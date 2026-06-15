@extends('layouts.app')

@section('title', 'Editar Paquete')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#6366f1,#4f46e5);">
                    <i class="bi bi-box text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Editar Paquete</h4>
                    <small class="text-muted">
                        <strong class="text-dark">{{ $product->product_name }}</strong>
                        &nbsp;&bull;&nbsp; Código: <strong class="text-dark">{{ $product->product_code }}</strong>
                    </small>
                </div>
            </div>
            <a href="{{ route('products.index') }}"
                class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        @include('utils.alerts')

        <form id="product-form" action="{{ route('products.update', $product) }}" method="POST"
            onsubmit="return handleFormSubmit(event)"
            data-form-type="other">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_token" value="{{ uniqid('product_edit_', true) }}">
            <input type="hidden" name="subproducts_json" id="subproducts_json" value="">

            {{-- Información del Paquete --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #6366f1;">
                    <i class="bi bi-box mr-2" style="color:#6366f1;"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Paquete
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Nombre del Paquete <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="product_name" id="product_name"
                                class="form-control form-control-sm @error('product_name') is-invalid @enderror"
                                value="{{ old('product_name', $product->product_name) }}" required
                                style="border-radius:8px;">
                            @error('product_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-2 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Código <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="product_code" id="paquete_ref"
                                class="form-control form-control-sm @error('product_code') is-invalid @enderror"
                                value="{{ old('product_code', $product->product_code) }}" required
                                autocomplete="off" data-lpignore="true" data-1p-ignore
                                style="border-radius:8px;">
                            @error('product_code')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Categoría / Especialidad <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" name="category_id" id="category_id"
                                required style="border-radius:8px;">
                                @foreach (\Modules\Product\Entities\Category::all() as $category)
                                    <option {{ $category->id == $product->category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Simbología Barcode <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" name="product_barcode_symbology"
                                id="barcode_symbology" required style="border-radius:8px;">
                                <option {{ $product->product_barcode_symbology == 'C128' ? 'selected' : '' }} value="C128">Code 128</option>
                                <option {{ $product->product_barcode_symbology == 'C39'  ? 'selected' : '' }} value="C39">Code 39</option>
                                <option {{ $product->product_barcode_symbology == 'UPCA' ? 'selected' : '' }} value="UPCA">UPC-A</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Clasificación --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                    <i class="bi bi-tags text-success mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Clasificación
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Área <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" id="area" name="area"
                                required style="border-radius:8px;">
                                @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                    <option {{ $product->area == $area->area_name ? 'selected' : '' }}
                                        value="{{ $area->area_name }}">{{ $area->area_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Temperatura de Proceso <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" name="product_type_process"
                                id="product_type_process" required style="border-radius:8px;">
                                <option {{ $product->product_type_process == 'Alta Temperatura' ? 'selected' : '' }} value="Alta Temperatura">Alta Temperatura</option>
                                <option {{ $product->product_type_process == 'Baja Temperatura' ? 'selected' : '' }} value="Baja Temperatura">Baja Temperatura</option>
                                <option {{ $product->product_type_process == 'N/A'              ? 'selected' : '' }} value="N/A">N/A</option>
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Cantidad
                            </label>
                            <input type="number" name="product_quantity" id="product_quantity"
                                class="form-control form-control-sm"
                                value="{{ old('product_quantity', $product->product_quantity) }}" min="0"
                                style="border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Precio
                            </label>
                            <input type="number" name="product_price" id="product_price"
                                class="form-control form-control-sm"
                                value="{{ old('product_price', $product->product_price) }}" step="0.01" min="0"
                                style="border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Unidad
                            </label>
                            <select class="form-control form-control-sm" name="product_unit" id="product_unit"
                                style="border-radius:8px;">
                                <option value="" selected>Seleccionar Unidad</option>
                                @foreach (\Modules\Informat\Entities\Unit::all() as $unit)
                                    <option {{ $product->product_unit == $unit->short_name ? 'selected' : '' }}
                                        value="{{ $unit->short_name }}">{{ $unit->name . ' | ' . $unit->short_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Paciente (Solo Casa Comercial)
                            </label>
                            <input type="text" class="form-control form-control-sm" name="product_patient"
                                value="{{ $product->product_patient }}" style="border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Instrumental (subproductos) --}}
            @can('accces_subproduct')
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-search mr-2" style="color:#0ea5e9;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Buscar Instrumental
                        </span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <livewire:search-instrumental />
                    </div>
                </div>

                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-cart3 text-info mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Instrumental del Paquete
                        </span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <livewire:instrumental-cart :cartInstance="'product'" :data="$product" />
                    </div>
                </div>
            @endcan

            {{-- Información Adicional --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #94a3b8;">
                    <i class="bi bi-chat-left-text text-secondary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información Adicional
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-lg-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Información Corta del Paquete
                            </label>
                            <input type="text" class="form-control form-control-sm" name="product_info"
                                maxlength="20" value="{{ $product->product_info }}" style="border-radius:8px;">
                            <small class="text-muted" style="font-size:.75rem;">Máximo 20 caracteres</small>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Nota / Observaciones
                            </label>
                            <textarea name="product_note" id="product_note" rows="3" class="form-control"
                                placeholder="Notas u observaciones adicionales (opcional)..."
                                style="border-radius:8px;resize:none;">{{ $product->product_note }}</textarea>
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
                    <span style="font-size:.9rem;">Actualizando paquete...</span>
                </div>
                <div></div>
                <button type="submit" id="submit-btn"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:11px 28px;font-weight:600;background:linear-gradient(135deg,#6366f1,#4f46e5);border:none;box-shadow:0 4px 12px rgba(99,102,241,0.35);gap:8px;">
                    <i class="bi bi-check-lg" id="submit-icon"></i>
                    <span id="submit-text">Actualizar Paquete</span>
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

            // Capturar subproductos del componente Livewire si existe
            @can('accces_subproduct')
            try {
                const componentElement = document.querySelector('[wire\\:id][wire\\:initial-data*="ProductCarttoSUB"]')
                    ?? document.querySelector('[wire\\:id]');

                if (componentElement) {
                    const component = window.Livewire.find(componentElement.getAttribute('wire:id'));
                    if (component) {
                        const subproducts = component.get('subproducts').filter(
                            item => item.subproduct_name?.trim() && item.subproduct_quantity > 0
                        );
                        document.getElementById('subproducts_json').value = JSON.stringify(subproducts);
                    }
                }
            } catch (e) {
                // Continúa el envío sin subproductos
            }
            @endcan

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
            document.getElementById('submit-text').textContent = 'Actualizar Paquete';
            document.getElementById('submit-icon').className = 'bi bi-check-lg';
            document.getElementById('loading-indicator').classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('product-form');
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
