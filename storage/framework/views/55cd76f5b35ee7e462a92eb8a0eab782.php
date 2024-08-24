

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_expeditions')): ?>
    <?php if($data->status_expedition == 'Despachado'): ?> 
    <a href="<?php echo e(route('expeditions.pdf', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir
    </a>
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_expeditions')): ?>
    <a href="<?php echo e(route('expeditions.edit', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar 
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_expeditions')): ?>
        <a href="<?php echo e(route('expeditions.show', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
        </a>
   
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_expeditions')): ?>
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy<?php echo e($data->id); ?>').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('expeditions.destroy', $data->id)); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </button>
<?php endif; ?>

<?php /**PATH /var/www/html/Modules/Expedition/Resources/views/partials/actions.blade.php ENDPATH**/ ?>