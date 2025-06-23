@php
    $discharge_max_id = \Modules\Discharge\Entities\Discharge::max('id') + 1;
    $discharge_code = 'DES-' . str_pad($discharge_max_id, 5, '0', STR_PAD_LEFT);
@endphp
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
                        <form onsubmit="handleFormSubmit(event)" id="discharge-form"
                            action="{{ route('discharges.store') }}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <button type="submit" id="submitBtn" class="btn btn-primary">
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
                                            value="{{ $discharge_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de esterilización <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required
                                            value="{{ $discharge->machine_type }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_name" required
                                            value="{{ $discharge->machine_name }}" readonly>
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
                                        <label for="lote_agente">Lote del Agente <span class="text-danger">*</span></label>
                                        @if ($discharge->machine_type == 'Peroxido')
                                            <input type="text" class="form-control" name="lote_agente" required
                                                value="{{ $discharge->lote_agente }}" readonly>
                                        @else
                                            <input type="text" class="form-control" name="lote_agente" required
                                                value="NA" readonly>
                                        @endif
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
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option
                                                {{ $discharge->validation_biologic == 'sin_validar' ? 'selected' : '' }}
                                                value="sin_validar">
                                                Sin Validar</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required
                                            readonly>
                                            <option {{ $discharge->status_cycle == 'Cargar' ? 'selected' : '' }}
                                                value="En Curso">En Curso</option>
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
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>


                            @if ($discharge->machine_type == 'Autoclave')
                                <livewire:product-carttoQR :cartInstance="'discharge'" :data="$discharge" />
                            @endif
                            @if ($discharge->machine_type == 'Peroxido')
                               <livewire:product-carttoQRHPO :cartInstance="'discharge'" :data="$discharge" />
                            @endif

                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $discharge->note }}</textarea>
                            </div>

                            <input type="hidden" name="labelqr_id" value="{{ $labelqr_id }}">

                            <div class="mt-3">

                                <button type="submit" id="submitBtn" class="btn btn-primary">
                                    Envío de Cíclo Esterilizador<i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function handleFormSubmit(event) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');

            // Disable button
            submitBtn.disabled = true;
            btnText.textContent = 'Enviando...';
            spinner.classList.remove('d-none');

            // Re-enable after 5 seconds (or when response is received)
            setTimeout(() => {
                submitBtn.disabled = false;
                btnText.textContent = 'Enviar Ciclo Esterilizador';
                spinner.classList.add('d-none');
            }, 5000);
        }
    </script>
@endpush
