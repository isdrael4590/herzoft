@extends('layouts.app')

@section('title', 'Stocks Generados')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Stocks Generados</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="bi bi-box-seam"></i> Stocks Generados
                        </h5>
                        <div class="d-flex" style="gap:8px;">
                            @can('access_stockDetails')
                                <a href="{{ route('stockDetails.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-list-ul"></i> Disponibilidad Stock
                                </a>
                            @endcan
                            @can('edit_stocks')
                                <a href="{{ route('stocks.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg"></i> Almacenar Manualmente
                                </a>
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
@endpush
