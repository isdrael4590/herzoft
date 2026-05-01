@extends('layouts.app')

@section('title', 'Detalle Descarga Lavado')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('descarga-lavado.index') }}">Descarga Lavado</a></li>
        <li class="breadcrumb-item active">{{ $descargaLavado->reference }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-droplet-half text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Descarga #{{ $descargaLavado->reference }}</h4>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($descargaLavado->created_at)->format('d M, Y H:i') }}
                        &nbsp;&bull;&nbsp;
                        Lavado: <strong>{{ optional($descargaLavado->lavado)->reference ?? '-' }}</strong>
                        &nbsp;&bull;&nbsp;
                        @if($descargaLavado->status === 'Registrado')
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Registrado
                            </span>
                        @else
                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> {{ $descargaLavado->status }}
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="{{ route('descarga-lavado.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
            </div>
        </div>

        {{-- Info Cards --}}
        <div class="row mb-4">

            {{-- Datos del proceso --}}
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-gear mr-2" style="color:#0ea5e9;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        @php
                            $statusCiclo = $descargaLavado->status_ciclo ?? 'Pendiente';
                            $cicloBadge = match($statusCiclo) {
                                'Ciclo Correcto' => ['badge-success', 'bi-check-circle'],
                                'Ciclo con Falla' => ['badge-danger', 'bi-x-circle'],
                                'Cargar' => ['badge-info', 'bi-arrow-repeat'],
                                default => ['badge-secondary', 'bi-clock'],
                            };
                            $items = [
                                ['icon' => 'bi-cpu',              'label' => 'Equipo',          'value' => $descargaLavado->equipo ?? '-'],
                                ['icon' => 'bi-hash',             'label' => 'Lote',            'value' => $descargaLavado->lote ?? '-'],
                                ['icon' => 'bi-list-check',       'label' => 'Programa',        'value' => $descargaLavado->programa_lavado ?? '-'],
                                ['icon' => 'bi-thermometer-half', 'label' => 'Temperatura',     'value' => ($descargaLavado->temperatura ?? '-') . ' °C'],
                                ['icon' => 'bi-person-badge',     'label' => 'Operador',        'value' => $descargaLavado->operator],
                            ];
                        @endphp
                        <div class="mb-2" style="font-size:.82rem;">
                            <span class="badge {{ $cicloBadge[0] }}"
                                style="font-size:.78rem;padding:5px 12px;border-radius:20px;">
                                <i class="bi {{ $cicloBadge[1] }} mr-1"></i>
                                {{ $statusCiclo }}
                            </span>
                        </div>
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.82rem;">
                                <span class="text-muted">
                                    <i class="bi {{ $item['icon'] }} mr-1"></i> {{ $item['label'] }}
                                </span>
                                <span class="font-weight-semibold text-dark">{{ $item['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Lavado origen --}}
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f97316;">
                        <i class="bi bi-droplet mr-2" style="color:#f97316;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Lavado Origen</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        @if($descargaLavado->lavado)
                            <p class="font-weight-bold text-dark mb-2" style="font-size:.95rem;">
                                {{ $descargaLavado->lavado->reference }}
                            </p>
                            <div class="d-flex justify-content-between mb-2" style="font-size:.82rem;">
                                <span class="text-muted"><i class="bi bi-hash mr-1"></i> Lote</span>
                                <span class="font-weight-semibold">{{ $descargaLavado->lavado->lote ?? '-' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size:.82rem;">
                                <span class="text-muted"><i class="bi bi-cpu mr-1"></i> Equipo</span>
                                <span class="font-weight-semibold">{{ $descargaLavado->lavado->equipo ?? '-' }}</span>
                            </div>
                            <a href="{{ route('lavados.show', $descargaLavado->lavado->id) }}"
                                class="btn btn-sm btn-outline-warning mt-2"
                                style="border-radius:6px;font-size:.8rem;">
                                <i class="bi bi-box-arrow-up-right mr-1"></i> Ver Lavado
                            </a>
                        @else
                            <span class="text-muted" style="font-size:.85rem;">Sin lavado vinculado</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Nota --}}
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #94a3b8;">
                        <i class="bi bi-chat-text mr-2 text-secondary"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Nota</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <p style="font-size:.85rem;color:#475569;line-height:1.6;">
                            {{ $descargaLavado->note ?? 'Sin observaciones.' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Tabla de ítems --}}
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul text-info mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Instrumental Descargado
                    </span>
                </div>
                <span class="badge badge-info" style="font-size:.8rem;">
                    {{ $descargaLavado->descargaLavadoDetalles->count() }} ítem(s)
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">#</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Código</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Nombre</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;" class="text-center">Cantidad</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Paciente</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Info</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Empresa Ext.</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Área</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($descargaLavado->descargaLavadoDetalles as $index => $det)
                                <tr>
                                    <td style="font-size:.82rem;color:#94a3b8;">{{ $index + 1 }}</td>
                                    <td style="font-size:.85rem;">
                                        <span class="badge badge-light border">{{ $det->product_code }}</span>
                                    </td>
                                    <td style="font-size:.85rem;font-weight:500;">{{ $det->product_name }}</td>
                                    <td style="font-size:.85rem;" class="text-center">
                                        <span class="badge badge-secondary">{{ $det->product_quantity }}</span>
                                    </td>
                                    <td style="font-size:.85rem;">{{ $det->product_patient ?? '-' }}</td>
                                    <td style="font-size:.85rem;">{{ $det->product_info ?? '-' }}</td>
                                    <td style="font-size:.85rem;">{{ $det->product_outside_company ?? '-' }}</td>
                                    <td style="font-size:.85rem;">{{ $det->product_area ?? '-' }}</td>
                                    <td style="font-size:.85rem;">{{ $det->product_type_process ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4" style="font-size:.85rem;">
                                        Sin ítems registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
