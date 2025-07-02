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

                        <form onsubmit="return handleFormSubmit(event)" id="discharge-form"
                            action="{{ route('discharges.store') }}" method="POST">
                            @csrf
                            {{-- Token adicional para prevenir duplicados --}}
                            <input type="hidden" name="form_token" value="{{ uniqid('discharge_', true) }}">

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <button type="submit" id="submit-btn" class="btn btn-primary">
                                    <span id="submit-text">Enviar a Ciclo</span> <i class="bi bi-check"
                                        id="submit-icon"></i>
                                </button>
                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>

                                    </div>
                                    <span class="ml-2">Enviando a Descargas...</span>
                                </div>
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
                                <textarea name="note" id="note" rows="5" class="form-control" maxlength="400"
                                    onkeyup="updateCounter()" placeholder="Escriba aquí cualquier observación adicional...">{{ $discharge->note }}</textarea>
                                <small class="text-muted"><span
                                        id="charCount">{{ strlen($discharge->note ?? '') }}</span>/400
                                    caracteres</small>
                            </div>

                            <input type="hidden" name="labelqr_id" value="{{ $labelqr_id }}">

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <button type="submit" id="submit-btn" class="btn btn-primary">
                                    <span id="submit-text">Enviar a Ciclo</span> <i class="bi bi-check"
                                        id="submit-icon"></i>
                                </button>
                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>

                                    </div>
                                    <span class="ml-2">Enviando a Descargas...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        let isSubmitting = false;
        let submitTimestamp = null;
        const SUBMIT_COOLDOWN = 3000; // 3 segundos

        function updateCounter() {
            const textarea = document.getElementById('note');
            const counter = document.getElementById('charCount');
            if (textarea && counter) {
                counter.textContent = textarea.value.length;
            }
        }

        function handleFormSubmit(event) {
            const now = Date.now();
            const submitBtn = document.getElementById('submit-btn'); // ✅ Corregido: era 'submitBtn'
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            // Prevenir doble envío
            if (isSubmitting) {
                event.preventDefault();
                console.log('Envío bloqueado - formulario ya en proceso');
                return false;
            }

            // Verificar cooldown
            if (submitTimestamp && (now - submitTimestamp) < SUBMIT_COOLDOWN) {
                event.preventDefault();
                console.log('Envío bloqueado - muy pronto desde el último envío');
                return false;
            }

            // Validar que hay productos en el carrito (esto depende de tu implementación de Livewire)
            // Puedes añadir aquí validaciones adicionales

            // Marcar como enviando
            isSubmitting = true;
            submitTimestamp = now;

            // Deshabilitar botón y mostrar loading
            submitBtn.disabled = true;
            submitBtn.classList.add('btn-secondary');
            submitBtn.classList.remove('btn-primary');

            submitText.textContent = 'Procesando...';
            submitIcon.className = 'bi bi-hourglass-split'; // ✅ Agregado: cambio de icono

            loadingIndicator.classList.remove('d-none');

            // Timeout de seguridad para rehabilitar el botón si algo sale mal
            setTimeout(() => {
                if (isSubmitting) {
                    resetSubmitButton();
                }
            }, 10000); // 10 segundos

            return true;
        }

        function resetSubmitButton() {
            const submitBtn = document.getElementById('submit-btn'); // ✅ Corregido: era 'submitBtn'
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            isSubmitting = false;
            submitTimestamp = null;

            submitBtn.disabled = false;
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-primary');

            submitText.textContent = 'Enviar a Ciclo'; // ✅ Corregido: texto consistente
            submitIcon.className = 'bi bi-check'; // ✅ Agregado: restaurar icono original

            loadingIndicator.classList.add('d-none');
        }

        // Prevenir envío con Enter en campos de texto (excepto textarea)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('discharge-form');
            const inputs = form.querySelectorAll('input[type="text"], input[type="number"], select');

            inputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        // Mover al siguiente campo
                        const formElements = Array.from(form.elements);
                        const currentIndex = formElements.indexOf(this);
                        const nextElement = formElements[currentIndex + 1];
                        if (nextElement && nextElement.focus) {
                            nextElement.focus();
                        }
                    }
                });
            });

            // Inicializar contador de caracteres
            updateCounter();
        });

        // Detectar si el usuario intenta cerrar la página mientras se está enviando
        /* window.addEventListener('beforeunload', function(e) {
            if (isSubmitting) {
                const message = 'El formulario se está enviando. ¿Estás seguro de que quieres salir?';
                e.preventDefault();
                e.returnValue = message;
                return message;
            }
        });
        */
    </script>
@endpush
