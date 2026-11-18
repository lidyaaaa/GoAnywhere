<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('rental_histories')) {
            DB::statement("ALTER TABLE `rental_histories` MODIFY `total_price` DECIMAL(16, 2) NOT NULL");
            DB::statement("ALTER TABLE `rental_histories` MODIFY `fine_amount` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('rental_histories')) {
            DB::statement("ALTER TABLE `rental_histories` MODIFY `total_price` DECIMAL(10, 2) NOT NULL");
            DB::statement("ALTER TABLE `rental_histories` MODIFY `fine_amount` DECIMAL(10, 2) NOT NULL DEFAULT 0.00");
        }
    }
};
