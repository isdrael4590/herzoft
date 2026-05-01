@extends('layouts.app')

@section('title', 'Editar Lote')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lote.index') }}">Lotes</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('lote.update', $lotes->id) }}" method="POST">
            @csrf
            @method('patch')

            {{-- Page Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);">
                        <i class="bi bi-pencil-square text-white" style="font-size:1.3rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Editar Lote</h4>
                        <small class="text-muted">
                            Lote: <strong class="text-dark">{{ $lotes->lote_code }}</strong>
                            &nbsp;&bull;&nbsp;
                            <span class="text-muted">{{ $lotes->equipo_lote }}</span>
                        </small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="{{ route('lote.index') }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-warning d-flex align-items-center text-dark"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Actualizar Lote
                    </button>
                </div>
            </div>

            @include('utils.alerts')

            {{-- Identificadores (solo lectura) --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f97316;">
                    <i class="bi bi-lock text-warning mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Datos del Lote (Solo lectura)
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-upc mr-1" style="color:#f97316;"></i>
                                    Código de Lote
                                </label>
                                <input class="form-control" type="text" name="lote_code" required readonly
                                    value="{{ $lotes->lote_code }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-gear mr-1" style="color:#f97316;"></i>
                                    Nombre del Equipo
                                </label>
                                <input class="form-control" type="text" name="equipo_lote" required readonly
                                    value="{{ $lotes->equipo_lote }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-arrow-repeat mr-1" style="color:#f97316;"></i>
                                    Tipo de Proceso
                                </label>
                                <input class="form-control" type="text" name="tipo_lote" required readonly
                                    value="{{ $lotes->tipo_lote }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Estado --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                    <i class="bi bi-toggle-on text-primary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Estado y Tipo de Equipo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-check-circle text-primary mr-1"></i>
                                    Estado del Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('status_lote') is-invalid @enderror"
                                    name="status_lote" id="status_lote" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="Correcto" {{ old('status_lote', $lotes->status_lote) == 'Correcto' ? 'selected' : '' }}>
                                        Correcto
                                    </option>
                                    <option value="Falla" {{ old('status_lote', $lotes->status_lote) == 'Falla' ? 'selected' : '' }}>
                                        Falla
                                    </option>
                                </select>
                                @error('status_lote')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-list-ul text-primary mr-1"></i>
                                    Tipo de Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('tipo_equipo') is-invalid @enderror"
                                    name="tipo_equipo" id="tipo_equipo" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="Autoclave" {{ old('tipo_equipo', $lotes->tipo_equipo) == 'Autoclave' ? 'selected' : '' }}>
                                        Autoclave
                                    </option>
                                    <option value="Peroxido" {{ old('tipo_equipo', $lotes->tipo_equipo) == 'Peroxido' ? 'selected' : '' }}>
                                        Esterilizador de Peróxido
                                    </option>
                                </select>
                                @error('tipo_equipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="{{ route('lote.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-warning d-flex align-items-center text-dark"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Actualizar Lote
                </button>
            </div>

        </form>
    </div>
@endsection
