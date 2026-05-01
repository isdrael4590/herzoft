<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_user_management')): ?>
    <a href="<?php echo e(route('users.edit', $data->id)); ?>" class="btn btn-info btn-sm" title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_user_management')): ?>
    <button class="btn btn-danger btn-sm" title="Eliminar"
        onclick="event.preventDefault();
        if (confirm('¿Está seguro de que desea eliminar este usuario? Esta acción no se puede deshacer.')) {
            document.getElementById('destroy<?php echo e($data->id); ?>').submit();
        }">
        <i class="bi bi-trash"></i>
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('users.destroy', $data->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </button>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/User/Resources/views/users/partials/actions.blade.php ENDPATH**/ ?>