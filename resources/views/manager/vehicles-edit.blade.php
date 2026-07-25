<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Kendaraan - {{ Auth::user()->location }}
        </h2>
    </x-slot>

    <style>
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-section {
            padding: 40px 0 60px;
            background: #f8f6f2;
            position: relative;
            min-height: 100vh;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E);
        }

        .form-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
            transition: all 0.4s ease;
        }

        .form-card:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .form-card .body {
            padding: 36px 40px 40px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #43637E;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 14px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #b0a8a0;
        }

        .form-group input[type="file"] {
            padding: 10px 12px;
            background: #faf8f5;
            cursor: pointer;
        }

        .form-group input[type="file"]::file-selector-button {
            padding: 8px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            color: #43637E;
            background: rgba(67, 99, 126, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 12px;
        }

        .form-group input[type="file"]::file-selector-button:hover {
            background: rgba(67, 99, 126, 0.18);
        }

        .form-group .helper-text {
            font-size: 12px;
            color: #9aabbb;
            margin-top: 4px;
        }

        .form-group .current-image {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 8px;
            margin-bottom: 8px;
            padding: 12px 16px;
            background: #faf8f5;
            border-radius: 10px;
            border: 1px solid #f0ede8;
        }

        .form-group .current-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e8e4de;
        }

        .form-group .current-image .info .label {
            font-size: 12px;
            color: #9aabbb;
            font-weight: 500;
            text-transform: none;
            letter-spacing: 0;
        }

        .form-group .current-image .info .filename {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-update {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #b08a3a;
            color: #ffffff;
            padding: 12px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(176, 138, 58, 0.35);
        }

        .btn-update:hover {
            background: #9a7a2a;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(176, 138, 58, 0.45);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e8e4de;
            color: #5a6a7a;
            padding: 12px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #d5d0c8;
            transform: translateY(-3px);
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        /* ===== DARK MODE ===== */
        .dark .form-section { background: #1a2632; }
        .dark .form-section::before { background: linear-gradient(90deg, #43637E, #f0e6d0, #43637E); }
        .dark .form-card { background: #1a2632; border-color: #2c3e50; box-shadow: 0 16px 50px rgba(0,0,0,0.5); }
        .dark .form-card:hover { border-color: #43637E; box-shadow: 0 24px 65px rgba(0,0,0,0.6); }
        .dark .form-group label { color: #f0e6d0; }
        .dark .form-group input,
        .dark .form-group select,
        .dark .form-group textarea { background: #0f1a24; border-color: #2c3e50; color: #f0ede8; }
        .dark .form-group input:focus,
        .dark .form-group select:focus,
        .dark .form-group textarea:focus { border-color: #43637E; background: #1a2632; }
        .dark .form-group input::placeholder,
        .dark .form-group textarea::placeholder { color: #5a6a7a; }
        .dark .form-group input[type="file"] { background: #0f1a24; }
        .dark .form-group input[type="file"]::file-selector-button { background: rgba(67,99,126,0.2); color: #f0e6d0; }
        .dark .form-group input[type="file"]::file-selector-button:hover { background: rgba(67,99,126,0.3); }
        .dark .form-group .current-image { background: #0f1a24; border-color: #2c3e50; }
        .dark .form-group .current-image .info .filename { color: #f0ede8; }
        .dark .btn-cancel { background: #2c3e50; color: #b0bec5; }
        .dark .btn-cancel:hover { background: #3a4a5a; }

        @media (max-width: 768px) {
            .form-card .body { padding: 24px 20px 28px; }
            .form-actions { flex-direction: column; }
            .btn-update, .btn-cancel { justify-content: center; }
            .form-group .current-image { flex-direction: column; text-align: center; }
        }

        @media (max-width: 480px) {
            .form-section { padding: 24px 0 40px; }
            .form-card .body { padding: 18px 14px 22px; }
            .form-group label { font-size: 12px; }
            .form-group input,
            .form-group select,
            .form-group textarea { font-size: 13px; padding: 9px 12px; }
            .btn-update, .btn-cancel { font-size: 13px; padding: 10px 20px; }
            .form-group .current-image img { width: 60px; height: 60px; }
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f0ede8; }
        ::-webkit-scrollbar-thumb { background: #43637E; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #36546b; }
        .dark ::-webkit-scrollbar-track { background: #1a2632; }
        .dark ::-webkit-scrollbar-thumb { background: #43637E; }
    </style>

    <div class="form-section">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="form-card">
                <div class="body">

                    <form action="{{ route('manager.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Nama Kendaraan -->
                            <div class="form-group">
                                <label>Nama Kendaraan</label>
                                <input type="text" name="name" value="{{ $vehicle->name }}" required placeholder="Contoh: Toyota Avanza G 1.5">
                            </div>

                            <!-- Tipe -->
                            <div class="form-group">
                                <label>Tipe</label>
                                <select name="vehicle_type" required>
                                    <option value="car">Mobil</option>
                                    <option value="motorcycle">Motor</option>
                                </select>
                            </div>

                            <!-- Merk -->
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" name="brand" value="{{ $vehicle->brand }}" required placeholder="Contoh: Toyota, Honda, Yamaha">
                            </div>

                            <!-- Tipe Kendaraan -->
                            <div class="form-group">
                                <label>Tipe Kendaraan</label>
                                <input type="text" name="type" value="{{ $vehicle->type }}" required placeholder="MPV/SUV/Sedan/Matic/Sport">
                            </div>

                            <!-- Tahun -->
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="year" value="{{ $vehicle->year }}" required min="2000" max="{{ date('Y') }}" placeholder="2024">
                            </div>

                            <!-- Transmisi Mobil -->
                            <div class="form-group">
                                <label>Transmisi (Mobil)</label>
                                <select name="transmission">
                                    <option value="">Pilih</option>
                                    <option value="manual" {{ $vehicle->transmission == 'manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="automatic" {{ $vehicle->transmission == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                </select>
                            </div>

                            <!-- Transmisi Motor -->
                            <div class="form-group">
                                <label>Transmisi (Motor)</label>
                                <select name="transmission_motor">
                                    <option value="">Pilih</option>
                                    <option value="matic" {{ $vehicle->transmission_motor == 'matic' ? 'selected' : '' }}>Matic</option>
                                    <option value="manual" {{ $vehicle->transmission_motor == 'manual' ? 'selected' : '' }}>Manual</option>
                                </select>
                            </div>

                            <!-- Kapasitas -->
                            <div class="form-group">
                                <label>Kapasitas (Orang/CC)</label>
                                <input type="number" name="capacity" value="{{ $vehicle->capacity }}" required min="1" placeholder="7 atau 150">
                            </div>

                            <!-- Warna -->
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" name="color" value="{{ $vehicle->color }}" required placeholder="Hitam, Putih, Merah">
                            </div>

                            <!-- BBM -->
                            <div class="form-group">
                                <label>BBM</label>
                                <input type="text" name="fuel" value="{{ $vehicle->fuel }}" required placeholder="Bensin/Diesel/Pertalite">
                            </div>

                            <!-- Harga -->
                            <div class="form-group">
                                <label>Harga / Hari</label>
                                <input type="number" name="price_per_day" value="{{ $vehicle->price_per_day }}" required min="0" placeholder="500000">
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group md:col-span-2">
                                <label>Deskripsi</label>
                                <textarea name="description" rows="3" placeholder="Deskripsi kendaraan...">{{ $vehicle->description }}</textarea>
                            </div>

                            <!-- Upload Gambar -->
                            <div class="form-group md:col-span-2">
                                <label>Foto Kendaraan</label>
                                
                                @if($vehicle->image)
                                    <div class="current-image">
                                        <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}">
                                        <div class="info">
                                            <div class="filename">{{ basename($vehicle->image) }}</div>
                                            <div class="label">Gambar saat ini</div>
                                        </div>
                                    </div>
                                @endif

                                <input type="file" name="image" accept="image/*">
                                <div class="helper-text">Format: JPG, PNG, JPEG, GIF | Maks: 2MB | Kosongkan jika tidak ingin mengganti</div>
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-update">
                                Update
                            </button>
                            <a href="{{ route('manager.vehicles') }}" class="btn-cancel">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>