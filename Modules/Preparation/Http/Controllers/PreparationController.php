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
use Modules\Reception\Entities\Reception;
use Modules\Reception\Entities\ReceptionDetails;

use Modules\Preparation\Entities\PreparationDetails;

use Modules\Preparation\Http\Requests\StorePreparationRequest;
use Modules\Preparation\Http\Requests\UpdatePreparationRequest;
use Modules\Reception\Http\Requests\StoreReceptionRequest;


class PreparationController extends Controller
{
    public function index(PreparationDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_preparations'), 403);

        return $dataTable->render('preparation::preparations.index');
    }
    

    public function create()
    {
        abort_if(Gate::denies('create_preparations'), 403);

        Cart::instance('preparation')->destroy();

        return view('preparation::preparations.create');
    }


    public function store(StorePreparationRequest $request, Reception $reception)
    {
        DB::transaction(function () use ($request, $reception) {
            $preparation = Preparation::create([
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
            foreach ($reception->receptionDetails as $reception_detail) {
                $reception_detail->delete();
            }

            $reception->update([
                'reference' => $request->reference,
                'operator' => $request->operator,
                'delivery_staff' => $request->delivery_staff,
                'area' => $request->area,
                'status' => "procesado",
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

            
            Cart::instance('preparation')->destroy();
        });

       

        toast('preparation registrada!', 'success');

        return redirect()->route('preparations.index');
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

        toast('Recepción actualizado!', 'info');

        return redirect()->route('preparations.index');
    }

    public function destroy(Preparation $preparation)
    {
        abort_if(Gate::denies('delete_preparations'), 403);

        $preparation->delete();

        toast('Recepcion Eliminado!', 'warning');

        return redirect()->route('preparations.index');
    }
}
