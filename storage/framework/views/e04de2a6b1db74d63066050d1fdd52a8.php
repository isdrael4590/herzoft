<?php $__currentLoopData = $data->getPermissionNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="badge badge-primary"><?php echo e($permission); ?></span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<a class="text-primary" href="<?php echo e(route('roles.edit', $data->id)); ?>">.......</a>
<?php /**PATH /var/www/html/Modules/User/Resources/views/roles/partials/permissions.blade.php ENDPATH**/ ?>