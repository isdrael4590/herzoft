@extends('layouts.app')

@section('title', 'Nuevo Insumo')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Insumos</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="informat-form" action="{{ route('informats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Page Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="bi bi-plus-circle text-white" style="font-size:1.4rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Nuevo Insumo</h4>
                        <small class="text-muted">Complete los campos para registrar un insumo</small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="{{ route('informats.index') }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-success d-flex align-items-center"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Registrar Insumo
                    </button>
                </div>
            </div>

            @include('utils.alerts')

            {{-- Información Básica --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                    <i class="bi bi-info-circle text-primary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Insumo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-tag text-primary mr-1"></i>
                                    Nombre del Insumo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('insumo_name') is-invalid @enderror"
                                    name="insumo_name" placeholder="Ej: Indicador Químico Clase 4"
                                    value="{{ old('insumo_name') }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('insumo_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-upc text-primary mr-1"></i>
                                    Código del Insumo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('insumo_code') is-invalid @enderror"
                                    name="insumo_code" placeholder="Ej: INS-001"
                                    value="{{ old('insumo_code') }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('insumo_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-layers text-primary mr-1"></i>
                                    Tipo de Insumo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('insumo_type') is-invalid @enderror"
                                    name="insumo_type" id="insumo_type" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" selected disabled>-- Seleccionar tipo --</option>
                                    <option value="INDICADORES QUIMICOS" {{ old('insumo_type') == 'INDICADORES QUIMICOS' ? 'selected' : '' }}>INDICADORES QUÍMICOS</option>
                                    <option value="INDICADORES BIOLOGICOS" {{ old('insumo_type') == 'INDICADORES BIOLOGICOS' ? 'selected' : '' }}>INDICADORES BIOLÓGICOS</option>
                                    <option value="ROLLOS TYVEK" {{ old('insumo_type') == 'ROLLOS TYVEK' ? 'selected' : '' }}>ROLLOS TYVEK</option>
                                    <option value="ROLLOS MIXTOS" {{ old('insumo_type') == 'ROLLOS MIXTOS' ? 'selected' : '' }}>ROLLOS MIXTOS</option>
                                    <option value="AGENTE ESTERILIZANTE" {{ old('insumo_type') == 'AGENTE ESTERILIZANTE' ? 'selected' : '' }}>AGENTE ESTERILIZANTE</option>
                                    <option value="TEST BOWIE & DICK" {{ old('insumo_type') == 'TEST BOWIE & DICK' ? 'selected' : '' }}>TEST BOWIE & DICK</option>
                                </select>
                                @error('insumo_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-primary mr-1"></i>
                                    Temperatura de Uso <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('insumo_temp') is-invalid @enderror"
                                    name="insumo_temp" id="insumo_temp" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" selected disabled>-- Seleccionar temperatura --</option>
                                    <option value="ALTA TEMPERATURA" {{ old('insumo_temp') == 'ALTA TEMPERATURA' ? 'selected' : '' }}>ALTA TEMPERATURA</option>
                                    <option value="BAJA TEMPERATURA" {{ old('insumo_temp') == 'BAJA TEMPERATURA' ? 'selected' : '' }}>BAJA TEMPERATURA</option>
                                </select>
                                @error('insumo_temp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lote y Vencimiento --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f59e0b;">
                    <i class="bi bi-calendar3 text-warning mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Lote y Vencimiento
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-archive text-warning mr-1"></i>
                                    Lote del Insumo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('insumo_lot') is-invalid @enderror"
                                    name="insumo_lot" placeholder="Ej: L-2024-001"
                                    value="{{ old('insumo_lot') }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('insumo_lot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-calendar-x text-warning mr-1"></i>
                                    Fecha de Expiración <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control @error('insumo_exp') is-invalid @enderror"
                                    name="insumo_exp" required
                                    value="{{ old('insumo_exp', now()->format('Y-m-d')) }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('insumo_exp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cantidad y Estado --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #8b5cf6;">
                    <i class="bi bi-bar-chart text-purple mr-2" style="color:#8b5cf6;"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Cantidad y Estado
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-123" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Cantidad <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('insumo_quantity') is-invalid @enderror"
                                    name="insumo_quantity" placeholder="0"
                                    value="{{ old('insumo_quantity') }}" min="1" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('insumo_quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-rulers" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Presentación <span class="text-danger">*</span>
                                    <i class="bi bi-question-circle-fill text-info ml-1"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Unidad de presentación del insumo"></i>
                                </label>
                                <select class="form-control @error('insumo_unit') is-invalid @enderror"
                                    name="insumo_unit" id="insumo_unit" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="">-- Seleccionar presentación --</option>
                                    @foreach (\Modules\Informat\Entities\Unit::all() as $unit)
                                        <option value="{{ $unit->short_name }}" {{ old('insumo_unit') == $unit->short_name ? 'selected' : '' }}>
                                            {{ $unit->name . ' | ' . $unit->short_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('insumo_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Estado del Insumo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control @error('insumo_status') is-invalid @enderror"
                                    name="insumo_status" id="insumo_status" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" selected disabled>-- Seleccionar estado --</option>
                                    <option value="Activo" {{ old('insumo_status') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Desactivado" {{ old('insumo_status') == 'Desactivado' ? 'selected' : '' }}>Desactivado</option>
                                </select>
                                @error('insumo_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Observaciones --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #64748b;">
                    <i class="bi bi-chat-text text-secondary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Observaciones
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-group mb-0">
                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                            <i class="bi bi-pencil-square text-secondary mr-1"></i>
                            Nota / Observaciones
                        </label>
                        <textarea name="insumo_note" id="insumo_note" rows="4" class="form-control"
                            placeholder="Ingrese observaciones adicionales sobre este insumo..."
                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;">{{ old('insumo_note') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="{{ route('informats.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-success d-flex align-items-center"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Registrar Insumo
                </button>
            </div>

        </form>
    </div>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
