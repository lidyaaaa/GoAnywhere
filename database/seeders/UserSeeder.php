<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // SUPERADMIN
        User::create([
            'id' => Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'superadmin@goanywhere.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'location' => null,
            'phone' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // MANAGERS (5 lokasi)
        $managers = [
            ['name' => 'Jakarta', 'email' => 'jakarta@goanywhere.com'],
            ['name' => 'Bogor', 'email' => 'bogor@goanywhere.com'],
            ['name' => 'Depok', 'email' => 'depok@goanywhere.com'],
            ['name' => 'Tangerang', 'email' => 'tangerang@goanywhere.com'],
            ['name' => 'Bekasi', 'email' => 'bekasi@goanywhere.com'],
        ];

        foreach ($managers as $manager) {
            User::create([
                'id' => Str::uuid(),
                'name' => 'Manager ' . $manager['name'],
                'email' => $manager['email'],
                'password' => Hash::make('password'),
                'role' => 'manager',
                'location' => $manager['name'],
                'phone' => '08' . rand(1000000000, 9999999999),
                'email_verified_at' => now(),
            ]);
        }

        // USERS (10 sample)
        $userNames = ['Andi', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fitri', 'Gilang', 'Hana', 'Iqbal', 'Joko'];
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'id' => Str::uuid(),
                'name' => $userNames[$i] . ' ' . ['Saputra', 'Wijaya', 'Kusuma', 'Putri', 'Hidayat'][rand(0, 4)],
                'email' => 'user' . ($i + 1) . '@goanywhere.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'location' => null,
                'phone' => '08' . rand(1000000000, 9999999999),
                'email_verified_at' => now(),
            ]);
        }
    }
}