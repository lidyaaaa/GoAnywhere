<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'vehicle_id',
        'quantity',
        'quantity_days',
        'quantity_vehicle',
        'period',
        'package_type',
        'subtotal',
        'delivery_fee',
        'total_payment',
        'rental_start_date',
        'rental_end_date',
        'status',
        'booking_code',
        'payment_deadline',
        'pickup_location',
        'ktp_image',
        'handover_at',
        'returned_at',
        'fine_amount',
        'damage_fee',
        'damage_note',
        'reject_reason',
        'cancel_reason',
        'extra_charge',
        'extra_charge_note',
        'dispute_note',
        'is_late',
        'late_minutes',
    ];

    protected $casts = [
        'rental_start_date' => 'datetime',
        'rental_end_date' => 'datetime',
        'handover_at' => 'datetime',
        'returned_at' => 'datetime',
        'payment_deadline' => 'datetime',
        'subtotal' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total_payment' => 'decimal:2',
        'fine_amount' => 'decimal:2',
        'damage_fee' => 'decimal:2',
        'extra_charge' => 'decimal:2',
        'is_late' => 'boolean',
        'late_minutes' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function rentalHistory()
    {
        return $this->hasOne(RentalHistory::class);
    }
}