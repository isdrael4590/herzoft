@extends('layouts.app')

@section('title', 'Create Product')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Crear Paquetes <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Paquete <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required
                                            value="{{ old('product_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Código <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required
                                            value="{{ old('product_code') }}" maxlength="8">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="category_id">Categoría / Especialidad <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="" selected disabled>Select Categoria</option>
                                            @foreach (\Modules\Product\Entities\Category::all() as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                                            <option value="" disabled>Selección Simbología</option>
                                            <option selected value="C128">Code 128</option>
                                            <option value="C39">Code 39</option>
                                            <option value="UPCA">UPC-A</option>
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
                                                <option value="{{ $area->area_name }}">
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
                                            <option selected value="Alta Temperatura">Alta Temperatura</option>
                                            <option value="Baja Temperatura">Baja Temperatura</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_quantity">Cantidad <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="product_quantity" required
                                            value="{{ old('product_quantity', 1) }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_patient">Paciente (Solo casa comercial):<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_patient"
                                            value="{{ old('product_patient') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Precio <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="product_price" required
                                            value="{{ old('product_price', 1) }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_unit">Unidad <i class="bi bi-question-circle-fill text-info"
                                                data-toggle="tooltip" data-placement="top"
                                                title="This short text will be placed after Product Quantity."></i> <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="product_unit" id="product_unit">
                                            <option value="" selected>Seleccionar Unidad</option>
                                            @foreach (\Modules\Informat\Entities\Unit::all() as $unit)
                                                <option value="{{ $unit->short_name }}">
                                                    {{ $unit->name . ' | ' . $unit->short_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @can('accces_subproduct')
                                <div class="row">
                                    <div class="col-12">
                                        <livewire:search-instrumental />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <livewire:instrumental-cart :cartInstance="'product'" >
                                    </div>
                                </div>
                            @endcan
                            <div class="form-group">
                                <label for="product_info"> Información corta del paquete</label>
                                <input type="text" name="product_info" id="product_info" rows="4 "
                                    class="form-control" maxlength="20"></input>
                            </div>

                            <div class="form-group">
                                <label for="product_note">Nota / Observaciones</label>
                                <textarea name="product_note" id="product_note" rows="4 " class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                @can('add_image')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Imagen del Paquete <i class="bi bi-question-circle-fill text-info"
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
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                $.ajax({
                    type: "POST",
                    url: "{{ route('dropzone.delete') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'file_name': `${name}`
                    },
                });
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



        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove()
        });
    </script>
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
@endpush
