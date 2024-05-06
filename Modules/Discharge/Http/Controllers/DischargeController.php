<?php

namespace Modules\Discharge\Http\Controllers;

use Modules\Discharge\DataTables\DischargesDataTable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Discharge\Http\Requests\StoreDischargeRequest;
use Modules\Discharge\Http\Requests\UpdateDischargeRequest;


use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\DataTables\LabelqrDataTable;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Labelqr\Http\Requests\StoreLabelqrRequest;
use Modules\Labelqr\Http\Requests\UpdateLabelqrRequest;


class DischargeController extends Controller
{

    public function index(DischargesDataTable $dataTable)
    {
        abort_if(Gate::denies('access_ze_area'), 403);

        return $dataTable->render('discharge::discharges.index');
    }


    public function create()
    {
        abort_if(Gate::denies('create_discharges'), 403);

        Cart::instance('discharge')->destroy();

        return view('discharge::discharges.create');
    }


    public function store(StoreDischargeRequest $request)
    {
        DB::transaction(function () use ($request) {
            $discharge = Discharge::create([
                'machine_name' => $request->machine_name,
                'lote_machine' => $request->lote_machine,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'expiration' => $request->expiration,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'note' => $request->note,
                'operator' => $request->operator,
            ]);

            foreach (Cart::instance('discharge')->content() as $cart_item) {
                DischargeDetails::create([
                    'discharge_id' => $discharge->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_eval_package' => $cart_item->options->product_eval_package,
                    'product_eval_indicator'=> $cart_item->options->product_eval_indicator
                ]);
            }

            Cart::instance('discharge')->destroy();
        });

        toast('Discharge Created!', 'success');

        return redirect()->route('labelqrs.index');
    }


    public function show(Discharge $discharge)
    {
        abort_if(Gate::denies('show_discharges'), 403);

        return view('discharge::discharges.show', compact('discharge'));
    }


    public function edit(Discharge $discharge)
    {
        abort_if(Gate::denies('edit_discharges'), 403);

        $discharge_details = $discharge->dischargeDetails;

        Cart::instance('discharge')->destroy();

        $cart = Cart::instance('discharge');

        foreach ($discharge_details as $discharge_detail) {
            $cart->add([
                'id'      => $discharge_detail->product_id,
                'name'    => $discharge_detail->product_name,
                'qty'     => 1,
                'price'     => 1,
                'weight'     => 1,
                'options' => [
                    'code'     => $discharge_detail->product_code,
                    'product_package_wrap'   => $discharge_detail->product_package_wrap,
                    'product_ref_qr'   => $discharge_detail->product_ref_qr,
                    'product_eval_package' => $discharge_detail->product_eval_package,
                    'product_eval_indicator'=> $discharge_detail->product_eval_indicator
                ]
            ]);
        }

        return view('discharge::discharges.edit', compact('discharge'));
    }


    public function update(UpdateDischargeRequest  $request, Discharge $discharge)
    {
        DB::transaction(function () use ($request, $discharge) {

            foreach ($discharge->dischargeDetails as $discharge_detail) {
                $discharge_detail->delete();
            }

            $discharge->update([
                'machine_name' => $request->machine_name,
                'lote_machine' => $request->lote_machine,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'expiration' => $request->expiration,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'note' => $request->note,
                'operator' => $request->operator
            ]);
     

            foreach (Cart::instance('discharge')->content() as $cart_item) {
                DischargeDetails::create([
                    'discharge_id' => $discharge->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_eval_package' => $cart_item->options->product_eval_package,
                    'product_eval_indicator'=> $cart_item->options->product_eval_indicator
                    
                ]);
            }

            Cart::instance('discharge')->destroy();
        });






        toast('Descarga Liberada!', 'info');

        return redirect()->route('discharges.index');
    }



    public function destroy(Discharge $discharge)
    {
        abort_if(Gate::denies('delete_discharges'), 403);

        $discharge->delete();

        toast('Discharge Deleted!', 'warning');

        return redirect()->route('discharges.index');
    }
}
