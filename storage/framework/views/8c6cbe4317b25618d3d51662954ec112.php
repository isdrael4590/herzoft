<span>CREADO</span><br>
<?php echo e($data->created_at->format('d M, Y')); ?> <?php echo e($data->created_at->isoFormat('H:mm:ss A')); ?>

<br>
<?php if( $data->updated_at != $data->created_at): ?>
<span>ACTUALIZADO</span><br>
<?php echo e($data->updated_at->format('d M, Y')); ?> <?php echo e($data->updated_at->isoFormat('H:mm:ss A')); ?>

    
<?php else: ?>
    
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testbds/partials/dates.blade.php ENDPATH**/ ?>