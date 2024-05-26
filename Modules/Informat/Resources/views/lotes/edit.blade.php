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
                                <input class="form-control" type="text" name="equipo_lote" required
                                    value="{{ $lotes->equipo_lote }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="tipo_lote">Tipo de Lote <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="tipo_lote" required
                                    value="{{ $lotes->tipo_lote }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="status_lote">Estado de Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="status_lote" required
                                    value="{{ $lotes->status_lote }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="tipo_equipo">Tipo de Equipo
                                    <select class="form-control" name="tipo_equipo" id="tipo_equipo" required>
                                        <option {{ $lotes->tipo_equipo == 'Alta Temperatura' ? 'selected' : '' }}
                                            value="Alta Temperatura">Alta Temperatura</option>
                                        <option {{ $lotes->tipo_equipo == 'Baja Temperatura' ? 'selected' : '' }}
                                            value="Baja Temperatura">Baja Temperatura</option>
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
