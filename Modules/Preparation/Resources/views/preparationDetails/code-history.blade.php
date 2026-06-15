@extends('layouts.app')

@section('title', 'Historial - ' . $productCode)

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('preparationDetails.index') }}">Preparación</a></li>
        <li class="breadcrumb-item active">Historial: {{ $productCode }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-0">
                                <i class="bi bi-clock-history"></i>
                                Historial de Paquetes - {{ $productCode }}
                            </h5>
                            <small class="text-muted">
                                <strong>Código:</strong> {{ $productCode }} &mdash;
                                <strong>Nombre:</strong> {{ $productName }}
                            </small>
                        </div>
                        <a href="{{ route('preparationDetails.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="card-body">

                        {{-- Resumen --}}
                        @php
                            $totalActual = $details->sum('product_quantity');
                            $totalRegistros = $details->total();
                        @endphp
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-primary">{{ $totalActual }}</div>
                                    <div class="text-muted small">Cantidad Total Actual</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-secondary">{{ $totalRegistros }}</div>
                                    <div class="text-muted small">Total de Registros</div>
                                </div>
                            </div>
                        </div>

                        {{-- Tabla de historial --}}
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha de Ingreso</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Proveniente</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo de Proceso</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Casa Comercial</th>
                                        <th class="text-center">Info</th>
                                        <th class="text-center">Paciente</th>
                                        @can('access_admin')
                                            <th class="text-center">Referencia</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($details as $detail)
                                        <tr>
                                            <td class="text-center text-muted small">{{ $detail->id }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($detail->created_at)->format('d M, Y H:i:s') }}
                                            </td>
                                            <td class="text-center fw-bold">
                                                @if($detail->product_quantity == 0)
                                                    <span class="badge bg-secondary">0</span>
                                                @elseif($detail->product_quantity <= 2)
                                                    <span class="badge bg-warning text-dark">{{ $detail->product_quantity }}</span>
                                                @elseif($detail->product_quantity <= 4)
                                                    <span class="badge bg-primary">{{ $detail->product_quantity }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $detail->product_quantity }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($detail->product_coming_zone == 'Recepcion')
                                                    <span class="badge bg-success">{{ $detail->product_coming_zone }}</span>
                                                @elseif($detail->product_coming_zone == 'Lavado')
                                                    <span class="badge bg-info text-dark">{{ $detail->product_coming_zone }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $detail->product_coming_zone }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $detail->product_area ?? '-' }}</td>
                                            <td class="text-center">{{ $detail->product_type_process ?? '-' }}</td>
                                            <td class="text-center">
                                                @php $state = $detail->product_state_preparation; @endphp
                                                @if($state == 'Disponible')
                                                    <span class="badge bg-success">{{ $state }}</span>
                                                @elseif($state == 'En Curso')
                                                    <span class="badge bg-warning text-dark">{{ $state }}</span>
                                                @elseif($state == 'Procesado')
                                                    <span class="badge bg-secondary">{{ $state }}</span>
                                                @else
                                                    <span class="badge bg-light text-dark">{{ $state ?? '-' }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center small">
                                                {{ $detail->product_outside_company ?? '-' }}
                                            </td>
                                            <td class="text-center small">
                                                {{ $detail->product_info ?? '-' }}
                                            </td>
                                            <td class="text-center small">
                                                {{ $detail->product_patient ?? '-' }}
                                            </td>
                                            @can('access_admin')
                                                <td class="text-center small">
                                                    @if($detail->preparation)
                                                        <a href="{{ route('preparations.show', $detail->preparation_id) }}">
                                                            {{ $detail->preparation->reference ?? $detail->preparation_id }}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center text-muted py-4">
                                                No hay registros para este código.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginación --}}
                        <div class="d-flex justify-content-center mt-3">
                            {{ $details->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
