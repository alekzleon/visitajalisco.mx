@extends('layouts.dashboard')

@section('title', 'Zonas')

@section('content')
    <div class="page-head">
        <div>
            <h1>Zonas</h1>
            <p class="subhead">Agrupa Airbnbs que comparten cercanía, negocios y espacios publicitarios.</p>
        </div>
        <a class="button" href="{{ route('dashboard.zones.create') }}">Crear zona</a>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Zona</th><th>Área</th><th>Airbnbs</th><th>Negocios</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($zones as $zone)
                    <tr>
                        <td><strong>{{ $zone->name }}</strong><br><span>{{ $zone->slug }}</span></td>
                        <td>{{ $zone->area }}</td>
                        <td>{{ $zone->airbnbs_count }}</td>
                        <td>{{ $zone->businesses_count }}</td>
                        <td><span class="pill {{ $zone->is_active ? '' : 'paused' }}">{{ $zone->is_active ? 'Activa' : 'Pausada' }}</span></td>
                        <td>
                            <div class="actions">
                                <a class="link-action" href="{{ route('dashboard.zones.edit', $zone) }}">Editar</a>
                                <form action="{{ route('dashboard.zones.toggle', $zone) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="link-action" type="submit">{{ $zone->is_active ? 'Pausar' : 'Activar' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Aún no hay zonas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
