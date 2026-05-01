<div class="input-group d-flex justify-content-center">
    <!-- Botón decrementar -->
    <div class="input-group-prepend">
        <button type="button" wire:click="decrementQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
            class="btn btn-outline-danger btn-sm" <?php echo e($cart_item->qty <= 1 ? 'disabled' : ''); ?>>
            <i class="bi bi-dash"></i>
        </button>
    </div>
    <!-- Input de cantidad -->
    <input wire:model.live="quantity.<?php echo e($cart_item->id); ?>"
        wire:change="updateQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
        style="min-width: 60px; max-width: 90px; text-align: center;" class="form-control" value="<?php echo e($cart_item->qty); ?>"
        min="1"
        <?php if($cart_instance == 'discharge'): ?> <?php
$stockValue = isset($check_quantity[$cart_item->id]) 
? (is_array($check_quantity[$cart_item->id]) 
? implode('', $check_quantity[$cart_item->id]) 
: $check_quantity[$cart_item->id])
: 999;
?>
max="<?php echo e($stockValue); ?>" <?php endif; ?>>
    <!-- Botón incrementar -->
    <div class="input-group-append">
        <button type="button" wire:click="incrementQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
            class="btn btn-outline-success btn-sm"
            <?php if($cart_instance == 'discharge'): ?> <?php
$availableStock = isset($check_quantity[$cart_item->id])
? (is_array($check_quantity[$cart_item->id])
? (int)implode('', $check_quantity[$cart_item->id])
: (int)$check_quantity[$cart_item->id])
: 999;
?>
<?php echo e($cart_item->qty >= $availableStock ? 'disabled' : ''); ?>

title="Stock disponible: <?php echo e($availableStock); ?>" <?php endif; ?>>
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>


<?php /**PATH /var/www/html/resources/views/livewire/includes/product-carttoDES-quantity.blade.php ENDPATH**/ ?>