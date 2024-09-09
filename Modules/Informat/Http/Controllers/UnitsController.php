<?php

namespace Modules\Informat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Informat\Entities\Unit;
use Illuminate\Support\Facades\Gate;


class   UnitsController extends Controller
{

    public function index() {
        abort_if(Gate::denies('access_informat_units'), 403);
        $units = Unit::all();

        return view('informat::units.index', [
            'units' => $units
        ]);
    }

    public function create() {
        return view('informat::units.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'       => 'required|string|max:255',
            'short_name' => 'required|string|max:255'
        ]);

        Unit::create([
            'name'            => $request->name,
            'short_name'      => $request->short_name,

        ]);

        toast('Unit Created!', 'success');

        return redirect()->route('units.index');
    }

    public function edit(Unit $unit) {
        return view('informat::units.edit', [
            'unit' => $unit
        ]);
    }

    public function update(Request $request, Unit $unit) {
        $request->validate([
            'name'       => 'required|string|max:255',
            'short_name' => 'required|string|max:255'
        ]);

        $unit->update([
            'name'            => $request->name,
            'short_name'      => $request->short_name,

        ]);

        toast('Unit Updated!', 'info');

        return redirect()->route('units.index');
    }

    public function destroy(Unit $unit) {
        $unit->delete();

        toast('Unit Deleted!', 'warning');

        return redirect()->route('units.index');
    }
}
