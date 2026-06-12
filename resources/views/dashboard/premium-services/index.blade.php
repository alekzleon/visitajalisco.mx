@extends('layouts.dashboard')

@section('title', 'Servicios premium')

@section('content')
    <div class="page-head">
        <div>
            <h1>Servicios premium</h1>
            <p class="subhead">Servicios destacados del home como transporte, guías, experiencias y viajes personalizados.</p>
        </div>
        <a class="button" href="{{ route('dashboard.premium-services.create') }}">Crear servicio</a>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Imagen</th><th>Servicio</th><th>Etiqueta</th><th>WhatsApp</th><th>Link</th><th>Orden</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($premiumServices as $premiumService)
                    <tr>
                        <td>
                            <img src="{{ $premiumService->imageUrl() }}" alt="{{ $premiumService->title }}" style="width:96px;aspect-ratio:16/10;object-fit:cover;border-radius:8px;border:1px solid var(--line);">
                        </td>
                        <td><strong>{{ $premiumService->title }}</strong><br><span>{{ \Illuminate\Support\Str::limit($premiumService->description, 74) }}</span></td>
                        <td>{{ $premiumService->label ?: 'Sin etiqueta' }}</td>
                        <td>{{ $premiumService->whatsapp ?: 'Sin WhatsApp' }}</td>
                        <td>
                            @if ($premiumService->link_url)
                                <a class="link-action" href="{{ $premiumService->link_url }}" target="_blank" rel="noopener">Abrir link</a>
                            @else
                                Sin link
                            @endif
                        </td>
                        <td>{{ $premiumService->position }}</td>
                        <td><span class="pill {{ $premiumService->is_active ? '' : 'paused' }}">{{ $premiumService->is_active ? 'Activo' : 'Pausado' }}</span></td>
                        <td>
                            <div class="actions">
                                <a class="link-action" href="{{ route('dashboard.premium-services.edit', $premiumService) }}">Editar</a>
                                <form action="{{ route('dashboard.premium-services.toggle', $premiumService) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="link-action" type="submit">{{ $premiumService->is_active ? 'Pausar' : 'Activar' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">Aún no hay servicios premium.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
