@extends('layouts.app')

@section('title', 'labelqrs')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Generación de Etiquetas</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @can('create_labelqrs')
                            <a href="{{ route('labelqrs.create') }}" class="btn btn-warning">
                                Generación de Etiquetas STEAM<i class="bi bi-plus"></i>
                            </a>
                        @endcan
                        @can('create_labelqrshpo')
                            <a href="{{ route('labelqrshpo.create') }}" class="btn btn-info">
                                Generación de Etiquetas HPO <i class="bi bi-plus"></i>
                            </a>
                            <hr>
                        @endcan
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
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
