@extends('layouts.app')

@section('title', 'Editar Producto Stok')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stockDetails.index') }}">Disponibilidad Stock</a></li>
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
                        <form id="stockDetails-form" action="{{ route('stockDetails.update', $stockDetails) }}"
                            method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required readonly
                                            value="{{ $stockDetails->product_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_code">Código del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required readonly
                                            value="{{ $stockDetails->product_code }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_status_stock">Estado de Stock Producto<span
                                                class="text-danger">*</span></label>
                                     
                                        <select class="form-control" id="product_status_stock" name="product_status_stock">
                                            
                                            <option
                                                {{ $stockDetails->product_status_stock == 'Disponible' ? 'selected' : '' }}
                                                value="Disponible">
                                                Disponible</option>
                                            <option
                                                {{ $stockDetails->product_status_stock == 'Despachado' ? 'selected' : '' }}
                                                value="Despachado">Despachado</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_date_sterilized">Fecha de Esterilización<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_date_sterilized" required
                                            readonly value="{{ $stockDetails->product_date_sterilized }}">
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_expiration">Fecha de expiración<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_expiration" required
                                            readonly value="{{ $stockDetails->product_expiration }}">
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
