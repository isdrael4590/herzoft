
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
           @change="$wire.setAndUpdateQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>, qty)"
           id="qty-<?php echo e($cart_item->id); ?>"
           type="number"
           style="min-width: 60px; max-width: 90px; text-align: center;"
           class="form-control"
           min="1"
           <?php if($cart_instance == 'labelqr' || $cart_instance == 'labelqrhpo'): ?>
               <?php
                   $stockValue = isset($check_quantity[$cart_item->id])
                       ? (is_array($check_quantity[$cart_item->id])
                           ? (int)implode('', $check_quantity[$cart_item->id])
                           : (int)$check_quantity[$cart_item->id])
                       : 999;
               ?>
               max="<?php echo e($stockValue); ?>"
           <?php endif; ?>>

    
    <div class="input-group-append">
        <button type="button"
                @click.prevent="qty++; $wire.incrementQuantity('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
                class="btn btn-outline-success btn-sm"
                <?php if($cart_instance == 'labelqr' || $cart_instance == 'labelqrhpo'): ?>
                    :disabled="qty >= <?php echo e($stockValue ?? 999); ?>"
                    title="Stock disponible: <?php echo e($stockValue ?? 999); ?>"
                <?php endif; ?>>
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>

<!--[if BLOCK]><![endif]--><?php if($cart_instance == 'labelqr' || $cart_instance == 'labelqrhpo'): ?>
    <?php
        $availableStock = isset($check_quantity[$cart_item->id])
            ? (is_array($check_quantity[$cart_item->id])
                ? (int)implode('', $check_quantity[$cart_item->id])
                : (int)$check_quantity[$cart_item->id])
            : 0;
    ?>
    <small class="text-muted d-block text-center mt-1">
        <i class="bi bi-archive"></i> Stock: <strong><?php echo e($availableStock); ?></strong>
    </small>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH /var/www/html/resources/views/livewire/includes/product-carttoQR-quantity.blade.php ENDPATH**/ ?>