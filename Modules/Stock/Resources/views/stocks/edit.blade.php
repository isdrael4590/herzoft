@extends('layouts.app')

@section('title', 'Editar Etiquetas')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="quotation-form" action="{{ route('stocks.update', $stock) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $stock->reference }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ $stock->lote_machine }}">
                                    </div>
                                </div>
                             
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiration">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option {{ $stock->type_program == '134C ESTANDAR' ? 'selected' : '' }} value="134C ESTANDAR">134C ESTANDAR</option>
                                            <option {{ $stock->type_program == '121C ESTANDAR' ? 'selected' : '' }} value="121C ESTANDAR">121C ESTANDAR</option>
                                            <option {{ $stock->type_program == 'CONTENEDORES' ? 'selected' : '' }} value="CONTENEDORES">CONTENEDORES</option>
                                            <option {{ $stock->type_program == 'RAPID' ? 'selected' : '' }} value="RAPID">RAPID</option>
                                            <option {{ $stock->type_program == 'ESPORAS' ? 'selected' : '' }} value="ESPORAS">ESPORAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="{{ $stock->lote_biologic }}">
                                    </div>
                                </div>
                         
              
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $stock->temp_ambiente }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                              

                            </div>


                            <livewire:product-carttoStock :cartInstance="'stock'" :data="$stock" />



                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $stock->note }}</textarea>
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
