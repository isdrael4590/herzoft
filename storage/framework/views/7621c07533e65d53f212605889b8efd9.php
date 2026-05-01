<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->descargaLavadoDetalles->isEmpty()): ?>
    <span class="text-muted">-</span>
<?php else: ?>
    <button type="button" class="btn btn-sm btn-outline-secondary"
        data-toggle="collapse" data-target="#des-detalles-<?php echo e($data->id); ?>">
        <i class="bi bi-list-ul"></i> <?php echo e($data->descargaLavadoDetalles->count()); ?> ítem(s)
    </button>
    <div id="des-detalles-<?php echo e($data->id); ?>" class="collapse mt-1 text-left">
        <ul class="list-unstyled mb-0 small">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data->descargaLavadoDetalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <strong><?php echo e($detalle->product_code); ?></strong> - <?php echo e($detalle->product_name); ?>

                    <span class="badge badge-light border">x<?php echo e($detalle->product_quantity); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($detalle->product_patient): ?>
                        <span class="text-muted"> | <?php echo e($detalle->product_patient); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/Modules/Lavado/Resources/views/descarga-lavado/partials/detalles.blade.php ENDPATH**/ ?>