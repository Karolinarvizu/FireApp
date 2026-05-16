@extends('layouts.dashboard')
@section('title', 'Detalle Reporte de Instalaciones')
@section('content')
<div class="container">
    <h1><i class="fas fa-building me-2" style="color:#cc2200;font-size:1rem"></i>Detalle — Reporte de Instalaciones</h1>

    <div class="row mb-3">
        <div class="col-sm-6">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;">
                <div style="font-size:11px;color:#666;margin-bottom:4px;">Fecha</div>
                <div style="font-size:15px;color:#eee;">{{ \Carbon\Carbon::parse($installationReport->date)->format('d/m/Y') }}</div>
            </div>
        </div>
        <div class="col-sm-6 mt-2 mt-sm-0">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;">
                <div style="font-size:11px;color:#666;margin-bottom:4px;">Creado por</div>
                <div style="font-size:15px;color:#eee;">{{ $installationReport->user->name }}</div>
            </div>
        </div>
    </div>

    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:12px;">
        <div style="font-size:11px;color:#666;margin-bottom:8px;">Áreas atendidas</div>
        <div class="d-flex flex-wrap gap-2">
            @foreach(json_decode($installationReport->cleaned_rooms, true) as $room)
            <span style="background:rgba(26,138,58,0.15);color:#44cc66;font-size:12px;padding:4px 10px;border-radius:4px;">
                <i class="fas fa-check me-1" style="font-size:10px"></i>{{ $room }}
            </span>
            @endforeach
        </div>
    </div>

    @if($installationReport->notes)
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;margin-bottom:16px;">
        <div style="font-size:11px;color:#666;margin-bottom:4px;">Observaciones</div>
        <div style="color:#ccc;font-size:14px;">{{ $installationReport->notes }}</div>
    </div>
    @endif

    <a href="{{ route('installation_reports.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i>Regresar
    </a>
</div>
@endsection
