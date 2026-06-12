<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="/assets/img/logos/icon.png">
    <link rel="apple-touch-icon" href="/assets/img/logos/icon.png">
    <title>@yield('title', 'Dashboard') | Visita Jalisco</title>
    <style>
        :root {
            --bg: #f7f8fa;
            --panel: #ffffff;
            --ink: #1d1f23;
            --muted: #68707d;
            --line: #e7e9ee;
            --green: #167a5a;
            --pink: #e91e63;
            --orange: #ff9f1c;
            --blue: #168aad;
            --shadow: 0 18px 50px rgba(20, 29, 42, .06);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input, textarea, select { font: inherit; }

        .app {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 260px 1fr;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            border-right: 1px solid var(--line);
            background: rgba(255, 255, 255, .82);
            backdrop-filter: blur(16px);
            padding: 22px;
        }

        .brand {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 28px;
        }

        .brand img {
            display: block;
            width: 178px;
            height: auto;
        }

        .brand strong {
            font-size: 20px;
            letter-spacing: 0;
        }

        .brand span {
            color: var(--muted);
            font-size: 13px;
        }

        .nav {
            display: grid;
            gap: 6px;
        }

        .nav a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 42px;
            padding: 0 12px;
            border-radius: 8px;
            color: var(--muted);
            font-weight: 700;
            font-size: 14px;
        }

        .nav a.active,
        .nav a:hover {
            background: #f0f4f2;
            color: var(--green);
        }

        .main {
            min-width: 0;
        }

        .topbar {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            border-bottom: 1px solid var(--line);
            background: rgba(247, 248, 250, .88);
            backdrop-filter: blur(14px);
            padding: 0 clamp(18px, 4vw, 42px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 14px;
        }

        .logout {
            border: 1px solid var(--line);
            background: #ffffff;
            color: var(--ink);
            min-height: 36px;
            padding: 0 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        .content {
            padding: clamp(22px, 4vw, 42px);
        }

        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: 0;
            line-height: 1;
        }

        .subhead {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.5;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            border: 0;
            border-radius: 8px;
            background: var(--ink);
            color: #ffffff;
            padding: 0 14px;
            font-weight: 800;
            cursor: pointer;
        }

        .button.secondary {
            background: #ffffff;
            color: var(--ink);
            border: 1px solid var(--line);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .card,
        .table-card,
        .form-card {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--panel);
            box-shadow: var(--shadow);
        }

        .card {
            padding: 20px;
        }

        .card span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .card strong {
            display: block;
            margin-top: 14px;
            font-size: 34px;
        }

        .split {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 18px;
        }

        .table-card {
            overflow: hidden;
        }

        .table-title {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
            font-weight: 900;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: top;
            font-size: 14px;
        }

        th {
            color: var(--muted);
            font-size: 12px;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        tr:last-child td { border-bottom: 0; }

        .pill {
            display: inline-flex;
            align-items: center;
            min-height: 24px;
            border-radius: 999px;
            padding: 0 9px;
            background: #edf8f3;
            color: var(--green);
            font-size: 12px;
            font-weight: 900;
        }

        .pill.paused {
            background: #fff2e1;
            color: #985b00;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .link-action {
            color: var(--blue);
            font-weight: 800;
            border: 0;
            background: transparent;
            padding: 0;
            cursor: pointer;
        }

        .form-card {
            padding: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        label {
            display: grid;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        input, textarea, select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #ffffff;
            color: var(--ink);
            padding: 11px 12px;
            outline: 0;
        }

        textarea {
            min-height: 116px;
            resize: vertical;
        }

        .full { grid-column: 1 / -1; }

        .check-row {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
        }

        .check-row input {
            width: auto;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .notice,
        .errors {
            margin-bottom: 18px;
            border-radius: 8px;
            padding: 12px 14px;
            background: #edf8f3;
            color: var(--green);
            font-weight: 800;
        }

        .errors {
            background: #fff0f5;
            color: #9f174b;
        }

        @media (max-width: 980px) {
            .app { grid-template-columns: 1fr; }
            .sidebar { position: static; height: auto; }
            .grid, .split, .form-grid { grid-template-columns: 1fr; }
            .page-head { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="app">
        @php
            $isAdmin = auth()->user()->isAdmin();
            $isAirbnb = auth()->user()->isAirbnb();
            $homeRoute = $isAdmin ? route('dashboard.index') : ($isAirbnb ? route('airbnb.dashboard') : route('business.dashboard'));
        @endphp

        <aside class="sidebar">
            <a class="brand" href="{{ $homeRoute }}">
                <img src="/assets/img/logos/logo_visitajalisco_horizontal.png" alt="Visita Jalisco">
                <span>{{ $isAdmin ? 'Administrador' : ($isAirbnb ? 'Panel Airbnb' : 'Panel de negocio') }}</span>
            </a>

            <nav class="nav" aria-label="Dashboard">
                @if ($isAdmin)
                    <a class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">Resumen</a>
                    <a class="{{ request()->routeIs('dashboard.zones.*') ? 'active' : '' }}" href="{{ route('dashboard.zones.index') }}">Zonas</a>
                    <a class="{{ request()->routeIs('dashboard.airbnbs.*') ? 'active' : '' }}" href="{{ route('dashboard.airbnbs.index') }}">Airbnbs</a>
                    <a class="{{ request()->routeIs('dashboard.businesses.*') ? 'active' : '' }}" href="{{ route('dashboard.businesses.index') }}">Negocios</a>
                    <a class="{{ request()->routeIs('dashboard.public-ads.*') ? 'active' : '' }}" href="{{ route('dashboard.public-ads.index') }}">Publicidad</a>
                    <a class="{{ request()->routeIs('dashboard.premium-services.*') ? 'active' : '' }}" href="{{ route('dashboard.premium-services.index') }}">Servicios premium</a>
                    <a class="{{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}" href="{{ route('dashboard.users.index') }}">Usuarios</a>
                @else
                    @if ($isAirbnb)
                        <a class="{{ request()->routeIs('airbnb.dashboard') ? 'active' : '' }}" href="{{ route('airbnb.dashboard') }}">Mis Airbnbs</a>
                    @else
                        <a class="{{ request()->routeIs('business.dashboard') ? 'active' : '' }}" href="{{ route('business.dashboard') }}">Mis negocios</a>
                    @endif
                @endif
                <a href="{{ url('/') }}" target="_blank" rel="noopener">Ver sitio</a>
            </nav>
        </aside>

        <div class="main">
            <header class="topbar">
                <div class="user-chip">
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>{{ auth()->user()->role }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout" type="submit">Cerrar sesión</button>
                </form>
            </header>

            <main class="content">
                @if (session('status'))
                    <div class="notice">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="errors">
                        {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
