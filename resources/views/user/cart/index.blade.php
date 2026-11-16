<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <span>🛒</span> Keranjang Belanja ({{ count($carts) }} item)
            </h2>
            <span class="text-xs font-semibold px-3 py-1 bg-[#43637E]/10 text-[#43637E] dark:text-[#8baac4] rounded-full">
                📍 Lokasi Anda: {{ auth()->user()->location ?? '-' }}
            </span>
        </div>
    </x-slot>

    <style>
        .cart-section {
            padding: 36px 0 60px;
            background: #eef1f4;
            min-height: calc(100vh - 140px);
            width: 100%;
        }

        .dark .cart-section {
            background: #001F3F;
        }

        .alert-success {
            background: #e8f4ec;
            border: 1px solid #4a7a5a;
            color: #4a7a5a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            color: #b04a4a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-info {
            background: #e8f0f4;
            border: 1px solid #43637E;
            color: #43637E;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ===== CART ITEM CARD ===== */
        .cart-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 22px 24px;
            margin-bottom: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.05);
            border: 1.5px solid #e8e4de;
            transition: all 0.3s ease;
            position: relative;
        }

        .cart-card.selected {
            border-color: #004B87;
            background: #fafcff;
            box-shadow: 0 12px 35px rgba(0, 75, 135, 0.08);
        }

        .dark .cart-card {
            background: #0f172a;
            border-color: #1e293b;
        }

        .dark .cart-card.selected {
            border-color: #38bdf8;
            background: #0c192c;
        }

        .cart-item-row {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        /* Custom Checkbox Styling */
        .cart-select-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2px;
        }

        .cart-checkbox {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            border: 2px solid #94a3b8;
            cursor: pointer;
            accent-color: #004B87;
            transition: all 0.2s;
        }

        .cart-checkbox:disabled {
            cursor: not-allowed;
            opacity: 0.35;
        }

        /* Image Thumbnail */
        .cart-item-image {
            width: 110px;
            height: 85px;
            border-radius: 14px;
            background: #eef1f4;
            border: 1.5px solid #e2e8f0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-image .image-fallback {
            font-size: 36px;
        }

        /* Vehicle Info */
        .cart-item-info {
            flex: 1;
            min-width: 200px;
        }

        .cart-badge-type {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 3px 10px;
            border-radius: 20px;
            background: rgba(67, 99, 126, 0.1);
            color: #43637E;
            margin-bottom: 4px;
        }

        .dark .cart-badge-type {
            background: rgba(106, 155, 209, 0.15);
            color: #93c5fd;
        }

        .cart-item-info .item-name {
            font-size: 18px;
            font-weight: 700;
            color: #002D55;
            margin: 0;
            line-height: 1.3;
        }

        .dark .cart-item-info .item-name {
            color: #f8fafc;
        }

        .cart-item-info .item-meta {
            font-size: 13px;
            color: #64748B;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .dark .cart-item-info .item-meta {
            color: #94a3b8;
        }

        .cart-item-info .item-subtotal {
            font-size: 16px;
            font-weight: 700;
            color: #004B87;
            margin-top: 4px;
        }

        .dark .cart-item-info .item-subtotal {
            color: #38bdf8;
        }

        .cart-item-info .item-stock {
            font-size: 12px;
            font-weight: 600;
            margin-top: 4px;
        }

        .cart-item-info .item-stock.available {
            color: #16a34a;
        }

        .cart-item-info .item-stock.unavailable {
            color: #dc2626;
        }

        /* Controls */
        .cart-controls-box {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .dark .cart-controls-box {
            background: #1e293b;
            border-color: #334155;
        }

        .cart-ctrl-group {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .cart-ctrl-group label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748B;
        }

        .dark .cart-ctrl-group label {
            color: #94a3b8;
        }

        .cart-ctrl-group select,
        .cart-ctrl-group input {
            padding: 5px 8px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
            background: #ffffff;
        }

        .dark .cart-ctrl-group select,
        .dark .cart-ctrl-group input {
            background: #0f172a;
            border-color: #334155;
            color: #f8fafc;
        }

        .btn-cart-update {
            padding: 6px 12px;
            border-radius: 8px;
            background: #004B87;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 14px;
        }

        .btn-cart-update:hover {
            background: #002D55;
        }

        .btn-cart-delete {
            padding: 8px 12px;
            border-radius: 10px;
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-cart-delete:hover {
            background: #f87171;
            color: #ffffff;
        }

        /* ===== SUMMARY CARD ===== */
        .summary-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px 28px;
            margin-top: 24px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.05);
            border: 1.5px solid #e8e4de;
        }

        .dark .summary-card {
            background: #0f172a;
            border-color: #1e293b;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 700;
            color: #002D55;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1.5px solid #f1f5f9;
        }

        .dark .summary-title {
            color: #f8fafc;
            border-bottom-color: #1e293b;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #475569;
            padding: 8px 0;
        }

        .dark .summary-row {
            color: #94a3b8;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 800;
            color: #002D55;
            padding-top: 14px;
            margin-top: 8px;
            border-top: 2px dashed #e2e8f0;
        }

        .dark .summary-total {
            color: #38bdf8;
            border-top-color: #334155;
        }

        .btn-checkout {
            display: block;
            width: 100%;
            text-align: center;
            padding: 14px 20px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            background: #004B87;
            margin-top: 18px;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(0, 75, 135, 0.25);
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-checkout:hover:not(:disabled) {
            background: #002D55;
            transform: translateY(-2px);
        }

        .btn-checkout:disabled,
        .btn-checkout.disabled {
            background: #94a3b8;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
            opacity: 0.7;
        }

        .empty-cart-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 24px;
            text-align: center;
            border: 1.5px solid #e8e4de;
        }

        .dark .empty-cart-card {
            background: #0f172a;
            border-color: #1e293b;
        }

        .empty-icon {
            font-size: 54px;
            display: block;
            margin-bottom: 12px;
        }
    </style>

    <div class="cart-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">✕ {{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="alert-info">ℹ {{ session('info') }}</div>
            @endif

            {{-- Policy Hint Banner --}}
            <div class="mb-5 p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-sky-50 dark:from-slate-800 dark:to-slate-850 border border-blue-200 dark:border-blue-900/40 text-xs text-slate-700 dark:text-slate-300 flex items-start gap-3 shadow-sm">
                <span class="text-xl shrink-0">💡</span>
                <div>
                    <strong class="font-bold text-blue-950 dark:text-sky-300">Pilih Unit dengan Centang Checkbox:</strong>
                    <p class="mt-0.5 leading-relaxed">
                        Anda dapat menyimpan banyak kendaraan di keranjang. Namun sesuai aturan rental, saat Checkout Anda hanya dapat menyewa <strong>maksimal 1 Mobil</strong> dan <strong>1 Motor</strong> dalam satu kali transaksi, dengan lokasi yang cocok dengan domisili Anda.
                    </p>
                </div>
            </div>

            @if(count($carts) > 0)
                <form id="checkoutForm" action="{{ route('user.cart.checkout') }}" method="GET">
                    @foreach($carts as $index => $cart)
                        @php
                            $userLoc = auth()->user()->location;
                            $vehLoc = $cart->vehicle->location;
                            $locMatch = ($userLoc === $vehLoc);
                            $stockOk = $cart->is_stock_available;
                            $canSelect = $locMatch && $stockOk;
                        @endphp

                        <div class="cart-card" id="cart_card_{{ $cart->id }}">
                            <div class="cart-item-row">

                                <!-- Checkbox Selector -->
                                <div class="cart-select-wrap">
                                    <input type="checkbox" 
                                           name="selected_carts[]" 
                                           value="{{ $cart->id }}" 
                                           id="cb_{{ $cart->id }}"
                                           class="cart-checkbox"
                                           data-id="{{ $cart->id }}"
                                           data-type="{{ $cart->vehicle->vehicle_type }}"
                                           data-subtotal="{{ $cart->subtotal }}"
                                           data-available="{{ $canSelect ? '1' : '0' }}"
                                           {{ $canSelect && $index === 0 ? 'checked' : '' }}
                                           {{ !$canSelect ? 'disabled' : '' }}
                                           onchange="handleCartCheckboxChange(this)">
                                </div>

                                <!-- Image Thumbnail -->
                                <div class="cart-item-image">
                                    @if($cart->vehicle->image)
                                        <img src="{{ asset('storage/' . $cart->vehicle->image) }}" alt="{{ $cart->vehicle->name }}">
                                    @else
                                        <span class="image-fallback">{{ $cart->vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                                    @endif
                                </div>

                                <!-- Vehicle Details -->
                                <div class="cart-item-info">
                                    <div class="flex items-center gap-2">
                                        <span class="cart-badge-type">
                                            {{ $cart->vehicle->vehicle_type == 'car' ? '🚗 Mobil' : '🏍️ Sepeda Motor' }}
                                        </span>
                                        @if(!$locMatch)
                                            <span class="text-[11px] font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded-full">
                                                ⚠️ Beda Kota
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="item-name">{{ $cart->vehicle->name }}</h3>
                                    
                                    <div class="item-meta">
                                        <span>📍 Gerai {{ $cart->vehicle->location }}</span>
                                        <span>&bull;</span>
                                        <span>Rp {{ number_format($cart->vehicle->price_per_day, 0, ',', '.') }}/hari</span>
                                        @if($cart->vehicle->price_per_week > 0)
                                            <span class="text-xs text-emerald-600 font-semibold">(Paket 7 Hari: Rp {{ number_format($cart->vehicle->price_per_week, 0, ',', '.') }})</span>
                                        @endif
                                    </div>

                                    <div class="item-stock {{ $stockOk ? 'available' : 'unavailable' }}">
                                        @if($stockOk)
                                            ✓ Stok tersedia ({{ $cart->available_stock }} unit)
                                        @else
                                            ⚠ STOK HABIS / TIDAK TERSEDIA!
                                        @endif
                                    </div>

                                    @if(!$locMatch)
                                        <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">
                                            * Kendaraan berada di {{ $vehLoc }}. Ubah lokasi domisili Anda di Profil jika ingin menyewa unit ini.
                                        </p>
                                    @endif
                                </div>

                                <!-- Action: Hapus Saja (Durasi diatur saat Checkout) -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <button type="submit" form="delete_form_{{ $cart->id }}" class="btn-cart-delete" title="Hapus dari keranjang">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach

                    <!-- SUMMARY CARD -->
                    <div class="summary-card">
                        <h3 class="summary-title flex items-center justify-between">
                            <span>📋 Ringkasan Pilihan</span>
                            <span id="selectedCountBadge" class="text-xs font-bold px-3 py-1 bg-[#004B87]/10 text-[#004B87] dark:text-sky-300 rounded-full">
                                0 Unit Dipilih
                            </span>
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 leading-relaxed">
                            Pilih kendaraan yang ingin Anda sewa. Pengaturan durasi hari sewa, pemilihan paket harian/mingguan, dan metode pembayaran akan dilakukan di <strong>Halaman Checkout</strong>.
                        </p>

                        <div id="selectionWarning" class="hidden mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-medium"></div>

                        <button type="submit" id="checkoutBtn" class="btn-checkout">
                            Lanjut ke Checkout →
                        </button>
                    </div>
                </form>

                {{-- Hidden forms for deletes --}}
                @foreach($carts as $cart)
                    <form id="delete_form_{{ $cart->id }}" action="{{ route('user.cart.remove', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

            @else
                <div class="empty-cart-card">
                    <span class="empty-icon">🛒</span>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-1">Keranjang Belanja Kosong</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-5">Anda belum menambahkan kendaraan apapun ke dalam keranjang.</p>
                    <a href="{{ route('user.armada') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#004B87] hover:bg-[#002D55] text-white rounded-xl text-sm font-bold shadow-md transition">
                        ← Jelajahi Armada
                    </a>
                </div>
            @endif

        </div>
    </div>

    <script>
    function handleCartCheckboxChange(currentCheckbox) {
        const checkboxes = document.querySelectorAll('.cart-checkbox:checked');
        let carCount = 0;
        let motorCount = 0;

        checkboxes.forEach(cb => {
            const type = cb.dataset.type;
            if (type === 'car') carCount++;
            if (type === 'motorcycle') motorCount++;
        });

        // Enforce max 1 car & max 1 motorcycle
        if (currentCheckbox.checked) {
            const currentType = currentCheckbox.dataset.type;
            if (currentType === 'car' && carCount > 1) {
                currentCheckbox.checked = false;
                alert('Kebijakan Rental: Anda hanya dapat memilih maksimal 1 Mobil dalam satu transaksi. Batalkan centang mobil sebelumnya jika ingin mengganti.');
            } else if (currentType === 'motorcycle' && motorCount > 1) {
                currentCheckbox.checked = false;
                alert('Kebijakan Rental: Anda hanya dapat memilih maksimal 1 Sepeda Motor dalam satu transaksi. Batalkan centang motor sebelumnya jika ingin mengganti.');
            }
        }

        recalculateCartSummary();
    }

    function recalculateCartSummary() {
        const checkboxes = document.querySelectorAll('.cart-checkbox:checked');
        let selectedCount = 0;

        // Reset visual card selection
        document.querySelectorAll('.cart-card').forEach(card => card.classList.remove('selected'));

        checkboxes.forEach(cb => {
            selectedCount++;
            const card = document.getElementById('cart_card_' + cb.dataset.id);
            if (card) card.classList.add('selected');
        });

        // Update DOM
        document.getElementById('selectedCountBadge').textContent = selectedCount + ' Unit Dipilih';

        const checkoutBtn = document.getElementById('checkoutBtn');
        const warning = document.getElementById('selectionWarning');

        if (selectedCount === 0) {
            checkoutBtn.disabled = true;
            checkoutBtn.classList.add('disabled');
            checkoutBtn.textContent = 'Pilih Minimal 1 Kendaraan';
            warning.classList.remove('hidden');
            warning.textContent = 'Silakan beri tanda centang pada kendaraan di atas yang ingin Anda sewa.';
        } else {
            checkoutBtn.disabled = false;
            checkoutBtn.classList.remove('disabled');
            checkoutBtn.textContent = 'Lanjut ke Checkout (' + selectedCount + ' Unit) →';
            warning.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        recalculateCartSummary();
    });
    </script>
</x-app-layout>
