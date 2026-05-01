<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_admin')): ?>
    <a href="<?php echo e(route('dischargeDetails.edit', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
    </a>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_admin')): ?>
    <button id="delete" class="dropdown-item"
        onclick="
    event.preventDefault();
    if (confirm('Are you sure? It will delete the data permanently!')) {
    document.getElementById('destroy<?php echo e($data->id); ?>').submit()
    }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('dischargeDetails.destroy', $data->id)); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </button>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Discharge/Resources/views/partials/actionDetails.blade.php ENDPATH**/ ?>