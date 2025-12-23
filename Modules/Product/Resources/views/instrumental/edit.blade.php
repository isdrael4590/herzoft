@extends('layouts.app')

@section('title', 'Editar Instrumental')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('instrumental.index') }}">Base Datos Instrumental</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="Instrumental-form" action="{{ route('instrumental.update', $instrumental->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            Actualizar Instrumental <i class="bi bi-check"></i>
                        </button>
                        <a href="{{ route('instrumental.index') }}" class="btn btn-secondary">
                            Cancelar <i class="bi bi-x-circle"></i>
                        </a>
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
                                            value="{{ old('nombre_generico', $instrumental->nombre_generico) }}" maxlength="255">
                                        @error('nombre_generico')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo_unico_ud">Código Único <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="codigo_unico_ud" required
                                            value="{{ old('codigo_unico_ud', $instrumental->codigo_unico_ud) }}">
                                        @error('codigo_unico_ud')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_familia">Familia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tipo_familia" required
                                            value="{{ old('tipo_familia', $instrumental->tipo_familia) }}">
                                        @error('tipo_familia')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marca_fabricante">Fabricante <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="marca_fabricante" required
                                            value="{{ old('marca_fabricante', $instrumental->marca_fabricante) }}">
                                        @error('marca_fabricante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_compra">FECHA DE COMPRA <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="fecha_compra" required
                                            value="{{ old('fecha_compra', $instrumental->fecha_compra ? $instrumental->fecha_compra->format('Y-m-d') : '') }}">
                                        @error('fecha_compra')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estado_actual">Selección De estado <span class="text-danger">*</span></label>
                                        <select class="form-control" name="estado_actual" id="estado_actual" required>
                                            <option value="">Selección de Estado</option>
                                            <option value="DISPONIBLE" 
                                                {{ old('estado_actual', $instrumental->estado_actual) == 'DISPONIBLE' ? 'selected' : '' }}>
                                                DISPONIBLE
                                            </option>
                                            <option value="EN_USO" 
                                                {{ old('estado_actual', $instrumental->estado_actual) == 'EN_USO' ? 'selected' : '' }}>
                                                EN USO
                                            </option>
                                            <option value="MANTENIMIENTO" 
                                                {{ old('estado_actual', $instrumental->estado_actual) == 'MANTENIMIENTO' ? 'selected' : '' }}>
                                                MANTENIMIENTO
                                            </option>
                                            <option value="BAJA" 
                                                {{ old('estado_actual', $instrumental->estado_actual) == 'BAJA' ? 'selected' : '' }}>
                                                BAJA
                                            </option>
                                        </select>
                                        @error('estado_actual')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Información adicional (solo lectura) -->
                            <div class="form-row mt-3">
                                <div class="col-md-12">
                                    <hr>
                                    <h5>Información del Registro</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" class="form-control" value="{{ $instrumental->id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de Creación</label>
                                        <input type="text" class="form-control" 
                                            value="{{ $instrumental->created_at->format('d/m/Y H:i') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Última Actualización</label>
                                        <input type="text" class="form-control" 
                                            value="{{ $instrumental->updated_at->format('d/m/Y H:i') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $('#Instrumental-form').on('submit', function(e) {
                // Deshabilitar el botón para evitar múltiples envíos
                $('#submitBtn').prop('disabled', true).html(
                    'Actualizando... <i class="bi bi-hourglass-split"></i>');
            });
        });
    </script>
@endpush