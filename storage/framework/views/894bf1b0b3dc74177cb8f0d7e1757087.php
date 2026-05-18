<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status_expedition == 'Despachado'): ?>
<span>Despachado</span><br>

<?php echo e($data->created_at->format('d M, Y')); ?> <?php echo e($data->created_at->isoFormat('H:mm:ss A')); ?>

<?php else: ?>
<span>Pendiente</span><br>
<?php echo e($data->created_at->format('d M, Y')); ?> <?php echo e($data->created_at->isoFormat('H:mm:ss A')); ?>


<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH /var/www/html/Modules/Expedition/Resources/views/partials/dates.blade.php ENDPATH**/ ?>