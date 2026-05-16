@extends('layouts.dashboard')
@section('title', 'Detalle Reporte de Unidades')
@section('content')
<div class="container">
    <h1><i class="fas fa-truck me-2" style="color:#cc2200;font-size:1rem"></i>Detalle — Reporte de Unidades</h1>

    <div class="row mb-3">
        <div class="col-sm-6 col-md-4">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;">
                <div style="font-size:11px;color:#666;margin-bottom:4px;">Fecha</div>
                <div style="font-size:15px;color:#eee;">{{ \Carbon\Carbon::parse($unitReport->date)->format('d/m/Y') }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 mt-2 mt-sm-0">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;">
                <div style="font-size:11px;color:#666;margin-bottom:4px;">Entrega de turno</div>
                <div style="font-size:15px;color:#eee;">{{ $unitReport->entrega_turno ?? '—' }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 mt-2 mt-md-0">
            <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;">
                <div style="font-size:11px;color:#666;margin-bottom:4px;">Recepción de turno</div>
                <div style="font-size:15px;color:#ffaa33;">{{ $unitReport->recepcion_turno ?? '—' }}</div>
            </div>
        </div>
    </div>

    @foreach(json_decode($unitReport->units, true) as $unitKey => $details)
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:12px;">
        <div style="font-size:13px;font-weight:500;color:#ff6b47;margin-bottom:10px;">
            <i class="fas fa-truck me-2" style="font-size:12px"></i>
            {{ $details['name'] ?? str_replace('unit_', 'Unidad ', $unitKey) }}
        </div>
        <div class="row">
            <div class="col-md-8">
                <div style="font-size:11px;color:#666;margin-bottom:6px;">Servicios verificados</div>
                @if(!empty($details['services']))
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($details['services'] as $service)
                        <span style="background:rgba(26,138,58,0.15);color:#44cc66;font-size:11px;padding:3px 8px;border-radius:4px;">
                            <i class="fas fa-check me-1" style="font-size:10px"></i>{{ $service }}
                        </span>
                        @endforeach
                    </div>
                @else
                    <span style="color:#555;font-size:12px">Sin servicios registrados</span>
                @endif
            </div>
            <div class="col-md-4 mt-2 mt-md-0">
                <div style="font-size:11px;color:#666;margin-bottom:4px;">Gas/Diesel</div>
                <span style="background:rgba(255,140,0,0.15);color:#ffaa33;font-size:13px;padding:4px 10px;border-radius:4px;">
                    {{ $details['gas_diesel_status'] ?? 'No especificado' }}
                </span>
            </div>
        </div>
    </div>
    @endforeach

    @if($unitReport->gas_diesel_notes)
    <div style="background:#1e1e1e;border:1px solid #2a2a2a;border-radius:8px;padding:14px;margin-bottom:16px;">
        <div style="font-size:11px;color:#666;margin-bottom:4px;">Otros</div>
        <div style="color:#ccc;font-size:14px;">{{ $unitReport->gas_diesel_notes }}</div>
    </div>
    @endif

    <div style="font-size:12px;color:#555;margin-bottom:16px;">
        Creado por: <span style="color:#aaa">{{ $unitReport->user->name }}</span>
    </div>

    <a href="{{ route('unit_reports.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i>Regresar
    </a>
</div>
@endsection
