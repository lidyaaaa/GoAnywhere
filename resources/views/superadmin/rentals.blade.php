<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 leading-tight flex items-center gap-2.5">
                    <span class="text-2xl">📋</span> Kelola Transaksi (Super Admin)
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Monitoring transaksi sewa kendaraan di seluruh cabang Jabodetabek secara real-time.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3.5 py-1.5 bg-[#004B87]/10 text-[#004B87] font-bold text-xs rounded-full border border-[#004B87]/20 flex items-center gap-1.5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Total: {{ $statusCounts['all'] }} Transaksi
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- ===== 1. KARTU STATISTIK RINGKAS ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Transaksi -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Transaksi</span>
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-lg text-slate-700">
                            📑
                        </div>
                    </div>
                    <div class="text-2xl font-black text-slate-800">{{ $stats['total_transactions'] }}</div>
                    <p class="text-xs text-slate-500 mt-1">Seluruh booking masuk ke sistem</p>
                </div>

                <!-- Aktif / Sedang Berjalan -->
                <div class="bg-white border border-blue-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Aktif & OTW</span>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-lg text-blue-700">
                            🚗
                        </div>
                    </div>
                    <div class="text-2xl font-black text-blue-700">{{ $stats['active_running'] }}</div>
                    <p class="text-xs text-slate-500 mt-1">{{ $statusCounts['approved'] }} OTW • {{ $statusCounts['active'] }} sedang dipakai</p>
                </div>

                <!-- Menunggu Tindakan -->
                <div class="bg-white border border-amber-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Menunggu Tindakan</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-lg text-amber-700">
                            ⏳
                        </div>
                    </div>
                    <div class="text-2xl font-black text-amber-700">{{ $stats['pending_action'] }}</div>
                    <p class="text-xs text-slate-500 mt-1">{{ $statusCounts['paid'] }} approve • {{ $statusCounts['pending_return'] }} cek fisik • {{ $statusCounts['pending_payment'] }} denda</p>
                </div>

                <!-- Selesai & Pendapatan -->
                <div class="bg-white border border-emerald-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Selesai & Lunas</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-lg text-emerald-700">
                            💰
                        </div>
                    </div>
                    <div class="text-2xl font-black text-emerald-700">{{ $stats['completed'] }}</div>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- ===== 2. FILTER & SEARCH BAR ===== -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                <form action="{{ route('superadmin.rentals') }}" method="GET" class="space-y-4">
                    <input type="hidden" name="status" value="{{ $statusFilter }}">

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <!-- Search Box -->
                        <div class="md:col-span-5 relative">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Pencarian</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    🔍
                                </span>
                                <input type="text" 
                                       name="search" 
                                       value="{{ $search }}" 
                                       placeholder="Cari Kode Booking, Customer, atau Armada..." 
                                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                            </div>
                        </div>

                        <!-- Filter Manager / Cabang -->
                        <div class="md:col-span-4">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Filter Manager / Cabang</label>
                            <select name="manager_id" class="w-full py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-[#004B87] focus:ring-2 focus:ring-[#004B87]/20 transition">
                                <option value="all" {{ $managerFilter === 'all' ? 'selected' : '' }}>🏢 Semua Cabang & Manager</option>
                                @foreach($managers as $m)
                                    <option value="{{ $m->id }}" {{ $managerFilter == $m->id ? 'selected' : '' }}>
                                        📍 {{ $m->location }} — {{ $m->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="md:col-span-3 flex items-end gap-2">
                            <button type="submit" class="flex-1 py-2.5 px-4 bg-[#004B87] hover:bg-[#002D55] text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center justify-center gap-1.5">
                                <span>Filter</span>
                            </button>
                            @if(!empty($search) || $managerFilter !== 'all' || $statusFilter !== 'all')
                                <a href="{{ route('superadmin.rentals') }}" class="py-2.5 px-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm rounded-xl transition border border-slate-300" title="Reset Semua Filter">
                                    ↺ Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- ===== 3. STATUS TABS (FILTER STATUS) ===== -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-2 shadow-sm">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
                    @php
                        $statusTabs = [
                            'all' => ['label' => 'Semua', 'icon' => '📑', 'color' => 'slate'],
                            'paid' => ['label' => 'Menunggu Approval', 'icon' => '⏳', 'color' => 'amber'],
                            'approved' => ['label' => 'Disetujui / OTW', 'icon' => '🚚', 'color' => 'blue'],
                            'active' => ['label' => 'Aktif Digunakan', 'icon' => '🚗', 'color' => 'emerald'],
                            'pending_return' => ['label' => 'Cek Fisik Gerai', 'icon' => '🔍', 'color' => 'indigo'],
                            'pending_payment' => ['label' => 'Menunggu Denda', 'icon' => '⚠️', 'color' => 'rose'],
                            'completed' => ['label' => 'Selesai', 'icon' => '✅', 'color' => 'green'],
                            'cancelled' => ['label' => 'Dibatalkan', 'icon' => '🚫', 'color' => 'slate'],
                            'rejected' => ['label' => 'Ditolak', 'icon' => '❌', 'color' => 'red'],
                        ];
                    @endphp

                    @foreach($statusTabs as $stKey => $stData)
                        @php
                            $isActive = ($statusFilter === $stKey);
                            $badgeCount = $statusCounts[$stKey] ?? 0;
                        @endphp
                        <a href="{{ route('superadmin.rentals', array_merge(request()->query(), ['status' => $stKey, 'page' => 1])) }}"
                           class="flex items-center gap-2 px-3.5 py-2 rounded-xl font-bold whitespace-nowrap transition {{ $isActive ? 'bg-[#004B87] text-white shadow-sm' : 'bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200' }}">
                            <span>{{ $stData['icon'] }}</span>
                            <span>{{ $stData['label'] }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-extrabold {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-800' }}">
                                {{ $badgeCount }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- ===== 4. TABEL TRANSAKSI SUPERADMIN ===== -->
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h3 class="font-extrabold text-base text-slate-800">
                            Daftar Transaksi: <span class="text-[#004B87]">{{ $statusTabs[$statusFilter]['label'] ?? 'Semua' }}</span>
                        </h3>
                        <p class="text-xs text-slate-500">
                            Menampilkan {{ $rentals->count() }} dari {{ $rentals->total() }} total data sesuai filter.
                        </p>
                    </div>
                </div>

                @if($rentals->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-600 text-xs font-bold uppercase tracking-wider">
                                    <th class="py-3.5 px-4">Booking Info</th>
                                    <th class="py-3.5 px-4">Customer</th>
                                    <th class="py-3.5 px-4">Armada & Cabang</th>
                                    <th class="py-3.5 px-4">Durasi & Waktu</th>
                                    <th class="py-3.5 px-4">Rincian Pembayaran</th>
                                    <th class="py-3.5 px-4">Status</th>
                                    <th class="py-3.5 px-4 text-center">Catatan / Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                                @foreach($rentals as $rental)
                                    @php
                                        $managerUser = $managers->firstWhere('location', $rental->vehicle->location ?? '');
                                    @endphp
                                    <tr class="hover:bg-slate-50/60 transition">
                                        <!-- Booking Info -->
                                        <td class="py-4 px-4 align-top">
                                            <div class="font-mono font-bold text-slate-800">{{ $rental->booking_code }}</div>
                                            <div class="text-[11px] text-slate-500 mt-0.5">
                                                {{ $rental->created_at->format('d M Y, H:i') }}
                                            </div>
                                            <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-bold rounded bg-blue-100 text-blue-800">
                                                💳 {{ strtoupper($rental->payment->payment_type ?? 'ONLINE') }}
                                            </span>
                                        </td>

                                        <!-- Customer -->
                                        <td class="py-4 px-4 align-top">
                                            <div class="font-bold text-slate-900">{{ $rental->user->name ?? 'User Dihapus' }}</div>
                                            <div class="text-xs text-slate-500">{{ $rental->user->email ?? '-' }}</div>
                                            <div class="text-xs text-slate-500 mt-0.5">
                                                📞 {{ $rental->user->phone ?? 'Tanpa No. Telp' }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 mt-0.5">
                                                🏠 Lokasi: {{ $rental->user->location ?? '-' }}
                                            </div>
                                        </td>

                                        <!-- Armada & Cabang -->
                                        <td class="py-4 px-4 align-top">
                                            <div class="flex items-center gap-3">
                                                @if($rental->vehicle && $rental->vehicle->image)
                                                    <img src="{{ asset('storage/' . $rental->vehicle->image) }}" class="w-12 h-10 object-cover rounded-lg border border-slate-200 shadow-sm shrink-0">
                                                @else
                                                    <div class="w-12 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-base shrink-0">🚗</div>
                                                @endif
                                                <div>
                                                    <div class="font-bold text-slate-900">{{ $rental->vehicle->name ?? 'Armada N/A' }}</div>
                                                    <div class="text-xs text-slate-500">{{ $rental->vehicle->brand ?? '' }} • {{ $rental->vehicle->type ?? '' }}</div>
                                                    <div class="text-xs font-semibold text-[#004B87] mt-0.5 flex items-center gap-1">
                                                        <span>📍 Cabang: {{ $rental->vehicle->location ?? '-' }}</span>
                                                        @if($managerUser)
                                                            <span class="text-slate-400 font-normal">({{ $managerUser->name }})</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Durasi & Waktu -->
                                        <td class="py-4 px-4 align-top text-xs">
                                            <div class="font-semibold text-slate-800">
                                                ⏱️ {{ ($rental->package_type === 'weekly' || $rental->period === 'weekly') ? 'Paket 7 Hari (Mingguan)' : (($rental->quantity_days ?? 1) . ' Hari (Harian)') }}
                                            </div>
                                            @if($rental->handover_at)
                                                <div class="text-[11px] text-emerald-700 font-medium mt-1">
                                                    Mulai: {{ \Carbon\Carbon::parse($rental->handover_at)->format('d M Y, H:i') }}
                                                </div>
                                                <div class="text-[11px] text-slate-600">
                                                    Selesai: {{ \Carbon\Carbon::parse($rental->returned_at ?? $rental->rental_end_date)->format('d M Y, H:i') }}
                                                </div>
                                            @else
                                                <div class="text-[11px] text-slate-400 italic mt-1">
                                                    Timer sewa mulai saat serah terima unit
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Rincian Pembayaran -->
                                        <td class="py-4 px-4 align-top">
                                            <div class="font-bold text-slate-900 text-sm">
                                                Rp {{ number_format($rental->total_payment, 0, ',', '.') }}
                                            </div>
                                            <div class="text-[11px] text-slate-500 mt-0.5 space-y-0.5">
                                                <div>Sewa: Rp {{ number_format($rental->subtotal, 0, ',', '.') }}</div>
                                                <div>Ongkir: Rp {{ number_format($rental->delivery_fee, 0, ',', '.') }}</div>
                                                @if($rental->damage_fee > 0)
                                                    <div class="text-rose-600 font-semibold">Reparasi: Rp {{ number_format($rental->damage_fee, 0, ',', '.') }}</div>
                                                @endif
                                                @if($rental->fine_amount > 0)
                                                    <div class="text-amber-600 font-semibold">Denda Telat: Rp {{ number_format($rental->fine_amount, 0, ',', '.') }}</div>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Status Badge -->
                                        <td class="py-4 px-4 align-top">
                                            @if($rental->status === 'paid')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                    Menunggu Approval
                                                </span>
                                            @elseif($rental->status === 'approved')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                    <span>🚚</span> Disetujui (OTW)
                                                </span>
                                            @elseif($rental->status === 'active')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                                    Sedang Aktif
                                                </span>
                                            @elseif($rental->status === 'pending_return')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800 border border-indigo-200">
                                                    <span>🔍</span> Cek Fisik Gerai
                                                </span>
                                            @elseif($rental->status === 'pending_payment')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200 animate-pulse">
                                                    <span>⚠️</span> Menunggu Denda
                                                </span>
                                            @elseif($rental->status === 'completed')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <span>✅</span> Selesai & Lunas
                                                </span>
                                            @elseif($rental->status === 'cancelled')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                    <span>🚫</span> Dibatalkan User
                                                </span>
                                            @elseif($rental->status === 'rejected')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                    <span>❌</span> Ditolak Manager
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                                    {{ strtoupper($rental->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Catatan / Detail -->
                                        <td class="py-4 px-4 align-top text-xs">
                                            <div class="space-y-1">
                                                @if($rental->ktp_image)
                                                    <a href="{{ asset('storage/' . $rental->ktp_image) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 hover:text-blue-800 underline">
                                                        <span>🪪</span> Foto KTP Jaminan
                                                    </a>
                                                @endif

                                                @if($rental->damage_note)
                                                    <div class="p-1.5 rounded bg-rose-50 border border-rose-200 text-rose-800 text-[11px]">
                                                        <strong>Kerusakan:</strong> {{ $rental->damage_note }}
                                                    </div>
                                                @endif

                                                @if($rental->reject_reason)
                                                    <div class="p-1.5 rounded bg-red-50 border border-red-200 text-red-800 text-[11px]">
                                                        <strong>Alasan Tolak:</strong> {{ $rental->reject_reason }}
                                                    </div>
                                                @endif

                                                @if($rental->status === 'cancelled')
                                                    <span class="text-[11px] text-emerald-700 font-medium block">
                                                        ✓ Refund Berhasil
                                                    </span>
                                                @endif

                                                @if(!$rental->ktp_image && !$rental->damage_note && !$rental->reject_reason && $rental->status !== 'cancelled')
                                                    <span class="text-slate-400 italic text-[11px]">Tidak ada catatan khusus</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($rentals->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/50">
                            <div class="text-xs text-slate-500">
                                Menampilkan {{ $rentals->firstItem() }} - {{ $rentals->lastItem() }} dari {{ $rentals->total() }} total data
                            </div>
                            <div>
                                {{ $rentals->links() }}
                            </div>
                        </div>
                    @endif

                @else
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-3xl text-slate-400">
                            🔍
                        </div>
                        <h4 class="text-base font-bold text-slate-800 mb-1">Tidak Ada Transaksi yang Ditemukan</h4>
                        <p class="text-xs text-slate-500 max-w-md mx-auto mb-4">
                            Tidak ditemukan transaksi dengan filter status <strong>"{{ $statusTabs[$statusFilter]['label'] ?? $statusFilter }}"</strong>
                            @if($managerFilter !== 'all')
                                pada cabang/manager terpilih.
                            @else
                                di sistem.
                            @endif
                        </p>
                        @if(!empty($search) || $managerFilter !== 'all' || $statusFilter !== 'all')
                            <a href="{{ route('superadmin.rentals') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-800 text-white font-bold text-xs rounded-xl hover:bg-slate-900 transition">
                                <span>↺ Reset Semua Filter</span>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
