@extends('layouts.app')

@section('title', 'Procesos Registro')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proceso.index') }}">Información</a></li>
        <li class="breadcrumb-item active">Información de Tipo Procesos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        @can('create_proceso')
                            <a href="{{ route('proceso.create') }}" class="btn btn-primary">
                                Añadir Tipo Procesos <i class="bi bi-plus"></i>
                            </a>
                        @endcan
                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->

@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
