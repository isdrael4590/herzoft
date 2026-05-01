@extends('layouts.app')

@section('title', 'Generación de Etiquetas')

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

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);">
                    <i class="bi bi-qr-code text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Generación de Etiquetas</h4>
                    <small class="text-muted">Registro de etiquetas QR de procesos de esterilización</small>
                </div>
            </div>
            <div class="d-flex align-items-center" style="gap:10px;">
                @can('create_labelqrs')
                    <a href="{{ route('labelqrs.create') }}"
                        class="btn d-flex align-items-center text-white"
                        style="border-radius:8px;padding:10px 20px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);background:linear-gradient(135deg,#f59e0b,#d97706);border:none;">
                        <i class="bi bi-plus-lg mr-2"></i> Etiqueta STEAM
                    </a>
                @endcan
                @can('create_labelqrshpo')
                    <a href="{{ route('labelqrshpo.create') }}"
                        class="btn d-flex align-items-center text-white"
                        style="border-radius:8px;padding:10px 20px;font-weight:600;box-shadow:0 4px 12px rgba(6,182,212,0.35);background:linear-gradient(135deg,#06b6d4,#0891b2);border:none;">
                        <i class="bi bi-plus-lg mr-2"></i> Etiqueta HPO
                    </a>
                @endcan
            </div>
        </div>

        {{-- Main Card --}}
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table text-warning mr-2" style="font-size:1.1rem;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">REGISTRO DE ETIQUETAS</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 10px;border-radius:20px;background:rgba(245,158,11,0.12);color:#d97706;">
                    Tabla en tiempo real
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                {{-- Filtro por Estado --}}
                <div class="d-flex align-items-center mb-3" style="gap:10px;">
                    <i class="bi bi-funnel text-warning" style="font-size:1rem;"></i>
                    <span class="text-muted font-weight-semibold" style="font-size:.85rem;white-space:nowrap;">Filtrar por estado:</span>
                    <select id="filter-status" class="form-control form-control-sm" style="max-width:200px;">
                        <option value="">Todos</option>
                        <option value="Cargar">Cargar</option>
                        <option value="En Curso">En Curso</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Ciclo Aprobado">Ciclo Aprobado</option>
                        <option value="Ciclo Falla">Ciclo Falla</option>
                    </select>
                </div>

                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-hover table-bordered align-middle']) !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            $('#filter-status').on('change', function () {
                window.LaravelDataTables['labelqrs-table']
                    .column(3)
                    .search($(this).val())
                    .draw();
            });
        });
    </script>
@endpush
