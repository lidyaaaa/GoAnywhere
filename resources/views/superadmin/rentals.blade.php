<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Semua Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Transaksi Aktif -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Transaksi Aktif</h3>
                
                @if(count($rentals) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kendaraan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penyewa</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($rentals as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">{{ $item->booking_code }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->vehicle->location ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($item->status == 'active')
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                                            @elseif($item->status == 'paid')
                                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Paid</span>
                                            @else
                                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Tidak ada transaksi aktif</p>
                @endif
            </div>

            <!-- Riwayat -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Riwayat Transaksi</h3>
                
                @if(count($history) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kendaraan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penyewa</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($history as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">{{ $item->booking_code }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->vehicle->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->vehicle->location ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm font-semibold">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm">
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Selesai</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $history->links() }}
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada riwayat transaksi</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>