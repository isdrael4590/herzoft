@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        @include('utils.alerts')

        {{-- Page Header --}}
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);">
                <i class="bi bi-person-gear text-white" style="font-size:1.4rem;"></i>
            </div>
            <div>
                <h4 class="mb-0 font-weight-bold text-dark">Editar Usuario</h4>
                <small class="text-muted">{{ $user->name }} &mdash; {{ $user->email }}</small>
            </div>
        </div>

        @if ($user->must_change_password)
            <div class="alert alert-warning d-flex align-items-center mb-4" style="border-radius:10px;">
                <i class="bi bi-exclamation-triangle-fill mr-2" style="font-size:1.2rem;"></i>
                <span>Este usuario tiene una <strong>contraseña temporal</strong> asignada y deberá cambiarla en su próximo
                    inicio de sesión.</span>
            </div>
        @endif

        <form id="edit-user-form" action="{{ route('users.update', $user->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input type="hidden" name="email" value="{{ $user->email }}">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                            <i class="bi bi-person-lines-fill text-warning mr-2" style="font-size:1.1rem;"></i>
                            <span class="font-weight-semibold text-secondary"
                                style="font-size:.9rem;letter-spacing:.3px;">DATOS DEL USUARIO</span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Nombres Completos <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text" name="name" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Usuario <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text" name="username" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;"
                                            value="{{ $user->username }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Rol <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="role" id="role" required
                                    style="border-radius:8px;border:1px solid #e2e8f0;">
                                    @foreach (\Spatie\Permission\Models\Role::where('name', '!=', 'Super Admin')->get() as $role)
                                        <option {{ $user->hasRole($role->name) ? 'selected' : '' }}
                                            value="{{ $role->name }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Estado <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="is_active" id="is_active" required
                                    style="border-radius:8px;border:1px solid #e2e8f0;">
                                    <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="2" {{ $user->is_active == 2 ? 'selected' : '' }}>Desactivado
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Reset password card --}}
                    @can('edit_user_management')
                        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                            <div class="card-header border-0 d-flex align-items-center"
                                style="background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:12px 12px 0 0;padding:16px 24px;">
                                <i class="bi bi-key-fill text-warning mr-2" style="font-size:1.1rem;"></i>
                                <span class="font-weight-semibold"
                                    style="font-size:.9rem;letter-spacing:.3px;color:#92400e;">REINICIO DE CONTRASEÑA</span>
                            </div>
                            <div class="card-body" style="padding:24px;">
                                <p class="text-muted mb-3" style="font-size:.9rem;">
                                    Reinicia la contraseña del usuario a la clave temporal
                                    <code class="px-2 py-1 rounded"
                                        style="background:#f1f5f9;color:#4f46e5;font-size:.9rem;">Admin1234!</code>.
                                    El usuario deberá cambiarla al iniciar sesión.
                                </p>
                                <form action="{{ route('users.reset-password', $user->id) }}" method="POST"
                                    onsubmit="return confirm('¿Reiniciar la contraseña de {{ addslashes($user->name) }} a la clave temporal?')">
                                    @csrf
                                    <button type="submit" class="btn d-inline-flex align-items-center"
                                        style="border-radius:8px;padding:9px 20px;font-weight:600;background:linear-gradient(135deg,#f59e0b,#d97706);border:none;color:#fff;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                                        <i class="bi bi-arrow-clockwise mr-2"></i> Reiniciar Contraseña
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endcan
                </div>

                <div class="col-lg-4">
                    <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                            <i class="bi bi-image text-warning mr-2" style="font-size:1.1rem;"></i>
                            <span class="font-weight-semibold text-secondary"
                                style="font-size:.9rem;letter-spacing:.3px;">FOTO DE PERFIL</span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <img style="width:80px;height:80px;"
                                class="d-block mx-auto img-thumbnail img-fluid rounded-circle mb-3"
                                src="{{ $user->getFirstMediaUrl('avatars') }}" alt="Foto de perfil">
                            <div class="form-group mb-0">
                                <input id="image" type="file" name="image" data-max-file-size="500KB">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" form="edit-user-form"
                            class="btn btn-block d-flex align-items-center justify-content-center"
                            style="border-radius:8px;padding:12px 20px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);background:linear-gradient(135deg,#f59e0b,#d97706);border:none;color:#fff;">
                            <i class="bi bi-check-lg mr-2"></i> Guardar Cambios
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-block btn-outline-secondary mt-2"
                            style="border-radius:8px;padding:12px 20px;font-weight:600;">
                            <i class="bi bi-arrow-left mr-2"></i> Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@push('page_scripts')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                url: "{{ route('filepond.upload') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });
    </script>
@endpush
