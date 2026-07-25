<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'period')) {
                $table->string('period')->default('daily')->after('quantity');
            }
            if (!Schema::hasColumn('carts', 'quantity_days')) {
                $table->integer('quantity_days')->default(1)->after('period');
            }
            if (!Schema::hasColumn('carts', 'quantity_vehicle')) {
                $table->integer('quantity_vehicle')->default(1)->after('quantity_days');
            }
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'period')) {
                $table->dropColumn('period');
            }
            if (Schema::hasColumn('carts', 'quantity_days')) {
                $table->dropColumn('quantity_days');
            }
            if (Schema::hasColumn('carts', 'quantity_vehicle')) {
                $table->dropColumn('quantity_vehicle');
            }
        });
    }
};