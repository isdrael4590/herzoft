<?php

namespace Modules\Labelqr\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;

use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\DataTables\LabelqrDataTable;
use Modules\Labelqr\Entities\LabelqrDetails;

use Modules\Labelqr\Http\Requests\StoreLabelqrHPORequest;
use Modules\Labelqr\Http\Requests\UpdateLabelqrHPORequest;
use Modules\Preparation\Entities\PreparationDetails;


class LabelqrHPOController extends Controller

{
    public function index(LabelqrDataTable $dataTable)
    {
        abort_if(Gate::denies('access_zne_area'), 403);

        return view('labelqr::labelqrs.create');
    }

    public function create()
    {
        abort_if(Gate::denies('create_labelqrs'), 403);

        Cart::instance('labelqrhpo')->destroy();

        return view('labelqr::labelqrshpo.create');
    }

    public function store(StoreLabelqrHPORequest $request)
    {
        DB::transaction(function () use ($request) {
            $labelqrhpo = Labelqr::create([

                'machine_name' => $request->machine_name,
                'machine_type' => $request->machine_type,
                'lote_machine' => $request->lote_machine,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'note_labelqr' => $request->note_labelqr,
                'operator' => $request->operator,

            ]);

            foreach (Cart::instance('labelqrhpo')->content() as $cart_item) {
                $preparation_detail = PreparationDetails::findOrFail($cart_item->id);
                LabelqrDetails::create([
                    'labelqr_id' => $labelqrhpo->id,
                    'preparation_detail_id' => $preparation_detail->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_eval_package' => $cart_item->options->product_eval_package,
                    'product_eval_indicator' => $cart_item->options->product_eval_indicator,
                    'product_expiration' => $cart_item->options->product_expiration
                ]);
                $preparation_detail = PreparationDetails::findOrFail($cart_item->id);
                $preparation_detail->update([
                    'product_state_preparation' => 'Procesado',
                ]);
            }

            Cart::instance('labelqrhpo')->destroy();
        });

        toast('labelqr registrada!', 'success');

        return redirect()->route('labelqrs.index');
    }

    public function show(Labelqr $labelqrhpo)
    {
        abort_if(Gate::denies('show_labelqrs'), 403);

        return view('labelqr::labelqrshpo.show', compact('labelqr'));
    }

    public function edit(Labelqr $labelqr)
    {
        abort_if(Gate::denies('edit_labelqrs'), 403);

        $labelqr_details = $labelqr->labelqrDetails;

        Cart::instance('labelqrhpo')->destroy();

        $cart = Cart::instance('labelqrhpo');

        foreach ($labelqr_details as $labelqr_detail) {
            $cart->add([
                'id' => $labelqr_detail->product_id,
                'name' => $labelqr_detail->product_name,
                'qty' => 1,
                'price' => 1,
                'weight' => 1,
                'options' => [
                    'code' => $labelqr_detail->product_code,
                    'product_type_process' => $labelqr_detail->product_type_process,
                    'product_package_wrap' => $labelqr_detail->product_package_wrap,
                    'product_ref_qr' => $labelqr_detail->product_ref_qr,
                    'product_eval_package' => $labelqr_detail->product_eval_package,
                    'product_eval_indicator' => $labelqr_detail->product_eval_indicator,
                    'product_expiration' => $labelqr_detail->product_expiration
                ]
            ]);
        }

        return view('labelqr::labelqrshpo.edit', compact('labelqr'));
    }

    public function update(UpdateLabelqrHPORequest $request, Labelqr $labelqr)
    {
        DB::transaction(function () use ($request, $labelqr) {
            foreach ($labelqr->labelqrDetails as $labelqr_detail) {
                $labelqr_detail->delete();
            }

            $labelqr->update([
                'machine_name' => $request->machine_name,
                'machine_type' => $request->machine_type,
                'lote_machine' => $request->lote_machine,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'note_labelqr' => $request->note_labelqr,
                'operator' => $request->operator
            ]);

            foreach (Cart::instance('labelqrhpo')->content() as $cart_item) {
                $preparation_detail = PreparationDetails::findOrFail($cart_item->id);
                LabelqrDetails::create([
                    'labelqr_id' => $labelqr->id,
                    'preparation_detail_id' => $preparation_detail->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_eval_package' => $cart_item->options->product_eval_package,
                    'product_eval_indicator' => $cart_item->options->product_eval_indicator,
                    'product_expiration' => $cart_item->options->product_expiration

                ]);
                $preparation_detail = PreparationDetails::findOrFail($cart_item->id);
                $preparation_detail->update([
                    'product_state_preparation' => 'Procesado',
                ]);
            }

            Cart::instance('labelqrhpo')->destroy();
        });

        toast('Ingreso actualizado!', 'info');

        return redirect()->route('labelqrs.index');
    }

    public function destroy(Labelqr $labelqrhpo)
    {
        abort_if(Gate::denies('delete_labelqrs'), 403);

        $labelqrhpo->delete();

        toast('labelqr Deleted!', 'warning');

        return redirect()->route('labelqrs.index');
    }
}
