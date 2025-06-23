<!-- REEMPLAZO COMPLETO: Cambia todo el div original por este select -->
<div class="d-inline-block">
    <select wire:model.live="package_wrap.{{ $cart_item->id }}"
        wire:change="setProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
        class="form-control form-control-sm" style="min-width: 150px;">
        <option value="Tela Tejida">Tela Tejida (SMS)</option>
        <option value="Contenedor">Contenedor Rígido</option>
        <option value="Papel Mixto">Papel Mixto</option>
        <option value="Tela No Tejida">Tela No Tejida</option>
    </select>
</div>
