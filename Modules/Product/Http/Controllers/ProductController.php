<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\DataTables\ProductDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Upload\Entities\Upload;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\SubProduct;
use Modules\Product\Http\Requests\StoreSubProductRequest;

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

        Cart::instance('product')->destroy();

        return view('product::products.create');
    }


    public function store(StoreProductRequest $request,)
    {

        DB::transaction(function () use ($request) {
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

            if ($request->has('document')) {
                foreach ($request->input('document', []) as $file) {
                    $product->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                }
            }
            foreach (Cart::instance('product')->content() as $cart_item) {
                if (($cart_item->qty) >= 3) {
                    $subcode = $request->product_code . "." . $cart_item->id . "." . $cart_item->qty;
                } else {
                    $subcode = $request->product_code . "." . $cart_item->id;
                }


                SubProduct::create([
                    'product_id' => $product->id,
                    'subproduct_name' => $cart_item->name,
                    'subproduct_code' => $subcode,
                    'subproduct_quantity' => $cart_item->qty,

                ]);
            }
            Cart::instance('product')->destroy();
        });
        toast('Producto Creado!', 'success');

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
        $sub_products = $product->subproduct;
        Cart::instance('product')->destroy();

        $cart = Cart::instance('product');

        foreach ($sub_products as $sub_product) {
            $cart->add([
                'id'      => $sub_product->product_id,
                'name'    => $sub_product->subproduct_name,
                'qty'     => $sub_product->subproduct_quantity,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $sub_product->subproduct_code,
                ]
            ]);
        }



        return view('product::products.edit', compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {

        DB::transaction(function () use ($request, $product) {
            foreach ($product->subproduct as $sub_product) {
                $sub_product->delete();
            }
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
            foreach (Cart::instance('product')->content() as $cart_item) {

                if (($cart_item->qty) >= 3) {
                    $subcode = $request->product_code . "." . $cart_item->id . "." . $cart_item->qty;
                } else {
                    $subcode = $request->product_code . "." . $cart_item->id;
                }
                SubProduct::create([
                    'product_id' => $product->id,
                    'subproduct_name' => $cart_item->name,
                    'subproduct_code' => $subcode,
                    'subproduct_quantity' => $cart_item->qty,
                ]);
            }
            Cart::instance('product')->destroy();
        });
        toast('Producto Actualizado!', 'info');
        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        abort_if(Gate::denies('delete_products'), 403);
        $product->delete();
        toast('Producto Eliminado!', 'warning');
        return redirect()->route('products.index');
    }
}
