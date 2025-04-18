@extends('layouts.app')

@section('title', 'Editar Testbd')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testbds.index') }}">TestBd</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form id="testbd-form" action="{{ route('testbds.update', $testbd->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Actualizar TestBD <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label class="font-weight-bold" for="testbd_reference">TestbD- Código <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="testbd_reference" required readonly
                                    value="{{ $testbd->testbd_reference }}">
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name" required>
                                            @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                                <option {{ $machines->machine_name == $testbd->machine_name ? 'selected' : '' }}value="{{ $machines->machine_name }}">
                                                    {{ $machines->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="{{ $testbd->lote_machine }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_machine" required
                                            value="{{ $testbd->lote_machine }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo BD <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_bd" required
                                            value="{{ $testbd->lote_bd }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validation_bd">Validación Ciclo BD</label>
                                        <select class="form-control" name="validation_bd" id="validation_bd" required>
                                            
                                            <option {{ $testbd->validation_bd == 'Correcto' ? 'selected' : '' }} value="Correcto">
                                                Correcto</option>
                                            <option {{ $testbd->validation_bd == 'Falla' ? 'selected' : '' }} value="Falla">
                                                Falla</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $testbd->temp_ambiente }}" step="0.1">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ $testbd->operator }}" required readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="observation">Nota / Observaciones</label>
                                <textarea name="observation" id="observation" rows="4 " class="form-control">{{ $testbd->observation }}</textarea>
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
                @if (isset($testbd) && $testbd->getMedia('images'))
                    var files = {!! json_encode($testbd->getMedia('images')) !!};
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
