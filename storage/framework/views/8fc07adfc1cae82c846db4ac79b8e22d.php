<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->validation_vacuum == 'Falla'): ?>
    <span class="badge badge-danger">
        <?php echo e($data->validation_vacuum); ?>

    </span>
<?php else: ?>
    <span class="badge badge-success">
        <?php echo e($data->validation_vacuum); ?>

    </span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testvacuums/partials/validation_vacuum.blade.php ENDPATH**/ ?>