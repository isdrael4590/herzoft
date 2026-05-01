<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status_indicador === 'Correcto'): ?>
    <span class="badge badge-success"><?php echo e($data->status_indicador); ?></span>
<?php elseif($data->status_indicador === 'Falla'): ?>
    <span class="badge badge-warning"><?php echo e($data->status_indicador); ?></span>
<?php else: ?>
    <span class="badge badge-secondary"><?php echo e($data->status_indicador); ?></span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/Modules/Lavado/Resources/views/descarga-lavado/partials/status_indicador.blade.php ENDPATH**/ ?>