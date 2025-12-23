@extends('layouts.app')

@section('title', 'Create Instrumental')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('instrumental.index') }}">Base Datos Instrumental</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="Instrumental-form" action="{{ route('instrumental.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            Crear Instrumental <i class="bi bi-check"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_generico">Descripción <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nombre_generico" required
                                            value="{{ old('nombre_generico') }}" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo_unico_ud">Código Único <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="codigo_unico_ud" required
                                            value="{{ old('codigo_unico_ud') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_familia">Familia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tipo_familia" required
                                            value="{{ old('tipo_familia') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marca_fabricante">Fabricante <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="marca_fabricante" required
                                            value="{{ old('marca_fabricante') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_compra">FECHA DE COMPRA <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="fecha_compra" required
                                            value="{{ old('fecha_compra') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estado_actual">Selección De estado <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="estado_actual" id="estado_actual" required>
                                            <option value="">Selección de Estado</option>
                                            <option value="DISPONIBLE"
                                                {{ old('estado_actual') == 'DISPONIBLE' ? 'selected' : '' }}>DISPONIBLE
                                            </option>
                                            <option value="EN_USO" {{ old('estado_actual') == 'EN_USO' ? 'selected' : '' }}>
                                                EN USO</option>
                                            <option value="MANTENIMIENTO"
                                                {{ old('estado_actual') == 'MANTENIMIENTO' ? 'selected' : '' }}>
                                                MANTENIMIENTO</option>
                                            <option value="BAJA" {{ old('estado_actual') == 'BAJA' ? 'selected' : '' }}>
                                                BAJA</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Create Category Modal -->
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
e
    <script>
        $(document).ready(function() {
            $('#Instrumental-form').on('submit', function(e) {
                // Deshabilitar el botón para evitar múltiples envíos
                $('#submitBtn').prop('disabled', true).html(
                    'Guardando... <i class="bi bi-hourglass-split"></i>');
            });
        });
    </script>
@endpush
