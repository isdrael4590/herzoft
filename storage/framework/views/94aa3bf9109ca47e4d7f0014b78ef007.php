<?php $__env->startSection('title', 'Stocks Generados'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Stocks Generados</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="bi bi-box-seam"></i> Stocks Generados
                        </h5>
                        <div class="d-flex" style="gap:8px;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_stockDetails')): ?>
                                <a href="<?php echo e(route('stockDetails.index')); ?>" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-list-ul"></i> Disponibilidad Stock
                                </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_stocks')): ?>
                                <a href="<?php echo e(route('stocks.create')); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg"></i> Almacenar Manualmente
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php echo $dataTable->table(['class' => 'table table-hover table-striped align-middle']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <?php echo $dataTable->scripts(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Stock/Resources/views/stocks/index.blade.php ENDPATH**/ ?>