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
        abort_if(Gate::denies('access_labelqrs'), 403);

        return $dataTable->render('preparation::preparationDetails.index');

    }







    public function edit($id)
    {

        abort_if(Gate::denies('edit_preparationDetails'), 403);

        $preparationDetails = PreparationDetails::findOrFail($id);
        return view('preparation::preparationDetails.edit', compact('preparationDetails'));
    }


    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('edit_preparationDetails'), 403);
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_state_preparation' => 'required',
            'product_coming_zone' => 'required',
            'product_type_process' => 'required',

        ]);

        preparationDetails::findOrFail($id)->update([
            'product_state_preparation' => $request->product_state_preparation,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_state_preparation' => $request->product_state_preparation,
            'product_coming_zone' => $request->product_coming_zone,
            'product_type_process' => $request->product_type_process,

        ]);
        toast('Producto preparation actualizado!', 'info');

        return redirect()->route('preparationDetails.index');
    }



    public function destroy($id)
    {
        abort_if(Gate::denies('delete_preparationDetails'), 403);
        $preparationDetails = PreparationDetails::findOrFail($id);
        $preparationDetails->delete();
        toast('Producto preparation Eliminado!', 'warning');

        return redirect()->route('preparationDetails.index');
    }
}
