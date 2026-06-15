@extends('layouts.app')

@section('title', 'Historial Stock - ' . $productCode)

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stockDetails.index') }}">Disponibilidad Stock</a></li>
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
                                Historial de Stock - {{ $productCode }}
                            </h5>
                            <small class="text-muted">
                                <strong>Código:</strong> {{ $productCode }} &mdash;
                                <strong>Nombre:</strong> {{ $productName }}
                            </small>
                        </div>
                        <a href="{{ route('stockDetails.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="card-body">

                        @php
                            $totalDisponible = $details->sum('product_quantity');
                            $totalDespachado = $details->sum('product_quantity_expedition');
                            $totalRegistros = $details->total();
                        @endphp
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-success">{{ $totalDisponible }}</div>
                                    <div class="text-muted small">Cantidad Disponible</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-warning">{{ $totalDespachado }}</div>
                                    <div class="text-muted small">Cantidad Despachada</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-secondary">{{ $totalRegistros }}</div>
                                    <div class="text-muted small">Total de Registros</div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha Esterilización</th>
                                        <th class="text-center">Fecha Ingreso</th>
                                        <th class="text-center">Tipo Embalaje</th>
                                        <th class="text-center">Cantidad Disponible</th>
                                        <th class="text-center">Cantidad Despachada</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Vencimiento</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($details as $detail)
                                        <tr>
                                            <td class="text-center text-muted small">{{ $detail->id }}</td>
                                            <td class="text-center">
                                                {{ $detail->product_date_sterilized ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($detail->created_at)->format('d M, Y H:i:s') }}
                                            </td>
                                            <td class="text-center">{{ $detail->product_package_wrap ?? '-' }}</td>
                                            <td class="text-center fw-bold">
                                                @if($detail->product_quantity == 0)
                                                    <span class="badge bg-secondary">0</span>
                                                @elseif($detail->product_quantity <= 2)
                                                    <span class="badge bg-warning text-dark">{{ $detail->product_quantity }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $detail->product_quantity }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info text-dark">{{ $detail->product_quantity_expedition ?? 0 }}</span>
                                            </td>
                                            <td class="text-center">{{ $detail->product_area ?? '-' }}</td>
                                            <td class="text-center">{{ $detail->product_expiration ?? '-' }}</td>
                                            <td class="text-center">
                                                @if($detail->product_status_stock == 'Disponible')
                                                    <span class="badge bg-success">Disponible</span>
                                                @elseif($detail->product_status_stock == 'Despachado')
                                                    <span class="badge bg-warning text-dark">Despachado</span>
                                                @else
                                                    <span class="badge bg-light text-dark">{{ $detail->product_status_stock ?? '-' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                No hay registros para este código.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $details->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
