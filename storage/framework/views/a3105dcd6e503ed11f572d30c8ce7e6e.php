<?php if($data->product_state_preparation == 'Disponible'): ?>
    <span class="badge badge-success">
        <?php echo e($data->product_coming_zone); ?>

    </span>
<?php elseif($data->product_state_preparation == 'Procesado'): ?>
    <span class="badge badge-dark">
        <?php echo e($data->product_coming_zone); ?> </span>
<?php elseif($data->product_state_preparation == 'Cargado'): ?>
    <span class="badge badge-light">
        <?php echo e($data->product_coming_zone); ?> </span>
        <?php elseif($data->product_state_preparation == 'En Curso'): ?>
    <span class="badge badge-secondary">
        <?php echo e($data->product_coming_zone); ?> </span>
<?php elseif($data->product_state_preparation == 'Reprocesar'): ?>
    <span class="badge badge-warning">
        <?php echo e($data->product_coming_zone); ?> </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Preparation/Resources/views/partials/product_coming_zone.blade.php ENDPATH**/ ?>