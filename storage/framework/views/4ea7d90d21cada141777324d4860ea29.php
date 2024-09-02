<?php if($data->validation_bd == 'Falla'): ?>
    <span class="badge badge-danger">
        <?php echo e($data->validation_bd); ?>

    </span>
<?php else: ?>
    <span class="badge badge-success">
        <?php echo e($data->validation_bd); ?>

    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testbds/partials/validation_bd.blade.php ENDPATH**/ ?>