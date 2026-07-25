<x-guest-layout>
    <style>
        /* ============================================ */
        /* REGISTER PAGE - ELEGAN #43637E               */
        /* ============================================ */
        * {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .register-container {
            max-width: 420px;
            margin: 0 auto;
            padding: 40px 36px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25), 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e8e4de;
        }

        .register-container:hover {
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.35), 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: #43637E;
        }

        .register-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .register-header .icon {
            font-size: 48px;
            display: block;
            margin-bottom: 8px;
        }

        .register-header .title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Georgia', serif;
        }

        .register-header .title .highlight {
            color: #43637E;
        }

        .register-header .subtitle {
            font-size: 14px;
            color: #7a8a9a;
            margin-top: 4px;
            font-weight: 300;
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
            margin-bottom: 6px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1.5px solid #e8e4de;
            font-size: 15px;
            background: #faf8f5;
            transition: all 0.3s ease;
            color: #2c3e50;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            border-color: #43637E;
            box-shadow: 0 0 0 4px rgba(67, 99, 126, 0.12);
            outline: none;
            background: #ffffff;
        }

        .form-group input[type="text"]::placeholder,
        .form-group input[type="email"]::placeholder,
        .form-group input[type="password"]::placeholder {
            color: #b0a8a0;
        }

        .form-group .error-text {
            color: #b04a4a;
            font-size: 13px;
            margin-top: 4px;
        }

        .register-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: #43637E;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(67, 99, 126, 0.4);
        }

        .btn-register:hover {
            background: #36546b;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(67, 99, 126, 0.5);
        }

        .login-link {
            text-align: center;
            font-size: 14px;
            color: #7a8a9a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: #43637E;
        }

        .login-link strong {
            color: #43637E;
        }

        .login-link strong:hover {
            text-decoration: underline;
        }

        /* ===== DARK MODE ===== */
        .dark .register-container {
            background: #1a2632;
            border-color: #2c3e50;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5), 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .dark .register-container:hover {
            border-color: #43637E;
            box-shadow: 0 24px 65px rgba(0, 0, 0, 0.6), 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .dark .register-header .title {
            color: #f0ede8;
        }

        .dark .register-header .title .highlight {
            color: #f0e6d0;
        }

        .dark .register-header .subtitle {
            color: #b0bec5;
        }

        .dark .form-group label {
            color: #f0e6d0;
        }

        .dark .form-group input[type="text"],
        .dark .form-group input[type="email"],
        .dark .form-group input[type="password"] {
            background: #0f1a24;
            border-color: #2c3e50;
            color: #f0ede8;
        }

        .dark .form-group input[type="text"]:focus,
        .dark .form-group input[type="email"]:focus,
        .dark .form-group input[type="password"]:focus {
            border-color: #43637E;
            background: #1a2632;
        }

        .dark .form-group input[type="text"]::placeholder,
        .dark .form-group input[type="email"]::placeholder,
        .dark .form-group input[type="password"]::placeholder {
            color: #5a6a7a;
        }

        .dark .login-link {
            color: #7a8a9a;
        }

        .dark .login-link:hover {
            color: #f0e6d0;
        }

        .dark .login-link strong {
            color: #f0e6d0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 480px) {
            .register-container {
                padding: 28px 20px;
                border-radius: 16px;
            }

            .register-header .title {
                font-size: 20px;
            }

            .register-header .icon {
                font-size: 40px;
            }

            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="password"] {
                font-size: 14px;
                padding: 10px 14px;
            }

            .btn-register {
                font-size: 14px;
                padding: 12px;
            }
        }

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

    <div class="register-container">
        <!-- Header -->
        <div class="register-header">
            <span class="icon">🚗</span>
            <h2 class="title">Daftar <span class="highlight">GoAnywhere</span></h2>
            <p class="subtitle">Buat akun untuk mulai menyewa kendaraan</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">👤 Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" 
                       placeholder="Masukkan nama lengkap" required autofocus autocomplete="name">
                @if($errors->has('name'))
                    <div class="error-text">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">📧 Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                       placeholder="Masukkan email" required autocomplete="username">
                @if($errors->has('email'))
                    <div class="error-text">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">🔒 Password</label>
                <input id="password" type="password" name="password" 
                       placeholder="Masukkan password" required autocomplete="new-password">
                @if($errors->has('password'))
                    <div class="error-text">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group" style="margin-bottom: 0;">
                <label for="password_confirmation">🔒 Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" 
                       placeholder="Konfirmasi password" required autocomplete="new-password">
                @if($errors->has('password_confirmation'))
                    <div class="error-text">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <!-- Actions -->
            <div class="register-actions">
                <button type="submit" class="btn-register">
                    🚀 Daftar
                </button>

                <a class="login-link" href="{{ route('login') }}">
                    Sudah punya akun? <strong>Login</strong>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>