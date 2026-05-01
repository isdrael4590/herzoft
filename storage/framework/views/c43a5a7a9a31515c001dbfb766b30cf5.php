<?php $__env->startSection('title', 'Crear Rol'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('roles.index')); ?>">Roles</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_css'); ?>
    <style>
        .custom-control-label { cursor: pointer; }
        .perm-card-header {
            background: linear-gradient(135deg,#f8fafc,#f1f5f9);
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 16px;
            font-weight: 600;
            font-size: .82rem;
            letter-spacing: .4px;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#6366f1,#4f46e5);">
                    <i class="bi bi-shield-plus text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Nuevo Rol</h4>
                    <small class="text-muted">Define el nombre y los permisos del rol</small>
                </div>
            </div>
        </div>

        <form action="<?php echo e(route('roles.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center justify-content-between"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-tag text-primary mr-2" style="font-size:1.1rem;"></i>
                        <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">DATOS DEL ROL</span>
                    </div>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-group mb-0">
                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                            Nombre del Rol <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="name" required
                            style="border-radius:8px;border:1px solid #e2e8f0;max-width:400px;"
                            value="<?php echo e(old('name')); ?>">
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center justify-content-between"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-key text-warning mr-2" style="font-size:1.1rem;"></i>
                        <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">PERMISOS</span>
                    </div>
                    <div class="custom-control custom-checkbox mb-0">
                        <input type="checkbox" class="custom-control-input" id="select-all">
                        <label class="custom-control-label font-weight-semibold" for="select-all" style="font-size:.85rem;">
                            Seleccionar todos
                        </label>
                    </div>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="row">
                                <!-- Dashboard Permissions -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="perm-card-header">
                                            Panel Principal
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_total_stats" name="permissions[]"
                                                            value="show_total_stats"
                                                            <?php echo e(old('show_total_stats') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="show_total_stats">Todas las Gráficas</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_notifications" name="permissions[]"
                                                            value="show_notifications"
                                                            <?php echo e(old('show_notifications') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_notifications">Notificaciones</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_test" name="permissions[]" value="show_test"
                                                            <?php echo e(old('show_test') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="show_test">Resultados 
                                                            Tests B&D - Vacío</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_production" name="permissions[]"
                                                            value="show_production"
                                                            <?php echo e(old('show_production') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_production">Producción de Esterilización</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_types_rumed" name="permissions[]"
                                                            value="show_types_rumed"
                                                            <?php echo e(old('show_types_rumed') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_types_rumed">Rendimiento de Instrumental</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_result_biologic" name="permissions[]"
                                                            value="show_result_biologic"
                                                            <?php echo e(old('show_result_biologic') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_result_biologic">Estadísticas biológicos</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_production_areas" name="permissions[]"
                                                            value="show_production_areas"
                                                            <?php echo e(old('show_production_areas') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_production_areas">Estadísticas Áreas</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Management Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="perm-card-header">
                                            Control de usuario
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_user_management" name="permissions[]"
                                                            value="access_user_management"
                                                            <?php echo e(old('access_user_management') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_user_management">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_user_management" name="permissions[]"
                                                            value="create_user_management"
                                                            <?php echo e(old('create_user_management') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_user_management">Crear Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_user_management" name="permissions[]"
                                                            value="edit_user_management"
                                                            <?php echo e(old('edit_user_management') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_user_management">Editar Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_user_management" name="permissions[]"
                                                            value="delete_user_management"
                                                            <?php echo e(old('delete_user_management') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="delete_user_management">Eliminar Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_own_profile" name="permissions[]"
                                                            value="edit_own_profile"
                                                            <?php echo e(old('edit_own_profile') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="edit_own_profile">
                                                            Perfil</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_roles" name="permissions[]" value="access_roles"
                                                            <?php echo e(old('access_roles') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_roles">
                                                            Acceso Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_roles" name="permissions[]" value="create_roles"
                                                            <?php echo e(old('create_roles') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="create_roles">
                                                            Crear Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_roles" name="permissions[]" value="edit_roles"
                                                            <?php echo e(old('edit_roles') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="edit_roles">
                                                            Editar Roles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_roles" name="permissions[]" value="delete_roles"
                                                            <?php echo e(old('delete_roles') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            Productos/Paquetes
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_products" name="permissions[]"
                                                            value="access_products"
                                                            <?php echo e(old('access_products') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_products">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_products" name="permissions[]" value="show_products"
                                                            <?php echo e(old('show_products') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_products">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_products" name="permissions[]"
                                                            value="create_products"
                                                            <?php echo e(old('create_products') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_products">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="accces_subproduct" name="permissions[]"
                                                            value="accces_subproduct"
                                                            <?php echo e(old('accces_subproduct') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="accces_subproduct">Añadir subproductos</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_products" name="permissions[]" value="edit_products"
                                                            <?php echo e(old('edit_products') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_products">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_products" name="permissions[]"
                                                            value="delete_products"
                                                            <?php echo e(old('delete_products') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="delete_products">Borrar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_product_categories" name="permissions[]"
                                                            value="access_product_categories"
                                                            <?php echo e(old('access_product_categories') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_product_categories">Especialidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="add_image" name="permissions[]"
                                                            value="add_image"
                                                            <?php echo e(old('add_image') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="add_image">Añadir Imagen</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_barcodes" name="permissions[]"
                                                            value="print_barcodes"
                                                            <?php echo e(old('print_barcodes') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="print_barcodes">Print
                                                            Barcodes</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_importproducts" name="permissions[]"
                                                            value="create_importproducts"
                                                            <?php echo e(old('create_importproducts') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="create_importproducts">
                                                            Importar Productos</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--ZONAS Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="perm-card-header">
                                            ACCESOS ZONAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_dirty_area" name="permissions[]"
                                                            value="access_dirty_area"
                                                            <?php echo e(old('access_dirty_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_dirty_area">Zona
                                                            Sucia</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_zne_area" name="permissions[]"
                                                            value="access_zne_area"
                                                            <?php echo e(old('access_zne_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_zne_area">Zona No
                                                            Esteril</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_esteril_area" name="permissions[]"
                                                            value="access_esteril_area"
                                                            <?php echo e(old('access_esteril_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_esteril_area">Zona
                                                            Esteril</label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_almacen_area" name="permissions[]"
                                                            value="access_almacen_area"
                                                            <?php echo e(old('access_almacen_area') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            RECEPCION
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_receptions" name="permissions[]"
                                                            value="access_receptions"
                                                            <?php echo e(old('access_receptions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_receptions">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_receptions" name="permissions[]"
                                                            value="show_receptions"
                                                            <?php echo e(old('show_receptions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_receptions">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_receptions" name="permissions[]"
                                                            value="create_receptions"
                                                            <?php echo e(old('create_receptions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_receptions">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_reception_preparations" name="permissions[]"
                                                            value="create_reception_preparations"
                                                            <?php echo e(old('create_reception_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_reception_preparations">Enviar zona Preparación</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_receptions" name="permissions[]"
                                                            value="edit_receptions"
                                                            <?php echo e(old('edit_receptions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_receptions">Editar</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_receptions" name="permissions[]"
                                                            value="print_receptions"
                                                            <?php echo e(old('print_receptions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_receptions">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_receptionsticket" name="permissions[]"
                                                            value="print_receptionsticket"
                                                            <?php echo e(old('print_receptionsticket') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_receptionsticket">Imprimir Ticket</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_receptions" name="permissions[]"
                                                            value="delete_receptions"
                                                            <?php echo e(old('delete_receptions') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            LAVADORAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_wash_area" name="permissions[]"
                                                            value="access_wash_area"
                                                            <?php echo e(old('access_wash_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_wash_area">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_wash_area" name="permissions[]"
                                                            value="show_wash_area"
                                                            <?php echo e(old('show_wash_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_wash_area">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_wash_area" name="permissions[]"
                                                            value="create_wash_area"
                                                            <?php echo e(old('create_wash_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_wash_area">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_wash_area" name="permissions[]"
                                                            value="edit_wash_area"
                                                            <?php echo e(old('edit_wash_area') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_wash_area">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_wash_area" name="permissions[]"
                                                            value="delete_wash_area"
                                                            <?php echo e(old('delete_wash_area') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            TEST DE BOWIE
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_testbds" name="permissions[]"
                                                            value="access_testbds"
                                                            <?php echo e(old('access_testbds') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_testbds">Acceso
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testbds" name="permissions[]" value="show_testbds"
                                                            <?php echo e(old('show_testbds') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_testbds">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_testbds" name="permissions[]"
                                                            value="create_testbds"
                                                            <?php echo e(old('create_testbds') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_testbds">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_testbds" name="permissions[]" value="edit_testbds"
                                                            <?php echo e(old('edit_testbds') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_testbds">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_testbds" name="permissions[]" value="print_testbds"
                                                            <?php echo e(old('print_testbds') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_testbds">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_testbds" name="permissions[]"
                                                            value="delete_testbds"
                                                            <?php echo e(old('delete_testbds') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            TEST DE VACIO
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_testvacuums" name="permissions[]"
                                                            value="access_testvacuums"
                                                            <?php echo e(old('access_testvacuums') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_testvacuums">Acceso
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testvacuums" name="permissions[]" value="show_testvacuums"
                                                            <?php echo e(old('show_testvacuums') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_testvacuums">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_testvacuums" name="permissions[]"
                                                            value="create_testvacuums"
                                                            <?php echo e(old('create_testvacuums') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_testvacuums">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_testvacuums" name="permissions[]" value="edit_testvacuums"
                                                            <?php echo e(old('edit_testvacuums') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_testvacuums">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_testvacuums" name="permissions[]" value="print_testvacuums"
                                                            <?php echo e(old('print_testvacuums') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_testvacuums">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_testvacuums" name="permissions[]"
                                                            value="delete_testvacuums"
                                                            <?php echo e(old('delete_testvacuums') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="delete_testvacuums">Borrar</label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--PREPARACION  Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="perm-card-header">
                                            PREPARACION
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_preparations" name="permissions[]"
                                                            value="access_preparations"
                                                            <?php echo e(old('access_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_preparations">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_preparations" name="permissions[]"
                                                            value="show_preparations"
                                                            <?php echo e(old('show_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_preparations">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_preparations" name="permissions[]"
                                                            value="create_preparations"
                                                            <?php echo e(old('create_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_preparations">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_preparations" name="permissions[]"
                                                            value="edit_preparations"
                                                            <?php echo e(old('edit_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_preparations">Editar</label>
                                                    </div>
                                                </div>
                                                 <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="reset_preparations" name="permissions[]"
                                                            value="reset_preparations"
                                                            <?php echo e(old('reset_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="reset_preparations">Resetear cantidades</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_preparations" name="permissions[]"
                                                            value="delete_preparations"
                                                            <?php echo e(old('delete_preparations') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="delete_preparations">Borrar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--REPARACION avanzada Permission-->
                               
                                <!-- GENERAR ETIQUETAS -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="perm-card-header">
                                            GENERAR ETIQUETAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_labelqrs" name="permissions[]"
                                                            value="access_labelqrs"
                                                            <?php echo e(old('access_labelqrs') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_labelqrs">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_labelqrs" name="permissions[]" value="show_labelqrs"
                                                            <?php echo e(old('show_labelqrs') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_labelqrs">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqrs" name="permissions[]"
                                                            value="create_labelqrs"
                                                            <?php echo e(old('create_labelqrs') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_labelqrs">Crear STEAM</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqrshpo" name="permissions[]"
                                                            value="create_labelqrshpo"
                                                            <?php echo e(old('create_labelqrshpo') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_labelqrshpo">Crear HPO</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_labelqrs" name="permissions[]" value="edit_labelqrs"
                                                            <?php echo e(old('edit_labelqrs') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_labelqrs">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_labelqrs" name="permissions[]"
                                                            value="print_labelqrs"
                                                            <?php echo e(old('print_labelqrs') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_labelqrs">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_labelqrs_direct" name="permissions[]"
                                                            value="print_labelqrs_direct"
                                                            <?php echo e(old('print_labelqrs_direct') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_labelqrs_direct">Imprimir Directo</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_labelqr_discharges" name="permissions[]"
                                                            value="create_labelqr_discharges"
                                                            <?php echo e(old('create_labelqr_discharges') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_labelqr_discharges">Cargar/Enviar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_labelqrs" name="permissions[]"
                                                            value="delete_labelqrs"
                                                            <?php echo e(old('delete_labelqrs') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            LIBERAR CICLO
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_discharges" name="permissions[]"
                                                            value="access_discharges"
                                                            <?php echo e(old('access_discharges') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_discharges">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_discharges" name="permissions[]"
                                                            value="show_discharges"
                                                            <?php echo e(old('show_discharges') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_discharges">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_discharges" name="permissions[]"
                                                            value="create_discharges"
                                                            <?php echo e(old('create_discharges') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_discharges">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_discharges" name="permissions[]"
                                                            value="edit_discharges"
                                                            <?php echo e(old('edit_discharges') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_discharges">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_discharge_Details" name="permissions[]"
                                                            value="access_discharge_Details"
                                                            <?php echo e(old('access_discharge_Details') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_discharge_Details">Acceso Detalles</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_discharges" name="permissions[]"
                                                            value="print_discharges"
                                                            <?php echo e(old('print_discharges') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_discharges">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_discharges_stock" name="permissions[]"
                                                            value="create_discharges_stock"
                                                            <?php echo e(old('create_discharges_stock') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_discharges_stock">Enviar Almacén</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_discharges" name="permissions[]"
                                                            value="delete_discharges"
                                                            <?php echo e(old('delete_discharges') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            ALMACEN MANUAL
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_stockManual" name="permissions[]"
                                                            value="access_stockManual"
                                                            <?php echo e(old('access_stockManual') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_stockManual">Acceso </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_stockManual" name="permissions[]"
                                                            value="show_stockManual"
                                                            <?php echo e(old('show_stockManual') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_stockManual">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_stockManual" name="permissions[]"
                                                            value="create_stockManual"
                                                            <?php echo e(old('create_stockManual') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_stockManual">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_stockManual" name="permissions[]"
                                                            value="edit_stockManual"
                                                            <?php echo e(old('edit_stockManual') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_stockManual">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_stockManual" name="permissions[]"
                                                            value="delete_stockManual"
                                                            <?php echo e(old('delete_stockManual') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            ALMACEN
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_stocks" name="permissions[]" value="access_stocks"
                                                            <?php echo e(old('access_stocks') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="access_stocks">Acceso
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_stocks" name="permissions[]" value="show_stocks"
                                                            <?php echo e(old('show_stocks') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_stocks">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_stocks" name="permissions[]" value="create_stocks"
                                                            <?php echo e(old('create_stocks') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_stocks">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_stocks" name="permissions[]" value="edit_stocks"
                                                            <?php echo e(old('edit_stocks') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_stocks">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_stocks" name="permissions[]" value="delete_stocks"
                                                            <?php echo e(old('delete_stocks') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            DESPACHO
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_expeditions" name="permissions[]"
                                                            value="access_expeditions"
                                                            <?php echo e(old('access_expeditions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_expeditions">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_expeditions" name="permissions[]"
                                                            value="show_expeditions"
                                                            <?php echo e(old('show_expeditions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_expeditions">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_expeditions" name="permissions[]"
                                                            value="create_expeditions"
                                                            <?php echo e(old('create_expeditions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_expeditions">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_expeditions" name="permissions[]"
                                                            value="edit_expeditions"
                                                            <?php echo e(old('edit_expeditions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_expeditions">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_expeditions" name="permissions[]"
                                                            value="print_expeditions"
                                                            <?php echo e(old('print_expeditions') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_expeditions">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_expeditions" name="permissions[]"
                                                            value="delete_expeditions"
                                                            <?php echo e(old('delete_expeditions') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            PRESENTACION UNIDADES
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_units" name="permissions[]"
                                                            value="access_informat_units"
                                                            <?php echo e(old('access_informat_units') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_informat_units">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_units" name="permissions[]" value="show_units"
                                                            <?php echo e(old('show_units') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="show_units">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_units" name="permissions[]" value="create_units"
                                                            <?php echo e(old('create_units') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_units">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_units" name="permissions[]" value="edit_units"
                                                            <?php echo e(old('edit_units') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_units">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_units" name="permissions[]" value="delete_units"
                                                            <?php echo e(old('delete_units') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            INSUMOS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informats" name="permissions[]"
                                                            value="access_informats"
                                                            <?php echo e(old('access_informats') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_informats">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_informats" name="permissions[]"
                                                            value="show_informats"
                                                            <?php echo e(old('show_informats') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_informats">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_informats" name="permissions[]"
                                                            value="create_informats"
                                                            <?php echo e(old('create_informats') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_informats">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_informats" name="permissions[]"
                                                            value="edit_informats"
                                                            <?php echo e(old('edit_informats') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_informats">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_informats" name="permissions[]"
                                                            value="delete_informats"
                                                            <?php echo e(old('delete_informats') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            INSTITUCION
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_Informat_institutes" name="permissions[]"
                                                            value="access_Informat_institutes"
                                                            <?php echo e(old('access_Informat_institutes') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_Informat_institutes">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_institutes" name="permissions[]"
                                                            value="show_institutes"
                                                            <?php echo e(old('show_institutes') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_institutes">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_institutes" name="permissions[]"
                                                            value="create_institutes"
                                                            <?php echo e(old('create_institutes') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_institutes">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_institutes" name="permissions[]"
                                                            value="edit_institutes"
                                                            <?php echo e(old('edit_institutes') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_institutes">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_institutes" name="permissions[]"
                                                            value="delete_institutes"
                                                            <?php echo e(old('delete_institutes') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            EQUIPOS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_machines" name="permissions[]"
                                                            value="access_informat_machines"
                                                            <?php echo e(old('access_informat_machines') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_informat_machines">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_machines" name="permissions[]"
                                                            value="show_machines"
                                                            <?php echo e(old('show_machines') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_machines">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_machines" name="permissions[]"
                                                            value="create_machines"
                                                            <?php echo e(old('create_machines') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_machines">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_machines" name="permissions[]"
                                                            value="edit_machines"
                                                            <?php echo e(old('edit_machines') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_machines">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_machines" name="permissions[]"
                                                            value="delete_machines"
                                                            <?php echo e(old('delete_machines') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            AREAS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_areas" name="permissions[]"
                                                            value="access_informat_areas"
                                                            <?php echo e(old('access_informat_areas') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_informat_areas">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_areas" name="permissions[]" value="show_areas"
                                                            <?php echo e(old('show_areas') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_areas">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_areas" name="permissions[]"
                                                            value="create_areas"
                                                            <?php echo e(old('create_areas') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_areas">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_areas" name="permissions[]" value="edit_areas"
                                                            <?php echo e(old('edit_areas') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_areas">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_areas" name="permissions[]"
                                                            value="delete_areas"
                                                            <?php echo e(old('delete_areas') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            TIPO DE PROCESOS
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_proceso" name="permissions[]"
                                                            value="access_informat_proceso"
                                                            <?php echo e(old('access_informat_proceso') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_informat_proceso">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_proceso" name="permissions[]" value="show_proceso"
                                                            <?php echo e(old('show_proceso') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_proceso">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_proceso" name="permissions[]"
                                                            value="create_proceso"
                                                            <?php echo e(old('create_proceso') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_proceso">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_proceso" name="permissions[]" value="edit_proceso"
                                                            <?php echo e(old('edit_proceso') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_proceso">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_proceso" name="permissions[]"
                                                            value="delete_proceso"
                                                            <?php echo e(old('delete_proceso') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            LOTES
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_informat_lotes" name="permissions[]"
                                                            value="access_informat_lotes"
                                                            <?php echo e(old('access_informat_lotes') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_informat_lotes">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_lotes" name="permissions[]" value="show_lotes"
                                                            <?php echo e(old('show_lotes') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            Reportes
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_reports" name="permissions[]"
                                                            value="access_reports"
                                                            <?php echo e(old('access_reports') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_reports">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_reports" name="permissions[]"
                                                            value="create_reports"
                                                            <?php echo e(old('create_reports') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_reports">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_reports" name="permissions[]"
                                                            value="edit_reports"
                                                            <?php echo e(old('edit_reports') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_reports">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_reports" name="permissions[]"
                                                            value="print_reports"
                                                            <?php echo e(old('print_reports') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_reports">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_reports" name="permissions[]"
                                                            value="delete_reports"
                                                            <?php echo e(old('delete_reports') ? 'checked' : ''); ?>>
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
                                        <div class="perm-card-header">
                                            Settings
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_settings" name="permissions[]"
                                                            value="access_settings"
                                                            <?php echo e(old('access_settings') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_settings">Access</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ACCESO ADMINISTRADOR -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="perm-card-header">
                                            ACCESO ADMINISTRADOR
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_admin" name="permissions[]"
                                                            value="access_admin"
                                                            <?php echo e(old('access_admin') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="access_admin">Acceso</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_admin" name="permissions[]"
                                                            value="show_admin"
                                                            <?php echo e(old('show_admin') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="show_admin">Vista</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_admin" name="permissions[]"
                                                            value="create_admin"
                                                            <?php echo e(old('create_admin') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="create_admin">Crear</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_admin" name="permissions[]"
                                                            value="edit_admin"
                                                            <?php echo e(old('edit_admin') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="edit_admin">Editar</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_admin" name="permissions[]"
                                                            value="print_admin"
                                                            <?php echo e(old('print_admin') ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label"
                                                            for="print_admin">Imprimir</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_admin" name="permissions[]"
                                                            value="delete_admin"
                                                            <?php echo e(old('delete_admin') ? 'checked' : ''); ?>>
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
        </div>

        
        <div class="d-flex align-items-center mt-3" style="gap:12px;">
            <button type="submit"
                class="btn d-flex align-items-center"
                style="border-radius:8px;padding:10px 28px;font-weight:600;box-shadow:0 4px 12px rgba(99,102,241,0.35);background:linear-gradient(135deg,#6366f1,#4f46e5);border:none;color:#fff;">
                <i class="bi bi-check-lg mr-2"></i> Crear Rol
            </button>
            <a href="<?php echo e(route('roles.index')); ?>"
                class="btn btn-outline-secondary"
                style="border-radius:8px;padding:10px 24px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Cancelar
            </a>
        </div>

        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/User/Resources/views/roles/create.blade.php ENDPATH**/ ?>