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

        DB::unprepared("
        CREATE OR REPLACE VIEW `category_exists` AS
            SELECT c.*
            FROM `vehicle_categories` c
            LEFT JOIN `vehicle_rates` r ON r.vehicle_category_id = c.id
            WHERE r.vehicle_category_id IS NULL;
        ");

        DB::unprepared("
        CREATE OR REPLACE VIEW `card_exists` AS
            SELECT c.*
            FROM `vehicle_cards` c
            LEFT JOIN `vehicles` v ON v.vehicle_card_id = c.id
            WHERE v.vehicle_card_id IS NULL;
        ");

        DB::unprepared("
        CREATE OR REPLACE VIEW `vehicle_list` AS
            SELECT v.*,
                c.card_no,
                r.rate
            FROM `vehicles` v
            LEFT JOIN `vehicle_cards` c ON c.id = v.vehicle_card_id
            LEFT JOIN `vehicle_categories` t ON t.id = v.vehicle_category_id
            LEFT JOIN `vehicle_rates` r ON r.vehicle_category_id = t.id;
        ");

        DB::unprepared("
        CREATE OR REPLACE VIEW `vehicle_process_list` AS
            SELECT p.*,
                v.card_fee,
                v.reg_no,
                v.owner_name,
                v.owner_contact,
                c.card_no,
                t.name,
                r.rate
            FROM `vehicle_processes` p
            LEFT JOIN `vehicles` v ON v.id = p.vehicle_id
            LEFT JOIN `vehicle_cards` c ON c.id = p.vehicle_card_id
            LEFT JOIN `vehicle_categories` t ON t.id = v.vehicle_category_id
            LEFT JOIN `vehicle_rates` r ON v.vehicle_category_id = r.id;
        ");
    }
};
