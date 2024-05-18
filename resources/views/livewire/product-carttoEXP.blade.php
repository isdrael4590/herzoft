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
                        <th class="align-middle">Descripción del Instrumental</th>
                        <th class="align-middle">Código del Instrumental</th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Referecia QR</th>
                        <th class="align-middle text-center">Expiración</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cart_items->isNotEmpty())
                        @foreach ($cart_items as $cart_item)
                            <tr>
                                <td class="align-middle">
                                    {{ $cart_item->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $cart_item->options->code }}
                                </td>
                                <td class="align-middle text-center text-center">
                                    <span>
                                        {{ $cart_item->options->product_package_wrap }}
                                    </span>
                                </td>
                                <td class="align-middle ">
                                    <div>
                                        {!! QrCode::size(50)->style('square')->generate('{{ $cart_item->options->product_ref_qr }}') !!}
                                    </div>

                                </td>
                                <td class="align-middle text-center text-center">
                                    {{ $cart_item->options->product_expiration }}
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
