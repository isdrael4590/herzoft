<?php

namespace Modules\Product\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Product\DataTables\InstrumentalDataTable;
use Modules\Product\Entities\Instrumental;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\SubProduct;
use Modules\Product\Http\Requests\StoreInstrumentalRequest;

class InstrumentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InstrumentalDataTable $dataTable)
    {
        abort_if(Gate::denies('access_products'), 403);
        return $dataTable->render('product::instrumental.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('create_products'), 403);
        return view('product::instrumental.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstrumentalRequest $request)
    {
        try {
            $instrumental = Instrumental::create([
                'codigo_unico_ud' => $request->codigo_unico_ud,
                'nombre_generico' => $request->nombre_generico,
                'tipo_familia' => $request->tipo_familia,
                'marca_fabricante' => $request->marca_fabricante,
                'fecha_compra' => $request->fecha_compra,
                'estado_actual' => $request->estado_actual,
            ]);

            toast('Instrumental creado exitosamente', 'success');
            return redirect()->route('instrumental.index');
        } catch (\Exception $e) {
            Log::error('Error al crear instrumental: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear el instrumental');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Instrumental $instrumental)
    {
        abort_if(Gate::denies('show_instrumentals'), 403);

        // Cargar la relación con el producto si existe
        $instrumental->load('product');

        return view('product::instrumental.show', compact('instrumental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instrumental $instrumental)
    {
        return view('product::instrumental.edit', compact('instrumental'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInstrumentalRequest $request, Instrumental $instrumental)
    {
        try {
            $instrumental->update([
                'product_id' => $request->product_id,
                'codigo_unico_ud' => $request->codigo_unico_ud,
                'nombre_generico' => $request->nombre_generico,
                'tipo_familia' => $request->tipo_familia,
                'marca_fabricante' => $request->marca_fabricante,
                'fecha_compra' => $request->fecha_compra,
                'estado_actual' => $request->estado_actual,
            ]);

            toast('Instrumental actualizado exitosamente', 'success');

            return redirect()->route('instrumental.index');
        } catch (\Exception $e) {
            Log::error('Error al actualizar instrumental: ' . $e->getMessage());

            toast('Error al actualizar el instrumental', 'error');

            return redirect()
                ->back()
                ->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instrumental $instrumental)
    {
        abort_if(Gate::denies('delete_products'), 403);

        // ✅ VALIDACIÓN CRÍTICA: No permitir eliminar si está enlazado a un producto
        if (!is_null($instrumental->product_id)) {
            $productName = optional($instrumental->product)->product_name ?? 'Desconocido';
            
            return redirect()
                ->route('instrumental.index')
                ->with('error', "⚠️ No se puede eliminar este instrumental. Está asignado al paquete: '{$productName}'. Primero debe removerlo del paquete.");
        }

        try {
            DB::beginTransaction();
            

            
            $instrumental->delete();
            
            DB::commit();
            
            return redirect()
                ->route('instrumental.index')
                ->with('success', '✅ Instrumental eliminado exitosamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
 
            
            return redirect()
                ->back()
                ->with('error', '❌ Error al eliminar el Instrumental: ' . $e->getMessage());
        }
    }
}

