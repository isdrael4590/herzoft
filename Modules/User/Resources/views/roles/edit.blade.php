@extends('layouts.app')

@section('title', 'Edit Role')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Edit</li>
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
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Actualización de Role <i class="bi bi-check"></i>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nombre de Rol <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required
                                    value="{{ $role->name }}">
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="permissions">
                                    Permisos <span class="text-danger">*</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label class="custom-control-label" for="select-all">Dar todos los permisos</label>
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
                                                            {{ $role->hasPermissionTo('show_total_stats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_total_stats">Todas las Gráficas</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_notifications" name="permissions[]"
                                                            value="show_notifications"
                                                            {{ $role->hasPermissionTo('show_notifications') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_notifications">Notificaciones</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_test" name="permissions[]" value="show_test"
                                                            {{ $role->hasPermissionTo('show_test') ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="show_test">Resultados 
                                                                Tests B&D - Vacío</label>
                                                    </div>
                                                </div>
                                             
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_production" name="permissions[]"
                                                            value="show_production"
                                                            {{ $role->hasPermissionTo('show_production') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_production">Producción Esterilización</label>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_types_rumed" name="permissions[]"
                                                            value="show_types_rumed"
                                                            {{ $role->hasPermissionTo('show_types_rumed') ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                            for="show_types_rumed">Rendimiento de Instrumental</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_result_biologic" name="permissions[]"
                                                            value="show_result_biologic"
                                                            {{ $role->hasPermissionTo('show_result_biologic') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_result_biologic">Estadísticas biológicos </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_production_areas" name="permissions[]"
                                                            value="show_production_areas"
                                                            {{ $role->hasPermissionTo('show_production_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_production_areas">Estadísticas Áreas </label>
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
                                                            {{ $role->hasPermissionTo('access_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_user_management">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_user_management" name="permissions[]"
                                                            value="create_user_management"
                                                            {{ $role->hasPermissionTo('create_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_user_management">Crear Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_user_management" name="permissions[]"
                                                            value="edit_user_management"
                                                            {{ $role->hasPermissionTo('edit_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_user_management">Editar Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_user_management" name="permissions[]"
                                                            value="delete_user_management"
                                                            {{ $role->hasPermissionTo('delete_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_user_management">Eliminar Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_own_profile" name="permissions[]"
                                                            value="edit_own_profile"
                                                            {{ $role->hasPermissionTo('edit_own_profile') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_own_profile">
                                                            Perfil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_roles" name="permissions[]" value="access_roles"
                                                            {{ $role->hasPermissionTo('access_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_roles">
                                                            Acceso Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_roles" name="permissions[]" value="create_roles"
                                                            {{ $role->hasPermissionTo('create_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_roles">
                                                            Crear Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_roles" name="permissions[]" value="edit_roles"
                                                            {{ $role->hasPermissionTo('edit_roles') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_roles">
                                                            Editar Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_roles" name="permissions[]" value="delete_roles"
                                                            {{ $role->hasPermissionTo('delete_roles') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_products">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_products" name="permissions[]" value="show_products"
                                                            {{ $role->hasPermissionTo('show_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_products">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_products" name="permissions[]"
                                                            value="create_products"
                                                            {{ $role->hasPermissionTo('create_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_products">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="accces_subproduct" name="permissions[]"
                                                            value="accces_subproduct"
                                                            {{ $role->hasPermissionTo('accces_subproduct') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="accces_subproduct">Añadir Subproductos</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_products" name="permissions[]" value="edit_products"
                                                            {{ $role->hasPermissionTo('edit_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_products">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_products" name="permissions[]"
                                                            value="delete_products"
                                                            {{ $role->hasPermissionTo('delete_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_products">Borrar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_product_categories" name="permissions[]"
                                                            value="access_product_categories"
                                                            {{ $role->hasPermissionTo('access_product_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_product_categories">Especialidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="add_image" name="permissions[]"
                                                            value="add_image"
                                                            {{ $role->hasPermissionTo('add_image') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="add_image">Añadir Imagen</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_importproducts" name="permissions[]"
                                                            value="create_importproducts"
                                                            {{ $role->hasPermissionTo('create_importproducts') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_importproducts">
                                                            Importar Prodcutos</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_barcodes" name="permissions[]"
                                                            value="print_barcodes"
                                                            {{ $role->hasPermissionTo('print_barcodes') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_dirty_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_dirty_area">Zona
                                                            Sucia</label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_zne_area" name="permissions[]"
                                                            value="access_zne_area"
                                                            {{ $role->hasPermissionTo('access_zne_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_zne_area">Zona
                                                            No Esteril</label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_esteril_area" name="permissions[]"
                                                            value="access_esteril_area"
                                                            {{ $role->hasPermissionTo('access_esteril_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_esteril_area">Zona
                                                            Esteril </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_almacen_area" name="permissions[]"
                                                            value="access_almacen_area"
                                                            {{ $role->hasPermissionTo('access_almacen_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="access_almacen_area">Zona
                                                            Almacenaje</label>
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
                                                            {{ $role->hasPermissionTo('access_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_receptions">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_receptions" name="permissions[]"
                                                            value="show_receptions"
                                                            {{ $role->hasPermissionTo('show_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_receptions">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_receptions" name="permissions[]"
                                                            value="create_receptions"
                                                            {{ $role->hasPermissionTo('create_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_receptions">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_reception_preparations" name="permissions[]"
                                                            value="create_reception_preparations"
                                                            {{ $role->hasPermissionTo('create_reception_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_reception_preparations">Enviar zona Preparación</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_receptions" name="permissions[]"
                                                            value="edit_receptions"
                                                            {{ $role->hasPermissionTo('edit_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_receptions">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_receptions" name="permissions[]"
                                                            value="print_receptions"
                                                            {{ $role->hasPermissionTo('print_receptions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_receptions">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_receptionsticket" name="permissions[]"
                                                            value="print_receptionsticket"
                                                            {{ $role->hasPermissionTo('print_receptionsticket') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_receptionsticket">Imprimir Ticket</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_receptions" name="permissions[]"
                                                            value="delete_receptions"
                                                            {{ $role->hasPermissionTo('delete_receptions') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_wash_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_wash_area" name="permissions[]"
                                                            value="show_wash_area"
                                                            {{ $role->hasPermissionTo('show_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_wash_area">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_wash_area" name="permissions[]"
                                                            value="create_wash_area"
                                                            {{ $role->hasPermissionTo('create_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_wash_area">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_wash_area" name="permissions[]"
                                                            value="edit_wash_area"
                                                            {{ $role->hasPermissionTo('edit_wash_area') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_wash_area">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_wash_area" name="permissions[]"
                                                            value="delete_wash_area"
                                                            {{ $role->hasPermissionTo('delete_wash_area') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_testbds">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testbds" name="permissions[]" value="show_testbds"
                                                            {{ $role->hasPermissionTo('show_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_testbds">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_testbds" name="permissions[]"
                                                            value="create_testbds"
                                                            {{ $role->hasPermissionTo('create_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_testbds">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_testbds" name="permissions[]" value="edit_testbds"
                                                            {{ $role->hasPermissionTo('edit_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_testbds">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_testbds" name="permissions[]" value="print_testbds"
                                                            {{ $role->hasPermissionTo('print_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_testbds">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_testbds" name="permissions[]"
                                                            value="delete_testbds"
                                                            {{ $role->hasPermissionTo('delete_testbds') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_testbds">Borrar</label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--TEST VACIO Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            TEST DE VACIO
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_testvacuums" name="permissions[]"
                                                            value="access_testvacuums"
                                                            {{ $role->hasPermissionTo('access_testvacuums') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_testvacuums">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testvacuums" name="permissions[]" value="show_testvacuums"
                                                            {{ $role->hasPermissionTo('show_testvacuums') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_testvacuums">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_testvacuums" name="permissions[]"
                                                            value="create_testvacuums"
                                                            {{ $role->hasPermissionTo('create_testvacuums') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_testvacuums">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_testvacuums" name="permissions[]" value="edit_testvacuums"
                                                            {{ $role->hasPermissionTo('edit_testvacuums') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_testvacuums">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_testvacuums" name="permissions[]" value="print_testvacuums"
                                                            {{ $role->hasPermissionTo('print_testvacuums') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_testvacuums">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_testvacuums" name="permissions[]"
                                                            value="delete_testvacuums"
                                                            {{ $role->hasPermissionTo('delete_testvacuums') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_testvacuums">Borrar</label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--PREPARACION   AVANZADA Permission -->
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
                                                            {{ $role->hasPermissionTo('access_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_preparations">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_preparations" name="permissions[]"
                                                            value="show_preparations"
                                                            {{ $role->hasPermissionTo('show_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_preparations">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_preparations" name="permissions[]"
                                                            value="create_preparations"
                                                            {{ $role->hasPermissionTo('create_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_preparations">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_preparations" name="permissions[]"
                                                            value="edit_preparations"
                                                            {{ $role->hasPermissionTo('edit_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_preparations">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_preparations" name="permissions[]"
                                                            value="delete_preparations"
                                                            {{ $role->hasPermissionTo('delete_preparations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_preparations">Borrar</label>
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
                                            PREPARACION / REPROCESAR
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_reprocess" name="permissions[]"
                                                            value="access_reprocess"
                                                            {{ $role->hasPermissionTo('access_reprocess') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_reprocess">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_reprocess" name="permissions[]"
                                                            value="show_reprocess"
                                                            {{ $role->hasPermissionTo('show_reprocess') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_reprocess">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_reprocess" name="permissions[]"
                                                            value="create_reprocess"
                                                            {{ $role->hasPermissionTo('create_reprocess') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_reprocess">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_reprocess" name="permissions[]"
                                                            value="edit_reprocess"
                                                            {{ $role->hasPermissionTo('edit_reprocess') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_reprocess">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_reprocess" name="permissions[]"
                                                            value="delete_reprocess"
                                                            {{ $role->hasPermissionTo('delete_reprocess') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_reprocess">Borrar</label>
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
                                                            {{ $role->hasPermissionTo('access_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_labelqrs">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_labelqrs" name="permissions[]" value="show_labelqrs"
                                                            {{ $role->hasPermissionTo('show_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_labelqrs">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqrs" name="permissions[]"
                                                            value="create_labelqrs"
                                                            {{ $role->hasPermissionTo('create_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_labelqrs">Crear Steam</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqrshpo" name="permissions[]"
                                                            value="create_labelqrshpo"
                                                            {{ $role->hasPermissionTo('create_labelqrshpo') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_labelqrshpo">Crear HPO</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_labelqrs" name="permissions[]" value="edit_labelqrs"
                                                            {{ $role->hasPermissionTo('edit_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_labelqrs">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_labelqrs" name="permissions[]"
                                                            value="print_labelqrs"
                                                            {{ $role->hasPermissionTo('print_labelqrs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_labelqrs">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_labelqrs_direct" name="permissions[]"
                                                            value="print_labelqrs_direct"
                                                            {{ $role->hasPermissionTo('print_labelqrs_direct') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_labelqrs_direct">Imprimir Directo</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqr_discharges" name="permissions[]"
                                                            value="create_labelqr_discharges"
                                                            {{ $role->hasPermissionTo('create_labelqr_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_labelqr_discharges">Cargar/Enviar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_labelqrs" name="permissions[]"
                                                            value="delete_labelqrs"
                                                            {{ $role->hasPermissionTo('delete_labelqrs') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_discharges">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_discharges" name="permissions[]"
                                                            value="show_discharges"
                                                            {{ $role->hasPermissionTo('show_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_discharges">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_discharges" name="permissions[]"
                                                            value="create_discharges"
                                                            {{ $role->hasPermissionTo('create_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_discharges">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_discharges" name="permissions[]"
                                                            value="edit_discharges"
                                                            {{ $role->hasPermissionTo('edit_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_discharges">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_discharge_Details" name="permissions[]"
                                                            value="access_discharge_Details"
                                                            {{ $role->hasPermissionTo('access_discharge_Details') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_discharge_Details">Acceso Detalles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_discharges" name="permissions[]"
                                                            value="print_discharges"
                                                            {{ $role->hasPermissionTo('print_discharges') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_discharges">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_discharges_stock" name="permissions[]"
                                                            value="create_discharges_stock"
                                                            {{ $role->hasPermissionTo('create_discharges_stock') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_discharges_stock">Enviar Almacén</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_discharges" name="permissions[]"
                                                            value="delete_discharges"
                                                            {{ $role->hasPermissionTo('delete_discharges') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_stocks">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_stocks" name="permissions[]" value="show_stocks"
                                                            {{ $role->hasPermissionTo('show_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_stocks">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_stocks" name="permissions[]" value="create_stocks"
                                                            {{ $role->hasPermissionTo('create_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_stocks">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_stocks" name="permissions[]" value="edit_stocks"
                                                            {{ $role->hasPermissionTo('edit_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_stocks">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_stocks" name="permissions[]" value="delete_stocks"
                                                            {{ $role->hasPermissionTo('delete_stocks') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_stocks">Borrar</label>
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
                                                            {{ $role->hasPermissionTo('access_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_stockManual">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_stockManual" name="permissions[]"
                                                            value="show_stockManual"
                                                            {{ $role->hasPermissionTo('show_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_stockManual">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_stockManual" name="permissions[]"
                                                            value="create_stockManual"
                                                            {{ $role->hasPermissionTo('create_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_stockManual">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_stockManual" name="permissions[]"
                                                            value="edit_stockManual"
                                                            {{ $role->hasPermissionTo('edit_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_stockManual">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_stockManual" name="permissions[]"
                                                            value="delete_stockManual"
                                                            {{ $role->hasPermissionTo('delete_stockManual') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_stockManual">Borrar</label>
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
                                                            {{ $role->hasPermissionTo('access_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_expeditions">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_expeditions" name="permissions[]"
                                                            value="show_expeditions"
                                                            {{ $role->hasPermissionTo('show_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_expeditions">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_expeditions" name="permissions[]"
                                                            value="create_expeditions"
                                                            {{ $role->hasPermissionTo('create_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_expeditions">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_expeditions" name="permissions[]"
                                                            value="edit_expeditions"
                                                            {{ $role->hasPermissionTo('edit_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_expeditions">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_expeditions" name="permissions[]"
                                                            value="print_expeditions"
                                                            {{ $role->hasPermissionTo('print_expeditions') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_expeditions">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_expeditions" name="permissions[]"
                                                            value="delete_expeditions"
                                                            {{ $role->hasPermissionTo('delete_expeditions') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_informat_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_units">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_units" name="permissions[]" value="show_units"
                                                            {{ $role->hasPermissionTo('show_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_units">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_units" name="permissions[]" value="create_units"
                                                            {{ $role->hasPermissionTo('create_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_units">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_units" name="permissions[]" value="edit_units"
                                                            {{ $role->hasPermissionTo('edit_units') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_units">Editar</label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_units" name="permissions[]" value="delete_units"
                                                            {{ $role->hasPermissionTo('delete_units') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informats">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_informats" name="permissions[]"
                                                            value="show_informats"
                                                            {{ $role->hasPermissionTo('show_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_informats">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_informats" name="permissions[]"
                                                            value="create_informats"
                                                            {{ $role->hasPermissionTo('create_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_informats">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_informats" name="permissions[]"
                                                            value="edit_informats"
                                                            {{ $role->hasPermissionTo('edit_informats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_informats">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_informats" name="permissions[]"
                                                            value="delete_informats"
                                                            {{ $role->hasPermissionTo('delete_informats') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_Informat_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_Informat_institutes">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_institutes" name="permissions[]"
                                                            value="show_institutes"
                                                            {{ $role->hasPermissionTo('show_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_institutes">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_institutes" name="permissions[]"
                                                            value="create_institutes"
                                                            {{ $role->hasPermissionTo('create_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_institutes">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_institutes" name="permissions[]"
                                                            value="edit_institutes"
                                                            {{ $role->hasPermissionTo('edit_institutes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_institutes">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_institutes" name="permissions[]"
                                                            value="delete_institutes"
                                                            {{ $role->hasPermissionTo('delete_institutes') ? 'checked' : '' }}>
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
                                                            {{ $role->hasPermissionTo('access_informat_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_machines">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_machines" name="permissions[]"
                                                            value="show_machines"
                                                            {{ $role->hasPermissionTo('show_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_machines">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_machines" name="permissions[]"
                                                            value="create_machines"
                                                            {{ $role->hasPermissionTo('create_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_machines">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_machines" name="permissions[]"
                                                            value="edit_machines"
                                                            {{ $role->hasPermissionTo('edit_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_machines">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_machines" name="permissions[]"
                                                            value="delete_machines"
                                                            {{ $role->hasPermissionTo('delete_machines') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_machines">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--AREAS-->
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
                                                            {{ $role->hasPermissionTo('access_informat_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_areas">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_areas" name="permissions[]" value="show_areas"
                                                            {{ $role->hasPermissionTo('show_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_areas">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_areas" name="permissions[]"
                                                            value="create_areas"
                                                            {{ $role->hasPermissionTo('create_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_areas">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_areas" name="permissions[]" value="edit_areas"
                                                            {{ $role->hasPermissionTo('edit_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_areas">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_areas" name="permissions[]"
                                                            value="delete_areas"
                                                            {{ $role->hasPermissionTo('delete_areas') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_areas">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!--PROCESOS-->
                                 <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            TIPO DE PROCESOS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_proceso" name="permissions[]"
                                                            value="access_informat_proceso"
                                                            {{ $role->hasPermissionTo('access_informat_proceso') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_proceso">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_proceso" name="permissions[]" value="show_proceso"
                                                            {{ $role->hasPermissionTo('show_proceso') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_proceso">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_proceso" name="permissions[]"
                                                            value="create_proceso"
                                                            {{ $role->hasPermissionTo('create_proceso') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_proceso">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_proceso" name="permissions[]" value="edit_proceso"
                                                            {{ $role->hasPermissionTo('edit_proceso') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_proceso">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_proceso" name="permissions[]"
                                                            value="delete_proceso"
                                                            {{ $role->hasPermissionTo('delete_proceso') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_proceso">Borrar</label>
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
                                                            {{ $role->hasPermissionTo('access_informat_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_informat_lotes">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_lotes" name="permissions[]" value="show_lotes"
                                                            {{ $role->hasPermissionTo('show_lotes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_lotes">Vista</label>
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
                                                            {{ $role->hasPermissionTo('access_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_reports">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_reports" name="permissions[]"
                                                            value="create_reports"
                                                            {{ $role->hasPermissionTo('create_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_reports">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_reports" name="permissions[]"
                                                            value="edit_reports"
                                                            {{ $role->hasPermissionTo('edit_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_reports">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_reports" name="permissions[]"
                                                            value="print_reports"
                                                            {{ $role->hasPermissionTo('print_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_reports">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_reports" name="permissions[]"
                                                            value="delete_reports"
                                                            {{ $role->hasPermissionTo('delete_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_reports">Eliminar</label>
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
                                                            {{ $role->hasPermissionTo('access_settings') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_settings">Access</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ACCEO ADMINISTRADOR -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            ACCEO ADMINISTRADOR
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_admin" name="permissions[]"
                                                            value="access_admin"
                                                            {{ $role->hasPermissionTo('access_admin') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_admin">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_admin" name="permissions[]" value="show_admin"
                                                            {{ $role->hasPermissionTo('show_admin') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_admin">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_admin" name="permissions[]"
                                                            value="create_admin"
                                                            {{ $role->hasPermissionTo('create_admin') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_admin">Crear</label>
                                                    </div>
                                                </div>
                                             
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_admin" name="permissions[]" value="edit_admin"
                                                            {{ $role->hasPermissionTo('edit_admin') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_admin">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_admin" name="permissions[]"
                                                            value="print_admin"
                                                            {{ $role->hasPermissionTo('print_admin') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="print_admin">Imprimir</label>
                                                    </div>
                                                </div>
                                              
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_admin" name="permissions[]"
                                                            value="delete_admin"
                                                            {{ $role->hasPermissionTo('delete_admin') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_admin">Borrar</label>
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
