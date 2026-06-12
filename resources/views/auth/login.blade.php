<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="/assets/img/logos/icon.png">
    <link rel="apple-touch-icon" href="/assets/img/logos/icon.png">
    <title>Ingresar | Visita Jalisco</title>
    <style>
        :root {
            --ink: #1d1f23;
            --muted: #68707d;
            --line: #e7e9ee;
            --green: #167a5a;
            --pink: #e91e63;
            --orange: #ff9f1c;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at top left, rgba(22, 122, 90, .14), transparent 32%),
                #f7f8fa;
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            padding: 20px;
        }

        .login {
            width: min(430px, 100%);
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #ffffff;
            padding: 28px;
            box-shadow: 0 18px 50px rgba(20, 29, 42, .08);
        }

        .brand {
            margin-bottom: 28px;
        }

        .brand strong {
            display: block;
            font-size: 28px;
        }

        .brand img {
            display: block;
            width: 210px;
            height: auto;
            margin: 0 auto 8px;
        }

        .brand span {
            display: block;
            margin-top: 6px;
            color: var(--muted);
        }

        label {
            display: grid;
            gap: 8px;
            margin-top: 14px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 12px;
            outline: 0;
            font: inherit;
        }

        .row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            color: var(--muted);
            font-size: 14px;
        }

        .row input {
            width: auto;
        }

        button {
            width: 100%;
            min-height: 44px;
            margin-top: 18px;
            border: 0;
            border-radius: 8px;
            background: var(--ink);
            color: #ffffff;
            font-weight: 900;
            cursor: pointer;
        }

        .hint,
        .error {
            margin-top: 16px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .error {
            color: #9f174b;
            font-weight: 800;
        }
    </style>
</head>
<body>
    <main class="login">
        <div class="brand">
            <img src="/assets/img/logos/logo_visitajalisco_horizontal.png" alt="Visita Jalisco">
            <span>Dashboard privado</span>
        </div>

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <label>
                Correo
                <input name="email" type="email" value="{{ old('email', 'admin@visitajalisco.mx') }}" autocomplete="email" required autofocus>
            </label>

            <label>
                Contraseña
                <input name="password" type="password" autocomplete="current-password" required>
            </label>

            <label class="row">
                <input name="remember" type="checkbox" value="1">
                Recordar sesión
            </label>

            <button type="submit">Ingresar</button>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </form>

        <p class="hint">Usuario inicial: admin@visitajalisco.mx · contraseña: password</p>
    </main>
</body>
</html>
