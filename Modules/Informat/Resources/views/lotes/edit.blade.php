@extends('layouts.app')

@section('title', 'Edit informat Category')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Información</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lote.index') }}">Lote Equipos </a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('lote.update', $lotes->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label class="font-weight-bold" for="lote_code">Lote del Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lote_code" required readonly
                                    value="{{ $lotes->lote_code }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="equipo_lote">Nombre del Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="equipo_lote" required readonly
                                    value="{{ $lotes->equipo_lote }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="tipo_lote">Tipo de Proceso <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="tipo_lote" required
                                    value="{{ $lotes->tipo_lote }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="status_lote">Estado de Equipo <span
                                        class="text-danger">*</span></label>
                                        <select class="form-control" name="status_lote" id="status_lote" required >
                                            <option {{ $lotes->status_lote == 'Correcto' ? 'selected' : '' }}
                                                value="Correcto">Correcto</option>
                                            <option {{ $lotes->status_lote == 'Falla' ? 'selected' : '' }}
                                                value="Falla">Falla</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="tipo_equipo">Tipo de Equipo
                                    <select class="form-control" name="tipo_equipo" id="tipo_equipo" required >
                                        <option {{ $lotes->tipo_equipo == 'Autoclave' ? 'selected' : '' }}
                                            value="Autoclave">Autoclave</option>
                                        <option {{ $lotes->tipo_equipo == 'Peroxido' ? 'selected' : '' }}
                                            value="Peroxido">Peroxido</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar <i
                                        class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
