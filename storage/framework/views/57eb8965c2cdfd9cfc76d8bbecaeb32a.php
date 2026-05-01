<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_products')): ?>
    <a href="<?php echo e(route('instrumental.edit', $data->id)); ?>" class="btn btn-info btn-sm" title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_products')): ?>
    <a href="<?php echo e(route('instrumental.show', $data->id)); ?>" class="btn btn-primary btn-sm" title="Ver detalles">
        <i class="bi bi-eye"></i>
    </a>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_products')): ?>
    <?php if(is_null($data->product_id)): ?>
        
        <button 
            id="delete" 
            class="btn btn-danger btn-sm" 
            title="Eliminar instrumental"
            onclick="
                event.preventDefault();
                if (confirm('¿Está seguro de eliminar este instrumental?\n\nCódigo: <?php echo e($data->codigo_unico_ud); ?>\nNombre: <?php echo e($data->nombre_generico); ?>\n\n⚠️ Esta acción es permanente y no se puede deshacer.')) {
                    document.getElementById('destroy<?php echo e($data->id); ?>').submit()
                }
            ">
            <i class="bi bi-trash"></i>
        </button>
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('instrumental.destroy', $data->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    <?php else: ?>
        
        <button 
            class="btn btn-secondary btn-sm" 
            title="🔒 Bloqueado: Este instrumental está asignado al paquete '<?php echo e($data->product->product_name ?? 'Desconocido'); ?>'. Para eliminarlo, primero debe removerlo del paquete."
            disabled
            data-bs-toggle="tooltip"
            data-bs-placement="left"
            data-bs-html="true"
            data-bs-title="<strong>🔒 No se puede eliminar</strong><br><br>Este instrumental está asignado al paquete:<br><em><?php echo e($data->product->product_name ?? 'Desconocido'); ?></em><br><br>Para eliminarlo, primero debe:<br>1. Editar el paquete<br>2. Remover este instrumental<br>3. Guardar cambios">
            <i class="bi bi-lock-fill"></i>
        </button>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/instrumental/partials/actions.blade.php ENDPATH**/ ?>