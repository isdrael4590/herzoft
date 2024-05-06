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
        <div class="table-responsive position-relative">
            <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center"
                style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle">Código</th>
                        <th class="align-middle text-center">Nivel de Infección </th>
                        <th class="align-middle text-center">Estado del instrumental</th>
                        <th class="align-middle text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart_items->isNotEmpty())
                        @foreach ($cart_items as $cart_item)
                            <tr>
                                <td class="align-middle">
                                    {{ $cart_item->name }} <br>
                                    <span class="badge badge-info">
                                        {{ $cart_item->options->code }}
                                    </span>
                                    @include('livewire.includes.product-cart-modal')
                                </td>

                                <td class="align-middle text-center text-center">
                                    @if ($cart_item->options->product_type_dirt == 'NO CRITICO')
                                        <span class="badge badge-info">
                                            {{ $cart_item->options->product_type_dirt }}
                                        </span>
                                    @elseif($cart_item->options->product_type_dirt == 'SEMICRITICO')
                                        <span class="badge badge-warning">
                                            {{ $cart_item->options->product_type_dirt }}
                                        </span>
                                    @elseif($cart_item->options->product_type_dirt == 'CRITICO')
                                        <span class="badge badge-danger">
                                            {{ $cart_item->options->product_type_dirt }}
                                        </span>
                                    @endif
                                    {{--
                                    <div class="form-group form-focus select-focus">
                                        <select wire:model.live="type_dirt.{{ $cart_item->id }}" class="form-control" required>
                                            <option  disabled>-- SELECCIONAR EL NIVEL DE INFECCION--</option>
                                            <option value=" "> NO CRITICO</option>
                                            <option value="SEMICRITICO"> SEMI-CRITICO</option>
                                            <option selected value="CRITICO"> CRÍTICO</option>
                                        </select>
                                    </div>
                                    --}}
                                </td>

                                <td class="align-middle text-center">
                                    <span class="badge badge-secondary">
                                        {{ $cart_item->options->product_state_rumed }}
                                    </span>
                                    {{--
                                    <div class="form-group">
                                        <select wire:model.live="state_rumed.{{ $cart_item->id }}" class="form-control" required>
                                            <option value="BUENO">BUENO</option>
                                            <option value="REGULAR">REGULAR</option>
                                            <option value="MALO">MALO</option>
                                        </select>
                                    </div>
                                    --}}
                                </td>

                                <td class="align-middle text-center">
                                    <a href="#" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                        <i class="bi bi-x-circle font-2xl text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-danger">
                                    Por favor buscar y seleccionar el paquete !
                                </span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
