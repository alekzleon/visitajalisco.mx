@extends('layouts.dashboard')

@section('title', 'Editar Airbnb')

@section('content')
    <div class="page-head">
        <div>
            <h1>Editar Airbnb</h1>
            <p class="subhead">Zona: {{ $airbnb->zone?->name }}. Código: {{ $airbnb->code }}. No puedes cambiar zona, código, cuenta ni edificio.</p>
        </div>
    </div>

    <form class="form-card" action="{{ route('airbnb.airbnbs.update', $airbnb) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <label>Nombre de anfitrión <input name="host" value="{{ old('host', $airbnb->host) }}" placeholder="Nombre visible del anfitrión"></label>
            <label>Link de Airbnb <input name="airbnb_url" value="{{ old('airbnb_url', $airbnb->airbnb_url) }}" placeholder="https://www.airbnb.com/rooms/..."></label>
            <label class="full">Frase de página <input name="headline" value="{{ old('headline', $airbnb->headline) }}"></label>
            <label class="full">Descripción <textarea name="description">{{ old('description', $airbnb->description) }}</textarea></label>
            <label class="full">
                Galería del hospedaje, máximo 5 imágenes
                <input id="airbnb-gallery-input" name="gallery_images[]" type="file" accept="image/*" multiple>
            </label>
            <div class="full">
                <span style="display:block;color:var(--muted);font-size:13px;font-weight:800;margin-bottom:8px;">Galería actual / vista previa</span>
                <div id="airbnb-gallery-preview" style="display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:10px;">
                    @forelse ($airbnb->galleryImageUrls() as $image)
                        <img src="{{ $image }}" alt="Imagen del hospedaje" style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;border:1px solid var(--line);">
                    @empty
                        <p style="grid-column:1/-1;margin:0;color:var(--muted);font-size:13px;">Selecciona imágenes para verlas antes de guardar.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('airbnb.dashboard') }}">Cancelar</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('airbnb-gallery-input');
            const preview = document.getElementById('airbnb-gallery-preview');

            if (!input || !preview) {
                return;
            }

            input.addEventListener('change', function () {
                const files = Array.from(input.files || []).slice(0, 5);
                preview.innerHTML = '';

                if (!files.length) {
                    preview.innerHTML = '<p style="grid-column:1/-1;margin:0;color:var(--muted);font-size:13px;">Selecciona imágenes para verlas antes de guardar.</p>';
                    return;
                }

                files.forEach(function (file) {
                    const reader = new FileReader();

                    reader.addEventListener('load', function () {
                        const image = document.createElement('img');
                        image.src = reader.result;
                        image.alt = 'Vista previa del hospedaje';
                        image.style.cssText = 'width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;border:1px solid var(--line);';
                        preview.appendChild(image);
                    });

                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
@endsection
