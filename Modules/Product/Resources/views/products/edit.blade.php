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
    <div class="container-fluid mb-4">
        <form id="product-form" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Actualizar Paquete <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Paquete <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required
                                            value="{{ $product->product_name }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="product_code">Código <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required readonly
                                            value="{{ $product->product_code }}">
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
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_quantity">Cantidad <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="product_quantity" required
                                            value="{{ $product->product_quantity }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_patient">Paciente (Solo casa comercial):<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_patient"
                                            value="{{ $product->product_patient }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Precio<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="product_price" required
                                            value="{{ $product->product_price }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_unit">Unidad <i class="bi bi-question-circle-fill text-info"
                                                data-toggle="tooltip" data-placement="top"
                                                title="This short text will be placed after Product Quantity."></i> <span
                                                class="text-danger">*</span></label>
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
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_info"> Información corta del Paquete:<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_info" maxlength="20"
                                            value="{{ $product->product_info }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_note">Note</label>
                                <textarea name="product_note" id="product_note" rows="4 " class="form-control">{{ $product->product_note }}</textarea>
                            </div>


                            @can('accces_subproduct')
                                <div class="form-group">
                                    <div>
                                        <h3>Detalles del Paquete</h3>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <livewire:search-producttoSUB />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <livewire:product-carttoSUB :cartInstance="'product'" :data="$product" />

                                </div>
                            @endcan
                        </div>
                    </div>
                </div>

                @can('add_image')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Imagen del paquete <i class="bi bi-question-circle-fill text-info"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                    <div class="dropzone d-flex flex-wrap align-items-center justify-content-center"
                                        id="document-dropzone">
                                        <div class="dz-message" data-dz-message>
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </form>
    </div>

    <!-- Create Category Modal -->
    @include('product::includes.category-modal')
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('dropzone.upload') }}',
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 3,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function(file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            },
            init: function() {
                @if (isset($product) && $product->getMedia('images'))
                    var files = {!! json_encode($product->getMedia('images')) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        this.options.thumbnail.call(this, file, file.original_url);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
                    }
                @endif
            }
        }
    </script>

    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
@endpush
