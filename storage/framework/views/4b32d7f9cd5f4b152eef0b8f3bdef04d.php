<?php $__env->startSection('title', 'Historial de Reseteos - Stock'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('stockDetails.index')); ?>">Disponibilidad Stock</a></li>
        <li class="breadcrumb-item active">Historial de Reseteos</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-history"></i> Historial de Reseteos de Stock
                        </h5>
                        <a href="<?php echo e(route('stockDetails.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Fecha Reset</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Nombre del Producto</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Embalaje</th>
                                        <th class="text-center">Cant. Anterior</th>
                                        <th class="text-center">Cant. Nueva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $resets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo e(\Carbon\Carbon::parse($reset->reset_at)->format('d M, Y H:i:s')); ?>

                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">
                                                    <i class="bi bi-person-fill"></i>
                                                    <?php echo e(optional($reset->user)->name ?? 'N/A'); ?>

                                                </span>
                                            </td>
                                            <td class="text-center"><?php echo e($reset->product_name); ?></td>
                                            <td class="text-center"><code><?php echo e($reset->product_code); ?></code></td>
                                            <td class="text-center"><?php echo e($reset->product_area ?? '-'); ?></td>
                                            <td class="text-center"><?php echo e($reset->product_package_wrap ?? '-'); ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark"><?php echo e($reset->previous_quantity); ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary"><?php echo e($reset->new_quantity); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                No hay historial de reseteos registrado.
                                            </td>
                                        </tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <?php echo e($resets->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Stock/Resources/views/stockDetails/reset-history.blade.php ENDPATH**/ ?>