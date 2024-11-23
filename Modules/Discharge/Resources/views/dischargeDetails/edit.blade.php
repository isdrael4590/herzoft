@extends('layouts.app')

@section('title', 'Editar Producto Stok')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dischargeDetails.index') }}">Instrumental Procesado</a></li>
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
                        <form id="dischargeDetails-form" action="{{ route('dischargeDetails.update', $dischargeDetails) }}"
                            method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required readonly
                                            value="{{ $dischargeDetails->product_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_code">Código del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required readonly
                                            value="{{ $dischargeDetails->product_code }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_ref_qr">Estado de Esterilidad<span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" id="product_ref_qr" name="product_ref_qr">
                                            <option {{ $dischargeDetails->product_ref_qr == 'Esteril' ? 'selected' : '' }}
                                                value="Esteril">
                                                Esteril</option>
                                            <option
                                                {{ $dischargeDetails->product_ref_qr == 'No Esteril' ? 'selected' : '' }}
                                                value="No Esteril">No Esteril</option>
                                            {{-- <option
                                                {{ $dischargeDetails->product_ref_qr == 'Reprocesar' ? 'selected' : '' }}
                                                value="Reprocesar">Reprocesar</option>
                                                                                        --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_eval_package">Area Proveniente<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="product_eval_package" name="product_eval_package">
                                            <option {{ $dischargeDetails->product_eval_package == 'OK' ? 'selected' : '' }}
                                                value="OK">
                                                OK</option>
                                            <option {{ $dischargeDetails->product_eval_package == 'NO' ? 'selected' : '' }}
                                                value="NO">NO</option>


                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_expiration">Fecha de vencimiento<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_expiration" required
                                            readonly value="{{ $dischargeDetails->product_expiration }}">
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
