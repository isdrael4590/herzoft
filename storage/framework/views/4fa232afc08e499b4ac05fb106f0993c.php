<?php $__env->startSection('title', 'Historial Stock - ' . $productCode); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('stockDetails.index')); ?>">Disponibilidad Stock</a></li>
        <li class="breadcrumb-item active">Historial: <?php echo e($productCode); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-0">
                                <i class="bi bi-clock-history"></i>
                                Historial de Stock - <?php echo e($productCode); ?>

                            </h5>
                            <small class="text-muted">
                                <strong>Código:</strong> <?php echo e($productCode); ?> &mdash;
                                <strong>Nombre:</strong> <?php echo e($productName); ?>

                            </small>
                        </div>
                        <a href="<?php echo e(route('stockDetails.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="card-body">

                        <?php
                            $totalDisponible = $details->sum('product_quantity');
                            $totalDespachado = $details->sum('product_quantity_expedition');
                            $totalRegistros = $details->total();
                        ?>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-success"><?php echo e($totalDisponible); ?></div>
                                    <div class="text-muted small">Cantidad Disponible</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-warning"><?php echo e($totalDespachado); ?></div>
                                    <div class="text-muted small">Cantidad Despachada</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-secondary"><?php echo e($totalRegistros); ?></div>
                                    <div class="text-muted small">Total de Registros</div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha Esterilización</th>
                                        <th class="text-center">Fecha Ingreso</th>
                                        <th class="text-center">Tipo Embalaje</th>
                                        <th class="text-center">Cantidad Disponible</th>
                                        <th class="text-center">Cantidad Despachada</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Vencimiento</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-center text-muted small"><?php echo e($detail->id); ?></td>
                                            <td class="text-center">
                                                <?php echo e($detail->product_date_sterilized ?? '-'); ?>

                                            </td>
                                            <td class="text-center">
                                                <?php echo e(\Carbon\Carbon::parse($detail->created_at)->format('d M, Y H:i:s')); ?>

                                            </td>
                                            <td class="text-center"><?php echo e($detail->product_package_wrap ?? '-'); ?></td>
                                            <td class="text-center fw-bold">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($detail->product_quantity == 0): ?>
                                                    <span class="badge bg-secondary">0</span>
                                                <?php elseif($detail->product_quantity <= 2): ?>
                                                    <span class="badge bg-warning text-dark"><?php echo e($detail->product_quantity); ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-success"><?php echo e($detail->product_quantity); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info text-dark"><?php echo e($detail->product_quantity_expedition ?? 0); ?></span>
                                            </td>
                                            <td class="text-center"><?php echo e($detail->product_area ?? '-'); ?></td>
                                            <td class="text-center"><?php echo e($detail->product_expiration ?? '-'); ?></td>
                                            <td class="text-center">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($detail->product_status_stock == 'Disponible'): ?>
                                                    <span class="badge bg-success">Disponible</span>
                                                <?php elseif($detail->product_status_stock == 'Despachado'): ?>
                                                    <span class="badge bg-warning text-dark">Despachado</span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-dark"><?php echo e($detail->product_status_stock ?? '-'); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                No hay registros para este código.
                                            </td>
                                        </tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <?php echo e($details->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Stock/Resources/views/stockDetails/code-history.blade.php ENDPATH**/ ?>