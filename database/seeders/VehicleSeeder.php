<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua manager
        $managers = User::where('role', 'manager')->get();

        // Data kendaraan per lokasi
        $vehicles = [
            'Jakarta' => [
                [
                    'name' => 'Toyota Avanza G 1.5',
                    'vehicle_type' => 'car',
                    'brand' => 'Toyota',
                    'type' => 'MPV',
                    'year' => 2022,
                    'transmission' => 'automatic',
                    'transmission_motor' => null,
                    'capacity' => 7,
                    'color' => 'Silver Metallic',
                    'fuel' => 'Bensin',
                    'price_per_day' => 350000,
                    'description' => 'Kendaraan nyaman untuk keluarga, AC dingin, interior bersih. Cocok untuk perjalanan jauh.',
                    'total_stock' => 5,
                    'available_stock' => 5,
                ],
                [
                    'name' => 'Honda Civic Turbo',
                    'vehicle_type' => 'car',
                    'brand' => 'Honda',
                    'type' => 'Sedan',
                    'year' => 2023,
                    'transmission' => 'automatic',
                    'transmission_motor' => null,
                    'capacity' => 5,
                    'color' => 'Putih',
                    'fuel' => 'Bensin',
                    'price_per_day' => 600000,
                    'description' => 'Mobil sporty dengan performa tinggi. Cocok untuk gaya hidup modern.',
                    'total_stock' => 3,
                    'available_stock' => 3,
                ],
                [
                    'name' => 'Honda Vario 125 CBS',
                    'vehicle_type' => 'motorcycle',
                    'brand' => 'Honda',
                    'type' => 'Matic',
                    'year' => 2023,
                    'transmission' => null,
                    'transmission_motor' => 'matic',
                    'capacity' => 125,
                    'color' => 'Red',
                    'fuel' => 'Pertalite',
                    'price_per_day' => 150000,
                    'description' => 'Motor irit dan nyaman untuk harian. Cocok untuk mobilitas di perkotaan.',
                    'total_stock' => 7,
                    'available_stock' => 7,
                ],
            ],
            'Bogor' => [
                [
                    'name' => 'Daihatsu Xenia 1.3',
                    'vehicle_type' => 'car',
                    'brand' => 'Daihatsu',
                    'type' => 'MPV',
                    'year' => 2021,
                    'transmission' => 'manual',
                    'transmission_motor' => null,
                    'capacity' => 7,
                    'color' => 'Hitam',
                    'fuel' => 'Bensin',
                    'price_per_day' => 250000,
                    'description' => 'Kendaraan irit dan cocok untuk perjalanan jauh. Perawatan mudah.',
                    'total_stock' => 4,
                    'available_stock' => 4,
                ],
                [
                    'name' => 'Yamaha NMAX 155',
                    'vehicle_type' => 'motorcycle',
                    'brand' => 'Yamaha',
                    'type' => 'Matic',
                    'year' => 2023,
                    'transmission' => null,
                    'transmission_motor' => 'matic',
                    'capacity' => 155,
                    'color' => 'Hitam',
                    'fuel' => 'Pertamax',
                    'price_per_day' => 180000,
                    'description' => 'Motor premium dengan fitur canggih. Nyaman untuk perjalanan jauh.',
                    'total_stock' => 5,
                    'available_stock' => 5,
                ],
            ],
            'Depok' => [
                [
                    'name' => 'Suzuki Ertiga GL',
                    'vehicle_type' => 'car',
                    'brand' => 'Suzuki',
                    'type' => 'MPV',
                    'year' => 2022,
                    'transmission' => 'manual',
                    'transmission_motor' => null,
                    'capacity' => 7,
                    'color' => 'Biru',
                    'fuel' => 'Bensin',
                    'price_per_day' => 280000,
                    'description' => 'Mobil keluarga dengan kabin luas. Cocok untuk perjalanan bersama keluarga.',
                    'total_stock' => 3,
                    'available_stock' => 3,
                ],
                [
                    'name' => 'Honda Beat Street',
                    'vehicle_type' => 'motorcycle',
                    'brand' => 'Honda',
                    'type' => 'Matic',
                    'year' => 2023,
                    'transmission' => null,
                    'transmission_motor' => 'matic',
                    'capacity' => 110,
                    'color' => 'Putih',
                    'fuel' => 'Pertalite',
                    'price_per_day' => 120000,
                    'description' => 'Motor irit dan stylish untuk anak muda. Cocok untuk harian.',
                    'total_stock' => 6,
                    'available_stock' => 6,
                ],
            ],
            'Tangerang' => [
                [
                    'name' => 'Mitsubishi Xpander',
                    'vehicle_type' => 'car',
                    'brand' => 'Mitsubishi',
                    'type' => 'MPV',
                    'year' => 2023,
                    'transmission' => 'automatic',
                    'transmission_motor' => null,
                    'capacity' => 7,
                    'color' => 'Putih',
                    'fuel' => 'Bensin',
                    'price_per_day' => 400000,
                    'description' => 'Mobil premium dengan desain modern. Cocok untuk gaya hidup mewah.',
                    'total_stock' => 3,
                    'available_stock' => 3,
                ],
                [
                    'name' => 'Yamaha Mio M3',
                    'vehicle_type' => 'motorcycle',
                    'brand' => 'Yamaha',
                    'type' => 'Matic',
                    'year' => 2022,
                    'transmission' => null,
                    'transmission_motor' => 'matic',
                    'capacity' => 125,
                    'color' => 'Biru',
                    'fuel' => 'Pertalite',
                    'price_per_day' => 130000,
                    'description' => 'Motor murah dan irit untuk harian. Cocok untuk pelajar dan mahasiswa.',
                    'total_stock' => 8,
                    'available_stock' => 8,
                ],
            ],
            'Bekasi' => [
                [
                    'name' => 'Toyota Fortuner G',
                    'vehicle_type' => 'car',
                    'brand' => 'Toyota',
                    'type' => 'SUV',
                    'year' => 2023,
                    'transmission' => 'automatic',
                    'transmission_motor' => null,
                    'capacity' => 7,
                    'color' => 'Hitam',
                    'fuel' => 'Diesel',
                    'price_per_day' => 750000,
                    'description' => 'SUV tangguh untuk segala medan. Cocok untuk perjalanan off-road.',
                    'total_stock' => 2,
                    'available_stock' => 2,
                ],
                [
                    'name' => 'Honda PCX 160',
                    'vehicle_type' => 'motorcycle',
                    'brand' => 'Honda',
                    'type' => 'Matic',
                    'year' => 2023,
                    'transmission' => null,
                    'transmission_motor' => 'matic',
                    'capacity' => 160,
                    'color' => 'Silver',
                    'fuel' => 'Pertamax',
                    'price_per_day' => 200000,
                    'description' => 'Motor mewah dengan performa tinggi. Cocok untuk perjalanan jauh.',
                    'total_stock' => 4,
                    'available_stock' => 4,
                ],
            ],
        ];

        foreach ($vehicles as $location => $vehicleList) {
            // Cari manager untuk lokasi ini
            $manager = $managers->firstWhere('location', $location);

            foreach ($vehicleList as $vehicle) {
                Vehicle::create([
                    'id' => Str::uuid(),
                    'name' => $vehicle['name'],
                    'vehicle_type' => $vehicle['vehicle_type'],
                    'brand' => $vehicle['brand'],
                    'type' => $vehicle['type'],
                    'year' => $vehicle['year'],
                    'transmission' => $vehicle['transmission'],
                    'transmission_motor' => $vehicle['transmission_motor'],
                    'capacity' => $vehicle['capacity'],
                    'color' => $vehicle['color'],
                    'fuel' => $vehicle['fuel'],
                    'price_per_day' => $vehicle['price_per_day'],
                    'description' => $vehicle['description'],
                    'location' => $location,
                    'manager_id' => $manager ? $manager->id : null,
                    'total_stock' => $vehicle['total_stock'],
                    'available_stock' => $vehicle['available_stock'],
                    'status' => 'available',
                    'image' => null,
                ]);
            }
        }
    }
}