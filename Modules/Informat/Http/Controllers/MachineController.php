<?php
namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Machine;
use Modules\Informat\DataTables\MachineDataTable;

class MachineController extends Controller
{

    public function index(MachineDataTable $dataTable) {
        abort_if(Gate::denies('access_Informat_machines'), 403);

        return $dataTable->render('informat::machines.index');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_Informat_machines'), 403);

        $request->validate([
            'machine_code' => 'required',
            'machine_name' => 'required',
            'machine_model' => 'nullable',
            'machine_type' => 'nullable',
            'machine_serial' => 'nullable',
            'machine_factory' => 'nullable',
            'machine_country' => 'nullable'
        ]);

        Machine::create([
            'machine_code' => $request->machine_code,
            'machine_name' => $request->machine_name,
            'machine_model' => $request->machine_model,
            'machine_type' => $request->machine_type,
            'machine_serial' => $request->machine_serial,
            'machine_factory' => $request->machine_factory,
            'machine_country' => $request->machine_country
        ]);

        toast('Equipo creado!', 'success');

        return redirect()->back();
    }


    public function edit($id) {
        abort_if(Gate::denies('access_Informat_machines'), 403);

        $Machines = Machine::findOrFail($id);

        return view('informat::machines.edit', compact('Machines'));
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_Informat_machines'), 403);

        $request->validate([
            'machine_code' => 'required|unique:machines,machine_code,' . $id,
            'machine_name' => 'required',
            'machine_model' => 'nullable',
            'machine_type' => 'nullable',
            'machine_serial' => 'nullable',
            'machine_factory' => 'nullable',
            'machine_country' => 'nullable'
        ]);

        Machine::findOrFail($id)->update([
            'machine_code' => $request->machine_code,
            'machine_name' => $request->machine_name,
            'machine_model' => $request->machine_model,
            'machine_type' => $request->machine_type,
            'machine_serial' => $request->machine_serial,
            'machine_factory' => $request->machine_factory,
            'machine_country' => $request->machine_country
        ]);

        toast('Equipo actualizada!', 'info');

        return redirect()->route('machine.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('access_Informat_machines'), 403);

        $category = Machine::findOrFail($id);

   

        $category->delete();

        toast('Equipo Eliminado!', 'warning');

        return redirect()->route('machine.index');
    }
}
