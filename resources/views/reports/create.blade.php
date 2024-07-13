@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Reporte</h1>

    <!-- Formulario para crear un nuevo reporte -->
    <form action="{{ route('reports.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Crear Reporte</button>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
