@extends('layouts.app')

@section('title', 'Stock - Preparación')

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
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="bi bi-box-seam"></i> Gestión de Preparación
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="action-buttons mb-3">
                            @can('access_admin')
                                <a href="{{ route('preparations.index') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i>
                                    Cambios EXCLUSIVOS
                                </a>



                                <a href="{{ route('preparationDetails.resetHistory') }}" class="btn btn-info">
                                    <i class="bi bi-clock-history"></i>
                                    Historial de Reseteos
                                </a>
                            @endcan
                            @can('reset_preparations')
                                <!-- FORMULARIO SIMPLE DE RESET -->
                                <form id="resetForm" action="{{ route('preparationDetails.resetQuantities') }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    <button type="button" class="btn btn-warning" id="resetQuantitiesBtn">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Reiniciar Cantidades
                                    </button>
                                </form>
                            @endcan
                        </div>

                        {{-- <!-- TEST: Mostrar la URL de la ruta -->
                            <div class="alert alert-info">
                                <strong>DEBUG:</strong> Ruta de reset:
                                <code>{{ route('preparationDetails.resetQuantities') }}</code>
                            </div> --}}


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
            console.log('Script cargado correctamente');

            // VERSIÓN SIMPLIFICADA PARA DIAGNÓSTICO
            const resetBtn = document.getElementById('resetQuantitiesBtn');
            const resetForm = document.getElementById('resetForm');

            if (resetBtn && resetForm) {
                console.log('Botón y formulario encontrados');
                console.log('Action del formulario:', resetForm.action);

                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Click en botón detectado');

                    // Confirmación simple con confirm() nativo
                    if (confirm('¿Está seguro de reiniciar las cantidades?')) {
                        console.log('Usuario confirmó, enviando formulario...');
                        resetForm.submit();
                    } else {
                        console.log('Usuario canceló');
                    }
                });
            } else {
                console.error('No se encontró el botón o el formulario');
            }
        });
    </script>
@endpush
