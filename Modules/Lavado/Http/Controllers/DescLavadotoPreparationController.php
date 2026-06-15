<?php

namespace Modules\Lavado\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Lavado\Entities\DescargaLavado;
use Modules\Lavado\Entities\Lavado;

class DescLavadotoPreparationController extends Controller
{
    public function __invoke(DescargaLavado $descargalavado)
    {
        abort_if(Gate::denies('create_reception_preparations'), 403);

        $descargalavado->load('descargaLavadoDetalles');

        $lavado_detalles = $descargalavado->descargaLavadoDetalles;

        Cart::instance('preparation')->destroy();

        $cart = Cart::instance('preparation');

        foreach ($lavado_detalles as $detalle) {
            $coming_zone = match($detalle->product_area) {
                'Preparación', 'Preparacion' => 'Preparación',
                default => 'Lavado',
            };

            $cart->add([
                'id'      => $detalle->product_id ?? $detalle->id,
                'name'    => $detalle->product_name,
                'qty'     => $detalle->product_quantity,
                'price'   => 0,
                'weight'  => 1,
                'options' => [
                    'code'                    => $detalle->product_code,
                    'product_patient'         => $detalle->product_patient,
                    'product_info'            => $detalle->product_info,
                    'product_outside_company' => $detalle->product_outside_company,
                    'product_area'            => $detalle->product_area,
                    'product_type_process'    => $detalle->product_type_process,
                    'product_state_preparation' => 'Disponible',
                    'product_coming_zone'     => $coming_zone,
                    'unit_price'              => 0,
                ],
            ]);
        }

        return view('lavado::lavdestopreparation.create', [
            'descargalavado_id'   => $descargalavado->id,
            'reception_id'=> $descargalavado->reception_id,
            'preparation' => $descargalavado,
        ]);
    }
}
