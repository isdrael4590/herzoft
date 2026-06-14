@extends('layouts.app')

@section('title', ' Detalles Etiquetas Generadas')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('labelqrs.index') }}">Etiquetas Generadas</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    @php
        $isSteam = $labelqr->machine_type == 'Autoclave';
        $isHpo   = $labelqr->machine_type == 'Peroxido';
    @endphp

    <div class="container-fluid">
        @if (session()->has('exito'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('exito') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('advertencia'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('advertencia') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header d-flex flex-wrap align-items-center" style="gap:8px;">
                        <div class="mr-2">
                            Referencia: <strong>{{ $labelqr->reference }}</strong>
                        </div>

                        {{-- Tipo de proceso badge --}}
                        @if ($isSteam)
                            <span class="badge badge-pill"
                                  style="background-color:#17a2b8; color:#fff; font-size:.85rem; padding:6px 12px;">
                                <i class="bi bi-thermometer-high"></i> STEAM — Alta Temperatura (Autoclave)
                            </span>
                        @elseif ($isHpo)
                            <span class="badge badge-pill"
                                  style="background-color:#6f42c1; color:#fff; font-size:.85rem; padding:6px 12px;">
                                <i class="bi bi-wind"></i> HPO — Baja Temperatura (Peróxido)
                            </span>
                        @endif

                        <div class="ml-auto d-flex flex-wrap align-items-center" style="gap:6px;">
                            @can('create_labelqr_discharges')
                                @if ($labelqr->status_cycle == 'Cargar')
                                    <a href="{{ route('labelqr-discharges.create', $labelqr->id) }}"
                                       class="btn btn-sm btn-success d-print-none">
                                        <i class="bi bi-check2-circle"></i> Enviar a Ciclo
                                    </a>
                                @endif
                            @endcan

                            @can('print_labelqrs')
                                @php
                                    $labelConfig = match(institutes()->label_type ?? 'qr') {
                                        'barcode' => ['route' => 'labelqrs_label.pdf',        'label' => 'Ver Etiquetas Barcode', 'icon' => 'bi-tag'],
                                        'simple'  => ['route' => 'labelqrs_label.simple',     'label' => 'Ver Etiquetas Simple',  'icon' => 'bi-tag'],
                                        default   => ['route' => 'labelqrs_label.qr-preview', 'label' => 'Ver Etiquetas QR',      'icon' => 'bi-qr-code'],
                                    };
                                @endphp
                                <a target="_blank" class="btn btn-sm btn-secondary d-print-none"
                                   href="{{ route($labelConfig['route'], $labelqr->id) }}">
                                    <i class="bi {{ $labelConfig['icon'] }}"></i> {{ $labelConfig['label'] }}
                                </a>
                            @endcan
                            @can('print_labelqrs_direct')
                                <a class="btn btn-sm btn-dark d-print-none"
                                   href="{{ route('labelqrs_label.print', $labelqr->id) }}">
                                    <i class="bi bi-printer"></i> Imprimir directa
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Info row --}}
                        <div class="row mb-4">
                            {{-- Institución --}}
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong>Hospital:</strong> {{ institutes()->institute_name }}</div>
                                <div><strong>Dirección:</strong> {{ institutes()->institute_address }}</div>
                                <div><strong>Área:</strong> {{ institutes()->institute_area }}</div>
                                <div><strong>Ciudad:</strong> {{ institutes()->institute_city }}</div>
                                <div><strong>País:</strong> {{ institutes()->institute_country }}</div>
                            </div>

                            {{-- Información del Proceso --}}
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información de Proceso:</h5>
                                <div><strong>Tipo:</strong>
                                    @if ($isSteam)
                                        <span class="text-info font-weight-bold">STEAM / Autoclave</span>
                                    @elseif ($isHpo)
                                        <span style="color:#6f42c1;" class="font-weight-bold">HPO / Peróxido</span>
                                    @endif
                                </div>
                                <div><strong>Equipo:</strong> {{ $labelqr->machine_name }}</div>
                                <div><strong>Lote del Equipo:</strong> {{ $labelqr->lote_machine }}</div>
                                <div><strong>Temp. Equipo:</strong> {{ $labelqr->temp_machine }}°C</div>
                                @if ($isHpo && $labelqr->lote_agente)
                                    <div><strong>Lote Agente:</strong> {{ $labelqr->lote_agente }}</div>
                                @endif
                                <div><strong>Tipo de Programa:</strong> {{ $labelqr->type_program }}</div>
                                <div><strong>Temp. Ambiente:</strong> {{ $labelqr->temp_ambiente }}</div>
                                <div><strong>Operario:</strong> {{ $labelqr->operator }}</div>
                            </div>

                            {{-- Registro INFO --}}
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong>{{ $labelqr->reference }}</strong></div>
                                <div><strong>Fecha Proceso:</strong>
                                    {{ \Carbon\Carbon::parse($labelqr->created_up)->format('d M, Y') }}
                                </div>
                                <div><strong>Estado del Ciclo:</strong>
                                    @php
                                        $statusColors = [
                                            'Cargar'   => 'badge-warning',
                                            'En Curso' => 'badge-primary',
                                            'Cargado'  => 'badge-success',
                                            'Pendiente'=> 'badge-secondary',
                                        ];
                                        $statusClass = $statusColors[$labelqr->status_cycle] ?? 'badge-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $labelqr->status_cycle }}</span>
                                </div>
                                <div><strong>Lote Biológico:</strong> {{ $labelqr->lote_biologic }}</div>
                                <div><strong>Validación Biológico:</strong> {{ $labelqr->validation_biologic }}</div>
                            </div>

                            {{-- QR de Proceso --}}
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">QR de Proceso:</h5>
                                {!! QrCode::size(150)->style('square')->generate(
                                    "$labelqr->reference" .
                                    ' -> Equipo: ' . "$labelqr->machine_name" .
                                    ' -> Lote: ' . "$labelqr->lote_machine" .
                                    ' -> Fecha Elabo: ' . "$labelqr->created_up" .
                                    ' -> Expiracion: ' . "$labelqr->updated_at"
                                ) !!}
                            </div>
                        </div>

                        {{-- Tabla de items --}}
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="align-middle">Descripción</th>
                                        <th class="align-middle">Código</th>
                                        <th class="align-middle text-center">Cantidad</th>
                                        <th class="align-middle text-center">Tipo de Envoltura</th>
                                        <th class="align-middle text-center">Embalaje</th>
                                        <th class="align-middle text-center">Ind. Químico</th>
                                        <th class="align-middle text-center">Vencimiento</th>
                                        <th class="align-middle text-center">Paciente / Casa Com.</th>
                                        <th class="align-middle text-center">QR Paquete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($labelqr->labelqrDetails as $item)
                                        <tr>
                                            <td class="align-middle">{{ $item->product_name }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-success">{{ $item->product_code }}</span>
                                            </td>
                                            <td class="align-middle text-center">{{ $item->product_quantity }}</td>
                                            <td class="align-middle text-center">{{ $item->product_package_wrap }}</td>
                                            <td class="align-middle text-center">{{ $item->product_eval_package }}</td>
                                            <td class="align-middle text-center">{{ $item->product_eval_indicator }}</td>
                                            <td class="align-middle text-center">
                                                @if ($item->product_expiration >= 15)
                                                    @if ($item->product_expiration == 180)
                                                        6 Meses
                                                    @elseif ($item->product_expiration == 270)
                                                        9 Meses
                                                    @elseif ($item->product_expiration == 365)
                                                        12 Meses
                                                    @elseif ($item->product_expiration == 545)
                                                        18 Meses
                                                    @else
                                                        {{ $item->product_expiration }} Días
                                                    @endif
                                                @else
                                                    {{ $item->product_expiration }} Días
                                                @endif
                                                <br>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($item->updated_at)->addDays((int) $item->product_expiration)->format('d M, Y') }}
                                                </small>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product_patient }} //
                                                {{ $item->product_outside_company }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {!! QrCode::size(50)->style('square')->generate(
                                                    "$labelqr->reference" .
                                                    ' // Lote: ' . "$labelqr->lote_machine" .
                                                    ' // Cod: ' . "$item->product_code " .
                                                    ' // Elab: ' . "$item->updated_at " .
                                                    ' // Venc: ' . "$item->updated_at"
                                                ) !!}
                                                <div>
                                                    <small>Lote: {{ $labelqr->lote_machine }}<br>
                                                    Cód: {{ $item->product_code }}</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox" style="font-size:2rem;"></i><br>
                                                No hay instrumentos registrados en este proceso.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
