@extends('layouts.dashboard')

@section('title', $airbnb->exists ? 'Editar Airbnb' : 'Crear Airbnb')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $airbnb->exists ? 'Editar Airbnb' : 'Crear Airbnb' }}</h1>
            <p class="subhead">Asigna un código único y una zona compartida.</p>
        </div>
    </div>

    <form class="form-card" action="{{ $airbnb->exists ? route('dashboard.airbnbs.update', $airbnb) : route('dashboard.airbnbs.store') }}" method="POST">
        @csrf
        @if ($airbnb->exists) @method('PUT') @endif

        <div class="form-grid">
            <label>Nombre <input name="name" value="{{ old('name', $airbnb->name) }}" required></label>
            <label>Código <input name="code" value="{{ old('code', $airbnb->code) }}" placeholder="TORREA101" required></label>
            <label>Zona
                <select name="zone_id" required>
                    <option value="">Selecciona zona</option>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}" @selected(old('zone_id', $airbnb->zone_id) == $zone->id)>{{ $zone->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>Cuenta Airbnb
                <select name="user_id">
                    <option value="">Sin asignar</option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" @selected(old('user_id', $airbnb->user_id) == $owner->id)>{{ $owner->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>Anfitrión <input name="host" value="{{ old('host', $airbnb->host) }}"></label>
            <label>Torre / edificio <input name="tower" value="{{ old('tower', $airbnb->tower) }}"></label>
            <label class="full">Link de Airbnb <input name="airbnb_url" value="{{ old('airbnb_url', $airbnb->airbnb_url) }}" placeholder="https://www.airbnb.com/rooms/..."></label>
            <label class="full">Frase de página <input name="headline" value="{{ old('headline', $airbnb->headline) }}"></label>
            <label class="full">Descripción <textarea name="description">{{ old('description', $airbnb->description) }}</textarea></label>
            <label class="check-row full"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $airbnb->is_active ?? true))> Airbnb activo</label>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('dashboard.airbnbs.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
