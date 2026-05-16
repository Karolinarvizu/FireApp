@extends('layouts.dashboard')
@section('title', 'Editar Usuario')
@section('content')
<div class="container" style="max-width:500px">
    <h1><i class="fas fa-user-edit me-2" style="color:#cc2200;font-size:1rem"></i>Editar usuario</h1>
    @if($errors->any())
    <div class="alert alert-danger py-2">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $error)<li style="font-size:13px">{{ $error }}</li>@endforeach</ul>
    </div>
    @endif
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:24px;">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <hr style="border-color:#2a2a2a;margin:16px 0">
            <div style="font-size:11px;color:#666;margin-bottom:12px;">Deja en blanco para no cambiar la contraseña</div>
            <div class="mb-3">
                <label class="form-label" for="password">Nueva contraseña</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            </div>
            <div class="mb-4">
                <label class="form-label" for="role">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
