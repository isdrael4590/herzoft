<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\DataTables\ProductDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Upload\Entities\Upload;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Instrumental;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        abort_if(Gate::denies('access_products'), 403);

        return $dataTable->render('product::products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_products'), 403);

        // Limpiar carrito de instrumental
        Cart::instance('product')->destroy();

        return view('product::products.create');
    }

    public function store(StoreProductRequest $request)
    {
        DB::transaction(function () use ($request) {
            // Crear el producto principal
            $product = Product::create([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_barcode_symbology' => $request->product_barcode_symbology,
                'product_unit' => $request->product_unit,
                'product_price' => $request->product_price,
                'area' => $request->area,
                'product_note' => $request->product_note,
                'product_info' => $request->product_info,
                'category_id' => $request->category_id,
                'product_type_process' => $request->product_type_process,
                'product_quantity' => $request->product_quantity,
                'product_patient' => $request->product_patient,
            ]);

            // Manejar imágenes
            if ($request->has('document')) {
                foreach ($request->input('document', []) as $file) {
                    $product->addMedia(Storage::path('temp/dropzone/' . $file))
                        ->toMediaCollection('images');
                }
            }

            // Procesar INSTRUMENTAL desde el carrito 'instrumental'
            $cartInstrumentals = Cart::instance('product')->content();

            if ($cartInstrumentals->count() > 0) {
                // Log::info('🔧 Procesando instrumental desde Cart:', [
                //     'count' => $cartInstrumentals->count(),
                //     'product_id' => $product->id
                // ]);

                foreach ($cartInstrumentals as $cart_item) {
                    try {
                        // ✅ SOLO ACTUALIZAR el instrumental existente
                        $instrumental = Instrumental::find($cart_item->id);

                        if ($instrumental) {
                            $instrumental->update([
                                'product_id' => $product->id,  // Asociar al producto
                                'estado_actual' => 'EN USO'    // Cambiar estado a "EN USO"
                            ]);

                            // Log::info('✅ Instrumental actualizado:', [
                            //     'id' => $instrumental->id,
                            //     'codigo' => $instrumental->codigo_unico_ud,
                            //     'product_id' => $product->id,
                            //     'estado' => 'EN USO'
                            //]);
                        } else {
                            Log::warning('⚠️ Instrumental no encontrado:', [
                                'cart_item_id' => $cart_item->id
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('❌ Error creando instrumental:', [
                            'cart_item' => $cart_item->name,
                            'error' => $e->getMessage()
                        ]);
                        throw $e;
                    }
                }
            }

            // Limpiar carrito después de guardar
            Cart::instance('product')->destroy();

            // Log::info('✅ Producto creado exitosamente', [
            //     'product_id' => $product->id,
            //     'instrumental_count' => $cartInstrumentals->count()
            // ]);
        });

        toast('Producto Creado con Éxito!', 'success');
        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('show_products'), 403);

        return view('product::products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('edit_products'), 403);

        // Limpiar carrito de instrumental
        Cart::instance('product')->destroy();

        // Cargar instrumental en el carrito
        $cartInstrumental = Cart::instance('product');
        $instrumental = $product->instrumental; // ✅ Usar get() explícitamente

        foreach ($instrumental as $instrumental) {
            $cartInstrumental->add([
                'id'      => $instrumental->id,
                'name'    => $instrumental->nombre_generico,
                'qty'     => 1, // Los instrumental son únicos
                'price'   => 0,
                'weight'  => 1,
                'options' => [
                    'codigo_unico_ud' => $instrumental->codigo_unico_ud,
                    'nombre_generico' => $instrumental->nombre_generico,
                    'tipo_familia' => $instrumental->tipo_familia,
                    'marca_fabricante' => $instrumental->marca_fabricante,
                    'fecha_compra' => $instrumental->fecha_compra,
                    'estado_actual' => $instrumental->estado_actual,
                ]
            ]);
        }

        return view('product::products.edit', compact('product'));
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            // Actualizar producto principal
            $product->update([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_barcode_symbology' => $request->product_barcode_symbology,
                'product_unit' => $request->product_unit,
                'area' => $request->area,
                'product_note' => $request->product_note,
                'product_info' => $request->product_info,
                'category_id' => $request->category_id,
                'product_type_process' => $request->product_type_process,
                'product_quantity' => $request->product_quantity,
                'product_patient' => $request->product_patient,
            ]);

            // Manejar imágenes
            if ($request->has('document')) {
                if (count($product->getMedia('images')) > 0) {
                    foreach ($product->getMedia('images') as $media) {
                        if (!in_array($media->file_name, $request->input('document', []))) {
                            $media->delete();
                        }
                    }
                }
                $media = $product->getMedia('images')->pluck('file_name')->toArray();
                foreach ($request->input('document', []) as $file) {
                    if (count($media) === 0 || !in_array($file, $media)) {
                        $product->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                    }
                }
            }

            // Actualizar instrumental: remover product_id de los anteriores
            foreach ($product->instrumental as $instrumental) {
                $instrumental->update([
                    'product_id' => null,
                    'estado_actual' => 'DISPONIBLE' // Volver a disponible
                ]);
            }

            // Actualizar nuevos instrumental desde el carrito 'product'
            foreach (Cart::instance('product')->content() as $cart_item) {
                $instrumental = Instrumental::find($cart_item->id);

                if ($instrumental) {
                    $instrumental->update([
                        'product_id' => $product->id,  // Asociar al producto
                        'estado_actual' => 'EN USO'    // Cambiar estado a "EN USO"
                    ]);
                }
            }

            // Limpiar carrito
            Cart::instance('product')->destroy();
        });

        toast('Producto Actualizado!', 'info');
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('delete_products'), 403);

        try {
            DB::beginTransaction();

            // Contar instrumental antes de desvincular
            $instrumentalCount = $product->instrumental()->count();
            $productName = $product->product_name;

            // ✅ Desvincular instrumental en lugar de eliminarlos
            foreach ($product->instrumental as $instrumental) {
                $instrumental->update([
                    'product_id' => null,
                    'estado_actual' => 'DISPONIBLE' // O el campo que uses para el estado
                ]);
            }

            // Ahora sí eliminar el producto
            $product->delete();

            DB::commit();

            // Log::info('🗑️ Producto eliminado exitosamente:', [
            //     'product_name' => $productName,
            //     'instrumental_liberados' => $instrumentalCount
            // ]);

            $mensaje = 'Producto eliminado exitosamente!';
            if ($instrumentalCount > 0) {
                $mensaje .= " {$instrumentalCount} instrumental(es) liberado(s) y marcado(s) como DISPONIBLE.";
            }

            toast($mensaje, 'warning');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log::error('❌ Error al eliminar producto:', [
            //     'product_id' => $product->id,
            //     'error' => $e->getMessage()
            // ]);

            toast('Error al eliminar el producto: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
