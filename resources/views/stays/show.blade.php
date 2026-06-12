<!DOCTYPE html>
<html lang="es-MX">
<head>
    @php
        $siteName = 'Visita Jalisco';
        $siteUrl = 'https://visitajalisco.mx';
        $pageUrl = $siteUrl . '/estancias/' . $code;
        $pageTitle = ($airbnb->tower ?: $airbnb->name) . ' | Guía cercana para huéspedes';
        $pageDescription = 'Negocios, servicios y recomendaciones cerca de ' . ($airbnb->tower ?: $airbnb->name) . ' para huéspedes con código de Airbnb.';
        $analyticsId = config('services.google_analytics.measurement_id');
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ $pageUrl }}">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $pageUrl }}">

    @if ($analyticsId)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $analyticsId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $analyticsId }}', {
                airbnb_code: '{{ $code }}',
                airbnb_tower: '{{ $airbnb->tower }}',
                airbnb_zone: '{{ $airbnb->zone?->slug }}'
            });
        </script>
    @endif

    <link rel="icon" type="image/png" href="/assets/img/logos/icon.png">
    <link rel="apple-touch-icon" href="/assets/img/logos/icon.png">
    <title>{{ $pageTitle }} | Visita Jalisco</title>

    <style>
        :root {
            --ink: #242424;
            --charcoal: #303030;
            --paper: #fffaf3;
            --green: #167a5a;
            --orange: #ff9f1c;
            --pink: #e91e63;
            --blue: #168aad;
            --muted: #6b665f;
            --line: rgba(36, 36, 36, .12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .topbar {
            min-height: 82px;
            background: #d6d6d6;
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 14px clamp(18px, 4vw, 72px);
        }

        .brand-mark {
            display: block;
            font-size: clamp(30px, 4vw, 46px);
            font-weight: 900;
            line-height: 1;
            text-transform: lowercase;
        }

        .brand-mark span:nth-child(1) { color: var(--green); }
        .brand-mark span:nth-child(2) { color: var(--orange); }
        .brand-mark span:nth-child(3) { color: var(--blue); }
        .brand-mark span:nth-child(4) { color: var(--pink); }
        .brand-mark span:nth-child(5) { color: var(--green); }
        .brand-mark span:nth-child(6) { color: var(--orange); }

        .brand-logo {
            display: block;
            width: clamp(142px, 16vw, 210px);
            height: auto;
        }

        .back-link {
            color: rgba(36, 36, 36, .78);
            font-weight: 700;
        }

        .hero {
            padding: clamp(58px, 8vw, 104px) clamp(20px, 6vw, 96px);
            background:
                linear-gradient(110deg, rgba(23, 63, 71, .95), rgba(22, 122, 90, .84)),
                url("/assets/img/hero-poster.svg");
            background-size: cover;
            color: #ffffff;
        }

        .hero-inner,
        .section-inner,
        .footer-inner {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .code-pill {
            display: inline-flex;
            margin-bottom: 22px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .14);
            color: rgba(255, 255, 255, .86);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .hero-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .hero-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            border-radius: 8px;
            background: #ffffff;
            color: var(--green);
            padding: 0 14px;
            font-weight: 900;
        }

        h1 {
            max-width: 900px;
            margin: 0;
            font-size: clamp(42px, 7vw, 86px);
            line-height: .95;
        }

        .hero p {
            max-width: 720px;
            margin: 22px 0 0;
            color: rgba(255, 255, 255, .78);
            font-size: clamp(18px, 2vw, 23px);
            line-height: 1.55;
        }

        .metrics-note {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 34px;
        }

        .metric {
            min-height: 112px;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 8px;
            padding: 18px;
            background: rgba(255, 255, 255, .08);
        }

        .metric strong {
            display: block;
            font-size: 20px;
        }

        .metric span {
            display: block;
            margin-top: 8px;
            color: rgba(255, 255, 255, .68);
            line-height: 1.45;
        }

        .section {
            padding: clamp(58px, 8vw, 104px) clamp(20px, 6vw, 96px);
        }

        .eyebrow {
            color: var(--green);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        h2 {
            max-width: 780px;
            margin: 12px 0 0;
            font-size: clamp(34px, 5vw, 58px);
            line-height: 1;
        }

        .lead {
            max-width: 720px;
            margin: 18px 0 0;
            color: var(--muted);
            font-size: 19px;
            line-height: 1.6;
        }

        .nearby-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 34px;
        }

        .business-card {
            position: relative;
            min-height: 250px;
            aspect-ratio: 16 / 11;
            border: 1px solid var(--line);
            border-radius: 8px;
            background-position: center;
            background-size: cover;
            box-shadow: 0 18px 50px rgba(36, 36, 36, .12);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
        }

        .business-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, 0) 34%, rgba(0, 0, 0, .84) 100%),
                linear-gradient(90deg, rgba(0, 0, 0, .36), rgba(0, 0, 0, 0) 52%);
            z-index: 0;
        }

        .business-content {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 80px 1fr;
            align-items: end;
            gap: 16px;
            padding: 18px;
            color: #ffffff;
        }

        .business-copy {
            min-width: 0;
        }

        .business-card .category {
            color: rgba(255, 255, 255, .84);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .business-card strong {
            display: block;
            margin-top: 5px;
            font-size: 24px;
            line-height: 1.08;
            text-shadow: 0 8px 22px rgba(0, 0, 0, .34);
        }

        .business-card p {
            margin: 6px 0 0;
            color: rgba(255, 255, 255, .82);
            line-height: 1.35;
            font-size: 14px;
        }

        .distance {
            display: inline-flex;
            color: rgba(255, 255, 255, .74);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .ad-slot {
            margin-top: 4px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 900;
        }

        .business-actions {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 999px;
            background: #25d366;
            color: #ffffff;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .24);
        }

        .whatsapp-button svg {
            width: 34px;
            height: 34px;
            fill: currentColor;
        }

        .directions-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            margin-top: 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .92);
            color: #173f47;
            padding: 0 12px;
            font-size: 13px;
            font-weight: 900;
        }

        .directions-link:hover {
            background: var(--orange);
            color: #211407;
        }

        .social-links {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 9px;
        }

        .social-link {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .18);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .social-link svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        .footer {
            padding: 34px clamp(20px, 6vw, 96px);
            background: #d6d6d6;
            color: rgba(36, 36, 36, .72);
        }

        .footer-inner {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .footer-logo {
            display: block;
            width: 74px;
            height: auto;
        }

        .creator-strip {
            padding: 9px 20px;
            background: #ffffff;
            color: rgba(36, 36, 36, .62);
            text-align: center;
            font-size: 12px;
            line-height: 1.2;
        }

        .creator-strip a {
            color: var(--pink);
            font-weight: 800;
        }

        @media (max-width: 980px) {
            .nearby-grid,
            .metrics-note {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .nearby-grid,
            .metrics-note {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a href="{{ url('/') }}" aria-label="Visita Jalisco inicio">
            <img class="brand-logo" src="/assets/img/logos/logo_visitajalisco_horizontal.png" alt="Visita Jalisco">
        </a>
        <a class="back-link" href="{{ url('/') }}">Volver al portal general</a>
    </header>

    <main>
        <section class="hero">
            <div class="hero-inner">
                <span class="code-pill">Código {{ $code }}</span>
                <h1>{{ $airbnb->headline ?: 'Tu guía cercana para moverte desde este Airbnb.' }}</h1>

            </div>
        </section>

        <section class="section">
            <div class="section-inner">
                <span class="eyebrow">{{ $zone->area ?: 'Zona cercana' }}</span>
                <h2>Lo que tienes cerca de tu Airbnb.</h2>
                <p class="lead">{{ $zone->summary }}</p>

                <div class="nearby-grid">
                    @foreach ($zone->businesses as $business)
                        <article class="business-card" style="background-image: url('{{ $business->imageUrl() }}');">
                            <div class="business-content">
                                <div class="business-actions">
                                    @if ($business->whatsappUrl())
                                        <a class="whatsapp-button" href="{{ route('track.businesses.whatsapp', $business) }}" target="_blank" rel="noopener" aria-label="Contactar por WhatsApp a {{ $business->name }}">
                                            <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false">
                                                <path d="M16.01 3.2c-7.05 0-12.78 5.73-12.78 12.78 0 2.25.59 4.45 1.72 6.38L3.12 29l6.8-1.78a12.7 12.7 0 0 0 6.09 1.55h.01c7.04 0 12.77-5.73 12.77-12.78S23.06 3.2 16.01 3.2Zm0 23.4h-.01a10.6 10.6 0 0 1-5.4-1.48l-.39-.23-4.04 1.06 1.08-3.94-.25-.4a10.57 10.57 0 0 1-1.62-5.63c0-5.86 4.77-10.63 10.64-10.63 2.84 0 5.51 1.11 7.52 3.12a10.56 10.56 0 0 1 3.11 7.52c0 5.86-4.77 10.62-10.64 10.62Zm5.83-7.96c-.32-.16-1.89-.93-2.18-1.04-.29-.11-.5-.16-.71.16-.21.32-.82 1.04-1.01 1.25-.19.21-.37.24-.69.08-.32-.16-1.35-.5-2.57-1.59-.95-.85-1.59-1.9-1.78-2.22-.19-.32-.02-.49.14-.65.15-.14.32-.37.48-.56.16-.19.21-.32.32-.53.11-.21.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.33-.26-.61-.52-.53-.71-.54h-.61c-.21 0-.56.08-.85.4-.29.32-1.12 1.09-1.12 2.66 0 1.57 1.15 3.09 1.31 3.3.16.21 2.27 3.46 5.49 4.85.77.33 1.37.53 1.84.68.77.24 1.47.21 2.03.13.62-.09 1.89-.77 2.16-1.52.27-.75.27-1.39.19-1.52-.08-.13-.29-.21-.61-.37Z"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                <div class="business-copy">
                                    <strong>{{ $business->name }}</strong>
                                    <p>{{ $business->distance }}</p>
                                    @if ($business->mapsUrl())
                                        <a class="directions-link" href="{{ route('track.businesses.directions', $business) }}" target="_blank" rel="noopener">Cómo llegar</a>
                                    @endif
                                    @if ($business->instagramUrl() || $business->facebookUrl() || $business->tiktokUrl())
                                        <div class="social-links" aria-label="Redes sociales de {{ $business->name }}">
                                            @if ($business->instagramUrl())
                                                <a class="social-link" href="{{ $business->instagramUrl() }}" target="_blank" rel="noopener" aria-label="Instagram de {{ $business->name }}">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7.8 2h8.4A5.8 5.8 0 0 1 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8A5.8 5.8 0 0 1 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2Zm0 2A3.8 3.8 0 0 0 4 7.8v8.4A3.8 3.8 0 0 0 7.8 20h8.4a3.8 3.8 0 0 0 3.8-3.8V7.8A3.8 3.8 0 0 0 16.2 4H7.8Zm8.7 2.2a1.3 1.3 0 1 1 0 2.6 1.3 1.3 0 0 1 0-2.6ZM12 7.3a4.7 4.7 0 1 1 0 9.4 4.7 4.7 0 0 1 0-9.4Zm0 2a2.7 2.7 0 1 0 0 5.4 2.7 2.7 0 0 0 0-5.4Z"/></svg>
                                                </a>
                                            @endif
                                            @if ($business->facebookUrl())
                                                <a class="social-link" href="{{ $business->facebookUrl() }}" target="_blank" rel="noopener" aria-label="Facebook de {{ $business->name }}">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M14 8.5V6.9c0-.8.2-1.2 1.3-1.2H17V2.2C16.7 2.1 15.6 2 14.4 2 11.8 2 10 3.6 10 6.5v2H7v3.9h3V22h4v-9.6h3.1l.5-3.9H14Z"/></svg>
                                                </a>
                                            @endif
                                            @if ($business->tiktokUrl())
                                                <a class="social-link" href="{{ $business->tiktokUrl() }}" target="_blank" rel="noopener" aria-label="TikTok de {{ $business->name }}">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M16.6 2c.4 3 2.1 4.8 5.1 5v3.4a8.2 8.2 0 0 1-5-1.6v6.5c0 4.2-2.6 6.7-6.5 6.7-3.6 0-6.5-2.8-6.5-6.3 0-4.2 4-7.3 8.1-6.1v3.7c-2-.6-4.3.6-4.3 2.4 0 1.5 1.2 2.6 2.8 2.6 1.7 0 2.6-1 2.6-3V2h3.7Z"/></svg>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <img class="footer-logo" src="/assets/img/logos/logo_visitajalisco_cuadrado.png" alt="Visita Jalisco">
            <span>{{ $airbnb->tower }} · {{ $airbnb->name }}</span>
        </div>
    </footer>

    <div class="creator-strip">
        página creada por <a href="https://cloudi.mx" target="_blank" rel="noopener">cloudi.mx</a>
    </div>
</body>
</html>
