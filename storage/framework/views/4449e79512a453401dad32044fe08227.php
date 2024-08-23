

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_discharges')): ?>
    <?php if($data->ruta_process == 'Sin Ruta'): ?>
        <?php if($data->machine_type == 'Autoclave'): ?>
            <a href="<?php echo e(route('discharges.edit', $data->id)); ?>" class="dropdown-item">
                <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Liberar STEAM
            </a>
        <?php elseif($data->machine_type == 'Peroxido'): ?>
            <a href="<?php echo e(route('discharges.edit', $data->id)); ?>" class="dropdown-item">
                <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Liberar HPO
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_discharges')): ?>
    <?php if(($data->status_cycle == 'Ciclo Aprobado') | ($data->status_cycle == 'Ciclo Falla')): ?>
        <a href="<?php echo e(route('discharges.show', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
        </a>
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_discharges')): ?>
    <?php if(($data->status_cycle == 'Ciclo Aprobado') | ($data->status_cycle == 'Ciclo Falla')): ?>
        <a href="<?php echo e(route('discharges.pdf', $data->id)); ?>" class="dropdown-item">
            <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir
        </a>
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_discharges_stock')): ?>
    <?php if($data->ruta_process != 'Almacenado'): ?>
        <?php if(($data->status_cycle == 'Ciclo Aprobado') & ($data->validation_biologic == 'Correcto')): ?>
            <a href="<?php echo e(route('discharges-stock.create', $data)); ?>" class="dropdown-item">
                <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a Almacén.
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_discharges')): ?>
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy<?php echo e($data->id); ?>').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy<?php echo e($data->id); ?>" class="d-none" action="<?php echo e(route('discharges.destroy', $data->id)); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </button>
<?php endif; ?>



<?php /**PATH /var/www/html/Modules/Discharge/Resources/views/partials/actions.blade.php ENDPATH**/ ?>