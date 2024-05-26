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


    public function store(StoreTestbdRequest $request) {
        $testbd = Testbd::create($request->except('document'));

       
      
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
        if ($request->has('document')) {
            if (count($testbd->getMedia('images')) > 0) {
                foreach ($testbd->getMedia('images') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $testbd->getMedia('images')->pluck('file_name')->toArray();
            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $testbd->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                }
            }
        }

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
