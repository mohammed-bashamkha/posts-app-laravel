<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <style>
        :root{
            --bg: #f7fafc;
            --panel:#ffffff;
            --muted:#6b7280;
            --accent:#2563eb;
            --radius:10px;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        }
        *{box-sizing:border-box}
        html,body{height:100%;margin:0;background:var(--bg);color:#0f172a;font-size:15px;line-height:1.5}
        a{color:inherit;text-decoration:none}
        .app{min-height:100vh;display:flex;flex-direction:column}

        /* Header */
        .header{
            background:linear-gradient(90deg, rgba(37,99,235,0.06), rgba(99,102,241,0.04));
            border-bottom:1px solid rgba(15,23,42,0.04);
            padding:14px 20px;
        }
        .nav{max-width:1100px;margin:0 auto;display:flex;align-items:center;gap:12px}
        .brand{display:flex;align-items:center;gap:10px}
        .logo{
            width:40px;height:40px;border-radius:8px;
            background:linear-gradient(135deg,var(--accent),#1e40af);
            color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700
        }
        .links{margin-left:auto;display:flex;gap:8px}
        .links a{padding:8px 12px;border-radius:8px;color:var(--muted);font-weight:600}
        .links a:hover{background:rgba(255,255,255,0.6);color:var(--accent)}

        /* Main */
        .main{max-width:1100px;margin:28px auto;padding:0 20px;flex:1;width:100%}
        .panel{background:var(--panel);border-radius:var(--radius);padding:20px;box-shadow:0 8px 24px rgba(12,18,36,0.06)}
        .page-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px}
        .page-title{font-weight:700;font-size:20px}
        .page-sub{color:var(--muted);font-size:13px;margin-top:6px}

        /* Alerts */
        .alerts{display:flex;flex-direction:column;gap:10px;margin-bottom:16px}
        .alert{padding:12px 14px;border-radius:10px;font-weight:600}
        .alert.success{background:#ecfdf5;color:#065f46}
        .alert.error{background:#fff1f2;color:#7f1d1d}

        /* Footer */
        .footer{text-align:center;padding:18px;color:var(--muted);font-size:13px;margin-top:28px}

        @media (max-width:700px){
            .page-head{flex-direction:column;gap:12px}
            .links{gap:6px}
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="app">

    <header class="header">
        <nav class="nav" aria-label="Main navigation">
            <a href="{{ url('/') }}" class="brand" aria-label="{{ config('app.name','Laravel') }}">
                <div class="logo">{{ strtoupper(substr(config('app.name','APP'),0,2)) }}</div>
                <div>{{ config('app.name','Laravel') }}</div>
            </a>

            <div class="links" role="navigation" aria-label="Links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('posts.index') }}">Posts</a>
                <a href="{{ route('posts.trashed') }}">Trashed</a>
            </div>
        </nav>
    </header>

    <main class="main"></main>
        @if(session('success') || session('error'))
            <div class="alerts" aria-live="polite">
                @if(session('success'))
                    <div class="alert success panel">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert error panel">{{ session('error') }}</div>
                @endif
            </div>
        @endif

        <section class="panel" role="region" aria-labelledby="page-title">
            <div class="page-head">
                <div>
                    <div id="page-title" class="page-title">@yield('page_title','Dashboard')</div>
                </div>
                <div>
                    @yield('page_actions')
                </div>
            </div>

            @yield('content')
        </section>
    </main>

    <footer class="footer">
        &copy; {{ date('Y') }} {{ config('app.name','Laravel') }}
    </footer>

</div>

@stack('scripts')
</body>
</html>
