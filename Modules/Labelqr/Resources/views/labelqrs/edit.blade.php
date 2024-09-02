@extends('layouts.app')

@section('title', 'Editar Etiquetas')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('labelqrs.index') }}">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Editar Etiquetas</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-producttoQR/>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="labelqr-form" action="{{ route('labelqrs.update', $labelqr) }}" method="POST">
                            @csrf
                            @method('patch')
                            @if ($labelqr->machine_type =='Autoclave')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo Esterilización <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                        value="{{ $labelqr->machine_type }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $labelqr->reference }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                @if ($machines->machine_type == 'Autoclave')
                                                    <option
                                                        {{ $labelqr->machine_name == $machines->machine_name ? 'selected' : '' }}value="{{ $machines->machine_name }}">
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
                                            value="{{ $labelqr->lote_machine }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_machine" required
                                            value="{{ $labelqr->temp_machine }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiration">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option {{ $labelqr->type_program == '134C ESTANDAR' ? 'selected' : '' }}
                                                value="134C ESTANDAR">134C ESTANDAR</option>
                                            <option {{ $labelqr->type_program == '121C ESTANDAR' ? 'selected' : '' }}
                                                value="121C ESTANDAR">121C ESTANDAR</option>
                                            <option {{ $labelqr->type_program == 'CONTENEDORES' ? 'selected' : '' }}
                                                value="CONTENEDORES">CONTENEDORES</option>
                                            <option {{ $labelqr->type_program == 'RAPID' ? 'selected' : '' }}
                                                value="RAPID">RAPID</option>
                                            <option {{ $labelqr->type_program == 'ESPORAS' ? 'selected' : '' }}
                                                value="ESPORAS">ESPORAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_biologic">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="lote_biologic" name="lote_biologic" required>
                                            @foreach (\Modules\Informat\Entities\Informat::all() as $informat)
                                                @if (
                                                    ($informat->insumo_type == 'INDICADORES BIOLOGICOS') &
                                                        ($informat->insumo_status == 'Activo') &
                                                        ($informat->insumo_temp == 'ALTA TEMPERATURA'))
                                                    <option
                                                        {{ $labelqr->lote_biologic == $informat->insumo_lot ? 'selected' : '' }}value="{{ $informat->insumo_lot }}">
                                                        {{ $informat->insumo_lot }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly required>
                                            <option
                                                {{ $labelqr->validation_biologic == 'sin_validar' ? 'selected' : '' }}value="sin_validar">
                                                Sin Validar</option>
                                          
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>

                                            <option {{ $labelqr->status_cycle == 'Pendiente' ? 'selected' : '' }}
                                                value="Pendiente">Pendiente</option>
                                            <option {{ $labelqr->status_cycle == 'Cargar' ? 'selected' : '' }}
                                                value="Cargar">Cargar</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $labelqr->temp_ambiente }}">
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
                            @elseif ($labelqr->machine_type =='Peroxido')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo Esterilización <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                        value="{{ $labelqr->machine_type }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $labelqr->reference }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                @if ($machines->machine_type == 'Peroxido')
                                                    <option
                                                        {{ $labelqr->machine_name == $machines->machine_name ? 'selected' : '' }}value="{{ $machines->machine_name }}">
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
                                            value="{{ $labelqr->lote_machine }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="temp_machine" id="temp_machine" readonly>
                                            <option {{ $labelqr->temp_machine == '52' ? 'selected' : '' }} value="52">
                                                52ºC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiration">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option {{ $labelqr->type_program == 'ESTANDAR' ? 'selected' : '' }}
                                                value="ESTANDAR">ESTANDAR</option>
                                            <option {{ $labelqr->type_program == 'AVANZADO' ? 'selected' : '' }}
                                                value="AVANZADO">AVANZADO</option>
                                            <option {{ $labelqr->type_program == 'RAPID' ? 'selected' : '' }}
                                                value="RAPID">RAPID</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_biologic">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="lote_biologic" name="lote_biologic" required>
                                            @foreach (\Modules\Informat\Entities\Informat::all() as $informat)
                                                @if (
                                                    ($informat->insumo_type == 'INDICADORES BIOLOGICOS') &
                                                        ($informat->insumo_status == 'Activo') &
                                                        ($informat->insumo_temp == 'BAJA TEMPERATURA'))
                                                    <option
                                                        {{ $labelqr->lote_biologic == $informat->insumo_lot ? 'selected' : '' }}value="{{ $informat->insumo_lot }}">
                                                        {{ $informat->insumo_lot }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option {{ $labelqr->validation_biologic == 'sin_validar' ? 'selected' : '' }}
                                                value="sin_validar">
                                                Sin Validar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>

                                            <option {{ $labelqr->status_cycle == 'Pendiente' ? 'selected' : '' }}
                                                value="Pendiente">Pendiente</option>
                                            <option {{ $labelqr->status_cycle == 'Cargar' ? 'selected' : '' }}
                                                value="Cargar">Cargar</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $labelqr->temp_ambiente }}">
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
                            @endif
                            <livewire:product-carttoQR :cartInstance="'labelqr'" :data="$labelqr" />
                            <div class="form-group">
                                <label for="note_labelqr">Nota (Si se necesita)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="5" class="form-control">{{ $labelqr->note_labelqr }}</textarea>
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
