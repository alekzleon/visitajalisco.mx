@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')
    <div class="page-head">
        <div>
            <h1>Usuarios</h1>
            <p class="subhead">Cuentas por rol: administrador, Airbnb y negocio.</p>
        </div>
        <a class="button" href="{{ route('dashboard.users.create') }}">Crear usuario</a>
    </div>

    <div class="table-card">
        <table>
            <thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Creado</th><th>Acciones</th></tr></thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td><span class="pill">{{ $user->role }}</span></td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td><a class="link-action" href="{{ route('dashboard.users.edit', $user) }}">Editar</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5">Aún no hay usuarios.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
