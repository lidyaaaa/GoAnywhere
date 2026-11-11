<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE carts MODIFY status ENUM('pending','paid','active','completed','cancelled','expired','dispute','lost') NOT NULL DEFAULT 'pending'");

        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('extra_charge', 12, 2)->default(0)->after('fine_amount');
            $table->string('extra_charge_note')->nullable()->after('extra_charge');
            $table->text('dispute_note')->nullable()->after('extra_charge_note');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('suspended_at')->nullable()->after('phone');
            $table->string('suspended_reason')->nullable()->after('suspended_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn(['suspended_at', 'suspended_reason']));
        Schema::table('carts', fn (Blueprint $t) => $t->dropColumn(['extra_charge', 'extra_charge_note', 'dispute_note']));
        DB::statement("ALTER TABLE carts MODIFY status ENUM('pending','paid','active','completed','cancelled','expired') NOT NULL DEFAULT 'pending'");
    }
};
