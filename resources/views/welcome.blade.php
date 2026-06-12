<!DOCTYPE html>
<html lang="es-MX">
<head>
    @php
        $siteName = 'Visita Jalisco';
        $siteUrl = 'https://visitajalisco.mx';
        $siteDescription = 'Visita Jalisco conecta turistas con hospedajes Airbnb, rutas, servicios y negocios locales cercanos a su estancia.';
        $analyticsId = config('services.google_analytics.measurement_id');
        $heroImage = $siteUrl . '/assets/img/hero-poster.svg';
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristInformationCenter',
            'name' => $siteName,
            'url' => $siteUrl,
            'description' => $siteDescription,
            'areaServed' => [
                '@type' => 'AdministrativeArea',
                'name' => 'Jalisco, México',
            ],
            'knowsAbout' => [
                'Hospedaje Airbnb en Jalisco',
                'Negocios locales en Jalisco',
                'Rutas turísticas en Jalisco',
                'Servicios para turistas',
            ],
            'sameAs' => [
                'https://visitajalisco.mx',
            ],
        ];
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $siteDescription }}">
    <meta name="keywords" content="Visita Jalisco, turismo Jalisco, Airbnb Jalisco, hospedaje Jalisco, negocios locales Jalisco, rutas turisticas Jalisco, guia turistica Jalisco">
    <meta name="author" content="Visita Jalisco">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="theme-color" content="#167a5a">
    <link rel="canonical" href="{{ $siteUrl }}">
    <link rel="icon" type="image/png" href="/assets/img/logos/icon.png">
    <link rel="apple-touch-icon" href="/assets/img/logos/icon.png">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="Visita Jalisco | Hospedaje, rutas y negocios locales">
    <meta property="og:description" content="{{ $siteDescription }}">
    <meta property="og:url" content="{{ $siteUrl }}">
    <meta property="og:image" content="{{ $heroImage }}">
    <meta property="og:image:alt" content="Paisaje visual de Jalisco para turistas">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Visita Jalisco | Hospedaje, rutas y negocios locales">
    <meta name="twitter:description" content="{{ $siteDescription }}">
    <meta name="twitter:image" content="{{ $heroImage }}">

    @if ($analyticsId)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $analyticsId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $analyticsId }}');
        </script>
    @endif

    <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <title>Visita Jalisco | Hospedaje, rutas y comercios locales</title>

    <style>
        :root {
            --ink: #242424;
            --charcoal: #303030;
            --paper: #fffaf3;
            --cream: #f7efe3;
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

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .site-shell {
            min-height: 100vh;
            overflow: hidden;
            width: 100%;
            max-width: 100vw;
        }

        .topbar {
            position: fixed;
            z-index: 20;
            top: 0;
            left: 0;
            width: 100%;
            height: 86px;
            background: #d6d6d6;
            color: var(--ink);
            display: flex;
            align-items: center;
            padding: 0 clamp(18px, 4vw, 72px);
            gap: clamp(18px, 3vw, 48px);
        }

        .brand {
            display: flex;
            align-items: center;
            min-width: 210px;
            line-height: 1;
        }

        .brand-logo {
            display: block;
            width: clamp(142px, 14vw, 210px);
            height: auto;
        }

        .brand-mark {
            display: block;
            font-size: clamp(30px, 4vw, 46px);
            font-weight: 900;
            letter-spacing: 0;
            text-transform: lowercase;
        }

        .brand-mark span:nth-child(1) { color: var(--green); }
        .brand-mark span:nth-child(2) { color: var(--orange); }
        .brand-mark span:nth-child(3) { color: var(--blue); }
        .brand-mark span:nth-child(4) { color: var(--pink); }
        .brand-mark span:nth-child(5) { color: var(--green); }
        .brand-mark span:nth-child(6) { color: var(--orange); }

        .brand-tagline {
            display: block;
            margin-top: 4px;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            letter-spacing: .04em;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex: 1;
            gap: 18px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: clamp(18px, 3vw, 44px);
            width: 100%;
        }

        .nav a {
            font-size: clamp(14px, 1.15vw, 19px);
            color: rgba(36, 36, 36, .78);
        }

        .nav a.active {
            color: var(--ink);
            font-weight: 800;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 18px;
            white-space: nowrap;
        }

        .code-form {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 999px;
            background: rgba(255, 255, 255, .08);
        }

        .code-form input {
            width: 158px;
            height: 34px;
            border: 0;
            border-radius: 999px;
            background: rgba(255, 255, 255, .95);
            color: var(--ink);
            padding: 0 14px;
            font-size: 13px;
            outline: 0;
            text-transform: uppercase;
        }

        .code-form input::placeholder {
            color: rgba(36, 36, 36, .58);
            text-transform: none;
        }

        .code-form button {
            height: 34px;
            border: 0;
            border-radius: 999px;
            padding: 0 14px;
            background: var(--orange);
            color: #ffffff;
            font-weight: 800;
            font-size: 13px;
            cursor: pointer;
        }

        .code-error {
            position: fixed;
            z-index: 30;
            top: 98px;
            right: clamp(18px, 4vw, 72px);
            max-width: 360px;
            padding: 12px 14px;
            border-radius: 8px;
            background: #ffffff;
            color: #8a123f;
            box-shadow: 0 18px 60px rgba(0, 0, 0, .18);
            font-size: 14px;
        }

        .hero {
            position: relative;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 130px clamp(20px, 7vw, 120px) 72px;
            color: #ffffff;
        }

        .hero-video,
        .hero-fallback,
        .hero-tint {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .hero-video {
            object-fit: cover;
            z-index: 0;
        }

        .hero-fallback {
            z-index: -1;
            background:
                linear-gradient(90deg, rgba(10, 56, 76, .35), rgba(8, 80, 91, .14)),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cdefs%3E%3ClinearGradient id='sky' x1='0' x2='1' y1='0' y2='1'%3E%3Cstop stop-color='%230d4f64'/%3E%3Cstop offset='.42' stop-color='%238cc6d8'/%3E%3Cstop offset='1' stop-color='%230e766f'/%3E%3C/linearGradient%3E%3Cfilter id='blur'%3E%3CfeGaussianBlur stdDeviation='30'/%3E%3C/filter%3E%3C/defs%3E%3Crect width='1600' height='900' fill='url(%23sky)'/%3E%3Cg opacity='.46' filter='url(%23blur)'%3E%3Cpath d='M112 0h150l-82 900H10zM470 0h105l-50 900H390zM920 0h205l-132 900H800zM1320 0h190l-160 900h-105z' fill='%23d8f5ff'/%3E%3C/g%3E%3Cg opacity='.22'%3E%3Ccircle cx='790' cy='430' r='150' fill='%231b1b1b'/%3E%3Cpath d='M780 300c42 80 67 174 75 284 4 60-36 128-90 130-58 2-92-78-82-138 14-92 39-176 97-276z' fill='%23f4efe7'/%3E%3C/g%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
            animation: slow-pan 18s ease-in-out infinite alternate;
        }

        .hero-tint {
            z-index: 1;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, .28), rgba(0, 0, 0, .08) 42%, rgba(0, 0, 0, .28)),
                linear-gradient(90deg, rgba(0, 0, 0, .12), rgba(0, 0, 0, .02));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: minmax(220px, 440px) minmax(280px, 470px);
            align-items: center;
            gap: clamp(28px, 6vw, 72px);
            width: min(1080px, 100%);
            margin-top: 40px;
        }

        .hero-title {
            font-size: clamp(48px, 8vw, 96px);
            line-height: .92;
            font-weight: 900;
            letter-spacing: 0;
            text-transform: uppercase;
            text-shadow: 0 14px 34px rgba(0, 0, 0, .28);
        }

        .hero-card {
            position: relative;
            width: min(470px, 100%);
            min-height: 230px;
            display: flex;
            align-items: center;
            background: var(--orange);
            padding: clamp(28px, 4vw, 48px);
            color: #ffffff;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            left: -24px;
            top: 54px;
            width: 0;
            height: 0;
            border-top: 24px solid transparent;
            border-bottom: 24px solid transparent;
            border-right: 24px solid var(--orange);
        }

        .hero-card p {
            margin: 0;
            font-size: clamp(22px, 2.4vw, 31px);
            line-height: 1.35;
            letter-spacing: 0;
        }

        .hero-quick {
            position: absolute;
            z-index: 3;
            right: clamp(20px, 4vw, 62px);
            bottom: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-button {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            border: 0;
            background: rgba(255, 255, 255, .92);
            color: var(--blue);
            display: grid;
            place-items: center;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(0, 0, 0, .18);
        }

        .scroll-top {
            border-radius: 0;
            background: rgba(43, 43, 43, .94);
            color: #ffffff;
        }

        .section {
            padding: clamp(64px, 8vw, 112px) clamp(20px, 6vw, 96px);
        }

        .section-inner {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .eyebrow {
            color: var(--green);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .section h2 {
            margin: 12px 0 0;
            max-width: 780px;
            font-size: clamp(34px, 5vw, 64px);
            line-height: 1;
            letter-spacing: 0;
        }

        .section-lead {
            max-width: 720px;
            margin: 20px 0 0;
            color: var(--muted);
            font-size: clamp(17px, 1.7vw, 21px);
            line-height: 1.6;
        }

        .feature-grid,
        .visit-grid,
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 36px;
        }

        .feature,
        .step {
            min-height: 230px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #ffffff;
            padding: 24px;
            box-shadow: 0 18px 50px rgba(36, 36, 36, .06);
        }

        .visit-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .visit-card {
            position: relative;
            display: block;
            min-height: 280px;
            overflow: hidden;
            border-radius: 8px;
            background: var(--dark);
            box-shadow: 0 20px 55px rgba(36, 36, 36, .12);
        }

        .visit-card img {
            width: 100%;
            height: 100%;
            min-height: 280px;
            display: block;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .visit-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 38%, rgba(0, 0, 0, .76) 100%);
        }

        .visit-card strong {
            position: absolute;
            left: 22px;
            right: 22px;
            bottom: 20px;
            z-index: 1;
            color: #ffffff;
            font-size: 24px;
            line-height: 1.1;
        }

        .visit-card:hover img {
            transform: scale(1.04);
        }

        .services-band {
            background:
                radial-gradient(circle at 18% 0%, rgba(255, 159, 28, .18), transparent 32%),
                radial-gradient(circle at 86% 12%, rgba(22, 138, 173, .16), transparent 34%),
                #171717;
            color: #ffffff;
        }

        .services-band .eyebrow {
            color: var(--orange);
        }

        .services-band h2 {
            max-width: 860px;
            color: #ffffff;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 34px;
        }

        .service-card {
            position: relative;
            display: flex;
            min-height: 310px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 8px;
            background: #242424;
            box-shadow: 0 22px 70px rgba(0, 0, 0, .24);
        }

        .service-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: .64;
            transition: transform .35s ease, opacity .35s ease;
        }

        .service-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, .08), rgba(0, 0, 0, .84)),
                linear-gradient(135deg, rgba(255, 159, 28, .12), rgba(22, 122, 90, .16));
        }

        .service-card-content {
            position: relative;
            z-index: 1;
            align-self: flex-end;
            width: 100%;
            padding: 20px;
        }

        .service-card span {
            display: inline-flex;
            margin-bottom: 12px;
            padding: 6px 9px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .16);
            color: #ffffff;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .service-card strong {
            display: block;
            color: #ffffff;
            font-size: 23px;
            line-height: 1.05;
        }

        .service-card p {
            margin: 10px 0 0;
            color: rgba(255, 255, 255, .74);
            font-size: 14px;
            line-height: 1.45;
        }

        .service-contact {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            margin-top: 14px;
            border-radius: 999px;
            background: #25d366;
            color: #062f17;
            padding: 0 14px;
            font-size: 13px;
            font-weight: 900;
        }

        .service-contact:hover {
            background: #ffffff;
            color: #128c4a;
        }

        .service-card:hover img {
            opacity: .78;
            transform: scale(1.04);
        }

        .feature {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .airbnb-card {
            min-height: 360px;
            padding: 0;
            overflow: hidden;
        }

        .airbnb-card-media {
            position: relative;
            min-height: 205px;
            background: #111a3d;
            overflow: hidden;
        }

        .airbnb-card-media::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, .06), rgba(0, 0, 0, .18));
            pointer-events: none;
        }

        .airbnb-slide {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity .28s ease;
        }

        .airbnb-slide.is-active {
            opacity: 1;
        }

        .airbnb-badge {
            position: absolute;
            z-index: 2;
            top: 12px;
            left: 12px;
            display: inline-flex;
            border-radius: 4px;
            background: #111a3d;
            color: #ffffff;
            padding: 7px 9px;
            font-size: 12px;
            font-weight: 900;
        }

        .airbnb-heart {
            position: absolute;
            z-index: 2;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: #ffffff;
            color: #e91e63;
            font-size: 22px;
            line-height: 1;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .16);
        }

        .airbnb-arrow {
            position: absolute;
            z-index: 2;
            top: 50%;
            border: 0;
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(17, 26, 61, .78);
            color: #ffffff;
            transform: translateY(-50%);
            font-size: 24px;
            line-height: 1;
            cursor: pointer;
        }

        .airbnb-arrow.prev {
            left: 12px;
        }

        .airbnb-arrow.next {
            right: 12px;
        }

        .airbnb-card-body {
            padding: 18px 18px 20px;
        }

        .airbnb-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .airbnb-card .zone {
            margin-top: 10px;
            color: #111a3d;
            font-size: 14px;
            line-height: 1.25;
        }

        .airbnb-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .airbnb-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 24px;
            border-radius: 4px;
            background: #111a3d;
            color: #ffffff;
            padding: 0 9px;
            font-size: 13px;
            font-weight: 900;
        }

        .airbnb-action.secondary {
            background: rgba(22, 122, 90, .1);
            color: var(--green);
        }

        .airbnb-card .card-link,
        .airbnb-card .media-link {
            color: inherit;
        }

        .feature strong,
        .step strong {
            display: block;
            font-size: 22px;
            line-height: 1.1;
        }

        .feature p,
        .step p {
            margin: 14px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.55;
        }

        .feature .number {
            color: var(--pink);
            font-size: 48px;
            font-weight: 900;
            line-height: 1;
        }

        .airbnb-band {
            background: #173f47;
            color: #ffffff;
        }

        .airbnb-layout {
            display: grid;
            grid-template-columns: minmax(280px, .9fr) minmax(320px, 1.1fr);
            gap: clamp(28px, 5vw, 64px);
            align-items: center;
        }

        .photo-stack {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .photo-tile {
            min-height: 270px;
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(22, 122, 90, .9), rgba(22, 138, 173, .65)),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 700 900'%3E%3Crect width='700' height='900' fill='%23d7c6ad'/%3E%3Cpath d='M0 380h700v520H0z' fill='%23364f4f'/%3E%3Cpath d='M120 170h460v730H120z' fill='%23f5efe5'/%3E%3Cg fill='%23222' opacity='.18'%3E%3Crect x='160' y='230' width='84' height='90'/%3E%3Crect x='310' y='230' width='84' height='90'/%3E%3Crect x='460' y='230' width='84' height='90'/%3E%3Crect x='160' y='390' width='84' height='90'/%3E%3Crect x='310' y='390' width='84' height='90'/%3E%3Crect x='460' y='390' width='84' height='90'/%3E%3Crect x='160' y='550' width='84' height='90'/%3E%3Crect x='310' y='550' width='84' height='90'/%3E%3Crect x='460' y='550' width='84' height='90'/%3E%3C/g%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
        }

        .photo-tile:nth-child(2) {
            margin-top: 52px;
            background:
                linear-gradient(135deg, rgba(255, 159, 28, .88), rgba(233, 30, 99, .62)),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 700 900'%3E%3Crect width='700' height='900' fill='%23f4eadb'/%3E%3Cpath d='M80 620h540v140H80z' fill='%232f2f2f'/%3E%3Cpath d='M120 190h460v430H120z' fill='%23ffffff'/%3E%3Cpath d='M170 255h360v300H170z' fill='%23b9d8df'/%3E%3Ccircle cx='530' cy='164' r='52' fill='%23ff9f1c'/%3E%3C/svg%3E");
            background-size: cover;
        }

        .airbnb-copy .eyebrow,
        .airbnb-copy .section-lead {
            color: rgba(255, 255, 255, .78);
        }

        .airbnb-copy h2 {
            color: #ffffff;
        }

        .nearby-list {
            display: grid;
            gap: 12px;
            margin-top: 26px;
        }

        .nearby-item {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .18);
            font-size: 18px;
        }

        .nearby-item span {
            color: rgba(255, 255, 255, .66);
        }

        .places-band {
            position: relative;
            width: 100%;
            max-width: 100vw;
            min-height: 520px;
            overflow: hidden;
            display: flex;
            align-items: center;
            color: #ffffff;
            padding: 64px 20px;
        }

        .places-video,
        .places-shade {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .places-video {
            object-fit: cover;
            z-index: 0;
        }

        .places-shade {
            z-index: 1;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, .58)),
                linear-gradient(90deg, rgba(0, 0, 0, .42), rgba(0, 0, 0, .08) 50%, rgba(0, 0, 0, .42));
        }

        .places-shell {
            position: relative;
            z-index: 2;
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .places-title {
            margin: 0 0 30px;
            text-align: center;
            font-size: clamp(32px, 4vw, 52px);
            line-height: 1;
            font-weight: 900;
        }

        .places-frame {
            position: relative;
            overflow: hidden;
            padding: 0 58px;
        }

        .places-track {
            display: flex;
            gap: 18px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            padding-bottom: 4px;
        }

        .places-track::-webkit-scrollbar {
            display: none;
        }

        .place-card {
            position: relative;
            flex: 0 0 220px;
            height: 220px;
            border-radius: 8px;
            overflow: hidden;
            scroll-snap-align: start;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, .82) 100%),
                var(--place-image),
                linear-gradient(135deg, var(--place-a), var(--place-b));
            background-size: cover;
            background-position: center;
            box-shadow: 0 20px 42px rgba(0, 0, 0, .22);
        }

        .place-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, .04), rgba(0, 0, 0, .16));
        }

        .place-card strong {
            position: absolute;
            left: 18px;
            right: 54px;
            bottom: 20px;
            z-index: 1;
            font-size: 18px;
            line-height: 1.08;
        }

        .place-card span {
            position: absolute;
            right: 14px;
            bottom: 16px;
            z-index: 1;
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: #ffffff;
            color: #111a3d;
            font-size: 22px;
        }

        .places-arrow {
            position: absolute;
            top: 50%;
            z-index: 3;
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 999px;
            background: #ffffff;
            color: #111a3d;
            transform: translateY(-50%);
            font-size: 30px;
            line-height: 1;
            cursor: pointer;
            box-shadow: 0 16px 34px rgba(0, 0, 0, .24);
        }

        .places-arrow.prev {
            left: 0;
        }

        .places-arrow.next {
            right: 0;
        }

        .footer {
            padding: 46px clamp(20px, 6vw, 96px);
            background: #d6d6d6;
            color: rgba(36, 36, 36, .72);
        }

        .footer-inner {
            width: min(1180px, 100%);
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.3fr repeat(3, minmax(150px, 1fr));
            gap: 28px;
        }

        .footer strong {
            display: block;
            color: var(--ink);
            font-size: 19px;
            margin-bottom: 10px;
        }

        .footer-logo {
            display: block;
            width: 92px;
            height: auto;
            margin-bottom: 14px;
        }

        .footer p {
            margin: 0;
            max-width: 420px;
            line-height: 1.55;
        }

        .footer h3 {
            margin: 0 0 12px;
            color: var(--ink);
            font-size: 13px;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .footer a,
        .footer span {
            display: block;
            margin-top: 8px;
            color: rgba(36, 36, 36, .72);
            font-size: 14px;
        }

        .footer a:hover {
            color: var(--ink);
        }

        .footer-note {
            margin-top: 18px;
            color: rgba(36, 36, 36, .58);
            font-size: 13px;
        }

        .cookie-banner {
            position: fixed;
            z-index: 40;
            left: clamp(14px, 3vw, 28px);
            right: clamp(14px, 3vw, 28px);
            bottom: 18px;
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            width: min(980px, calc(100vw - 28px));
            margin: 0 auto;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 8px;
            background: rgba(31, 31, 31, .96);
            color: rgba(255, 255, 255, .82);
            box-shadow: 0 22px 80px rgba(0, 0, 0, .22);
        }

        .cookie-banner.is-visible {
            display: flex;
        }

        .cookie-banner p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .cookie-banner a {
            color: #ffffff;
            font-weight: 800;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .cookie-actions {
            display: flex;
            gap: 10px;
            flex: 0 0 auto;
        }

        .cookie-actions button {
            min-height: 38px;
            border: 0;
            border-radius: 8px;
            padding: 0 14px;
            background: var(--orange);
            color: #211407;
            font-weight: 900;
            cursor: pointer;
        }

        .cookie-actions button.secondary {
            border: 1px solid rgba(255, 255, 255, .24);
            background: transparent;
            color: #ffffff;
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

        @keyframes slow-pan {
            from {
                transform: scale(1.02) translateX(-1%);
            }
            to {
                transform: scale(1.08) translateX(1%);
            }
        }

        @media (max-width: 980px) {
            .topbar {
                height: auto;
                min-height: 76px;
                align-items: flex-start;
                padding-block: 14px;
            }

            .nav {
                justify-content: flex-end;
            }

            .nav-links {
                display: none;
            }

            .nav-actions {
                align-items: flex-end;
                flex-direction: column;
                gap: 8px;
            }

            .hero-content,
            .airbnb-layout {
                grid-template-columns: 1fr;
            }

            .hero-content {
                place-items: start;
            }

            .hero-card::before {
                left: 34px;
                top: -24px;
                border-left: 24px solid transparent;
                border-right: 24px solid transparent;
                border-bottom: 24px solid var(--orange);
                border-top: 0;
            }

            .feature-grid,
            .airbnb-grid,
            .visit-grid,
            .steps-grid {
                grid-template-columns: 1fr;
            }

            .service-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .footer-inner {
                grid-template-columns: 1fr 1fr;
            }

            .places-shell {
                width: min(760px, 100%);
            }

            .places-frame {
                padding: 0 50px;
            }
        }

        @media (max-width: 640px) {
            .brand {
                min-width: 0;
            }

            .brand-tagline,
            .nav-actions span {
                display: none;
            }

            .code-form input {
                width: min(42vw, 142px);
            }

            .hero {
                min-height: 92vh;
                padding-top: 112px;
            }

            .hero-card {
                min-height: 190px;
            }

            .hero-quick {
                left: 20px;
                right: auto;
                bottom: 24px;
            }

            .photo-stack {
                grid-template-columns: 1fr;
            }

            .photo-tile:nth-child(2) {
                margin-top: 0;
            }

            .places-band {
                min-height: 470px;
                padding-inline: 16px;
            }

            .places-frame {
                padding: 0 44px;
            }

            .place-card {
                flex-basis: min(70vw, 230px);
                height: 218px;
            }

            .places-arrow {
                width: 42px;
                height: 42px;
                font-size: 28px;
            }

            .footer-inner,
            .service-grid,
            .cookie-banner {
                grid-template-columns: 1fr;
            }

            .cookie-banner {
                align-items: stretch;
                flex-direction: column;
            }

            .cookie-actions {
                width: 100%;
            }

            .cookie-actions button {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="site-shell" id="inicio">
        <header class="topbar" aria-label="Navegación principal">
            <a class="brand" href="#inicio" aria-label="Visita Jalisco inicio">
                <img class="brand-logo" src="/assets/img/logos/logo_visitajalisco_horizontal.png" alt="Visita Jalisco">
            </a>

            <nav class="nav">
                <div class="nav-links">
                    <a class="active" href="#inicio">Inicio</a>
                    <a href="#destinos">Destinos</a>
                    <a href="#locales">Negocios locales</a>
                    <a href="#rutas">Hospedajes</a>
                    <a href="#contacto">Servicios</a>
                </div>

                <div class="nav-actions" aria-label="Acciones rápidas">
                    <form class="code-form" action="{{ route('stays.lookup') }}" method="POST">
                        @csrf
                        <label class="sr-only" for="airbnb-code">Código del Airbnb</label>
                        <input id="airbnb-code" name="code" type="text" value="{{ old('code') }}" placeholder="Código Airbnb" autocomplete="off" required>
                        <button type="submit">Ver zona</button>
                    </form>
                    <span>ES</span>
                </div>
            </nav>
        </header>

        @error('code')
            <div class="code-error" role="alert">{{ $message }}</div>
        @enderror

        <main>
            <section class="hero" aria-label="Visita Jalisco">
                <div class="hero-fallback" aria-hidden="true"></div>
                <video class="hero-video" autoplay muted loop playsinline preload="metadata" poster="/assets/img/hero-poster.svg">
                    <source src="/assets/video/jalisco_vd.mp4" type="video/mp4">
                </video>
                <div class="hero-tint" aria-hidden="true"></div>

                <div class="hero-content">
                    <h1 class="hero-title">JALISCO</h1>
                    <div class="hero-card">
                        <p>Hospédate, camina y descubre negocios locales cerca de donde te quedas.</p>
                    </div>
                </div>

                <div class="hero-quick" aria-label="Redes sociales y volver arriba">
                    <a class="icon-button" href="https://www.facebook.com/visitajaliscomx" target="_blank" aria-label="Facebook">f</a>
                    {{-- <a class="icon-button" href="#" aria-label="Instagram">◎</a> --}}
                    {{-- <a class="icon-button" href="#" aria-label="Video">▶</a> --}}
                    <a class="icon-button scroll-top" href="#inicio" aria-label="Volver arriba">⌃</a>
                </div>
            </section>

            <section class="section" id="rutas">
                <div class="section-inner">
                    <span class="eyebrow">El airbnb adecuado para ti</span>
                    <h2>Hospedajes que conectan tu viaje con lo mejor que tienes cerca.</h2>
                    <p class="section-lead">Visita Jalisco, arranca conectando un Airbnb</p>

                    <div class="feature-grid airbnb-grid">
                        @forelse ($homeAirbnbs as $airbnb)
                            @php
                                $fallbackImages = [
                                    asset('assets/img/airbnb-card-1.svg'),
                                    asset('assets/img/airbnb-card-2.svg'),
                                    asset('assets/img/airbnb-card-3.svg'),
                                    asset('assets/img/airbnb-card-4.svg'),
                                ];
                                $galleryImages = $airbnb->galleryImageUrls() ?: [
                                    $fallbackImages[($loop->iteration - 1) % count($fallbackImages)],
                                    $fallbackImages[$loop->iteration % count($fallbackImages)],
                                ];
                            @endphp
                            <article class="feature airbnb-card">
                                <div class="airbnb-card-media" data-airbnb-carousel>
                                    @foreach ($galleryImages as $image)
                                        <img class="airbnb-slide {{ $loop->first ? 'is-active' : '' }}" src="{{ $image }}" alt="{{ $airbnb->name }}">
                                    @endforeach
                                    <span class="airbnb-badge">{{ $airbnb->code }}</span>
                                    <span class="airbnb-heart" aria-hidden="true">♡</span>
                                    @if (count($galleryImages) > 1)
                                        <button class="airbnb-arrow prev" type="button" data-airbnb-prev aria-label="Imagen anterior">‹</button>
                                        <button class="airbnb-arrow next" type="button" data-airbnb-next aria-label="Imagen siguiente">›</button>
                                    @endif
                                </div>
                                <div class="airbnb-card-body">
                                    <strong>{{ $airbnb->name }}</strong>
                                    <div class="zone">{{ $airbnb->zone?->name ?? 'Zona por asignar' }}</div>
                                    <div class="airbnb-actions">
                                        @if ($airbnb->airbnb_url)
                                            <a class="airbnb-action" href="{{ route('track.airbnbs.reserve', $airbnb) }}" target="_blank" rel="noopener">Reservar</a>
                                        @endif
                                        <a class="airbnb-action secondary" href="{{ route('stays.show', $airbnb->code) }}">Lugares cerca</a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <article class="feature airbnb-card">
                                <div class="airbnb-card-media" style="--airbnb-image: url('/assets/img/airbnb-card-1.svg');">
                                    <span class="airbnb-badge">Próximamente</span>
                                    <span class="airbnb-heart" aria-hidden="true">♡</span>
                                </div>
                                <div class="airbnb-card-body">
                                    <strong>Airbnbs conectados</strong>
                                    <div class="zone">Jalisco</div>
                                    <div class="airbnb-actions"><span class="airbnb-action secondary">En preparación</span></div>
                                </div>
                            </article>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="places-band" id="destinos" aria-label="Principales destinos">
                <video class="places-video" autoplay muted loop playsinline preload="metadata" poster="/assets/img/hero-poster.svg">
                    <source src="/assets/video/jalisco_vd.mp4" type="video/mp4">
                </video>
                <div class="places-shade" aria-hidden="true"></div>

                <div class="places-shell">
                    <h2 class="places-title">Principales destinos</h2>

                    <div class="places-frame">
                        <button class="places-arrow prev" type="button" data-places-prev aria-label="Destino anterior">‹</button>
                        <div class="places-track" data-places-track>
                            @foreach ([
                                ['Tequila', '#1b6f63', '#d9a441', 'tequila.jpg'],
                                ['Ajijic', '#1f6a8a', '#f07f4f', 'ajijic.jpg'],
                                ['Chapala', '#0f5d7a', '#70b7c6', 'chapala.jpg'],
                                ['Lagos de Moreno', '#6f452b', '#d8a45d', 'lagosm.webp'],
                                ['Mascota', '#264f3f', '#9bbf74', 'mascota.jpg'],
                                ['Mazamitla', '#173f47', '#6ea66b', 'mazamitl.jpg'],
                                ['Cocula', '#7a2648', '#ff9f1c', 'cocula.jpg'],
                                ['Sayula', '#353b5f', '#b57d62', 'sayula.jpeg'],
                                ['Tapalpa', '#285943', '#c5a46d', 'tapalpa.jpg'],
                                ['San Pedro Tlaquepaque', '#7c2d2d', '#e0a458', 'tlaquepaque.jpeg'],
                            ] as [$destination, $colorA, $colorB, $image])
                                <article class="place-card" style="--place-a: {{ $colorA }}; --place-b: {{ $colorB }}; --place-image: url('{{ asset('assets/img/destinos/' . $image) }}');">
                                    <strong>{{ $destination }}</strong>
                                    <span aria-hidden="true">›</span>
                                </article>
                            @endforeach
                        </div>
                        <button class="places-arrow next" type="button" data-places-next aria-label="Destino siguiente">›</button>
                    </div>
                </div>
            </section>

            <section class="section" id="locales">
                <div class="section-inner">
                    <span class="eyebrow">Tienes que visitarlo</span>
                    <h2>Si visitas Jalisco no te puedes perder de estos lugares mágicos</h2>

                    <div class="visit-grid">
                        @forelse ($publicAds as $publicAd)
                            <a class="visit-card" href="{{ route('track.public-ads.click', $publicAd) }}" target="_blank" rel="noopener">
                                <img src="{{ $publicAd->imageUrl() }}" alt="{{ $publicAd->title }}" loading="lazy">
                                <strong>{{ $publicAd->title }}</strong>
                            </a>
                        @empty
                            <a class="visit-card" href="#destinos">
                                <img src="/assets/img/public-ad-placeholder.svg" alt="Jalisco te espera" loading="lazy">
                                <strong>Jalisco te espera</strong>
                            </a>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="section services-band" id="servicios">
                <div class="section-inner">
                    <span class="eyebrow">Servicios que te pueden interesar</span>
                    <h2>Soluciones pensadas para que tu viaje sea más cómodo, seguro y personalizado.</h2>

                    <div class="service-grid">
                        @forelse ($premiumServices as $premiumService)
                            <article class="service-card">
                                <img src="{{ $premiumService->imageUrl() }}" alt="{{ $premiumService->title }}" loading="lazy">
                                <div class="service-card-content">
                                    @if ($premiumService->label)
                                        <span>{{ $premiumService->label }}</span>
                                    @endif
                                    <strong>{{ $premiumService->title }}</strong>
                                    @if ($premiumService->description)
                                        <p>{{ $premiumService->description }}</p>
                                    @endif
                                    @if ($premiumService->whatsappUrl())
                                        <a class="service-contact" href="{{ route('track.premium-services.whatsapp', $premiumService) }}" target="_blank" rel="noopener">Contactar</a>
                                    @endif
                                </div>
                            </article>
                        @empty
                            @foreach ([
                                ['Transporte privado', 'Traslados desde el aeropuerto, recorridos por la ciudad y viajes programados.', 'Premium'],
                                ['Guía turístico', 'Acompañamiento local para conocer historia, cultura y lugares clave de Jalisco.', 'Experiencia'],
                                ['Viajes personalizados', 'Rutas armadas a la medida para parejas, familias o grupos pequeños.', 'A la medida'],
                                ['Experiencias locales', 'Catas, recorridos, comida típica y actividades cerca de tu estancia.', 'Local'],
                            ] as [$serviceTitle, $serviceCopy, $serviceLabel])
                                <article class="service-card">
                                    <img src="/assets/img/public-ad-placeholder.svg" alt="{{ $serviceTitle }}" loading="lazy">
                                    <div class="service-card-content">
                                        <span>{{ $serviceLabel }}</span>
                                        <strong>{{ $serviceTitle }}</strong>
                                        <p>{{ $serviceCopy }}</p>
                                    </div>
                                </article>
                            @endforeach
                        @endforelse
                    </div>
                </div>
            </section>

        </main>

        <footer class="footer" id="contacto">
            <div class="footer-inner">
                <div>
                    <img class="footer-logo" src="/assets/img/logos/logo_visitajalisco_cuadrado.png" alt="Visita Jalisco">
                    <p>Turismo local, hospedajes y negocios cercanos para que cada visitante descubra Jalisco desde su estancia.</p>
                    <p class="footer-note">Visita Jalisco es una plataforma comercial independiente. No pertenece, representa ni sustituye a ninguna institución de gobierno.</p>
                </div>

                <div>
                    <h3>Turistas</h3>
                    <a href="#inicio">Inicio</a>
                    <a href="#destinos">Destinos</a>
                    <a href="#locales">Lugares mágicos</a>
                </div>

                <div>
                    <h3>Anunciantes</h3>
                    <span>Alta de negocios locales</span>
                    <span>Espacios publicitarios</span>
                    <span>Promoción por zona</span>
                </div>

                <div>
                    <h3>Legal</h3>
                    <a href="{{ route('privacy') }}">Aviso de privacidad</a>
                    <a href="{{ route('privacy') }}#cookies">Cookies</a>
                    <a href="{{ route('privacy') }}#terminos">Términos y condiciones</a>
                </div>
            </div>
        </footer>

        <div class="creator-strip">
            página creada por <a href="https://cloudi.mx" target="_blank" rel="noopener">cloudi.mx</a>
        </div>

        <div class="cookie-banner" data-cookie-banner role="dialog" aria-live="polite" aria-label="Aviso de cookies">
            <p>Usamos cookies técnicas y de analítica para entender el comportamiento de navegación y mejorar Visita Jalisco. Al continuar aceptas nuestros <a href="{{ route('privacy') }}#terminos">términos y condiciones</a>, el uso de cookies y el <a href="{{ route('privacy') }}">aviso de privacidad</a>.</p>
            <div class="cookie-actions">
                <button class="secondary" type="button" data-cookie-close>Después</button>
                <button type="button" data-cookie-accept>Aceptar</button>
            </div>
        </div>
    </div>
    <script>
        const cookieBanner = document.querySelector('[data-cookie-banner]');
        const cookieAccepted = localStorage.getItem('visita-jalisco-cookie-consent');

        if (cookieBanner && cookieAccepted !== 'accepted') {
            cookieBanner.classList.add('is-visible');
        }

        document.addEventListener('click', function (event) {
            if (event.target.closest('[data-cookie-accept]')) {
                localStorage.setItem('visita-jalisco-cookie-consent', 'accepted');
                cookieBanner?.classList.remove('is-visible');
            }

            if (event.target.closest('[data-cookie-close]')) {
                cookieBanner?.classList.remove('is-visible');
            }
        });

        document.addEventListener('click', function (event) {
            const nextButton = event.target.closest('[data-airbnb-next]');
            const prevButton = event.target.closest('[data-airbnb-prev]');

            if (!nextButton && !prevButton) {
                return;
            }

            const carousel = event.target.closest('[data-airbnb-carousel]');
            const slides = Array.from(carousel?.querySelectorAll('.airbnb-slide') || []);

            if (slides.length < 2) {
                return;
            }

            const currentIndex = slides.findIndex((slide) => slide.classList.contains('is-active'));
            const direction = nextButton ? 1 : -1;
            const nextIndex = (currentIndex + direction + slides.length) % slides.length;

            slides[currentIndex]?.classList.remove('is-active');
            slides[nextIndex].classList.add('is-active');
        });

        document.addEventListener('click', function (event) {
            const nextButton = event.target.closest('[data-places-next]');
            const prevButton = event.target.closest('[data-places-prev]');

            if (!nextButton && !prevButton) {
                return;
            }

            const carousel = document.querySelector('[data-places-track]');

            if (!carousel) {
                return;
            }

            const card = carousel.querySelector('.place-card');
            const gap = 18;
            const distance = ((card?.offsetWidth || 260) + gap) * (nextButton ? 1 : -1);

            carousel.scrollBy({ left: distance, behavior: 'smooth' });
        });

        const destinationCarousel = document.querySelector('[data-places-track]');

        if (destinationCarousel) {
            let destinationPaused = false;

            destinationCarousel.addEventListener('mouseenter', () => destinationPaused = true);
            destinationCarousel.addEventListener('mouseleave', () => destinationPaused = false);
            destinationCarousel.addEventListener('touchstart', () => destinationPaused = true, { passive: true });
            destinationCarousel.addEventListener('touchend', () => destinationPaused = false, { passive: true });

            setInterval(() => {
                if (destinationPaused) {
                    return;
                }

                const card = destinationCarousel.querySelector('.place-card');
                const gap = 18;
                const distance = (card?.offsetWidth || 260) + gap;
                const nearEnd = destinationCarousel.scrollLeft + destinationCarousel.clientWidth >= destinationCarousel.scrollWidth - distance;

                if (nearEnd) {
                    destinationCarousel.scrollTo({ left: 0, behavior: 'smooth' });
                    return;
                }

                destinationCarousel.scrollBy({ left: distance, behavior: 'smooth' });
            }, 3200);
        }
    </script>
</body>
</html>
