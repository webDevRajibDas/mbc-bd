<!DOCTYPE html>
<html lang="bn-BD" class="login-registration">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>পাসওয়ার্ড রিসেট - POPI[HRMS]</title>
    <link rel="shortcut icon" href="{{ asset('default-img/popi-logo.png') }}">
    <link href="{{ URL::asset('assets/login/css/login.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app-bangla.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background-image: url('{{ asset('default-img/login-bg.jpg') }}');
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 1rem;
        }

        .login-card {
            display: flex;
            width: 100%;
            max-width: 780px;
            min-height: 500px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(12, 107, 94, 0.13), 0 2px 8px rgba(0,0,0,0.07);
        }

        .login-brand {
            width: 240px;
            flex-shrink: 0;
            background: #0C6B5E;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.75rem;
            gap: 1.25rem;
            position: relative;
        }
        .login-brand::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: rgba(255,255,255,0.08);
        }
        .brand-logo-wrap {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .brand-logo-wrap img {
            width: 62px;
            height: 62px;
            object-fit: contain;
            border-radius: 8px;
        }
        .brand-name {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-align: center;
            line-height: 1;
        }
        .brand-name span {
            display: block;
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 3px;
            color: rgba(255,255,255,0.7);
            margin-top: 4px;
        }
        .brand-divider {
            width: 36px;
            height: 1px;
            background: rgba(255,255,255,0.2);
        }
        .brand-tagline {
            color: rgba(255,255,255,0.55);
            font-size: 11.5px;
            text-align: center;
            line-height: 1.65;
        }
        .brand-version {
            position: absolute;
            bottom: 18px;
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .brand-version::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4ade80;
        }

        .login-form-panel {
            flex: 1;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2.75rem 2.5rem;
        }
        .login-heading {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        .login-subheading {
            font-size: 13.5px;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 1.25rem;
            font-size: 13px;
            color: #b91c1c;
        }
        .alert-error ul { margin: 0; padding-left: 16px; }
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 1.25rem;
            font-size: 13px;
            color: #166534;
        }

        .field-group { margin-bottom: 1.1rem; }
        .field-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }
        .field-label .req { color: #ef4444; margin-left: 2px; }
        .field-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .field-icon {
            position: absolute;
            left: 12px;
            font-size: 15px;
            color: #9ca3af;
            pointer-events: none;
            z-index: 1;
        }
        .field-input {
            width: 100%;
            height: 44px;
            padding: 0 42px 0 38px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            color: #111827;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }
        .field-input:focus {
            border-color: #0C6B5E;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(12, 107, 94, 0.12);
        }
        .field-input.is-invalid {
            border-color: #ef4444;
            background: #fff;
        }
        .field-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }
        .invalid-feedback {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
            display: block;
        }

        .btn-login {
            width: 100%;
            height: 44px;
            background: #0C6B5E;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 600;
            letter-spacing: 0.3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(12, 107, 94, 0.3);
        }
        .btn-login:hover {
            background: #084d44;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(12, 107, 94, 0.38);
        }
        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(12, 107, 94, 0.2);
        }
        .btn-login:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .btn-login .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .login-footer {
            margin-top: 1.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f3f4f6;
            text-align: center;
        }
        .login-footer p {
            font-size: 11.5px;
            color: #9ca3af;
            line-height: 1.6;
            margin: 0;
        }
        .login-footer a {
            color: #0C6B5E;
            text-decoration: none;
        }
        .login-footer a:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            .login-brand { display: none; }
            .login-form-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>

<body class="login-registration">

<div class="login-card">

    {{-- ===== LEFT BRAND PANEL ===== --}}
    <div class="login-brand">
        <div class="brand-logo-wrap">
            <img src="{{ asset('default-img/popi-logo.png') }}" alt="POPI Logo">
        </div>

        <div>
            <div class="brand-name">
                POPI
                <span>HRMS</span>
            </div>
        </div>

        <div class="brand-divider"></div>

        <div class="brand-tagline">
            Peoples Oriented<br>
            Program Implementation<br>
            <br>
            Human Resource<br>
            Management System
        </div>
    </div>

    {{-- ===== RIGHT FORM PANEL ===== --}}
    <div class="login-form-panel">

        <div class="login-heading">পাসওয়ার্ড রিসেট</div>
        <div class="login-subheading">আপনার ইমেইল ঠিকানা দিন, আমরা রিসেট লিংক পাঠাবো</div>

        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="resetForm" novalidate>
            @csrf

            <div class="field-group">
                <label for="email" class="field-label">
                    ব্যবহারকারী নাম / ইমেইল <span class="req">*</span>
                </label>
                <div class="field-wrap">
                    <i class="fa fa-envelope-o field-icon" aria-hidden="true"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="field-input @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="আপনার ব্যবহারকারী নাম কিংবা ইমেইল দিন"
                        autocomplete="email"
                        autofocus
                        required
                    >
                </div>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login" id="resetBtn">
                <span class="spinner" id="resetSpinner"></span>
                <i class="fa fa-send" id="resetIcon" aria-hidden="true"></i>
                <span id="resetText">রিসেট লিংক পাঠান</span>
            </button>

            <div style="text-align: center; margin-top: 1rem;">
                <a href="{{ route('login') }}" style="color: #0C6B5E; font-size: 13px; text-decoration: none; font-weight: 500;">&larr; লগইন পেইজে ফিরে যান</a>
            </div>

        </form>

        <div class="login-footer">
            <p>
                POPI HRMS &nbsp;·&nbsp; Dhaka, Bangladesh
            </p>
        </div>

    </div>{{-- /.login-form-panel --}}
</div>{{-- /.login-card --}}

<script>
    document.getElementById('resetForm').addEventListener('submit', function () {
        const btn     = document.getElementById('resetBtn');
        const spinner = document.getElementById('resetSpinner');
        const icon    = document.getElementById('resetIcon');
        const text    = document.getElementById('resetText');

        btn.disabled          = true;
        spinner.style.display = 'block';
        icon.style.display    = 'none';
        text.textContent      = 'Sending…';
    });
</script>

</body>
</html>
