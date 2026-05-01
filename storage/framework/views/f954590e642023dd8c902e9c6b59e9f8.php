
<div class="input-group d-flex justify-content-center"
     x-data="{ qty: <?php echo e($cart_item->qty); ?> }"
     @qty-confirmed-<?php echo e($cart_item->id); ?>.window="qty = $event.detail.qty">

    
    <div class="input-group-prepend">
        <button type="button"
                @click.prevent="if (qty > 1) { qty--; $wire.decrementQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>) }"
                class="btn btn-outline-danger btn-sm"
                :disabled="qty <= 1">
            <i class="bi bi-dash"></i>
        </button>
    </div>

    
    <input x-model.number="qty"
           @keydown.enter.prevent="$wire.setAndUpdateQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>, qty)"
           id="qty-<?php echo e($cart_item->id); ?>"
           type="number"
           style="min-width: 60px; max-width: 90px; text-align: center;"
           class="form-control"
           min="1">

    
    <div class="input-group-append">
        <button type="button"
                @click.prevent="qty++; $wire.incrementQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
                class="btn btn-outline-success btn-sm">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/includes/product-cart-quantity.blade.php ENDPATH**/ ?>