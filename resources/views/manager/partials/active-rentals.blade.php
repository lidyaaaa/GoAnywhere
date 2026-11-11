{{-- Tabel Sewa Aktif + kolom Aksi (Manager). CSS mandiri (tidak bergantung build Tailwind). Butuh Alpine.js. --}}
@php use App\Services\LateFeeCalculator as Fee; @endphp

@foreach (['success' => 'ar-alert--ok', 'error' => 'ar-alert--err'] as $key => $cls)
    @if (session($key))
        <div class="ar-alert {{ $cls }}">{{ session($key) }}</div>
    @endif
@endforeach
@if ($errors->any())
    <div class="ar-alert ar-alert--err">{{ $errors->first() }}</div>
@endif

<div class="section-card">
    <div class="ar-head">
        <h3 class="section-title" style="margin:0">Sewa Aktif</h3>
        <span class="ar-muted">{{ $rentals->count() }} unit sedang disewa</span>
    </div>

    @if ($rentals->isEmpty())
        <div class="empty-state"><p>Tidak ada sewa aktif</p></div>
    @else
        <div class="ar-wrap">
            <table class="ar-table">
                <thead>
                    <tr>
                        <th>Kendaraan</th>
                        <th>Penyewa</th>
                        <th>Mulai</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th class="ar-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentals as $rental)
                        @php
                            $late = $rental->late;
                            $dueAt = $late['due_at'];
                            $hoursLeft = (int) now()->diffInHours($dueAt, false);
                            $isDueToday = $dueAt->isToday();
                            $isDueTomorrow = $dueAt->isTomorrow();
                            $daysLeft = (int) now()->diffInDays($dueAt, false);

                            [$tone, $label] = match (true) {
                                $late['late_days'] > 7  => ['severe', 'Telat ' . $late['late_days'] . ' hari'],
                                $late['late_days'] >= 3 => ['orange', 'Telat ' . $late['late_days'] . ' hari'],
                                $late['is_late']        => ['yellow', 'Telat ' . $late['duration_label']],
                                $isDueToday             => ['blue', 'Jatuh tempo hari ini'],
                                $isDueTomorrow          => ['green', 'Jatuh tempo besok'],
                                $daysLeft > 1           => ['green', 'Sisa ' . $daysLeft . ' hari'],
                                default                 => ['green', 'Sisa ' . max(1, $hoursLeft) . ' jam'],
                            };
                        @endphp
                        <tr class="{{ $tone === 'severe' ? 'ar-row--severe' : '' }}"
                            x-data="{ menu: false, top: 0, left: 0, returnOpen: false, flagOpen: false, extra: 0 }">
                            <td>
                                <div class="ar-strong">{{ $rental->vehicle->name ?? 'N/A' }}</div>
                                <div class="ar-code">{{ $rental->booking_code }}</div>
                            </td>
                            <td>
                                <div class="ar-strong">{{ $rental->user->name ?? 'N/A' }}</div>
                                <div class="ar-muted">{{ $rental->user->phone ?? 'No. HP belum diisi' }}</div>
                            </td>
                            <td class="ar-nowrap">{{ \Carbon\Carbon::parse($rental->rental_start_date)->translatedFormat('d M Y') }}</td>
                            <td class="ar-nowrap">{{ $late['due_at']->translatedFormat('d M Y, H:i') }}</td>
                            <td>
                                <span class="ar-badge ar-badge--{{ $tone }}" title="{{ $late['is_late'] ? 'Terlambat ' . $late['duration_label'] : '' }}">
                                    @if ($late['is_late'])
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                    @endif
                                    {{ $label }}
                                </span>
                                @if ($late['is_late'])
                                    <div class="ar-fine">{{ Fee::rupiah($late['fine_amount']) }}</div>
                                @endif
                            </td>

                            <td class="ar-right">
                                <div style="display:inline-flex; align-items:center; gap:8px;">
                                    <a href="{{ route('manager.chat.start', ['user_id' => $rental->user_id, 'vehicle_id' => $rental->vehicle_id]) }}" 
                                       class="ar-btn-chat" title="Chat dengan {{ $rental->user->name ?? 'Penyewa' }}">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <span>Chat</span>
                                    </a>
                                    <button type="button" class="ar-kebab" aria-label="Aksi"
                                        @click="const r = $el.getBoundingClientRect(); top = r.bottom + 6; left = r.right - 230; menu = !menu">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><circle cx="10" cy="4" r="1.8"/><circle cx="10" cy="10" r="1.8"/><circle cx="10" cy="16" r="1.8"/></svg>
                                </button>

                                {{-- Dropdown --}}
                                <template x-teleport="body">
                                    <div x-show="menu" x-cloak x-transition @click.outside="menu = false" @keydown.escape.window="menu = false" @scroll.window="menu = false"
                                         :style="`top:${top}px; left:${left}px`" class="ar-menu">
                                        <button type="button" class="ar-menu__item" @click="menu = false; returnOpen = true">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
                                            Proses Pengembalian
                                        </button>
                                        @if ($rental->whatsapp_url)
                                            <a href="{{ $rental->whatsapp_url }}" target="_blank" rel="noopener" class="ar-menu__item" @click="menu = false">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="#16a34a"><path d="M12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2zm5.3 14.2c-.2.6-1.3 1.2-1.8 1.2-.5.1-1 .2-3.3-.7-2.8-1.1-4.6-4-4.7-4.2-.1-.2-1.1-1.5-1.1-2.9s.7-2 1-2.3c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.4 0 .5l-.3.5-.4.4c-.1.1-.3.3-.1.6.2.3.7 1.2 1.6 1.9 1.1 1 2 1.3 2.3 1.4.3.1.4.1.6-.1l.8-1c.2-.3.4-.2.6-.1l1.9.9c.3.1.5.2.5.3.1.2.1.7-.1 1.4z"/></svg>
                                                Hubungi Penyewa
                                            </a>
                                        @else
                                            <span class="ar-menu__item ar-menu__item--disabled" title="Penyewa belum mengisi nomor HP">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2z"/></svg>
                                                Hubungi Penyewa (no. HP kosong)
                                            </span>
                                        @endif
                                        <div class="ar-menu__sep"></div>
                                        <button type="button" class="ar-menu__item ar-menu__item--danger" @click="menu = false; flagOpen = true">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 21V4h11l1 2h4v9h-6l-1-2H4"/></svg>
                                            Tandai Bermasalah / Hilang
                                        </button>
                                    </div>
                                </template>

                                {{-- Modal: Proses Pengembalian --}}
                                <template x-teleport="body">
                                    <div x-show="returnOpen" x-cloak x-transition.opacity class="ar-overlay" @keydown.escape.window="returnOpen = false">
                                        <form method="POST" action="{{ route('manager.rentals.complete', $rental->id) }}" class="ar-modal" @click.outside="returnOpen = false">
                                            @csrf
                                            <div class="ar-modal__head">
                                                <h4>Proses Pengembalian</h4>
                                                <p>{{ $rental->vehicle->name }} · {{ $rental->user->name }} · <span class="ar-code">{{ $rental->booking_code }}</span></p>
                                            </div>
                                            <div class="ar-modal__body">
                                                <dl class="ar-dl">
                                                    <div><dt>Jatuh tempo</dt><dd>{{ $late['due_at']->translatedFormat('d M Y, H:i') }}</dd></div>
                                                    <div><dt>Keterlambatan</dt><dd class="{{ $late['is_late'] ? 'ar-red' : 'ar-green' }}">{{ $late['is_late'] ? $late['duration_label'] : 'Tepat waktu' }}</dd></div>
                                                    <div><dt>Denda keterlambatan <small>({{ Fee::rupiah($late['fine_per_hour']) }}/jam)</small></dt><dd>{{ Fee::rupiah($late['fine_amount']) }}</dd></div>
                                                </dl>

                                                <div class="ar-fields">
                                                    <label>
                                                        <span>Biaya tambahan (Rp)</span>
                                                        <input type="number" name="extra_charge" min="0" step="1000" x-model.number="extra" placeholder="0">
                                                    </label>
                                                    <label>
                                                        <span>Keterangan</span>
                                                        <input type="text" name="extra_charge_note" maxlength="255" :required="extra > 0" placeholder="Lecet bumper, bensin kurang, dll.">
                                                    </label>
                                                </div>

                                                <div class="ar-total">
                                                    <span>Total tagihan akhir</span>
                                                    <strong x-text="'Rp ' + ({{ $late['fine_amount'] }} + (Number(extra) || 0)).toLocaleString('id-ID')">{{ Fee::rupiah($late['fine_amount']) }}</strong>
                                                </div>
                                                <p class="ar-note">Status sewa menjadi <b>Selesai</b> dan stok unit kembali <b>tersedia</b>. Denda dihitung final saat konfirmasi.</p>
                                            </div>
                                            <div class="ar-modal__foot">
                                                <button type="button" class="ar-btn ar-btn--ghost" @click="returnOpen = false">Batal</button>
                                                <button type="submit" class="ar-btn ar-btn--primary">Konfirmasi Selesai</button>
                                            </div>
                                        </form>
                                    </div>
                                </template>

                                {{-- Modal: Tandai Bermasalah / Hilang --}}
                                <template x-teleport="body">
                                    <div x-show="flagOpen" x-cloak x-transition.opacity class="ar-overlay" @keydown.escape.window="flagOpen = false">
                                        <form method="POST" action="{{ route('manager.rentals.flag', $rental->id) }}" class="ar-modal ar-modal--sm" @click.outside="flagOpen = false">
                                            @csrf
                                            <div class="ar-modal__head ar-modal__head--danger">
                                                <span class="ar-icon-circle">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                                </span>
                                                <div>
                                                    <h4>Tandai Bermasalah / Hilang</h4>
                                                    <p>Akun <b>{{ $rental->user->name }}</b> akan langsung di-suspend dan ter-logout.</p>
                                                </div>
                                            </div>
                                            <div class="ar-modal__body">
                                                <div class="ar-radios">
                                                    <label><input type="radio" name="status" value="dispute" checked> Dispute</label>
                                                    <label><input type="radio" name="status" value="lost"> Hilang / Digelapkan</label>
                                                </div>
                                                <label class="ar-fields__full">
                                                    <span>Kronologi / catatan (wajib)</span>
                                                    <textarea name="note" rows="3" required maxlength="1000"></textarea>
                                                </label>
                                            </div>
                                            <div class="ar-modal__foot">
                                                <button type="button" class="ar-btn ar-btn--ghost" @click="flagOpen = false">Batal</button>
                                                <button type="submit" class="ar-btn ar-btn--danger">Tandai & Suspend</button>
                                            </div>
                                        </form>
                                    </div>
                                </template>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@once
<style>
    [x-cloak] { display: none !important; }
    .ar-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
    .ar-muted { font-size:12px; color:#7a8a9a; }
    .ar-alert { margin-bottom:16px; padding:12px 16px; border-radius:12px; font-size:14px; font-weight:500; }
    .ar-alert--ok { background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; }
    .ar-alert--err { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }

    .ar-wrap { overflow-x:auto; border:1px solid #e2e8f0; border-radius:14px; }
    .ar-table { width:100%; border-collapse:collapse; font-size:14px; }
    .ar-table thead { background:#f5f7f9; }
    .ar-table th { padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#43637E; text-transform:uppercase; letter-spacing:.5px; white-space:nowrap; }
    .ar-table td { padding:14px 16px; color:#5a6a7a; border-top:1px solid #eef1f4; vertical-align:middle; }
    .ar-table tbody tr:hover { background:#f8fafc; }
    .ar-row--severe { background:#fff5f5; box-shadow: inset 3px 0 0 #dc2626; }
    .ar-right { text-align:right !important; }
    .ar-nowrap { white-space:nowrap; }
    .ar-strong { font-weight:600; color:#1e293b; }
    .ar-code { font-family:ui-monospace,monospace; font-size:11px; color:#7a8a9a; letter-spacing:.3px; }
    .ar-fine { margin-top:4px; font-size:12px; font-weight:700; color:#dc2626; }

    .ar-badge { display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:999px; font-size:12px; font-weight:600; line-height:1.3; white-space:nowrap; }
    .ar-badge svg { flex-shrink:0; }
    .ar-badge--green  { background:#e8f4ec; color:#2f6b45; }
    .ar-badge--blue   { background:#e0f2fe; color:#075985; }
    .ar-badge--yellow { background:#fef9c3; color:#854d0e; border:1px solid #fde047; }
    .ar-badge--orange { background:#ffedd5; color:#9a3412; border:1px solid #fdba74; font-weight:700; }
    .ar-badge--severe { background:#dc2626; color:#fff; font-weight:800; box-shadow:0 0 0 3px rgba(220,38,38,.18); }

    .ar-btn-chat { display:inline-flex; align-items:center; gap:6px; padding:7px 12px; background:#43637E; color:#ffffff !important; border-radius:9px; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s ease; border:1px solid #43637E; }
    .ar-btn-chat:hover { background:#334d63; border-color:#334d63; color:#ffffff !important; box-shadow:0 2px 8px rgba(67,99,126,0.3); }
    .ar-kebab { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border:0; border-radius:10px; background:transparent; color:#64748b; cursor:pointer; }
    .ar-kebab:hover { background:#eef1f4; color:#1e293b; }

    .ar-menu { position:fixed; z-index:60; width:230px; padding:6px; background:#fff; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 12px 32px rgba(15,23,42,.16); }
    .ar-menu__item { display:flex; align-items:center; gap:10px; width:100%; padding:9px 12px; border:0; border-radius:8px; background:none; font-size:14px; color:#334155; text-align:left; text-decoration:none; cursor:pointer; }
    .ar-menu__item:hover { background:#f1f5f9; }
    .ar-menu__item--danger { color:#dc2626; font-weight:600; }
    .ar-menu__item--danger:hover { background:#fef2f2; }
    .ar-menu__item--disabled { color:#94a3b8; cursor:not-allowed; font-size:13px; }
    .ar-menu__item--disabled:hover { background:none; }
    .ar-menu__sep { height:1px; margin:6px 4px; background:#eef1f4; }

    .ar-overlay { position:fixed; inset:0; z-index:70; display:flex; align-items:center; justify-content:center; padding:16px; background:rgba(15,23,42,.55); }
    .ar-modal { width:100%; max-width:520px; background:#fff; border-radius:18px; box-shadow:0 24px 60px rgba(0,0,0,.3); text-align:left; overflow:hidden; }
    .ar-modal--sm { max-width:440px; }
    .ar-modal__head { padding:22px 24px 16px; border-bottom:1px solid #eef1f4; }
    .ar-modal__head h4 { margin:0; font-size:18px; font-weight:700; color:#0f172a; }
    .ar-modal__head p { margin:4px 0 0; font-size:13px; color:#64748b; }
    .ar-modal__head--danger { display:flex; gap:12px; align-items:flex-start; }
    .ar-icon-circle { display:flex; align-items:center; justify-content:center; flex-shrink:0; width:40px; height:40px; border-radius:50%; background:#fee2e2; color:#dc2626; }
    .ar-modal__body { padding:18px 24px; display:flex; flex-direction:column; gap:16px; font-size:14px; }
    .ar-modal__foot { display:flex; gap:10px; padding:0 24px 22px; }

    .ar-dl { margin:0; display:flex; flex-direction:column; gap:8px; }
    .ar-dl div { display:flex; justify-content:space-between; gap:12px; }
    .ar-dl dt { color:#64748b; } .ar-dl dt small { font-size:11px; }
    .ar-dl dd { margin:0; font-weight:600; color:#0f172a; text-align:right; }
    .ar-red { color:#dc2626 !important; } .ar-green { color:#059669 !important; }

    .ar-fields { display:grid; grid-template-columns:2fr 3fr; gap:12px; padding:14px; background:#f8fafc; border-radius:12px; }
    .ar-fields label, .ar-fields__full { display:flex; flex-direction:column; gap:4px; }
    .ar-fields span, .ar-fields__full span { font-size:12px; font-weight:600; color:#475569; }
    .ar-modal input[type=number], .ar-modal input[type=text], .ar-modal textarea { width:100%; padding:9px 12px; border:1px solid #cbd5e1; border-radius:9px; font-size:14px; background:#fff; }
    .ar-modal input:focus, .ar-modal textarea:focus { outline:none; border-color:#43637E; box-shadow:0 0 0 3px rgba(67,99,126,.18); }

    .ar-total { display:flex; justify-content:space-between; align-items:center; padding:12px 16px; border-radius:12px; background:rgba(67,99,126,.1); }
    .ar-total span { font-weight:600; color:#1e293b; }
    .ar-total strong { font-size:20px; color:#43637E; }
    .ar-note { margin:0; font-size:12px; color:#64748b; }

    .ar-radios { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
    .ar-radios label { display:flex; align-items:center; gap:8px; padding:10px 12px; border:1px solid #cbd5e1; border-radius:10px; cursor:pointer; font-weight:500; }
    .ar-radios label:has(input:checked) { border-color:#dc2626; background:#fef2f2; color:#991b1b; }

    .ar-btn { flex:1; padding:11px 16px; border-radius:11px; font-size:14px; font-weight:600; cursor:pointer; border:1px solid transparent; }
    .ar-btn--ghost { background:#fff; border-color:#cbd5e1; color:#334155; } .ar-btn--ghost:hover { background:#f8fafc; }
    .ar-btn--primary { background:#43637E; color:#fff; } .ar-btn--primary:hover { background:#36546b; }
    .ar-btn--danger { background:#dc2626; color:#fff; } .ar-btn--danger:hover { background:#b91c1c; }

    @media (max-width: 640px) { .ar-fields { grid-template-columns:1fr; } }
</style>
@endonce
