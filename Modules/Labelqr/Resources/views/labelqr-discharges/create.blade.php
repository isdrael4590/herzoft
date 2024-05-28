@extends('layouts.app')

@section('title', ' Envio Etiquetas Generadas')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('labelqrs.index') }}">Etiquetas Generadas</a></li>
        <li class="breadcrumb-item active">Registro de envío de ciclo</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="discharge -form" action="{{ route('discharges.store') }}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Envío de Cíclo Esterilizador<i class="bi bi-check"></i>
                                </button>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia Descarga <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="DES">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name" readonly>
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                <option
                                                    {{ $discharge->machine_id == $machines->id ? 'selected' : '' }}value="{{ $machines->id }}">
                                                    {{ $machines->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ $discharge->lote_machine }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_machine" required
                                            value="{{ $discharge->temp_machine }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="type_program">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program" readonly>
                                            <option {{ $discharge->type_program == '134C ESTANDAR' ? 'selected' : '' }}
                                                value="134C ESTANDAR">134C ESTANDAR</option>
                                            <option {{ $discharge->type_program == '121C ESTANDAR' ? 'selected' : '' }}
                                                value="121C ESTANDAR">121C ESTANDAR</option>
                                            <option {{ $discharge->type_program == 'CONTENEDORES' ? 'selected' : '' }}
                                                value="CONTENEDORES">CONTENEDORES</option>
                                            <option {{ $discharge->type_program == 'RAPID' ? 'selected' : '' }}
                                                value="RAPID">RAPID</option>
                                            <option {{ $discharge->type_program == 'ESPORAS' ? 'selected' : '' }}
                                                value="ESPORAS">ESPORAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="{{ $discharge->lote_biologic }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option
                                                {{ $discharge->validation_biologic == 'sin_validar' ? 'selected' : '' }}
                                                value="sin_validar">
                                                Sin Validar</option>
                                            {{-- <option {{ $discharge->validation_biologic == 'Correcto' ? 'selected' : '' }}
                                                value="Correcto">
                                                Correcto</option>
                                            <option {{ $discharge->validation_biologic == 'Falla' ? 'selected' : '' }}
                                                value="Falla">
                                                Falla</option> --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>

                                            <option {{ $discharge->status_cycle == 'Pendiente' ? 'selected' : '' }}
                                                value="Pendiente">Pendiente</option>
                                            <option {{ $discharge->status_cycle == 'En Curso' ? 'selected' : '' }}
                                                value="En Curso">En curso</option>
                                            {{--
                                            <option {{ $discharge->status_cycle == 'cycle_ok' ? 'selected' : '' }} value="cycle_ok">Ciclo Aprobado</option>
                                            <option {{ $discharge->status_cycle == 'cycle_fail' ? 'selected' : '' }} value="cycle_fail">Ciclo Con Falla</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $discharge->temp_ambiente }}" readonly>
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

                           <livewire:product-carttoQR :cartInstance="'discharge'" :data="$discharge"/>



                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $discharge->note }}</textarea>
                            </div>

                            <input type="hidden" name="labelqr_id" value="{{ $labelqr_id }}">

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Envío de Cíclo<i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
