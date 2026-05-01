<!-- REEMPLAZO COMPLETO: Cambia todo el div original por este select -->
<div class="d-inline-block">
    <select wire:model.live="package_wrap.<?php echo e($cart_item->id); ?>"
        wire:change="setProductoptions('<?php echo e($cart_item->rowId); ?>', <?php echo e($cart_item->id); ?>)"
        class="form-control form-control-sm" style="min-width: 150px;">
        <option value="Tela Tejida">Tela Tejida (SMS)</option>
        <option value="Contenedor">Contenedor Rígido</option>
        <option value="Papel Mixto">Papel Mixto</option>
        <option value="Tela No Tejida">Tela No Tejida</option>
    </select>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/includes/product-cart-modaltoQR.blade.php ENDPATH**/ ?>