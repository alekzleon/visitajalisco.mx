<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>QR {{ $airbnb->code }} | Visita Jalisco</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f5f6f8;
            color: #111a3d;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            padding: 28px;
        }
        .sheet {
            width: min(520px, 100%);
            background: #ffffff;
            border: 1px solid #e7e9ee;
            border-radius: 8px;
            padding: 28px;
            text-align: center;
        }
        .brand {
            font-size: 30px;
            font-weight: 900;
            margin-bottom: 8px;
        }
        .brand span:nth-child(1) { color: #167a5a; }
        .brand span:nth-child(2) { color: #ff9f1c; }
        .brand span:nth-child(3) { color: #168aad; }
        .brand span:nth-child(4) { color: #e91e63; }
        .brand span:nth-child(5) { color: #167a5a; }
        .brand span:nth-child(6) { color: #ff9f1c; }
        h1 {
            margin: 0;
            font-size: 26px;
            line-height: 1.1;
        }
        p {
            margin: 10px auto 0;
            color: #68707d;
            line-height: 1.45;
        }
        .qr {
            width: min(330px, 82vw);
            margin: 24px auto;
            border: 1px solid #e7e9ee;
            border-radius: 8px;
            padding: 18px;
        }
        .qr img {
            width: 100%;
            height: auto;
            display: block;
        }
        .code {
            display: inline-flex;
            border-radius: 999px;
            background: #edf8f3;
            color: #167a5a;
            padding: 8px 12px;
            font-weight: 900;
        }
        .actions {
            margin-top: 18px;
        }
        button {
            border: 0;
            border-radius: 8px;
            background: #111a3d;
            color: #ffffff;
            padding: 11px 16px;
            font-weight: 900;
            cursor: pointer;
        }
        @media print {
            body { background: #ffffff; padding: 0; }
            .sheet { border: 0; width: 100%; }
            .actions { display: none; }
        }
    </style>
</head>
<body>
    <main class="sheet">
        <div class="brand"><span>v</span><span>i</span><span>s</span><span>i</span><span>t</span><span>a</span></div>
        <h1>Explora lo que hay cerca de tu Airbnb</h1>
        <p>{{ $airbnb->name }} · {{ $airbnb->zone?->name }}</p>

        <div class="qr">
            <img src="{{ route('airbnb.airbnbs.qr', $airbnb) }}" alt="Código QR de {{ $airbnb->name }}">
        </div>

        <span class="code">{{ $airbnb->code }}</span>
        <p>{{ $publicUrl }}</p>

        <div class="actions">
            <button type="button" onclick="window.print()">Imprimir QR</button>
        </div>
    </main>
</body>
</html>
