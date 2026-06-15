<?php

namespace Modules\Lavado\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\Lavado\DataTables\DescargaLavadoDataTable;
use Modules\Lavado\Entities\DescargaLavado;
use Modules\Lavado\Entities\DescargaLavadoDetalle;
use Modules\Lavado\Entities\Lavado;
use Modules\Lavado\Entities\PrelavadoDetalle;

class DescargaLavadoController extends Controller
{
    public function index(DescargaLavadoDataTable $dataTable)
    {
        return $dataTable->render('lavado::descarga-lavado.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lavado_id'    => 'required|exists:lavados,id',
            'operator'     => 'required|string|max:255',
            'machine_name' => 'nullable|string|max:255',
            'lote'         => 'required|string|max:255',
            'type_program' => 'nullable|string|max:255',
            'temperatura'  => 'required|numeric',
            'status_ciclo'      => 'required|in:En Curso,Pendiente,Cargar,Ciclo Correcto,Ciclo con Falla',
            'status_indicador'  => 'nullable|string',
            'status'       => 'nullable|string',
            'note'         => 'nullable|string|max:1000',
        ]);

        $lavado = Lavado::with('lavadoDetalles')->findOrFail($request->lavado_id);

        try {
            DB::beginTransaction();

            $nextId = (DescargaLavado::max('id') ?? 0) + 1;
            $reference = 'DESC_' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

            $descarga = DescargaLavado::create([
                'lavado_id'       => $lavado->id,
                'reference'       => $reference,
                'operator'        => $request->operator,
                'equipo'          => $request->machine_name,
                'lote'            => $request->lote,
                'programa_lavado' => $request->type_program,
                'temperatura'     => $request->temperatura,
                'status_ciclo'     => $request->status_ciclo,
                'status_indicador' => $request->status_indicador ?? 'Sin Validar',
                'status'          => $request->status,
                'note'            => $request->note,
            ]);

            $lavado->update(['status_ciclo' => 'En Curso']);

            foreach ($lavado->lavadoDetalles as $det) {
                DescargaLavadoDetalle::create([
                    'descarga_lavado_id'      => $descarga->id,
                    'lavado_detalle_id'       => $det->id,
                    'product_id'              => $det->product_id,
                    'product_name'            => $det->product_name,
                    'product_code'            => $det->product_code,
                    'product_quantity'        => $det->product_quantity,
                    'product_patient'         => $det->product_patient,
                    'product_info'            => $det->product_info,
                    'product_outside_company' => $det->product_outside_company,
                    'product_area'            => $det->product_area,
                    'product_type_process'    => $det->product_type_process,
                ]);
            }

            DB::commit();

            toast('Descarga de lavado registrada exitosamente.', 'success');
            return redirect()->route('descarga-lavado.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar la descarga: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->except(['_token']),
            ]);
            toast('Error al registrar la descarga.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function show(DescargaLavado $descargaLavado)
    {
        $descargaLavado->load(['lavado', 'descargaLavadoDetalles']);

        return view('lavado::descarga-lavado.show', compact('descargaLavado'));
    }

    public function edit(DescargaLavado $descargaLavado)
    {
        $descargaLavado->load(['lavado', 'descargaLavadoDetalles']);

        return view('lavado::descarga-lavado.edit', compact('descargaLavado'));
    }

    public function update(Request $request, DescargaLavado $descargaLavado)
    {
        $request->validate([
            'temperatura'      => 'required|numeric',
            'status_ciclo'     => 'required|in:En Curso,Ciclo Correcto,Ciclo con Falla',
            'status_indicador' => 'required|in:Sin Validar,Correcto,Falla',
            'note'             => 'nullable|string|max:1000',
        ]);

        $previousStatusCiclo = $descargaLavado->status_ciclo;

        try {
            DB::beginTransaction();

            $updateData = [
                'temperatura'      => $request->temperatura,
                'status_ciclo'     => $request->status_ciclo,
                'status_indicador' => $request->status_indicador,
                'note'             => $request->note,
            ];

            if (Gate::allows('access_admin') && $request->filled('status')) {
                $updateData['status'] = $request->status;
            }

            $descargaLavado->update($updateData);

            $descargaLavado->lavado->update([
                'status_ciclo'     => $request->status_ciclo,
                'status_indicador' => $request->status_indicador,
            ]);

            // Descontar del prelavado solo cuando cambia A "Ciclo Correcto"
            if ($request->status_ciclo === 'Ciclo Correcto' && $previousStatusCiclo !== 'Ciclo Correcto') {
                $descargaLavado->load('descargaLavadoDetalles');

                foreach ($descargaLavado->descargaLavadoDetalles as $det) {
                    $qty = $det->product_quantity;

                    $rows = PrelavadoDetalle::where('product_code', $det->product_code)
                        ->where('product_quantity', '>', 0)
                        ->orderBy('id')
                        ->get();

                    foreach ($rows as $row) {
                        if ($qty <= 0) break;
                        $descuento = min($qty, $row->product_quantity);
                        $row->update(['product_quantity' => $row->product_quantity - $descuento]);
                        $qty -= $descuento;
                    }
                }
            }

            DB::commit();

            toast('Descarga actualizada exitosamente.', 'success');
            return redirect()->route('descarga-lavado.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar la descarga: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            toast('Error al actualizar la descarga.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(DescargaLavado $descargaLavado)
    {
        $descargaLavado->delete();

        toast('Descarga eliminada.', 'success');
        return redirect()->route('descarga-lavado.index');
    }
}
