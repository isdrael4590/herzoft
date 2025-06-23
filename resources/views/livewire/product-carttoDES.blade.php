
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
  
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        @can('edit_admin')
                            <th class="align-middle">Id</th>
                        @endcan
                        <th class="align-middle text-center">Descripción del Instrumental</th>
                        <th class="align-middle text-center">Código del Instrumental</th>
                        <th class="align-middle text-center">Cantidad Procesado</th>
                        <th class="align-middle text-center">Cantidad Validado</th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Validación Embalaje e Indicador </th>
                        <th class="align-middle text-center"> Ind. 4 ó 5</th>
                        <th class="align-middle text-center"> Venc. </th>
                        <th class="align-middle text-center"> Otra Info. </th>

                    </tr>
                </thead>
                <tbody>
                    @if ($cart_items->isNotEmpty())
                        @foreach ($cart_items as $cart_item)
                            <tr>
                                  @can('edit_admin')
                                    <td class="align-middle text-center">
                                        {{ $cart_item->id }}
                                    </td>
                                @endcan
                                <td class="align-middle">
                                    {{ $cart_item->name }} <br>
                                </td>
                                <td class="align-middle">
                                    {{ $cart_item->options->code }}
                                </td>
                                <td class="align-middle text-center text-center">
                                    {{ $cart_item->options->stock }}
                                </td>
                                <td class="align-middle text-center">
                                    @include('livewire.includes.product-carttoDES-quantity')
                                </td>
                                <td class="align-middle text-center text-center">
                                    <span>
                                        {{ $cart_item->options->product_package_wrap }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    {{ $cart_item->options->product_eval_package }} @include('livewire.includes.product-cart-modaltoDES')
                                </td>

                                <td class="align-middle text-center">
                                    {{ $cart_item->options->product_eval_indicator }}
                                </td>
                                <td class="align-middle text-center">
                                    @if ($cart_item->options->product_expiration >= 15)
                                    @if ($cart_item->options->product_expiration == 180)
                                        6 Meses <br>
                                    @elseif ($cart_item->options->product_expiration == 270)
                                        9 Meses <br>
                                    @elseif ($cart_item->options->product_expiration == 365)
                                        12 Meses <br>
                                    @elseif ($cart_item->options->product_expiration == 545)
                                        18 Meses <br>
                                    @endif
                                @else
                                    {{ $cart_item->options->product_expiration }} Días <br>
                                @endif
                                </td>
                                <td class="align-middle text-center">
                                    {{ $cart_item->options->product_patient}} // [
                                    {{ $cart_item->options->product_outside_company}}] 

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
                        <th>Total Paquetes Estériles</th>
                        @php
                            $total_package = Cart::instance($cart_instance)->subtotal()
                        @endphp
                        <th>
                             {{ ($total_package) }}
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_amount" value="{{ $total_package }}">

</div>
