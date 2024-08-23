<?php if($data->product_status_stock == 'Disponible'): ?>
    <span class="badge badge-success">
        <?php echo e($data->product_status_stock); ?>

    </span>
<?php elseif($data->product_status_stock == 'Despachado'): ?>
    <span class="badge badge-info">
        <?php echo e($data->product_status_stock); ?>    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Stock/Resources/views/partials/status_stock.blade.php ENDPATH**/ ?>