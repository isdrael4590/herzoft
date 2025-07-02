@extends('layouts.app')

@section('title', 'Editar Ingreso')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('receptions.index') }}">Recepción Instrumental</a></li>
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

                        {{-- Formulario con token CSRF único y prevención de doble envío --}}
                        <form id="reception-form" action="{{ route('receptions.update', $reception) }}" method="POST"
                            onsubmit="return handleFormSubmit(event)">
                            @csrf
                            @method('patch')
                            {{-- Token adicional para prevenir duplicados --}}
                            <input type="hidden" name="form_token" value="{{ uniqid('reception_edit_', true) }}">

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $reception->reference }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Área Procedente</label>
                                        <select class="form-control" id="area" name="area" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option
                                                    {{ $reception->area == $area->area_name ? 'selected' : '' }}value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Persona que entrega</label>
                                        <input class="form-control" type="text" id="delivery_staff" name="delivery_staff"
                                            value="{{ $reception->delivery_staff }}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label>Operador</label>
                                            <input class="form-control" type="text" id="operator" name="operator"
                                                placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <livewire:product-cart :cartInstance="'reception'" :data="$reception" />

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Estado de Ingreso <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option {{ $reception->status == 'Pendiente' ? 'selected' : '' }}
                                                value="Pendiente">Pendiente</option>
                                            <option {{ $reception->status == 'Registrado' ? 'selected' : '' }}
                                                value="Registrado">Registrado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control" maxlength="400" onkeyup="updateCounter()">{{ $reception->note }}</textarea>
                                <small class="text-muted"><span
                                        id="charCount">{{ strlen($reception->note ?? '') }}</span>/400 caracteres</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span id="submit-text">Actualizar Ingreso</span>
                                    <i class="bi bi-check" id="submit-icon"></i>
                                </button>

                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-2">Actualizando registro...</span>
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

            submitText.textContent = 'Actualizar Ingreso';
            submitIcon.className = 'bi bi-check';

            loadingIndicator.classList.add('d-none');
        }

        // Prevenir envío con Enter en campos de texto (excepto textarea)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reception-form');
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
