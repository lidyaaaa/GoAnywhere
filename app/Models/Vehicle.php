<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'vehicle_type',
        'brand',
        'type',
        'year',
        'transmission',
        'transmission_motor',
        'capacity',
        'color',
        'fuel',
        'price_per_day',
        'description',
        'image',
        'status',
        'location',
        'manager_id',
        'total_stock',
        'available_stock',
    ];

    protected $casts = [
        'year' => 'integer',
        'capacity' => 'integer',
        'price_per_day' => 'decimal:2',
        'total_stock' => 'integer',
        'available_stock' => 'integer',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function rentalHistories()
    {
        return $this->hasMany(RentalHistory::class);
    }
}