@extends('layouts.app')

@section('title', 'Liberar Ciclo')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Descargar Ciclo</a></li>
        <li class="breadcrumb-item active">Liberar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="discharge-form" action="{{ route('discharges.update', $discharge) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Ref.Descarga <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $discharge->reference }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Ref.Proceso <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="labelqr_id" required
                                            value="{{ $discharge->labelqr_id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de Esterilización <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                            value="{{ $discharge->machine_type }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_name" required readonly
                                            value="{{ $discharge->machine_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_agente">Lote Agente Esterilizante <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_agente" required readonly
                                            value="{{ $discharge->lote_agente }}">
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
                                        <input type="text" class="form-control" name="type_program" required
                                            value="{{ $discharge->type_program }}" readonly>
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
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $discharge->temp_ambiente }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic">
                                            <option
                                                {{ $discharge->validation_biologic == 'sin_validar' ? 'selected' : '' }}
                                                value="Sin Validar">
                                                Sin Validar</option>
                                            <option {{ $discharge->validation_biologic == 'Correcto' ? 'selected' : '' }}
                                                value="Correcto">
                                                Correcto</option>
                                            <option {{ $discharge->validation_biologic == 'Falla' ? 'selected' : '' }}
                                                value="Falla">
                                                Falla</option>
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

                                            <option {{ $discharge->status_cycle == 'Ciclo Aprobado' ? 'selected' : '' }}
                                                value="Ciclo Aprobado">Ciclo Aprobado</option>
                                            <option {{ $discharge->status_cycle == 'Ciclo Falla' ? 'selected' : '' }}
                                                value="Ciclo Falla">Ciclo Falla</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador Descarga</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }} "readonly>
                                    </div>
                                </div>


                            </div>


                            <livewire:product-carttoDES :cartInstance="'discharge'" :data="$discharge" />



                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $discharge->note }}</textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Liberar Proceso <i class="bi bi-check"></i>
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
