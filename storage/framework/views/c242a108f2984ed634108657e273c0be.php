<?php if($data->status == 'Pendiente'): ?>
    <span class="badge badge-info">
        <?php echo e($data->reference); ?>

    </span>
<?php elseif($data->status == 'Registrado'): ?>
    <span class="badge badge-success">
        <?php echo e($data->reference); ?>

    </span>
<?php elseif($data->status == 'Procesado'): ?>
    <span class="badge badge-secondary">
        <?php echo e($data->reference); ?>

    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Reception/Resources/views/partials/reference.blade.php ENDPATH**/ ?>