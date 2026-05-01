@extends('layouts.app')

@section('title', 'Lavados')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Lavados</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#f97316,#ea580c);">
                    <i class="bi bi-droplet text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Registro de Lavados</h4>
                    <small class="text-muted">Gestión y seguimiento del proceso de lavado de instrumental</small>
                </div>
            </div>
            @can('create_wash_area')
                <a href="{{ route('lavados.create') }}"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:10px 20px;font-weight:600;background:linear-gradient(135deg,#f97316,#ea580c);border:none;box-shadow:0 4px 12px rgba(249,115,22,0.35);">
                    <i class="bi bi-plus-lg mr-2"></i> Nuevo Lavado
                </a>
            @endcan
        </div>

        {{-- Main Card --}}
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table mr-2" style="font-size:1.1rem;color:#f97316;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">REGISTRO DE LAVADOS</span>
                </div>
                <div class="d-flex align-items-center" style="gap:10px;">
                    <i class="bi bi-funnel" style="font-size:1rem;color:#f97316;"></i>
                    <span class="text-muted font-weight-semibold" style="font-size:.85rem;white-space:nowrap;">Filtrar por estado:</span>
                    <select id="filter-status" class="form-control form-control-sm" style="max-width:180px;">
                        <option value="">Todos</option>
                       <option value="Sin Validar">Sin Validar</option>
                       <option value="Ciclo Correcto">Ciclo Correcto</option>
                       <option value="Ciclo Falla">Ciclo Falla</option>
                    </select>
                </div>
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
    <script>
        $(document).ready(function () {
            $('#filter-status').on('change', function () {
                window.LaravelDataTables['lavados-table']
                    .column(3)
                    .search($(this).val())
                    .draw();
            });
        });
    </script>
@endpush
