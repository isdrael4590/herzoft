@extends('layouts.app')

@section('title', 'Editar Lavado')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lavados.index') }}">Lavados</a></li>
        <li class="breadcrumb-item active">Editar {{ $lavado->reference }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);">
                    <i class="bi bi-droplet text-white" style="font-size:1.4rem;"></i>
                </div>
            </div>
            <a href="{{ route('lavados.index') }}" class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        {{-- Formulario de Edición --}}
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                <i class="bi bi-droplet text-primary mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Datos del Lavado — {{ $lavado->reference }}
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                @include('utils.alerts')

                <form id="lavado-form" action="{{ route('lavados.update', $lavado->id) }}" method="POST"
                    onsubmit="return handleFormSubmit(event)">
                    @csrf @method('PUT')

                    {{-- Campos de cabecera --}}
                    <div class="form-row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-primary mr-1"></i>
                                    Operador <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="operator"
                                    value="{{ old('operator', $lavado->operator) }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-cpu text-primary mr-1"></i>
                                    Equipo Lavadora
                                </label>
                                <select class="form-control" name="machine_name" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                        @if ($machines->machine_type == 'Lavadora')
                                            <option value="{{ $machines->machine_name }}"
                                                {{ old('machine_name', $lavado->machine_name) === $machines->machine_name ? 'selected' : '' }}>
                                                {{ $machines->machine_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-primary mr-1"></i>
                                    Lote
                                </label>
                                <input type="text" name="lote" class="form-control" placeholder="N° de lote"
                                    value="{{ old('lote', $lavado->lote) }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-list-check text-primary mr-1"></i>
                                    Programa de Lavado
                                </label>
                                <select class="form-control" name="type_program" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (\Modules\Informat\Entities\Proceso::all() as $proceso)
                                        @if ($proceso->proceso_type == 'LAVADO')
                                            <option value="{{ $proceso->proceso_name }}"
                                                {{ old('type_program', $lavado->type_program) === $proceso->proceso_name ? 'selected' : '' }}>
                                                {{ $proceso->proceso_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-primary mr-1"></i>
                                    Temperatura (°C)
                                </label>
                                <input type="number" step="0.1" name="temperatura" class="form-control"
                                    placeholder="Ej: 93.0" value="{{ old('temperatura', $lavado->temperatura) }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                    </div>

                    {{-- Agregar instrumental pendiente --}}
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-secondary mb-2"
                            style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">
                            <i class="bi bi-plus-circle text-primary mr-1"></i> Agregar instrumental pendiente
                        </h6>
                        <livewire:search-product-washer />
                        <div class="mt-3">
                            <livewire:product-cart-washer :cartInstance="'lavados'" />
                        </div>
                    </div>

                    {{-- Estado y Nota --}}
                    <div class="form-row mt-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on text-primary mr-1"></i>
                                    Estado del Indicador <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="status_indicador"
                                    value="Sin Validar" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-check2-circle text-primary mr-1"></i>
                                    Estado del Ciclo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status_ciclo" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (['Pendiente', 'Cargar'] as $ciclo)
                                        <option value="{{ $ciclo }}"
                                            {{ old('status_ciclo', $lavado->status_ciclo) === $ciclo ? 'selected' : '' }}>
                                            {{ $ciclo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-chat-text text-secondary mr-1"></i>
                                    Nota (opcional)
                                </label>
                                <textarea name="note" rows="4" class="form-control" maxlength="400" onkeyup="updateCounter()"
                                    placeholder="Observaciones adicionales..."
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;">{{ old('note', $lavado->note) }}</textarea>
                                <small class="text-muted">
                                    <span id="charCount">{{ strlen(old('note', $lavado->note ?? '')) }}</span>/400
                                    caracteres
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div id="loading-indicator" class="d-none d-flex align-items-center text-primary">
                            <div class="spinner-border spinner-border-sm mr-2" role="status">
                                <span class="sr-only">Procesando...</span>
                            </div>
                            <span style="font-size:.875rem;">Guardando cambios...</span>
                        </div>
                        <div class="d-flex ml-auto" style="gap:10px;">
                            <a href="{{ route('lavados.index') }}"
                                class="btn btn-outline-secondary d-flex align-items-center"
                                style="border-radius:8px;padding:10px 20px;font-weight:600;">
                                <i class="bi bi-x-circle mr-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary d-flex align-items-center" id="submit-btn"
                                style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(59,130,246,0.35);">
                                <span id="submit-text">Guardar Cambios</span>
                                <i class="bi bi-check-lg ml-2" id="submit-icon"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@push('page_scripts')
    <script>
        let isSubmitting = false;
        let submitTimestamp = null;
        const SUBMIT_COOLDOWN = 3000;

        function updateCounter() {
            const textarea = document.querySelector('textarea[name="note"]');
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

            if (isSubmitting) {
                event.preventDefault();
                return false;
            }
            if (submitTimestamp && (now - submitTimestamp) < SUBMIT_COOLDOWN) {
                event.preventDefault();
                return false;
            }

            isSubmitting = true;
            submitTimestamp = now;
            submitBtn.disabled = true;
            submitBtn.classList.add('btn-secondary');
            submitBtn.classList.remove('btn-primary');
            submitText.textContent = 'Procesando...';
            submitIcon.className = 'bi bi-hourglass-split ml-2';
            loadingIndicator.classList.remove('d-none');

            setTimeout(() => {
                if (isSubmitting) resetSubmitButton();
            }, 10000);
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
            submitText.textContent = 'Guardar Cambios';
            submitIcon.className = 'bi bi-check-lg ml-2';
            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCounter();
        });
    </script>
@endpush
