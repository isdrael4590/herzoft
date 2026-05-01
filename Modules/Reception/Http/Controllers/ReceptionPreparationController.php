<?php

namespace Modules\Reception\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;

use Modules\Reception\Entities\Reception;
use Modules\Reception\Http\Requests\StoreReceptionRequest;
use Modules\Lavado\Entities\PrelavadoDetalle;

class ReceptionPreparationController extends Controller

{

    public function __invoke(Reception $reception)
    {
        abort_if(Gate::denies('create_reception_preparations'), 403);

        $reception_details = $reception->receptionDetails;

        // Separar productos: sin lavado van a preparación, con lavado van a prelavado
        $para_preparacion = $reception_details->where('product_lavado', false);
        $para_prelavado   = $reception_details->where('product_lavado', true);

        // Guardar en prelavado_detalles los que requieren lavado previo
        foreach ($para_prelavado as $detalle) {
            PrelavadoDetalle::updateOrCreate(
                [
                    'reception_id' => $reception->id,
                    'product_id'   => $detalle->product_id,
                ],
                [
                    'reception_reference'    => $reception->reference,
                    'product_name'           => $detalle->product_name,
                    'product_code'           => $detalle->product_code,
                    'product_quantity'       => $detalle->product_quantity,
                    'product_patient'        => $detalle->product_patient,
                    'product_info'           => $detalle->product_info,
                    'product_outside_company'=> $detalle->product_outside_company,
                    'product_area'           => $detalle->product_area,
                    'product_type_process'   => $detalle->product_type_process,
                ]
            );
        }

        Cart::instance('preparation')->destroy();

        $cart = Cart::instance('preparation');
        $area = $reception->area;

        if ($area == 'Zona Esteril') {
            foreach ($para_preparacion as $reception_detail) {
                $cart->add([
                    'id'      => $reception_detail->product_id,
                    'name'    => $reception_detail->product_name,
                    'qty'     => $reception_detail->product_quantity,
                    'price'   => $reception_detail->price,
                    'weight'  => 1,
                    'options' => [
                        'code'                    => $reception_detail->product_code,
                        'product_patient'         => $reception_detail->product_patient,
                        'product_info'            => $reception_detail->product_info,
                        'product_outside_company' => $reception_detail->product_outside_company,
                        'product_area'            => $reception_detail->product_area,
                        'product_type_process'    => $reception_detail->product_type_process,
                        'product_state_preparation' => 'Disponible',
                        'product_coming_zone'     => 'Zona Esteril',
                        'unit_price'              => $reception_detail->unit_price,
                    ]
                ]);
            }
        } else {
            foreach ($para_preparacion as $reception_detail) {
                $cart->add([
                    'id'      => $reception_detail->product_id,
                    'name'    => $reception_detail->product_name,
                    'qty'     => $reception_detail->product_quantity,
                    'price'   => $reception_detail->price,
                    'weight'  => 1,
                    'options' => [
                        'code'                    => $reception_detail->product_code,
                        'product_patient'         => $reception_detail->product_patient,
                        'product_info'            => $reception_detail->product_info,
                        'product_outside_company' => $reception_detail->product_outside_company,
                        'product_area'            => $reception_detail->product_area,
                        'product_type_process'    => $reception_detail->product_type_process,
                        'product_state_preparation' => 'Disponible',
                        'product_coming_zone'     => 'Recepcion',
                        'unit_price'              => $reception_detail->unit_price,
                    ]
                ]);
            }
        }

        return view('reception::reception-preparations.create', [
            'reception_id'    => $reception->id,
            'preparation'     => $reception,
            'para_prelavado'  => $para_prelavado,
            'prelavado_count' => $para_prelavado->count(),
        ]);
    }
}
