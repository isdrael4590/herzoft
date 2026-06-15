@extends('layouts.app')

@section('title', 'Disponibilidad Stock')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Stocks Generados</a></li>
        <li class="breadcrumb-item active">Disponibilidad Stock</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="bi bi-layers"></i> Disponibilidad Stock
                        </h5>
                        <div class="d-flex align-items-center" style="gap:8px;">
                            @can('access_admin') <a href="{{ route('stocks.index') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i> Cambios Exclusivos
                                </a>
                         
                            <a href="{{ route('stockDetails.resetHistory') }}" class="btn btn-info btn-sm">
                                <i class="bi bi-clock-history"></i> Historial de Reseteos
                            </a>
                        @endcan
                        @can('reset_preparations')
                            <form id="resetStockForm" action="{{ route('stockDetails.resetQuantities') }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="button" class="btn btn-warning btn-sm" id="resetStockBtn">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reiniciar Cantidades
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-hover table-striped align-middle']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        $('#resetStockBtn').on('click', function() {
            if (confirm(
                    '¿Está seguro de reiniciar las cantidades de stock? Esta acción quedará registrada en el historial.'
                    )) {
                $('#resetStockForm').submit();
            }
        });
    });
</script>
@endpush
