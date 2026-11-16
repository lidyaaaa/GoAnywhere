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
        // 1. vehicles table
        if (Schema::hasTable('vehicles')) {
            DB::statement("ALTER TABLE `vehicles` MODIFY `price_per_day` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            if (Schema::hasColumn('vehicles', 'price_per_week')) {
                DB::statement("ALTER TABLE `vehicles` MODIFY `price_per_week` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
        }

        // 2. carts table
        if (Schema::hasTable('carts')) {
            DB::statement("ALTER TABLE `carts` MODIFY `subtotal` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            DB::statement("ALTER TABLE `carts` MODIFY `fine_amount` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            if (Schema::hasColumn('carts', 'delivery_fee')) {
                DB::statement("ALTER TABLE `carts` MODIFY `delivery_fee` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
            if (Schema::hasColumn('carts', 'total_payment')) {
                DB::statement("ALTER TABLE `carts` MODIFY `total_payment` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
            if (Schema::hasColumn('carts', 'damage_fee')) {
                DB::statement("ALTER TABLE `carts` MODIFY `damage_fee` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
            if (Schema::hasColumn('carts', 'extra_charge')) {
                DB::statement("ALTER TABLE `carts` MODIFY `extra_charge` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
        }

        // 3. payments table
        if (Schema::hasTable('payments')) {
            DB::statement("ALTER TABLE `payments` MODIFY `amount` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
        }

        // 4. fines table
        if (Schema::hasTable('fines')) {
            DB::statement("ALTER TABLE `fines` MODIFY `fine_per_hour` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            DB::statement("ALTER TABLE `fines` MODIFY `total_fine` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
        }

        // 5. bookings table (if exists)
        if (Schema::hasTable('bookings')) {
            if (Schema::hasColumn('bookings', 'total_price')) {
                DB::statement("ALTER TABLE `bookings` MODIFY `total_price` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
            if (Schema::hasColumn('bookings', 'fine_amount')) {
                DB::statement("ALTER TABLE `bookings` MODIFY `fine_amount` DECIMAL(16, 2) NOT NULL DEFAULT 0.00");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('vehicles')) {
            DB::statement("ALTER TABLE `vehicles` MODIFY `price_per_day` DECIMAL(10, 2) NOT NULL DEFAULT 0.00");
        }
        if (Schema::hasTable('carts')) {
            DB::statement("ALTER TABLE `carts` MODIFY `subtotal` DECIMAL(10, 2) NOT NULL DEFAULT 0.00");
        }
    }
};
