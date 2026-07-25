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
        'quantity_days',      // 🔥 TAMBAH INI
        'quantity_vehicle',   // 🔥 TAMBAH INI
        'period',             // 🔥 TAMBAH INI
        'subtotal',
        'rental_start_date',
        'rental_end_date',
        'status',
        'booking_code',
        'payment_deadline',
        'pickup_location',
        'returned_at',
        'fine_amount',
        'is_late',
        'late_minutes',
    ];

    protected $casts = [
        'rental_start_date' => 'date',
        'rental_end_date' => 'date',
        'returned_at' => 'datetime',
        'payment_deadline' => 'datetime',
        'subtotal' => 'decimal:2',
        'fine_amount' => 'decimal:2',
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