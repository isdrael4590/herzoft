<?php $__env->startSection('title', 'Roles & Permisos'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#6366f1,#4f46e5);">
                    <i class="bi bi-shield-lock text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Gestión de Roles</h4>
                    <small class="text-muted">Roles y permisos del sistema</small>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_roles')): ?>
                <a href="<?php echo e(route('roles.create')); ?>"
                    class="btn d-flex align-items-center"
                    style="border-radius:8px;padding:10px 20px;font-weight:600;box-shadow:0 4px 12px rgba(99,102,241,0.35);background:linear-gradient(135deg,#6366f1,#4f46e5);border:none;color:#fff;">
                    <i class="bi bi-plus-lg mr-2"></i> Nuevo Rol
                </a>
            <?php endif; ?>
        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table text-primary mr-2" style="font-size:1.1rem;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">REGISTRO DE ROLES</span>
                </div>
                <span class="badge badge-warning" style="font-size:.75rem;padding:5px 10px;border-radius:20px;">
                    Gestión de accesos
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <div class="table-responsive">
                    <?php echo $dataTable->table(['class' => 'table table-hover table-bordered align-middle']); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <?php echo $dataTable->scripts(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/User/Resources/views/roles/index.blade.php ENDPATH**/ ?>