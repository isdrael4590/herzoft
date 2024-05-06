@php
    $Institute_max_id = \Modules\Informat\Entities\Institute::max('id') + 1;
    $institute_code = "Inst_" . str_pad($Institute_max_id, 2, '0', STR_PAD_LEFT)
@endphp
@extends('layouts.app')

@section('title', 'Crear Institucion')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('institute.index') }}">Información</a></li>
        <li class="breadcrumb-item active">Información de la institución</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('institute.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Crear Institución <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="institute_code">Institución Código <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="institute_code" required value="{{ $institute_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="institute_name">Nombre de la Institución <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="institute_name" required >
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="institute_address">Dirección Institución <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="institute_address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="institute_area">Área del Hospital<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="institute_area" required >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="institute_city">Ciudad <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="institute_city" required >
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="institute_country">País<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="institute_country" required >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">Logo de la Institución. <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                <div class="dropzone d-flex flex-wrap align-items-center justify-content-center" id="document-dropzone">
                                    <div class="dz-message" data-dz-message>
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
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


