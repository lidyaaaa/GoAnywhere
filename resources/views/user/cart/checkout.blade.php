<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            💳 Checkout - GoAnywhere
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .checkout-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .checkout-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
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

        .alert-warning {
            background: #fdf6e8;
            border: 1px solid #b08a3a;
            color: #b08a3a;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 28px;
            margin-bottom: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .checkout-card:hover {
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .checkout-card .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 16px;
        }

        .checkout-card .card-title .icon {
            margin-right: 8px;
        }

        /* ===== 2 KOLOM ===== */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ===== ITEM CARD ===== */
        .item-card {
            display: flex;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #f0ede8;
            align-items: center;
        }

        .item-card:last-child {
            border-bottom: none;
        }

        .item-card .item-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e8e4de, #d5d0c8);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            border: 1px solid #e8e4de;
        }

        .item-card .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-card .item-image .placeholder {
            font-size: 36px;
            opacity: 0.6;
        }

        .item-card .item-detail {
            flex: 1;
        }

        .item-card .item-detail .name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 15px;
        }

        .item-card .item-detail .meta {
            font-size: 13px;
            color: #7a8a9a;
        }

        .item-card .item-detail .meta .badge-weekly {
            background: rgba(67, 99, 126, 0.12);
            color: #43637E;
            padding: 1px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 6px;
        }

        .item-card .item-detail .price {
            font-weight: 700;
            color: #43637E;
            font-size: 16px;
            font-family: 'Georgia', serif;
            margin-top: 2px;
        }

        /* ===== DETAIL ORDER ===== */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 14px;
            color: #7a8a9a;
        }

        .detail-row .label {
            color: #9aabbb;
        }

        .detail-row .value {
            font-weight: 600;
            color: #2c3e50;
        }

        .detail-row .value.booking-code {
            color: #43637E;
            font-family: monospace;
            font-size: 15px;
        }

        .detail-row .value.deadline {
            color: #b04a4a;
        }

        .detail-divider {
            border: none;
            border-top: 1.5px solid #f0ede8;
            margin: 12px 0 14px;
        }

        .detail-total {
            display: flex;
            justify-content: space-between;
            font-size: 22px;
            font-weight: 700;
            color: #43637E;
            font-family: 'Georgia', serif;
        }

        /* ===== PAYMENT ===== */
        .payment-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .payment-option {
            position: relative;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .payment-option .payment-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 8px;
            border: 2px solid #e8e4de;
            border-radius: 12px;
            background: #faf8f5;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }

        .payment-option .payment-label:hover {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.06);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.15);
        }

        .payment-option input[type="radio"]:checked + .payment-label {
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.1);
            box-shadow: 0 4px 20px rgba(67, 99, 126, 0.15);
        }

        .payment-option .payment-label .icon {
            font-size: 28px;
            display: block;
        }

        .payment-option .payment-label .label-text {
            font-size: 11px;
            font-weight: 600;
            color: #5a6a7a;
            margin-top: 4px;
        }

        .payment-option input[type="radio"]:checked + .payment-label .label-text {
            color: #43637E;
        }

        /* ===== INPUT NOMINAL ===== */
        .nominal-group {
            margin-top: 16px;
        }

        .nominal-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #43637E;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .nominal-group input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 18px;
            font-weight: 700;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .nominal-group input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .nominal-group .nominal-hint {
            font-size: 12px;
            color: #9aabbb;
            margin-top: 4px;
        }

        .nominal-group .nominal-hint strong {
            color: #43637E;
        }

        .nominal-group .nominal-error {
            font-size: 13px;
            font-weight: 600;
            margin-top: 4px;
            display: none;
        }

        .nominal-group .nominal-error.show {
            display: block;
        }

        .nominal-group .nominal-error.less {
            color: #b04a4a;
        }

        .nominal-group .nominal-error.more {
            color: #b08a3a;
        }

        .nominal-group .nominal-error.valid {
            color: #4a7a5a;
        }

        /* ===== WARNING BOX ===== */
        .warning-box {
            background: #fdf6e8;
            border: 1px solid #b08a3a;
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .warning-box .icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .warning-box .content .title {
            font-weight: 700;
            color: #8a6a2a;
            font-size: 14px;
        }

        .warning-box .content .desc {
            font-size: 13px;
            color: #7a6a4a;
        }

        .warning-box .content .location {
            font-size: 13px;
            color: #43637E;
            font-weight: 600;
            margin-top: 2px;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-pay {
            width: 100%;
            margin-top: 20px;
            background: #4a7a5a;
            color: #ffffff;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(74, 122, 90, 0.4);
        }

        .btn-pay:hover {
            background: #3a6a4a;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(74, 122, 90, 0.5);
        }

        .btn-pay:disabled {
            background: #d5d0c8;
            color: #7a8a9a;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* ===== BACK LINK ===== */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #7a8a9a;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 20px;
            padding: 8px 0;
        }

        .back-link:hover {
            color: #43637E;
            transform: translateX(-4px);
        }

        /* ===== DARK MODE ===== */
        .dark .checkout-section { background: #1a2632; }
        .dark .checkout-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
        .dark .alert-error { background: #3d1e1e; border-color: #d46a6a; color: #d46a6a; }
        .dark .alert-warning { background: #3d3a1e; border-color: #b08a3a; color: #d4b86a; }
        .dark .checkout-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 12px 40px rgba(0,0,0,0.4); }
        .dark .checkout-card:hover { border-color: #43637E; }
        .dark .checkout-card .card-title { color: #f0ede8; }
        .dark .item-card { border-bottom-color: #2c3e50; }
        .dark .item-card .item-detail .name { color: #f0ede8; }
        .dark .item-card .item-detail .meta { color: #b0bec5; }
        .dark .item-card .item-detail .price { color: #f0e6d0; }
        .dark .detail-row .value { color: #f0ede8; }
        .dark .detail-divider { border-top-color: #2c3e50; }
        .dark .detail-total { color: #f0e6d0; }
        .dark .payment-option .payment-label { background: #0f1a24; border-color: #2c3e50; }
        .dark .payment-option .payment-label:hover { border-color: #43637E; background: rgba(67,99,126,0.15); }
        .dark .payment-option .payment-label .label-text { color: #b0bec5; }
        .dark .payment-option input[type="radio"]:checked + .payment-label { border-color: #43637E; background: rgba(67,99,126,0.2); }
        .dark .payment-option input[type="radio"]:checked + .payment-label .label-text { color: #f0e6d0; }
        .dark .nominal-group label { color: #f0e6d0; }
        .dark .nominal-group input { background: #0f1a24; border-color: #2c3e50; color: #f0ede8; }
        .dark .nominal-group input:focus { border-color: #43637E; background: #1a2632; }
        .dark .warning-box { background: #3d3a1e; border-color: #b08a3a; }
        .dark .warning-box .content .title { color: #d4b86a; }
        .dark .warning-box .content .desc { color: #b0a080; }
        .dark .warning-box .content .location { color: #8ab4d4; }
        .dark .back-link { color: #7a8a9a; }
        .dark .back-link:hover { color: #f0e6d0; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .checkout-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 768px) {
            .checkout-card { padding: 18px 20px; }
            .payment-grid { grid-template-columns: repeat(3, 1fr); gap: 10px; }
            .detail-total { font-size: 18px; }
            .item-card .item-image { width: 60px; height: 60px; }
            .item-card .item-image .placeholder { font-size: 28px; }
        }

        @media (max-width: 480px) {
            .checkout-section { padding: 24px 0 40px; }
            .checkout-card { padding: 14px 16px; }
            .payment-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }
            .payment-option .payment-label { padding: 10px 6px; }
            .payment-option .payment-label .icon { font-size: 22px; }
            .payment-option .payment-label .label-text { font-size: 10px; }
            .detail-total { font-size: 16px; }
            .btn-pay { font-size: 15px; padding: 14px; }
            .item-card { padding: 8px 0; }
            .item-card .item-detail .name { font-size: 14px; }
            .item-card .item-detail .price { font-size: 14px; }
            .warning-box { padding: 12px 14px; }
            .warning-box .content .title { font-size: 13px; }
            .nominal-group input { font-size: 16px; padding: 10px 14px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <!-- ============================================ -->
    <!-- CHECKOUT SECTION                             -->
    <!-- ============================================ -->
    <div class="checkout-section">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="alert-error">❌ {{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert-warning">⚠️ {{ session('warning') }}</div>
            @endif

            <!-- ===== 2 KOLOM ===== -->
            <div class="checkout-grid">

                <!-- ===== KOLOM KIRI: ITEM YANG DIPESAN ===== -->
                <div class="checkout-card">
                    <h4 class="card-title" style="font-size: 16px; margin-bottom: 12px;">
                        <span class="icon">🛒</span> Item yang Dipesan
                    </h4>

                    @foreach($carts as $cart)
                        <div class="item-card">
                            <div class="item-image">
                                @if($cart->vehicle->image)
                                    <img src="{{ asset('storage/' . $cart->vehicle->image) }}" alt="{{ $cart->vehicle->name }}">
                                @else
                                    <span class="placeholder">{{ $cart->vehicle->vehicle_type == 'car' ? '🚗' : '🏍️' }}</span>
                                @endif
                            </div>
                            <div class="item-detail">
                                <div class="name">{{ $cart->vehicle->name }}</div>
                                <div class="meta">
                                    {{ $cart->quantity }} hari
                                    @if($cart->period == 'weekly')
                                        <span class="badge-weekly">Mingguan</span>
                                    @endif
                                </div>
                                <div class="price">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ===== KOLOM KANAN: DETAIL PEMESANAN ===== -->
                <div class="checkout-card">
                    <h4 class="card-title" style="font-size: 16px; margin-bottom: 12px;">
                        <span class="icon">📋</span> Detail Pemesanan
                    </h4>

                    <div class="detail-row">
                        <span class="label">Kode Booking</span>
                        <span class="value booking-code">{{ $bookingCode }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Total Item</span>
                        <span class="value">{{ count($carts) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Batas Pembayaran</span>
                        <span class="value deadline">{{ $paymentDeadline->format('d M Y H:i') }}</span>
                    </div>

                    <hr class="detail-divider">

                    <div class="detail-total">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

            <!-- ===== METODE PEMBAYARAN ===== -->
            <div class="checkout-card">
                <h3 class="card-title"><span class="icon">💰</span> Pilih Metode Pembayaran</h3>

                <form action="{{ route('user.cart.payment') }}" method="POST" id="paymentForm">
                    @csrf

                    <div class="payment-grid">
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="qris" id="qris">
                            <label for="qris" class="payment-label">
                                <span class="icon">📱</span>
                                <span class="label-text">QRIS</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer">
                            <label for="bank_transfer" class="payment-label">
                                <span class="icon">🏦</span>
                                <span class="label-text">Transfer</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="gopay" id="gopay">
                            <label for="gopay" class="payment-label">
                                <span class="icon">💚</span>
                                <span class="label-text">GoPay</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="dana" id="dana">
                            <label for="dana" class="payment-label">
                                <span class="icon">🟣</span>
                                <span class="label-text">DANA</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment_method" value="ovo" id="ovo">
                            <label for="ovo" class="payment-label">
                                <span class="icon">🟡</span>
                                <span class="label-text">OVO</span>
                            </label>
                        </div>
                    </div>

                    <!-- ===== INPUT NOMINAL ===== -->
                    <div class="nominal-group">
                        <label>💳 Masukkan Nominal Pembayaran</label>
                        <input type="number" id="nominal" name="nominal" 
                               placeholder="Masukkan nominal sesuai total" 
                               oninput="validateNominal(this.value, {{ $total }})">
                        <div class="nominal-hint">
                            Total yang harus dibayar: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <div id="nominalError" class="nominal-error"></div>
                    </div>

                    <!-- Warning -->
                    <div class="warning-box">
                        <span class="icon">⚠️</span>
                        <div class="content">
                            <div class="title">Setelah bayar, Anda wajib mengambil kendaraan di lokasi dalam 30 menit!</div>
                            <div class="desc">Pastikan Anda datang tepat waktu untuk menghindari pembatalan.</div>
                            <div class="location">📍 Lokasi: {{ $carts->first()->pickup_location ?? 'SMKN 21 Jakarta' }}</div>
                        </div>
                    </div>

                    <button type="submit" class="btn-pay" id="btnPay" disabled>
                        💳 Bayar Sekarang
                    </button>
                </form>
            </div>

            <!-- Back Link -->
            <a href="{{ route('user.cart') }}" class="back-link">
                ← Kembali ke Keranjang
            </a>

        </div>
    </div>

    <!-- ============================================ -->
    <!-- VALIDASI JS                                  -->
    <!-- ============================================ -->
    <script>
        function validateNominal(value, total) {
            var nominal = parseInt(value);
            var errorEl = document.getElementById('nominalError');
            var btnPay = document.getElementById('btnPay');
            var totalFormatted = new Intl.NumberFormat('id-ID').format(total);

            // Reset
            errorEl.className = 'nominal-error';
            errorEl.textContent = '';
            btnPay.disabled = true;

            if (isNaN(nominal) || nominal <= 0) {
                errorEl.className = 'nominal-error show less';
                errorEl.textContent = '⚠️ Silakan masukkan nominal pembayaran!';
                return;
            }

            if (nominal < total) {
                var kurang = new Intl.NumberFormat('id-ID').format(total - nominal);
                errorEl.className = 'nominal-error show less';
                errorEl.textContent = '⚠️ Nominal kurang Rp ' + kurang + '! Total yang harus dibayar Rp ' + totalFormatted;
                return;
            }

            if (nominal > total) {
                var lebih = new Intl.NumberFormat('id-ID').format(nominal - total);
                errorEl.className = 'nominal-error show more';
                errorEl.textContent = '⚠️ Nominal lebih Rp ' + lebih + '! Total yang harus dibayar Rp ' + totalFormatted;
                return;
            }

            // NOMINAL PAS!
            errorEl.className = 'nominal-error show valid';
            errorEl.textContent = '✅ Nominal sesuai! Silakan lanjutkan pembayaran.';
            btnPay.disabled = false;
        }

        // Cek juga saat submit
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            var selected = document.querySelector('input[name="payment_method"]:checked');
            var nominal = document.getElementById('nominal').value;

            if (!selected) {
                e.preventDefault();
                alert('⚠️ Silakan pilih metode pembayaran terlebih dahulu!');
                return false;
            }

            if (isNaN(parseInt(nominal)) || parseInt(nominal) <= 0) {
                e.preventDefault();
                alert('⚠️ Silakan masukkan nominal pembayaran yang valid!');
                return false;
            }

            var total = {{ $total }};
            if (parseInt(nominal) !== total) {
                e.preventDefault();
                var errorEl = document.getElementById('nominalError');
                if (parseInt(nominal) < total) {
                    alert('⚠️ Nominal kurang! Total yang harus dibayar Rp ' + new Intl.NumberFormat('id-ID').format(total));
                } else {
                    alert('⚠️ Nominal lebih! Total yang harus dibayar Rp ' + new Intl.NumberFormat('id-ID').format(total));
                }
                return false;
            }

            return true;
        });
    </script>
</x-app-layout>