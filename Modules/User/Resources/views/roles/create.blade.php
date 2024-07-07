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
                                                            id="show_test_bd" name="permissions[]" value="show_test_bd"
                                                            {{ old('show_test_bd') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_test_bd">Producción
                                                            Test Bowie</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_test_vacuum" name="permissions[]"
                                                            value="show_test_vacuum"
                                                            {{ old('show_test_vacuum') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_test_vacuum">Producción Test Vacio</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_production_steam" name="permissions[]"
                                                            value="show_production_steam"
                                                            {{ old('show_production_steam') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_production_steam">Producción Vapor</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_production_hpo" name="permissions[]"
                                                            value="show_production_hpo"
                                                            {{ old('show_production_hpo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_production_hpo">Producción Baja temperatura</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_biologic_steam" name="permissions[]"
                                                            value="show_biologic_steam"
                                                            {{ old('show_biologic_steam') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_biologic_steam">Estadísticas biológicos Vapor</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_biologic_hpo" name="permissions[]"
                                                            value="show_biologic_hpo"
                                                            {{ old('show_biologic_hpo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_biologic_hpo">Estadísticas biológicos Baja
                                                            temperatura</label>
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
                                                            id="create_user_management" name="permissions[]"
                                                            value="create_user_management"
                                                            {{ old('create_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_user_management">Crear Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_user_management" name="permissions[]"
                                                            value="edit_user_management"
                                                            {{ old('edit_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_user_management">Editar Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_user_management" name="permissions[]"
                                                            value="delete_user_management"
                                                            {{ old('delete_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_user_management">Eliminar Usuario</label>
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
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_roles" name="permissions[]"
                                                            value="access_roles"
                                                            {{ old('access_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_roles">
                                                            Acceso Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_roles" name="permissions[]"
                                                            value="create_roles"
                                                            {{ old('create_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_roles">
                                                            Crear Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_roles" name="permissions[]"
                                                            value="edit_roles"
                                                            {{ old('edit_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_roles">
                                                            Editar Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_roles" name="permissions[]"
                                                            value="delete_roles"
                                                            {{ old('delete_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="delete_roles">
                                                            Eliminar Roles</label>
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
                                <!--ZONAS Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            ACCESOS ZONAS
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
                                                            for="access_dirty_area">Zona Sucia</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_zne_area" name="permissions[]"
                                                            value="access_zne_area"
                                                            {{ old('access_zne_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_zne_area">Zona No Esteril</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_esteril_area" name="permissions[]"
                                                            value="access_esteril_area"
                                                            {{ old('access_esteril_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_esteril_area">Zona Esteril</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_almacen_area" name="permissions[]"
                                                            value="access_almacen_area"
                                                            {{ old('access_almacen_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_almacen_area">Zona Almacenaje</label>
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
                                                            id="access_receptions" name="permissions[]"
                                                            value="access_receptions"
                                                            {{ old('access_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_receptions">Acceso</label>
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
                                                            id="print_receptions" name="permissions[]"
                                                            value="print_receptions"
                                                            {{ old('print_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_receptions">Imprimir</label>
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
                                                            id="access_testbds" name="permissions[]"
                                                            value="access_testbds"
                                                            {{ old('access_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_testbds">Acceso
                                                             </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testbds" name="permissions[]" value="show_testbds"
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
                                                            id="edit_testbds" name="permissions[]" value="edit_testbds"
                                                            {{ old('edit_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_testbds">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_testbds" name="permissions[]" value="print_testbds"
                                                            {{ old('print_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_testbds">Imprimir</label>
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
                                <!--PREPARACION  Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            PREPARACION 
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_preparations" name="permissions[]"
                                                            value="access_preparations"
                                                            {{ old('access_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_preparations">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_preparations" name="permissions[]"
                                                            value="show_preparations"
                                                            {{ old('show_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_preparations">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_preparations" name="permissions[]"
                                                            value="create_preparations"
                                                            {{ old('create_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_preparations">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_preparations" name="permissions[]"
                                                            value="edit_preparations"
                                                            {{ old('edit_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_preparations">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_preparations" name="permissions[]"
                                                            value="delete_preparations"
                                                            {{ old('delete_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_preparations">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--REPARACION avanzada Permission-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            PREPARACION DETALLES
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_preparationDetails" name="permissions[]"
                                                            value="access_preparationDetails"
                                                            {{ old('access_preparationDetails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_preparationDetails">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_preparationDetails" name="permissions[]"
                                                            value="show_preparationDetails"
                                                            {{ old('show_preparationDetails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_preparationDetails">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_preparationDetails" name="permissions[]"
                                                            value="create_preparationDetails"
                                                            {{ old('create_preparationDetails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_preparationDetails">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_preparationDetails" name="permissions[]"
                                                            value="edit_preparationDetails"
                                                            {{ old('edit_preparationDetails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_preparationDetails">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_preparationDetails" name="permissions[]"
                                                            value="delete_preparationDetails"
                                                            {{ old('delete_preparationDetails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_preparationDetails">Borrar</label>
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
                                                            id="access_labelqrs" name="permissions[]"
                                                            value="access_labelqrs"
                                                            {{ old('access_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_labelqrs">Acceso</label>
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
                                                            id="print_labelqrs" name="permissions[]" value="print_labelqrs"
                                                            {{ old('print_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_labelqrs">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqr_discharges" name="permissions[]" value="create_labelqr_discharges"
                                                            {{ old('create_labelqr_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_labelqr_discharges">Cargar/Enviar</label>
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
                                                            id="access_discharges" name="permissions[]"
                                                            value="access_discharges"
                                                            {{ old('access_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_discharges">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_discharges" name="permissions[]"
                                                            value="show_discharges"
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
                                                            id="edit_discharges" name="permissions[]"
                                                            value="edit_discharges"
                                                            {{ old('edit_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_discharges">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_discharges" name="permissions[]"
                                                            value="print_discharges"
                                                            {{ old('print_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_discharges">Imprimir</label>
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

                                <!-- ALMACEN MANUAL-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            ALMACEN MANUAL
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_stockManual" name="permissions[]"
                                                            value="access_stockManual"
                                                            {{ old('access_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_stockManual">Acceso </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_stockManual" name="permissions[]"
                                                            value="show_stockManual"
                                                            {{ old('show_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_stockManual">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_stockManual" name="permissions[]"
                                                            value="create_stockManual"
                                                            {{ old('create_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_stockManual">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_stockManual" name="permissions[]"
                                                            value="edit_stockManual"
                                                            {{ old('edit_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_stockManual">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_stockManual" name="permissions[]"
                                                            value="delete_stockManual"
                                                            {{ old('delete_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_stockManual">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ALMACEN -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            ALMACEN
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_stocks" name="permissions[]" value="access_stocks"
                                                            {{ old('access_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_stocks">Acceso
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_stocks" name="permissions[]" value="show_stocks"
                                                            {{ old('show_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_stocks">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_stocks" name="permissions[]" value="create_stocks"
                                                            {{ old('create_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_stocks">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_stocks" name="permissions[]" value="edit_stocks"
                                                            {{ old('edit_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_stocks">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_stocks" name="permissions[]" value="delete_stocks"
                                                            {{ old('delete_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_stocks">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--EXPEDICION /DESPACHO-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            DESPACHO
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_expeditions" name="permissions[]"
                                                            value="access_expeditions"
                                                            {{ old('access_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_expeditions">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_expeditions" name="permissions[]"
                                                            value="show_expeditions"
                                                            {{ old('show_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_expeditions">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_expeditions" name="permissions[]"
                                                            value="create_expeditions"
                                                            {{ old('create_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_expeditions">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_expeditions" name="permissions[]"
                                                            value="edit_expeditions"
                                                            {{ old('edit_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_expeditions">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_expeditions" name="permissions[]"
                                                            value="print_expeditions"
                                                            {{ old('print_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_expeditions">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_expeditions" name="permissions[]"
                                                            value="delete_expeditions"
                                                            {{ old('delete_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_expeditions">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--PRESENTACION UNIDADES-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            PRESENTACION UNIDADES
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_units" name="permissions[]"
                                                            value="access_informat_units"
                                                            {{ old('access_informat_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_units">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_units" name="permissions[]" value="show_units"
                                                            {{ old('show_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_units">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_units" name="permissions[]" value="create_units"
                                                            {{ old('create_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_units">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_units" name="permissions[]" value="edit_units"
                                                            {{ old('edit_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_units">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_units" name="permissions[]" value="delete_units"
                                                            {{ old('delete_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_units">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--INSUMOS-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            INSUMOS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informats" name="permissions[]"
                                                            value="access_informats"
                                                            {{ old('access_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informats">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_informats" name="permissions[]"
                                                            value="show_informats"
                                                            {{ old('show_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_informats">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_informats" name="permissions[]"
                                                            value="create_informats"
                                                            {{ old('create_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_informats">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_informats" name="permissions[]"
                                                            value="edit_informats"
                                                            {{ old('edit_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_informats">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_informats" name="permissions[]"
                                                            value="delete_informats"
                                                            {{ old('delete_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_informats">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--INSTITUCION-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            INSTITUCION
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_Informat_institutes" name="permissions[]"
                                                            value="access_Informat_institutes"
                                                            {{ old('access_Informat_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_Informat_institutes">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_institutes" name="permissions[]"
                                                            value="show_institutes"
                                                            {{ old('show_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_institutes">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_institutes" name="permissions[]"
                                                            value="create_institutes"
                                                            {{ old('create_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_institutes">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_institutes" name="permissions[]"
                                                            value="edit_institutes"
                                                            {{ old('edit_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_institutes">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_institutes" name="permissions[]"
                                                            value="delete_institutes"
                                                            {{ old('delete_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_institutes">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--EQUIPOS-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            EQUIPOS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_machines" name="permissions[]"
                                                            value="access_informat_machines"
                                                            {{ old('access_informat_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_machines">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_machines" name="permissions[]" value="show_machines"
                                                            {{ old('show_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_machines">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_machines" name="permissions[]"
                                                            value="create_machines"
                                                            {{ old('create_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_machines">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_machines" name="permissions[]" value="edit_machines"
                                                            {{ old('edit_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_machines">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_machines" name="permissions[]"
                                                            value="delete_machines"
                                                            {{ old('delete_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_machines">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--AREA-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            AREAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_areas" name="permissions[]"
                                                            value="access_informat_areas"
                                                            {{ old('access_informat_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_areas">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_areas" name="permissions[]" value="show_areas"
                                                            {{ old('show_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_areas">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_areas" name="permissions[]" value="create_areas"
                                                            {{ old('create_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_areas">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_areas" name="permissions[]" value="edit_areas"
                                                            {{ old('edit_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_areas">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_areas" name="permissions[]" value="delete_areas"
                                                            {{ old('delete_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_areas">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--LOTES-->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            LOTES
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_lotes" name="permissions[]"
                                                            value="access_informat_lotes"
                                                            {{ old('access_informat_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_lotes">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_lotes" name="permissions[]" value="show_lotes"
                                                            {{ old('show_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_lotes">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_lotes" name="permissions[]" value="create_lotes"
                                                            {{ old('create_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_lotes">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_lotes" name="permissions[]" value="edit_lotes"
                                                            {{ old('edit_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_lotes">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_lotes" name="permissions[]" value="delete_lotes"
                                                            {{ old('delete_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_lotes">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_reports" name="permissions[]" value="create_reports"
                                                            {{ old('create_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_reports">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_reports" name="permissions[]" value="edit_reports"
                                                            {{ old('edit_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_reports">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_reports" name="permissions[]" value="print_reports"
                                                            {{ old('print_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_reports">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_reports" name="permissions[]" value="delete_reports"
                                                            {{ old('delete_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_reports">Borrar</label>
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
            </div>
            </form>
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
