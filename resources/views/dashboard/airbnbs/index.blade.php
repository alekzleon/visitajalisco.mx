@extends('layouts.dashboard')

@section('title', 'Airbnbs')

@section('content')
    <div class="page-head">
        <div>
            <h1>Airbnbs</h1>
            <p class="subhead">Cada Airbnb tiene su propio código, aunque comparta zona con otros.</p>
        </div>
        <a class="button" href="{{ route('dashboard.airbnbs.create') }}">Crear Airbnb</a>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Código</th><th>Airbnb</th><th>Zona</th><th>Responsable</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($airbnbs as $airbnb)
                    <tr>
                        <td><span class="pill">{{ $airbnb->code }}</span></td>
                        <td><strong>{{ $airbnb->name }}</strong><br><span>{{ $airbnb->tower }}</span></td>
                        <td>{{ $airbnb->zone?->name }}</td>
                        <td>{{ $airbnb->user?->name ?? 'Sin asignar' }}</td>
                        <td><span class="pill {{ $airbnb->is_active ? '' : 'paused' }}">{{ $airbnb->is_active ? 'Activo' : 'Pausado' }}</span></td>
                        <td>
                            <div class="actions">
                                <a class="link-action" href="{{ route('stays.show', $airbnb->code) }}" target="_blank" rel="noopener">Ver</a>
                                <a class="link-action" href="{{ route('dashboard.airbnbs.edit', $airbnb) }}">Editar</a>
                                <form action="{{ route('dashboard.airbnbs.toggle', $airbnb) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="link-action" type="submit">{{ $airbnb->is_active ? 'Pausar' : 'Activar' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Aún no hay Airbnbs.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
