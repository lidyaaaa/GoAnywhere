<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Carbon;

/**
 * Satu sumber kebenaran untuk perhitungan keterlambatan & denda sewa.
 */
class LateFeeCalculator
{
    /** Tarif denda keterlambatan per jam (Rp). */
    public const FINE_PER_HOUR = 50000;

    /** Toleransi keterlambatan (menit) sebelum denda berlaku. */
    public const TOLERANCE_MINUTES = 30;

    public static function calculate(Cart $cart, ?Carbon $returnedAt = null): array
    {
        $returnedAt ??= now();
        $dueAt = Carbon::parse($cart->rental_end_date);
        $toleranceAt = $dueAt->copy()->addMinutes(self::TOLERANCE_MINUTES);
        $isLate = $returnedAt->greaterThan($toleranceAt);

        // Arah eksplisit (tenggat -> kembali) + abs(): Carbon 3 mengembalikan nilai bertanda
        $lateMinutes = $isLate ? (int) abs($toleranceAt->diffInMinutes($returnedAt)) : 0;
        $billableHours = (int) ceil($lateMinutes / 60);

        return [
            'is_late'        => $isLate,
            'due_at'         => $dueAt,
            'tolerance_at'   => $toleranceAt,
            'returned_at'    => $returnedAt,
            'late_minutes'   => $lateMinutes,
            'late_days'      => intdiv($billableHours, 24),
            'billable_hours' => $billableHours,
            'duration_label' => self::formatDuration($lateMinutes),
            'fine_per_hour'  => self::FINE_PER_HOUR,
            'fine_per_day'   => self::FINE_PER_HOUR * 24,
            'fine_amount'    => $billableHours * self::FINE_PER_HOUR,
        ];
    }

    /** Menit -> "X hari Y jam" (sisa menit dibulatkan ke atas sebagai jam tertagih). */
    public static function formatDuration(int $minutes): string
    {
        $hours = (int) ceil($minutes / 60);
        $days = intdiv($hours, 24);
        $remHours = $hours % 24;

        $parts = [];
        if ($days > 0) $parts[] = "{$days} hari";
        if ($remHours > 0 || $days === 0) $parts[] = "{$remHours} jam";

        return implode(' ', $parts);
    }

    public static function rupiah(int|float $amount): string
    {
        return 'Rp ' . number_format(abs($amount), 0, ',', '.');
    }
}
