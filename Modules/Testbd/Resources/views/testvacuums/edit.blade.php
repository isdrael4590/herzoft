@extends('layouts.app')

@section('title', 'Editar Test Vacio')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testvacuums.index') }}">Test Vacio</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form id="testvacuum-form" action="{{ route('testvacuums.update', $testvacuum->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Actualizar Test Vacio <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label class="font-weight-bold" for="testvacuum_reference">Test Vacio- Código <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="testvacuum_reference" required readonly
                                    value="{{ $testvacuum->testvacuum_reference }}">
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name" required>
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                <option {{ $machines->machine_name == $testvacuum->machine_name ? 'selected' : '' }}value="{{ $machines->machine_name }}">
                                                    {{ $machines->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_equipo">Tipo de Equipo</label>
                                        <select class="form-control" name="tipo_equipo" id="tipo_equipo" required>
                                            <option {{ $testvacuum->tipo_equipo == 'Autoclave' ? 'selected' : '' }} value="Autoclave">
                                                Autoclave</option>
                                                <option {{ $testvacuum->tipo_equipo == 'Peroxido' ? 'selected' : '' }} value="Peroxido">
                                                    Autoclave</option>
                                         
                                        </select>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ $testvacuum->lote_machine }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validation_vacuum">Validación Ciclo vacio</label>
                                        <select class="form-control" name="validation_vacuum" id="validation_vacuum" required>
                                            
                                            <option {{ $testvacuum->validation_vacuum == 'Correcto' ? 'selected' : '' }} value="Correcto">
                                                Correcto</option>
                                            <option {{ $testvacuum->validation_vacuum == 'Falla' ? 'selected' : '' }} value="Falla">
                                                Falla</option>
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
                                            value="{{ $testvacuum->temp_ambiente }}" step="0.1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ $testvacuum->operator }}" readonly required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="observation">Nota / Observaciones</label>
                                <textarea name="observation" id="observation" rows="4 " class="form-control">{{ $testvacuum->observation }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
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
                @if (isset($testvacuum) && $testvacuum->getMedia('images'))
                    var files = {!! json_encode($testvacuum->getMedia('images')) !!};
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
