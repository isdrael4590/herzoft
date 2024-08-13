<?php

namespace Modules\Preparation\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Preparation\Entities\Preparationze;
use Modules\Preparation\DataTables\PreparationzeDataTable;
use Modules\Preparation\Entities\PreparationDetails;
use Modules\Preparation\Http\Requests\StorePreparationzeRequest;
use Modules\Preparation\Http\Requests\UpdatePreparationzeRequest;
use Modules\Discharge\Entities\Discharge;


class PreparationfromZEController extends Controller
{
    public function index( PreparationzeDataTable $dataTable)
    {
        abort_if(Gate::denies('access_preparations'), 403);


        return $dataTable->render('preparation::preparations.index');
    }


    public function create($discharge_id)
    {
        abort_if(Gate::denies('create_preparations'), 403);
        $discharge = Discharge::findOrFail($discharge_id);

        Cart::instance('preparation')->destroy();

        return view('preparation::preparations.create',compact('discharge'));
    }


    public function store(StorePreparationzeRequest $request)
    {
        DB::transaction(function () use ($request) {
            $preparationze = Preparationze::create([
                'discharge_id' => $request->discharge_id,
                'operator' => $request->operator,
            ]);

            $discharge = discharge::findOrFail($request->discharge_id);
            $discharge->update([
                'ruta_process' => 'Reprocesado',
            ]);
            foreach (Cart::instance('preparation')->content() as $cart_item) {
                PreparationDetails::create([
                    'preparation_id' => $preparationze->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_state_preparation' => $cart_item->options->product_state_preparation,
                    'product_coming_zone' => $cart_item->options->product_coming_zone,
                ]);

            }

            Cart::instance('preparation')->destroy();
        });



        toast('preparation registrada!', 'success');

        return redirect()->route('preparationDetails.index');
    }

    public function show(Preparationze $preparationze)
    {
        abort_if(Gate::denies('show_preparations'), 403);


        return view('preparation::preparations.show', compact('preparation'));
    }

    public function edit(Preparationze $preparationze)
    {
        abort_if(Gate::denies('edit_preparations'), 403);

        $preparation_details = $preparationze->preparationDetails;

        Cart::instance('preparation')->destroy();

        $cart = Cart::instance('preparation');

        foreach ($preparation_details as $preparation_detail) {
            $cart->add([
                'id'      => $preparation_detail->product_id,
                'name'    => $preparation_detail->product_name,
                'qty'     => 1,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $preparation_detail->product_code,
                    'product_type_process'   => $preparation_detail->product_type_process,
                    'product_state_preparation'   => $preparation_detail->product_state_preparation,
                    'product_coming_zone' => $preparation_detail->product_coming_zone,

                ]
            ]);
        }

        return view('preparation::preparations.edit', compact('preparation'));
    }

    public function update(UpdatePreparationzeRequest $request, Preparationze $preparationze)
    {
        DB::transaction(function () use ($request, $preparationze) {
            foreach ($preparationze->preparationDetails as $preparation_detail) {
                $preparation_detail->delete();
            }

            $preparationze->update([
                'discharge_id' => $request->discharge_id,
                'reference' => $request->reference,
                'operator' => $request->operator,
                'note' => $request->note,

            ]);

            $discharge = discharge::findOrFail($request->discharge_id);
            $discharge->update([
                'ruta_process' => 'Reprocesado',
            ]);

            foreach (Cart::instance('preparation')->content() as $cart_item) {
                PreparationDetails::create([
                    'preparation_id' => $preparationze->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_state_preparation' => $cart_item->options->product_state_preparation,
                    'product_coming_zone' => $cart_item->options->product_coming_zone,


                ]);
            }

            Cart::instance('preparation')->destroy();
        });

        toast('Preparación actualizado!', 'info');

        return redirect()->route('preparations.index');
    }

    public function destroy(Preparationze $preparationze)
    {
        abort_if(Gate::denies('delete_preparations'), 403);

        $preparationze->delete();

        toast('Preparación Eliminado!', 'warning');

        return redirect()->route('preparations.index');
    }
}
