<?php if($data->validation_biologic == 'Falla'): ?>
    <span class="badge badge-danger">
        <?php echo e($data->validation_biologic); ?>

    </span>
<?php elseif($data->validation_biologic == 'Correcto'): ?>
    <span class="badge badge-success">
        <?php echo e($data->validation_biologic); ?>

    </span>
    <?php else: ?>
    <span class="badge badge-info">
        <?php echo e($data->validation_biologic); ?>

    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Discharge/Resources/views/partials/validation_biologic.blade.php ENDPATH**/ ?>