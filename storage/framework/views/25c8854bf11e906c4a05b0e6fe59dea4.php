<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status_expedition == 'Despachado'): ?>
    <span class="badge badge-dark">
        <?php echo e($data->status_expedition); ?>

    </span>
<?php else: ?>
    <span class="badge badge-warning">
        <?php echo e($data->status_expedition); ?>

    </span>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/Modules/Expedition/Resources/views/partials/status_expedition.blade.php ENDPATH**/ ?>