@extends('layouts.dashboard')

@section('title', 'Mis Airbnbs')

@section('content')
    <style>
        .icon-actions {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .icon-action {
            width: 32px;
            height: 32px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #ffffff;
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: color .18s ease, border-color .18s ease, background .18s ease;
        }

        .icon-action:hover {
            border-color: rgba(22, 122, 90, .32);
            background: #f0f4f2;
            color: var(--green);
        }

        .icon-action svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
    </style>

    <div class="page-head">
        <div>
            <h1>Mis Airbnbs</h1>
            <p class="subhead">Edita únicamente la información pública de tus hospedajes asignados.</p>
        </div>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Airbnb</th><th>Código</th><th>Zona</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($airbnbs as $airbnb)
                    @php($publicUrl = route('stays.show', $airbnb->code))
                    <tr>
                        <td><strong>{{ $airbnb->name }}</strong><br><span>{{ $airbnb->host ?: 'Sin anfitrión' }}</span></td>
                        <td><span class="pill">{{ $airbnb->code }}</span></td>
                        <td>{{ $airbnb->zone?->name }}</td>
                        <td><span class="pill {{ $airbnb->is_active ? '' : 'paused' }}">{{ $airbnb->is_active ? 'Publicado' : 'Pausado' }}</span></td>
                        <td>
                            <div class="icon-actions" aria-label="Acciones de {{ $airbnb->name }}">
                                <a class="icon-action" href="{{ route('airbnb.airbnbs.edit', $airbnb) }}" title="Editar" aria-label="Editar">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </a>
                                <a class="icon-action" href="{{ route('stays.show', $airbnb->code) }}" target="_blank" rel="noopener" title="Ver zona" aria-label="Ver zona">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s7-4.4 7-11a7 7 0 1 0-14 0c0 6.6 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                </a>
                                <button class="icon-action" type="button" data-copy-value="{{ $publicUrl }}" title="Copiar link" aria-label="Copiar link">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                </button>
                                <a class="icon-action" href="{{ route('airbnb.airbnbs.qr', $airbnb) }}" target="_blank" rel="noopener" title="Ver QR" aria-label="Ver QR">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><path d="M14 14h2v2h-2zM19 14h2v2h-2zM14 19h2v2h-2zM19 19h2v2h-2z"/></svg>
                                </a>
                                <a class="icon-action" href="{{ route('airbnb.airbnbs.qr.print', $airbnb) }}" target="_blank" rel="noopener" title="Imprimir QR" aria-label="Imprimir QR">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
                                </a>
                                <a class="icon-action" href="{{ route('airbnb.airbnbs.qr.download', $airbnb) }}" title="Descargar QR" aria-label="Descargar QR">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Todavía no tienes Airbnbs asignados. El administrador debe asignarte uno.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('click', async function (event) {
            const button = event.target.closest('[data-copy-value]');

            if (!button) {
                return;
            }

            try {
                await navigator.clipboard.writeText(button.dataset.copyValue);
            } catch (error) {
                const textarea = document.createElement('textarea');
                textarea.value = button.dataset.copyValue;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                textarea.remove();
            }

            const originalTitle = button.title;
            button.title = 'Copiado';
            button.setAttribute('aria-label', 'Copiado');
            setTimeout(() => {
                button.title = originalTitle;
                button.setAttribute('aria-label', originalTitle);
            }, 1600);
        });
    </script>
@endsection
