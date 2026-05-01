<?php $__env->startSection('title', 'Historial - ' . $productCode); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('preparationDetails.index')); ?>">Preparación</a></li>
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
                                Historial de Paquetes - <?php echo e($productCode); ?>

                            </h5>
                            <small class="text-muted">
                                <strong>Código:</strong> <?php echo e($productCode); ?> &mdash;
                                <strong>Nombre:</strong> <?php echo e($productName); ?>

                            </small>
                        </div>
                        <a href="<?php echo e(route('preparationDetails.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="card-body">

                        
                        <?php
                            $totalActual = $details->sum('product_quantity');
                            $totalRegistros = $details->total();
                        ?>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card border-0 bg-light text-center py-3">
                                    <div class="fs-3 fw-bold text-primary"><?php echo e($totalActual); ?></div>
                                    <div class="text-muted small">Cantidad Total Actual</div>
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
                                        <th class="text-center">Fecha de Ingreso</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Proveniente</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo de Proceso</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Casa Comercial</th>
                                        <th class="text-center">Info</th>
                                        <th class="text-center">Paciente</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
                                            <th class="text-center">Referencia</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-center text-muted small"><?php echo e($detail->id); ?></td>
                                            <td class="text-center">
                                                <?php echo e(\Carbon\Carbon::parse($detail->created_at)->format('d M, Y H:i:s')); ?>

                                            </td>
                                            <td class="text-center fw-bold">
                                                <?php if($detail->product_quantity == 0): ?>
                                                    <span class="badge bg-secondary">0</span>
                                                <?php elseif($detail->product_quantity <= 2): ?>
                                                    <span class="badge bg-warning text-dark"><?php echo e($detail->product_quantity); ?></span>
                                                <?php elseif($detail->product_quantity <= 4): ?>
                                                    <span class="badge bg-primary"><?php echo e($detail->product_quantity); ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-success"><?php echo e($detail->product_quantity); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($detail->product_coming_zone == 'Recepcion'): ?>
                                                    <span class="badge bg-success"><?php echo e($detail->product_coming_zone); ?></span>
                                                <?php elseif($detail->product_coming_zone == 'Lavado'): ?>
                                                    <span class="badge bg-info text-dark"><?php echo e($detail->product_coming_zone); ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?php echo e($detail->product_coming_zone); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo e($detail->product_area ?? '-'); ?></td>
                                            <td class="text-center"><?php echo e($detail->product_type_process ?? '-'); ?></td>
                                            <td class="text-center">
                                                <?php $state = $detail->product_state_preparation; ?>
                                                <?php if($state == 'Disponible'): ?>
                                                    <span class="badge bg-success"><?php echo e($state); ?></span>
                                                <?php elseif($state == 'En Curso'): ?>
                                                    <span class="badge bg-warning text-dark"><?php echo e($state); ?></span>
                                                <?php elseif($state == 'Procesado'): ?>
                                                    <span class="badge bg-secondary"><?php echo e($state); ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-dark"><?php echo e($state ?? '-'); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center small">
                                                <?php echo e($detail->product_outside_company ?? '-'); ?>

                                            </td>
                                            <td class="text-center small">
                                                <?php echo e($detail->product_info ?? '-'); ?>

                                            </td>
                                            <td class="text-center small">
                                                <?php echo e($detail->product_patient ?? '-'); ?>

                                            </td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
                                                <td class="text-center small">
                                                    <?php if($detail->preparation): ?>
                                                        <a href="<?php echo e(route('preparations.show', $detail->preparation_id)); ?>">
                                                            <?php echo e($detail->preparation->reference ?? $detail->preparation_id); ?>

                                                        </a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="11" class="text-center text-muted py-4">
                                                No hay registros para este código.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Preparation/Resources/views/preparationDetails/code-history.blade.php ENDPATH**/ ?>