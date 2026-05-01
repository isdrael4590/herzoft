@extends('layouts.app')

@section('title', 'Liberar Ciclo')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Descarga de Ciclos</a></li>
        <li class="breadcrumb-item active">Liberar</li>
    </ol>
@endsection

@section('content')
    @php
        $isSteam   = $discharge->machine_type == 'Autoclave';
        $isHpo     = $discharge->machine_type == 'Peroxido';
        $typeColor = $isHpo ? '#4990e1' : '#a46c05';
        $typeBg    = $isHpo ? '#e8f4ff' : '#fff8ee';
    @endphp
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:{{ $typeColor }};">
                    <i class="bi bi-unlock text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Liberar Ciclo
                        @if ($isSteam)
                            <span class="badge badge-pill ml-2"
                                  style="background-color:#a46c05;color:#fff;font-size:.75rem;padding:4px 10px;">
                                <i class="bi bi-thermometer-high"></i> STEAM — Alta Temperatura
                            </span>
                        @elseif ($isHpo)
                            <span class="badge badge-pill ml-2"
                                  style="background-color:#4990e1;color:#fff;font-size:.75rem;padding:4px 10px;">
                                <i class="bi bi-wind"></i> HPO — Baja Temperatura
                            </span>
                        @endif
                    </h4>
                    <small class="text-muted">
                        Referencia: <strong class="text-dark">{{ $discharge->reference }}</strong>
                        &nbsp;&bull;&nbsp; Equipo: <strong class="text-dark">{{ $discharge->machine_name }}</strong>
                        &nbsp;&bull;&nbsp;
                        @if ($discharge->status_cycle == 'Ciclo Aprobado')
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Ciclo Aprobado
                            </span>
                        @elseif ($discharge->status_cycle == 'Ciclo Falla')
                            <span class="badge badge-danger" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-x-circle mr-1"></i> Ciclo Falla
                            </span>
                        @elseif ($discharge->status_cycle == 'En Curso')
                            <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-arrow-repeat mr-1"></i> En Curso
                            </span>
                        @else
                            <span class="badge badge-dark" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> {{ $discharge->status_cycle }}
                            </span>
                        @endif
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

        <form id="discharge-form" action="{{ route('discharges.update', $discharge) }}" method="POST"
            onsubmit="return handleFormSubmit(event)">
            @csrf
            @method('patch')
            <input type="hidden" name="form_token" value="{{ uniqid('discharge_edit_', true) }}">

            {{-- Información del Proceso (readonly) --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background-color:{{ $typeBg }};border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid {{ $typeColor }};">
                    <i class="bi bi-gear mr-2" style="color:{{ $typeColor }};"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        @if ($isSteam) <i class="bi bi-thermometer-high mr-1"></i> @elseif ($isHpo) <i class="bi bi-wind mr-1"></i> @endif
                        Información del Proceso
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Ref. Descarga
                            </label>
                            <input type="text" class="form-control form-control-sm" name="reference"
                                value="{{ $discharge->reference }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Ref. Proceso
                            </label>
                            <input type="text" class="form-control form-control-sm" name="labelqr_id"
                                value="{{ $discharge->labelqr_id }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Tipo Esterilización
                            </label>
                            <input type="text" class="form-control form-control-sm" name="machine_type"
                                value="{{ $discharge->machine_type }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Equipo
                            </label>
                            <input type="text" class="form-control form-control-sm" name="machine_name"
                                value="{{ $discharge->machine_name }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Lote Equipo
                            </label>
                            <input type="text" class="form-control form-control-sm" name="lote_machine"
                                value="{{ $discharge->lote_machine }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Lote Agente Esteril.
                            </label>
                            <input type="text" class="form-control form-control-sm" name="lote_agente"
                                value="{{ $discharge->lote_agente }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Temp. Equipo
                            </label>
                            <input type="text" class="form-control form-control-sm" name="temp_machine"
                                value="{{ $discharge->temp_machine }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Tipo de Programa
                            </label>
                            <input type="text" class="form-control form-control-sm" name="type_program"
                                value="{{ $discharge->type_program }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Lote Biológico
                            </label>
                            <input type="text" class="form-control form-control-sm" name="lote_biologic"
                                value="{{ $discharge->lote_biologic }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Operador Carga
                            </label>
                            <input type="text" class="form-control form-control-sm" name="operator"
                                value="{{ $discharge->operator }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Liberación del Ciclo (editable) --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                    <i class="bi bi-unlock text-success mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Datos de Liberación
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Temp. Ambiente <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" name="temp_ambiente"
                                value="{{ $discharge->temp_ambiente }}" min="1" step="0.1" required
                                style="border-radius:8px;">
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Validación Biológica
                            </label>
                            <select class="form-control form-control-sm" name="validation_biologic" style="border-radius:8px;">
                                <option value="Sin Validar" {{ $discharge->validation_biologic == 'Sin Validar' || $discharge->validation_biologic == 'sin_validar' ? 'selected' : '' }}>
                                    Sin Validar
                                </option>
                                <option value="Correcto" {{ $discharge->validation_biologic == 'Correcto' ? 'selected' : '' }}>
                                    Correcto
                                </option>
                                <option value="Falla" {{ $discharge->validation_biologic == 'Falla' ? 'selected' : '' }}>
                                    Falla
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Estado del Ciclo <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" name="status_cycle" required style="border-radius:8px;">
                                <option value="Pendiente"      {{ $discharge->status_cycle == 'Pendiente'      ? 'selected' : '' }}>Pendiente</option>
                                <option value="En Curso"       {{ $discharge->status_cycle == 'En Curso'       ? 'selected' : '' }}>En Curso</option>
                                <option value="Ciclo Aprobado" {{ $discharge->status_cycle == 'Ciclo Aprobado' ? 'selected' : '' }}>Ciclo Aprobado</option>
                                <option value="Ciclo Falla"    {{ $discharge->status_cycle == 'Ciclo Falla'    ? 'selected' : '' }}>Ciclo Falla</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Operador Descarga
                            </label>
                            <input type="text" class="form-control form-control-sm" name="operator_discharge"
                                value="{{ Auth::user()->name }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Carrito de Productos --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background-color:{{ $typeBg }};border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid {{ $typeColor }};">
                    <i class="bi bi-cart3 mr-2" style="color:{{ $typeColor }};"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Instrumental del Ciclo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    @if ($discharge->machine_type == 'Peroxido')
                        <livewire:product-carttoDES :cartInstance="'discharge_hpo'" :data="$discharge" />
                    @else
                        <livewire:product-carttoDES :cartInstance="'discharge'" :data="$discharge" />
                    @endif
                </div>
            </div>

            {{-- Observaciones --}}
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
                        style="border-radius:8px;resize:none;">{{ $discharge->note }}</textarea>
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
                    <span style="font-size:.9rem;">Liberando proceso...</span>
                </div>
                <div></div>
                <button type="submit" id="submit-btn"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:11px 28px;font-weight:600;background:linear-gradient(135deg,#8b5cf6,#7c3aed);border:none;box-shadow:0 4px 12px rgba(139,92,246,0.35);gap:8px;">
                    <i class="bi bi-check-lg" id="submit-icon"></i>
                    <span id="submit-text">Liberar Proceso</span>
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
            if (textarea && counter) counter.textContent = textarea.value.length;
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
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            document.getElementById('submit-text').textContent = 'Procesando...';
            document.getElementById('submit-icon').className = 'bi bi-hourglass-split';
            document.getElementById('loading-indicator').classList.remove('d-none');

            setTimeout(() => { if (isSubmitting) resetSubmitButton(); }, 10000);

            return true;
        }

        function resetSubmitButton() {
            isSubmitting = false;
            submitTimestamp = null;

            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            document.getElementById('submit-text').textContent = 'Liberar Proceso';
            document.getElementById('submit-icon').className = 'bi bi-check-lg';
            document.getElementById('loading-indicator').classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('discharge-form');
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
