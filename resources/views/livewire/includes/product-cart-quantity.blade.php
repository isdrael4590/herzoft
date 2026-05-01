{{-- Alpine gestiona el estado visual (instantáneo), Livewire solo se llama al confirmar --}}
<div class="input-group d-flex justify-content-center"
     x-data="{ qty: {{ $cart_item->qty }} }"
     @qty-confirmed-{{ $cart_item->id }}.window="qty = $event.detail.qty">

    {{-- Botón decrementar --}}
    <div class="input-group-prepend">
        <button type="button"
                @click.prevent="if (qty > 1) { qty--; $wire.decrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }}) }"
                class="btn btn-outline-danger btn-sm"
                :disabled="qty <= 1">
            <i class="bi bi-dash"></i>
        </button>
    </div>

    {{-- Input: Alpine controla el valor; Enter envía qty al servidor en 1 roundtrip --}}
    <input x-model.number="qty"
           @keydown.enter.prevent="$wire.setAndUpdateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }}, qty)"
           id="qty-{{ $cart_item->id }}"
           type="number"
           style="min-width: 60px; max-width: 90px; text-align: center;"
           class="form-control"
           min="1">

    {{-- Botón incrementar --}}
    <div class="input-group-append">
        <button type="button"
                @click.prevent="qty++; $wire.incrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
                class="btn btn-outline-success btn-sm">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>
