<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Visita Jalisco</title>
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="{{ $indexable ? 'index, follow' : 'noindex, follow' }}">
    <link rel="canonical" href="https://visitajalisco.mx{{ $path }}">
    <link rel="icon" type="image/png" href="/assets/img/logos/icon.png">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; color: #242424; background: #fffaf3; font: 1rem/1.75 system-ui, sans-serif; }
        header { background: #d6d6d6; padding: 18px clamp(20px, 5vw, 72px); }
        header img { display: block; width: 180px; height: auto; }
        main, footer { width: min(960px, 100%); margin: auto; padding: 32px 24px; }
        article { background: white; border: 1px solid #e7e0d5; padding: clamp(24px, 5vw, 48px); border-radius: 18px; }
        h1 { font-size: clamp(2rem, 6vw, 3.2rem); line-height: 1.1; margin-top: 0; }
        h2 { font-size: 1.4rem; line-height: 1.3; margin-top: 32px; }
        a { color: #116047; overflow-wrap: anywhere; text-underline-offset: .2em; }
        a:focus-visible { outline: 3px solid #116047; outline-offset: 4px; }
        .stamp { color: #68625b; font-size: .9rem; }
        .table-scroll { overflow-x: auto; }
        table { border-collapse: collapse; width: 100%; font-size: .9rem; }
        th, td { border: 1px solid #ded8cd; padding: 10px; text-align: left; vertical-align: top; }
        footer { border-top: 1px solid #ded8cd; }
        .skip { position: absolute; left: -10000px; }
        .skip:focus { left: 12px; top: 12px; background: white; padding: 12px; }
    </style>
</head>
<body>
    <a class="skip" href="#contenido">Saltar al contenido</a>
    <header><a href="/" aria-label="Visita Jalisco inicio"><img src="/assets/img/logos/logo_visitajalisco_horizontal.png" alt="Visita Jalisco" width="2000" height="600"></a></header>
    <main id="contenido">
        <p><a href="/">← Volver a Visita Jalisco</a></p>
        <article>
            <h1>{{ $title }}</h1>
            @if ($available)
                <p class="stamp">Versión del contenido: <time datetime="{{ $updatedAt }}">{{ \Carbon\Carbon::parse($updatedAt)->format('d/m/Y') }}</time></p>
                @yield('information')
            @else
                <p>{{ $unavailableMessage }}</p>
                <p>Consulta <a href="{{ route('cookies', [], false) }}">cómo utiliza el sitio las cookies y el almacenamiento local</a> y <a href="{{ route('about', [], false) }}">qué ofrece Visita Jalisco</a>.</p>
            @endif
        </article>
    </main>
    <footer>
        @include('partials.policy-links')
        <p>Visita Jalisco es una plataforma comercial independiente de las instituciones de gobierno.</p>
    </footer>
</body>
</html>
