@extends('layouts.app')

@section('title', 'Editar Ingreso')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('receptions.index') }}">Ingreso Instrumental</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);">
                    <i class="bi bi-pencil-square text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Editar Ingreso</h4>
                    <small class="text-muted">
                        Referencia: <strong class="text-dark">{{ $reception->reference }}</strong>
                        &nbsp;&bull;&nbsp;
                        @if ($reception->status === 'Registrado')
                            <span class="badge badge-success" style="font-size:.75rem;padding:3px 8px;border-radius:20px;">Registrado</span>
                        @elseif ($reception->status === 'Procesado')
                            <span class="badge badge-secondary" style="font-size:.75rem;padding:3px 8px;border-radius:20px;">Procesado</span>
                        @else
                            <span class="badge badge-warning" style="font-size:.75rem;padding:3px 8px;border-radius:20px;">Pendiente</span>
                        @endif
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="{{ route('receptions.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
            </div>
        </div>

        {{-- Búsqueda de Productos --}}
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-search text-info mr-2"></i>
                <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Búsqueda de Instrumental
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <livewire:search-product />
            </div>
        </div>

        {{-- Formulario Principal --}}
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                <i class="bi bi-clipboard-data text-primary mr-2"></i>
                <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Datos del Ingreso
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                @include('utils.alerts')

                <form id="reception-form" action="{{ route('receptions.update', $reception) }}" method="POST"
                    onsubmit="return handleFormSubmit(event)">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="form_token" value="{{ uniqid('reception_edit_', true) }}">

                    {{-- Campos de cabecera --}}
                    <div class="form-row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-primary mr-1"></i>
                                    Referencia <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="reference" required
                                    value="{{ $reception->reference }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-diagram-3 text-primary mr-1"></i>
                                    Área Procedente
                                </label>
                                <select class="form-control" id="area" name="area" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                        <option {{ $reception->area == $area->area_name ? 'selected' : '' }}
                                            value="{{ $area->area_name }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person text-primary mr-1"></i>
                                    Persona que entrega
                                </label>
                                <input class="form-control" type="text" id="delivery_staff" name="delivery_staff"
                                    value="{{ $reception->delivery_staff }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-primary mr-1"></i>
                                    Operador
                                </label>
                                <input class="form-control" type="text" id="operator" name="operator"
                                    value="{{ Auth::user()->name }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                    </div>

                    {{-- Carrito de productos --}}
                    <livewire:product-cart :cartInstance="'reception'" :data="$reception" />

                    {{-- Estado y Nota --}}
                    <div class="form-row mt-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on text-primary mr-1"></i>
                                    Estado de Ingreso <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status" id="status" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option {{ $reception->status == 'Pendiente'  ? 'selected' : '' }} value="Pendiente">Pendiente</option>
                                    <option {{ $reception->status == 'Registrado' ? 'selected' : '' }} value="Registrado">Registrado</option>
                                    @can('access_admin')
                                        <option {{ $reception->status == 'Procesado' ? 'selected' : '' }} value="Procesado">Procesado</option>
                                    @endcan
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-chat-text text-secondary mr-1"></i>
                                    Nota (opcional)
                                </label>
                                <textarea name="note" id="note" rows="4" class="form-control" maxlength="400"
                                    onkeyup="updateCounter()"
                                    placeholder="Observaciones adicionales..."
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;">{{ $reception->note }}</textarea>
                                <small class="text-muted">
                                    <span id="charCount">{{ strlen($reception->note ?? '') }}</span>/400 caracteres
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Botón submit con loading --}}
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div id="loading-indicator" class="d-none d-flex align-items-center text-primary">
                            <div class="spinner-border spinner-border-sm mr-2" role="status">
                                <span class="sr-only">Procesando...</span>
                            </div>
                            <span style="font-size:.875rem;">Actualizando registro...</span>
                        </div>
                        <div class="d-flex ml-auto" style="gap:10px;">
                            <a href="{{ route('receptions.index') }}"
                                class="btn btn-outline-secondary d-flex align-items-center"
                                style="border-radius:8px;padding:10px 20px;font-weight:600;">
                                <i class="bi bi-x-circle mr-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning d-flex align-items-center text-dark"
                                id="submit-btn"
                                style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                                <span id="submit-text">Actualizar Ingreso</span>
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
            submitBtn.classList.remove('btn-warning');

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
            submitBtn.classList.add('btn-warning');

            submitText.textContent = 'Actualizar Ingreso';
            submitIcon.className = 'bi bi-check-lg ml-2';

            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('reception-form');
            const inputs = form.querySelectorAll('input[type="text"], select');

            inputs.forEach(input => {
                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const formElements = Array.from(form.elements);
                        const currentIndex = formElements.indexOf(this);
                        const nextElement = formElements[currentIndex + 1];
                        if (nextElement && nextElement.focus) {
                            nextElement.focus();
                        }
                    }
                });
            });

            updateCounter();
        });
    </script>
@endpush
