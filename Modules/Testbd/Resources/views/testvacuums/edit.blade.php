@extends('layouts.app')

@section('title', 'Editar Test Vacío')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testvacuums.index') }}">Test Vacío</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="testvacuum-form" action="{{ route('testvacuums.update', $testvacuum->id) }}" method="POST"
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
                        <h4 class="mb-0 font-weight-bold text-dark">Editar Test Vacío</h4>
                        <small class="text-muted">Referencia: <strong>{{ $testvacuum->testvacuum_reference }}</strong></small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="{{ route('testvacuums.index') }}"
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
                                <input class="form-control" type="text" name="testvacuum_reference" readonly
                                    value="{{ $testvacuum->testvacuum_reference }}"
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hdd-stack text-success mr-1"></i>
                                    Nombre del Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="machine_name" name="machine_name" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (\Modules\Informat\Entities\Machine::all() as $machine)
                                        <option value="{{ $machine->machine_name }}"
                                            {{ $machine->machine_name == $testvacuum->machine_name ? 'selected' : '' }}>
                                            {{ $machine->machine_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-diagram-3 text-success mr-1"></i>
                                    Tipo de Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="tipo_equipo" id="tipo_equipo" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="Autoclave" {{ $testvacuum->tipo_equipo == 'Autoclave' ? 'selected' : '' }}>Autoclave</option>
                                    <option value="Peroxido" {{ $testvacuum->tipo_equipo == 'Peroxido' ? 'selected' : '' }}>Peróxido</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-archive text-success mr-1"></i>
                                    Lote del Equipo <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('lote_machine') is-invalid @enderror"
                                    name="lote_machine" required
                                    value="{{ old('lote_machine', $testvacuum->lote_machine) }}"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                @error('lote_machine')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-patch-check text-warning mr-1"></i>
                                    Resultado del Ciclo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="validation_vacuum" id="validation_vacuum" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="Correcto" {{ $testvacuum->validation_vacuum == 'Correcto' ? 'selected' : '' }}>Correcto</option>
                                    <option value="Falla" {{ $testvacuum->validation_vacuum == 'Falla' ? 'selected' : '' }}>Falla</option>
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
                                        value="{{ old('temp_ambiente', $testvacuum->temp_ambiente) }}"
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
                                    value="{{ $testvacuum->operator }}" readonly
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
                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;">{{ old('observation', $testvacuum->observation) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="{{ route('testvacuums.index') }}"
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
