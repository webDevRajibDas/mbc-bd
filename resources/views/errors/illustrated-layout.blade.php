<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', __('Error')) - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#6478e8; --secondary:#754daf; --ink:#15233a; --text:#637795; --muted:#8da2bf; }
        * { box-sizing:border-box; }
        body { min-width:320px; margin:0; color:var(--ink); background:linear-gradient(115deg,#667de2,#754ca9); font-family:Inter,Arial,sans-serif; }
        .page { min-height:100vh; display:grid; place-items:center; padding:32px 20px; }
        .card { width:min(1100px,100%); min-height:600px; display:grid; grid-template-columns:1fr 1fr; overflow:hidden; border-radius:24px; background:#fff; box-shadow:0 25px 45px rgba(32,39,96,.24); }
        .content { padding:60px 48px 42px; display:flex; flex-direction:column; justify-content:center; }
        .code { margin:0 0 22px; color:#6b68d2; font-size:clamp(92px,10vw,132px); font-weight:900; letter-spacing:-7px; line-height:.76; }
        h1 { margin:0; font-size:32px; line-height:1.25; }
        .rule { width:80px; height:4px; margin:38px 0 28px; border-radius:4px; background:var(--primary); }
        .message { margin:0 0 17px; color:var(--text); font-size:18px; }
        .description { max-width:455px; margin:0 0 34px; color:var(--muted); font-size:15px; line-height:1.65; }
        .actions { display:flex; flex-wrap:wrap; gap:16px; }
        .button { display:inline-flex; align-items:center; justify-content:center; gap:9px; min-height:56px; padding:0 27px; border:2px solid var(--primary); border-radius:11px; color:var(--primary); background:#fff; font-size:15px; font-weight:700; text-decoration:none; transition:.2s ease; }
        .button:hover { transform:translateY(-2px); box-shadow:0 7px 16px rgba(83,95,190,.18); }
        .button--primary { border-color:transparent; color:#fff; background:linear-gradient(105deg,var(--primary),var(--secondary)); }
        .additional { margin-top:32px; padding-top:25px; border-top:1px solid #dce3ee; }
        .quick-title { display:block; font-size:15px; }
        .search { display:flex; gap:9px; margin-top:18px; }
        .search input { min-width:0; flex:1; height:46px; padding:0 16px; border:2px solid #dde4ef; border-radius:11px; outline:0; color:var(--ink); font:inherit; }
        .search input:focus { border-color:var(--primary); }
        .search button { width:61px; border:0; border-radius:11px; color:#fff; background:var(--primary); font-size:19px; cursor:pointer; }
        .links { margin-top:26px; }
        .links a { margin-right:20px; color:#5873e9; font-size:15px; font-weight:600; text-decoration:none; }
        .custom-content { margin-top:20px; }
        .art { position:relative; overflow:hidden; background:linear-gradient(135deg,#f8f9ff,#f0f3ff); }
        .art::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 76% 23%,rgba(113,139,233,.13) 0 74px,transparent 75px),radial-gradient(circle at -5% 70%,rgba(114,80,180,.12) 0 50px,transparent 51px),radial-gradient(circle at 67% 85%,rgba(113,139,233,.13) 0 40px,transparent 41px); }
        .art-content { position:relative; z-index:1; width:100%; height:100%; }
        .art-content img, .art-content > div { max-width:100%; }
        @media (max-width:720px) { .page { padding:18px; } .card { grid-template-columns:1fr; } .content { padding:48px 28px 34px; } .art { min-height:160px; order:-1; } .code { font-size:96px; } .rule { margin:28px 0 22px; } }
    </style>
</head>
<body>
    <main class="page">
        <section class="card" aria-labelledby="error-title">
            <div class="content">
                <div class="code">@yield('code', 'Error')</div>
                <h1 id="error-title">@yield('title', __('Something went wrong'))</h1>
                <div class="rule"></div>
                <p class="message">@yield('message', __('Something went wrong.'))</p>
                <p class="description">@yield('description', __('Please try again in a moment. If the problem persists, contact the system administrator.'))</p>
                <div class="actions">
                    <a class="button button--primary" href="{{ app('router')->has('home') ? route('home') : url('/') }}"><span aria-hidden="true">⌂</span> {{ __('Back to Dashboard') }}</a>
                    <a class="button" href="javascript:history.back()"><span aria-hidden="true">←</span> {{ __('Go Back') }}</a>
                </div>
                @hasSection('additional_content')
                    <div class="custom-content">@yield('additional_content')</div>
                @endif
                <div class="additional">
                    <strong class="quick-title">{{ __('Quick Search') }}</strong>
                    <form class="search" action="{{ url('/search') }}" method="get">
                        <input type="search" name="q" placeholder="{{ __('Search') }}..." aria-label="{{ __('Search') }}">
                        <button type="submit" aria-label="{{ __('Search') }}">⌕</button>
                    </form>
                    <div class="links">
                        <strong class="quick-title">{{ __('Quick Links') }}</strong>
                        <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">{{ __('Dashboard') }}</a>
                    </div>
                </div>
            </div>
            <div class="art" aria-hidden="true"><div class="art-content">@yield('image')</div></div>
        </section>
    </main>
</body>
</html>
