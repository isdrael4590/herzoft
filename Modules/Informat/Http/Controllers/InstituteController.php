<?php

namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Institute;
use Modules\Informat\DataTables\InstituteDataTable;

class InstituteController extends Controller
{

    public function index(InstituteDataTable $dataTable) {
        abort_if(Gate::denies('access_Informat_institutes'), 403);

        return $dataTable->render('informat::institutes.index');
    }

    public function create() {
        abort_if(Gate::denies('create_products'), 403);

        return view('informat::institutes.create');
    }
    public function store(Request $request) {
        abort_if(Gate::denies('access_Informat_institutes'), 403);

        $request->validate([
            'institute_code' => 'required',
            'institute_name' => 'required',
            'institute_address' => 'nullable',
            'institute_area' => 'nullable',
            'institute_city' => 'nullable',
            'institute_country' => 'nullable'
        ]);

        Institute::create([
            'institute_code' => $request->institute_code,
            'institute_name' => $request->institute_name,
            'institute_address' => $request->institute_address,
            'institute_area' => $request->institute_area,
            'institute_city' => $request->institute_city,
            'institute_country' => $request->institute_country,
        ]);

        toast('Institución creado!', 'success');

        return redirect()->route('institute.index');
    }


    public function edit($id) {
        abort_if(Gate::denies('access_Informat_institutes'), 403);

        $institute = Institute::findOrFail($id);

        return view('informat::institutes.edit', compact('institute'));
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_Informat_institutes'), 403);

        $request->validate([
            'institute_code' => 'required|unique:institutes,institute_code,' . $id,
            'institute_name' => 'required',
            'institute_address' => 'nullable',
            'institute_area' => 'nullable',
            'institute_city' => 'nullable',
            'institute_country' => 'nullable'
        ]);

        Institute::findOrFail($id)->update([
            'institute_code' => $request->institute_code,
            'institute_name' => $request->institute_name,
            'institute_address' => $request->institute_address,
            'institute_area' => $request->institute_area,
            'institute_city' => $request->institute_city,
            'institute_country' => $request->institute_country,
        ]);

        toast('Institucion actualizada!', 'info');

        return redirect()->route('institute.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('access_Informat_institutes'), 403);

        $Institute = Institute::findOrFail($id);

    
        $Institute->delete();

        toast('Institución  Eliminada!', 'warning');

        return redirect()->route('institute.index');
    }
}
