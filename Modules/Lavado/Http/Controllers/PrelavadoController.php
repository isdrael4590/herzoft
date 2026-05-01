<?php

namespace Modules\Lavado\Http\Controllers;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Lavado\Entities\PrelavadoDetalle;
use Modules\Reception\Entities\Reception;

class PrelavadoController extends Controller
{
    public function index()
    {
        $prelavados = PrelavadoDetalle::selectRaw('product_code, MAX(product_name) as product_name, SUM(product_quantity) as total_quantity')
            ->groupBy('product_code')
            ->orderByDesc('total_quantity')
            ->get();

        return view('lavado::prelavado.index', compact('prelavados'));
    }

    public function historial($product_code)
    {
        $detalles = PrelavadoDetalle::with('reception')
            ->where('product_code', $product_code)
            ->latest()
            ->get();

        $product_name = $detalles->first()->product_name ?? $product_code;

        return view('lavado::prelavado.historial', compact('detalles', 'product_code', 'product_name'));
    }

    public function create()
    {
        $max_id = PrelavadoDetalle::max('id') + 1;
        $prelavado_ref = 'PREV_' . str_pad($max_id, 5, '0', STR_PAD_LEFT);

        return view('lavado::prelavado.create', compact('prelavado_ref'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:100',
        ]);

        $cart_items = Cart::instance('prelavado')->content();

        if ($cart_items->isEmpty()) {
            return back()
                ->withErrors(['cart' => 'Debe agregar al menos un producto.'])
                ->withInput();
        }

        foreach ($cart_items as $cart_item) {
            PrelavadoDetalle::create([
                'reception_id'            => null,
                'reception_reference'     => $request->reference,
                'product_id'              => $cart_item->id,
                'product_name'            => $cart_item->name,
                'product_code'            => $cart_item->options->code,
                'product_quantity'        => $cart_item->qty,
                'product_patient'         => $cart_item->options->product_patient ?? null,
                'product_info'            => $cart_item->options->product_info ?? null,
                'product_outside_company' => $cart_item->options->product_outside_company ?? null,
                'product_area'            => $cart_item->options->product_area ?? null,
                'product_type_process'    => $cart_item->options->product_type_process ?? null,
            ]);
        }

        Cart::instance('prelavado')->destroy();

        return redirect()->route('prelavado.index')
            ->with('success', 'Productos registrados en prelavado correctamente.');
    }

    public function edit($reception_id)
    {
        $detalles = PrelavadoDetalle::with('product')
            ->where('reception_id', $reception_id)
            ->get();

        if ($detalles->isEmpty()) {
            abort(404);
        }

        return view('lavado::prelavado.edit', compact('reception_id', 'detalles'));
    }

    public function update(Request $request, $reception_id)
    {
        $detalles = PrelavadoDetalle::where('reception_id', $reception_id)->get();

        foreach ($detalles as $detalle) {
            $data = $request->input('detalles.' . $detalle->id, []);
            $detalle->update([
                'product_quantity'        => $data['product_quantity'] ?? $detalle->product_quantity,
                'product_patient'         => $data['product_patient'] ?? null,
                'product_info'            => $data['product_info'] ?? null,
                'product_outside_company' => $data['product_outside_company'] ?? null,
                'product_area'            => $data['product_area'] ?? null,
                'product_type_process'    => $data['product_type_process'] ?? null,
            ]);
        }

        return redirect()->route('prelavado.index')
            ->with('success', 'Prelavado actualizado correctamente.');
    }

    public function show(Reception $reception)
    {
        $detalles = PrelavadoDetalle::with('product')
            ->where('reception_id', $reception->id)
            ->get();

        return view('lavado::prelavado.show', compact('reception', 'detalles'));
    }
}
