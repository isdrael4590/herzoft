<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Prelavado - Ingreso #<?php echo e($reception->id); ?> (<?php echo e($reception->reference); ?>)</h3>
                    <a href="<?php echo e(route('prelavado.index')); ?>" class="btn btn-sm btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Paciente</th>
                                <th>Área</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($detalle->product_code); ?></td>
                                    <td><?php echo e($detalle->product_name); ?></td>
                                    <td><?php echo e($detalle->product_quantity); ?></td>
                                    <td><?php echo e($detalle->product_patient ?? '-'); ?></td>
                                    <td><?php echo e($detalle->product_area ?? '-'); ?></td>
                                    <td><?php echo e($detalle->product_info ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Sin productos.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/prelavado/show.blade.php ENDPATH**/ ?>