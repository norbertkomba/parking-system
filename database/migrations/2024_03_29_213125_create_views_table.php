<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
        CREATE OR REPLACE VIEW `vehicle_rate_view` AS
            SELECT r.*,
                c.name
            FROM `vehicle_rates` r
            JOIN `vehicle_categories` c ON c.id = r.vehicle_category_id;
        ");
    }
};
