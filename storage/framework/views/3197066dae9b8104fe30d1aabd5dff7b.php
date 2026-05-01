<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span
        wire:click="$dispatch('OutputWrap_packageRefresh', { product_id: <?php echo e($cart_item->id); ?>, row_id: '<?php echo e($cart_item->rowId); ?>' })"
        role="button" class="badge badge-warning pointer-event" data-toggle="modal"
        data-target="#OutputWrap_package<?php echo e($cart_item->id); ?>">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="OutputWrap_package<?php echo e($cart_item->id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="OutputWrap_packageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OutputWrap_packageLabel">
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
                    <!--[if BLOCK]><![endif]--><?php if(session()->has('message_OutputWrap_package' . $cart_item->id)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span><?php echo e(session('message_OutputWrap_package' . $cart_item->id)); ?></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <div class="form-group">
                        <label>Validación del Embalaje e Ind. Químico <span class="text-danger">*</span></label>
                        <select wire:model.live="eval_package.<?php echo e($cart_item->id); ?>" class="form-control" required>
                            <option selected value="OK"> OK</option>
                            <option value="NO"> NO </option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setProductoptions('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
                        type="button" class="btn btn-primary">Guardar Validación</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/includes/product-cart-modaltoDES.blade.php ENDPATH**/ ?>