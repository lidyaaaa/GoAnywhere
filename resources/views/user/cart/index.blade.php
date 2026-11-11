<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Keranjang Belanja ({{ count($carts) }} item)
        </h2>
    </x-slot>

    <style>
        .cart-section {
            padding: 36px 0 60px;
            background: #eef1f4;
            min-height: calc(100vh - 140px);
            width: 100%;
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
            border-radius: 18px;
            padding: 22px 24px;
            margin-bottom: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08), 0 2px 10px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8e4de;
            transition: all 0.3s ease;
        }

        .cart-card:hover {
            box-shadow: 0 16px 45px rgba(67, 99, 126, 0.16);
            border-color: #43637E;
        }

        .cart-item-row {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
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
            min-width: 220px;
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

        .cart-item-info .item-name {
            font-size: 19px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin: 0;
            line-height: 1.3;
        }

        .cart-item-info .item-meta {
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .cart-item-info .item-subtotal {
            font-size: 17px;
            font-weight: 700;
            color: #43637E;
            margin-top: 6px;
            font-family: 'Georgia', serif;
        }

        .cart-item-info .item-stock {
            font-size: 12px;
            font-weight: 600;
            margin-top: 4px;
        }

        .cart-item-info .item-stock.available {
            color: #2b7a4b;
        }

        .cart-item-info .item-stock.unavailable {
            color: #b04a4a;
        }

        /* Controls Form */
        .cart-controls-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #faf8f5;
            padding: 10px 16px;
            border-radius: 14px;
            border: 1px solid #e8e4de;
            flex-wrap: wrap;
        }

        .cart-ctrl-group {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .cart-ctrl-group label {
            font-size: 10px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cart-ctrl-group select,
        .cart-ctrl-group input {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            font-size: 13px;
            background: #ffffff;
            color: #2c3e50;
            outline: none;
            transition: all 0.2s;
        }

        .cart-ctrl-group select:focus,
        .cart-ctrl-group input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 3px rgba(67, 99, 126, 0.12);
        }

        .cart-ctrl-group input[type="number"] {
            width: 64px;
            text-align: center;
        }

        .btn-cart-update {
            background: #43637E;
            color: #ffffff;
            padding: 7px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 12px;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.2s;
            height: 33px;
            box-shadow: 0 3px 10px rgba(67, 99, 126, 0.2);
        }

        .btn-cart-update:hover {
            background: #36546b;
            transform: translateY(-1px);
        }

        /* Remove Action */
        .btn-cart-delete {
            background: #fff;
            color: #b04a4a;
            border: 1.5px solid #f2c2c2;
            padding: 7px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            height: 33px;
        }

        .btn-cart-delete:hover {
            background: #b04a4a;
            color: #ffffff;
            border-color: #b04a4a;
            transform: translateY(-1px);
        }

        /* ===== SUMMARY CARD ===== */
        .summary-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 24px 28px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            margin-top: 24px;
        }

        .summary-card .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 9px 0;
            font-size: 14px;
            color: #64748b;
            border-bottom: 1px solid #f1f5f9;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0 6px;
            font-size: 22px;
            font-weight: 700;
            color: #43637E;
            font-family: 'Georgia', serif;
            border-top: 2px solid #e2e8f0;
            margin-top: 8px;
        }

        .btn-checkout {
            display: block;
            width: 100%;
            margin-top: 18px;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
        }

        .btn-checkout.active {
            background: #43637E;
            color: #ffffff;
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.35);
        }

        .btn-checkout.active:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(67, 99, 126, 0.45);
        }

        .btn-checkout.disabled {
            background: #cbd5e1;
            color: #64748b;
            cursor: not-allowed;
        }

        .stock-warning {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            color: #b04a4a;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
            margin-top: 14px;
            font-size: 13px;
        }

        /* ===== EMPTY STATE ===== */
        .empty-cart-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 24px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            display: block;
        }

        .empty-cart-card h3 {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .empty-cart-card p {
            color: #7a8a9a;
            font-size: 14px;
            margin-top: 6px;
        }

        .btn-browse {
            display: inline-block;
            margin-top: 20px;
            background: #43637E;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 6px 20px rgba(67, 99, 126, 0.25);
        }

        .btn-browse:hover {
            background: #36546b;
            transform: translateY(-2px);
        }

        /* ===== DARK MODE ===== */
        .dark .cart-section { background: #111a22; }
        .dark .cart-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 10px 35px rgba(0,0,0,0.4); }
        .dark .cart-card:hover { border-color: #43637E; }
        .dark .cart-item-image { background: #0f1a24; border-color: #2c3e50; }
        .dark .cart-badge-type { background: rgba(67, 99, 126, 0.3); color: #8baac4; }
        .dark .cart-item-info .item-name { color: #f0ede8; }
        .dark .cart-item-info .item-meta { color: #8fa1b3; }
        .dark .cart-item-info .item-subtotal { color: #8baac4; }
        .dark .cart-controls-box { background: #0f1a24; border-color: #2c3e50; }
        .dark .cart-ctrl-group label { color: #8baac4; }
        .dark .cart-ctrl-group select,
        .dark .cart-ctrl-group input { background: #1a2632; border-color: #2c3e50; color: #f0ede8; }
        .dark .cart-ctrl-group select:focus,
        .dark .cart-ctrl-group input:focus { border-color: #43637E; }
        .dark .btn-cart-delete { background: #1a2632; border-color: #8a3a3a; color: #e57373; }
        .dark .summary-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 10px 35px rgba(0,0,0,0.4); }
        .dark .summary-card .summary-title { color: #f0ede8; }
        .dark .summary-row { color: #8fa1b3; border-bottom-color: #2c3e50; }
        .dark .summary-total { border-top-color: #2c3e50; color: #8baac4; }
        .dark .empty-cart-card { background: #1a2632; border-color: #2c3e50; }
        .dark .empty-cart-card h3 { color: #f0ede8; }
        .dark .empty-cart-card p { color: #8fa1b3; }

        @media (max-width: 860px) {
            .cart-item-row {
                flex-direction: column;
                align-items: stretch;
            }
            .cart-item-image {
                width: 100%;
                height: 140px;
            }
            .cart-controls-box {
                justify-content: space-between;
            }
            .btn-cart-update,
            .btn-cart-delete {
                margin-top: 8px;
            }
        }
    </style>

    <div class="cart-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">✕ {{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="alert-info">ℹ {{ session('info') }}</div>
            @endif

            @if(count($carts) > 0)
                @foreach($carts as $cart)
                    <div class="cart-card">
                        <div class="cart-item-row">

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
                                <span class="cart-badge-type">
                                    {{ $cart->vehicle->vehicle_type == 'car' ? '🚗 Mobil' : '🏍️ Sepeda Motor' }}
                                </span>
                                <h3 class="item-name">{{ $cart->vehicle->name }}</h3>
                                <div class="item-meta">
                                    <span>📍 {{ $cart->vehicle->location }}</span>
                                    <span>&bull;</span>
                                    <span>Rp {{ number_format($cart->vehicle->price_per_day, 0, ',', '.') }} / hari</span>
                                </div>
                                <div class="item-subtotal">
                                    Subtotal: Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                </div>
                                <div class="item-stock {{ $cart->is_stock_available ? 'available' : 'unavailable' }}">
                                    @if($cart->is_stock_available)
                                        ✓ Stok tersedia ({{ $cart->available_stock }} unit)
                                    @else
                                        ⚠ STOK TIDAK TERSEDIA! (Tersisa {{ $cart->available_stock }} unit)
                                    @endif
                                </div>
                            </div>

                            <!-- Controls: Update & Delete -->
                            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                <form action="{{ route('user.cart.update', $cart->id) }}" method="POST" class="cart-controls-box">
                                    @csrf
                                    @method('PUT')

                                    <div class="cart-ctrl-group">
                                        <label>Periode</label>
                                        <select name="period" onchange="toggleDays(this)">
                                            <option value="daily" {{ $cart->period == 'daily' ? 'selected' : '' }}>Per Hari</option>
                                            <option value="weekly" {{ $cart->period == 'weekly' ? 'selected' : '' }}>Per Minggu</option>
                                        </select>
                                    </div>

                                    <div class="cart-ctrl-group">
                                        <label>Hari</label>
                                        <input type="number" name="quantity_days" id="quantity_days_{{ $cart->id }}" value="{{ $cart->quantity_days ?? 1 }}" min="1" max="7">
                                    </div>

                                    <div class="cart-ctrl-group">
                                        <label>Unit</label>
                                        <input type="number" name="quantity_vehicle" value="{{ $cart->quantity_vehicle ?? 1 }}" min="1" max="{{ $cart->available_stock ?? 10 }}">
                                    </div>

                                    <button type="submit" class="btn-cart-update">Update</button>
                                </form>

                                <!-- Hapus Button Form -->
                                <form action="{{ route('user.cart.remove', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-cart-delete" title="Hapus dari keranjang">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach

                <!-- SUMMARY CARD -->
                <div class="summary-card">
                    <h3 class="summary-title">Ringkasan</h3>

                    <div class="summary-row">
                        <span>Total Item:</span>
                        <span class="font-semibold">{{ count($carts) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Unit:</span>
                        <span class="font-semibold">{{ $carts->sum('quantity_vehicle') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Hari:</span>
                        <span class="font-semibold">{{ $carts->sum('quantity_days') }}</span>
                    </div>

                    <div class="summary-total">
                        <span>Total Sewa:</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    @php
                        $hasStockIssue = $carts->contains(function($item) {
                            return !$item->is_stock_available;
                        });
                    @endphp

                    @if($hasStockIssue)
                        <div class="stock-warning">
                            ⚠ Ada item dengan stok tidak tersedia! Silahkan hapus atau kurangi item tersebut sebelum melanjutkan.
                        </div>
                        <button disabled class="btn-checkout disabled">
                            Lanjut ke Pembayaran (Stok Tidak Cukup)
                        </button>
                    @else
                        <a href="{{ route('user.cart.checkout') }}" class="btn-checkout active">
                            Lanjut ke Pembayaran
                        </a>
                    @endif
                </div>

            @else
                <div class="empty-cart-card">
                    <span class="empty-icon">🛒</span>
                    <h3>Keranjang Belanja Kosong</h3>
                    <p>Anda belum menambahkan kendaraan apapun ke dalam keranjang.</p>
                    <a href="{{ route('user.armada') }}" class="btn-browse">
                        ← Jelajahi Armada
                    </a>
                </div>
            @endif

        </div>
    </div>

    <script>
    function toggleDays(select) {
        var form = select.closest('form');
        var daysInput = form.querySelector('input[name="quantity_days"]');
        
        if (select.value === 'weekly') {
            daysInput.value = 1;
            daysInput.max = 1;
            daysInput.readOnly = true;
            daysInput.style.background = '#f0ede8';
            daysInput.style.cursor = 'not-allowed';
            daysInput.style.opacity = '0.7';
        } else {
            daysInput.max = 7;
            daysInput.readOnly = false;
            daysInput.style.background = '';
            daysInput.style.cursor = '';
            daysInput.style.opacity = '1';
            if (parseInt(daysInput.value) < 1 || isNaN(parseInt(daysInput.value))) {
                daysInput.value = 1;
            }
        }
    }

    // Inisialisasi saat load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('select[name="period"]').forEach(function(select) {
            toggleDays(select);
        });
    });
    </script>
</x-app-layout>
