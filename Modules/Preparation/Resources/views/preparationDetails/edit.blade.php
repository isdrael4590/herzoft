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
                        <form id="preparationDetails-form"
                            action="{{ route('preparationDetails.update', $preparationDetails) }}" method="POST">
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
                                        <label for="product_quantity">Cantidad<span class="text-danger">*</span></label>
                                        <input class="form-control" name="product_quantity" type="number"
                                            class="form-control" value="{{ $preparationDetails->product_quantity }}"
                                            min="0">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_state_preparation">Estado de Stock Producto<span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" id="product_state_preparation"
                                            name="product_state_preparation">

                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Disponible' ? 'selected' : '' }}
                                                value="Disponible">
                                                Disponible</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Cargado' ? 'selected' : '' }}
                                                value="Cargado">Cargado</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'En Curso' ? 'selected' : '' }}
                                                value="En Curso">En Curso</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Procesado' ? 'selected' : '' }}
                                                value="Procesado">Procesado</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Reprocesar' ? 'selected' : '' }}
                                                value="Reprocesar">Reprocesar</option>


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
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_patient">Paciente si aplica<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_patient"
                                            value="{{ $preparationDetails->product_patient }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_outside_company">Casa Comercial si aplica<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_outside_company"
                                            value="{{ $preparationDetails->product_outside_company }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_area">Área<span class="text-danger">*</span></label>
                                        <select class="form-control" id="area" name="product_area" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option
                                                    {{ $preparationDetails->product_area == $area->area_name ? 'selected' : '' }}value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
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
