@extends('layouts.dashboard')
@section('title', 'Detalle — Parte de Novedades')
@section('content')
<div class="container">
    <h1><i class="fas fa-bell me-2" style="color:#cc2200;font-size:1rem"></i>Parte de Novedades</h1>

    <div class="row g-2 mb-3">
        <div class="col-6 col-md-3">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:12px;">
                <div style="font-size:10px;color:#666;margin-bottom:3px;">Fecha</div>
                <div style="font-size:14px;color:#eee;">{{ \Carbon\Carbon::parse($newsReport->date)->format('d/m/Y') }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:12px;">
                <div style="font-size:10px;color:#666;margin-bottom:3px;">Hora inicio</div>
                <div style="font-size:14px;color:#eee;">{{ $newsReport->start_time }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:12px;">
                <div style="font-size:10px;color:#666;margin-bottom:3px;">Hora fin</div>
                <div style="font-size:14px;color:#eee;">{{ $newsReport->end_time }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:12px;">
                <div style="font-size:10px;color:#666;margin-bottom:3px;">Creado por</div>
                <div style="font-size:14px;color:#eee;">{{ $newsReport->user->name }}</div>
            </div>
        </div>
    </div>

    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:10px;">
        <div style="font-size:11px;color:#666;margin-bottom:6px;">Dirección</div>
        <div style="color:#eee;font-size:14px;">{{ $newsReport->address }}</div>
    </div>

    <div class="row g-2 mb-2">
        <div class="col-md-6">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;height:100%;">
                <div style="font-size:11px;color:#666;margin-bottom:8px;">Unidades involucradas</div>
                <div class="d-flex flex-wrap gap-1">
                    @foreach(json_decode($newsReport->units, true) as $unit)
                    <span style="background:rgba(34,102,204,0.15);color:#5599ff;font-size:12px;padding:3px 9px;border-radius:4px;">{{ $unit }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;height:100%;">
                <div style="font-size:11px;color:#666;margin-bottom:8px;">Personal involucrado</div>
                <div class="d-flex flex-wrap gap-1">
                    @foreach(json_decode($newsReport->personnel, true) as $person)
                    <span style="background:rgba(204,34,0,0.12);color:#ff6b47;font-size:12px;padding:3px 9px;border-radius:4px;">{{ $person }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($newsReport->activities)
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:10px;">
        <div style="font-size:11px;color:#666;margin-bottom:6px;">Actividades realizadas</div>
        <div style="color:#ccc;font-size:14px;line-height:1.6;">{{ $newsReport->activities }}</div>
    </div>
    @endif

    @if($newsReport->others)
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:10px;">
        <div style="font-size:11px;color:#666;margin-bottom:6px;">Otros</div>
        <div style="color:#ccc;font-size:14px;">{{ $newsReport->others }}</div>
    </div>
    @endif

    @php $photos = json_decode($newsReport->photos, true) ?? []; @endphp
    @if(count($photos) > 0)
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:16px;">
        <div style="font-size:11px;color:#666;margin-bottom:10px;">Fotografías del servicio ({{ count($photos) }})</div>
        <div class="d-flex flex-wrap gap-2">
            @foreach($photos as $photo)
            <img src="{{ Storage::url($photo) }}"
                style="width:130px;height:130px;object-fit:cover;border-radius:8px;border:1px solid #2a2a2a;cursor:pointer;transition:opacity 0.2s;"
                onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1"
                onclick="abrirFoto('{{ Storage::url($photo) }}')"
                title="Ver foto completa">
            @endforeach
        </div>
    </div>

    <div id="lightbox" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.95);z-index:9999;justify-content:center;align-items:center;flex-direction:column;">
        <img id="lightbox-img" src="" style="max-width:95%;max-height:85vh;border-radius:8px;object-fit:contain;">
        <button onclick="cerrarFoto()" class="btn btn-secondary btn-sm mt-3">
            <i class="fas fa-times me-1"></i>Cerrar
        </button>
    </div>
    @endif

    <div class="d-flex flex-wrap gap-2 mt-2">
        <a href="{{ route('news_reports.download_pdf', $newsReport->id) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-file-pdf me-1"></i>Descargar PDF
        </a>
        @can('actualizar reportes')
        <a href="{{ route('news_reports.edit', $newsReport->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit me-1"></i>Editar
        </a>
        @endcan
        @can('borrar reportes')
        <form action="{{ route('news_reports.destroy', $newsReport->id) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('¿Está seguro de que desea eliminar este reporte?')">
                <i class="fas fa-trash-alt me-1"></i>Eliminar
            </button>
        </form>
        @endcan
        <a href="{{ route('news_reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Regresar
        </a>
    </div>
</div>

@section('scripts')
<script>
function abrirFoto(url) {
    document.getElementById('lightbox-img').src = url;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function cerrarFoto() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.getElementById('lightbox')?.addEventListener('click', function(e) {
    if (e.target === this) cerrarFoto();
});
</script>
@endsection
@endsection
