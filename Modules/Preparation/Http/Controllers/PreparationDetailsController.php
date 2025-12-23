<?php

namespace Modules\Preparation\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Preparation\DataTables\PreparationDetailsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Preparation\Entities\PreparationDetails;
use Modules\Preparation\Entities\PreparationQuantityReset;

class PreparationDetailsController extends Controller
{
    public function index(PreparationDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_preparations'), 403);
        return $dataTable->render('preparation::preparationDetails.index');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('edit_preparations'), 403);
        $preparationDetails = PreparationDetails::findOrFail($id);
        return view('preparation::preparationDetails.edit', compact('preparationDetails'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('edit_preparations'), 403);

        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_state_preparation' => 'required',
            'product_coming_zone' => 'required',
            'product_type_process' => 'required',
            'product_patient' => 'nullable',
            'product_info' => 'nullable',
            'product_area' => 'nullable',
            'product_outside_company' => 'nullable',
        ]);

        PreparationDetails::findOrFail($id)->update([
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_state_preparation' => $request->product_state_preparation,
            'product_coming_zone' => $request->product_coming_zone,
            'product_type_process' => $request->product_type_process,
            'product_patient' => $request->product_patient,
            'product_area' => $request->product_area,
            'product_outside_company' => $request->product_outside_company,
            'product_info' => $request->product_info,
        ]);

        toast('Producto preparation actualizado!', 'info');
        return redirect()->route('preparationDetails.index');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('delete_preparations'), 403);
        $preparationDetails = PreparationDetails::findOrFail($id);
        $preparationDetails->delete();
        toast('Producto preparation Eliminado!', 'warning');
        return redirect()->route('preparationDetails.index');
    }
    public function resetQuantities(Request $request)
    {
        abort_if(Gate::denies('reset_preparations'), 403);

        DB::beginTransaction();

        try {
            $userId = Auth::id();
            $resetTime = now();

            // Resetear TODOS los items con cantidad > 0
            $itemsToReset = PreparationDetails::where('product_quantity', '>', 0)->get();

            \Log::info('Reset de cantidades iniciado', [
                'user_id' => $userId,
                'items_count' => $itemsToReset->count(),
                'timestamp' => $resetTime
            ]);

            if ($itemsToReset->isEmpty()) {
                DB::rollBack();
                toast('No hay productos con cantidades para reiniciar.', 'info');
                return redirect()->route('preparationDetails.index');
            }

            $resetCount = 0;
            $errors = [];

            foreach ($itemsToReset as $item) {
                try {
                    // Registrar en historial
                    PreparationQuantityReset::create([
                        'preparation_detail_id' => $item->id,
                        'user_id' => $userId,
                        'previous_quantity' => $item->product_quantity,
                        'new_quantity' => 0,
                        'product_name' => $item->product_name,
                        'product_code' => $item->product_code,
                        'product_area' => $item->product_area ?? null,
                        'product_type_process' => $item->product_type_process,
                        'reset_at' => $resetTime,
                    ]);

                    // Actualizar cantidad a 0
                    $item->update(['product_quantity' => 0]);

                    $resetCount++;
                } catch (\Exception $itemError) {
                    $errors[] = "Item {$item->id}: {$itemError->getMessage()}";
                    \Log::error('Error al resetear item individual', [
                        'item_id' => $item->id,
                        'error' => $itemError->getMessage()
                    ]);
                }
            }

            if ($resetCount === 0) {
                DB::rollBack();
                $errorMsg = 'No se pudo resetear ningún producto.';
                if (!empty($errors)) {
                    $errorMsg .= ' Errores: ' . implode('; ', array_slice($errors, 0, 3));
                }
                toast($errorMsg, 'error');
                return redirect()->route('preparationDetails.index');
            }

            DB::commit();

            $message = "✓ Se reiniciaron las cantidades de {$resetCount} producto(s) correctamente!";
            if (!empty($errors)) {
                $message .= " (con " . count($errors) . " error(es))";
            }

            \Log::info('Reset completado exitosamente', [
                'user_id' => $userId,
                'items_reset' => $resetCount,
                'errors_count' => count($errors)
            ]);

            toast($message, 'success');
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error crítico al resetear cantidades', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            toast('Error al reiniciar cantidades: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('preparationDetails.index');
    }

    public function resetHistory()
    {
        abort_if(Gate::denies('access_preparations'), 403);

        $resets = PreparationQuantityReset::with(['user', 'preparationDetail'])
            ->orderBy('reset_at', 'desc')
            ->paginate(20);

        return view('preparation::preparationDetails.reset-history', compact('resets'));
    }
}
