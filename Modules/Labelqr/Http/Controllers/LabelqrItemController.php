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
use Modules\Labelqr\DataTables\LabelqrDetailsDataTable;
use Modules\Labelqr\Entities\LabelqrDetails;

use Modules\Labelqr\Http\Requests\StoreLabelqrRequest;
use Modules\Labelqr\Http\Requests\UpdateLabelqrRequest;
use Modules\Preparation\Entities\PreparationDetails;

class LabelqrItemController extends Controller

{
    public function index(LabelqrDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('access_zne_area'), 403);

        return $dataTable->render('labelqr::labelqrsitem.index');
    }




    public function show(LabelqrDetails $labelqr_detail)
    {
        abort_if(Gate::denies('show_labelqrs'), 403);


        return view('labelqr::labelqrsitem.show', compact('labelqr'));
    }

    public function edit(Labelqr $labelqr)
    {
        abort_if(Gate::denies('edit_labelqrs'), 403);

        $labelqr_details = $labelqr->labelqrDetails;

        Cart::instance('labelqr')->destroy();

        $cart = Cart::instance('labelqr');

        foreach ($labelqr_details as $labelqr_detail) {
            $cart->add([
                'id'      => $labelqr_detail->product_id,
                'name'    => $labelqr_detail->product_name,
                'qty'     => 1,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $labelqr_detail->product_code,
                    'product_type_process'   => $labelqr_detail->product_type_process,
                    'product_package_wrap'   => $labelqr_detail->product_package_wrap,
                    'product_ref_qr'   => $labelqr_detail->product_ref_qr,
                    'product_eval_package' => $labelqr_detail->product_eval_package,
                    'product_eval_indicator' => $labelqr_detail->product_eval_indicator,
                    'product_expiration' => $labelqr_detail->product_expiration
                ]
            ]);
        }

        return view('labelqr::labelqrs.edit', compact('labelqr'));
    }

    public function update(UpdateLabelqrRequest $request, Labelqr $labelqr)
    {
        DB::transaction(function () use ($request, $labelqr) {
            


            foreach (Cart::instance('labelqr')->content() as $cart_item) {
                $preparation_detail = PreparationDetails::findOrFail($cart_item->id);
                LabelqrDetails::create([
                    'labelqr_id' => $labelqr->id,
                    'preparation_detail_id'=>$preparation_detail->id,
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

            Cart::instance('labelqr')->destroy();
        });

        toast('Ingreso actualizado!', 'info');

        return redirect()->route('labelqrs.index');
    }

    public function destroy(Labelqr $labelqr)
    {
        abort_if(Gate::denies('delete_labelqrs'), 403);

        $labelqr->delete();

        toast('labelqr Deleted!', 'warning');

        return redirect()->route('labelqrs.index');
    }
}