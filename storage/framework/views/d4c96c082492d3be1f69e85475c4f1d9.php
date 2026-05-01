<?php if($data->lavadoDetalles->isEmpty()): ?>
    <span class="text-muted">-</span>
<?php else: ?>
    <button type="button" class="btn btn-sm btn-outline-secondary"
        data-toggle="collapse" data-target="#detalles-<?php echo e($data->id); ?>">
        <i class="bi bi-list-ul"></i> <?php echo e($data->lavadoDetalles->count()); ?> ítem(s)
    </button>
    <div id="detalles-<?php echo e($data->id); ?>" class="collapse mt-1 text-left">
        <ul class="list-unstyled mb-0 small">
            <?php $__currentLoopData = $data->lavadoDetalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <strong><?php echo e($detalle->product_code); ?></strong> - <?php echo e($detalle->product_name); ?>

                    <span class="badge badge-light border">x<?php echo e($detalle->product_quantity); ?></span>
                    <?php if($detalle->product_patient): ?>
                        <span class="text-muted"> | <?php echo e($detalle->product_patient); ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Lavado/Resources/views/partials/detalles.blade.php ENDPATH**/ ?>