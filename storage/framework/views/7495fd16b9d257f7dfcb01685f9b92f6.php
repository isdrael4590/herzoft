<a href="<?php echo e(route('descarga-lavado.show', $data->id)); ?>" class="dropdown-item">
    <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
</a>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_wash_area')): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!in_array($data->status_ciclo, ['Ciclo Correcto', 'Ciclo con Falla'])): ?>
        <a href="<?php echo e(route('descarga-lavado.edit', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Liberar Lavado
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
    <a href="<?php echo e(route('descarga-lavado.edit', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-clock-history mr-2 text-secondary" style="line-height: 1;"></i> Editar Admin
    </a>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_reception_preparations')): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status_ciclo === 'Ciclo Correcto' && $data->status_indicador !== 'Falla' && $data->status !== 'Procesado'): ?>
        <a href="<?php echo e(route('lavado-preparations.create', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-arrow-right-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a Preparación
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?>

<button class="dropdown-item"
    onclick="
        event.preventDefault();
        if (confirm('¿Está seguro? Desea eliminar permanentemente esta descarga.')) {
            document.getElementById('destroy-des<?php echo e($data->id); ?>').submit()
        }">
    <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
    <form id="destroy-des<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('descarga-lavado.destroy', $data->id)); ?>"
        method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>
</button>
<?php /**PATH /var/www/html/Modules/Lavado/Resources/views/descarga-lavado/partials/actions.blade.php ENDPATH**/ ?>