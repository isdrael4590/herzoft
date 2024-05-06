@extends('layouts.app')

@section('title', 'Create Role')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
@endsection

@push('page_css')
    <style>
        .custom-control-label {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('utils.alerts')
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Crear Role <i class="bi bi-check"></i>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nombre del Rol <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="permissions">Permisos <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label class="custom-control-label" for="select-all">Dar todos los Permisos</label>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dashboard Permissions -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Panel Principal
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_total_stats" name="permissions[]"
                                                            value="show_total_stats"
                                                            {{ old('show_total_stats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_total_stats">Produción
                                                            actual</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_notifications" name="permissions[]"
                                                            value="show_notifications"
                                                            {{ old('show_notifications') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_notifications">Notificaciones</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_rendimiento" name="permissions[]"
                                                            value="show_rendimiento"
                                                            {{ old('show_rendimiento') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_rendimiento">Rendimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="show_test"
                                                            name="permissions[]" value="show_test"
                                                            {{ old('show_test') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_test">Tests</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Management Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Control de usuario
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_user_management" name="permissions[]"
                                                            value="access_user_management"
                                                            {{ old('access_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_user_management">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_own_profile" name="permissions[]"
                                                            value="edit_own_profile"
                                                            {{ old('edit_own_profile') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_own_profile">
                                                            Perfil</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Productos/Paquetes
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_products" name="permissions[]"
                                                            value="access_products"
                                                            {{ old('access_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_products">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_products" name="permissions[]" value="show_products"
                                                            {{ old('show_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_products">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_products" name="permissions[]"
                                                            value="create_products"
                                                            {{ old('create_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_products">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_products" name="permissions[]" value="edit_products"
                                                            {{ old('edit_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_products">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_products" name="permissions[]"
                                                            value="delete_products"
                                                            {{ old('delete_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_products">Borrar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_product_categories" name="permissions[]"
                                                            value="access_product_categories"
                                                            {{ old('access_product_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_product_categories">Especialidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_barcodes" name="permissions[]"
                                                            value="print_barcodes"
                                                            {{ old('print_barcodes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="print_barcodes">Print
                                                            Barcodes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--RECEPTION Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            RECEPCION
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_dirty_area" name="permissions[]"
                                                            value="access_dirty_area"
                                                            {{ old('access_dirty_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_dirty_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_receptions" name="permissions[]"
                                                            value="show_receptions"
                                                            {{ old('show_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_receptions">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_receptions" name="permissions[]"
                                                            value="create_receptions"
                                                            {{ old('create_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_receptions">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_receptions" name="permissions[]"
                                                            value="edit_receptions"
                                                            {{ old('edit_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_receptions">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_receptions" name="permissions[]"
                                                            value="delete_receptions"
                                                            {{ old('delete_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_receptions">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--LAVADORA  Permission -->
                              <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            LAVADORAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_wash_area" name="permissions[]"
                                                            value="access_wash_area"
                                                            {{ old('access_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_wash_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_wash_area" name="permissions[]"
                                                            value="show_wash_area"
                                                            {{ old('show_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_wash_area">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_wash_area" name="permissions[]"
                                                            value="create_wash_area"
                                                            {{ old('create_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_wash_area">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_wash_area" name="permissions[]"
                                                            value="edit_wash_area"
                                                            {{ old('edit_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_wash_area">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_wash_area" name="permissions[]"
                                                            value="delete_wash_area"
                                                            {{ old('delete_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_wash_area">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--TEST BOWIE Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            TEST DE BOWIE
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_zne_area" name="permissions[]"
                                                            value="access_zne_area"
                                                            {{ old('access_zne_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_zne_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testbds" name="permissions[]"
                                                            value="show_testbds"
                                                            {{ old('show_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_testbds">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_testbds" name="permissions[]"
                                                            value="create_testbds"
                                                            {{ old('create_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_testbds">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_testbds" name="permissions[]"
                                                            value="edit_testbds"
                                                            {{ old('edit_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_testbds">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_testbds" name="permissions[]"
                                                            value="delete_testbds"
                                                            {{ old('delete_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_testbds">Borrar</label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- GENERAR ETIQUETAS -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            GENERAR ETIQUETAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_zne_area" name="permissions[]"
                                                            value="access_zne_area"
                                                            {{ old('access_zne_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_zne_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_labelqrs" name="permissions[]" value="show_labelqrs"
                                                            {{ old('show_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_labelqrs">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqrs" name="permissions[]"
                                                            value="create_labelqrs"
                                                            {{ old('create_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_labelqrs">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_labelqrs" name="permissions[]" value="edit_labelqrs"
                                                            {{ old('edit_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_labelqrs">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_labelqrs" name="permissions[]"
                                                            value="delete_labelqrs"
                                                            {{ old('delete_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_labelqrs">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- LIBERAR CARGA -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            LIBERAR CICLO
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_ze_area" name="permissions[]"
                                                            value="access_ze_area"
                                                            {{ old('access_ze_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_ze_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_discharges" name="permissions[]" value="show_discharges"
                                                            {{ old('show_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_discharges">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_discharges" name="permissions[]"
                                                            value="create_discharges"
                                                            {{ old('create_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_discharges">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_discharges" name="permissions[]" value="edit_discharges"
                                                            {{ old('edit_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_discharges">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_discharges" name="permissions[]"
                                                            value="delete_discharges"
                                                            {{ old('delete_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_discharges">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ALMACEN -->
                                <div class="col-lg-4 col-md-6 mb-3">

                                </div>



                                <!-- Reports -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Reportes
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_reports" name="permissions[]"
                                                            value="access_reports"
                                                            {{ old('access_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_reports">Access</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Settings
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_settings" name="permissions[]"
                                                            value="access_settings"
                                                            {{ old('access_settings') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_settings">Access</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#select-all').click(function() {
                var checked = this.checked;
                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            })
        });
    </script>
@endpush
