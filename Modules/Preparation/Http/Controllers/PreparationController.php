<?php

namespace Modules\Preparation\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;

use Modules\Preparation\Entities\Preparation;
use Modules\Preparation\DataTables\PreparationDetailsDataTable;
use Modules\Preparation\DataTables\PreparationDataTable;
use Modules\Preparation\DataTables\PreparationzeDataTable;

use Modules\Reception\Entities\Reception;
use Modules\Reception\Entities\ReceptionDetails;

use Modules\Preparation\Entities\PreparationDetails;

use Modules\Preparation\Http\Requests\StorePreparationRequest;
use Modules\Preparation\Http\Requests\UpdatePreparationRequest;
use Modules\Reception\Http\Requests\StoreReceptionRequest;


class PreparationController extends Controller
{
    public function index( PreparationDataTable $dataTable)
    {
        abort_if(Gate::denies('access_preparations'), 403);


        return $dataTable->render('preparation::preparations.index', compact('dataTable'));
    }


    public function create($reception_id)
    {
        abort_if(Gate::denies('create_preparations'), 403);
        $reception = Reception::findOrFail($reception_id);

        Cart::instance('preparation')->destroy();

        return view('preparation::preparations.create',compact('reception'));
    }


    public function store(StorePreparationRequest $request)
    {
        DB::transaction(function () use ($request) {
            $preparation = Preparation::create([
                'reception_id' => $request->reception_id,
                'operator' => $request->operator,
                'note' => $request->note,
            ]);

            $reception = Reception::findOrFail($request->reception_id);
            $reception->update([
                'status' => 'Procesado',
            ]);
            foreach (Cart::instance('preparation')->content() as $cart_item) {
                PreparationDetails::create([
                    'preparation_id' => $preparation->id,
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

    public function show(Preparation $preparation)
    {
        abort_if(Gate::denies('show_preparations'), 403);


        return view('preparation::preparations.show', compact('preparation'));
    }

    public function edit(Preparation $preparation)
    {
        abort_if(Gate::denies('edit_preparations'), 403);

        $preparation_details = $preparation->preparationDetails;

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

    public function update(UpdatePreparationRequest $request, Preparation $preparation)
    {
        DB::transaction(function () use ($request, $preparation) {
            foreach ($preparation->preparationDetails as $preparation_detail) {
                $preparation_detail->delete();
            }

            $preparation->update([
                'reference' => $request->reference,
                'operator' => $request->operator,
                'note' => $request->note,

            ]);

            foreach (Cart::instance('preparation')->content() as $cart_item) {
                PreparationDetails::create([
                    'preparation_id' => $preparation->id,
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

    public function destroy(Preparation $preparation)
    {
        abort_if(Gate::denies('delete_preparations'), 403);

        $preparation->delete();

        toast('Preparación Eliminado!', 'warning');

        return redirect()->route('preparations.index');
    }
}
