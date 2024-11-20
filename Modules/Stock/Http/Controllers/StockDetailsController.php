<?php

namespace Modules\Stock\Http\Controllers;

use Modules\Stock\DataTables\StockDetailsDataTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockDetails;





class StockDetailsController extends Controller
{

    public function index(StockDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_almacen_area'), 403);

        return $dataTable->render('stock::stockDetails.index');
    }

    public function edit($id)
    {

        abort_if(Gate::denies('edit_admin'), 403);
        $stockDetails = StockDetails::findOrFail($id);
        return view('stock::stockDetails.edit', compact('stockDetails'));
    }


    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('edit_admin'), 403);
        $request->validate([
            'product_status_stock' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_quantity_expedition' => 'required',
            'product_date_sterilized' => 'required',
            'product_expiration' => 'required',

        ]);

        StockDetails::findOrFail($id)->update([
            'product_status_stock' => $request->product_status_stock,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_quantity_expedition' => $request->product_quantity_expedition,
            'product_date_sterilized' => $request->product_date_sterilized,
            'product_expiration' => $request->product_expiration,

        ]);
        toast('Producto Stock actualizado!', 'info');

        return redirect()->route('stockDetails.index');
    }



    public function destroy($id)
    {
        abort_if(Gate::denies('delete_stocks'), 403);
        $StockDetails = StockDetails::findOrFail($id);
        $StockDetails->delete();
        toast('Producto Stock Eliminado!', 'warning');

        return redirect()->route('stockDetails.index');
    }
}
