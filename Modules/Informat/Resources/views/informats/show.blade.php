@extends('layouts.app')

@section('title', 'Detalle del Insumo')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Insumos</a></li>
        <li class="breadcrumb-item active">Detalle</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#6366f1,#4338ca);">
                    <i class="bi bi-eye text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">{{ $informat->insumo_name }}</h4>
                    <small class="text-muted">
                        Código: <strong class="text-dark">{{ $informat->insumo_code }}</strong>
                        &nbsp;&bull;&nbsp;
                        @if ($informat->insumo_status === 'Activo')
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Activo
                            </span>
                        @else
                            <span class="badge badge-danger" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-x-circle mr-1"></i> Desactivado
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="{{ route('informats.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                @can('edit_informats')
                    <a href="{{ route('informats.edit', $informat->id) }}"
                        class="btn btn-warning d-flex align-items-center text-dark"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                        <i class="bi bi-pencil-square mr-2"></i> Editar
                    </a>
                @endcan
            </div>
        </div>

        <div class="row">

            {{-- Información Principal --}}
            <div class="col-lg-8">

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
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(59,130,246,0.1);">
                                        <i class="bi bi-tag text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Nombre</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $informat->insumo_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(59,130,246,0.1);">
                                        <i class="bi bi-upc text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Código</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $informat->insumo_code }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(59,130,246,0.1);">
                                        <i class="bi bi-layers text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Tipo de Insumo</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $informat->insumo_type }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(59,130,246,0.1);">
                                        <i class="bi bi-thermometer-half text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Temperatura de Uso</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $informat->insumo_temp }}</p>
                                    </div>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(245,158,11,0.1);">
                                        <i class="bi bi-archive text-warning"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Lote</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $informat->insumo_lot }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(245,158,11,0.1);">
                                        <i class="bi bi-calendar-x text-warning"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Fecha de Expiración</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $informat->insumo_exp }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Observaciones --}}
                @if ($informat->insumo_note)
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #64748b;">
                            <i class="bi bi-chat-text text-secondary mr-2"></i>
                            <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Observaciones
                            </span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <p class="mb-0 text-dark" style="line-height:1.7;">{{ $informat->insumo_note }}</p>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Panel lateral --}}
            <div class="col-lg-4">

                {{-- Stock y Estado --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #8b5cf6;">
                        <i class="bi bi-bar-chart mr-2" style="color:#8b5cf6;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Stock y Estado
                        </span>
                    </div>
                    <div class="card-body text-center" style="padding:28px 24px;">

                        {{-- Cantidad --}}
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width:80px;height:80px;background:linear-gradient(135deg,#8b5cf6,#6d28d9);">
                            <span class="text-white font-weight-bold" style="font-size:1.6rem;">
                                {{ $informat->insumo_quantity }}
                            </span>
                        </div>
                        <p class="text-muted mb-1" style="font-size:.8rem;text-transform:uppercase;letter-spacing:.5px;">Cantidad en Stock</p>
                        <p class="font-weight-semibold text-dark mb-3">{{ $informat->insumo_unit }}</p>

                        <hr class="my-3">

                        {{-- Estado --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted" style="font-size:.85rem;">Estado:</span>
                            @if ($informat->insumo_status === 'Activo')
                                <span class="badge badge-success" style="font-size:.8rem;padding:6px 14px;border-radius:20px;">
                                    <i class="bi bi-check-circle mr-1"></i> Activo
                                </span>
                            @else
                                <span class="badge badge-danger" style="font-size:.8rem;padding:6px 14px;border-radius:20px;">
                                    <i class="bi bi-x-circle mr-1"></i> Desactivado
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Acciones rápidas --}}
                <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                        <i class="bi bi-lightning text-success mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Acciones
                        </span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <div class="d-flex flex-column" style="gap:10px;">
                            @can('edit_informats')
                                <a href="{{ route('informats.edit', $informat->id) }}"
                                    class="btn btn-warning btn-block d-flex align-items-center justify-content-center text-dark"
                                    style="border-radius:8px;padding:10px;font-weight:600;">
                                    <i class="bi bi-pencil-square mr-2"></i> Editar Insumo
                                </a>
                            @endcan
                            <a href="{{ route('informats.index') }}"
                                class="btn btn-outline-secondary btn-block d-flex align-items-center justify-content-center"
                                style="border-radius:8px;padding:10px;font-weight:600;">
                                <i class="bi bi-list-ul mr-2"></i> Ver todos los Insumos
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
