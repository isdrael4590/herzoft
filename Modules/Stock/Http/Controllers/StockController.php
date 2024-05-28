<?php

namespace Modules\Stock\Http\Controllers;

use Modules\Stock\DataTables\StockDataTable;
use Modules\Stock\DataTables\StockDetailsDataTable;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;
use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockDetails;
use Modules\Stock\Http\Requests\StoreStockRequest;
use Modules\Stock\Http\Requests\UpdateStockRequest;




class StockController extends Controller
{

    public function index(StockDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_almacen_area'), 403);

        return $dataTable->render('stock::stocks.index');
    }


    public function create()
    {
        abort_if(Gate::denies('create_stocks'), 403);

        Cart::instance('stocks')->destroy();

        return view('stock::stocks.create');
    }


    public function store(StoreStockRequest $request)
    {
        DB::transaction(function () use ($request) {
            $stock = Stock::create([
                'lote_machine' => $request->lote_machine,
                'machine_name' => $request->machine_name,
                'lote_biologic' => $request->lote_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'note' => $request->note,
                'operator' => $request->operator,
            ]);
            foreach (Cart::instance('stock')->content() as $cart_item) {
                StockDetails::create([
                    'stock_id' => $stock->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_expiration' =>$cart_item->options->product_expiration,
                    'product_date_sterilized' =>$cart_item->options->product_date_sterilized,
                    'product_status_stock' =>$cart_item->options->product_status_stock,

                ]);
            }
            Cart::instance('stock')->destroy();
    
        });

        toast('Despacho Generado!', 'success');

        return redirect()->route('stocks.index');
    }


    public function show(Stock $stock)
    {
        abort_if(Gate::denies('show_stocks'), 403);

        return view('stock::stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        abort_if(Gate::denies('edit_stocks'), 403);

        $stock_details = $stock->stockDetails;

        Cart::instance('stock')->destroy();

        $cart = Cart::instance('stock');

        foreach ($stock_details as $stock_detail) {
            $cart->add([
                'id'      => $stock_details->product_id,
                'name'    => $stock_details->product_name,
                'qty'     => 1,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $stock_details->product_code,
                    'product_type_process'   => $stock_details->product_type_process,
                    'product_package_wrap'   => $stock_details->product_package_wrap,
                    'product_ref_qr'   => $stock_details->product_ref_qr,
                    'product_expiration'   => $stock_details->product_expiration,
                    'product_date_sterilized'   => $stock_details->product_date_sterilized,
                    'product_status_stock'   => $stock_details->product_status_stock,
                    
                 
                ]
            ]);
        }

        return view('stock::stocks.edit', compact('stock'));
    }


    public function update(UpdateStockRequest  $request, Stock $stock)
    {
        DB::transaction(function () use ($request, $stock) {

            foreach ($stock->stockDetails as $stock_detail) {
                $stock_detail->delete();
            }

            $stock->update([
                'lote_machine' => $request->lote_machine,
                'machine_name' => $request->machine_name,
                'lote_biologic' => $request->lote_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'note' => $request->note,
                'operator' => $request->operator
            ]);
     

            foreach (Cart::instance('stock')->content() as $cart_item) {
                stockDetails::create([
                    'stock_id' => $stock->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_expiration' =>$cart_item->options->product_expiration,
                    'product_date_sterilized' =>$cart_item->options->product_date_sterilized,
                    'product_status_stock' =>$cart_item->options->product_status_stock,
          
                    
                ]);
            }

            Cart::instance('stock')->destroy();
        });


        toast('Despacho actualizado!', 'info');

        return redirect()->route('stocks.index');
    }



    public function destroy(Stock $stock)
    {
        abort_if(Gate::denies('delete_stocks'), 403);

        $stock->delete();

        toast('Despacho Eliminado!', 'warning');

        return redirect()->route('stocks.index');
    }
}
