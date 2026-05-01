

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_preparations')): ?>
            <a href="<?php echo e(route('preparationDetails.edit', $data->id)); ?>" class="dropdown-item">
                <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
            </a>
        <?php endif; ?>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_preparations')): ?>
            <button id="delete" class="dropdown-item" onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy<?php echo e($data->id); ?>').submit()
                }">
                <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
                <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('preparationDetails.destroy', $data->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                </form>
            </button>
        <?php endif; ?>
<?php /**PATH /var/www/html/Modules/Preparation/Resources/views/partials/actions2.blade.php ENDPATH**/ ?>