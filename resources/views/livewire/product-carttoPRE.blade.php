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
                        <th class="align-middle">Descripción/Código</th>
                        <th class="align-middle">Cantidad</th>
                        <th class="align-middle text-center">Zona proveniente </th>
                        <th class="align-middle text-center">Disponibilidad</th>
                        <th class="align-middle text-center">Paciente</th>
                        <th class="align-middle text-center">Casa Comercial</th>



                    </tr>
                </thead>
                <tbody>
                    @if ($cart_items->isNotEmpty())
                        @foreach ($cart_items as $cart_item)
                            <tr>
                              
                                <td class="align-middle text-center">
                                    {{ $cart_item->name }} <br>
                                    <span class="badge badge-info">
                                        {{ $cart_item->options->code }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    {{ $cart_item->qty }} <br>
                                </td>
                                <td class="align-middle text-center">
                                    @if ($cart_item->options->product_coming_zone == 'Zona Esteril')
                                        <span class="badge badge-warning">
                                            {{ $cart_item->options->product_coming_zone }}
                                        </span>
                                    @elseif($cart_item->options->product_coming_zone == 'Recepcion')
                                        <span class="badge badge-primary">
                                            {{ $cart_item->options->product_coming_zone }}
                                        </span>
                                    @endif
                                    @include('livewire.includes.product-cart-modaltoPRE')
                                </td>

                                <td class="align-middle text-center text-center">
                                    @if ($cart_item->options->product_state_preparation == 'Reprocesar')
                                        <span class="badge badge-info">
                                            {{ $cart_item->options->product_state_preparation }}
                                        </span>
                                    @elseif($cart_item->options->product_state_preparation == 'Disponible')
                                        <span class="badge badge-success">
                                            {{ $cart_item->options->product_state_preparation }}
                                        </span>
                                    @endif

                                </td>
                                <td class="align-middle text-center">
                                    {{ $cart_item->options->product_patient }} <br>
                                </td>
                                <td class="align-middle text-center">
                                    {{ $cart_item->options->product_outside_company }} <br>
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
                        <th>Total Paquetes Ingresados</th>
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
