<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span wire:click="$dispatch('inputPreparationRefresh', { product_id: <?php echo e($cart_item->id); ?>, row_id: '<?php echo e($cart_item->rowId); ?>' })" role="button" class="badge badge-warning pointer-event" data-toggle="modal" data-target="#inputPreparation<?php echo e($cart_item->id); ?>">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="inputPreparation<?php echo e($cart_item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="inputPreparationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputPreparationLabel">
                        <?php echo e($cart_item->name); ?>

                        <br>
                        <span class="badge badge-success">
                        <?php echo e($cart_item->options->code); ?>

                    </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--[if BLOCK]><![endif]--><?php if(session()->has('message_inputPreparation' . $cart_item->id)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span><?php echo e(session('message_inputPreparation' . $cart_item->id)); ?></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                  
                    <div class="form-group">
                        <label>Estado de Preparación <span class="text-danger">*</span></label>
                        <select wire:model.live="state_preparation.<?php echo e($cart_item->id); ?>" class="form-control" required>
                            <option value="Procesado">Procesado</option>
                            <option value="Disponible">Disponible</option>
                            <option value="Reprocesar">Reprocesar</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setProductoptions('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)" type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/includes/product-cart-modaltoPRE.blade.php ENDPATH**/ ?>