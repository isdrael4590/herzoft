<?php

namespace Modules\Testbd\Http\Controllers;

use Modules\Testbd\DataTables\TestbdDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Modules\Testbd\Entities\Testbd;
use Modules\Testbd\Http\Requests\StoreTestbdRequest;
use Modules\Testbd\Http\Requests\UpdateTestbdRequest;
use Modules\Upload\Entities\Upload;
use Modules\Informat\Entities\Lote;

class TestbdController extends Controller
{

    public function index(TestbdDataTable $dataTable) {
        abort_if(Gate::denies('access_testbds'), 403);

        return $dataTable->render('testbd::testbds.index');
    }

    public function create() {
        abort_if(Gate::denies('create_testbds'), 403);

        return view('testbd::testbds.create');
    }


    public function store(StoreTestbdRequest $request ) {
        $testbd = Testbd::create($request->except('document'));

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
            'tipo_lote' => "TEST BOWIE & DICK",
            'tipo_equipo' => "Autoclave",
            'status_lote' => $request->validation_bd,
        ]);
      
        toast('test BD Creado!', 'success');

        return redirect()->route('testbds.index');
    }


    public function show(Testbd $testbd) {
        abort_if(Gate::denies('show_testbds'), 403);
        return view('testbd::testbds.show', compact('testbd'));
    }

    public function edit(Testbd $testbd) {
        abort_if(Gate::denies('edit_testbds'), 403);

        return view('testbd::testbds.edit', compact('testbd'));
    }


    public function update(UpdateTestbdRequest $request, Testbd $testbd) {
        $testbd->update($request->except('document'));
 


        toast('Testbd Actualizado!', 'info');
        return redirect()->route('testbds.index');
    }


    public function destroy(Testbd $testbd) {
        abort_if(Gate::denies('delete_testbds'), 403);
        $testbd->delete();
        toast('Testbd Eliminado!', 'warning');
        return redirect()->route('testbds.index');
    }
}
