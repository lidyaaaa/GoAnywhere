<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'cart_id',
        'user_id',
        'vehicle_id',
        'late_minutes',
        'fine_per_hour',
        'total_fine',
        'payment_status',
        'payment_method',
        'paid_at',
    ];

    protected $casts = [
        'fine_per_hour' => 'decimal:2',
        'total_fine' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
