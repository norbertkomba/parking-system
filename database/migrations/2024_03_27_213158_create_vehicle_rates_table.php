<?php

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
        Schema::create('vehicle_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(VehicleCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->double('rate', 10, 2)->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_rates');
    }
};
