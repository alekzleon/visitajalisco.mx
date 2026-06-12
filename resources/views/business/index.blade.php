@extends('layouts.dashboard')

@section('title', 'Mis negocios')

@section('content')
    <div class="page-head">
        <div>
            <h1>Mis negocios</h1>
            <p class="subhead">Edita únicamente la información pública de los negocios asignados a tu cuenta.</p>
        </div>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Negocio</th><th>Zona asignada</th><th>WhatsApp</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($businesses as $business)
                    <tr>
                        <td><strong>{{ $business->name }}</strong><br><span>{{ $business->category }}</span></td>
                        <td>{{ $business->zone?->name }}</td>
                        <td>{{ $business->whatsapp ?: 'Sin WhatsApp' }}</td>
                        <td><span class="pill {{ $business->is_active ? '' : 'paused' }}">{{ $business->is_active ? 'Publicado' : 'Pausado' }}</span></td>
                        <td><a class="link-action" href="{{ route('business.businesses.edit', $business) }}">Editar</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5">Todavía no tienes negocios asignados. El administrador debe asignarte uno.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
