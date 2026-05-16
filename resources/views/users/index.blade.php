@extends('layouts.dashboard')
@section('title', 'Usuarios')
@section('content')
<div class="container">
    <h1><i class="fas fa-users me-2" style="color:#cc2200;font-size:1rem"></i>Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Crear usuario
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped has-actions scroll-mobile">
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th style="width:100px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td style="color:#666">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td style="color:#aaa;font-size:13px">{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        <span style="background:rgba(204,34,0,0.15);color:#ff6b47;font-size:11px;padding:2px 8px;border-radius:10px;">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="table-actions">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                onclick="return confirm('¿Está seguro de que desea eliminar este usuario?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
