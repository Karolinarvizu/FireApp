@extends('layouts.dashboard')
@section('title', 'Editar Perfil')
@section('content')
<div class="container" style="max-width:600px">
    <h1><i class="fas fa-user-edit me-2" style="color:#cc2200;font-size:1rem"></i>Editar perfil</h1>

    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger py-2">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li style="font-size:13px">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:24px;">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <hr style="border-color:#2a2a2a;margin:20px 0">
            <div style="font-size:11px;color:#666;margin-bottom:12px;">Deja en blanco para no cambiar la contraseña</div>
            <div class="mb-3">
                <label class="form-label" for="password">Nueva contraseña</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
            </div>
            <div class="mb-4">
                <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
