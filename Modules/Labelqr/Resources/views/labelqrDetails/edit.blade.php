@extends('layouts.app')

@section('title', 'Editar Instrumental')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('labelqrDetails.index') }}">Items de producto</a></li>
        <li class="breadcrumb-item active">Editar Producto</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="labelqrDetails-form" action="{{ route('labelqrDetails.update', $labelqrDetails) }}"
                            method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="preparation_detail_id">ID del Preparación<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="preparation_detail_id" required readonly
                                            value="{{ $labelqrDetails->preparation_detail_id }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required readonly
                                            value="{{ $labelqrDetails->product_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_code">Código del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required readonly
                                            value="{{ $labelqrDetails->product_code }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_ref_qr">Estado de Producto<span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" id="product_ref_qr" name="product_ref_qr">

                                            <option {{ $labelqrDetails->product_ref_qr == 'Correcto' ? 'selected' : '' }}
                                                value="Correcto">
                                                Correcto</option>
                                            <option {{ $labelqrDetails->product_ref_qr == 'Falla' ? 'selected' : '' }}
                                                value="Falla">Falla</option>
                                            <option {{ $labelqrDetails->product_ref_qr == 'En Curso' ? 'selected' : '' }}
                                                value="En Curso">En Curso</option>
                                                <option {{ $labelqrDetails->product_ref_qr == 'NO USADO' ? 'selected' : '' }}
                                                    value="NO USADO">NO USADO</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_type_process">Tipo de Esterilización<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_type_process" required
                                            readonly value="{{ $labelqrDetails->product_type_process }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualización de Items <i class="bi bi-check"></i>
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
