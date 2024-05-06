@extends('layouts.app')

@section('title', 'Editar Etiquetas')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('labelqrs.index') }}">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-product />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="quotation-form" action="{{ route('labelqrs.update', $labelqr) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
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
                                                <option {{ $labelqr->machine_name == $machines->machine_name ? 'selected' : '' }}value="{{ $machines->machine_name }}">
                                                    {{ $machines->machine_name }}</option>
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
                                            <option {{ $labelqr->type_program == '134C ESTANDAR' ? 'selected' : '' }} value="134C ESTANDAR">134C ESTANDAR</option>
                                            <option {{ $labelqr->type_program == '121C ESTANDAR' ? 'selected' : '' }} value="121C ESTANDAR">121C ESTANDAR</option>
                                            <option {{ $labelqr->type_program == 'CONTENEDORES' ? 'selected' : '' }} value="CONTENEDORES">CONTENEDORES</option>
                                            <option {{ $labelqr->type_program == 'RAPID' ? 'selected' : '' }} value="RAPID">RAPID</option>
                                            <option {{ $labelqr->type_program == 'ESPORAS' ? 'selected' : '' }} value="ESPORAS">ESPORAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="{{ $labelqr->lote_biologic }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic" readonly>
                                            <option {{ $labelqr->validation_biologic == 'sin_validar' ? 'selected' : '' }}
                                                value="sin_validar" >
                                                Sin Validar</option>
                                           {{-- <option {{ $labelqr->validation_biologic == 'Correcto' ? 'selected' : '' }}
                                                value="Correcto">
                                                Correcto</option>
                                            <option {{ $labelqr->validation_biologic == 'Falla' ? 'selected' : '' }}
                                                value="Falla">
                                                Falla</option>--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiration">Tiempo de expiración</label>
                                        <select class="form-control" name="expiration" id="expiration" >
                                            <option {{ $labelqr->expiration == '6' ? 'selected' : '' }} value="6">6 meses</option>
                                            <option {{ $labelqr->expiration == '12' ? 'selected' : '' }} value="12">12 meses</option>
                                            <option {{ $labelqr->expiration == '18' ? 'selected' : '' }} value="18">18 meses</option>
                                            <option {{ $labelqr->expiration == '24' ? 'selected' : '' }} value="24">24 meses</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>
                                            
                                            <option {{ $labelqr->status_cycle == 'Pendiente' ? 'selected' : '' }} value="Pendiente">Pendiente</option>
                                            <option {{ $labelqr->status_cycle == 'En Curso' ? 'selected' : '' }}
                                                value="En Curso">En curso</option>
                                            {{--
                                            <option {{ $labelqr->status_cycle == 'cycle_ok' ? 'selected' : '' }} value="cycle_ok">Ciclo Aprobado</option>
                                            <option {{ $labelqr->status_cycle == 'cycle_fail' ? 'selected' : '' }} value="cycle_fail">Ciclo Con Falla</option> --}}
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
