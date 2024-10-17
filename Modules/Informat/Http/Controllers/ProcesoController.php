<?php

namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Proceso;
use Modules\Informat\DataTables\ProcesoDataTable;

class ProcesoController extends Controller
{

    public function index(ProcesoDataTable $dataTable) {
        abort_if(Gate::denies('access_informat_proceso'), 403);

        return $dataTable->render('informat::procesos.index');
    }

    public function create() {
        abort_if(Gate::denies('create_proceso'), 403);

        return view('informat::procesos.create');
    }
    public function store(Request $request) {
        abort_if(Gate::denies('create_proceso'), 403);

        $request->validate([
            'proceso_code' => 'required',
            'proceso_name' => 'required',
            'proceso_type' => 'nullable',
            'proceso_temp' => 'nullable',
        ]);

        Proceso::create([
            'proceso_code' => $request->proceso_code,
            'proceso_name' => $request->proceso_name,
            'proceso_type' => $request->proceso_type,
            'proceso_temp' => $request->proceso_temp,
         
        ]);

        toast('Proceso creado!', 'success');

        return redirect()->route('proceso.index');
    }


    public function edit($id) {
        abort_if(Gate::denies('edit_proceso'), 403);

        $proceso = Proceso::findOrFail($id);

        return view('informat::procesos.edit', compact('proceso'));
    }


    public function update(Request $request, $id) {

        $request->validate([
            'proceso_code' => 'required',
            'proceso_name' => 'required',
            'proceso_type' => 'nullable',
            'proceso_temp' => 'nullable',
     
        ]);

        Proceso::findOrFail($id)->update([
            'proceso_code' => $request->proceso_code,
            'proceso_name' => $request->proceso_name,
            'proceso_type' => $request->proceso_type,
            'proceso_temp' => $request->proceso_temp,
        ]);

        toast('Proceso actualizada!', 'info');

        return redirect()->route('proceso.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('delete_proceso'), 403);

        $proceso = Proceso::findOrFail($id);

    
        $proceso->delete();

        toast('Proceso  Eliminada!', 'warning');

        return redirect()->route('proceso.index');
    }
}
