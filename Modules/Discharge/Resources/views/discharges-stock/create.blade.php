@extends('layouts.app')

@section('title', 'Envío al Almacén')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Ciclos Liberados</a></li>
        <li class="breadcrumb-item active">Envío al Almacén</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                    <i class="bi bi-box-arrow-in-right text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Envío al Almacén</h4>
                    <small class="text-muted">
                        Ciclo: <strong class="text-dark">{{ $stock->reference }}</strong>
                        &nbsp;&bull;&nbsp; Equipo: <strong class="text-dark">{{ $stock->machine_name }}</strong>
                    </small>
                </div>
            </div>
            <a href="{{ route('discharges.index') }}"
                class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        @include('utils.alerts')

        <form id="stock-form" action="{{ route('stocks.store') }}" method="POST" onsubmit="return handleFormSubmit(event)">
            @csrf
            <input type="hidden" name="form_token" value="{{ uniqid('stock_', true) }}">
            <input type="hidden" name="discharge_id" value="{{ $discharge_id }}">

            {{-- Información del Ciclo --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #8b5cf6;">
                    <i class="bi bi-gear mr-2" style="color:#8b5cf6;"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Ciclo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Referencia
                            </label>
                            <input type="text" class="form-control form-control-sm" name="reference"
                                value="STOCK" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Tipo Esterilización
                            </label>
                            <input type="text" class="form-control form-control-sm" name="machine_type"
                                value="{{ $stock->machine_type }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Equipo
                            </label>
                            <input type="text" class="form-control form-control-sm" name="machine_name"
                                value="{{ $stock->machine_name }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Lote del Equipo
                            </label>
                            <input type="text" class="form-control form-control-sm" name="lote_machine"
                                value="{{ $stock->lote_machine }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Lote Biológico
                            </label>
                            <input type="text" class="form-control form-control-sm" name="lote_biologic"
                                value="{{ $stock->lote_biologic }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Operador
                            </label>
                            <input type="text" class="form-control form-control-sm" name="operator"
                                value="{{ Auth::user()->name }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Temp. Ambiente <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" name="temp_ambiente"
                                value="{{ $stock->temp_ambiente }}" min="1" step="0.1" required
                                style="border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Carrito de Productos --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                    <i class="bi bi-cart3 text-info mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Productos a Almacenar
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <livewire:product-carttoStock :cartInstance="'stock'" :data="$stock" />
                </div>
            </div>

            {{-- Nota --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #94a3b8;">
                    <i class="bi bi-chat-left-text text-secondary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Observaciones
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <textarea name="note" id="note" rows="3" class="form-control"
                        placeholder="Notas u observaciones adicionales (opcional)..."
                        style="border-radius:8px;resize:none;">{{ $stock->note }}</textarea>
                    <small class="text-muted" style="font-size:.75rem;">
                        <span id="charCount">0</span> caracteres
                    </small>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="d-flex align-items-center justify-content-between">
                <div id="loading-indicator" class="d-none d-flex align-items-center text-muted" style="gap:8px;">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Procesando...</span>
                    </div>
                    <span style="font-size:.9rem;">Almacenando producto estéril...</span>
                </div>
                <div></div>
                <button type="submit" id="submit-btn"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:11px 28px;font-weight:600;background:linear-gradient(135deg,#10b981,#059669);border:none;box-shadow:0 4px 12px rgba(16,185,129,0.35);gap:8px;">
                    <i class="bi bi-check-lg" id="submit-icon"></i>
                    <span id="submit-text">Enviar al Almacén</span>
                </button>
            </div>

        </form>

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

            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitText.textContent = 'Procesando...';
            submitIcon.className = 'bi bi-hourglass-split';
            loadingIndicator.classList.remove('d-none');

            setTimeout(() => {
                if (isSubmitting) resetSubmitButton();
            }, 10000);

            return true;
        }

        function resetSubmitButton() {
            isSubmitting = false;
            submitTimestamp = null;

            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            document.getElementById('submit-text').textContent = 'Enviar al Almacén';
            document.getElementById('submit-icon').className = 'bi bi-check-lg';
            document.getElementById('loading-indicator').classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('stock-form');
            const inputs = form.querySelectorAll('input[type="text"], input[type="number"], select');

            inputs.forEach(input => {
                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const formElements = Array.from(form.elements);
                        const next = formElements[formElements.indexOf(this) + 1];
                        if (next && next.focus) next.focus();
                    }
                });
            });

            const note = document.getElementById('note');
            if (note) {
                note.addEventListener('input', updateCounter);
                updateCounter();
            }
        });
    </script>
@endpush
