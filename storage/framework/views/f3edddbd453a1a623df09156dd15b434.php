<?php if($data->status_cycle == 'En Curso'): ?>
    <span class="badge badge-info">
        <?php echo e($data->status_cycle); ?>

    </span>
<?php elseif($data->status_cycle == 'Pendiente'): ?>
    <span class="badge badge-dark">
        <?php echo e($data->status_cycle); ?>

    </span>
<?php elseif($data->status_cycle == 'Ciclo Aprobado'): ?>
    <span class="badge badge-success">
        Ciclo Aprobado
    </span>
<?php elseif($data->status_cycle == 'Ciclo Falla'): ?>
    <span class="badge badge-danger">
        Ciclo Falla    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Discharge/Resources/views/partials/status_cycle.blade.php ENDPATH**/ ?>