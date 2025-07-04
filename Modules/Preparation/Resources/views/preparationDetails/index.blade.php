@extends('layouts.app')

@section('title', 'Stock - Pre')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Preparación</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @can('access_admin')
                            <a href="{{ route('preparations.index') }}" class="btn btn-primary">
                                Cambios EXCLUSIVOS<i class="bi bi-plus"></i>
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
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
