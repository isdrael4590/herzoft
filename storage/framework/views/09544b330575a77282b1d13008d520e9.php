<?php
    $maxStock = isset($check_quantity[$cart_item->id])
        ? (is_array($check_quantity[$cart_item->id])
            ? (int) implode('', $check_quantity[$cart_item->id])
            : (int) $check_quantity[$cart_item->id])
        : 0;
    $remaining = max(0, $maxStock - $cart_item->qty);
?>


<div class="input-group d-flex justify-content-center"
     x-data="{ qty: <?php echo e($cart_item->qty); ?>, max: <?php echo e($maxStock); ?> }"
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
           @keydown.enter.prevent="qty = Math.min(Math.max(qty, 1), max); $wire.setAndUpdateQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>, qty)"
           id="qty-<?php echo e($cart_item->id); ?>"
           type="number"
           style="min-width: 60px; max-width: 90px; text-align: center;"
           class="form-control"
           min="1"
           :max="max">

    
    <div class="input-group-append">
        <button type="button"
                @click.prevent="if (qty < max) { qty++; $wire.incrementQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>) }"
                class="btn btn-outline-success btn-sm"
                :disabled="qty >= max"
                :title="'Máx. prelavado: ' + max">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>

<small class="d-block text-center mt-1 <?php echo e($remaining === 0 ? 'text-danger' : 'text-muted'); ?>">
    Saldo: <strong><?php echo e($remaining); ?></strong> / <?php echo e($maxStock); ?>

</small>
<?php /**PATH /var/www/html/resources/views/livewire/includes/product-cart-wash-quantity.blade.php ENDPATH**/ ?>