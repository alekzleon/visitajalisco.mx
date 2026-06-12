@extends('layouts.dashboard')

@section('title', $user->exists ? 'Editar usuario' : 'Crear usuario')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $user->exists ? 'Editar usuario' : 'Crear usuario' }}</h1>
            <p class="subhead">Define el rol operativo de cada cuenta.</p>
        </div>
    </div>

    <form class="form-card" action="{{ $user->exists ? route('dashboard.users.update', $user) : route('dashboard.users.store') }}" method="POST">
        @csrf
        @if ($user->exists) @method('PUT') @endif

        <div class="form-grid">
            <label>Nombre <input name="name" value="{{ old('name', $user->name) }}" required></label>
            <label>Correo <input name="email" type="email" value="{{ old('email', $user->email) }}" required></label>
            <label>Rol
                <select name="role" required>
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrador</option>
                    <option value="airbnb" @selected(old('role', $user->role) === 'airbnb')>Airbnb</option>
                    <option value="business" @selected(old('role', $user->role) === 'business')>Negocio</option>
                </select>
            </label>
            <label>Contraseña <input name="password" type="password" placeholder="{{ $user->exists ? 'Dejar vacío para conservar' : 'Mínimo 8 caracteres' }}"></label>
        </div>

        <div class="form-actions">
            <button class="button" type="submit">Guardar</button>
            <a class="button secondary" href="{{ route('dashboard.users.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
