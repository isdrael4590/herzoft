@extends('layouts.app')

@section('title', 'Editar Test Bowie & Dick')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testbds.index') }}">Test BD</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="testbd-form" action="{{ route('testbds.update', $testbd->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            {{-- Page Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#3b82f6,#2563eb);">
                        <i class="bi bi-pencil-square text-white" style="font-size:1.4rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Editar Test Bowie & Dick</h4>
                        <small class="text-muted">Referencia: <strong>{{ $testbd->testbd_reference }}</strong></small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="{{ route('testbds.index') }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-primary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(59,130,246,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Actualizar Test
                    </button>
                </div>
            </div>

            @include('utils.alerts')

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
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-primary mr-1"></i>
                                    Referencia del Test
                                </label>
                                <input class="form-control" type="text" name="testbd_reference" readonly
                                    value="{{ $testbd->testbd_reference }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;font-weight:600;color:#374151;">
                            </div>
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
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hdd-stack text-success mr-1"></i>
                                    Nombre del Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="machine_name" name="machine_name" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (\Modules\Informat\Entities\Machine::all() as $machine)
                                        <option value="{{ $machine->machine_name }}"
                                            {{ $machine->machine_name == $testbd->machine_name ? 'selected' : '' }}>
                                            {{ $machine->machine_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-archive text-success mr-1"></i>
                                    Lote del Equipo <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('lote_machine') is-invalid @enderror"
                                    name="lote_machine" required value="{{ old('lote_machine', $testbd->lote_machine) }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('lote_machine')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-success mr-1"></i>
                                    Temperatura del Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="temp_machine" name="temp_machine" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="134" {{ $testbd->temp_machine == 134 ? 'selected' : '' }}>134 °C</option>
                                    <option value="121" {{ $testbd->temp_machine == 121 ? 'selected' : '' }}>121 °C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Insumo BD y Validación --}}
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f59e0b;">
                    <i class="bi bi-clipboard2-check text-warning mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Insumo BD y Validación del Ciclo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-box-seam text-warning mr-1"></i>
                                    Lote del Insumo BD <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="lote_bd" name="lote_bd" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" disabled>-- Seleccionar lote --</option>
                                    @foreach (\Modules\Informat\Entities\Informat::all() as $informat)
                                        @if ($informat->insumo_type == 'TEST BOWIE & DICK' && $informat->insumo_status == 'Activo')
                                            <option value="{{ $informat->insumo_lot }}"
                                                {{ $testbd->lote_bd == $informat->insumo_lot ? 'selected' : '' }}>
                                                {{ $informat->insumo_lot }}
                                            </option>
                                        @endif
                                    @endforeach
                                    {{-- Mostrar el lote actual si ya no está activo --}}
                                    @if (!collect(\Modules\Informat\Entities\Informat::where('insumo_type', 'TEST BOWIE & DICK')->where('insumo_status', 'Activo')->pluck('insumo_lot'))->contains($testbd->lote_bd))
                                        <option value="{{ $testbd->lote_bd }}" selected>
                                            {{ $testbd->lote_bd }} (inactivo)
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-patch-check text-warning mr-1"></i>
                                    Validación del Ciclo BD <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="validation_bd" id="validation_bd" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="Correcto" {{ $testbd->validation_bd == 'Correcto' ? 'selected' : '' }}>
                                        Correcto
                                    </option>
                                    <option value="Falla" {{ $testbd->validation_bd == 'Falla' ? 'selected' : '' }}>
                                        Falla
                                    </option>
                                </select>
                            </div>
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
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Temperatura Ambiente <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('temp_ambiente') is-invalid @enderror"
                                        name="temp_ambiente" required step="0.1"
                                        value="{{ old('temp_ambiente', $testbd->temp_ambiente) }}"
                                        style="border-radius:8px 0 0 8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="border-radius:0 8px 8px 0;background:#f1f5f9;border-color:#e2e8f0;font-weight:600;">°C</span>
                                    </div>
                                    @error('temp_ambiente')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Operador
                                </label>
                                <input class="form-control" type="text" name="operator"
                                    value="{{ $testbd->operator }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;font-weight:600;color:#374151;">
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
                        <textarea name="observation" id="observation" rows="4" class="form-control"
                            placeholder="Ingrese observaciones adicionales sobre este test..."
                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;">{{ old('observation', $testbd->observation) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="{{ route('testbds.index') }}"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-primary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(59,130,246,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Actualizar Test
                </button>
            </div>

        </form>
    </div>
@endsection
