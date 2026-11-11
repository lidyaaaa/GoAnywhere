@php
    use App\Http\Controllers\User\RentalController as RC;
    $isLate = $late['is_late'];
    $fmt = fn ($date) => $date->translatedFormat('d M Y, H:i');
    $buttonLabel = $isLate ? 'Selesaikan & Bayar Denda' : 'Konfirmasi Pengembalian';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kembalikan Kendaraan
        </h2>
    </x-slot>

    <div class="min-h-screen bg-slate-100 dark:bg-slate-900 py-10 sm:py-14" x-data="{ confirmOpen: false }">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl ring-1 ring-slate-200 dark:ring-slate-700 overflow-hidden">

                {{-- Header kendaraan --}}
                <div class="px-6 sm:px-8 pt-8 pb-6 border-b border-slate-100 dark:border-slate-700">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#43637E] dark:text-sky-300">Pengembalian Unit</p>
                    <h3 class="mt-1 text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">{{ $cart->vehicle->name }}</h3>
                    <p class="mt-1 flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $cart->vehicle->location }}
                    </p>
                </div>

                <div class="px-6 sm:px-8 py-6 space-y-6">

                    {{-- Rincian jadwal --}}
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 p-5 ring-1 ring-slate-100 dark:ring-slate-700">
                        @foreach ([
                            ['Tanggal Sewa', \Carbon\Carbon::parse($cart->rental_start_date)->translatedFormat('d M Y'), false],
                            ['Wajib Kembali', $fmt($late['due_at']), true],
                            ['Batas Toleransi (30 mnt)', $fmt($late['tolerance_at']), false],
                            ['Waktu Pengembalian', $fmt($late['returned_at']), true],
                        ] as [$label, $value, $highlight])
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ $label }}</dt>
                                <dd class="mt-1 text-sm font-semibold {{ $highlight ? 'text-[#43637E] dark:text-sky-300' : 'text-slate-800 dark:text-slate-100' }}">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    {{-- Status --}}
                    @if (! $isLate)
                        <div class="flex gap-4 rounded-xl border border-emerald-200 bg-emerald-50 dark:bg-emerald-900/20 dark:border-emerald-800 p-5">
                            <svg class="w-6 h-6 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <p class="font-bold text-emerald-800 dark:text-emerald-300">Tepat Waktu</p>
                                <p class="mt-1 text-sm text-emerald-700 dark:text-emerald-400">Tidak ada denda. Terima kasih telah mengembalikan kendaraan tepat waktu!</p>
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl border border-red-200 bg-red-50 dark:bg-red-900/20 dark:border-red-800 overflow-hidden">
                            <div class="flex items-center gap-3 px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-600 px-3 py-1 text-xs font-bold uppercase tracking-wide text-white">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                    Terlambat
                                </span>
                                <p class="text-sm text-red-800 dark:text-red-300">Pengembalian melewati batas toleransi.</p>
                            </div>

                            <dl class="divide-y divide-red-100 dark:divide-red-900/50 bg-white/70 dark:bg-slate-800/60 px-5 text-sm">
                                <div class="flex justify-between py-3">
                                    <dt class="text-slate-600 dark:text-slate-300">Durasi terlambat</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">{{ $late['duration_label'] }}</dd>
                                </div>
                                <div class="flex justify-between py-3">
                                    <dt class="text-slate-600 dark:text-slate-300">Tarif denda</dt>
                                    <dd class="text-right font-semibold text-slate-900 dark:text-white">
                                        {{ RC::rupiah($late['fine_per_hour']) }}/jam
                                        <span class="block text-xs font-normal text-slate-500">≈ {{ RC::rupiah($late['fine_per_day']) }}/hari</span>
                                    </dd>
                                </div>
                                <div class="flex justify-between py-3">
                                    <dt class="text-slate-600 dark:text-slate-300">Jam tertagih</dt>
                                    <dd class="font-semibold text-slate-900 dark:text-white">{{ number_format($late['billable_hours'], 0, ',', '.') }} jam</dd>
                                </div>
                                <div class="flex justify-between items-center py-4">
                                    <dt class="font-semibold text-slate-800 dark:text-slate-100">Total denda</dt>
                                    <dd class="text-xl sm:text-2xl font-bold text-red-600 dark:text-red-400">{{ RC::rupiah($late['fine_amount']) }}</dd>
                                </div>
                            </dl>

                            <p class="flex gap-2 px-5 py-3 text-xs text-red-700 dark:text-red-300 bg-red-100/60 dark:bg-red-900/30">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Denda keterlambatan akan ditagihkan saat serah terima unit / pelunasan. Sisa menit dibulatkan ke atas menjadi 1 jam.
                            </p>
                        </div>
                    @endif

                    {{-- Aksi --}}
                    <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                        <a href="{{ route('user.rental') }}" class="inline-flex justify-center items-center gap-2 px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-[#43637E]">
                            ← Kembali
                        </a>
                        <button type="button" @click="confirmOpen = true"
                            class="inline-flex justify-center items-center gap-2 rounded-xl px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition
                                   {{ $isLate ? 'bg-red-600 hover:bg-red-700 focus:ring-red-300' : 'bg-[#43637E] hover:bg-[#36546b] focus:ring-sky-300' }} focus:outline-none focus:ring-4">
                            {{ $buttonLabel }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal konfirmasi --}}
        <div x-show="confirmOpen" x-cloak x-transition.opacity
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4"
             @keydown.escape.window="confirmOpen = false">
            <div @click.outside="confirmOpen = false" class="w-full max-w-md rounded-2xl bg-white dark:bg-slate-800 p-6 shadow-2xl">
                <h4 class="text-lg font-bold text-slate-900 dark:text-white">Konfirmasi Pengembalian</h4>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Periksa rincian sebelum menyelesaikan sewa.</p>

                <dl class="mt-5 space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-slate-500">Kendaraan</dt><dd class="font-medium text-slate-900 dark:text-white">{{ $cart->vehicle->name }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Waktu kembali</dt><dd class="font-medium text-slate-900 dark:text-white">{{ $fmt($late['returned_at']) }}</dd></div>
                    @if ($isLate)
                        <div class="flex justify-between"><dt class="text-slate-500">Terlambat</dt><dd class="font-medium text-slate-900 dark:text-white">{{ $late['duration_label'] }}</dd></div>
                    @endif
                    <div class="flex justify-between border-t border-slate-200 dark:border-slate-700 pt-3 mt-3">
                        <dt class="font-semibold text-slate-800 dark:text-slate-100">Total denda</dt>
                        <dd class="font-bold {{ $isLate ? 'text-red-600' : 'text-emerald-600' }}">{{ RC::rupiah($late['fine_amount']) }}</dd>
                    </div>
                </dl>

                <form action="{{ route('user.rental.processReturn', $cart->id) }}" method="POST" class="mt-6 flex gap-3">
                    @csrf
                    <button type="button" @click="confirmOpen = false" class="flex-1 rounded-xl border border-slate-300 dark:border-slate-600 px-4 py-3 text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">Batal</button>
                    <button type="submit" class="flex-1 rounded-xl px-4 py-3 text-sm font-semibold text-white {{ $isLate ? 'bg-red-600 hover:bg-red-700' : 'bg-[#43637E] hover:bg-[#36546b]' }}">
                        {{ $isLate ? 'Ya, Lanjut Bayar' : 'Ya, Kembalikan' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>[x-cloak]{display:none!important}</style>
</x-app-layout>
