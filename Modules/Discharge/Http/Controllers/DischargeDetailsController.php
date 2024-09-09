<?php

namespace Modules\Discharge\Http\Controllers;

use Modules\Discharge\DataTables\DischargeDetailsDataTable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Discharge\Entities\DischargeDetails;

class DischargeDetailsController extends Controller
{

    public function index(DischargeDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_esteril_area'), 403);

        return $dataTable->render('discharge::dischargeDetails.index');
    }


    public function edit($id)
    {
        abort_if(Gate::denies('access_admin'), 403);
        $dischargeDetails = DischargeDetails::findorFail($id);
        return view('discharge::dischargeDetails.edit', compact('dischargeDetails'));
    }


    public function update(Request $request,  $id)
    {
        abort_if(Gate::denies('access_admin'), 403);

        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_ref_qr' => 'required',
            'product_eval_package' => 'required',
            'product_expiration' => 'required',

        ]);
        DischargeDetails::findOrFail($id)->update([
            'product_name' => $request->product_name,
            'product_code' =>  $request->product_code,
            'product_ref_qr' =>  $request->product_ref_qr,
            'product_eval_package' =>  $request->product_eval_package,
            'product_expiration' => $request->product_expiration,
        ]);

        toast('Producto de Descarga Actualizado!', 'info');

        return redirect()->route('dischargeDetails.index');
    }



    public function destroy($id)
    {
        abort_if(Gate::denies('delete_admin'), 403);
        $dischargeDetails = DischargeDetails::findorFail($id);

        $dischargeDetails->delete();

        toast('Producto de Descarga Eliminado!', 'warning');

        return redirect()->route('dischargeDetails.index');
    }
}
