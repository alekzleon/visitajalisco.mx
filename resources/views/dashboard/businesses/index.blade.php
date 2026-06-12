@extends('layouts.dashboard')

@section('title', 'Negocios')

@section('content')
    <div class="page-head">
        <div>
            <h1>Negocios</h1>
            <p class="subhead">Anunciantes locales asociados a una zona.</p>
        </div>
        <a class="button" href="{{ route('dashboard.businesses.create') }}">Crear negocio</a>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Negocio</th><th>Categoría</th><th>Zona</th><th>WhatsApp</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($businesses as $business)
                    <tr>
                        <td><strong>{{ $business->name }}</strong><br><span>{{ $business->distance }}</span></td>
                        <td>{{ $business->category }}</td>
                        <td>{{ $business->zone?->name }}</td>
                        <td>{{ $business->whatsapp ?: 'Sin WhatsApp' }}</td>
                        <td><span class="pill {{ $business->is_active ? '' : 'paused' }}">{{ $business->is_active ? 'Activo' : 'Pausado' }}</span></td>
                        <td>
                            <div class="actions">
                                <a class="link-action" href="{{ route('dashboard.businesses.edit', $business) }}">Editar</a>
                                <form action="{{ route('dashboard.businesses.toggle', $business) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="link-action" type="submit">{{ $business->is_active ? 'Pausar' : 'Activar' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Aún no hay negocios.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
