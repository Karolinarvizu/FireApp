@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Reporte</h1>
    <form action="{{ route('reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description">{{ $report->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
