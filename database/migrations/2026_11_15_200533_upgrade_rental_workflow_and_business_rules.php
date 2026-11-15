<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Modifikasi ENUM status pada tabel carts
        DB::statement("ALTER TABLE carts MODIFY status ENUM('pending','paid','cancelled','rejected','approved','active','pending_return','pending_payment','completed','expired','dispute','lost') NOT NULL DEFAULT 'pending'");

        // 2. Tambah kolom pada tabel users jika belum ada
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('location');
            }
        });

        // 3. Tambah/Ubah kolom pada tabel vehicles
        Schema::table('vehicles', function (Blueprint $table) {
            if (!Schema::hasColumn('vehicles', 'price_per_week')) {
                $table->decimal('price_per_week', 14, 2)->default(0)->after('price_per_day');
            }
            if (!Schema::hasColumn('vehicles', 'damaged_stock')) {
                $table->integer('damaged_stock')->default(0)->after('available_stock');
            }
        });

        // Pastikan tipe price_per_week cukup besar untuk mobil mewah (misal Rolls-Royce Rp 25.000.000 / hari)
        DB::statement("ALTER TABLE vehicles MODIFY price_per_week DECIMAL(14, 2) NOT NULL DEFAULT 0.00");

        // 4. Tambah kolom pada tabel carts jika belum ada
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'package_type')) {
                $table->enum('package_type', ['daily', 'weekly'])->default('daily')->after('period');
            }
            if (!Schema::hasColumn('carts', 'delivery_fee')) {
                $table->decimal('delivery_fee', 10, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('carts', 'total_payment')) {
                $table->decimal('total_payment', 14, 2)->default(0)->after('delivery_fee');
            }
            if (!Schema::hasColumn('carts', 'ktp_image')) {
                $table->string('ktp_image')->nullable()->after('pickup_location');
            }
            if (!Schema::hasColumn('carts', 'handover_at')) {
                $table->timestamp('handover_at')->nullable()->after('ktp_image');
            }
            if (!Schema::hasColumn('carts', 'damage_fee')) {
                $table->decimal('damage_fee', 14, 2)->default(0)->after('fine_amount');
            }
            if (!Schema::hasColumn('carts', 'damage_note')) {
                $table->text('damage_note')->nullable()->after('damage_fee');
            }
            if (!Schema::hasColumn('carts', 'reject_reason')) {
                $table->text('reject_reason')->nullable()->after('damage_note');
            }
        });

        // Seed price_per_week: jika masih 0, isi diskon 7 hari seharga 5.5 hari
        DB::statement("UPDATE vehicles SET price_per_week = ROUND(price_per_day * 5.5, 0) WHERE price_per_week = 0 OR price_per_week IS NULL");
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn([
                'package_type',
                'delivery_fee',
                'total_payment',
                'ktp_image',
                'handover_at',
                'damage_fee',
                'damage_note',
                'reject_reason',
            ]);
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['price_per_week', 'damaged_stock']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address']);
        });

        DB::statement("ALTER TABLE carts MODIFY status ENUM('pending','paid','active','completed','cancelled','expired','dispute','lost') NOT NULL DEFAULT 'pending'");
    }
};
