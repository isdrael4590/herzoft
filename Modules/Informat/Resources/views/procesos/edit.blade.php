@extends('layouts.app')

@section('title', 'Editar Proceso')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proceso.index') }}">Proceso</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('proceso.update', $proceso->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('utils.alerts')
                                    <div class="form-group">
                                        <button class="btn btn-primary">Actualizar Proceso <i class="bi bi-check"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="proceso_code">Proceso
                                                            Código <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="proceso_code" required
                                                            value="{{ $proceso->proceso_code }}
                                                    ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="proceso_name">Nombre del Proceso.
                                                            <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="proceso_name" required
                                                            value="{{ $proceso->proceso_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <label for="proceso_type">Tipo de proceso<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                      
                                                        <select class="form-control" name="proceso_type" id="proceso_type" required>
                                                            <option value=""  disabled>Selección la temperatura de uso
                                                            </option>
                                                            <option {{ $proceso->proceso_type == 'ALTA TEMPERATURA' ? 'selected' : '' }} value="ALTA TEMPERATURA">ALTA TEMPERATURA</option>
                                                            <option {{ $proceso->proceso_type == 'BAJA TEMPERATURA' ? 'selected' : '' }} value="BAJA TEMPERATURA">BAJA TEMPERATURA</option>
                                                        </select>

                                                    </div>
                                                </div>
                
                                                <div class="col-lg-6">
                                                    <label for="proceso_temp">Temperatura de proceso<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select class="form-control" name="proceso_temp" id="proceso_temp" required>
                                                            <option value="" selected disabled>Selección la temperatura de Proceso
                                                            </option>
                                                            <option {{ $proceso->proceso_temp == '134' ? 'selected' : '' }} value="134">134°C</option>
                                                            <option {{ $proceso->proceso_temp == '121' ? 'selected' : '' }} value="121">121°C</option>
                                                            <option {{ $proceso->proceso_temp == '52' ? 'selected' : '' }} value="52">52°C</option>
                                                    
                                                        </select>
                                                    </div>
                                                </div>
                
                                            </div>
                                            
                                      

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@push('page_scripts')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                url: "{{ route('filepond.upload') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });
    </script>
@endpush
