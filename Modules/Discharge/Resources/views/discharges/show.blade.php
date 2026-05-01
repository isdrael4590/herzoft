@extends('layouts.app')

@section('title', 'Detalles Ciclo Procesado')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Descarga de Ciclos</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
                    <i class="bi bi-eye text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Ciclo #{{ $discharge->reference }}</h4>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y H:i') }}
                        &nbsp;&bull;&nbsp;
                        @if ($discharge->status_cycle == 'Ciclo Aprobado')
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Ciclo Aprobado
                            </span>
                        @elseif ($discharge->status_cycle == 'Ciclo Falla')
                            <span class="badge badge-danger" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-x-circle mr-1"></i> Ciclo Falla
                            </span>
                        @elseif ($discharge->status_cycle == 'En Curso')
                            <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-arrow-repeat mr-1"></i> En Curso
                            </span>
                        @else
                            <span class="badge badge-dark" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> {{ $discharge->status_cycle }}
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="{{ route('discharges.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                @can('print_discharges')
                    <a target="_blank" href="{{ route('discharges.pdf', $discharge->id) }}"
                        class="btn btn-outline-secondary d-flex align-items-center d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-printer mr-2"></i> Imprimir
                    </a>
                    <a target="_blank" href="{{ route('discharges.pdf', $discharge->id) }}"
                        class="btn d-flex align-items-center text-white d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;background:linear-gradient(135deg,#8b5cf6,#7c3aed);border:none;box-shadow:0 4px 12px rgba(139,92,246,0.35);">
                        <i class="bi bi-file-earmark-pdf mr-2"></i> Guardar PDF
                    </a>
                @endcan
            </div>
        </div>

        {{-- Tarjetas de información --}}
        <div class="row mb-4">

            {{-- Institución --}}
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #4f46e5;">
                        <i class="bi bi-hospital mr-2" style="color:#4f46e5;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Institución</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <p class="font-weight-bold text-dark mb-1" style="font-size:.95rem;">{{ institutes()->institute_name }}</p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-upc mr-1"></i> {{ institutes()->institute_code }}
                        </p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-diagram-3 mr-1"></i> {{ institutes()->institute_area }}
                        </p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-geo-alt mr-1"></i> {{ institutes()->institute_address }}
                        </p>
                        <p class="text-muted mb-0" style="font-size:.82rem;">
                            <i class="bi bi-globe mr-1"></i> {{ institutes()->institute_city }}, {{ institutes()->institute_country }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Información del Proceso --}}
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #8b5cf6;">
                        <i class="bi bi-gear mr-2" style="color:#8b5cf6;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Información del Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        @php
                            $items = [
                                ['icon' => 'bi-tag',           'label' => 'Ref. Proceso',            'value' => $labelqr->reference],
                                ['icon' => 'bi-cpu',           'label' => 'Equipo',                  'value' => $discharge->machine_name],
                                ['icon' => 'bi-box-seam',      'label' => 'Lote del Equipo',          'value' => $discharge->lote_machine],
                                ['icon' => 'bi-droplet',       'label' => 'Lote Agente Esteril.',    'value' => $discharge->lote_agente],
                                ['icon' => 'bi-thermometer',   'label' => 'Temp. Equipo',            'value' => $discharge->temp_machine],
                                ['icon' => 'bi-sliders',       'label' => 'Tipo de Programa',        'value' => $discharge->type_program],
                                ['icon' => 'bi-thermometer-half', 'label' => 'Temp. Ambiente',       'value' => $discharge->temp_ambiente],
                            ];
                        @endphp
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.82rem;">
                                <span class="text-muted">
                                    <i class="bi {{ $item['icon'] }} mr-1" style="color:#8b5cf6;"></i>{{ $item['label'] }}
                                </span>
                                <span class="font-weight-semibold text-dark">{{ $item['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Registro --}}
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #10b981;">
                        <i class="bi bi-info-circle text-success mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Registro</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-hash text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Número</p>
                                <p class="mb-0 font-weight-bold text-dark" style="font-size:.95rem;">{{ $discharge->reference }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-virus text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Lote Biológico</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">{{ $discharge->lote_biologic }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-check2-all text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Validación Biológica</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">{{ $discharge->validation_biologic }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-person-badge text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">
                                    {{ $discharge->operator == $discharge->operator_discharge ? 'Operario Carga/Descarga' : 'Operario Carga' }}
                                </p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">{{ $discharge->operator }}</p>
                            </div>
                        </div>
                        @if ($discharge->operator != $discharge->operator_discharge)
                            <div class="d-flex align-items-start">
                                <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                    <i class="bi bi-person-check text-success" style="font-size:.9rem;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Operario Descarga</p>
                                    <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">{{ $discharge->operator_discharge }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- QR de Proceso --}}
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f59e0b;">
                        <i class="bi bi-qr-code mr-2" style="color:#f59e0b;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">QR del Proceso</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="padding:20px;">
                        <div class="mb-3">
                            {!! QrCode::size(130)->style('square')->generate(
                                'Ref. Proceso: ' . $discharge->labelqr_id .
                                ' // Ref. Des: ' . $discharge->reference .
                                ' // Equipo: ' . $discharge->machine_name .
                                ' // Lote: ' . $discharge->lote_machine .
                                ' // Fecha: ' . $discharge->updated_at
                            ) !!}
                        </div>
                        <p class="text-muted mb-1 text-center" style="font-size:.8rem;">
                            <strong>{{ $discharge->reference }}</strong>
                        </p>
                        <p class="text-muted mb-0 text-center" style="font-size:.75rem;">
                            {{ \Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Tabla de Instrumental --}}
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul mr-2" style="font-size:1.1rem;color:#8b5cf6;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INSTRUMENTAL PROCESADO</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 12px;border-radius:20px;background:rgba(139,92,246,0.12);color:#7c3aed;">
                    {{ $discharge->dischargeDetails->count() }} {{ $discharge->dischargeDetails->count() === 1 ? 'ítem' : 'ítems' }}
                </span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                @foreach ([
                                    'Instrumental', 'Código', 'Cant. Procesada', 'Cant. Validada',
                                    'Envoltura', 'Valid. Embalaje', 'Ind. Químico',
                                    'Vencimiento', 'Paciente / Casa Com.', 'QR Paquete'
                                ] as $col)
                                    <th class="align-middle border-0"
                                        style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;white-space:nowrap;">
                                        {{ $col }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discharge->dischargeDetails as $item)
                                <tr style="border-color:#f1f5f9;">
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="font-weight-semibold text-dark" style="font-size:.875rem;">{{ $item->product_name }}</span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                            {{ $item->product_code }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <span class="font-weight-semibold">{{ $item->product_quantity }}</span>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <span class="font-weight-semibold">{{ $item->product_quantity }}</span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        {{ $item->product_package_wrap }}
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        @if ($item->product_eval_package == 'Correcto' || $item->product_eval_package == 'Aprobado')
                                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">{{ $item->product_eval_package }}</span>
                                        @else
                                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">{{ $item->product_eval_package }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        {{ $item->product_eval_indicator }}
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-muted" style="font-size:.8rem;">
                                            @if ($item->product_expiration == 180) 6 Meses
                                            @elseif ($item->product_expiration == 270) 9 Meses
                                            @elseif ($item->product_expiration == 365) 12 Meses
                                            @elseif ($item->product_expiration == 545) 18 Meses
                                            @else {{ $item->product_expiration }} Días
                                            @endif
                                        </span>
                                        <br>
                                        <span class="font-weight-semibold text-dark" style="font-size:.8rem;">
                                            {{ \Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d M, Y') }}
                                        </span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <span>{{ $item->product_patient ?: '—' }}</span>
                                        @if ($item->product_outside_company)
                                            <br><span class="text-muted" style="font-size:.78rem;">{{ $item->product_outside_company }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        {!! QrCode::size(50)->style('square')->generate(
                                            $discharge->reference .
                                            ' // Lote: ' . $discharge->lote_machine .
                                            ' // Cod: ' . $item->product_code .
                                            ' // Elab: ' . $item->updated_at .
                                            ' // Venc: ' . \Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d M, Y')
                                        ) !!}
                                        <div style="font-size:.7rem;color:#64748b;margin-top:4px;">
                                            Lote: {{ $discharge->lote_machine }}<br>
                                            Cód: {{ $item->product_code }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
