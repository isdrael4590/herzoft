<div>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> <?php echo e(session('message')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Atención!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-box-seam"></i> Paquete de Instrumentales
            </h5>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart_items->count() > 0): ?>
                <button wire:click="clearCart" class="btn btn-sm btn-danger" type="button">
                    <i class="bi bi-trash"></i> Vaciar Paquete
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="card-body">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart_items->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 12%;">Código Único</th>
                                <th style="width: 20%;">Nombre</th>
                                <th style="width: 15%;">Tipo/Familia</th>
                                <th style="width: 15%;">Marca</th>
                                <th style="width: 15%;">Estado</th>
                                <th style="width: 10%;" class="text-center">Cantidad</th>
                                <th style="width: 13%;" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-light"
                                            value="<?php echo e($codigo_unico_ud[$cart_item->id] ?? ''); ?>" readonly />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-light"
                                            value="<?php echo e($nombre_generico[$cart_item->id] ?? ''); ?>" readonly />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-light"
                                            value="<?php echo e($tipo_familia[$cart_item->id] ?? ''); ?>" readonly />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-light"
                                            value="<?php echo e($marca_fabricante[$cart_item->id] ?? ''); ?>" readonly />
                                    </td>
                                    <td class="align-middle"> <select
                                            class="form-select form-select-sm w-100 border-0 shadow-none"
                                            wire:model.live="estado_actual.<?php echo e($cart_item->id); ?>"
                                            style="cursor: pointer; background-color: transparent;" <?php echo e(auth()->user()->roles()->where('id', 1)->exists() ? '' : 'disabled'); ?>>
                                            <option value="DISPONIBLE">DISPONIBLE</option>
                                            <option value="EN USO">EN USO</option>
                                            <option value="EN MANTENIMIENTO">EN MANTENIMIENTO</option>
                                            <option value="BAJA">BAJA</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm text-center bg-light"
                                            value="<?php echo e($quantity[$cart_item->id] ?? 1); ?>" min="1" readonly />
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button class="btn btn-outline-primary"
                                                wire:click="updateInstrumentalData('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
                                                type="button" title="Guardar cambios">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                            <button class="btn btn-outline-danger"
                                                wire:click="removeItem('<?php echo e($cart_item->rowId); ?>')" type="button"
                                                title="Eliminar"
                                                onclick="return confirm('¿Está seguro de eliminar este instrumental del paquete?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="5" class="text-end fw-bold">Total de instrumentales:</td>
                                <td class="text-center fw-bold"><?php echo e($cart_items->count()); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center mb-0" role="alert">
                    <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                    <h5>No hay instrumentales en el paquete</h5>
                    <p class="mb-0 text-muted">Utilice el buscador arriba para agregar instrumentales al paquete.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/instrumental-cart.blade.php ENDPATH**/ ?>