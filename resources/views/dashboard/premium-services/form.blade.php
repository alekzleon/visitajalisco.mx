@extends('layouts.dashboard')

@section('title', $premiumService->exists ? 'Editar servicio premium' : 'Crear servicio premium')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $premiumService->exists ? 'Editar servicio premium' : 'Crear servicio premium' }}</h1>
            <p class="subhead">Configura la ficha que aparecerá en la sección premium del home.</p>
        </div>
    </div>

    <form class="form-card" action="{{ $premiumService->exists ? route('dashboard.premium-services.update', $premiumService) : route('dashboard.premium-services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($premiumService->exists) @method('PUT') @endif

        <div class="form-grid">
            <label>Servicio <input name="title" value="{{ old('title', $premiumService->title) }}" required></label>
            <label>Etiqueta <input name="label" value="{{ old('label', $premiumService->label) }}" placeholder="Premium, Experiencia, Local..."></label>
            <label>Orden <input name="position" type="number" min="0" value="{{ old('position', $premiumService->position ?? 0) }}"></label>
            <label>Link opcional <input name="link_url" value="{{ old('link_url', $premiumService->link_url) }}" placeholder="https://sitio-del-servicio.com o /#contacto"></label>
            <label>WhatsApp <input name="whatsapp" value="{{ old('whatsapp', $premiumService->whatsapp) }}" placeholder="5213312345678"></label>
            <label class="full">Descripción <textarea name="description">{{ old('description', $premiumService->description) }}</textarea></label>
            <label class="full">
                Imagen del servicio
                <input id="premium-service-image-input" name="image" type="file" accept="image/*" @required(! $premiumService->exists)>
            </label>
            <div class="full">
                <span id="premium-service-image-preview-label" style="display:block;color:var(--muted);font-size:13px;font-weight:800;margin-bottom:8px;">{{ $premiumService->image_url ? 'Imagen actual' : 'Vista previa' }}</span>
                <div style="width:min(520px,100%);border:1px dashed var(--line);border-radius:8px;background:#f7f8fa;padding:10px;">
                    <img id="premium-service-image-preview" src="{{ $premiumService->image_url ? $premiumService->imageUrl() : '' }}" alt="Vista previa de imagen del servicio" style="{{ $premiumService->image_url ? '' : 'display:none;' }}width:100%;aspect-ratio:16/10;object-fit:cover;border-radius:6px;">
                    <p id="premium-service-image-preview-empty" style="{{ $premiumService->image_url ? 'display:none;' : '' }}margin:0;color:var(--muted);font-size:13px;">Selecciona una imagen para verla antes de guardar.</p>
                </div>
            </div>
            <label class="check-row full"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $premiumService->is_active ?? true))> Servicio activo</label>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('dashboard.premium-services.index') }}">Cancelar</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('premium-service-image-input');
            const previewImage = document.getElementById('premium-service-image-preview');
            const previewLabel = document.getElementById('premium-service-image-preview-label');
            const emptyState = document.getElementById('premium-service-image-preview-empty');

            if (!imageInput || !previewImage || !previewLabel || !emptyState) {
                return;
            }

            imageInput.addEventListener('change', function () {
                const file = imageInput.files && imageInput.files[0];

                if (!file) {
                    return;
                }

                const reader = new FileReader();

                reader.addEventListener('load', function () {
                    previewImage.src = reader.result;
                    previewImage.style.display = 'block';
                    emptyState.style.display = 'none';
                    previewLabel.textContent = 'Vista previa';
                });

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
