<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Profile Perusahaan - GoAnywhere
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .profile-company-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .profile-company-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 20px;
        }

        .section-title .icon {
            margin-right: 8px;
        }

        /* ===== CONTACT GRID ===== */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .contact-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1), 0 4px 15px rgba(0, 0, 0, 0.06);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .contact-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 45px rgba(0, 0, 0, 0.18), 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #43637E;
        }

        .contact-card .icon {
            font-size: 28px;
            flex-shrink: 0;
        }

        .contact-card .info .label {
            font-size: 11px;
            font-weight: 600;
            color: #9aabbb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-card .info .value {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
            margin-top: 1px;
        }

        /* ===== LOCATION GRID ===== */
        .location-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .location-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 24px 28px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            border-left: 4px solid #43637E;
            transition: all 0.4s ease;
        }

        .location-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .location-card .header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .location-card .header .icon {
            font-size: 28px;
        }

        .location-card .header .name {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .location-card .address {
            font-size: 14px;
            color: #7a8a9a;
            line-height: 1.6;
        }

        .location-card .detail {
            font-size: 13px;
            color: #7a8a9a;
            margin-top: 4px;
        }

        .location-card .detail strong {
            color: #43637E;
        }

        .location-card .btn-maps {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 20px;
            background: #43637E;
            color: #ffffff;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.3);
        }

        .location-card .btn-maps:hover {
            background: #36546b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 99, 126, 0.4);
        }

        /* ===== MAPS GRID 5 LOKASI ===== */
        .maps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 32px;
        }

        .maps-item {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
            background: #ffffff;
        }

        .maps-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.22), 0 12px 35px rgba(0, 0, 0, 0.12);
            border-color: #43637E;
        }

        .maps-item .maps-header {
            padding: 12px 18px;
            background: #43637E;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .maps-item .maps-header .city-name {
            font-weight: 700;
            font-size: 15px;
            font-family: 'Georgia', serif;
        }

        .maps-item .maps-header .city-icon {
            font-size: 20px;
        }

        .maps-item iframe {
            display: block;
            width: 100%;
            height: 200px;
            border: none;
        }

        /* ===== DARK MODE ===== */
        .dark .profile-company-section {
            background: #1a2632;
        }

        .dark .profile-company-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .section-title {
            color: #f0ede8;
        }

        .dark .contact-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3), 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dark .contact-card:hover {
            border-color: #43637E;
        }

        .dark .contact-card .info .value {
            color: #f0ede8;
        }

        .dark .location-card {
            background: #1a2632;
            border-color: #2c3e50;
            border-left-color: #43637E;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .dark .location-card:hover {
            border-color: #43637E;
        }

        .dark .location-card .header .name {
            color: #f0ede8;
        }

        .dark .location-card .address {
            color: #b0bec5;
        }

        .dark .location-card .detail {
            color: #b0bec5;
        }

        .dark .maps-item {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .dark .maps-item:hover {
            border-color: #43637E;
        }

        .dark .maps-item .maps-header {
            background: #2c3e50;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .contact-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .location-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .maps-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .contact-card {
                padding: 14px 16px;
            }

            .contact-card .icon {
                font-size: 22px;
            }

            .contact-card .info .value {
                font-size: 13px;
            }

            .location-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .location-card {
                padding: 18px 20px 22px;
            }

            .maps-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .maps-item iframe {
                height: 160px;
            }

            .section-title {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .profile-company-section {
                padding: 24px 0 40px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .contact-card {
                padding: 12px 14px;
            }

            .contact-card .icon {
                font-size: 20px;
            }

            .contact-card .info .value {
                font-size: 12px;
            }

            .location-card {
                padding: 14px 16px 18px;
            }

            .location-card .header .name {
                font-size: 17px;
            }

            .location-card .address {
                font-size: 13px;
            }

            .maps-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .maps-item iframe {
                height: 180px;
            }

            .maps-item .maps-header {
                padding: 10px 14px;
            }

            .maps-item .maps-header .city-name {
                font-size: 13px;
            }

            .section-title {
                font-size: 18px;
            }

            .location-card .btn-maps {
                font-size: 12px;
                padding: 6px 16px;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f0ede8;
        }

        ::-webkit-scrollbar-thumb {
            background: #43637E;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #36546b;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1a2632;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #43637E;
        }
    </style>

    <!-- ============================================ -->
    <!-- PROFILE COMPANY SECTION                      -->
    <!-- ============================================ -->
    <div class="profile-company-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ===== KONTAK ===== -->
            <h3 class="section-title"><span></span> Hubungi Kami</h3>

            <div class="contact-grid">
                <div class="contact-card">
                    <span></span>
                    <div class="info">
                        <div class="label">Telepon</div>
                        <div class="value">{{ $contacts['phone'] }}</div>
                    </div>
                </div>
                <div class="contact-card">
                    <span></span>
                    <div class="info">
                        <div class="label">WhatsApp</div>
                        <div class="value">{{ $contacts['wa'] }}</div>
                    </div>
                </div>
                <div class="contact-card">
                    <span></span>
                    <div class="info">
                        <div class="label">Email</div>
                        <div class="value">{{ $contacts['email'] }}</div>
                    </div>
                </div>
                <div class="contact-card">
                    <span></span>
                    <div class="info">
                        <div class="label">Jam Operasional</div>
                        <div class="value">{{ $contacts['hours'] }}</div>
                    </div>
                </div>
            </div>

            <!-- ===== LOKASI ===== -->
            <h3 class="section-title" style="margin-top: 40px;"><span></span> Lokasi Kami</h3>

            <div class="location-grid">
                @foreach($locations as $city => $data)
                    <div class="location-card">
                        <div class="header">
                            <span></span>
                            <span class="name">{{ $city }}</span>
                        </div>
                        <div class="address">{{ $data['address'] }}</div>
                        <div class="detail">
                             <strong>{{ $data['phone'] }}</strong>
                        </div>
                        <div class="detail">
                             {{ $data['hours'] }}
                        </div>
                        <a href="{{ $data['maps'] }}" target="_blank" class="btn-maps">
                             Lihat di Google Maps →
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- ===== MAPS 5 LOKASI ===== -->
            <h3 class="section-title" style="margin-top: 40px;"><span></span> Peta Lokasi</h3>

            <div class="maps-grid">
                <!-- Jakarta - Gambir -->
                <div class="maps-item">
                    <div class="maps-header">
                        <span class="city-name">Jakarta</span>
                        <span class="city-icon"></span>
                    </div>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.3106681789!2d106.664702!3d-6.229728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sStasiun%20Gambir!5e0!3m2!1sid!2sid!4v1700000000000" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Bogor - Stasiun Bogor -->
                <div class="maps-item">
                    <div class="maps-header">
                        <span class="city-name">Bogor</span>
                        <span class="city-icon"></span>
                    </div>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253807.78092420747!2d106.6211987!3d-6.5951369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c53bdb1c9b1f%3A0xf0f6e5d8b0f5c4a6!2sStasiun%20Bogor!5e0!3m2!1sid!2sid!4v1700000000000" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Depok - Stasiun Depok -->
                <div class="maps-item">
                    <div class="maps-header">
                        <span class="city-name">Depok</span>
                        <span class="city-icon"></span>
                    </div>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253855.7070807047!2d106.6994986!3d-6.4160436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69bef09cdcf885%3A0xf85f1f6c5f2491f2!2sStasiun%20Depok!5e0!3m2!1sid!2sid!4v1700000000000" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Tangerang - Stasiun Tangerang -->
                <div class="maps-item">
                    <div class="maps-header">
                        <span class="city-name">Tangerang</span>
                        <span class="city-icon"></span>
                    </div>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253735.67877117748!2d106.4923152!3d-6.1747981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f8226fda7b83%3A0xf7c036ffc8a5f1b4!2sStasiun%20Tangerang!5e0!3m2!1sid!2sid!4v1700000000000" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Bekasi - Stasiun Bekasi -->
                <div class="maps-item">
                    <div class="maps-header">
                        <span class="city-name">Bekasi</span>
                        <span class="city-icon"></span>
                    </div>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253863.80712239974!2d106.8235392!3d-6.241456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698b8a1b0db5b1%3A0x2adde5d06b2e6a0c!2sStasiun%20Bekasi!5e0!3m2!1sid!2sid!4v1700000000000" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>