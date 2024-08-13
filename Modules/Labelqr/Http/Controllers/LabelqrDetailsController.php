<?php

namespace Modules\Labelqr\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Modules\Labelqr\DataTables\LabelqrDetailsDataTable;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Preparation\Entities\PreparationDetails;

class LabelqrDetailsController extends Controller

{
    public function index(LabelqrDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_zne_area'), 403);

        return $dataTable->render('labelqr::labelqrDetails.index');
    }




    public function edit($id)
    {
        abort_if(Gate::denies('edit_labelqrDetails'), 403);
        $labelqrDetails = LabelqrDetails::findOrFail($id);


        return view('labelqr::labelqrDetails.edit', compact('labelqrDetails'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('edit_labelqrDetails'), 403);

        $request->validate([
            'preparation_detail_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_ref_qr' => 'required',

        ]);

        LabelqrDetails::findOrFail($id)->update([
            'preparation_detail_id' => $request->preparation_detail_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_ref_qr' => $request->product_ref_qr,

        ]);
        if ($request->product_ref_qr == 'NO USADO') {
            $preparation_detail = PreparationDetails::findOrFail($request->preparation_detail_id);
            $preparation_detail->update([
                'product_state_preparation' => 'Disponible',
            ]);
        }

        toast('Producto preparation actualizado!', 'info');

        return redirect()->route('labelqrDetails.index');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('delete_labelqrDetails'), 403);

        $labelqrDetails = LabelqrDetails::findOrFail($id);
        $labelqrDetails->delete();

        toast('labelqr Deleted!', 'warning');

        return redirect()->route('labelqrDetails.index');
    }
}
