{{--<div class="input-group d-flex justify-content-center">
    <input wire:model="quantity.{{ $cart_item->id }}" style="min-width: 40px;max-width: 90px;" type="number" class="form-control" value="{{ $cart_item->qty }}" min="1">
    <div class="input-group-append">
        <button type="button" wire:click="updateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})" class="btn btn-info">
            <i class="bi bi-check"></i>
        </button>
    </div>
</div>--}}

<div class="input-group d-flex justify-content-center">
    <!-- Botón decrementar -->
    <div class="input-group-prepend">
        <button type="button" 
                wire:click="decrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})" 
                class="btn btn-outline-danger btn-sm"
                {{ $cart_item->qty <= 1 ? 'disabled' : '' }}>
            <i class="bi bi-dash"></i>
        </button>
    </div>
    
    <!-- Input de cantidad -->
    <input wire:model.live="quantity.{{ $cart_item->id }}" 
           wire:change="updateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
           style="min-width: 60px; max-width: 90px; text-align: center;" 
           class="form-control" 
           value="{{ $cart_item->qty }}" 
           min="1">
    
    <!-- Botón incrementar -->
    <div class="input-group-append">
        <button type="button" 
                wire:click="incrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})" 
                class="btn btn-outline-success btn-sm">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>