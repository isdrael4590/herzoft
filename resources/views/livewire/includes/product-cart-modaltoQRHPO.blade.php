<div class="d-inline-block">
<select wire:model.live="package_wrap.{{ $cart_item->id }}"
wire:change="setProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
class="form-control form-control-sm" style="min-width: 150px;">
<option value="Papel Tyvek"> Papel Tyvek </option>
<option value="Tela Tejida"> Tela Tejida (SMS)</option>
</select>
</div>