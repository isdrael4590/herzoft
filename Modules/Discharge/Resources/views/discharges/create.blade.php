
@extends('layouts.app')

@section('title', 'Registrar Ingreso')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
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
                        <form id="Discharge-form" action="{{ route('discharges.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="DISC">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
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
                                        <label for="expiration">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option selected value="134C ESTANDAR"> 134C ESTANDAR </option>
                                            <option value="121C ESTANDAR"> 121C ESTANDAR </option>
                                            <option value="CONTENEDORES"> CONTENEDORES</option>
                                            <option value=" RAPID"> RAPID </option>
                                            <option value=" ESPORAS"> ESPORAS </option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="{{ old('lote_biologic') }}">
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
                                        <label for="expiration">Tiempo de expiración</label>
                                        <select class="form-control" name="expiration" id="expiration">
                                            <option disabled>-- SELECCIONAR LOS MESES--</option>

                                            <option value="6"> 6 meses </option>
                                            <option value="12"> 12 meses </option>
                                            <option value="12"> 18 meses </option>
                                            <option selected value="24"> 24 meses </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>
                                            <option selected value="En Curso">En Curso</option>
                                            <option value="Pendiente">Pendiente</option>

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
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>
                    </div>

                    <livewire:product-carttoQR :cartInstance="'Discharge'" />

                    <div class="form-row">

                    </div>
                    <div class="form-group">
                        <label for="note_Discharge">Nota (Si se necesita)</label>
                        <textarea name="note_Discharge" id="note_Discharge" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Generar proceso <i class="bi bi-check"></i>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page_scripts')
@endpush
