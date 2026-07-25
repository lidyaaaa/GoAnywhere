<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ==========================================
        // 1. USERS (role: user, manager, superadmin)
        // ==========================================
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'manager', 'superadmin'])->default('user');
            $table->enum('location', ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'])->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // ==========================================
        // 2. VEHICLES (kendaraan)
        // ==========================================
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('vehicle_type', ['car', 'motorcycle']);
            $table->string('brand');
            $table->string('type'); // MPV/SUV/Sedan/Matic/Sport
            $table->integer('year');
            $table->enum('transmission', ['manual', 'automatic'])->nullable(); // untuk mobil
            $table->enum('transmission_motor', ['matic', 'manual'])->nullable(); // untuk motor
            $table->integer('capacity'); // muat orang / cc
            $table->string('color');
            $table->string('fuel');
            $table->decimal('price_per_day', 10, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'maintenance', 'rented'])->default('available');
            $table->enum('location', ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi']);
            $table->uuid('manager_id')->nullable();
            $table->integer('total_stock')->default(0);
            $table->integer('available_stock')->default(0);
            $table->timestamps();

            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });

        // ==========================================
        // 3. CARTS (keranjang)
        // ==========================================
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('vehicle_id');
            $table->integer('quantity'); // jumlah hari (max 7)
            $table->decimal('subtotal', 10, 2);
            $table->date('rental_start_date');
            $table->date('rental_end_date');
            $table->enum('status', ['pending', 'paid', 'active', 'completed', 'cancelled', 'expired'])->default('pending');
            $table->string('booking_code')->unique();
            $table->timestamp('payment_deadline')->nullable();
            $table->string('pickup_location')->default('SMKN 21 Jakarta');
            $table->timestamp('returned_at')->nullable();
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->boolean('is_late')->default(false);
            $table->integer('late_minutes')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles')
                  ->onDelete('restrict');
        });

        // ==========================================
        // 4. PAYMENTS
        // ==========================================
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cart_id');
            $table->uuid('user_id');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['qris', 'bank_transfer', 'gopay', 'dana', 'ovo'])->nullable();
            $table->enum('payment_status', ['pending', 'success', 'failed', 'expired'])->default('pending');
            $table->string('payment_code')->unique()->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')
                  ->references('id')
                  ->on('carts')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // ==========================================
        // 5. FINES (denda)
        // ==========================================
        Schema::create('fines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cart_id');
            $table->uuid('user_id');
            $table->uuid('vehicle_id');
            $table->integer('late_minutes');
            $table->decimal('fine_per_hour', 10, 2)->default(50000);
            $table->decimal('total_fine', 10, 2);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('payment_method', ['qris', 'bank_transfer', 'gopay', 'dana', 'ovo'])->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')
                  ->references('id')
                  ->on('carts')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles')
                  ->onDelete('restrict');
        });

        // ==========================================
        // 6. RENTAL_HISTORY
        // ==========================================
        Schema::create('rental_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cart_id');
            $table->uuid('user_id');
            $table->uuid('vehicle_id');
            $table->string('vehicle_name');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('pickup_location');
            $table->enum('status', ['completed', 'cancelled']);
            $table->timestamp('returned_at')->nullable();
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('cart_id')
                  ->references('id')
                  ->on('carts')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_histories');
        Schema::dropIfExists('fines');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('users');
    }
};