<?php

namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Area;
use Modules\Informat\DataTables\AreaDataTable;
use Modules\Product\Entities\Category;

class AreaController extends Controller
{

    public function index(AreaDataTable $dataTable)
    {
        abort_if(Gate::denies('access_informat_areas'), 403);

        return $dataTable->render('informat::areas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_areas'), 403);

        return view('informat::areas.create');
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('create_areas'), 403);

    $category_max_id = \Modules\Product\Entities\Category::max('id') + 1;
    $category_code = "CA_" . str_pad($category_max_id, 2, '0', STR_PAD_LEFT);

        $request->validate([
            'area_code' => 'required',
            'area_name' => 'required',
            'area_responsable' => 'nullable',
            'area_piso' => 'nullable',
            'category_code' => 'required|unique:categories,category_code',

        ]);

        Area::create([
            'area_code' => $request->area_code,
            'area_name' => $request->area_name,
            'area_responsable' => $request->area_responsable,
            'area_piso' => $request->area_piso,

        ]);

       Category::create([
            'category_code' => $request->category_code,
            'category_name' => $request->area_name,
        ]);

        toast('Institución creado!', 'success');

        return redirect()->route('area.index');
    }


    public function edit($id)
    {
        abort_if(Gate::denies('edit_areas'), 403);

        $area = Area::findOrFail($id);

        return view('informat::areas.edit', compact('area'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'area_code' => 'required',
            'area_name' => 'required',
            'area_responsable' => 'nullable',
            'area_piso' => 'nullable',

        ]);

        area::findOrFail($id)->update([
            'area_code' => $request->area_code,
            'area_name' => $request->area_name,
            'area_responsable' => $request->area_responsable,
            'area_piso' => $request->area_piso,
        ]);

        toast('Institucion actualizada!', 'info');

        return redirect()->route('area.index');
    }


    public function destroy($id)
    {
        abort_if(Gate::denies('delete_areas'), 403);

        $area = area::findOrFail($id);


        $area->delete();

        toast('Institución  Eliminada!', 'warning');

        return redirect()->route('area.index');
    }
}
