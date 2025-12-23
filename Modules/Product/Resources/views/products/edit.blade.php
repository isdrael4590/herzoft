@extends('layouts.app')
@section('title', 'Edit Product')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Producto: {{ $product->product_name }}</h4>
                    </div>

                    <form id="productForm" action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            {{-- Campos del producto principal --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Producto <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="product_name" id="product_name"
                                            class="form-control @error('product_name') is-invalid @enderror"
                                            value="{{ old('product_name', $product->product_name) }}" required>
                                        @error('product_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Código del Producto <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="product_code" id="product_code"
                                            class="form-control @error('product_code') is-invalid @enderror"
                                            value="{{ old('product_code', $product->product_code) }}" required>
                                        @error('product_code')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Categoría / Especialidad <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            @foreach (\Modules\Product\Entities\Category::all() as $category)
                                                <option {{ $category->id == $product->category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barcode_symbology">SimbologÍa BARCODE <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="product_barcode_symbology" id="barcode_symbology"
                                            required>
                                            <option {{ $product->product_barcode_symbology == 'C128' ? 'selected' : '' }}
                                                value="C128">Code 128</option>
                                            <option {{ $product->product_barcode_symbology == 'C39' ? 'selected' : '' }}
                                                value="C39">Code 39</option>
                                            <option {{ $product->product_barcode_symbology == 'UPCA' ? 'selected' : '' }}
                                                value="UPCA">UPC-A</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Area <span class="text-danger">*</span></label>
                                        <select class="form-control" id="area" name="area" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option {{ $product->area == $area->area_name ? 'selected' : '' }}
                                                    value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_type_process">Paquete procesado en:<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="product_type_process" id="product_type_process"
                                            required>
                                            <option value="" disabled>Seleccion de Temp. Trabajo</option>
                                            <option
                                                {{ $product->product_type_process == 'Alta Temperatura' ? 'selected' : '' }}
                                                value="Alta Temperatura">Alta Temperatura</option>
                                            <option
                                                {{ $product->product_type_process == 'Baja Temperatura' ? 'selected' : '' }}
                                                value="Baja Temperatura">Baja Temperatura</option>
                                            <option {{ $product->product_type_process == 'N/A' ? 'selected' : '' }}
                                                value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- Más campos del producto... --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_quantity">Cantidad</label>
                                        <input type="number" name="product_quantity" id="product_quantity"
                                            class="form-control"
                                            value="{{ old('product_quantity', $product->product_quantity) }}"
                                            min="0">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_price">Precio</label>
                                        <input type="number" name="product_price" id="product_price" class="form-control"
                                            value="{{ old('product_price', $product->product_price) }}" step="0.01"
                                            min="0">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_unit">Unidad</label>
                                        <select class="form-control" name="product_unit" id="product_unit" required>
                                            <option value="" selected>Seleccionar Unidad</option>
                                            @foreach (\Modules\Informat\Entities\Unit::all() as $unit)
                                                <option {{ $product->product_unit == $unit->short_name ? 'selected' : '' }}
                                                    value="{{ $unit->short_name }}">
                                                    {{ $unit->name . ' | ' . $unit->short_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_patient">Paciente (Solo casa comercial):<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_patient"
                                            value="{{ $product->product_patient }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_info"> Información corta del Paquete:<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_info" maxlength="20"
                                            value="{{ $product->product_info }}">
                                    </div>
                                </div>
                            </div>

                            @can('accces_subproduct')
                                <div class="row">
                                    <div class="col-12">
                                        <livewire:search-instrumental />
                                    </div>
                                </div>
                                {{-- Componente Livewire con datos existentes --}}
                                <livewire:instrumental-cart :cartInstance="'product'" :data="$product">
                                </livewire:instrumental-cart>
                            @endcan
                            <div class="form-group">
                                <label for="product_note">Note</label>
                                <textarea name="product_note" id="product_note" rows="4 " class="form-control">{{ $product->product_note }}</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-save"></i> Actualizar Producto
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('product-form');
                const submitBtn = document.getElementById('submit-btn');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('🔵 Form submit interceptado');

                    // Buscar el componente por su nombre
                    const componentElement = document.querySelector(
                        '[wire\\:id][wire\\:initial-data*="ProductCarttoSUB"]');

                    if (!componentElement) {
                        console.warn('⚠️ No se encontró componente Livewire, buscando alternativa...');

                        // Intento alternativo: buscar cualquier componente Livewire
                        const anyLivewireElement = document.querySelector('[wire\\:id]');

                        if (anyLivewireElement) {
                            const componentId = anyLivewireElement.getAttribute('wire:id');
                            console.log('🔍 Intentando con component ID:', componentId);
                            captureAndSubmit(componentId);
                        } else {
                            console.error('❌ No hay componentes Livewire en la página');
                            form.submit();
                        }
                        return;
                    }

                    const componentId = componentElement.getAttribute('wire:id');
                    console.log('✅ Component ID encontrado:', componentId);
                    captureAndSubmit(componentId);
                });

                function captureAndSubmit(componentId) {
                    try {
                        const component = window.Livewire.find(componentId);

                        if (!component) {
                            throw new Error('Componente no encontrado en Livewire.find()');
                        }

                        console.log('🟢 Componente Livewire encontrado');

                        const subproducts = component.get('subproducts');
                        console.log('📦 Subproductos obtenidos:', subproducts);

                        const validSubproducts = subproducts.filter(item => {
                            return item.subproduct_name &&
                                item.subproduct_name.trim() !== '' &&
                                item.subproduct_quantity > 0;
                        });

                        console.log('✅ Subproductos válidos:', validSubproducts);

                        document.getElementById('subproducts_json').value = JSON.stringify(validSubproducts);
                        console.log('💾 JSON guardado:', document.getElementById('subproducts_json').value);

                        form.submit();
                    } catch (error) {
                        console.error('❌ Error al capturar subproductos:', error);
                        console.log('⚠️ Enviando formulario sin subproductos...');
                        form.submit();
                    }
                }
            });
        </script>
    @endpush
@endsection
