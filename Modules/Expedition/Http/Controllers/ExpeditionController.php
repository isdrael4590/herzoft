<?php

namespace Modules\Expedition\Http\Controllers;

use Modules\Expedition\DataTables\ExpeditionDataTable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;
use Modules\Expedition\Entities\Expedition;
use Modules\Expedition\Entities\ExpeditionDetails;
use Modules\Stock\Entities\StockDetails;
use Modules\Expedition\Http\Requests\StoreExpeditionRequest;
use Modules\Expedition\Http\Requests\UpdateExpeditionRequest;




class ExpeditionController extends Controller
{

    public function index(ExpeditionDataTable $dataTable)
    {
        abort_if(Gate::denies('access_almacen_area'), 403);

        return $dataTable->render('expedition::expeditions.index');
    }


    public function create()
    {
        abort_if(Gate::denies('create_expeditions'), 403);

        Cart::instance('expedition')->destroy();

        return view('expedition::expeditions.create');
    }


    public function store(StoreExpeditionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $expedition = Expedition::create([
                'area_expedition' => $request->area_expedition,
                'staff_expedition' => $request->staff_expedition,
                'temp_ambiente' => $request->temp_ambiente,
                'status_expedition' => $request->status_expedition,
                'note' => $request->note,
                'operator' => $request->operator,
            ]);

            foreach (Cart::instance('expedition')->content() as $cart_item) {
                $stock_detail = StockDetails::findOrFail($cart_item->id);
                ExpeditionDetails::create([
                    'expedition_id' => $expedition->id,
                    'stock_detail_id' => $stock_detail->id,
                    'product_id' => $cart_item->options->product_id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_expiration' => $cart_item->options->product_expiration,
                ]);


                if ($request->status_expedition == 'Despachado'){

                    $stock_detail = StockDetails::findOrFail($cart_item->id);
                    $stock_detail->update([
                        'product_status_stock' => 'Despachado',
                    ]);
                }
                  
            }


            Cart::instance('expedition')->destroy();
        });

        toast('Despacho Generado!', 'success');

        return redirect()->route('expeditions.index');
    }


    public function show(Expedition $expedition)
    {
        abort_if(Gate::denies('show_expeditions'), 403);

        return view('expedition::expeditions.show', compact('expedition'));
    }


    public function edit(Expedition $expedition)
    {
        abort_if(Gate::denies('edit_expeditions'), 403);

        $expedition_details = $expedition->expeditionDetails;

        Cart::instance('expedition')->destroy();

        $cart = Cart::instance('expedition');

        foreach ($expedition_details as $expedition_detail) {
            $cart->add([
                'id'      => $expedition_detail->id,
                'name'    => $expedition_detail->product_name,
                'qty'     => 1,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $expedition_detail->product_code,
                    'product_id'   => $expedition_detail->product_id,
                    'stock_detail_id'   => $expedition_detail->stock_detail_id,
                    'product_type_process'   => $expedition_detail->product_type_process,
                    'product_package_wrap'   => $expedition_detail->product_package_wrap,
                    'product_ref_qr'   => $expedition_detail->product_ref_qr,
                    'product_expiration'   => $expedition_detail->product_expiration,

                ]
            ]);
        }

        return view('expedition::expeditions.edit', compact('expedition'));
    }


    public function update(UpdateExpeditionRequest  $request, Expedition $expedition)
    {
        DB::transaction(function () use ($request, $expedition) {

            foreach ($expedition->expeditionDetails as $expedition_detail) {
                $expedition_detail->delete();
            }

            $expedition->update([
                'area_expedition' => $request->area_expedition,
                'staff_expedition' => $request->staff_expedition,
                'temp_ambiente' => $request->temp_ambiente,
                'status_expedition' => $request->status_expedition,
                'note' => $request->note,
                'operator' => $request->operator
            ]);


            foreach (Cart::instance('expedition')->content() as $cart_item) {
                //$stock_detail = StockDetails::findOrFail($cart_item->id);

                ExpeditionDetails::create([
                    'expedition_id' => $expedition->id,
                    'stock_detail_id' => $cart_item->options->stock_detail_id,
                    'product_id' => $cart_item->options->product_id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_expiration' => $cart_item->options->product_expiration,
                ]);
                if ($request->status_expedition == 'Despachado'){
                    $stock_detail = StockDetails::where('id', $cart_item->options->stock_detail_id);
                    $stock_detail->update([
                        'product_status_stock' => 'Despachado',
                    ]);
                }
            }

            Cart::instance('expedition')->destroy();
        });


        toast('Despacho actualizado!', 'info');

        return redirect()->route('expeditions.index');
    }



    public function destroy(expedition $expedition)
    {
        abort_if(Gate::denies('delete_expeditions'), 403);

        $expedition->delete();

        toast('Despacho Eliminado!', 'warning');

        return redirect()->route('expeditions.index');
    }
}
