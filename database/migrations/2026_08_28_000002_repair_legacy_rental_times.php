<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('carts')
            ->where('status', 'active')
            ->whereTime('rental_start_date', '00:00:00')
            ->orderBy('id')
            ->get()
            ->each(function ($cart) {
                $startTime = Carbon::parse($cart->updated_at);
                $totalDays = $cart->period === 'weekly'
                    ? 7
                    : ($cart->quantity_days ?: 1);

                DB::table('carts')
                    ->where('id', $cart->id)
                    ->update([
                        'rental_start_date' => $startTime,
                        'rental_end_date' => $startTime->copy()->addDays($totalDays),
                    ]);
            });
    }

    public function down(): void
    {
        // Legacy timestamps are intentionally preserved after repair.
    }
};
