@extends('layouts.app')

@section('title', 'Configuración de Licencia')

@section('content_header')
    <h1>Configuración de Licencia</h1>
@endsection

@section('third_party_stylesheets')
<style>
    .license-card {
        border-left: 4px solid #667eea;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        transition: all 0.3s ease;
    }
    .license-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .license-status-badge {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .license-info-box {
        background: rgba(255,255,255,0.7);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }
    .license-icon {
        font-size: 48px;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Configuración de Licencia</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card license-card">
                <div class="card-header bg-transparent border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-key text-primary"></i> Gestión de Licencia
                        </h5>
                        @if($licence && $licence->license_expiration_date)
                            <span class="license-status-badge bg-{{ $licence->status_color }} text-white">
                                {{ $licence->status_text }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.licence.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="license_expiration_date">
                                        <i class="fas fa-calendar-alt"></i> Fecha de Vencimiento 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" 
                                           class="form-control form-control-lg @error('license_expiration_date') is-invalid @enderror" 
                                           id="license_expiration_date" 
                                           name="license_expiration_date" 
                                           value="{{ old('license_expiration_date', $licence && $licence->license_expiration_date ? $licence->license_expiration_date->format('Y-m-d') : '') }}"
                                           min="{{ now()->addDay()->format('Y-m-d') }}"
                                           required>
                                    @error('license_expiration_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Seleccione la fecha en que vence la licencia del sistema
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" 
                                               class="custom-control-input" 
                                               id="license_notification_enabled" 
                                               name="license_notification_enabled" 
                                               value="1"
                                               {{ old('license_notification_enabled', $licence && $licence->license_notification_enabled ? true : false) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="license_notification_enabled">
                                            <i class="fas fa-bell"></i> Mostrar notificación de vencimiento
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        La notificación aparecerá en la parte inferior cuando falten 30 días o menos
                                    </small>
                                </div>
                                
                                <hr class="my-4">
                                
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> Guardar Configuración
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-lg ml-2">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-5">
                                <div class="license-info-box">
                                    @if($licence && $licence->license_expiration_date)
                                        @php
                                            $icons = [
                                                'expired' => '🔴',
                                                'critical' => '⚠️',
                                                'warning' => '⚡',
                                                'active' => '✅'
                                            ];
                                        @endphp
                                        <div class="license-icon">{{ $icons[$licence->status] ?? '📋' }}</div>
                                        
                                        <h2 class="mb-2 text-{{ $licence->status_color }}">
                                            @if($licence->days_remaining < 0)
                                                Expirada
                                            @else
                                                {{ $licence->days_remaining }}
                                                <small style="font-size: 0.5em;">{{ $licence->days_remaining == 1 ? 'día' : 'días' }}</small>
                                            @endif
                                        </h2>
                                        
                                        <p class="mb-2 text-muted">
                                            <i class="far fa-calendar"></i> 
                                            Vence: <strong>{{ $licence->license_expiration_date->format('d/m/Y') }}</strong>
                                        </p>
                                        
                                        <p class="mb-0 text-muted small">
                                            <i class="far fa-clock"></i> 
                                            {{ $licence->license_expiration_date->diffForHumans() }}
                                        </p>
                                        
                                        @if($licence->days_remaining <= 15 && $licence->days_remaining >= 0)
                                            <div class="alert alert-{{ $licence->status_color }} mt-3 mb-0 py-2">
                                                <small>
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    @if($licence->days_remaining <= 7)
                                                        ¡Renueve su licencia urgentemente!
                                                    @else
                                                        Considere renovar su licencia pronto
                                                    @endif
                                                </small>
                                            </div>
                                        @endif
                                    @else
                                        <div class="license-icon">⚙️</div>
                                        <h4 class="text-muted mb-3">Sin configurar</h4>
                                        <p class="text-muted small">
                                            Configure la fecha de vencimiento de su licencia para activar las notificaciones del sistema
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
    document.getElementById('license_expiration_date').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        selectedDate.setHours(0, 0, 0, 0);
        
        const diffTime = selectedDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays < 0) {
            alert('⚠️ La fecha seleccionada ya pasó. Por favor, seleccione una fecha futura.');
        }
    });
</script>
@endpush