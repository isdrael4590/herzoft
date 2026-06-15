@php
    $maxStock = isset($check_quantity[$cart_item->id])
        ? (is_array($check_quantity[$cart_item->id])
            ? (int) implode('', $check_quantity[$cart_item->id])
            : (int) $check_quantity[$cart_item->id])
        : 0;
    $remaining = max(0, $maxStock - $cart_item->qty);
@endphp

{{-- Alpine gestiona el estado visual (instantáneo), Livewire solo se llama al confirmar --}}
<div class="input-group d-flex justify-content-center"
     x-data="{ qty: {{ $cart_item->qty }}, max: {{ $maxStock }} }"
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
           @keydown.enter.prevent="qty = Math.min(Math.max(qty, 1), max); $wire.setAndUpdateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }}, qty)"
           id="qty-{{ $cart_item->id }}"
           type="number"
           style="min-width: 60px; max-width: 90px; text-align: center;"
           class="form-control"
           min="1"
           :max="max">

    {{-- Botón incrementar --}}
    <div class="input-group-append">
        <button type="button"
                @click.prevent="if (qty < max) { qty++; $wire.incrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }}) }"
                class="btn btn-outline-success btn-sm"
                :disabled="qty >= max"
                :title="'Máx. prelavado: ' + max">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>

<small class="d-block text-center mt-1 {{ $remaining === 0 ? 'text-danger' : 'text-muted' }}">
    Saldo: <strong>{{ $remaining }}</strong> / {{ $maxStock }}
</small>
