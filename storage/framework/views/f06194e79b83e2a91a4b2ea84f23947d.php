<?php $__env->startSection('title', 'Historial de Reseteos'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('preparationDetails.index')); ?>">Preparación</a></li>
        <li class="breadcrumb-item active">Historial de Reseteos</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Historial de Reseteos de Cantidades</h3>
                        <div class="card-tools">
                            <a href="<?php echo e(route('preparationDetails.index')); ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha y Hora</th>
                                        <th>Usuario</th>
                                        <th>Producto</th>
                                        <th>Código</th>
                                        <th>Área</th>
                                        <th>Cantidad Anterior</th>
                                        <th>Nueva Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $resets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($reset->reset_at->format('d/m/Y H:i:s')); ?></td>
                                            <td><?php echo e($reset->user->name); ?></td>
                                            <td><?php echo e($reset->product_name); ?></td>
                                            <td><?php echo e($reset->product_code); ?></td>
                                            <td><?php echo e($reset->product_area); ?></td>
                                            <td><span class="badge badge-warning"><?php echo e($reset->previous_quantity); ?></span></td>
                                            <td><span class="badge badge-success"><?php echo e($reset->new_quantity); ?></span></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No hay registros de reseteos</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            <?php echo e($resets->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Preparation/Resources/views/preparationDetails/reset-history.blade.php ENDPATH**/ ?>