<?php

namespace Modules\Reception\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Product\Entities\Product;
use Modules\Reception\Entities\Reception;
use Modules\Reception\Entities\ReceptionDetails;

use Modules\Reception\Http\Requests\StoreReceptionRequest;
use Modules\Reception\Http\Requests\UpdateReceptionRequest;

class ReceptionReprocessController extends Controller
{


    public function create()
    {
        abort_if(Gate::denies('create_receptions'), 403);

        Cart::instance('RecepReprocess')->destroy();

        return view('reception::receptions-reprocess.create');
    }


    public function store(StoreReceptionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $reception = Reception::create([

                //'product_name' => $request->product_name,
                'reference' => $request->reference,
                'operator' => $request->operator,
                'delivery_staff' => $request->delivery_staff,
                'area' => 'Zona Esteril',
                'status' => $request->status,
                'note' => $request->note,

            ]);

            foreach (Cart::instance('RecepReprocess')->content() as $cart_item) {
                $product_id_select = DischargeDetails::where('product_id', $cart_item->id)->get()->first();
                //dd($product_id_select);

                ReceptionDetails::create([
                    'reception_id' => $reception->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_dirt' => $cart_item->options->product_type_dirt,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_state_rumed' => $cart_item->options->product_state_rumed,
                ]);

                $Discharge_detail = DischargeDetails::findOrFail($cart_item->id);
                $Discharge_detail->update([
                    'product_ref_qr' => 'No Esteril',
                ]);
            }

            Cart::instance('RecepReprocess')->destroy();
        });

        toast('Reception registrada!', 'success');

        return redirect()->route('receptions.index');
    }

    public function show(Reception $reception)
    {
        abort_if(Gate::denies('show_receptions'), 403);


        return view('reception::receptions.show', compact('reception'));
    }

    public function edit(Reception $reception)
    {
        abort_if(Gate::denies('edit_receptions'), 403);

        $reception_details = $reception->receptionDetails;

        Cart::instance('RecepReprocess')->destroy();

        $cart = Cart::instance('reception');

        foreach ($reception_details as $reception_detail) {
            $cart->add([
                'id'      => $reception_detail->product_id,
                'name'    => $reception_detail->product_name,
                'qty'     => 1,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $reception_detail->product_code,
                    'product_type_dirt'   => $reception_detail->product_type_dirt,
                    'product_type_process'   => $reception_detail->product_type_process,
                    'product_state_rumed'   => $reception_detail->product_state_rumed
                ]
            ]);
        }

        return view('reception::receptions.edit', compact('reception'));
    }

    public function update(UpdateReceptionRequest $request, Reception $reception)
    {
        DB::transaction(function () use ($request, $reception) {
            foreach ($reception->receptionDetails as $reception_detail) {
                $reception_detail->delete();
            }

            $reception->update([
                'reference' => $request->reference,
                'operator' => $request->operator,
                'delivery_staff' => $request->delivery_staff,
                'area' => $request->area,
                'status' => $request->status,
                'note' => $request->note,
            ]);

            foreach (Cart::instance('reception')->content() as $cart_item) {
                ReceptionDetails::create([
                    'reception_id' => $reception->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_type_dirt' => $cart_item->options->product_type_dirt,
                    'product_state_rumed' => $cart_item->options->product_state_rumed,
                ]);
            }

            Cart::instance('RecepReprocess')->destroy();
        });

        toast('Ingreso actualizado!', 'info');

        return redirect()->route('receptions.index');
    }

    public function destroy(Reception $reception)
    {
        abort_if(Gate::denies('delete_receptions'), 403);

        $reception->delete();

        toast('Recepción Eliminado!', 'warning');

        return redirect()->route('receptions.index');
    }
}
