@extends('layouts.app')

@section('title', 'Detalles Despacho')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expeditions.index') }}">Despacho de Productos</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                    <i class="bi bi-eye text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Despacho #{{ $expedition->reference }}</h4>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y') }}
                        &nbsp;&bull;&nbsp;
                        @if ($expedition->status_expedition == 'Despachado')
                            <span class="badge badge-dark" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-box-arrow-right mr-1"></i> Despachado
                            </span>
                        @else
                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> {{ $expedition->status_expedition }}
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="{{ route('expeditions.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                @can('print_expeditions')
                    <a target="_blank" href="{{ route('expeditions.pdf', $expedition->id) }}"
                        class="btn btn-outline-secondary d-flex align-items-center d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-printer mr-2"></i> Imprimir
                    </a>
                    <a target="_blank" href="{{ route('expeditions.pdf', $expedition->id) }}"
                        class="btn d-flex align-items-center text-white d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;background:linear-gradient(135deg,#10b981,#059669);border:none;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
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
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #10b981;">
                        <i class="bi bi-gear mr-2" style="color:#10b981;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Información del Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        @php
                            $items = [
                                ['icon' => 'bi-thermometer-half', 'label' => 'Temp. Ambiente',      'value' => $expedition->temp_ambiente . ' °C'],
                                ['icon' => 'bi-geo-alt',          'label' => 'Área Despachada',      'value' => $expedition->area_expedition],
                                ['icon' => 'bi-person-check',     'label' => 'Persona que Recibe',   'value' => $expedition->staff_expedition],
                                ['icon' => 'bi-person-badge',     'label' => 'Operador',             'value' => $expedition->operator],
                            ];
                        @endphp
                        @foreach ($items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.82rem;">
                                <span class="text-muted">
                                    <i class="bi {{ $item['icon'] }} mr-1" style="color:#10b981;"></i>{{ $item['label'] }}
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
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-info-circle mr-2" style="color:#0ea5e9;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Registro</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        @php
                            $registros = [
                                ['icon' => 'bi-hash',          'color' => '#0ea5e9', 'label' => 'Número',             'value' => $expedition->reference],
                                ['icon' => 'bi-calendar-check','color' => '#0ea5e9', 'label' => 'Fecha de Despacho',  'value' => \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y')],
                                ['icon' => 'bi-layers',        'color' => '#0ea5e9', 'label' => 'Total Ítems',        'value' => $expedition->expeditionDetails->count() . ' ' . ($expedition->expeditionDetails->count() === 1 ? 'ítem' : 'ítems')],
                            ];
                        @endphp
                        @foreach ($registros as $reg)
                            <div class="d-flex align-items-start mb-3">
                                <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:34px;height:34px;background:rgba(14,165,233,0.1);">
                                    <i class="bi {{ $reg['icon'] }}" style="color:{{ $reg['color'] }};font-size:.9rem;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">{{ $reg['label'] }}</p>
                                    <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">{{ $reg['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- QR del Despacho --}}
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f59e0b;">
                        <i class="bi bi-qr-code mr-2" style="color:#f59e0b;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">QR del Despacho</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="padding:20px;">
                        <div class="mb-3">
                            {!! QrCode::size(130)->style('square')->generate(
                                'Ref: ' . $expedition->reference .
                                ' // Área: ' . $expedition->area_expedition .
                                ' // Recibe: ' . $expedition->staff_expedition .
                                ' // Fecha: ' . $expedition->created_up
                            ) !!}
                        </div>
                        <p class="text-muted mb-1 text-center" style="font-size:.8rem;">
                            <strong>{{ $expedition->reference }}</strong>
                        </p>
                        <p class="text-muted mb-0 text-center" style="font-size:.75rem;">
                            {{ \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y') }}
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
                    <i class="bi bi-list-ul mr-2" style="font-size:1.1rem;color:#10b981;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INSTRUMENTAL DESPACHADO</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 12px;border-radius:20px;background:rgba(16,185,129,0.12);color:#059669;">
                    {{ $expedition->expeditionDetails->count() }} {{ $expedition->expeditionDetails->count() === 1 ? 'ítem' : 'ítems' }}
                </span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                @foreach (['Instrumental', 'Código', 'Cantidad', 'Envoltura', 'Expiración', 'Paciente', 'Casa Comercial'] as $col)
                                    <th class="align-middle border-0"
                                        style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;white-space:nowrap;">
                                        {{ $col }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expedition->expeditionDetails as $item)
                                <tr style="border-color:#f1f5f9;">
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="font-weight-semibold text-dark" style="font-size:.875rem;">{{ $item->product_name }}</span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                            {{ $item->product_code }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <span class="font-weight-semibold">{{ $item->product_quantity }}</span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        {{ $item->product_package_wrap }}
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;color:#64748b;">
                                        {{ $item->product_expiration }}
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        {{ $item->product_patient ?: '—' }}
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        {{ $item->product_outside_company ?: '—' }}
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
