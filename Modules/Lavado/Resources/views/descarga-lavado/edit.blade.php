@extends('layouts.app')

@section('title', 'Editar Descarga de Lavado')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('descarga-lavado.index') }}">Descarga Lavado</a></li>
        <li class="breadcrumb-item active">Editar {{ $descargaLavado->reference }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-pencil-square text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark">Editar Descarga</h5>
                    <small class="text-muted">Referencia <strong>{{ $descargaLavado->reference }}</strong> — Lavado <strong>{{ $descargaLavado->lavado->reference }}</strong></small>
                </div>
            </div>
            <a href="{{ route('descarga-lavado.index') }}" class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        {{-- Ítems de la Descarga --}}
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-list-ul text-info mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Instrumental de la Descarga
                </span>
                <span class="badge badge-info ml-2">{{ $descargaLavado->descargaLavadoDetalles->count() }} ítem(s)</span>
            </div>
            <div class="card-body" style="padding:20px 24px;">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Código</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Nombre</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Cantidad</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Área</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($descargaLavado->descargaLavadoDetalles as $det)
                                <tr>
                                    <td style="font-size:.85rem;"><span class="badge badge-light border">{{ $det->product_code }}</span></td>
                                    <td style="font-size:.85rem;">{{ $det->product_name }}</td>
                                    <td style="font-size:.85rem;" class="text-center">
                                        <span class="badge badge-secondary">{{ $det->product_quantity }}</span>
                                    </td>
                                    <td style="font-size:.85rem;">{{ $det->product_area ?? '-' }}</td>
                                    <td style="font-size:.85rem;">{{ $det->product_type_process ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted" style="font-size:.85rem;">Sin ítems</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Formulario --}}
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-droplet-half text-info mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Datos de la Descarga
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                @include('utils.alerts')

                <form action="{{ route('descarga-lavado.update', $descargaLavado->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-info mr-1"></i> Operador
                                </label>
                                <input class="form-control" type="text" value="{{ $descargaLavado->operator }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-cpu text-info mr-1"></i> Equipo Lavadora
                                </label>
                                <input class="form-control" type="text" value="{{ $descargaLavado->equipo }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-info mr-1"></i> Lote
                                </label>
                                <input type="text" class="form-control" value="{{ $descargaLavado->lote }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-list-check text-info mr-1"></i> Programa
                                </label>
                                <input type="text" class="form-control" value="{{ $descargaLavado->programa_lavado }}" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-info mr-1"></i>
                                    Temperatura (°C) <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.1" name="temperatura" class="form-control"
                                    value="{{ old('temperatura', $descargaLavado->temperatura) }}" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on text-info mr-1"></i>
                                    Estado Indicador <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status_indicador" id="status_indicador" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (['Sin Validar', 'Correcto', 'Falla'] as $estado)
                                        <option value="{{ $estado }}"
                                            {{ old('status_indicador', $descargaLavado->status_indicador) === $estado ? 'selected' : '' }}>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-check2-circle text-info mr-1"></i>
                                    Estado del Ciclo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status_ciclo" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (['En Curso', 'Ciclo Correcto', 'Ciclo con Falla'] as $ciclo)
                                        <option value="{{ $ciclo }}"
                                            {{ old('status_ciclo', $descargaLavado->status_ciclo) === $ciclo ? 'selected' : '' }}>
                                            {{ $ciclo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @can('access_admin')
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-flag text-warning mr-1"></i>
                                    Estado <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    @foreach (['Liberado', 'Registrado', 'Procesado'] as $st)
                                        <option value="{{ $st }}"
                                            {{ old('status', $descargaLavado->status) === $st ? 'selected' : '' }}>
                                            {{ $st }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endcan

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-chat-text text-secondary mr-1"></i>
                                    Nota (opcional)
                                </label>
                                <textarea name="note" rows="4" class="form-control" maxlength="400"
                                    placeholder="Observaciones adicionales..."
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;">{{ old('note', $descargaLavado->note) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2" style="gap:10px;">
                        <a href="{{ route('descarga-lavado.index') }}"
                            class="btn btn-outline-secondary d-flex align-items-center"
                            style="border-radius:8px;padding:10px 20px;font-weight:600;">
                            <i class="bi bi-x-circle mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn d-flex align-items-center text-white"
                            style="border-radius:8px;padding:10px 24px;font-weight:600;background:linear-gradient(135deg,#0ea5e9,#0284c7);border:none;box-shadow:0 4px 12px rgba(14,165,233,0.35);">
                            <i class="bi bi-check-lg mr-2"></i> Guardar Cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
