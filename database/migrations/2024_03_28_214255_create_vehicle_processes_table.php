<?php

use App\Models\Vehicle;
use App\Models\VehicleCard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(VehicleCard::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Vehicle::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTimeTz('time_in')->nullable();
            $table->dateTimeTz('time_out')->nullable();
            $table->double('fee_charge', 10, 2)->nullable()->default(0);
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_processes');
    }
};
