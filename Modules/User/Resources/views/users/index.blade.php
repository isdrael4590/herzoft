@extends('layouts.app')

@section('title', 'Usuarios')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        @include('utils.alerts')

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                    <i class="bi bi-people text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Gestión de Usuarios</h4>
                    <small class="text-muted">Usuarios registrados en el sistema</small>
                </div>
            </div>
            @can('create_user_management')
                <a href="{{ route('users.create') }}"
                    class="btn d-flex align-items-center"
                    style="border-radius:8px;padding:10px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);background:linear-gradient(135deg,#10b981,#059669);border:none;color:#fff;">
                    <i class="bi bi-plus-lg mr-2"></i> Nuevo Usuario
                </a>
            @endcan
        </div>

        {{-- Main Card --}}
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table text-primary mr-2" style="font-size:1.1rem;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">REGISTRO DE USUARIOS</span>
                </div>
                <span class="badge badge-success" style="font-size:.75rem;padding:5px 10px;border-radius:20px;">
                    Tabla en tiempo real
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-hover table-bordered align-middle']) !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
