@extends('layouts.dashboard')

@section('title', 'Publicidad')

@section('content')
    <div class="page-head">
        <div>
            <h1>Publicidad</h1>
            <p class="subhead">Espacios visuales del home para vender destinos, experiencias o negocios destacados.</p>
        </div>
        <a class="button" href="{{ route('dashboard.public-ads.create') }}">Crear publicidad</a>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Imagen</th><th>Nombre</th><th>Link</th><th>Orden</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($publicAds as $publicAd)
                    <tr>
                        <td>
                            <img src="{{ $publicAd->imageUrl() }}" alt="{{ $publicAd->title }}" style="width:96px;aspect-ratio:16/10;object-fit:cover;border-radius:8px;border:1px solid var(--line);">
                        </td>
                        <td><strong>{{ $publicAd->title }}</strong></td>
                        <td><a class="link-action" href="{{ $publicAd->link_url }}" target="_blank" rel="noopener">Abrir link</a></td>
                        <td>{{ $publicAd->position }}</td>
                        <td><span class="pill {{ $publicAd->is_active ? '' : 'paused' }}">{{ $publicAd->is_active ? 'Activo' : 'Pausado' }}</span></td>
                        <td>
                            <div class="actions">
                                <a class="link-action" href="{{ route('dashboard.public-ads.edit', $publicAd) }}">Editar</a>
                                <form action="{{ route('dashboard.public-ads.toggle', $publicAd) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="link-action" type="submit">{{ $publicAd->is_active ? 'Pausar' : 'Activar' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Aún no hay publicidad.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
