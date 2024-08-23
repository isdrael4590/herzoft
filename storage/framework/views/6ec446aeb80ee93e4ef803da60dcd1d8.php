
        
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_labelqr_discharges')): ?>
    <?php if($data->status_cycle == 'Cargar'): ?>
        <a href="<?php echo e(route('labelqr-discharges.create', $data)); ?>" class="dropdown-item">
            <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar Proceso.
        </a>
    <?php endif; ?>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_labelqrs')): ?>

    <?php if(($data->status_cycle == 'Cargar' || $data->status_cycle == 'Pendiente' ) & ($data->machine_type == 'Autoclave')): ?>
        <a href="<?php echo e(route('labelqrs.edit', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar STEAM
        </a>
       <?php elseif(($data->status_cycle == 'Cargar' || $data->status_cycle == 'Pendiente' )& ($data->machine_type == 'Peroxido')): ?>
        <a href="<?php echo e(route('labelqrs.edit', [($data->id)])); ?>" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar HPO
        </a>
      
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_labelqrs')): ?>
    <a href="<?php echo e(route('labelqrs.show', $data->id)); ?>" class="dropdown-item">
        <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_labelqrs')): ?>
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Esta Seguro?.  Desea Eliminar Permanente el proceso!!')) {
                document.getElementById('destroy<?php echo e($data->id); ?>').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('labelqrs.destroy', $data->id)); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </button>
<?php endif; ?>

<?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/partials/actions.blade.php ENDPATH**/ ?>