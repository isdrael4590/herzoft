<div class="d-inline-block">
<select wire:model.live="package_wrap.<?php echo e($cart_item->id); ?>"
wire:change="setProductoptions('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
class="form-control form-control-sm" style="min-width: 150px;">
<option value="Papel Tyvek"> Papel Tyvek </option>
<option value="Tela Tejida"> Tela Tejida (SMS)</option>
</select>
</div><?php /**PATH /var/www/html/resources/views/livewire/includes/product-cart-modaltoQRHPO.blade.php ENDPATH**/ ?>