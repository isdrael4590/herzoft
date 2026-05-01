<?php

namespace Modules\Stock\Http\Controllers;

use Modules\Stock\DataTables\StockDetailsDataTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\StockDetails;
use Modules\Stock\Entities\StockQuantityReset;





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



    public function codeHistory($code)
    {
        abort_if(Gate::denies('access_almacen_area'), 403);

        $productCode = urldecode($code);

        $details = StockDetails::where('product_code', $productCode)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $productName = optional($details->first())->product_name ?? $productCode;

        return view('stock::stockDetails.code-history', compact('details', 'productCode', 'productName'));
    }

    public function resetQuantities(Request $request)
    {
        abort_if(Gate::denies('edit_stocks'), 403);

        set_time_limit(300);

        try {
            $userId = Auth::id();
            $resetTime = now();

            $totalCount = StockDetails::where('product_quantity', '>', 0)->count();

            if ($totalCount === 0) {
                toast('No hay productos con cantidades para reiniciar.', 'info');
                return redirect()->route('stockDetails.index');
            }

            $resetRecords = [];

            StockDetails::where('product_quantity', '>', 0)
                ->select('id', 'product_name', 'product_code', 'product_area', 'product_package_wrap', 'product_quantity')
                ->chunk(200, function ($items) use ($userId, $resetTime, &$resetRecords) {
                    foreach ($items as $item) {
                        $resetRecords[] = [
                            'stock_detail_id'    => $item->id,
                            'user_id'            => $userId,
                            'previous_quantity'  => $item->product_quantity,
                            'new_quantity'       => 0,
                            'product_name'       => $item->product_name,
                            'product_code'       => $item->product_code,
                            'product_area'       => $item->product_area,
                            'product_package_wrap' => $item->product_package_wrap,
                            'reset_at'           => $resetTime,
                            'created_at'         => $resetTime,
                            'updated_at'         => $resetTime,
                        ];
                    }
                });

            // Insert historial en lotes
            foreach (array_chunk($resetRecords, 200) as $chunk) {
                StockQuantityReset::insert($chunk);
            }

            // Update masivo en una sola query
            StockDetails::where('product_quantity', '>', 0)->update(['product_quantity' => 0]);

            toast('Se reiniciaron las cantidades de ' . $totalCount . ' producto(s) correctamente!', 'success');
        } catch (\Exception $e) {
            toast('Error al reiniciar cantidades: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('stockDetails.index');
    }

    public function resetHistory()
    {
        abort_if(Gate::denies('access_almacen_area'), 403);

        $resets = StockQuantityReset::with(['user', 'stockDetail'])
            ->orderBy('reset_at', 'desc')
            ->paginate(20);

        return view('stock::stockDetails.reset-history', compact('resets'));
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
