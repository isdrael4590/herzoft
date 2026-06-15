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

    {{-- Input: Alpine controla el valor; Enter envía qty al servidor --}}
    <input x-model.number="qty"
           @keydown.enter.prevent="$wire.setAndUpdateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }}, qty)"
           @change="$wire.setAndUpdateQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }}, qty)"
           id="qty-{{ $cart_item->id }}"
           type="number"
           style="min-width: 60px; max-width: 90px; text-align: center;"
           class="form-control"
           min="1"
           @if ($cart_instance == 'labelqr' || $cart_instance == 'labelqrhpo')
               @php
                   $stockValue = isset($check_quantity[$cart_item->id])
                       ? (is_array($check_quantity[$cart_item->id])
                           ? (int)implode('', $check_quantity[$cart_item->id])
                           : (int)$check_quantity[$cart_item->id])
                       : 999;
               @endphp
               max="{{ $stockValue }}"
           @endif>

    {{-- Botón incrementar --}}
    <div class="input-group-append">
        <button type="button"
                @click.prevent="qty++; $wire.incrementQuantity('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
                class="btn btn-outline-success btn-sm"
                @if ($cart_instance == 'labelqr' || $cart_instance == 'labelqrhpo')
                    :disabled="qty >= {{ $stockValue ?? 999 }}"
                    title="Stock disponible: {{ $stockValue ?? 999 }}"
                @endif>
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>

@if ($cart_instance == 'labelqr' || $cart_instance == 'labelqrhpo')
    @php
        $availableStock = isset($check_quantity[$cart_item->id])
            ? (is_array($check_quantity[$cart_item->id])
                ? (int)implode('', $check_quantity[$cart_item->id])
                : (int)$check_quantity[$cart_item->id])
            : 0;
    @endphp
    <small class="text-muted d-block text-center mt-1">
        <i class="bi bi-archive"></i> Stock: <strong>{{ $availableStock }}</strong>
    </small>
@endif
