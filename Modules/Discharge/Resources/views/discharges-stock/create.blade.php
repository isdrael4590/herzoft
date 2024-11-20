@extends('layouts.app')

@section('title', ' Envio Produccion al Stock')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Ciclos Liberados</a></li>
        <li class="breadcrumb-item active">Envío Al Almacén</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="stock -form" action="{{ route('stocks.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="STOCK">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de Esterilización <span
                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_type" required readonly
                                                value="{{ $stock->machine_type }}" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ $stock->lote_machine }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Equipo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_name" required
                                            value="{{ $stock->machine_name }}" readonly>
                                    </div>
                                </div>
                     
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="{{ $stock->lote_biologic }}" readonly>
                                    </div>
                                </div>

                    
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $stock->temp_ambiente }}" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>
                            </div>

                           <livewire:product-carttoStock :cartInstance="'stock'" :data="$stock"/>

                           <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $stock->note }}</textarea>
                            </div>

                            <input type="hidden" name="discharge_id" value="{{ $discharge_id }}">

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Envío al Almacen<i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
