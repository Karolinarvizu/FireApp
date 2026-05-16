@extends('layouts.dashboard')
@section('title', 'Crear Reporte de Novedad')
@section('content')
<div class="container">
    <h1><i class="fas fa-plus-circle me-2" style="color:#cc2200;font-size:1rem"></i>Crear Reporte de Novedad</h1>

    @if($errors->any())
    <div class="alert alert-danger py-2">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li style="font-size:13px">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('news_reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:20px;margin-bottom:12px;">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="date">Fecha</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="start_time">Hora inicio</label>
                    <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
                    @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="end_time">Hora fin</label>
                    <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
                    @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="address">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="units">Unidades involucradas</label>
                    <select name="units[]" id="units" class="form-control select2 @error('units') is-invalid @enderror" multiple required>
                        @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->name }}" {{ in_array($vehicle->name, old('units', [])) ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                        @endforeach
                    </select>
                    @error('units')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="personnel">Personal involucrado</label>
                    <select name="personnel[]" id="personnel" class="form-control select2 @error('personnel') is-invalid @enderror" multiple required>
                        @foreach($users as $user)
                        <option value="{{ $user->name }}" {{ in_array($user->name, old('personnel', [])) ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('personnel')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="activities">Actividades realizadas</label>
                    <textarea name="activities" id="activities" class="form-control @error('activities') is-invalid @enderror" rows="3">{{ old('activities') }}</textarea>
                    @error('activities')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="others">Otros</label>
                    <textarea name="others" id="others" class="form-control @error('others') is-invalid @enderror" rows="2">{{ old('others') }}</textarea>
                    @error('others')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="photos">Fotos del servicio</label>
                    <input type="file" name="photos[]" id="photos" class="form-control @error('photos.*') is-invalid @enderror" accept="image/*" multiple>
                    <div style="font-size:11px;color:#666;margin-top:4px;">Puedes seleccionar varias fotos. Máx. 5MB por foto.</div>
                    @error('photos.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    <div id="photo-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">Guardar reporte</button>
            <a href="{{ route('news_reports.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#personnel').select2({ width: '100%', placeholder: '-- Seleccionar personal --' });
    $('#units').select2({ width: '100%', placeholder: '-- Seleccionar unidades --' });

    var allFiles = new DataTransfer();
    $('#photos').on('change', function() {
        Array.from(this.files).forEach(function(file) { allFiles.items.add(file); });
        document.getElementById('photos').files = allFiles.files;
        $('#photo-preview').empty();
        Array.from(allFiles.files).forEach(function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#photo-preview').append('<img src="' + e.target.result + '" style="width:90px;height:90px;object-fit:cover;border-radius:6px;border:1px solid #2a2a2a;">');
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endsection
