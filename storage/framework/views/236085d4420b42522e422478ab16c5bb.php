
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_admin')): ?>
    <a href="<?php echo e(route('receptions.pdf', $data->id)); ?>" class="dropdown-item">
        <i target="_blank" class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir
    </a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_receptionsticket')): ?>
        <a href="<?php echo e(route('receptiontickets.pdf', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir Ticket
        </a>
    <?php endif; ?>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_receptions')): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status != 'Procesado'): ?>
        <a href="<?php echo e(route('receptions.edit', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar Operario
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_admin')): ?>
    <a href="<?php echo e(route('receptions.edit', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar Admin
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_receptions')): ?>
    <a href="<?php echo e(route('receptions.show', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_reception_preparations')): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data->status == 'Registrado'): ?>
        <a href="<?php echo e(route('reception-preparations.create', $data)); ?>" class="dropdown-item">
            <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a ZNE Preparación.
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_receptions')): ?>
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy<?php echo e($data->id); ?>').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('receptions.destroy', $data->id)); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </button>
<?php endif; ?>

<?php /**PATH /var/www/html/Modules/Reception/Resources/views/partials/actions.blade.php ENDPATH**/ ?>