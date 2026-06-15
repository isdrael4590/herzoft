@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('third_party_stylesheets')
    @include('includes.filepond-css')
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Perfil</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        @include('utils.alerts')

        {{-- Page Header --}}
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                style="width:48px;height:48px;background:linear-gradient(135deg,#6366f1,#4f46e5);">
                <i class="bi bi-person-circle text-white" style="font-size:1.4rem;"></i>
            </div>
            <div>
                <h4 class="mb-0 font-weight-bold text-dark">Mi Perfil</h4>
                <small class="text-muted">{{ auth()->user()->name }} &mdash; {{ auth()->user()->email }}</small>
            </div>
        </div>

        {{-- Alerta de cambio obligatorio --}}
        @if(session('force_password_change') || auth()->user()->must_change_password)
            <div class="alert alert-danger d-flex align-items-start mb-4"
                style="border-radius:10px;border-left:4px solid #dc2626;">
                <i class="bi bi-shield-exclamation mr-3 mt-1" style="font-size:1.5rem;color:#dc2626;flex-shrink:0;"></i>
                <div>
                    <strong style="font-size:1rem;">Debes cambiar tu contraseña</strong>
                    <p class="mb-0 mt-1" style="font-size:.9rem;">
                        Tu cuenta tiene una contraseña temporal asignada por un administrador.
                        No podrás acceder al sistema hasta que establezcas una nueva contraseña.
                    </p>
                </div>
            </div>
        @endif

        <div class="row">
            {{-- Columna izquierda: datos + foto --}}
            <div class="col-lg-6 mb-4">

                {{-- Card foto de perfil --}}
                <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                        <i class="bi bi-image text-primary mr-2" style="font-size:1.1rem;"></i>
                        <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">FOTO DE PERFIL</span>
                    </div>
                    <div class="card-body text-center" style="padding:24px;">
                        <img style="width:100px;height:100px;"
                            class="img-thumbnail img-fluid rounded-circle mb-3"
                            src="{{ auth()->user()->getFirstMediaUrl('avatars') }}"
                            alt="Foto de perfil">
                        <div class="form-group mb-0">
                            <input id="image" type="file" name="image" data-max-file-size="500KB">
                        </div>
                    </div>
                </div>

                {{-- Card datos del perfil --}}
                <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                        <i class="bi bi-person-lines-fill text-primary mr-2" style="font-size:1.1rem;"></i>
                        <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INFORMACIÓN PERSONAL</span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Nombre <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="name" required
                                    style="border-radius:8px;border:1px solid #e2e8f0;"
                                    value="{{ auth()->user()->name }}">
                                @error('name')
                                    <p class="text-danger mb-0 mt-1" style="font-size:.85rem;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Email
                                </label>
                                <input class="form-control" type="email"
                                    style="border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;color:#64748b;"
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn d-inline-flex align-items-center"
                                    style="border-radius:8px;padding:9px 20px;font-weight:600;background:linear-gradient(135deg,#6366f1,#4f46e5);border:none;color:#fff;box-shadow:0 4px 12px rgba(99,102,241,0.35);">
                                    <i class="bi bi-check-lg mr-2"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Columna derecha: cambio de contraseña --}}
            <div class="col-lg-6 mb-4">
                <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:12px 12px 0 0;padding:16px 24px;">
                        <i class="bi bi-key-fill text-warning mr-2" style="font-size:1.1rem;"></i>
                        <span class="font-weight-semibold" style="font-size:.9rem;letter-spacing:.3px;color:#92400e;">CAMBIAR CONTRASEÑA</span>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <form action="{{ route('profile.update.password') }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Contraseña Actual <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" required
                                        style="border-radius:8px 0 0 8px;border:1px solid #e2e8f0;">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                            data-target="current_password" tabindex="-1"
                                            style="border-radius:0 8px 8px 0;border-color:#e2e8f0;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('current_password')
                                    <p class="text-danger mb-0 mt-1" style="font-size:.85rem;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Nueva Contraseña <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="password"
                                        name="password" required
                                        style="border-radius:8px 0 0 8px;border:1px solid #e2e8f0;">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                            data-target="password" tabindex="-1"
                                            style="border-radius:0 8px 8px 0;border-color:#e2e8f0;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="text-danger mb-0 mt-1" style="font-size:.85rem;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Confirmar Contraseña <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="password_confirmation"
                                        name="password_confirmation" required
                                        style="border-radius:8px 0 0 8px;border:1px solid #e2e8f0;">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                            data-target="password_confirmation" tabindex="-1"
                                            style="border-radius:0 8px 8px 0;border-color:#e2e8f0;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-danger mb-0 mt-1" style="font-size:.85rem;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn d-inline-flex align-items-center"
                                    style="border-radius:8px;padding:9px 20px;font-weight:600;background:linear-gradient(135deg,#f59e0b,#d97706);border:none;color:#fff;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                                    <i class="bi bi-shield-lock mr-2"></i> Actualizar Contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    @include('includes.filepond-js')
    <script>
        document.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(this.dataset.target);
                var icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });
        });
    </script>
@endpush
