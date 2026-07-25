<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🚗 Kelola Semua Armada
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">❌ {{ session('error') }}</div>
            @endif

            <!-- Tambah Kendaraan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">➕ Tambah Kendaraan</h3>
                <form action="{{ route('superadmin.vehicles.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Kendaraan" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="text" name="brand" placeholder="Merk" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="text" name="type" placeholder="Tipe (MPV/SUV/Sedan)" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="number" name="year" placeholder="Tahun" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <select name="vehicle_type" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        <option value="car">🚗 Mobil</option>
                        <option value="motorcycle">🏍️ Motor</option>
                    </select>
                    <input type="text" name="color" placeholder="Warna" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="text" name="fuel" placeholder="BBM" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="number" name="capacity" placeholder="Kapasitas (Orang/CC)" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="number" name="price_per_day" placeholder="Harga/Hari" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="number" name="total_stock" placeholder="Stok" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <select name="location" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        <option value="">Pilih Lokasi</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="description" placeholder="Deskripsi" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">💾 Tambah</button>
                </form>
            </div>

            <!-- List Kendaraan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Merk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Manager</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($vehicles as $vehicle)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $vehicle->name }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $vehicle->brand }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $vehicle->location }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $vehicle->available_stock }}/{{ $vehicle->total_stock }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $vehicle->manager->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <form action="{{ route('superadmin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Hapus kendaraan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition text-sm">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada kendaraan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>