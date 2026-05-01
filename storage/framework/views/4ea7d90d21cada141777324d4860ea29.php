<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->validation_bd == 'Falla'): ?>
    <span class="badge badge-danger">
        <?php echo e($data->validation_bd); ?>

    </span>
<?php else: ?>
    <span class="badge badge-success">
        <?php echo e($data->validation_bd); ?>

    </span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testbds/partials/validation_bd.blade.php ENDPATH**/ ?>