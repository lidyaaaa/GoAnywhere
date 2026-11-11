<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'location',
        'phone',
    ];

    /** Format nomor WA Indonesia: 08xx / 628xx / +628xx (spasi & strip diperbolehkan). */
    public const PHONE_REGEX = 'regex:/^(\+?62|0)8[0-9\s\-]{7,15}$/';

    public const PHONE_MESSAGES = [
        'phone.required' => 'Nomor WhatsApp wajib diisi.',
        'phone.regex'    => 'Format nomor WhatsApp tidak valid. Contoh: 081234567890.',
    ];

    /** Simpan nomor dalam format internasional (628xxx) agar langsung bisa dipakai wa.me. */
    public function setPhoneAttribute(?string $value): void
    {
        $digits = preg_replace('/\D/', '', (string) $value);
        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }
        $this->attributes['phone'] = $digits !== '' ? $digits : null;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'manager_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function rentalHistories()
    {
        return $this->hasMany(RentalHistory::class);
    }

    public function userConversations()
    {
        return $this->hasMany(Conversation::class, 'user_id');
    }

    public function managerConversations()
    {
        return $this->hasMany(Conversation::class, 'manager_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}