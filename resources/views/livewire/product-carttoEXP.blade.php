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
                        <th class="align-middle">Descripción del Instrumental</th>
                        <th class="align-middle">Código del Instrumental</th>
                        <th class="align-middle text-center">Cantidad </th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Expiración</th>
                        <th class="align-middle text-center">Otra Info.</th>
                        <th class="align-middle text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart_items->isNotEmpty())
                        @foreach ($cart_items as $cart_item)
                            <tr>

                                <td class="align-middle">
                                    {{ $cart_item->name }} <br>

                                </td>
                                <td class="align-middle">
                                    {{ $cart_item->options->code }}
                                </td>
                         
                                <td class="align-middle text-center">
                                    @include('livewire.includes.product-carttoEXP-quantity')

                                </td>
                                <td class="align-middle text-center">

                                    {{ $cart_item->options->product_package_wrap }} 

                                </td>
                                <td class="align-middle text-center">
                                    {!! \Carbon\Carbon::parse($cart_item->options->product_expiration)->format('d M, Y') !!}
                                </td>

                                <td class="align-middle text-center">
                                    {{ $cart_item->options->product_patient }} / [
                                        {{ $cart_item->options->product_outside_company }}
                                    ]
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

    <div class="row justify-content-md-end">
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped">

                    <tr>
                        <th>Total Paquetes del Despachados</th>
                        @php
                            $total_package = Cart::instance($cart_instance)->subtotal();
                        @endphp
                        <th>
                            {{ $total_package }}
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_amount" value="{{ $total_package }}">


</div>
