<?php if($data->validation_vacuum == 'Falla'): ?>
    <span class="badge badge-danger">
        <?php echo e($data->validation_vacuum); ?>

    </span>
<?php else: ?>
    <span class="badge badge-success">
        <?php echo e($data->validation_vacuum); ?>

    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testvacuums/partials/validation_vacuum.blade.php ENDPATH**/ ?>