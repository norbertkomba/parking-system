<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCard;
use App\Http\Requests\StoreUpdateDevice;
use App\Models\Device;
use App\Models\Vehicle;
use App\Models\VehicleCard;
use App\Models\VehicleProcess;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    public function UpdateCreateDevice(StoreUpdateDevice $device) {
        try {
            Device::updateOrCreate(
                ["id" => $device->device],
                [
                    'device_name' => $device->device_name,
                    'card_limit' => $device->card_limit
                ]
            );
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Device records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function UpdateCreateCard(StoreUpdateCard $card) {
        try {
            VehicleCard::updateOrCreate(["id" => $card->card],['card_name' => $card->card_name]);
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Card records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function GetDetailsFromArduino(Request $request) {
        try {
            $device = Device::where("device_no",$request['device_token'])->first();
            $card = VehicleCard::where("device_token",$request['device_token'])->where("card_no",$request['card_uid'])->first();
            if (!$device->device_mode) {
                if ($card) {
                    return response()->json(['message' => 'available'], 200);
                }

                VehicleCard::create([
                    'device_token' => $request['device_token'],
                    'card_no' => $request['card_uid'],
                ]);
                return response()->json(['message' => 'available'], 200);
            }
            else {
                $vehicle = Vehicle::where("vehicle_card_id",$card->id)->first();
                $vehicleCheck = VehicleProcess::where("vehicle_card_id",$card->id)->where("vehicle_id",$vehicle->id)->where("status",false)->first();

                return (is_null($vehicleCheck)
                        ? $this->vehicle_enter($card,$vehicle)
                        : $this->vehicle_leave($vehicleCheck));
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function vehicle_enter($card,$vehicle) {
        VehicleProcess::create([
            'vehicle_card_id' => $card->id,
            'vehicle_id' => $vehicle->id,
            'time_in' => Carbon::now(),
        ]);
        return response()->json(['message' => 'login'], 200);
    }

    public function vehicle_leave($vehicle) {
        $process = DB::select('SELECT * FROM `vehicle_process_list` WHERE  `id` = ?',[$vehicle->id]);
        $time_in = Carbon::createFromFormat('Y-m-d H:i:s', $process[0]->time_in);
        $time_out = Carbon::now();
        $time_diff_hours = $time_out->diffInHours($time_in);

        $rate = $process[0]->rate;
        $card_fee = $process[0]->card_fee;

        $fee_coll = ($time_diff_hours > 1) ? $card_fee - ($time_diff_hours * $rate) : 0;

        VehicleProcess::find($vehicle->id)->update([
            'time_out' => Carbon::now(),
            'fee_charge' => ($time_diff_hours * $rate),
            'status' => true
        ]);
        Vehicle::find($process[0]->vehicle_id)->update(["card_fee" => $fee_coll]);

        return response()->json(['message' => 'logout'], 200);
    }
}
