@php
    $Labelqr_max_id = \Modules\Labelqr\Entities\Labelqr::max('id') + 1;
    $labelqr_code = 'Proceso_' . str_pad($Labelqr_max_id, 5, '0', STR_PAD_LEFT);
@endphp
@extends('layouts.app')

@section('title', 'Registrar Proceso')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('labelqrs.index') }}">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Añadir STEAM Etiquetas</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div>
            @can('create_labelqrshpo')
                <a href="{{ route('labelqrshpo.create') }}" class="btn btn-info">
                    Generación de Etiquetas HPO <i class="bi bi-plus"></i>
                </a>
            @endcan
        </div>
        <div class="row">
            <div class="col-12">
                <livewire:search-producttoQR />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="labelqr-form" action="{{ route('labelqrs.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo Esterilización <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                            value="Autoclave">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="{{ $labelqr_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                @if ($machines->machine_type == 'Autoclave')
                                                    <option value="{{ $machines->machine_name }}">
                                                        {{ $machines->machine_name }}</option>
                                                @endif
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
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                                <select class="form-control" id="temp_machine" name="temp_machine">
                                                    <option selected value="134"> 134ºC </option>
                                                    <option value="121"> 121ºC </option>
                                                </select>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="type_program">TIPO DE PROGRAMA</label>

                                        <select class="form-control" id="type_program" name="type_program" required>
                                            @foreach (\Modules\Informat\Entities\Proceso::all() as $proceso)
                                                @if ($proceso->proceso_type == 'ALTA TEMPERATURA')
                                                    <option value="{{ $proceso->proceso_name }}">
                                                        {{ $proceso->proceso_name }}</option>
                                                @endif
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
                                                @if (
                                                    ($informat->insumo_type == 'INDICADORES BIOLOGICOS') &
                                                        ($informat->insumo_status == 'Activo') &
                                                        ($informat->insumo_temp == 'ALTA TEMPERATURA'))
                                                    <option value="{{ $informat->insumo_lot }}">
                                                        {{ $informat->insumo_lot }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biologic</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option value="sin_validar" selected>Sin Validar</option>
                                            {{--  <option value="Correcto">Correcto</option>
                                            <option value="Falla">Falla</option>
                                            --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>
                                            <option value="Pendiente">Pendiente</option>
                                            <option selected value="Cargar">Cargar</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ old('temp_ambiente') }}" min="1">
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


                            <livewire:product-carttoQR :cartInstance="'labelqr'" />

                            <div class="form-row">

                            </div>
                            <div class="form-group">
                                <label for="note_labelqr">Nota (Si se necesita)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Guardar proceso <i class="bi bi-sd-card"></i>
                                </button>

                            </div>

                            <div class="mt-3">

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
