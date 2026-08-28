<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pembayaran Berhasil!
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .success-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .success-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .success-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .success-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .success-card .body {
            padding: 40px 44px 44px;
            text-align: center;
        }

        .success-icon {
            font-size: 72px;
            display: block;
            margin-bottom: 12px;
            animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .success-title {
            font-size: 28px;
            font-weight: 700;
            color: #4a7a5a;
            font-family: 'Georgia', serif;
        }

        .success-subtitle {
            font-size: 15px;
            color: #7a8a9a;
            margin-top: 4px;
        }

        .success-subtitle strong {
            color: #43637E;
            font-family: monospace;
            font-size: 16px;
        }

        /* ===== TIMER ===== */
        .timer-box {
            margin-top: 24px;
            padding: 20px 24px;
            border-radius: 14px;
            background: #fce8e8;
            border: 2px solid #d46a6a;
            box-shadow: 0 4px 20px rgba(180, 60, 60, 0.12);
        }

        .timer-box .timer-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .timer-box .timer-header .icon {
            font-size: 32px;
        }

        .timer-box .timer-header .label {
            font-size: 16px;
            font-weight: 700;
            color: #b04a4a;
        }

        .timer-box .timer-display {
            font-size: 48px;
            font-weight: 700;
            color: #b04a4a;
            font-family: 'Georgia', serif;
            margin-top: 4px;
            letter-spacing: 2px;
        }

        .timer-box .timer-display.warning {
            color: #b08a3a;
            animation: blink 0.5s ease-in-out infinite alternate;
        }

        .timer-box .timer-display.danger {
            color: #b04a4a;
            animation: blink 0.3s ease-in-out infinite alternate;
        }

        @keyframes blink {
            0% { opacity: 1; }
            100% { opacity: 0.4; }
        }

        .timer-box .timer-location {
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 6px;
        }

        .timer-box .timer-location strong {
            color: #43637E;
        }

        /* ===== DETAIL ===== */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid #f0ede8;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row .label {
            color: #9aabbb;
        }

        .detail-row .value {
            font-weight: 600;
            color: #2c3e50;
        }

        .detail-row .value.method {
            text-transform: capitalize;
        }

        /* ===== BUTTONS ===== */
        .btn-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-full {
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            display: block;
        }

        .btn-primary {
            background: #4a7a5a;
            color: #ffffff;
            box-shadow: 0 8px 30px rgba(74, 122, 90, 0.4);
        }

        .btn-primary:hover {
            background: #3a6a4a;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(74, 122, 90, 0.5);
        }

        .btn-primary:disabled {
            background: #d5d0c8;
            color: #7a8a9a;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-secondary {
            background: #43637E;
            color: #ffffff;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .btn-secondary:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        .btn-wa {
            display: inline-block;
            margin-top: 16px;
            color: #7a8a9a;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 10px 24px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            background: #faf8f5;
        }

        .btn-wa:hover {
            color: #43637E;
            border-color: #43637E;
            background: rgba(67, 99, 126, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.1);
        }

        /* ===== DARK MODE ===== */
        .dark .success-section { background: #1a2632; }
        .dark .success-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
        .dark .success-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 16px 50px rgba(0,0,0,0.5); }
        .dark .success-card:hover { border-color: #43637E; box-shadow: 0 24px 65px rgba(0,0,0,0.6); }
        .dark .success-title { color: #8abd9a; }
        .dark .success-subtitle { color: #b0bec5; }
        .dark .success-subtitle strong { color: #f0e6d0; }
        .dark .timer-box { background: #3d1e1e; border-color: #8a4a4a; }
        .dark .timer-box .timer-header .label { color: #d46a6a; }
        .dark .timer-box .timer-display { color: #d46a6a; }
        .dark .timer-box .timer-location { color: #b0bec5; }
        .dark .timer-box .timer-location strong { color: #8ab4d4; }
        .dark .detail-row { border-bottom-color: #2c3e50; }
        .dark .detail-row .value { color: #f0ede8; }
        .dark .btn-wa { color: #7a8a9a; border-color: #2c3e50; background: #0f1a24; }
        .dark .btn-wa:hover { color: #f0e6d0; border-color: #43637E; background: rgba(67,99,126,0.15); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .success-card .body { padding: 28px 24px 32px; }
            .success-title { font-size: 24px; }
            .timer-box .timer-display { font-size: 36px; }
        }

        @media (max-width: 480px) {
            .success-section { padding: 24px 0 40px; }
            .success-card .body { padding: 20px 16px 24px; }
            .success-icon { font-size: 56px; }
            .success-title { font-size: 20px; }
            .timer-box { padding: 14px 16px; }
            .timer-box .timer-display { font-size: 28px; }
            .timer-box .timer-header .icon { font-size: 24px; }
            .timer-box .timer-header .label { font-size: 14px; }
            .detail-row { font-size: 13px; padding: 8px 0; }
            .btn-full { font-size: 14px; padding: 14px; }
            .btn-wa { font-size: 13px; padding: 8px 18px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <!-- ============================================ -->
    <!-- SUCCESS SECTION                              -->
    <!-- ============================================ -->
    <div class="success-section">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="success-card">
                <div class="body">

                    <!-- Icon -->
                     <span class="success-icon"></span>

                    <!-- Title -->
                    <h3 class="success-title">PEMBAYARAN MENUNGGU KONFIRMASI</h3>
                    <p class="success-subtitle">
                        Kode Booking: <strong>{{ $booking_code }}</strong>
                    </p>

                    <!-- ===== DELIVERY INFO ===== -->
                    <div class="timer-box" style="background: #e8f4ec; border-color: #4a7a5a;">
                        <div class="timer-header">
                            <span class="icon"></span>
                            <span class="label" style="color: #4a7a5a;">Menunggu persetujuan manager</span>
                        </div>
                        <div class="timer-display" style="font-size: 20px; color: #4a7a5a; letter-spacing: 0;">Menunggu persetujuan manager</div>
                        <div class="timer-location">
                             Pengembalian kendaraan: <strong>Dikembalikan ke kantor</strong>
                        </div>
                    </div>

                    <!-- ===== DETAIL ===== -->
                    <div style="margin-top: 20px; text-align: left;">
                        <div class="detail-row">
                            <span class="label">Total Pembayaran</span>
                            <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Metode</span>
                            <span class="value method">{{ $carts->first()->payment->payment_method ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- ===== BUTTONS ===== -->
                    <div class="btn-grid">
                        <a href="{{ route('user.rental') }}" class="btn-full btn-secondary">
                             Sewa Saya
                        </a>
                    </div>

                    <!-- ===== WA ===== -->
                    <a href="https://wa.me/628157184307?text=Halo%20GoAnywhere%2C%20saya%20sudah%20melakukan%20pembayaran%20dengan%20kode%20booking%3A%20{{ $booking_code }}" 
                       target="_blank" class="btn-wa">
                         Kirim bukti ke WhatsApp
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- TIMER SCRIPT                                 -->
    <!-- ============================================ -->
    <script>
        // No pickup timer needed - vehicles are delivered by staff
    </script>
</x-app-layout>