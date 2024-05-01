<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategory;
use App\Http\Requests\StoreUpdateRate;
use App\Http\Requests\StoreUpdateRechargeCard;
use App\Http\Requests\StoreUpdateVehicle;
use App\Models\Vehicle;
use App\Models\VehicleCard;
use App\Models\VehicleCategory;
use App\Models\VehicleRate;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function UpdateCreateCategory(StoreUpdateCategory $category) {
        try {
            VehicleCategory::updateOrCreate(
                ["id" => $category->category],
                [
                    'name' => $category->name,
                    'status' => $category->status
                ]
            );
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Category records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function UpdateCreateRate(StoreUpdateRate $rate) {
        try {
            VehicleRate::updateOrCreate(
                ["id" => $rate->rate],
                [
                    'vehicle_category_id' => $rate->category,
                    'rate' => $rate->rate_name,
                    'status' => $rate->status
                ]
            );
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Rate records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function UpdateCreateVehicle(StoreUpdateVehicle $vehicle) {
        try {
            Vehicle::updateOrCreate(
                ["id" => $vehicle->vehicle],
                [
                    'vehicle_category_id' => $vehicle->category,
                    'vehicle_card_id' => $vehicle->card,
                    'vehicle_name' => $vehicle->vehicle_name,
                    'card_fee' => $vehicle->card_fee,
                    'reg_no' => Str::upper($vehicle->reg_no),
                    'owner_name' => $vehicle->owner_name,
                    'owner_contact' => $vehicle->owner_contact
                ]
            );

            VehicleCard::find($vehicle->card)->update(['card_name' => Str::upper($vehicle->reg_no)]);

            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Vehicle records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function RechargeCardAmount(StoreUpdateRechargeCard $card){
        try {
            if ($card->ajax()) {
                Vehicle::find($card->id)->update(['card_fee' => DB::raw('card_fee + ' . $card->recharge_fee)]);
                return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Card recharged successfully!"]);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function getVehicleRecords(Request $request) {
        try {
            if ($request->ajax()) {
                $result_html = '';
                $vehicleDetails = DB::select("SELECT * FROM `vehicle_process_list` WHERE id = ?",[$request->id]);
                $time_in = Carbon::createFromFormat('Y-m-d H:i:s', $vehicleDetails[0]->time_in);
                $time_out = Carbon::createFromFormat('Y-m-d H:i:s', $vehicleDetails[0]->time_out);
                $time_diff_hours = $time_out->diffInHours($time_in);

                $result_html.='
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Owner Name </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.$vehicleDetails[0]->owner_name.'</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Owner Contact </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.$vehicleDetails[0]->owner_contact.'</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Plate Number </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.$vehicleDetails[0]->reg_no.'</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Time In </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.$time_in->diffForHumans().'</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Time Out </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.$time_out->diffForHumans().'</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Time Exceed </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.$time_diff_hours.'Hr</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Fee Charge </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click">'.number_format($vehicleDetails[0]->fee_charge).'</span>
                        </div>
                    </div>
                </div>';

                return response()->json($result_html);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
