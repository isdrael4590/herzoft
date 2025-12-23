<?php

namespace Modules\Preparation\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\Product\Entities\Product;
use Modules\Preparation\Entities\Preparation;
use Modules\Preparation\DataTables\PreparationDetailsDataTable;
use Modules\Preparation\DataTables\PreparationDataTable;
use Modules\Reception\Entities\Reception;
use Modules\Reception\Entities\ReceptionDetails;
use Modules\Preparation\Entities\PreparationDetails;
use Modules\Preparation\Http\Requests\StorePreparationRequest;
use Modules\Preparation\Http\Requests\UpdatePreparationRequest;

class PreparationController extends Controller
{
    /**
     * Instancia del carrito de preparación
     */
    private const CART_INSTANCE = 'preparation';

    /**
     * Display a listing of the resource.
     */
    public function index(PreparationDataTable $dataTable)
    {
        abort_if(Gate::denies('access_preparations'), 403);

        return $dataTable->render('preparation::preparations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($reception_id)
    {
        abort_if(Gate::denies('create_preparations'), 403);

        try {
            $reception = Reception::findOrFail($reception_id);
            
            // Verificar que la recepción no esté ya procesada
            if ($reception->status === 'Procesado') {
                toast('Esta recepción ya ha sido procesada.', 'warning');
                return redirect()->route('receptions.index');
            }

            // Limpiar el carrito antes de crear una nueva preparación
            Cart::instance(self::CART_INSTANCE)->destroy();

            return view('preparation::preparations.create', compact('reception'));
            
        } catch (\Exception $e) {
            Log::error('Error al crear preparación: ' . $e->getMessage());
            toast('Error al cargar la recepción.', 'error');
            return redirect()->route('receptions.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreparationRequest $request)
    {
        abort_if(Gate::denies('create_preparations'), 403);

        try {
            DB::beginTransaction();

            // Verificar que el carrito no esté vacío
            $cartContent = Cart::instance(self::CART_INSTANCE)->content();
            
            if ($cartContent->isEmpty()) {
                DB::rollBack();
                toast('El carrito está vacío. Agregue productos antes de guardar.', 'warning');
                return redirect()->back();
            }

            // Verificar que la recepción existe
            $reception = Reception::findOrFail($request->reception_id);

            // Crear la preparación
            $preparation = Preparation::create([
                'reception_id' => $request->reception_id,
                'operator' => $request->operator,
                'note' => $request->note,
                'total_amount' => $request->total_amount ?? 0,
            ]);

            // Actualizar el estado de la recepción
            $reception->update([
                'status' => 'Procesado',
            ]);

            // Crear los detalles de la preparación
            foreach ($cartContent as $cart_item) {
                PreparationDetails::create([
                    'preparation_id' => $preparation->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_quantity' => $cart_item->qty,
                    'price' => $cart_item->price ?? 0,
                    'unit_price' => $cart_item->options->unit_price ?? 0,
                    'product_code' => $cart_item->options->code ?? '',
                    'product_type_process' => $cart_item->options->product_type_process ?? null,
                    'product_state_preparation' => $cart_item->options->product_state_preparation ?? 'Recepcion',
                    'product_coming_zone' => $cart_item->options->product_coming_zone ?? null,
                    'product_patient' => $cart_item->options->product_patient ?? null,
                    'product_outside_company' => $cart_item->options->product_outside_company ?? null,
                    'product_area' => $cart_item->options->product_area ?? null,
                    'product_info' => $cart_item->options->product_info ?? null,
                ]);
            }

            // Limpiar el carrito después de guardar
            Cart::instance(self::CART_INSTANCE)->destroy();

            DB::commit();

            toast('¡Preparación registrada exitosamente!', 'success');
            return redirect()->route('receptions.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar preparación: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            toast('Error al guardar la preparación. Por favor, intente nuevamente.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Preparation $preparation)
    {
        abort_if(Gate::denies('show_preparations'), 403);

        // Cargar las relaciones necesarias
        $preparation->load(['preparationDetails', 'reception']);

        return view('preparation::preparations.show', compact('preparation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Preparation $preparation)
    {
        abort_if(Gate::denies('edit_preparations'), 403);

        try {
            // Cargar los detalles de la preparación
            $preparation->load('preparationDetails');

            // Limpiar el carrito antes de editar
            Cart::instance(self::CART_INSTANCE)->destroy();

            $cart = Cart::instance(self::CART_INSTANCE);

            // Agregar los items existentes al carrito
            foreach ($preparation->preparationDetails as $detail) {
                $cart->add([
                    'id' => $detail->product_id,
                    'name' => $detail->product_name,
                    'qty' => $detail->product_quantity,
                    'price' => $detail->price ?? 0,
                    'weight' => 1,
                    'options' => [
                        'code' => $detail->product_code,
                        'product_type_process' => $detail->product_type_process,
                        'product_state_preparation' => $detail->product_state_preparation,
                        'product_coming_zone' => $detail->product_coming_zone,
                        'product_patient' => $detail->product_patient,
                        'product_outside_company' => $detail->product_outside_company,
                        'product_area' => $detail->product_area,
                        'unit_price' => $detail->unit_price ?? 0,
                        'product_info' => $detail->product_info,
                    ]
                ]);
            }

            return view('preparation::preparations.edit', compact('preparation'));
            
        } catch (\Exception $e) {
            Log::error('Error al editar preparación: ' . $e->getMessage());
            toast('Error al cargar la preparación para editar.', 'error');
            return redirect()->route('preparations.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePreparationRequest $request, Preparation $preparation)
    {
        abort_if(Gate::denies('edit_preparations'), 403);

        try {
            DB::beginTransaction();

            // Verificar que el carrito no esté vacío
            $cartContent = Cart::instance(self::CART_INSTANCE)->content();
            
            if ($cartContent->isEmpty()) {
                DB::rollBack();
                toast('El carrito está vacío. Agregue productos antes de actualizar.', 'warning');
                return redirect()->back();
            }

            // Eliminar los detalles antiguos
            $preparation->preparationDetails()->delete();

            // Actualizar la preparación
            $preparation->update([
                'operator' => $request->operator,
                'note' => $request->note,
                'total_amount' => $request->total_amount ?? 0,
            ]);

            // Crear los nuevos detalles
            foreach ($cartContent as $cart_item) {
                PreparationDetails::create([
                    'preparation_id' => $preparation->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_quantity' => $cart_item->qty,
                    'price' => $cart_item->price ?? 0,
                    'unit_price' => $cart_item->options->unit_price ?? 0,
                    'product_code' => $cart_item->options->code ?? '',
                    'product_type_process' => $cart_item->options->product_type_process ?? null,
                    'product_state_preparation' => $cart_item->options->product_state_preparation ?? 'Recepcion',
                    'product_coming_zone' => $cart_item->options->product_coming_zone ?? null,
                    'product_patient' => $cart_item->options->product_patient ?? null,
                    'product_outside_company' => $cart_item->options->product_outside_company ?? null,
                    'product_area' => $cart_item->options->product_area ?? null,
                    'product_info' => $cart_item->options->product_info ?? null,
                ]);
            }

            // Limpiar el carrito
            Cart::instance(self::CART_INSTANCE)->destroy();

            DB::commit();

            toast('¡Preparación actualizada exitosamente!', 'success');
            return redirect()->route('preparations.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar preparación: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'preparation_id' => $preparation->id
            ]);
            
            toast('Error al actualizar la preparación. Por favor, intente nuevamente.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Preparation $preparation)
    {
        abort_if(Gate::denies('delete_preparations'), 403);

        try {
            DB::beginTransaction();

            // Verificar si se puede eliminar (agregar lógica de negocio si es necesario)
            $reception = $preparation->reception;

            // Eliminar la preparación (los detalles se eliminan automáticamente si tienes cascade)
            $preparation->delete();

            // Opcional: Revertir el estado de la recepción si es necesario
            if ($reception) {
                $reception->update(['status' => 'Pendiente']);
            }

            DB::commit();

            toast('¡Preparación eliminada exitosamente!', 'success');
            return redirect()->route('preparations.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar preparación: ' . $e->getMessage(), [
                'preparation_id' => $preparation->id
            ]);
            
            toast('Error al eliminar la preparación. Puede que tenga datos relacionados.', 'error');
            return redirect()->route('preparations.index');
        }
    }

    /**
     * Limpiar el carrito de preparación
     */
    public function clearCart()
    {
        Cart::instance(self::CART_INSTANCE)->destroy();
        
        toast('Carrito limpiado exitosamente.', 'info');
        return redirect()->back();
    }
}