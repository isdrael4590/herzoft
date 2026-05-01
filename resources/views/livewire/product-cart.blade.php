<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <span>{{ session('message') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        @endif

        @php
            $dirtBadge = [
                'NO CRITICO'  => 'badge-info',
                'SEMICRITICO' => 'badge-warning',
                'CRITICO'     => 'badge-danger',
                'REPROCESADO' => 'badge-secondary',
            ];
        @endphp

        <div class="table-responsive position-relative">
            <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center"
                style="top:0;right:0;left:0;bottom:0;background-color:rgba(255,255,255,0.5);z-index:99;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle">Descripción/Código</th>
                        <th class="align-middle text-center">Cantidad</th>
                        <th class="align-middle text-center">Nivel de Infección</th>
                        <th class="align-middle text-center">Estado del instrumental</th>
                        <th class="align-middle text-center">Paciente</th>
                        <th class="align-middle text-center">Casa Comercial</th>
                        @can('access_wash_area')
                        <th class="align-middle text-center">Lavado</th>
                        @endcan
                        <th class="align-middle text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart_items as $cart_item)
                        <tr wire:key="cart-{{ $cart_item->rowId }}">
                            <td class="align-middle">
                                {{ $cart_item->name }}<br>
                                <span class="badge badge-info">{{ $cart_item->options->code }}</span>
                            </td>
                            <td class="align-middle text-center">
                                @include('livewire.includes.product-cart-quantity')
                            </td>
                            <td class="align-middle text-center">
                                @php $dirt = $cart_item->options->product_type_dirt; @endphp
                                <span class="badge {{ $dirtBadge[$dirt] ?? 'badge-secondary' }}">
                                    {{ $dirt }}
                                </span>
                                @include('livewire.includes.product-cart-modal')
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-secondary">
                                    {{ $cart_item->options->product_state_rumed }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-secondary">
                                    {{ $cart_item->options->product_patient }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-secondary">
                                    {{ $cart_item->options->product_outside_company }}
                                </span>
                            </td>
                            @can('access_wash_area')
                            <td class="align-middle text-center">
                                <span wire:click="toggleLavado('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
                                      role="button" title="Click para cambiar"
                                      class="badge {{ ($cart_item->options->product_lavado ?? false) ? 'badge-success' : 'badge-secondary' }}">
                                    {{ ($cart_item->options->product_lavado ?? false) ? 'SI' : 'NO' }}
                                </span>
                            </td>
                            @endcan
                            <td class="align-middle text-center">
                                <a href="#" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                    <i class="bi bi-x-circle font-2xl text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->can('access_wash_area') ? 8 : 7 }}" class="text-center">
                                <span class="text-danger">Por favor buscar y seleccionar el paquete !</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-md-end">
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Total Paquetes Recibidos</th>
                        @php $total_package = Cart::instance($cart_instance)->subtotal() @endphp
                        <th>{{ $total_package }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_amount" value="{{ $total_package }}">

    <script>
        window.addEventListener('focusQuantity', (event) => {
            setTimeout(() => {
                const input = document.getElementById('qty-' + event.detail.productId);
                if (input) {
                    input.focus();
                    input.select();
                }
            }, 150);
        });

        window.addEventListener('closeProductModal', (event) => {
            const modalEl = document.getElementById('inputDyrtState' + event.detail.productId);
            if (modalEl) {
                $(modalEl).removeClass('show').hide();
                $(modalEl).attr('aria-hidden', 'true').removeAttr('aria-modal').css('display', '');
            }
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css('padding-right', '');
        });
    </script>
</div>
