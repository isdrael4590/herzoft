@php
    $Testvacuum_max_id = \Modules\Testbd\Entities\Testvacuum::max('id') + 1;
    $testvacuum_reference = 'Tvac_' . str_pad($Testvacuum_max_id, 5, '0', STR_PAD_LEFT);
@endphp

@extends('layouts.app')

@section('title', 'Crear Test Vacio')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testvacuums.index') }}">Test Vacio</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="product-form" action="{{ route('testvacuums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Crear Test Vacío <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="testvacuum_reference">Identificación del Test Vacio
                                            <span class="text-danger"></span></label>
                                        <input class="form-control" type="text" name="testvacuum_reference" required readonly
                                            value="{{ $testvacuum_reference }}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                <option value="{{ $machines->machine_name }}">
                                                    {{ $machines->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_equipo">Tipo de Equipo</label>
                                        <select class="form-control" name="tipo_equipo" id="tipo_equipo" required>
                                            <option value="" selected>Seleccionar Tipo</option>
                                            <option value="Autoclave">Autoclave</option>
                                            <option value="Peroxido">Peroxido</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ old('lote_machine') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validation_vacuum">Validación Ciclo Vacio</label>
                                        <select class="form-control" name="validation_vacuum" id="validation_vacuum" required>
                                            <option value="" selected>Seleccionar Resultado</option>
                                            <option value="Correcto">Correcto</option>
                                            <option value="Falla">Falla</option>
                                        </select>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ old('temp_ambiente') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="observation">Nota / Observaciones</label>
                                <textarea name="observation" id="observation" rows="4 " class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

    <!-- Create Category Modal -->
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
    </script>

    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
@endpush
