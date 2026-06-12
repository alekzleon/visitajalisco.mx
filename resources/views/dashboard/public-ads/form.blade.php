@extends('layouts.dashboard')

@section('title', $publicAd->exists ? 'Editar publicidad' : 'Crear publicidad')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $publicAd->exists ? 'Editar publicidad' : 'Crear publicidad' }}</h1>
            <p class="subhead">Sube una imagen y define el link al destino, negocio o experiencia que se va a promocionar.</p>
        </div>
    </div>

    <form class="form-card" action="{{ $publicAd->exists ? route('dashboard.public-ads.update', $publicAd) : route('dashboard.public-ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($publicAd->exists) @method('PUT') @endif

        <div class="form-grid">
            <label>Nombre <input name="title" value="{{ old('title', $publicAd->title) }}" required></label>
            <label>Orden <input name="position" type="number" min="0" value="{{ old('position', $publicAd->position ?? 0) }}"></label>
            <label class="full">Link destino <input name="link_url" value="{{ old('link_url', $publicAd->link_url) }}" placeholder="https://visitajalisco.mx/destino o /#destinos" required></label>
            <label class="full">
                Imagen publicitaria
                <input id="public-ad-image-input" name="image" type="file" accept="image/*" @required(! $publicAd->exists)>
            </label>
            <div class="full">
                <span id="public-ad-image-preview-label" style="display:block;color:var(--muted);font-size:13px;font-weight:800;margin-bottom:8px;">{{ $publicAd->image_url ? 'Imagen actual' : 'Vista previa' }}</span>
                <div style="width:min(520px,100%);border:1px dashed var(--line);border-radius:8px;background:#f7f8fa;padding:10px;">
                    <img id="public-ad-image-preview" src="{{ $publicAd->image_url ? $publicAd->imageUrl() : '' }}" alt="Vista previa de imagen publicitaria" style="{{ $publicAd->image_url ? '' : 'display:none;' }}width:100%;aspect-ratio:16/10;object-fit:cover;border-radius:6px;">
                    <p id="public-ad-image-preview-empty" style="{{ $publicAd->image_url ? 'display:none;' : '' }}margin:0;color:var(--muted);font-size:13px;">Selecciona una imagen para verla antes de guardar.</p>
                </div>
            </div>
            <label class="check-row full"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $publicAd->is_active ?? true))> Publicidad activa</label>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('dashboard.public-ads.index') }}">Cancelar</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('public-ad-image-input');
            const previewImage = document.getElementById('public-ad-image-preview');
            const previewLabel = document.getElementById('public-ad-image-preview-label');
            const emptyState = document.getElementById('public-ad-image-preview-empty');

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
