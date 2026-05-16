@extends('layouts.dashboard')
@section('title', 'Crear Usuario')
@section('content')
<div class="container" style="max-width:500px">
    <h1><i class="fas fa-user-plus me-2" style="color:#cc2200;font-size:1rem"></i>Crear usuario</h1>
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:24px;">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-4">
                <label class="form-label" for="role">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Crear usuario</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
