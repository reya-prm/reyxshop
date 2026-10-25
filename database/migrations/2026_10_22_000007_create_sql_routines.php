<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            try {
                // 1. Function
                DB::unprepared(file_get_contents(database_path('sql/functions/fn_product_final_price.sql')));
            } catch (Throwable $e) {
                Log::warning('Could not install fn_product_final_price (requires SUPER or log_bin_trust_function_creators): '.$e->getMessage());
            }

            try {
                // 2. Procedure
                DB::unprepared(file_get_contents(database_path('sql/procedures/sp_update_product_stock.sql')));
            } catch (Throwable $e) {
                Log::warning('Could not install sp_update_product_stock: '.$e->getMessage());
            }

            try {
                // 3. Trigger
                DB::unprepared(file_get_contents(database_path('sql/triggers/trg_product_stock_status.sql')));
            } catch (Throwable $e) {
                Log::warning('Could not install trg_product_stock_status: '.$e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            try {
                DB::unprepared('DROP TRIGGER IF EXISTS trg_product_stock_status;');
            } catch (Throwable $e) {
            }

            try {
                DB::unprepared('DROP PROCEDURE IF EXISTS sp_update_product_stock;');
            } catch (Throwable $e) {
            }

            try {
                DB::unprepared('DROP FUNCTION IF EXISTS fn_product_final_price;');
            } catch (Throwable $e) {
            }
        }
    }
};
