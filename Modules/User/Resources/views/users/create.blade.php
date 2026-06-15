@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        @include('utils.alerts')

        {{-- Page Header --}}
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                <i class="bi bi-person-plus text-white" style="font-size:1.4rem;"></i>
            </div>
            <div>
                <h4 class="mb-0 font-weight-bold text-dark">Nuevo Usuario</h4>
                <small class="text-muted">Complete los datos para registrar un nuevo usuario</small>
            </div>
        </div>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                            <i class="bi bi-person-lines-fill text-success mr-2" style="font-size:1.1rem;"></i>
                            <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">DATOS DEL USUARIO</span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Nombres Completos <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text" name="name" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Usuario <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text" name="username" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;"
                                            value="{{ old('username') }}"
                                            placeholder="nombre_usuario">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Correo Electrónico <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="email" name="email" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;"
                                            value="{{ old('email') }}"
                                            placeholder="correo@ejemplo.com">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Contraseña <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" name="password" id="password" required
                                                style="border-radius:8px 0 0 8px;border:1px solid #e2e8f0;border-right:0;">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                                    data-target="#password"
                                                    style="border-radius:0 8px 8px 0;border-color:#e2e8f0;">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Confirmar Contraseña <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required
                                                style="border-radius:8px 0 0 8px;border:1px solid #e2e8f0;border-right:0;">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                                    data-target="#password_confirmation"
                                                    style="border-radius:0 8px 8px 0;border-color:#e2e8f0;">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Rol <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="role" id="role" required
                                    style="border-radius:8px;border:1px solid #e2e8f0;">
                                    <option value="" selected disabled>Seleccionar Rol</option>
                                    @foreach(\Spatie\Permission\Models\Role::where('name', '!=', 'Super Admin')->get() as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
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
                                    <option value="" selected disabled>Seleccionar Estado</option>
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="2" {{ old('is_active') == '2' ? 'selected' : '' }}>Desactivado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                            <i class="bi bi-image text-success mr-2" style="font-size:1.1rem;"></i>
                            <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">FOTO DE PERFIL</span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-group mb-0">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Imagen de Perfil <span class="text-danger">*</span>
                                </label>
                                <input id="image" type="file" name="image" data-max-file-size="500KB">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit"
                            class="btn btn-block d-flex align-items-center justify-content-center"
                            style="border-radius:8px;padding:12px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);background:linear-gradient(135deg,#10b981,#059669);border:none;color:#fff;">
                            <i class="bi bi-check-lg mr-2"></i> Crear Usuario
                        </button>
                        <a href="{{ route('users.index') }}"
                            class="btn btn-block btn-outline-secondary mt-2"
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
        document.querySelectorAll('.toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.querySelector(this.dataset.target);
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
