<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE carts MODIFY rental_start_date DATETIME NOT NULL');
        DB::statement('ALTER TABLE carts MODIFY rental_end_date DATETIME NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE carts MODIFY rental_start_date DATE NOT NULL');
        DB::statement('ALTER TABLE carts MODIFY rental_end_date DATE NOT NULL');
    }
};
