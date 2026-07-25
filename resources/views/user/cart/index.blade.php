<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🛒 Keranjang Belanja ({{ count($carts) }} item)
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cart-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .cart-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
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

        .cart-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .cart-card:hover {
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .cart-card .cart-content {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }

        .cart-card .cart-content .vehicle-info {
            flex: 1;
            min-width: 200px;
        }

        .cart-card .cart-content .vehicle-info .name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .cart-card .cart-content .vehicle-info .name .icon {
            font-size: 28px;
        }

        .cart-card .cart-content .vehicle-info .detail {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        .cart-card .cart-content .vehicle-info .detail strong {
            color: #43637E;
        }

        .cart-card .cart-content .vehicle-info .subtotal {
            font-size: 18px;
            font-weight: 700;
            color: #43637E;
            margin-top: 6px;
            font-family: 'Georgia', serif;
        }

        .cart-card .cart-content .vehicle-info .stock-status {
            font-size: 13px;
            font-weight: 600;
            margin-top: 4px;
        }

        .cart-card .cart-content .vehicle-info .stock-status.available {
            color: #4a7a5a;
        }

        .cart-card .cart-content .vehicle-info .stock-status.unavailable {
            color: #b04a4a;
        }

        .cart-controls {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 12px;
            background: #faf8f5;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #f0ede8;
        }

        .cart-controls .control-group {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .cart-controls .control-group label {
            font-size: 10px;
            font-weight: 700;
            color: #43637E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cart-controls .control-group select,
        .cart-controls .control-group input {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1.5px solid #e8e4de;
            font-size: 13px;
            background: #ffffff;
            color: #2c3e50;
            transition: all 0.3s ease;
            min-width: 70px;
        }

        .cart-controls .control-group select:focus,
        .cart-controls .control-group input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 3px rgba(67, 99, 126, 0.12);
            outline: none;
        }

        .cart-controls .control-group input[type="number"] {
            width: 70px;
        }

        .cart-controls .control-group input[readonly] {
            background: #f0ede8;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .cart-controls .btn-update {
            background: #43637E;
            color: #ffffff;
            padding: 6px 18px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(67, 99, 126, 0.25);
            margin-top: 16px;
            height: 34px;
        }

        .cart-controls .btn-update:hover {
            background: #36546b;
            transform: translateY(-2px);
        }

        .cart-controls .btn-remove {
            background: transparent;
            color: #b04a4a;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 12px;
            border: 1.5px solid #b04a4a;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
            height: 34px;
        }

        .cart-controls .btn-remove:hover {
            background: #b04a4a;
            color: #ffffff;
        }

        .summary-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 28px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .summary-card:hover {
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .summary-card .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .summary-card .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 15px;
            color: #7a8a9a;
            border-bottom: 1px solid #f0ede8;
        }

        .summary-card .summary-row:last-of-type {
            border-bottom: none;
        }

        .summary-card .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 12px 0 0;
            font-size: 24px;
            font-weight: 700;
            color: #43637E;
            font-family: 'Georgia', serif;
            border-top: 2px solid #f0ede8;
            margin-top: 8px;
        }

        .summary-card .btn-checkout {
            display: block;
            width: 100%;
            margin-top: 16px;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-align: center;
            text-decoration: none;
            transition: all 0.4s ease;
            border: none;
            cursor: pointer;
        }

        .summary-card .btn-checkout.active {
            background: #43637E;
            color: #ffffff;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .summary-card .btn-checkout.active:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        .summary-card .btn-checkout.disabled {
            background: #d5d0c8;
            color: #7a8a9a;
            cursor: not-allowed;
        }

        .summary-card .stock-warning {
            background: #fce8e8;
            border: 1px solid #d46a6a;
            color: #b04a4a;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
            margin-top: 12px;
            font-size: 14px;
        }

        .empty-state {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid #e8e4de;
        }

        .empty-state .icon {
            font-size: 72px;
            margin-bottom: 16px;
            display: block;
        }

        .empty-state h3 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .empty-state p {
            color: #7a8a9a;
            margin-top: 4px;
        }

        .empty-state .btn-armada {
            display: inline-block;
            margin-top: 16px;
            background: #43637E;
            color: #ffffff;
            padding: 12px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.3);
        }

        .empty-state .btn-armada:hover {
            background: #36546b;
            transform: translateY(-3px);
        }

        /* Dark Mode */
        .dark .cart-section { background: #1a2632; }
        .dark .cart-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
        .dark .alert-success { background: #1e3d2e; border-color: #4a7a5a; color: #8abd9a; }
        .dark .alert-error { background: #3d1e1e; border-color: #d46a6a; color: #d46a6a; }
        .dark .alert-info { background: #1e2d3d; border-color: #43637E; color: #8ab4d4; }
        .dark .cart-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .cart-card:hover { border-color: #43637E; }
        .dark .cart-card .cart-content .vehicle-info .name { color: #f0ede8; }
        .dark .cart-card .cart-content .vehicle-info .detail { color: #b0bec5; }
        .dark .cart-controls { background: #0f1a24; border-color: #2c3e50; }
        .dark .cart-controls .control-group label { color: #f0e6d0; }
        .dark .cart-controls .control-group select,
        .dark .cart-controls .control-group input { background: #1a2632; border-color: #2c3e50; color: #f0ede8; }
        .dark .cart-controls .control-group select:focus,
        .dark .cart-controls .control-group input:focus { border-color: #43637E; }
        .dark .summary-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .summary-card:hover { border-color: #43637E; }
        .dark .summary-card .summary-title { color: #f0ede8; }
        .dark .summary-card .summary-row { color: #b0bec5; border-bottom-color: #2c3e50; }
        .dark .summary-card .summary-total { border-top-color: #2c3e50; color: #f0e6d0; }
        .dark .summary-card .stock-warning { background: #3d1e1e; border-color: #d46a6a; color: #d46a6a; }
        .dark .empty-state { background: #1a2632; border-color: #2c3e50; box-shadow: 0 16px 50px rgba(0,0,0,0.4); }
        .dark .empty-state h3 { color: #f0ede8; }
        .dark .empty-state p { color: #b0bec5; }

        @media (max-width: 768px) {
            .cart-card { padding: 16px 18px; }
            .cart-card .cart-content { flex-direction: column; align-items: stretch; }
            .cart-controls { flex-wrap: wrap; padding: 10px 14px; }
            .cart-controls .control-group { flex: 1; min-width: 80px; }
            .cart-controls .control-group input[type="number"] { width: 100%; }
            .cart-controls .btn-update,
            .cart-controls .btn-remove { margin-top: 8px; flex: 1; }
            .summary-card { padding: 18px 20px; }
            .summary-card .summary-total { font-size: 20px; }
        }

        @media (max-width: 480px) {
            .cart-section { padding: 24px 0 40px; }
            .cart-card { padding: 14px 14px; }
            .cart-card .cart-content .vehicle-info .name { font-size: 16px; }
            .cart-card .cart-content .vehicle-info .subtotal { font-size: 16px; }
            .cart-controls { flex-direction: column; align-items: stretch; gap: 8px; }
            .cart-controls .control-group { min-width: unset; }
            .cart-controls .btn-update,
            .cart-controls .btn-remove { width: 100%; padding: 8px; }
            .summary-card .summary-total { font-size: 18px; }
            .summary-card .btn-checkout { font-size: 14px; padding: 12px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <div class="cart-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">❌ {{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="alert-info">ℹ️ {{ session('info') }}</div>
            @endif

            @if(count($carts) > 0)
                @foreach($carts as $cart)
                    <div class="cart-card">
                        <div class="cart-content">
                            <!-- Vehicle Info -->
                            <div class="vehicle-info">
                                <div class="name">
                                    <span class="icon">{{ $cart->vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                                    {{ $cart->vehicle->name }}
                                </div>
                                <div class="detail">
                                    📍 {{ $cart->vehicle->location }} &nbsp;•&nbsp; 💰 Rp {{ number_format($cart->vehicle->price_per_day, 0, ',', '.') }} / hari
                                </div>
                                <div class="subtotal">
                                    Subtotal: Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                </div>
                                <div class="stock-status {{ $cart->is_stock_available ? 'available' : 'unavailable' }}">
                                    @if($cart->is_stock_available)
                                        ✅ Stok tersedia ({{ $cart->available_stock }} unit)
                                    @else
                                        ⚠️ STOK TIDAK TERSEDIA! (Stok: {{ $cart->available_stock }} tersisa)
                                    @endif
                                </div>
                            </div>

                            <!-- Controls -->
                            <form action="{{ route('user.cart.update', $cart->id) }}" method="POST" class="cart-controls">
                                @csrf
                                @method('PUT')

                                <div class="control-group">
                                    <label>📅 Periode</label>
                                    <select name="period" onchange="toggleDays(this)">
                                        <option value="daily" {{ $cart->period == 'daily' ? 'selected' : '' }}>Per Hari</option>
                                        <option value="weekly" {{ $cart->period == 'weekly' ? 'selected' : '' }}>Per Minggu</option>
                                    </select>
                                </div>

                                <div class="control-group">
                                    <label>📆 Hari</label>
                                    <input type="number" name="quantity_days" id="quantity_days_{{ $cart->id }}" value="{{ $cart->quantity_days ?? 1 }}" min="1" max="7">
                                </div>

                                <div class="control-group">
                                    <label>🚗 Unit</label>
                                    <input type="number" name="quantity_vehicle" value="{{ $cart->quantity_vehicle ?? 1 }}" min="1" max="{{ $cart->available_stock ?? 10 }}">
                                </div>

                                <button type="submit" class="btn-update">🔄 Update</button>
                            </form>

                            <!-- Hapus -->
                            <form action="{{ route('user.cart.remove', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- SUMMARY -->
                <div class="summary-card">
                    <h3 class="summary-title">📊 Ringkasan</h3>

                    <div class="summary-row">
                        <span>Total Item:</span>
                        <span>{{ count($carts) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Unit:</span>
                        <span>{{ $carts->sum('quantity_vehicle') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Hari:</span>
                        <span>{{ $carts->sum('quantity_days') }}</span>
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
                            ⚠️ Ada item dengan stok tidak tersedia! Silahkan hapus atau kurangi item tersebut.
                        </div>
                        <button disabled class="btn-checkout disabled">
                            💳 Lanjut ke Pembayaran (Stock Issue)
                        </button>
                    @else
                        <a href="{{ route('user.cart.checkout') }}" class="btn-checkout active">
                            💳 Lanjut ke Pembayaran
                        </a>
                    @endif
                </div>

            @else
                <div class="empty-state">
                    <span class="icon">🛒</span>
                    <h3>Keranjang Kosong</h3>
                    <p>Belum ada kendaraan di keranjang</p>
                    <a href="{{ route('user.armada') }}" class="btn-armada">
                        🚗 Lihat Armada
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