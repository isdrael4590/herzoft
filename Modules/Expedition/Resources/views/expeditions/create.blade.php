@php
    $Expedition_max_id = \Modules\Expedition\Entities\Expedition::max('id') + 1;
    $expedition_code = 'EXP_' . str_pad($Expedition_max_id, 5, '0', STR_PAD_LEFT);
@endphp
@extends('layouts.app')

@section('title', 'Registrar Despacho')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expeditions.index') }}">Generador Despacho</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-producttoEXP />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="expedition-form" action="{{ route('expeditions.store') }}" method="POST" onsubmit="return handleFormSubmit(event)">
                            @csrf
                              <input type="hidden" name="form_token" value="{{ uniqid('expedition_', true) }}">
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="{{ $expedition_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_expedition">Estado del Despacho <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_expedition" id="status_expedition"
                                            required>
                                            <option selected value="Pendiente">Pendiente</option>
                                            <option  value="Despachado">Despachar</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ old('temp_ambiente') }}"min="1" step="0.1">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="area_expedition">Area de expedición <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="area_expedition" name="area_expedition" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="staff_expedition">Persona quién Recibe <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="staff_expedition" required
                                            value="{{ old('staff_expedition') }}">
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
                            <livewire:product-carttoEXP :cartInstance="'expedition'" />
                            <div class="form-row">
                            </div>
                            <div class="form-group">
                                <label for="note_expedition">Nota (Si se necesita)</label>
                                <textarea name="note_expedition" id="note_expedition" rows="5" class="form-control"></textarea>
                            </div>

                               <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span id="submit-text">Despachar Producto</span>
                                    <i class="bi bi-check" id="submit-icon"></i>
                                </button>

                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-2">Despachando.....</span>
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

            submitText.textContent = 'Procesando...';
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

            submitText.textContent = 'Despachar Producto';
            submitIcon.className = 'bi bi-check';

            loadingIndicator.classList.add('d-none');
        }

        // Prevenir envío con Enter en campos de texto (excepto textarea)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('preparation-form');
            const inputs = form.querySelectorAll('input[type="text"], select');

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