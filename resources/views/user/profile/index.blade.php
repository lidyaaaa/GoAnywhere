<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <!-- ============================================ -->
    <!-- STYLE ELEGAN - #43637E + SHADOW HITAM TEBEL -->
    <!-- ============================================ -->
    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .profile-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .profile-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        /* ===== ALERT ===== */
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

        /* ===== CARD ===== */
        .profile-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .profile-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .profile-card .body {
            padding: 36px 40px 40px;
        }

        /* ===== 2 COLUMN ===== */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .profile-grid .col-title {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0ede8;
        }

        .profile-grid .col-title .icon {
            margin-right: 8px;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #43637E;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 14px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .form-group input:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .form-group input::placeholder {
            color: #b0a8a0;
        }

        .form-group .error-text {
            color: #b04a4a;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ===== LOCATION GRID ===== */
        .location-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .location-card {
            background: #faf8f5;
            padding: 14px 18px;
            border-radius: 10px;
            border: 1px solid #f0ede8;
            transition: all 0.3s ease;
        }

        .location-card:hover {
            border-color: #43637E;
            box-shadow: 0 4px 15px rgba(67, 99, 126, 0.08);
            transform: translateY(-2px);
        }

        .location-card .name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 14px;
        }

        .location-card .address {
            font-size: 12px;
            color: #7a8a9a;
            margin-top: 2px;
        }

        .location-card .map-link {
            display: inline-block;
            margin-top: 4px;
            font-size: 12px;
            font-weight: 600;
            color: #43637E;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .location-card .map-link:hover {
            color: #36546b;
            transform: translateX(4px);
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            width: 100%;
            margin-top: 8px;
            background: #43637E;
            color: #ffffff;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .btn-submit:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        /* ===== DARK MODE ===== */
        .dark .profile-section {
            background: #1a2632;
        }

        .dark .profile-section::before {
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .dark .alert-success {
            background: #1e3d2e;
            border-color: #4a7a5a;
            color: #8abd9a;
        }

        .dark .profile-card {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .profile-card:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .profile-grid .col-title {
            color: #f0ede8;
            border-bottom-color: #2c3e50;
        }

        .dark .form-group label {
            color: #f0e6d0;
        }

        .dark .form-group input {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #f0ede8;
        }

        .dark .form-group input:focus {
            border-color: #43637E;
            background: #1a2632;
        }

        .dark .form-group input::placeholder {
            color: #5a6a7a;
        }

        .dark .location-card {
            background: #0f1a24;
            border-color: #2c3e50;
        }

        .dark .location-card:hover {
            border-color: #43637E;
        }

        .dark .location-card .name {
            color: #f0ede8;
        }

        .dark .location-card .address {
            color: #b0bec5;
        }

        .dark .location-card .map-link {
            color: #f0e6d0;
        }

        .dark .location-card .map-link:hover {
            color: #ffffff;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .profile-card .body {
                padding: 24px 20px 28px;
            }

            .profile-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .location-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .form-group input {
                padding: 10px 14px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .profile-section {
                padding: 24px 0 40px;
            }

            .profile-card .body {
                padding: 18px 14px 22px;
            }

            .profile-grid {
                gap: 16px;
            }

            .profile-grid .col-title {
                font-size: 14px;
            }

            .form-group label {
                font-size: 11px;
            }

            .form-group input {
                padding: 8px 12px;
                font-size: 13px;
            }

            .location-card {
                padding: 10px 14px;
            }

            .location-card .name {
                font-size: 13px;
            }

            .location-card .address {
                font-size: 11px;
            }

            .btn-submit {
                font-size: 13px;
                padding: 12px;
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
    <!-- PROFILE SECTION                             -->
    <!-- ============================================ -->
    <div class="profile-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ALERT -->
            @if(session('success'))
                <div class="alert-success">
                     {{ session('success') }}
                </div>
            @endif

            <!-- PROFILE CARD -->
            <div class="profile-card">
                <div class="body">

                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- ===== 2 KOLOM ===== -->
                        <div class="profile-grid">

                            <!-- ===== KOLOM KIRI: Profil ===== -->
                            <div>
                                <div class="col-title">
                                     <span class="section-badge"></span> Informasi Profil
                                </div>

                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email">
                                    @error('email')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>No. HP</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="0812-3456-7890">
                                    @error('phone')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- ===== KOLOM KANAN: Ganti Password ===== -->
                            <div>
                                <div class="col-title">
                                     <span class="section-badge"></span> Ganti Password
                                </div>

                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="password" name="current_password" placeholder="Masukkan password lama">
                                    @error('current_password')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" placeholder="Masukkan password baru">
                                    @error('new_password')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" placeholder="Konfirmasi password baru">
                                </div>
                            </div>

                        </div>

                        <!-- ===== LOKASI ===== -->
                        <hr style="border: none; border-top: 1.5px solid #f0ede8; margin: 28px 0 24px;">

                        <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; font-family: 'Georgia', serif; margin-bottom: 16px;">
                            <span style="margin-right: 8px;"></span> Alamat GoAnywhere
                        </h3>

                        <div class="location-grid">
                            @foreach($locations as $loc)
                                <div class="location-card">
                                     <div class="name">{{ $loc }}</div>
                                    <div class="address">
                                        <?php
                                            $addresses = [
                                                'Jakarta' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                                                'Bogor' => 'Jl. Pajajaran No. 45, Bogor',
                                                'Depok' => 'Jl. Margonda Raya No. 78, Depok',
                                                'Tangerang' => 'Jl. MH Thamrin No. 90, Tangerang',
                                                'Bekasi' => 'Jl. Ahmad Yani No. 56, Bekasi',
                                            ];
                                        ?>
                                        {{ $addresses[$loc] ?? '' }}
                                    </div>
                                    <a href="https://www.google.com/maps/search/{{ urlencode($addresses[$loc] ?? '') }}" 
                                       target="_blank" class="map-link">
                                                                                 Lihat di Maps →
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- ===== SUBMIT ===== -->
                        <button type="submit" class="btn-submit">
                            Simpan Perubahan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>