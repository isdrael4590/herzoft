@php
    $Stock_max_id = \Modules\Stock\Entities\Stock::max('id') + 1;
    $stock_code = 'STOCK_' . str_pad($Stock_max_id, 5, '0', STR_PAD_LEFT);
@endphp
@extends('layouts.app')

@section('title', 'Registrar Stock Manual')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Almacén</a></li>
        <li class="breadcrumb-item active">Almacenar Manual.</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-producttoDES />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="stock-form" action="{{ route('stocks.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="{{ $stock_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de Esterilización <span
                                                class="text-danger">*</span></label>
                                                <select class="form-control" id="machine_type" name="machine_type">
                                                    @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                            <option value="{{ $machines->machine_type }}">
                                                                {{ $machines->machine_type }}</option>
                                                    @endforeach
                                                </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ old('lote_machine') }}">
                                    </div>
                                </div>

                             
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Equipo</label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                    <option value="{{ $machines->machine_name }}">
                                                        {{ $machines->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_biologic">Lote Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                      
                                            <select class="form-control" id="lote_biologic" name="lote_biologic" required>
                                                @foreach (\Modules\Informat\Entities\Informat::all() as $informat)
                                                    @if ($informat->insumo_type == 'INDICADORES BIOLOGICOS' & $informat->insumo_status == 'Activo' )
                                                        <option value="{{ $informat->insumo_lot }}">
                                                            {{ $informat->insumo_lot }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ old('temp_ambiente') }}">
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
                    </div>

                    <livewire:product-carttoStock :cartInstance="'stock'" />

                    <div class="form-row">

                    </div>
                    <div class="form-group">
                        <label for="note">Nota (Si se necesita)</label>
                        <textarea name="note" id="note" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Almacenar instrumental <i class="bi bi-sd-card"></i>
                        </button>

                    </div>

                    <div class="mt-3">

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page_scripts')
@endpush
