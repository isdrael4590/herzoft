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


        <div class="row mt-4">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        {{-- Formulario con token CSRF único y prevención de doble envío --}}
                        <form id="labelqr-form" action="{{ route('labelqrs.update', $labelqr) }}" method="POST"
                            onsubmit="return handleFormSubmit(event)">
                            @csrf
                            @method('patch')
                            {{-- Token adicional para prevenir duplicados --}}
                            <input type="hidden" name="form_token" value="{{ uniqid('labelqr_edit_', true) }}">

                            @if ($labelqr->machine_type == 'Autoclave')

                                <BR></BR>
                                <div class="form-row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="machine_type">Tipo Esterilización <span
                                                    class="text-danger">*</span></label>
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
                                            <label for="lote_machine">Lote del Equipo <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="lote_machine" required
                                                value="{{ $labelqr->lote_machine }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="temp_machine">Temperatura del Equipo <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="temp_machine" name="temp_machine">
                                                <option {{ $labelqr->temp_machine == '134' ? 'selected' : '' }}
                                                    value="134">134</option>
                                                <option {{ $labelqr->temp_machine == '121' ? 'selected' : '' }}
                                                    value="121">121</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="type_program">TIPO DE PROGRAMA</label>
                                            <select class="form-control" id="type_program" name="type_program">
                                                @foreach (\Modules\Informat\Entities\Proceso::all() as $proceso)
                                                    @if ($proceso->proceso_type == 'ALTA TEMPERATURA')
                                                        <option
                                                            {{ $labelqr->type_program == $proceso->proceso_name ? 'selected' : '' }}value="{{ $proceso->proceso_name }}">
                                                            {{ $proceso->proceso_name }}</option>
                                                    @endif
                                                @endforeach


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
                                                value="{{ $labelqr->temp_ambiente }}" min="1" step="0.1">
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
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <livewire:search-producttoQR />
                                    </div>
                                </div>
                                <br>
                                <br>
                                <livewire:product-carttoQR :cartInstance="'labelqr'" :data="$labelqr" />
                            @elseif ($labelqr->machine_type == 'Peroxido')
                                <BR></BR>
                                <div class="form-row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="machine_type">Tipo Esterilización <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="machine_type" required
                                                readonly value="{{ $labelqr->machine_type }}">
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
                                            <label for="lote_machine">Lote del Equipo <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="lote_machine" required
                                                value="{{ $labelqr->lote_machine }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="temp_machine">Temperatura del Equipo <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="temp_machine" name="temp_machine">
                                                <option {{ $labelqr->temp_machine == '52' ? 'selected' : '' }}
                                                    value="52">52</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="lote_agente">Lote Agente Esterilizante <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="lote_agente" required
                                                value="{{ $labelqr->lote_agente }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="type_program">TIPO DE PROGRAMA</label>
                                            <select class="form-control" id="type_program" name="type_program">
                                                @foreach (\Modules\Informat\Entities\Proceso::all() as $proceso)
                                                    @if ($proceso->proceso_type == 'BAJA TEMPERATURA')
                                                        <option
                                                            {{ $labelqr->type_program == $proceso->proceso_name ? 'selected' : '' }}value="{{ $proceso->proceso_name }}">
                                                            {{ $proceso->proceso_name }}</option>
                                                    @endif
                                                @endforeach


                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="lote_biologic">Lote del Insumo Biológico <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="lote_biologic" name="lote_biologic"
                                                required>
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
                                            <select class="form-control" name="validation_biologic"
                                                id="validation_biologic" readonly>
                                                <option
                                                    {{ $labelqr->validation_biologic == 'sin_validar' ? 'selected' : '' }}
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
                                                value="{{ $labelqr->temp_ambiente }}" min="1" step="0.1">
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
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <livewire:search-producttoQRHPO />
                                    </div>
                                </div>
                                <br>
                                <br>
                                <livewire:product-carttoQRHPO :cartInstance="'labelqr'" :data="$labelqr" />
                            @endif

                            <div class="form-group">
                                <label for="note_labelqr">Nota (Si se necesita)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="5" class="form-control" maxlength="400"
                                    onkeyup="updateCounter()" placeholder="Escriba aquí cualquier observación adicional...">{{ $labelqr->note_labelqr }}</textarea>
                                <small class="text-muted"><span
                                        id="charCount">{{ strlen($labelqr->note_labelqr ?? '') }}</span>/400
                                    caracteres</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span id="submit-text">Actualizar Proceso</span>
                                    <i class="bi bi-check" id="submit-icon"></i>
                                </button>

                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-2">Actualizando proceso...</span>
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
            const textarea = document.getElementById('note_labelqr');
            const counter = document.getElementById('charCount');
            if (textarea && counter) {
                counter.textContent = textarea.value.length;
            }
        }

        function handleFormSubmit(event) {
            const now = Date.now();
            const submitBtn = document.getElementById('submit-btn');
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

            submitText.textContent = 'Actualizando...';
            submitIcon.className = 'bi bi-hourglass-split';

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
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            isSubmitting = false;
            submitTimestamp = null;

            submitBtn.disabled = false;
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-primary');

            submitText.textContent = 'Actualizar Proceso';
            submitIcon.className = 'bi bi-check';

            loadingIndicator.classList.add('d-none');
        }

        // Prevenir envío con Enter en campos de texto (excepto textarea)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('labelqr-form');
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
        }); */
    </script>
@endpush
