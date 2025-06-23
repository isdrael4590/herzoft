<div class="input-group d-flex justify-content-center">
    <!-- Botón decrementar -->
    <div class="input-group-prepend">
        <button type="button" wire:click="decrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
            class="btn btn-outline-danger btn-sm" {{ $cart_item->qty <= 1 ? 'disabled' : '' }}>
            <i class="bi bi-dash"></i>
        </button>
    </div>
    <!-- Input de cantidad -->
    <input wire:model.live="quantity.{{ $cart_item->id }}"
        wire:change="updateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
        style="min-width: 60px; max-width: 90px; text-align: center;" class="form-control" value="{{ $cart_item->qty }}"
        min="1"
        @if ($cart_instance == 'labelqr') @php
$stockValue = isset($check_quantity[$cart_item->id]) 
? (is_array($check_quantity[$cart_item->id]) 
? implode('', $check_quantity[$cart_item->id]) 
: $check_quantity[$cart_item->id])
: 999;
@endphp
max="{{ $stockValue }}" @endif>
    <!-- Botón incrementar -->
    <div class="input-group-append">
        <button type="button" wire:click="incrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
            class="btn btn-outline-success btn-sm"
            @if ($cart_instance == 'labelqr') @php
$availableStock = isset($check_quantity[$cart_item->id])
? (is_array($check_quantity[$cart_item->id])
? (int)implode('', $check_quantity[$cart_item->id])
: (int)$check_quantity[$cart_item->id])
: 999;
@endphp
{{ $cart_item->qty >= $availableStock ? 'disabled' : '' }}
title="Stock disponible: {{ $availableStock }}" @endif>
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>

@if ($cart_instance == 'labelqr')
    @php
        $availableStock = isset($check_quantity[$cart_item->id])
            ? (is_array($check_quantity[$cart_item->id])
                ? (int) implode('', $check_quantity[$cart_item->id])
                : (int) $check_quantity[$cart_item->id])
            : 0;
    @endphp
    <p class="text-muted">Stock: {{ $availableStock }}</p>
@endif
