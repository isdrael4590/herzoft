<?php if($data->status === 'Procesado'): ?>
    <span class="badge badge-success"><?php echo e($data->status); ?></span>
<?php elseif($data->status === 'Pendiente'): ?>
    <span class="badge badge-warning"><?php echo e($data->status); ?></span>
<?php elseif($data->status === 'Registrado'): ?>
    <span class="badge badge-info"><?php echo e($data->status); ?></span>
<?php else: ?>
    <span class="badge badge-secondary"><?php echo e($data->status); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Lavado/Resources/views/partials/status.blade.php ENDPATH**/ ?>