<?php $__env->startSection('title', 'Disponibilidad Stock'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('stocks.index')); ?>">Stocks Generados</a></li>
        <li class="breadcrumb-item active">Disponibilidad Stock</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="bi bi-layers"></i> Disponibilidad Stock
                        </h5>
                        <div class="d-flex align-items-center" style="gap:8px;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?> <a href="<?php echo e(route('stocks.index')); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i> Cambios Exclusivos
                                </a>
                         
                            <a href="<?php echo e(route('stockDetails.resetHistory')); ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-clock-history"></i> Historial de Reseteos
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reset_preparations')): ?>
                            <form id="resetStockForm" action="<?php echo e(route('stockDetails.resetQuantities')); ?>" method="POST"
                                style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="button" class="btn btn-warning btn-sm" id="resetStockBtn">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reiniciar Cantidades
                                </button>
                            </form>
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

<script>
    $(document).ready(function() {
        $('#resetStockBtn').on('click', function() {
            if (confirm(
                    '¿Está seguro de reiniciar las cantidades de stock? Esta acción quedará registrada en el historial.'
                    )) {
                $('#resetStockForm').submit();
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Stock/Resources/views/stockDetails/index.blade.php ENDPATH**/ ?>