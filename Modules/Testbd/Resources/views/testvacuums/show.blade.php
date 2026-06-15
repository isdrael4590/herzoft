@extends('layouts.app')

@section('title', 'Detalle Test Vacío')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testvacuums.index') }}">Test Vacío</a></li>
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
                    <h4 class="mb-0 font-weight-bold text-dark">{{ $testvacuum->testvacuum_reference }}</h4>
                    <small class="text-muted">
                        Equipo: <strong class="text-dark">{{ $testvacuum->machine_name }}</strong>
                        &nbsp;&bull;&nbsp;
                        @if ($testvacuum->validation_vacuum === 'Correcto')
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Correcto
                            </span>
                        @else
                            <span class="badge badge-danger" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-x-circle mr-1"></i> Falla
                            </span>
                        @endif
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="{{ route('testvacuums.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                @can('print_testbds')
                    <a target="_blank" href="{{ route('testvacuums.pdf', $testvacuum->id) }}"
                        class="btn btn-outline-dark d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-printer mr-2"></i> Imprimir
                    </a>
                @endcan
                @can('edit_testvacuums')
                    <a href="{{ route('testvacuums.edit', $testvacuum->id) }}"
                        class="btn btn-warning d-flex align-items-center text-dark"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                        <i class="bi bi-pencil-square mr-2"></i> Editar
                    </a>
                @endcan
            </div>
        </div>

        <div class="row">

            {{-- Columna principal --}}
            <div class="col-lg-8">

                {{-- Identificación --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                        <i class="bi bi-fingerprint text-primary mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Identificación
                        </span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <div class="d-flex align-items-start">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:38px;height:38px;background:rgba(59,130,246,0.1);">
                                <i class="bi bi-hash text-primary"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Referencia del Test</p>
                                <p class="mb-0 font-weight-bold text-dark" style="font-size:1.1rem;">{{ $testvacuum->testvacuum_reference }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Datos del Equipo --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                        <i class="bi bi-cpu text-success mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Datos del Equipo
                        </span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(16,185,129,0.1);">
                                        <i class="bi bi-hdd-stack text-success"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Nombre del Equipo</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $testvacuum->machine_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(16,185,129,0.1);">
                                        <i class="bi bi-diagram-3 text-success"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Tipo de Equipo</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $testvacuum->tipo_equipo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(16,185,129,0.1);">
                                        <i class="bi bi-archive text-success"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Lote del Equipo</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $testvacuum->lote_machine }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Validación del Ciclo --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f59e0b;">
                        <i class="bi bi-clipboard2-check text-warning mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Validación del Ciclo Vacío
                        </span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <div class="d-flex align-items-start">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:38px;height:38px;background:rgba(245,158,11,0.1);">
                                <i class="bi bi-patch-check text-warning"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Resultado del Ciclo</p>
                                @if ($testvacuum->validation_vacuum === 'Correcto')
                                    <span class="badge badge-success mt-1" style="font-size:.85rem;padding:5px 12px;border-radius:20px;">
                                        <i class="bi bi-check-circle mr-1"></i> Correcto
                                    </span>
                                @else
                                    <span class="badge badge-danger mt-1" style="font-size:.85rem;padding:5px 12px;border-radius:20px;">
                                        <i class="bi bi-x-circle mr-1"></i> Falla
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Condiciones Ambientales y Operador --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #8b5cf6;">
                        <i class="bi bi-cloud-sun mr-2" style="color:#8b5cf6;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Condiciones Ambientales y Operador
                        </span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(139,92,246,0.1);">
                                        <i class="bi bi-thermometer" style="color:#8b5cf6;"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Temperatura Ambiente</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $testvacuum->temp_ambiente }} °C</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:38px;height:38px;background:rgba(139,92,246,0.1);">
                                        <i class="bi bi-person-badge" style="color:#8b5cf6;"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;">Operador</p>
                                        <p class="mb-0 font-weight-semibold text-dark">{{ $testvacuum->operator }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Observaciones --}}
                @if ($testvacuum->observation)
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #64748b;">
                            <i class="bi bi-chat-text text-secondary mr-2"></i>
                            <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Observaciones
                            </span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <p class="mb-0 text-dark" style="line-height:1.7;">{{ $testvacuum->observation }}</p>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Panel lateral --}}
            <div class="col-lg-4">

                {{-- Resultado del ciclo --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #6366f1;">
                        <i class="bi bi-bar-chart mr-2" style="color:#6366f1;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                            Resultado del Ciclo
                        </span>
                    </div>
                    <div class="card-body text-center" style="padding:28px 24px;">
                        @if ($testvacuum->validation_vacuum === 'Correcto')
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width:80px;height:80px;background:linear-gradient(135deg,#10b981,#059669);">
                                <i class="bi bi-check-lg text-white" style="font-size:2rem;"></i>
                            </div>
                            <p class="font-weight-bold text-success mb-1" style="font-size:1.2rem;">Correcto</p>
                        @else
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width:80px;height:80px;background:linear-gradient(135deg,#ef4444,#dc2626);">
                                <i class="bi bi-x-lg text-white" style="font-size:2rem;"></i>
                            </div>
                            <p class="font-weight-bold text-danger mb-1" style="font-size:1.2rem;">Falla</p>
                        @endif
                        <p class="text-muted mb-0" style="font-size:.8rem;text-transform:uppercase;letter-spacing:.5px;">Validación Ciclo Vacío</p>

                        <hr class="my-3">

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted" style="font-size:.85rem;">Tipo de equipo:</span>
                            <span class="font-weight-semibold text-dark">{{ $testvacuum->tipo_equipo }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted" style="font-size:.85rem;">Temperatura ambiente:</span>
                            <span class="font-weight-semibold text-dark">{{ $testvacuum->temp_ambiente }} °C</span>
                        </div>
                    </div>
                </div>

                {{-- Acciones --}}
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
                            @can('print_testbds')
                                <a target="_blank" href="{{ route('testvacuums.pdf', $testvacuum->id) }}"
                                    class="btn btn-outline-dark btn-block d-flex align-items-center justify-content-center"
                                    style="border-radius:8px;padding:10px;font-weight:600;">
                                    <i class="bi bi-printer mr-2"></i> Imprimir PDF
                                </a>
                            @endcan
                            @can('edit_testvacuums')
                                <a href="{{ route('testvacuums.edit', $testvacuum->id) }}"
                                    class="btn btn-warning btn-block d-flex align-items-center justify-content-center text-dark"
                                    style="border-radius:8px;padding:10px;font-weight:600;">
                                    <i class="bi bi-pencil-square mr-2"></i> Editar Test
                                </a>
                            @endcan
                            <a href="{{ route('testvacuums.index') }}"
                                class="btn btn-outline-secondary btn-block d-flex align-items-center justify-content-center"
                                style="border-radius:8px;padding:10px;font-weight:600;">
                                <i class="bi bi-list-ul mr-2"></i> Ver todos los Tests
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
