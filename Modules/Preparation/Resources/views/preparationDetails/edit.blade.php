@extends('layouts.app')

@section('title', 'Editar Producto Stok')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('preparationDetails.index') }}">Disponibilidad Preparación</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">

        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')

                        {{-- Formulario con token CSRF único y prevención de doble envío --}}
                        <form id="preparationDetails-form"
                            action="{{ route('preparationDetails.update', $preparationDetails) }}" method="POST"
                            onsubmit="return handleFormSubmit(event)">
                            @csrf
                            @method('patch')
                            {{-- Token adicional para prevenir duplicados --}}
                            <input type="hidden" name="form_token" value="{{ uniqid('preparation_details_', true) }}">

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required readonly
                                            value="{{ $preparationDetails->product_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_code">Código del Producto<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required readonly
                                            value="{{ $preparationDetails->product_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_quantity">Cantidad<span class="text-danger">*</span></label>
                                        <input class="form-control" name="product_quantity" type="number"
                                            class="form-control" value="{{ $preparationDetails->product_quantity }}"
                                            min="0">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_state_preparation">Estado de Stock Producto<span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" id="product_state_preparation"
                                            name="product_state_preparation">

                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Disponible' ? 'selected' : '' }}
                                                value="Disponible">
                                                Disponible</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Cargado' ? 'selected' : '' }}
                                                value="Cargado">Cargado</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'En Curso' ? 'selected' : '' }}
                                                value="En Curso">En Curso</option>
                                            <option
                                                {{ $preparationDetails->product_state_preparation == 'Procesado' ? 'selected' : '' }}
                                                value="Procesado">Procesado</option>
                                            {{--   <option
                                                {{ $preparationDetails->product_state_preparation == 'Reprocesar' ? 'selected' : '' }}
                                                value="Reprocesar">Reprocesar</option>

                                                --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_coming_zone">Area Proveniente<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_coming_zone" required
                                            readonly value="{{ $preparationDetails->product_coming_zone }}">
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_type_process">Temperatura de proceso<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_type_process" required
                                            readonly value="{{ $preparationDetails->product_type_process }}">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_info">Informacion corta paquete<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_info"
                                            value="{{ $preparationDetails->product_info }}" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_patient">Paciente si aplica<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_patient"
                                            value="{{ $preparationDetails->product_patient }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_outside_company">Casa Comercial si aplica<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_outside_company"
                                            value="{{ $preparationDetails->product_outside_company }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="product_area">Área<span class="text-danger">*</span></label>
                                        <select class="form-control" id="area" name="product_area" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option
                                                    {{ $preparationDetails->product_area == $area->area_name ? 'selected' : '' }}value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span id="submit-text">Actualización Proceso</span>
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

            // Validaciones adicionales si es necesario
            const quantity = document.querySelector('input[name="product_quantity"]').value;
            if (quantity < 0) {
                event.preventDefault();
                alert('La cantidad no puede ser negativa');
                return false;
            }

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

            submitText.textContent = 'Actualización Proceso';
            submitIcon.className = 'bi bi-check';

            loadingIndicator.classList.add('d-none');
        }

        // Prevenir envío con Enter en campos de texto (excepto textarea)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('preparationDetails-form');
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
