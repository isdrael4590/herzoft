@php
    $Proceso_max_id = \Modules\Informat\Entities\Proceso::max('id') + 1;
    $Proceso_code = "Proceso_" . str_pad($Proceso_max_id, 2, '0', STR_PAD_LEFT)
@endphp
@extends('layouts.app')

@section('title', 'Crear Procesos')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proceso.index') }}">Información</a></li>
        <li class="breadcrumb-item active">Información de Procesos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('proceso.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Crear Tipo Proceso <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="proceso_code"> Código Proceso <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="proceso_code" required value="{{ $Proceso_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="proceso_name">Nombre del Proceso <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="proceso_name" required >
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <label for="proceso_type">Tipo de proceso<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="proceso_type" id="proceso_type" required>
                                            <option value="" selected disabled>Selección el tipo de Proceso
                                            </option>
                                            <option value="ALTA TEMPERATURA">ALTA TEMPERATURA</option>
                                            <option value="BAJA TEMPERATURA">BAJA TEMPERATURA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="proceso_temp">Temperatura de proceso<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="proceso_temp" id="proceso_temp" required>
                                            <option value="" selected disabled>Selección la temperatura de Proceso
                                            </option>
                                            <option value="134">134°C</option>
                                            <option value="121">121°C</option>
                                            <option value="52">52°C</option>
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
@endsection





