@extends('layouts.app')

@section('title', 'Equipos')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Equipos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        @include('utils.alerts')

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#8b5cf6,#6d28d9);">
                    <i class="bi bi-gear text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Equipos de la Institución</h4>
                    <small class="text-muted">Esterilizadores y equipos registrados</small>
                </div>
            </div>
            @can('create_machines')
                <button type="button"
                    class="btn d-flex align-items-center"
                    data-toggle="modal" data-target="#MachineCreateModal"
                    style="border-radius:8px;padding:10px 20px;font-weight:600;box-shadow:0 4px 12px rgba(139,92,246,0.35);background:linear-gradient(135deg,#8b5cf6,#6d28d9);border:none;color:white;">
                    <i class="bi bi-plus-lg mr-2"></i> Nuevo Equipo
                </button>
            @endcan
        </div>

        {{-- Main Card --}}
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table text-primary mr-2" style="font-size:1.1rem;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">REGISTRO DE EQUIPOS</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 10px;border-radius:20px;background:rgba(139,92,246,0.15);color:#6d28d9;">
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

    {{-- Create Modal --}}
    @include('informat::includes.machine-modal')
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
