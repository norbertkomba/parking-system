<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCard;
use App\Http\Requests\StoreUpdateDevice;
use App\Models\Device;
use App\Models\VehicleCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            VehicleCard::updateOrCreate(
                ["id" => $card->card],
                [
                    'device_id' => $card->device,
                    'card_no' => $card->card_no,
                    'card_fee' => $card->card_fee,
                    'card_name' => $card->card_name,
                ]
            );
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Card records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function GetDetailsFromArduino(Request $request) {
        
    }
}
