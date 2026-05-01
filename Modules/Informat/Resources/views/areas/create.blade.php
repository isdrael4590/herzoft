@php
    $Area_max_id = \Modules\Informat\Entities\Area::max('id') + 1;
    $area_code = 'Area_' . str_pad($Area_max_id, 2, '0', STR_PAD_LEFT);
@endphp
@php
    $category_max_id = \Modules\Product\Entities\Category::max('id') + 1;
    $category_code = 'CA_' . str_pad($category_max_id, 2, '0', STR_PAD_LEFT);
@endphp
@extends('layouts.app')

@section('title', 'Nueva Área')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Áreas</a></li>
        <li class="breadcrumb-item active">Nueva</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Page Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="bi bi-plus-circle text-white" style="font-size:1.4rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Nueva Área</h4>
                        <small class="text-muted">Complete los campos para registrar un área</small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="{{ route('area.index') }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-success d-flex align-items-center"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Crear Área
                    </button>
                </div>
            </div>

            @include('utils.alerts')

            {{-- Códigos --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #06b6d4;">
                    <i class="bi bi-hash text-info mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Identificadores (Generados automáticamente)
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-upc text-info mr-1"></i>
                                    Código de Área
                                </label>
                                <input class="form-control" type="text" name="area_code" required readonly
                                    value="{{ $area_code }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-upc text-info mr-1"></i>
                                    Código de Categoría
                                </label>
                                <input class="form-control" type="text" name="category_code" required readonly
                                    value="{{ $category_code }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Información del Área --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                    <i class="bi bi-diagram-3 text-primary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Área
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-building text-primary mr-1"></i>
                                    Nombre del Área <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('area_name') is-invalid @enderror"
                                    type="text" name="area_name" required
                                    placeholder="Ej: Área de Esterilización"
                                    value="{{ old('area_name') }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('area_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-primary mr-1"></i>
                                    Jefe de Área <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('area_responsable') is-invalid @enderror"
                                    type="text" name="area_responsable" required
                                    placeholder="Nombre del responsable"
                                    value="{{ old('area_responsable') }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('area_responsable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-layers text-primary mr-1"></i>
                                    Piso del Área <span class="text-danger">*</span>
                                </label>
                                <input class="form-control @error('area_piso') is-invalid @enderror"
                                    type="text" name="area_piso" required
                                    placeholder="Ej: Piso 2"
                                    value="{{ old('area_piso') }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('area_piso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="{{ route('area.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-success d-flex align-items-center"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Crear Área
                </button>
            </div>

        </form>
    </div>
@endsection
