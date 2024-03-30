<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategory;
use App\Http\Requests\StoreUpdateRate;
use App\Http\Requests\StoreUpdateVehicle;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleRate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
                    'reg_no' => $vehicle->reg_no,
                    'owner_name' => $vehicle->owner_name,
                    'owner_contact' => $vehicle->owner_contact
                ]
            );
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "Vehicle records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
