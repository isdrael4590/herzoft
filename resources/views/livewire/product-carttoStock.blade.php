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
                        <th class="align-middle">Código Instrumental</th>
                        <th class="align-middle">Descripción del Instrumental</th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Estado de Stock</th>
                        <th class="align-middle text-center">Fecha Esterilización</th>
                        <th class="align-middle text-center">Expiración</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart_items->isNotEmpty())
                        @foreach ($cart_items as $cart_item)
                            <tr>
                                <td class="align-middle">
                                    {{ $cart_item->options->code }}
                                </td>
                                <td class="align-middle">
                                    {{ $cart_item->name }}
                                </td>
                                <td class="align-middle text-center text-center">
                                    <span>
                                        {{ $cart_item->options->product_package_wrap }}
                                    </span>
                                </td>
                        
                                <td class="align-middle text-center text-center">
                                    {{ $cart_item->options->product_status_stock }}  @include('livewire.includes.product-cart-modaltoStock')
                                </td>
                                <td class="align-middle text-center text-center">
                                    {{ \Carbon\Carbon::parse($cart_item->options->product_date_sterilized)->format('d M, Y')  }}
                                   
                                </td>
                                <td class="align-middle text-center text-center">
                                   {{-- {!!\Carbon\Carbon::parse($cart_item->options->product_date_sterilized)->addMonth($cart_item->options->product_expiration)!!}--}}
                                   {!!\Carbon\Carbon::parse($cart_item->options->product_expiration)->format('d M, Y')!!}
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
