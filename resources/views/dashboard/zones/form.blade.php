@extends('layouts.dashboard')

@section('title', $zone->exists ? 'Editar zona' : 'Crear zona')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $zone->exists ? 'Editar zona' : 'Crear zona' }}</h1>
            <p class="subhead">La zona es lo que compartirán varios Airbnbs cercanos.</p>
        </div>
    </div>

    <form class="form-card" action="{{ $zone->exists ? route('dashboard.zones.update', $zone) : route('dashboard.zones.store') }}" method="POST">
        @csrf
        @if ($zone->exists) @method('PUT') @endif

        <div class="form-grid">
            <label>Nombre <input name="name" value="{{ old('name', $zone->name) }}" required></label>
            @if ($zone->exists)
                <label>Slug <input value="{{ $zone->slug }}" disabled></label>
            @endif
            <label class="full">Área <input name="area" value="{{ old('area', $zone->area) }}" placeholder="Providencia, Chapultepec, Centro..."></label>
            <label class="full">Resumen <textarea name="summary">{{ old('summary', $zone->summary) }}</textarea></label>
            <label class="check-row full"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $zone->is_active ?? true))> Zona activa</label>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('dashboard.zones.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
