<?php

use App\Models\VehicleCard;
use App\Models\VehicleCategory;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(VehicleCategory::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(VehicleCard::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('vehicle_name', 100);
            $table->double('card_fee', 10, 2)->default(0);
            $table->string('reg_no', 100);
            $table->string('owner_name', 100);
            $table->string('owner_contact', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
