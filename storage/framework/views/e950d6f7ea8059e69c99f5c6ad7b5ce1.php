<?php if($data->preparationDetails->count() > 0): ?>
    <div class="small">
        <?php $__currentLoopData = $data->preparationDetails->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-1">
                <code class="me-1"><?php echo e($detail->product_code); ?></code>
                <span class="text-truncate d-inline-block" style="max-width: 150px;">
                    <?php echo e($detail->product_name); ?>

                </span>
                <span class="badge bg-success ms-1"><?php echo e($detail->product_quantity); ?></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($data->preparationDetails->count() > 3): ?>
            <div class="text-muted small">
                <i class="bi bi-three-dots"></i> y <?php echo e($data->preparationDetails->count() - 3); ?> más
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <span class="text-muted small">
        <i class="bi bi-inbox"></i> Sin productos
    </span>
<?php endif; ?><?php /**PATH /var/www/html/Modules/Preparation/Resources/views/partials/products-list.blade.php ENDPATH**/ ?>