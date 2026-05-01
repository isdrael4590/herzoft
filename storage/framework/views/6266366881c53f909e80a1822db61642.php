<?php $__env->startSection('title', 'Product Categories'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Productos</a></li>
        <li class="breadcrumb-item active">Categoria/Especialidad</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_admin')): ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#categoryCreateModal">
                                Añadir Especialidad <i class="bi bi-plus"></i>
                            </button>

                            <a href="<?php echo e(route('import-categories.create')); ?>" class="btn btn-warning">
                                Importar Especialidad<i class="bi bi-save"></i>
                            </a>
                        <?php endif; ?>
                        <hr>

                        <div class="table-responsive">
                            <?php echo $dataTable->table(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <?php echo $__env->make('product::includes.category-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <?php echo $dataTable->scripts(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/categories/index.blade.php ENDPATH**/ ?>