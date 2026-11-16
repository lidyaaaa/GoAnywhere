<?php

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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('transmission', 50)->nullable()->change();
            $table->string('transmission_motor', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->enum('transmission', ['manual', 'automatic'])->nullable()->change();
            $table->enum('transmission_motor', ['matic', 'manual'])->nullable()->change();
        });
    }
};
