@extends('layouts.app')

@section('title', 'Editar Producto Stok')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('preparationDetails.index') }}">Disponibilidad Preparación</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">

        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="preparationDetails-form" action="{{ route('preparationDetails.update', $preparationDetails) }}"
                            method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required readonly
                                            value="{{ $preparationDetails->product_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_code">Código del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required readonly
                                            value="{{ $preparationDetails->product_code }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_state_preparation">Estado de Stock Producto<span
                                                class="text-danger">*</span></label>
                                     
                                        <select class="form-control" id="product_state_preparation" name="product_state_preparation">
                                            
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Disponible' ? 'selected' : '' }}
                                                value="Disponible">
                                                Disponible</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Procesado' ? 'selected' : '' }}
                                                value="Procesado">Procesado</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_coming_zone">Area Proveniente<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_coming_zone" required
                                            readonly value="{{ $preparationDetails->product_coming_zone }}">
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_type_process">Temperatura de proceso<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_type_process" required
                                            readonly value="{{ $preparationDetails->product_type_process }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualización Proceso <i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
@endpush
