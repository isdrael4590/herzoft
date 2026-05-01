<?php $__currentLoopData = $data->getPermissionNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="badge badge-light border mr-1 mb-1"
        style="font-size:.72rem;padding:4px 8px;border-radius:20px;color:#4f46e5;border-color:#c7d2fe !important;background:#eef2ff;">
        <i class="bi bi-key mr-1" style="font-size:.65rem;"></i><?php echo e($permission); ?>

    </span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_roles')): ?>
    <a class="btn btn-outline-primary btn-sm ml-1" href="<?php echo e(route('roles.edit', $data->id)); ?>" title="Editar permisos"
        style="border-radius:6px;font-size:.75rem;padding:2px 8px;">
        <i class="bi bi-pencil"></i>
    </a>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/User/Resources/views/roles/partials/permissions.blade.php ENDPATH**/ ?>