<?php

namespace Modules\Testbd\Http\Controllers;

use Modules\Testbd\DataTables\TestvacuumDataTable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Testbd\Entities\Testvacuum;
use Modules\Testbd\Http\Requests\StoreTestVacuumRequest;
use Modules\Testbd\Http\Requests\UpdateTestVacuumRequest;
use Modules\Informat\Entities\Lote;

class TestvacuumController extends Controller
{

    public function index(TestvacuumDataTable $dataTable) {
        abort_if(Gate::denies('access_testvacuums'), 403);

        return $dataTable->render('testbd::testvacuums.index');
    }

    public function create() {
        abort_if(Gate::denies('create_testvacuums'), 403);

        return view('testbd::testvacuums.create');
    }


    public function store(StoreTestVacuumRequest $request ) {
        $Testvacuum = Testvacuum::create($request->except('document'));

        $request->validate([
            'lote_code' => 'nullable',
            'equipo_lote' => 'nullable',
            'tipo_lote' => 'nullable',
            'tipo_equipo' => 'nullable',
            'status_lote' => 'nullable',
        ]);
        Lote::create([
            'lote_code' => $request->lote_machine,
            'equipo_lote' => $request->machine_name,
            'tipo_lote' => "Test Vacio",
            'tipo_equipo' => $request->tipo_equipo,
            'status_lote' => $request->validation_vacuum,
        ]);
      
        toast('Test de vacio Creado!', 'success');

        return redirect()->route('testvacuums.index');
    }


    public function show(Testvacuum $testvacuum) {
        abort_if(Gate::denies('show_testvacuums'), 403);
        return view('testbd::testvacuums.show', compact('testvacuum'));
    }

    public function edit(Testvacuum $testvacuum) {
        abort_if(Gate::denies('edit_testvacuums'), 403);

        return view('testbd::testvacuums.edit', compact('testvacuum'));
    }


    public function update(UpdateTestVacuumRequest $request, Testvacuum $testvacuum) {
        $testvacuum->update($request->except('document'));
 


        toast('Testvacuum Actualizado!', 'info');
        return redirect()->route('testvacuums.index');
    }


    public function destroy(Testvacuum $testvacuum) {
        abort_if(Gate::denies('delete_Testvacuums'), 403);
        $testvacuum->delete();
        toast('test Vacio Eliminado!', 'warning');
        return redirect()->route('testvacuums.index');
    }
}
