<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | MBC Bangladesh.com</title>
    <link rel="shortcut icon" href="{{ asset('default-img/popi-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <style>
        :root { --ink: #edf5ff; --muted: #b7c9e4; --line: rgba(255,255,255,.16); --accent: #86e6c2; --gold: #ffd675; }
        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100%; }
        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 32px 20px; overflow-x: hidden; background: #07111f;
            background: radial-gradient(circle at 8% 10%, rgba(58,105,216,.42), transparent 27%), radial-gradient(circle at 88% 82%, rgba(35,180,144,.2), transparent 30%), linear-gradient(130deg, #07111f, #111d40 52%, #071421);
            font-family: Inter, "Segoe UI", Arial, Helvetica, sans-serif;
        }
        body:before, body:after { content: ''; position: fixed; border-radius: 50%; filter: blur(2px); pointer-events: none; animation: drift 13s ease-in-out infinite alternate; }
        body:before { width: 280px; height: 280px; top: -105px; right: 9%; background: rgba(121,131,255,.18); }
        body:after { width: 190px; height: 190px; bottom: -75px; left: 7%; background: rgba(102,234,196,.12); animation-delay: -6s; }
        .login-board {
            position: relative; isolation: isolate; width: min(100%, 1180px); min-height: 610px; padding: 58px 62px;
            background: linear-gradient(125deg, rgba(18,35,69,.94), rgba(20,45,91,.83)); border: 1px solid var(--line); border-radius: 30px;
            box-shadow: 0 30px 80px rgba(0,0,0,.4), inset 0 1px rgba(255,255,255,.1); backdrop-filter: blur(18px);
            overflow: hidden;
            animation: board-in .75s cubic-bezier(.2,.8,.2,1) both;
        }
        .login-board:before { content: ''; position: absolute; z-index: -1; inset: 0; background: linear-gradient(110deg, transparent 42%, rgba(255,255,255,.055) 48%, transparent 55%); transform: translateX(-100%); animation: sheen 9s ease-in-out infinite; }
        .login-board:after { content: ''; position: absolute; z-index: -1; width: 440px; height: 440px; right: -170px; bottom: -240px; border-radius: 50%; background: rgba(112,218,190,.12); }
        .brand { height: 212px; margin: 0 535px 0 105px; position: relative; color: var(--ink); text-align: left; animation: rise .65s .15s both; }
        .brand-logo {
            position: absolute; left: -105px; top: 2px; width: 84px; height: 84px; border-radius: 24px;
            background: white; border: 1px solid rgba(255,255,255,.75); color: #173e67; font-size: 28px; font-weight: 900;
            display: flex; align-items: center; justify-content: center; box-shadow: 0 13px 28px rgba(0,0,0,.22); transform: rotate(-5deg);
        }
        .brand-title { color: #fff; font-size: clamp(27px, 3vw, 39px); letter-spacing: -.045em; font-weight: 800; line-height: 1.02; white-space: normal; }
        .brand-rule { width: 76px; height: 4px; border-radius: 4px; background: linear-gradient(90deg, var(--gold), #fff2c7); margin: 18px 0 14px; box-shadow: 0 0 20px rgba(255,214,117,.35); }
        .brand-subtitle { font-size: clamp(17px, 2vw, 23px); font-weight: 700; line-height: 1.15; color: var(--ink); }
        
        .about-card {
            position: absolute;
            right: 46px; top: 42px; bottom: 42px; width: 492px;
            background: rgba(7,21,47,.55); border-radius: 23px; padding: 28px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 18px 35px rgba(0,0,0,.2), inset 0 1px 0 rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.13); transition: transform .3s ease, box-shadow .3s ease;
            z-index: 10;
            animation: rise .65s .25s both;
        }
        .about-card:hover {
            transform: translateY(-4px); box-shadow: 0 24px 45px rgba(0,0,0,.26), inset 0 1px 0 rgba(255,255,255,.14);
        }
        .about-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .about-title {
            margin: 0;
            font-size: 21px; font-weight: 750; letter-spacing: -.02em;
        }
        .about-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-settings {
            width: 34px; height: 34px; background: rgba(255,255,255,.12); color: #fff; border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 16px;
            transition: background .2s, transform .2s;
        }
        .btn-settings:hover {
            background: rgba(255,255,255,.22); transform: translateY(-2px);
        }
        .profile-text {
            font-size: 12px; font-weight: 700; color: var(--muted);
            color: #fff;
            margin-right: 6px;
        }
        .btn-social {
            width: 34px; height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            transition: transform .2s, filter .2s, box-shadow .2s;
        }
        .btn-social:hover {
            transform: translateY(-3px) scale(1.06); filter: brightness(1.15); box-shadow: 0 7px 14px rgba(0,0,0,.22);
        }
        .btn-social.youtube {
            background: #ff0000;
        }
        .btn-social.facebook {
            background: #3b5998;
        }
        .btn-social.community {
            background: #f39c12;
        }
        .btn-social.chat {
            background: #e5e5e5;
            color: #8e44ad;
        }
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            flex-grow: 1;
        }
        .btn-link {
            background: rgba(255,255,255,.1); color: #f7fbff; border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 650; font-size: 14px; padding: 8px 16px; height: 43px;
            box-shadow: inset 0 1px rgba(255,255,255,.1); transition: all .24s ease;
            text-align: center;
            border: 1px solid transparent;
        }
        .btn-link:hover {
            background: rgba(255,255,255,.95); color: #132d59; transform: translateY(-3px); box-shadow: 0 10px 18px rgba(0,0,0,.2); border-color: rgba(255,255,255,.7);
        }
        .btn-link.registration {
            background: linear-gradient(130deg, #b8f0d2, #7ee0c4); color: #123b3e; border: 1px solid rgba(255,255,255,.32);
            animation: pulse-green 3s infinite;
        }
        .btn-link.registration:hover {
            background: #c8e6c9;
            color: #1b5e20;
        }
        @keyframes pulse-green {
            0% {
                box-shadow: 0 0 0 0 rgba(46,125,50, 0.4);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(46,125,50, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(46,125,50, 0);
            }
        }
        
        .credentials { position: absolute; left: 62px; bottom: 8px; width: 430px; padding: 12px; background: rgba(5,17,41,.5); border: 1px solid rgba(255,255,255,.17); border-radius: 23px; box-shadow: 0 18px 34px rgba(0,0,0,.18), inset 0 1px rgba(255,255,255,.08); backdrop-filter: blur(14px); animation: rise .65s .35s both; }
        .form-heading { margin: 0 0 24px; color: #fff; font-size: 27px; font-weight: 750; letter-spacing: -.03em; }
        .field-group { margin-bottom: 18px; }
        .field-label { display: block; margin: 0 0 8px; color: var(--muted); font-size: 13px; letter-spacing: .04em; font-weight: 700; }
        .field { display: flex; align-items: center; height: 56px; background: rgba(255,255,255,.09); border: 1px solid rgba(255,255,255,.15); border-radius: 12px; position: relative; overflow: hidden; transition: border-color .24s, box-shadow .24s, background .24s, transform .24s; }
        .field:after { content: ''; position: absolute; height: 2px; bottom: 0; left: 0; width: 100%; background: linear-gradient(90deg, var(--accent), #9ab8ff); transform: scaleX(0); transform-origin: left; transition: transform .3s ease; }
        .field:focus-within { background: rgba(255,255,255,.14); border-color: rgba(134,230,194,.8); box-shadow: 0 0 0 4px rgba(134,230,194,.12), 0 9px 18px rgba(0,0,0,.14); transform: translateY(-2px); }
        .field:focus-within:after { transform: scaleX(1); }
        .field input { flex: 1; width: 100%; height: 100%; border: 0; outline: 0; padding: 0 16px; color: #fff; font-size: 16px; background: transparent; }
        .field input::placeholder { color: #a9b6ca; opacity: 1; transition: opacity .2s, transform .2s; }
        .field:focus-within input::placeholder { opacity: .55; transform: translateX(4px); }
        .password-toggle {
            display: flex; align-items: center; justify-content: center;
            width: 40px; height: 100%; border: 0; background: transparent; cursor: pointer;
            color: var(--muted); font-size: 15px; flex-shrink: 0;
        }
        .password-toggle:hover { color: var(--accent); }
        .form-options { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 4px 0 12px; }
        .remember-row { display: inline-flex; align-items: center; min-height: 32px; gap: 9px; color: #fff; font-size: 13px; font-weight: 700; cursor: pointer; }
        .remember-row input { position: absolute; opacity: 0; pointer-events: none; }
        .checkmark { width: 20px; height: 20px; display: grid; place-items: center; border: 2px solid rgba(255,255,255,.9); border-radius: 5px; background: rgba(255,255,255,.12); transition: background .18s, border-color .18s, box-shadow .18s; }
        .checkmark:after { content: ''; width: 5px; height: 10px; border: solid #17395f; border-width: 0 2px 2px 0; transform: rotate(45deg) scale(0); transition: transform .15s; }
        .remember-row input:checked + .checkmark { background: #ffc329; border-color: #ffc329; }
        .remember-row input:checked + .checkmark:after { transform: rotate(45deg) scale(1); }
        .remember-row input:focus-visible + .checkmark { box-shadow: 0 0 0 3px rgba(255,255,255,.35); }
        .forgot-link { color: #fff2b6; font-size: 13px; font-weight: 700; text-decoration: none; }
        .forgot-link:hover { color: #fff; text-decoration: underline; }
        .forgot-link:focus-visible, .submit:focus-visible, .password-toggle:focus-visible { outline: 3px solid #fff; outline-offset: 3px; }
        .submit { width: 100%; height: 54px; margin-top: 6px; border: 0; border-radius: 12px; background: linear-gradient(105deg, #8be4c1, #9cc3ff); color: #102744; font-size: 17px; font-weight: 850; cursor: pointer; box-shadow: 0 10px 20px rgba(58,198,168,.2); transition: transform .2s, filter .2s, box-shadow .2s; }
        .submit:hover { filter: brightness(1.08); transform: translateY(-3px); box-shadow: 0 15px 26px rgba(58,198,168,.32); }
        .submit:active { transform: translateY(2px) scale(.99); filter: brightness(.9); box-shadow: 0 2px 0 #754600, 0 3px 8px rgba(20,45,75,.2); }
        .submit:disabled { opacity: .7; cursor: not-allowed; transform: none; }
        .alerts { margin-bottom: 12px; font-size: 12px; color: #7d1010; background: #fff0f0; border: 1px solid #ffb7b7; border-radius: 8px; padding: 8px 10px; }
        .alerts ul { margin: 0; padding-left: 18px; }
        
        @media (max-width: 990px) {
            body { padding: 14px; align-items: flex-start; }
            .login-board { min-height: auto; padding: 34px 22px 28px; overflow: hidden; }
            .brand { height: auto; min-height: auto; margin: 0 0 24px; padding: 0 4px; text-align: center; }
            .brand-logo { position: relative; left: auto; top: auto; margin: 0 auto 14px; width: 74px; height: 74px; font-size: 29px; }
            .brand-title { font-size: clamp(24px, 8vw, 36px); white-space: normal; }
            .brand-rule { margin: 8px auto 7px; width: min(100%, 360px); }
            .brand-subtitle { font-size: clamp(17px, 5.5vw, 25px); }
            .about-card { position: relative; top: auto; right: auto; bottom: auto; width: min(100%, 492px); margin: 0 auto 24px; padding: 21px; min-height: auto; }
            .credentials { position: relative; left: auto; bottom: auto; width: min(100%, 430px); margin: 0 auto 24px; }
            .form-options { align-items: flex-start; flex-direction: column; gap: 2px; }
        }
        @media (max-width: 600px) {
            body { padding: 10px; }
            .login-board { width: 100%; padding: 28px 16px 20px; border-radius: 22px; }
            .brand { margin-bottom: 20px; }
            .brand-title { font-size: clamp(25px, 8vw, 34px); }
            .about-card, .credentials { width: 100%; border-radius: 18px; }
            .about-card { padding: 18px 14px; margin-bottom: 18px; }
            .credentials { padding: 21px 16px; margin-bottom: 0; }
            .about-header { align-items: flex-start; gap: 12px; margin-bottom: 15px; }
            .about-actions { flex-wrap: wrap; justify-content: flex-end; gap: 6px; }
            .profile-text, .btn-settings { display: none; }
            .about-grid { gap: 8px; }
            .btn-link { height: 42px; font-size: 13px; padding: 8px; }
        }
        @media (max-width: 360px) {
            .login-board { padding-inline: 12px; }
            .about-grid { grid-template-columns: 1fr; }
            .about-title { font-size: 19px; }
            .btn-social { width: 31px; height: 31px; }
        }
        @keyframes board-in { from { opacity: 0; transform: translateY(18px) scale(.985); } to { opacity: 1; transform: none; } }
        @keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes drift { to { transform: translate3d(35px, 24px, 0) scale(1.13); } }
        @keyframes sheen { 0%, 68% { transform: translateX(-130%); } 90%, 100% { transform: translateX(130%); } }
        @media (prefers-reduced-motion: reduce) { *, *:before, *:after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; } }
        @if(isset($appSettings))
        .about-card {
            background: {{ $appSettings->navbar_color }} !important;
        }
        .submit {
            background: linear-gradient(135deg, {{ $appSettings->header_color }} 0%, {{ $appSettings->navbar_color }} 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 0 rgba(0,0,0,0.15) !important;
        }
        @endif
    </style>
</head>
<body>
<main class="login-board" aria-label="MBC Bangladesh login">
    <section class="brand">
        <div class="brand-logo" aria-hidden="true" style="overflow:hidden; display:flex; align-items:center; justify-content:center;">
            @if(isset($appSettings) && $appSettings->logo)
                <img src="{{ asset($appSettings->logo) }}" alt="Logo" style="max-width:100%; max-height:100%; object-fit:contain;">
            @else
                MBC
            @endif
        </div>
        <div class="brand-title">{{ isset($appSettings) ? $appSettings->brand_name : 'MBC Bangladesh.com' }}</div>
        <div class="brand-rule"></div>
        <div class="brand-subtitle">Multiple Business Community</div>
    </section>

    <aside class="about-card">
        <div class="about-header">
            <h2 class="about-title">Explore MBC</h2>
            <div class="about-actions">
                <a href="#" class="btn-settings" title="Settings"><i class="fa fa-cog"></i></a>
                <span class="profile-text">Profile</span>
                <a href="{{ isset($appSettings) && $appSettings->social_youtube ? $appSettings->social_youtube : '#' }}" class="btn-social youtube" title="YouTube" target="_blank"><i class="fa fa-youtube-play"></i></a>
                <a href="{{ isset($appSettings) && $appSettings->social_facebook ? $appSettings->social_facebook : '#' }}" class="btn-social facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="{{ isset($appSettings) && $appSettings->social_messenger ? $appSettings->social_messenger : '#' }}" class="btn-social chat" title="Chat" target="_blank"><i class="fa fa-comment"></i></a>
            </div>
        </div>
        <div class="about-grid">
            <a href="#" class="btn-link">Land Project</a>
            <a href="#" class="btn-link">Our Flat</a>
            <a href="#" class="btn-link">E-Shop</a>
            <a href="#" class="btn-link">Hotel & Restaurant</a>
            <a href="#" class="btn-link">Father Shop</a>
            <a href="#" class="btn-link">Investment</a>
            <a href="#" class="btn-link">Packages</a>
        </div>
    </aside>

    <form class="credentials" method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <h2 class="form-heading">Member Login</h2>

        @if (session('status'))
            <div class="alerts" role="status">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alerts" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="field-group">
            <label class="field-label" for="loginInput">Email address</label>
            <div class="field">
                <input
                    type="email"
                    name="email"
                    id="loginInput"
                    value="{{ old('email') }}"
                    placeholder="name@example.com"
                    autocomplete="username"
                    autofocus
                    required
                >
            </div>
        </div>

        <div class="field-group">
            <label class="field-label" for="passwordInput">Password</label>
            <div class="field">
                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
                <button type="button" class="password-toggle" id="togglePassword" aria-label="Show password">
                    <i class="fa fa-eye" id="toggleIcon" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="form-options">
            <label class="remember-row" for="remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark" aria-hidden="true"></span>
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button class="submit" type="submit" id="loginBtn">Login</button>
    </form>
</main>
<script>
    // Disable submit button on form submit to prevent double-submits
    document.getElementById('loginForm').addEventListener('submit', function () {
        const button = document.getElementById('loginBtn');
        button.disabled = true;
        button.textContent = 'Logging in...';
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('toggleIcon');
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !isHidden);
        icon.classList.toggle('fa-eye-slash', isHidden);
        this.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
    });
</script>
</body>
</html>
