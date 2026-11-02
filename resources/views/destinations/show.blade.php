<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $canonical = 'https://visitajalisco.mx/destinos/' . $slug;
        $title = 'Qué hacer en ' . $destination['name'] . ', Jalisco | Visita Jalisco';
        $image = 'https://visitajalisco.mx/assets/img/destinos/' . $destination['image'];
        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                ['@type' => 'TouristDestination', 'name' => $destination['name'] . ', Jalisco', 'url' => $canonical, 'description' => $destination['description'], 'image' => $image],
                ['@type' => 'BreadcrumbList', 'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => 'https://visitajalisco.mx/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => $destination['name'], 'item' => $canonical],
                ]],
            ],
        ];
    @endphp
    <title>{{ $title }}</title>
    @include('partials.adsense-verification')
    <meta name="description" content="{{ $destination['description'] }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ $canonical }}">
    <link rel="icon" type="image/png" href="/assets/img/logos/icon.png">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="Visita Jalisco">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $destination['description'] }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:alt" content="Vista de {{ $destination['name'] }}, Jalisco">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $destination['description'] }}">
    <meta name="twitter:image" content="{{ $image }}">
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; color: #242424; background: #fffaf3; font: 1.05rem/1.7 system-ui, sans-serif; }
        main { padding: 0; }
        footer { max-width: 920px; margin: auto; padding: 24px; }
        .topbar { background: #d6d6d6; color: #242424; padding: 14px clamp(18px, 4vw, 72px); min-height: 86px; display: flex; align-items: center; gap: clamp(24px, 4vw, 56px); }
        .brand { display: flex; flex-shrink: 0; }
        .brand-logo { display: block; width: clamp(142px, 14vw, 210px); height: auto; }
        .site-nav { flex: 1; align-items: center; justify-content: center; gap: clamp(18px, 3vw, 44px); }
        .site-nav a { color: rgba(36, 36, 36, .78); text-decoration: none; font-size: clamp(14px, 1.15vw, 19px); white-space: nowrap; }
        .site-nav a[aria-current] { color: #242424; font-weight: 800; }
        .site-nav a:hover { color: #116047; }
        .breadcrumbs { margin-bottom: 24px; font-size: .9rem; color: #6b665f; }
        .breadcrumbs a { text-decoration: none; }
        .skip:focus { z-index: 10; }
        @media (max-width: 900px) {
            .topbar { flex-direction: column; align-items: flex-start; gap: 12px; }
            .site-nav { width: 100%; justify-content: flex-start; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 6px; gap: 22px; }
        }
        a { color: #116047; text-underline-offset: .2em; }
        a:focus-visible { outline: 3px solid #116047; outline-offset: 4px; }
        nav { display: flex; gap: 12px; flex-wrap: wrap; }
        .skip { position: absolute; left: -10000px; }
        .skip:focus { left: 16px; top: 8px; background: white; padding: 12px; }
        h1 { font-size: clamp(2rem, 6vw, 3.4rem); line-height: 1.15; }
        h2 { line-height: 1.3; margin-top: 2rem; }
        h3 { margin-bottom: .3rem; }
        p { margin-top: .5rem; }
        .hero { display: block; width: 100%; height: auto; aspect-ratio: 16 / 9; object-fit: cover; border-radius: 12px; }
        .related-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr)); gap: 22px; padding: 0; margin: 26px 0 40px; list-style: none; }
        .related-grid li { min-width: 0; }
        .destination-card { display: flex; flex-direction: column; height: 100%; overflow: hidden; border: 1px solid #e7e0d5; border-radius: 18px; background: #fff; color: #242424; text-decoration: none; box-shadow: 0 8px 24px rgba(36, 36, 36, .06); transition: transform .2s ease, box-shadow .2s ease; }
        .destination-card picture { display: block; overflow: hidden; }
        .destination-card img { display: block; width: 100%; height: auto; aspect-ratio: 16 / 10; object-fit: cover; transition: transform .35s ease; }
        .destination-card-body { display: flex; flex-direction: column; align-items: flex-start; flex: 1; padding: 22px; }
        .destination-card-kicker { color: #116047; font-size: .72rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        .destination-card h3 { margin: 8px 0 10px; font-size: 1.4rem; line-height: 1.25; }
        .destination-card p { margin: 0 0 22px; color: #6b665f; font-size: .92rem; line-height: 1.6; }
        .destination-card-action { display: inline-flex; align-items: center; gap: 18px; margin-top: auto; padding: 10px 16px; border-radius: 999px; background: #116047; color: #fff; font-size: .86rem; font-weight: 700; }
        .destination-card:hover, .destination-card:focus-visible { transform: translateY(-4px); box-shadow: 0 16px 32px rgba(36, 36, 36, .12); }
        .destination-card:hover img { transform: scale(1.04); }
        @media (prefers-reduced-motion: reduce) {
            .destination-card, .destination-card img { transition: none; }
            .destination-card:hover, .destination-card:focus-visible, .destination-card:hover img { transform: none; }
        }
        .destination-hero { position: relative; isolation: isolate; display: grid; align-items: center; min-height: min(760px, 85svh); padding: 60px clamp(24px, 7vw, 120px); color: #fff; background: #14382e; }
        .destination-hero-picture { position: absolute; inset: 0; z-index: -2; }
        .destination-hero-image { display: block; width: 100%; height: 100%; object-fit: cover; }
        .destination-hero::before { content: ''; position: absolute; inset: 0; z-index: -1; background: linear-gradient(90deg, rgba(8, 26, 22, .84), rgba(8, 26, 22, .38)), linear-gradient(0deg, rgba(8, 26, 22, .35), transparent); }
        .destination-hero-inner { width: min(100%, 1120px); margin: auto; }
        .destination-hero .breadcrumbs { color: #fff; margin-bottom: 64px; }
        .destination-hero .breadcrumbs a { color: #fff; }
        .destination-eyebrow { display: block; font-size: .74rem; font-weight: 750; text-transform: uppercase; letter-spacing: .18em; color: #b7e7cf; }
        .destination-hero h1 { margin: 18px 0 24px; max-width: 1000px; font-size: clamp(2.8rem, 7vw, 6.5rem); letter-spacing: -.04em; line-height: 1.06; }
        .destination-hero h1 > span { display: block; font-size: clamp(.95rem, 2vw, 1.4rem); font-weight: 500; letter-spacing: .02em; margin-bottom: 12px; }
        .destination-hero h1 .destination-location { margin: 18px 0 0; color: #e7eee9; font-size: 1rem; }
        .destination-hero p { max-width: 650px; color: #f4f7f5; font-size: clamp(1rem, 1.8vw, 1.2rem); line-height: 1.75; }
        .hero-explore { display: inline-flex; gap: 28px; align-items: center; color: #fff; text-decoration: none; border-bottom: 1px solid #a6cfbb; padding: 12px 0; margin-top: 18px; }
        .hero-explore:focus-visible { outline-color: #fff; }
        .destination-intro { max-width: 880px; margin: 0 auto; padding: clamp(48px, 7vw, 88px) 24px; font-size: clamp(1.15rem, 2vw, 1.5rem); line-height: 1.8; text-align: center; }
        .destination-visits { background: #102c25; color: #f9faf7; padding: clamp(40px, 7vw, 88px) max(24px, calc((100% - 1040px) / 2)); }
        #visitar { scroll-margin-top: 24px; }
        .destination-visits h2 { font-size: clamp(2rem, 4vw, 3rem); margin: 12px 0 40px; letter-spacing: -.03em; }
        .destination-visits h3 { display: flex; align-items: baseline; gap: 18px; font-size: clamp(1.2rem, 2.5vw, 1.65rem); margin: 32px 0 12px; padding-top: 24px; border-top: 1px solid #345247; }
        .visit-number { font-size: .85rem; color: #acd8c0; font-weight: 500; }
        .destination-visits p { max-width: 850px; margin: 0 0 32px 42px; color: #d4e1d9; }
        .practical-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 1120px; margin: 0 auto; padding: 72px 24px; }
        .practical-panel { background: #fff; border: 1px solid #e7e0d5; border-radius: 20px; padding: clamp(24px, 3vw, 36px); }
        .practical-panel h2 { margin: 0 0 24px; font-size: 1.6rem; }
        .practical-panel p { color: #5b625c; margin-bottom: 0; }
        .destination-questions, .destination-related, .destination-sources, .destination-return { max-width: 1120px; margin: 0 auto; padding: 0 24px 60px; }
        .destination-questions h2, .destination-related h2 { font-size: clamp(1.8rem, 3.5vw, 2.6rem); letter-spacing: -.03em; margin: 0 0 28px; }
        .destination-questions h3 { border-top: 1px solid #ded8cd; padding-top: 24px; font-size: 1.1rem; }
        .destination-questions p { color: #5b625c; max-width: 880px; }
        .destination-sources { padding-top: 32px; border-top: 1px solid #ded8cd; font-size: .92rem; }
        .destination-sources h2 { margin-top: 0; font-size: 1.3rem; }
        .destination-return a { display: inline-block; padding: 12px 20px; border-radius: 999px; border: 1px solid #b9c8bd; text-decoration: none; }
        @media (max-width: 640px) {
            .destination-hero { min-height: 620px; padding: 32px 24px 48px; }
            .destination-hero .breadcrumbs { margin-bottom: 48px; }
            .practical-grid { grid-template-columns: 1fr; padding-top: 40px; padding-bottom: 40px; }
            .destination-visits p { margin-left: 0; }
        }
        footer { border-top: 1px solid #ded8cd; font-size: .9rem; }
    </style>
</head>
<body>
    <a class="skip" href="#contenido">Saltar al contenido</a>
    <header class="topbar">
        <a class="brand" href="/" aria-label="Visita Jalisco inicio">
            <img class="brand-logo" src="/assets/img/logos/logo_visitajalisco_horizontal.png" alt="Visita Jalisco" width="2000" height="600">
        </a>
        <nav class="site-nav" aria-label="Navegación principal">
            <a href="/#inicio">Inicio</a>
            <a href="/#destinos" aria-current="location">Destinos</a>
            <a href="/#locales">Negocios locales</a>
            <a href="/#rutas">Hospedajes</a>
            <a href="/#contacto">Servicios</a>
        </nav>
    </header>
    <main id="contenido">
        <section class="destination-hero" aria-labelledby="destination-title">
        <picture class="destination-hero-picture">
            @if ($destination['optimized_image'])
                <source srcset="/assets/img/destinos/optimized/{{ $destination['optimized_image'] }}" type="image/webp">
            @endif
            <img class="destination-hero-image" src="/assets/img/destinos/{{ $destination['image'] }}" alt="Vista de {{ $destination['name'] }}, Jalisco" width="1200" height="675" fetchpriority="high">
        </picture>
            <div class="destination-hero-inner">
                <nav class="breadcrumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span aria-hidden="true">/</span><span aria-current="page">{{ $destination['name'] }}</span></nav>
                <span class="destination-eyebrow">Un viaje por Jalisco</span>
                <h1 id="destination-title"><span>Qué hacer en</span> {{ $destination['name'] }}<span class="destination-location">Jalisco, México</span></h1>
                <p>{{ $destination['description'] }}</p>
                <a class="hero-explore" href="#visitar">Descubre el destino <span aria-hidden="true">↓</span></a>
            </div>
        </section>
        <p class="destination-intro">{{ $destination['intro'] }}</p>
        <section class="destination-visits" aria-labelledby="visitar">
            <span class="destination-eyebrow">Elige tu recorrido</span>
            <h2 id="visitar">Lugares para conocer</h2>
            @foreach ($destination['visits'] as [$heading, $text])
                <h3><span class="visit-number" aria-hidden="true">0{{ $loop->iteration }}</span>{{ $heading }}</h3>
                <p>{{ $text }}</p>
            @endforeach
        </section>
        <div class="practical-grid">
        <section class="practical-panel" aria-labelledby="plan"><h2 id="plan">Cómo organizar tu visita</h2><p>{{ $destination['plan'] }}</p></section>
        <section class="practical-panel" aria-labelledby="llegar"><h2 id="llegar">Cómo llegar y qué considerar</h2><p>{{ $destination['practical'] }}</p></section>
        </div>
        <section class="destination-questions" aria-labelledby="preguntas">
            <h2 id="preguntas">Preguntas para preparar el viaje</h2>
            @foreach ($destination['faq'] as [$question, $answer])
                <h3>{{ $question }}</h3><p>{{ $answer }}</p>
            @endforeach
        </section>
        <section class="destination-related" aria-labelledby="relacionados">
            <h2 id="relacionados">Otros destinos para tu viaje</h2>
            <p>Compara estas propuestas antes de elegir tu siguiente salida; no forman un itinerario para recorrer en un solo día.</p>
            <ul class="related-grid">
                @foreach ($destination['related'] as $related)
                    @php($relatedDestination = config('destinations.' . $related))
                    <li>
                        <a class="destination-card" href="{{ route('destinations.show', ['slug' => $related], false) }}">
                            <picture>
                                @if ($relatedDestination['optimized_image'])
                                    <source srcset="/assets/img/destinos/optimized/{{ $relatedDestination['optimized_image'] }}" type="image/webp">
                                @endif
                                <img src="/assets/img/destinos/{{ $relatedDestination['image'] }}" alt="" width="1200" height="750" loading="lazy" decoding="async">
                            </picture>
                            <div class="destination-card-body">
                                <span class="destination-card-kicker">Descubre Jalisco</span>
                                <h3>{{ $relatedDestination['name'] }}</h3>
                                <p>{{ $relatedDestination['description'] }}</p>
                                <span class="destination-card-action">Explorar destino <span aria-hidden="true">↗</span></span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
        <section class="destination-sources" aria-labelledby="fuentes">
            <h2 id="fuentes">Información para consultar</h2>
            <p>Los tiempos de visita son sugerencias de esta guía. Confirma horarios, accesos, precios y condiciones directamente con cada recinto u operador.</p>
            <ul>@foreach ($destination['sources'] as $source)<li><a href="{{ $source }}">{{ str_contains($source, 'gob.mx') ? 'Secretaría de Turismo' : 'Portal turístico de Jalisco' }}: {{ $destination['name'] }}</a></li>@endforeach</ul>
        </section>
        <p class="destination-return"><a href="/#destinos">← Volver a los diez destinos de Jalisco</a></p>
    </main>
    <footer>
        <p>Visita Jalisco es una guía independiente; no es un portal gubernamental.</p>
        @include('partials.policy-links')
    </footer>
</body>
</html>
