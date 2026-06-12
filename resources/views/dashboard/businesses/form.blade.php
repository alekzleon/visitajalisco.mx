@extends('layouts.dashboard')

@section('title', $business->exists ? 'Editar negocio' : 'Crear negocio')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $business->exists ? 'Editar negocio' : 'Crear negocio' }}</h1>
            <p class="subhead">Asocia negocios locales con una zona para que aparezcan en los Airbnbs cercanos.</p>
        </div>
    </div>

    <form class="form-card" action="{{ $business->exists ? route('dashboard.businesses.update', $business) : route('dashboard.businesses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($business->exists) @method('PUT') @endif

        <div class="form-grid">
            <label>Nombre <input name="name" value="{{ old('name', $business->name) }}" required></label>
            <label>Categoría <input name="category" value="{{ old('category', $business->category) }}" placeholder="Café, restaurante, farmacia..."></label>
            <label>Zona
                <select name="zone_id" required>
                    <option value="">Selecciona zona</option>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}" @selected(old('zone_id', $business->zone_id) == $zone->id)>{{ $zone->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>Cuenta negocio
                <select name="user_id">
                    <option value="">Sin asignar</option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" @selected(old('user_id', $business->user_id) == $owner->id)>{{ $owner->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>Distancia <input name="distance" value="{{ old('distance', $business->distance) }}" placeholder="Planta baja, 3 min caminando..."></label>
            <label>Espacio publicitario <input name="ad_slot" value="{{ old('ad_slot', $business->ad_slot) }}" placeholder="Premium, destacado..."></label>
            <label class="full">
                Imagen publicitaria
                <input id="business-image-input" name="image" type="file" accept="image/*">
            </label>
            <div class="full" id="business-image-preview-wrap">
                <span id="business-image-preview-label" style="display:block;color:var(--muted);font-size:13px;font-weight:800;margin-bottom:8px;">{{ $business->image_url ? 'Imagen actual' : 'Vista previa' }}</span>
                <div style="width:min(420px,100%);border:1px dashed var(--line);border-radius:8px;background:#f7f8fa;padding:10px;">
                    <img id="business-image-preview" src="{{ $business->image_url ? $business->imageUrl() : '' }}" alt="Vista previa de imagen publicitaria" style="{{ $business->image_url ? '' : 'display:none;' }}width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:6px;">
                    <p id="business-image-preview-empty" style="{{ $business->image_url ? 'display:none;' : '' }}margin:0;color:var(--muted);font-size:13px;">Selecciona una imagen para verla antes de guardar.</p>
                </div>
            </div>
            <label class="full">WhatsApp <input name="whatsapp" value="{{ old('whatsapp', $business->whatsapp) }}" placeholder="5213312345678"></label>
            <label class="full">Link de cómo llegar <input name="maps_url" value="{{ old('maps_url', $business->maps_url) }}" placeholder="https://maps.google.com/..."></label>
            <label>Instagram <input name="instagram_username" value="{{ old('instagram_username', $business->instagram_username) }}" placeholder="usuario"></label>
            <label>Facebook <input name="facebook_username" value="{{ old('facebook_username', $business->facebook_username) }}" placeholder="usuario o pagina"></label>
            <label class="full">TikTok <input name="tiktok_username" value="{{ old('tiktok_username', $business->tiktok_username) }}" placeholder="usuario"></label>
            <label class="full">Descripción <textarea name="description">{{ old('description', $business->description) }}</textarea></label>
            <label class="check-row full"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $business->is_active ?? true))> Negocio activo</label>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('dashboard.businesses.index') }}">Cancelar</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('business-image-input');
            const previewImage = document.getElementById('business-image-preview');
            const previewLabel = document.getElementById('business-image-preview-label');
            const emptyState = document.getElementById('business-image-preview-empty');

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
