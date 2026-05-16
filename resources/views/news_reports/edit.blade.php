@extends('layouts.dashboard')
@section('title', 'Editar Reporte de Novedad')
@section('content')
<div class="container">
    <h1><i class="fas fa-edit me-2" style="color:#cc2200;font-size:1rem"></i>Editar Reporte de Novedad</h1>

    @if($errors->any())
    <div class="alert alert-danger py-2">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li style="font-size:13px">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('news_reports.update', $newsReport->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:10px;padding:20px;margin-bottom:12px;">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="date">Fecha</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $newsReport->date) }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="start_time">Hora inicio</label>
                    <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $newsReport->start_time) }}" required>
                    @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="end_time">Hora fin</label>
                    <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $newsReport->end_time) }}" required>
                    @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="address">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $newsReport->address) }}" required>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="units">Unidades involucradas</label>
                    <select name="units[]" id="units" class="form-control select2 @error('units') is-invalid @enderror" multiple required>
                        @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->name }}" {{ in_array($vehicle->name, old('units', $newsReport->units)) ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                        @endforeach
                    </select>
                    @error('units')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="personnel">Personal involucrado</label>
                    <select name="personnel[]" id="personnel" class="form-control select2 @error('personnel') is-invalid @enderror" multiple required>
                        @foreach($users as $user)
                        <option value="{{ $user->name }}" {{ in_array($user->name, old('personnel', $newsReport->personnel)) ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('personnel')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="activities">Actividades realizadas</label>
                    <textarea name="activities" id="activities" class="form-control @error('activities') is-invalid @enderror" rows="3">{{ old('activities', $newsReport->activities) }}</textarea>
                    @error('activities')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="others">Otros</label>
                    <textarea name="others" id="others" class="form-control @error('others') is-invalid @enderror" rows="2">{{ old('others', $newsReport->others) }}</textarea>
                    @error('others')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Fotos existentes --}}
                @php $photos = json_decode($newsReport->photos, true) ?? []; @endphp
                @if(count($photos) > 0)
                <div class="col-12">
                    <label class="form-label">Fotos actuales</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($photos as $index => $photo)
                        <div id="photo-container-{{ $index }}" style="position:relative;">
                            <img src="{{ Storage::url($photo) }}"
                                style="width:90px;height:90px;object-fit:cover;border-radius:6px;border:1px solid #2a2a2a;cursor:pointer;"
                                onclick="abrirFoto('{{ Storage::url($photo) }}')" title="Ver foto">
                            <button type="button" onclick="eliminarFoto({{ $index }}, '{{ $photo }}')"
                                style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;background:#991111;border:none;border-radius:50%;color:#fff;font-size:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                                ×
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="delete_photos" id="delete_photos" value="">
                </div>
                @endif

                <div class="col-12">
                    <label class="form-label" for="photos">Agregar más fotos</label>
                    <input type="file" name="photos[]" id="photos" class="form-control" accept="image/*" multiple>
                    <div style="font-size:11px;color:#666;margin-top:4px;">Máx. 5MB por foto.</div>
                    <div id="photo-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            <a href="{{ route('news_reports.show', $newsReport->id) }}" class="btn btn-secondary btn-sm">Cancelar</a>
        </div>
    </form>
</div>

<div id="lightbox" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.95);z-index:9999;justify-content:center;align-items:center;flex-direction:column;">
    <img id="lightbox-img" src="" style="max-width:95%;max-height:85vh;border-radius:8px;object-fit:contain;">
    <button onclick="cerrarFoto()" class="btn btn-secondary btn-sm mt-3"><i class="fas fa-times me-1"></i>Cerrar</button>
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

var fotosAEliminar = [];
function eliminarFoto(index, path) {
    if (confirm('¿Eliminar esta foto?')) {
        fotosAEliminar.push(path);
        document.getElementById('delete_photos').value = JSON.stringify(fotosAEliminar);
        document.getElementById('photo-container-' + index).style.display = 'none';
    }
}
function abrirFoto(url) {
    document.getElementById('lightbox-img').src = url;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function cerrarFoto() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) cerrarFoto();
});
</script>
@endsection
