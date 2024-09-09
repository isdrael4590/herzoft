<?php

namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Lote;
use Modules\Informat\DataTables\LoteDataTable;

class LoteController extends Controller
{

    public function index(LoteDataTable $dataTable)
    {
        abort_if(Gate::denies('access_informat_lotes'), 403);

        return $dataTable->render('informat::lotes.index');
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('create_lotes'), 403);

        $request->validate([
            'lote_code' => 'required',
            'equipo_lote' => 'required',
            'tipo_lote' => 'required',
            'tipo_equipo' => 'required',
            'status_lote' => 'required',

        ]);

        Lote::create([
            'lote_code' => $request->lote_code,
            'equipo_lote' => $request->equipo_lote,
            'tipo_lote' => $request->tipo_lote,
            'tipo_equipo' => $request->tipo_equipo,
            'status_lote' => $request->status_lote,
        ]);

        toast('Equipo creado!', 'success');

        return redirect()->back();
    }


    public function edit($id)
    {
        abort_if(Gate::denies('edit_lotes'), 403);

        $lotes = lote::findOrFail($id);

        return view('informat::lotes.edit', compact('lotes'));
    }

    public function show(Lote $lote)
    {
        abort_if(Gate::denies('show_lotes'), 403);

        return view('informat::lotes.show', compact('lote'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('edit_lotes'), 403);

        $request->validate([
            'lote_code' => 'required|unique:lotes,lote_code,' . $id,
            'equipo_lote' => 'required',
            'tipo_lote' => 'required',
            'tipo_equipo' => 'nullable',
            'status_lote' => 'nullable',

        ]);

        Lote::findOrFail($id)->update([
            'lote_code' => $request->lote_code,
            'equipo_lote' => $request->equipo_lote,
            'tipo_lote' => $request->tipo_lote,
            'tipo_equipo' => $request->tipo_equipo,
            'status_lote' => $request->status_lote,

        ]);

        toast('Equipo actualizada!', 'info');

        return redirect()->route('lote.index');
    }


    public function destroy($id)
    {
        abort_if(Gate::denies('delete_lotes'), 403);

        $lote = Lote::findOrFail($id);
        $lote->delete();

        toast('Equipo Eliminado!', 'warning');

        return redirect()->route('lote.index');
    }
}
