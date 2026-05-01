@php
    $Institute_max_id = \Modules\Informat\Entities\Institute::max('id') + 1;
    $institute_code = "Inst_" . str_pad($Institute_max_id, 2, '0', STR_PAD_LEFT)
@endphp
@extends('layouts.app')

@section('title', 'Nueva Institución')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('institute.index') }}">Instituciones</a></li>
        <li class="breadcrumb-item active">Nueva</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('institute.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Page Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="bi bi-plus-circle text-white" style="font-size:1.4rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Nueva Institución</h4>
                        <small class="text-muted">Complete los campos para registrar una institución</small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="{{ route('institute.index') }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-success d-flex align-items-center"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Crear Institución
                    </button>
                </div>
            </div>

            @include('utils.alerts')

            <div class="row">
                <div class="col-lg-8">

                    {{-- Identificador --}}
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #4f46e5;">
                            <i class="bi bi-hash mr-2" style="color:#4f46e5;"></i>
                            <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Identificador (Generado automáticamente)
                            </span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                            <i class="bi bi-upc mr-1" style="color:#4f46e5;"></i>
                                            Código de Institución
                                        </label>
                                        <input class="form-control" type="text" name="institute_code" required
                                            value="{{ $institute_code }}"
                                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Información General --}}
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                            <i class="bi bi-hospital text-primary mr-2"></i>
                            <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Información de la Institución
                            </span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                            <i class="bi bi-building text-primary mr-1"></i>
                                            Nombre de la Institución <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('institute_name') is-invalid @enderror"
                                            type="text" name="institute_name" required
                                            placeholder="Ej: Hospital Central"
                                            value="{{ old('institute_name') }}"
                                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                        @error('institute_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                            <i class="bi bi-diagram-3 text-primary mr-1"></i>
                                            Área del Hospital <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('institute_area') is-invalid @enderror"
                                            type="text" name="institute_area" required
                                            placeholder="Ej: Central de Esterilización"
                                            value="{{ old('institute_area') }}"
                                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                        @error('institute_area')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Ubicación --}}
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f59e0b;">
                            <i class="bi bi-geo-alt text-warning mr-2"></i>
                            <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Ubicación
                            </span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                            <i class="bi bi-signpost text-warning mr-1"></i>
                                            Dirección <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('institute_address') is-invalid @enderror"
                                            type="text" name="institute_address" required
                                            placeholder="Ej: Av. Principal 123"
                                            value="{{ old('institute_address') }}"
                                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                        @error('institute_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                            <i class="bi bi-building text-warning mr-1"></i>
                                            Ciudad <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('institute_city') is-invalid @enderror"
                                            type="text" name="institute_city" required
                                            placeholder="Ej: Santiago"
                                            value="{{ old('institute_city') }}"
                                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                        @error('institute_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                            <i class="bi bi-globe text-warning mr-1"></i>
                                            País <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('institute_country') is-invalid @enderror"
                                            type="text" name="institute_country" required
                                            placeholder="Ej: Chile"
                                            value="{{ old('institute_country') }}"
                                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                        @error('institute_country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Panel lateral: Logo --}}
                <div class="col-lg-4">
                    <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);position:sticky;top:80px;">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #64748b;">
                            <i class="bi bi-image text-secondary mr-2"></i>
                            <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Logo
                            </span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <label class="text-dark font-weight-semibold d-block mb-2" style="font-size:.875rem;">
                                <i class="bi bi-cloud-arrow-up text-secondary mr-1"></i>
                                Logo de la Institución
                                <i class="bi bi-question-circle-fill text-info ml-1"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Máx. 3 archivos, 1MB c/u, tamaño 400x400px"></i>
                            </label>
                            <div class="dropzone d-flex flex-wrap align-items-center justify-content-center"
                                id="document-dropzone"
                                style="border:2px dashed #cbd5e1;border-radius:10px;min-height:160px;background:#f8fafc;cursor:pointer;">
                                <div class="dz-message text-center text-muted" data-dz-message>
                                    <i class="bi bi-cloud-arrow-up" style="font-size:2.5rem;color:#94a3b8;"></i>
                                    <p class="mt-2 mb-0" style="font-size:.8rem;">Arrastra o haz clic para subir</p>
                                    <small style="font-size:.73rem;">PNG, JPG hasta 1MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="{{ route('institute.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-success d-flex align-items-center"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Crear Institución
                </button>
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
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function (file) {
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
            init: function () {
                @if(isset($institute) && $institute->getMedia('institutes'))
                var files = {!! json_encode($institute->getMedia('institutes')) !!};
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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
@endpush
