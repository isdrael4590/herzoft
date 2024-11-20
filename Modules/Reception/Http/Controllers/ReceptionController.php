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
use Modules\Reception\DataTables\ReceptionDataTable;
use Modules\Reception\Entities\ReceptionDetails;

use Modules\Reception\Http\Requests\StoreReceptionRequest;
use Modules\Reception\Http\Requests\UpdateReceptionRequest;

class ReceptionController extends Controller
{
    public function index(ReceptionDataTable $dataTable)
    {
        abort_if(Gate::denies('access_receptions'), 403);

        return $dataTable->render('reception::receptions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_receptions'), 403);

        Cart::instance('reception')->destroy();

        return view('reception::receptions.create');
    }


    public function store(StoreReceptionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $reception = Reception::create([


                'reference' => $request->reference,
                'operator' => $request->operator,
                'delivery_staff' => $request->delivery_staff,
                'area' => $request->area,
                'status' => $request->status,
                'note' => $request->note,
                'total_amount' => $request->total_amount,  // se añade


            ]);

            foreach (Cart::instance('reception')->content() as $cart_item) {
                ReceptionDetails::create([
                    'reception_id' => $reception->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_quantity' => $cart_item->qty,
                    'price' => $cart_item->price, // se añade
                    'unit_price' => $cart_item->options->unit_price, // se añade
                    'sub_total' => $cart_item->options->sub_total, // se añade
                    'product_patient' => $cart_item->options->product_patient,
                    'product_outside_company' => $cart_item->options->product_outside_company,
                    'product_area' => $cart_item->options->product_area,
                    'product_type_dirt' => $cart_item->options->product_type_dirt,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_state_rumed' => $cart_item->options->product_state_rumed,
                ]);
            }

            Cart::instance('reception')->destroy();
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

        Cart::instance('reception')->destroy();

        $cart = Cart::instance('reception');

        foreach ($reception_details as $reception_detail) {
            $cart->add([
                'id'      => $reception_detail->product_id,
                'name'    => $reception_detail->product_name,
                'qty'     => $reception_detail->product_quantity,
                'price'     => $reception_detail->price, // se añade
                'weight'     => 1,
                'options' => [
                    'code'     => $reception_detail->product_code,
                    'product_patient'   => $reception_detail->product_patient,
                    'product_outside_company'   => $reception_detail->product_outside_company,
                    'product_area'   => $reception_detail->product_area,
                    'product_type_dirt'   => $reception_detail->product_type_dirt,
                    'product_type_process'   => $reception_detail->product_type_process,
                    'product_state_rumed'   => $reception_detail->product_state_rumed,
                    'sub_total'   => $reception_detail->sub_total, // se añade
                    'unit_price'  => $reception_detail->unit_price, // se añade
                    
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
                'total_amount' => $request->total_amount // se añade

            ]);

            foreach (Cart::instance('reception')->content() as $cart_item) {
                ReceptionDetails::create([
                    'reception_id' => $reception->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_quantity' => $cart_item->qty,
                    'product_patient' => $cart_item->options->product_patient,
                    'product_outside_company' => $cart_item->options->product_outside_company,
                    'product_area' => $cart_item->options->product_area,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_type_dirt' => $cart_item->options->product_type_dirt,
                    'product_state_rumed' => $cart_item->options->product_state_rumed,
                    'price' => $cart_item->price, // se añade
                    'unit_price' => $cart_item->options->unit_price, // se añade
                    'sub_total' => $cart_item->options->sub_total, // se añade
                ]);
            }

            Cart::instance('reception')->destroy();
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
