<?php

namespace Modules\Lavado\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Lavado\DataTables\LavadoDataTable;
use Modules\Lavado\Entities\Lavado;
use Modules\Lavado\Entities\LavadoDetalle;
use Modules\Lavado\Entities\PrelavadoDetalle;

class LavadoController extends Controller
{
    public function index(LavadoDataTable $dataTable)
    {
        return $dataTable->render('lavado::lavados.index');
    }

    public function create()
    {
        Cart::instance('lavados')->destroy();

        return view('lavado::lavados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'operator'     => 'required|string|max:255',
            'machine_name' => 'nullable|string|max:255',
            'lote'         => 'required|string|max:255',
            'type_program' => 'nullable|string|max:255',
            'temperatura'  => 'required|numeric',
            'status_indicador'       => 'required|string',
            'status_ciclo' => 'required|in:En Curso,Ciclo Correcto,Ciclo con Falla,Pendiente,Cargar',
            'note'         => 'nullable|string|max:1000',
        ]);

        $cartItems = Cart::instance('lavados')->content();

        try {
            DB::beginTransaction();

            $lavado = Lavado::create([
                'operator'        => $request->operator,
                'equipo'          => $request->machine_name,
                'lote'            => $request->lote,
                'programa_lavado' => $request->type_program,
                'temperatura'     => $request->temperatura,
                'status_ciclo'    => $request->status_ciclo,
                'note'            => $request->note,
            ]);

            foreach ($cartItems as $item) {
                LavadoDetalle::create([
                    'lavado_id'               => $lavado->id,
                    'product_id'              => $item->options->product_id ?? null,
                    'product_name'            => $item->name,
                    'product_code'            => $item->options->code ?? '',
                    'product_quantity'        => $item->qty,
                    'product_patient'         => $item->options->product_patient ?? '',
                    'product_info'            => $item->options->product_info ?? '',
                    'product_outside_company' => $item->options->product_outside_company ?? '',
                    'product_area'            => $item->options->product_area ?? '',
                    'product_type_process'    => $item->options->product_type_process ?? '',
                ]);

                // Solo descontar del prelavado si el ciclo fue correcto
                if ($request->status_ciclo === 'Ciclo Correcto') {
                    $prelavadoDetalle = PrelavadoDetalle::find($item->id);
                    if ($prelavadoDetalle) {
                        $nuevo = max(0, $prelavadoDetalle->product_quantity - $item->qty);
                        $prelavadoDetalle->update(['product_quantity' => $nuevo]);
                    }
                }
            }

            Cart::instance('lavados')->destroy();

            DB::commit();

            toast('Lavado registrado exitosamente.', 'success');
            return redirect()->route('lavados.index');

        } catch (\Exception) {
            DB::rollBack();
            toast('Error al registrar el lavado.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function show(Lavado $lavado)
    {
        $lavado->load('lavadoDetalles', 'reception');

        return view('lavado::lavados.show', compact('lavado'));
    }

    public function edit(Lavado $lavado)
    {
        Cart::instance('lavados')->destroy();

        $lavado->load('lavadoDetalles');

        foreach ($lavado->lavadoDetalles as $det) {
            $prelavadoDetalle = PrelavadoDetalle::where('product_code', $det->product_code)->first();
            $prelavadoId      = $prelavadoDetalle ? $prelavadoDetalle->id : 0;
            $checkQty         = $det->product_quantity + ($prelavadoDetalle ? $prelavadoDetalle->product_quantity : 0);

            Cart::instance('lavados')->add([
                'id'     => $prelavadoId,
                'name'   => $det->product_name,
                'qty'    => $det->product_quantity,
                'price'  => 0,
                'weight' => 1,
                'options' => [
                    'product_id'              => $det->product_id,
                    'code'                    => $det->product_code,
                    'product_quantity'        => $checkQty,
                    'product_type_process'    => $det->product_type_process ?? '',
                    'product_patient'         => $det->product_patient ?? '',
                    'product_info'            => $det->product_info ?? '',
                    'product_area'            => $det->product_area ?? '',
                    'product_outside_company' => $det->product_outside_company ?? '',
                    'product_type_dirt'       => 'CRITICO',
                    'product_state_rumed'     => 'BUENO',
                    'unit'                    => '',
                    'unit_price'              => 0,
                    'sub_total'               => 0,
                ],
            ]);
        }

        return view('lavado::lavados.edit', compact('lavado'));
    }

    public function update(Request $request, Lavado $lavado)
    {
        $request->validate([
            'operator'     => 'required|string|max:255',
            'machine_name' => 'nullable|string|max:255',
            'lote'         => 'required|string|max:255',
            'type_program' => 'nullable|string|max:255',
            'temperatura'  => 'required|numeric',
            'status_indicador'       => 'required|string',
            'status_ciclo' => 'required|in:En Curso,Ciclo Correcto,Ciclo con Falla,Pendiente,Cargar',
            'note'         => 'nullable|string|max:1000',
        ]);

        $cartItems = Cart::instance('lavados')->content();
        $previousStatusCiclo = $lavado->status_ciclo;

        try {
            DB::beginTransaction();

            $lavado->update([
                'operator'        => $request->operator,
                'equipo'          => $request->machine_name,
                'lote'            => $request->lote,
                'programa_lavado' => $request->type_program,
                'temperatura'     => $request->temperatura,
                'status_indicador'          => $request->status_indicador,
                'status_ciclo'    => $request->status_ciclo,
                'note'            => $request->note,
            ]);

            // Restaurar cantidades al prelavado solo si el ciclo anterior fue correcto
            // (solo ese caso había descontado stock)
            if ($previousStatusCiclo === 'Ciclo Correcto') {
                foreach ($lavado->lavadoDetalles as $det) {
                    $prelavadoDetalle = PrelavadoDetalle::where('product_code', $det->product_code)->first();
                    if ($prelavadoDetalle) {
                        $prelavadoDetalle->increment('product_quantity', $det->product_quantity);
                    }
                }
            }

            // Borrar detalles anteriores y recrear desde el carrito
            $lavado->lavadoDetalles()->delete();

            foreach ($cartItems as $item) {
                LavadoDetalle::create([
                    'lavado_id'               => $lavado->id,
                    'product_id'              => $item->options->product_id ?? null,
                    'product_name'            => $item->name,
                    'product_code'            => $item->options->code ?? '',
                    'product_quantity'        => $item->qty,
                    'product_patient'         => $item->options->product_patient ?? '',
                    'product_info'            => $item->options->product_info ?? '',
                    'product_outside_company' => $item->options->product_outside_company ?? '',
                    'product_area'            => $item->options->product_area ?? '',
                    'product_type_process'    => $item->options->product_type_process ?? '',
                ]);

                // Solo descontar del prelavado si el nuevo ciclo es correcto
                if ($request->status_ciclo === 'Ciclo Correcto') {
                    $prelavadoDetalle = PrelavadoDetalle::find($item->id);
                    if ($prelavadoDetalle) {
                        $nuevo = max(0, $prelavadoDetalle->product_quantity - $item->qty);
                        $prelavadoDetalle->update(['product_quantity' => $nuevo]);
                    }
                }
            }

            Cart::instance('lavados')->destroy();

            DB::commit();

            toast('Lavado actualizado.', 'success');
            return redirect()->route('lavados.index');

        } catch (\Exception) {
            DB::rollBack();
            toast('Error al actualizar el lavado.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Lavado $lavado)
    {
        $lavado->delete();

        toast('Lavado eliminado.', 'success');
        return redirect()->route('lavados.index');
    }
}
