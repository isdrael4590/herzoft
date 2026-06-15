@extends('layouts.app')

@section('title', 'Editar Producto Stock')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stockDetails.index') }}">Disponibilidad Stock</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-box-seam text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Editar Producto Stock</h4>
                    <small class="text-muted">
                        Producto: <strong class="text-dark">{{ $stockDetails->product_name }}</strong>
                        &nbsp;&bull;&nbsp; Código: <strong class="text-dark">{{ $stockDetails->product_code }}</strong>
                        &nbsp;&bull;&nbsp;
                        @if ($stockDetails->product_status_stock == 'Disponible')
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Disponible
                            </span>
                        @elseif ($stockDetails->product_status_stock == 'Despachado')
                            <span class="badge badge-secondary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-box-arrow-right mr-1"></i> Despachado
                            </span>
                        @else
                            <span class="badge badge-dark" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> {{ $stockDetails->product_status_stock }}
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            <a href="{{ route('stockDetails.index') }}"
                class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        @include('utils.alerts')

        <form id="stockDetails-form" action="{{ route('stockDetails.update', $stockDetails) }}" method="POST"
            onsubmit="return handleFormSubmit(event)">
            @csrf
            @method('patch')
            <input type="hidden" name="form_token" value="{{ uniqid('stock_details_', true) }}">

            {{-- Información del Producto (readonly) --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                    <i class="bi bi-info-circle mr-2" style="color:#0ea5e9;"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Producto
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Nombre del Producto
                            </label>
                            <input type="text" class="form-control form-control-sm" name="product_name"
                                value="{{ $stockDetails->product_name }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Código del Producto
                            </label>
                            <input type="text" class="form-control form-control-sm" name="product_code"
                                value="{{ $stockDetails->product_code }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Fecha de Esterilización
                            </label>
                            <input type="text" class="form-control form-control-sm" name="product_date_sterilized"
                                value="{{ $stockDetails->product_date_sterilized }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Fecha de Expiración
                            </label>
                            <input type="text" class="form-control form-control-sm" name="product_expiration"
                                value="{{ $stockDetails->product_expiration }}" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Datos editables de Stock --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                    <i class="bi bi-pencil-square text-success mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Datos de Stock
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Estado de Stock <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" id="product_status_stock" name="product_status_stock"
                                style="border-radius:8px;">
                                <option value="Disponible" {{ $stockDetails->product_status_stock == 'Disponible' ? 'selected' : '' }}>
                                    Disponible
                                </option>
                                <option value="Despachado" {{ $stockDetails->product_status_stock == 'Despachado' ? 'selected' : '' }}>
                                    Despachado
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Cantidad Disponible <span class="text-danger">*</span>
                            </label>
                            <input class="form-control form-control-sm" name="product_quantity" type="number"
                                value="{{ $stockDetails->product_quantity }}" min="0"
                                style="border-radius:8px;">
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Cantidad Despachada <span class="text-danger">*</span>
                            </label>
                            <input class="form-control form-control-sm" name="product_quantity_expedition" type="number"
                                value="{{ $stockDetails->product_quantity_expedition }}" min="0"
                                style="border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="d-flex align-items-center justify-content-between">
                <div id="loading-indicator" class="d-none d-flex align-items-center text-muted" style="gap:8px;">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Procesando...</span>
                    </div>
                    <span style="font-size:.9rem;">Actualizando proceso...</span>
                </div>
                <div></div>
                <button type="submit" id="submit-btn"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:11px 28px;font-weight:600;background:linear-gradient(135deg,#0ea5e9,#0284c7);border:none;box-shadow:0 4px 12px rgba(14,165,233,0.35);gap:8px;">
                    <i class="bi bi-check-lg" id="submit-icon"></i>
                    <span id="submit-text">Actualizar Stock</span>
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

            const quantity = document.querySelector('input[name="product_quantity"]').value;
            if (quantity < 0) {
                event.preventDefault();
                alert('La cantidad no puede ser negativa');
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
            document.getElementById('submit-text').textContent = 'Actualizar Stock';
            document.getElementById('submit-icon').className = 'bi bi-check-lg';
            document.getElementById('loading-indicator').classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('stockDetails-form');
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
        });
    </script>
@endpush
