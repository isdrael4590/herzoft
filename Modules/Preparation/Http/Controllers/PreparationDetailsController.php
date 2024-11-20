<?php

namespace Modules\Preparation\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Preparation\DataTables\PreparationDetailsDataTable;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use Modules\Preparation\Entities\PreparationDetails;





class PreparationDetailsController extends Controller
{

    public function index(PreparationDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_preparations'), 403);

        return $dataTable->render('preparation::preparationDetails.index');

    }







    public function edit($id)
    {

        abort_if(Gate::denies('edit_preparations'), 403);

        $preparationDetails = PreparationDetails::findOrFail($id);
        return view('preparation::preparationDetails.edit', compact('preparationDetails'));
    }


    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('edit_preparations'), 403);
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_state_preparation' => 'required',
            'product_coming_zone' => 'required',
            'product_type_process' => 'required',
            'product_patient' => 'nullable',
            'product_area' => 'nullable',
            'product_outside_company' => 'nullable',

        ]);

        preparationDetails::findOrFail($id)->update([
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_state_preparation' => $request->product_state_preparation,
            'product_coming_zone' => $request->product_coming_zone,
            'product_type_process' => $request->product_type_process,
            'product_patient' => $request->product_patient,
            'product_area' => $request->product_area,
            'product_outside_company' => $request->product_outside_company,

        

        ]);
        toast('Producto preparation actualizado!', 'info');

        return redirect()->route('preparationDetails.index');
    }



    public function destroy($id)
    {
        abort_if(Gate::denies('delete_preparations'), 403);
        $preparationDetails = PreparationDetails::findOrFail($id);
        $preparationDetails->delete();
        toast('Producto preparation Eliminado!', 'warning');

        return redirect()->route('preparationDetails.index');
    }
}
