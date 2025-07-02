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
use Modules\Discharge\Entities\Discharge;

use Carbon\Carbon;
use Modules\Discharge\Entities\DischargeDetails;

class StockController extends Controller
{

    public function index(StockDataTable $dataTable)
    {
        abort_if(Gate::denies('access_almacen_area'), 403);

        return $dataTable->render('stock::stocks.index');
    }


  /* public function create($discharge_id)
    {
        abort_if(Gate::denies('create_stocks'), 403);
       
        $discharge = Discharge::findOrFail($discharge_id);
        Cart::instance('stocks')->destroy();

        return view('stock::stocks.create', compact('discharge'));
    }
 */ 
public function create()
    {
        abort_if(Gate::denies('create_stocks'), 403);
       
        Cart::instance('stocks')->destroy();

        return view('stock::stocks.create');
    }

    public function store(StoreStockRequest $request, Stock $stock)
    {
        DB::transaction(function () use ($request, $stock) {
            $stock = Stock::create([
                'discharge_id' => $request->discharge_id,
                'lote_machine' => $request->lote_machine,
                'machine_name' => $request->machine_name,
                'lote_biologic' => $request->lote_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'note' => $request->note,
                'operator' => $request->operator,
            ]);

            $discharge = Discharge::findOrFail($request->discharge_id);
            $discharge->update([
                'ruta_process' => 'Almacenado', // aquii falta

            ]);

            foreach (Cart::instance('stock')->content() as $cart_item) {
                $expiration = Carbon::parse($cart_item->options->product_expiration);
                $date_sterelized = Carbon::parse($cart_item->options->product_date_sterilized);
                StockDetails::create([
                    'stock_id' => $stock->id,
                    'product_id' => $cart_item->options->product_id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_quantity' => $cart_item->qty,
                    'price' => $cart_item->price, // se añade
                    'unit_price' => $cart_item->options->unit_price, // se añade
                    'sub_total' => $cart_item->options->sub_total, // se añade
                    'product_patient' => $cart_item->options->product_patient,
                    'product_info' => $cart_item->options->product_info,
                    'product_type_process' => 
                    $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_expiration' => $expiration,
                    'product_date_sterilized' => $date_sterelized,
                    'product_status_stock' => $cart_item->options->product_status_stock,
                    'product_area' => $cart_item->options->product_area,
                    'product_outside_company' => $cart_item->options->product_outside_company,

                ]);
            }
            Cart::instance('stock')->destroy();
        });

        toast('Producto Almacenado!', 'success');

        return redirect()->route('discharges.index');
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
            $discharge_detail = DischargeDetails::where("id", $stock_detail->discharge_detail_id)->get()->first();
            $expiration = Carbon::parse($stock_detail->updated_at)->addDays($stock_detail->product_expiration);
            $cart->add([
                'id'      => $stock_detail->id,
                'name'    => $stock_detail->product_name,
                'qty'     => $stock_detail->product_quantity,
                'price'     => $stock_detail->price,
                'weight'     => 1,
                'options' => [
                    'code'     => $stock_detail->product_code,
                    'product_id'   => $stock_detail->product_id,
                    'stock'       => $discharge_detail->product_quantity,
                    'product_type_process'   => $stock_detail->product_type_process,
                    'product_package_wrap'   => $stock_detail->product_package_wrap,
                    'product_ref_qr'   => $stock_detail->product_ref_qr,
                    'product_expiration'   => $expiration,
                    'product_date_sterilized'   => $stock_detail->product_date_sterilized,
                    'product_status_stock'   => $stock_detail->product_status_stock,
                    'product_patient'   => $stock_detail->product_patient,
                    'sub_total'   => $stock_detail->sub_total, // se añade
                    'unit_price'  => $stock_detail->unit_price, // se añade
                    'product_outside_company'   => $stock_detail->product_outside_company,
                    'product_area'   => $stock_detail->product_area,
                    'product_info'   => $stock_detail->product_info,

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
                'discharge_id' => $request->discharge_id,
                'lote_machine' => $request->lote_machine,
                'machine_name' => $request->machine_name,
                'lote_biologic' => $request->lote_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'note' => $request->note,
                'operator' => $request->operator
            ]);

            $discharge = Discharge::findOrFail($request->discharge_id);
            $discharge->update([
                'ruta_process' => 'Almacenado', // aquii falta

            ]);
            foreach (Cart::instance('stock')->content() as $cart_item) {
                stockDetails::create([
                    'stock_id' => $stock->id,
                    'product_id' => $cart_item->options->product_id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_quantity' => $cart_item->qty,
                    'product_patient' => $cart_item->options->product_patient,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_expiration' => $cart_item->options->product_expiration,
                    'product_date_sterilized' => $cart_item->options->product_date_sterilized,
                    'product_status_stock' => $cart_item->options->product_status_stock,
                    'price' => $cart_item->price, // se añade
                    'unit_price' => $cart_item->options->unit_price, // se añade
                    'sub_total' => $cart_item->options->sub_total, // se añade
                    'product_outside_company' => $cart_item->options->product_outside_company,
                    'product_area' => $cart_item->options->product_area,
                    'product_info' => $cart_item->options->product_info,
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
