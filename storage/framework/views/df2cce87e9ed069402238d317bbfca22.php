<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status_indicador === 'Correcto'): ?>
    <span class="badge" style="background:#16a34a;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;"><?php echo e($data->status_indicador); ?></span>
<?php elseif($data->status_indicador === 'Sin Validar'): ?>
    <span class="badge" style="background:#6366f1;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;"><?php echo e($data->status_indicador); ?></span>
<?php elseif($data->status_indicador === 'Falla'): ?>
    <span class="badge" style="background:#dc2626;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;"><?php echo e($data->status_indicador); ?></span>
<?php else: ?>
    <span class="badge" style="background:#64748b;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;"><?php echo e($data->status_indicador); ?></span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/Modules/Lavado/Resources/views/partials/status_indicador.blade.php ENDPATH**/ ?>