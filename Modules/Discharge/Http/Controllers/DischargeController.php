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
use Modules\Informat\Entities\Lote;
use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Preparation\Entities\PreparationDetails;
use PhpParser\Node\Stmt\TryCatch;

class DischargeController extends Controller
{

    public function index(DischargesDataTable $dataTable)
    {
        abort_if(Gate::denies('access_esteril_area'), 403);

        return $dataTable->render('discharge::discharges.index');
    }


    public function create()
    {
        abort_if(Gate::denies('create_discharges'), 403);
       // $labelqr = Labelqr::findOrFail($labelqr_id);

        Cart::instance('discharge')->destroy();
        //return view('discharge::discharges.create', compact('labelqr'));

        return view('discharge::discharges.create');
    }


    public function store(StoreDischargeRequest $request, Discharge $discharge)
    {
        DB::transaction(function () use ($request, $discharge) {
        
            foreach ($discharge->dischargeDetails as $discharge_detail) {
                $discharge_detail->delete();
            }
            $labelqr = Labelqr::findOrFail($request->labelqr_id);
            $labelqr->update([
                'status_cycle' => 'En Curso',

            ]);

            $discharge = Discharge::create([
                'labelqr_id' => $request->labelqr_id,
                'machine_name' => $request->machine_name,
                'machine_type' => $request->machine_type,
                'lote_machine' => $request->lote_machine,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'ruta_process' => "Sin Ruta",
                'note' => $request->note,
                'operator' => $request->operator
            ]);



            Lote::create([
                'lote_code' => $request->lote_machine,
                'equipo_lote' => $request->machine_name,
                'tipo_equipo' => $request->machine_type,
                'tipo_lote' => "Esterilizacion",
                'status_lote' => $request->status_cycle,
            ]);

            foreach (Cart::instance('discharge')->content() as $cart_item) {
                dd($cart_item);
                $labelqr_detail = LabelqrDetails::findOrFail($cart_item->id);
                DischargeDetails::create([
                    'discharge_id' => $discharge->id,
                    'labelqr_detail_id' => $labelqr_detail->id,
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
                $labelqr_detail = LabelqrDetails::findOrFail($cart_item->id);
                $labelqr_detail->update([
                    'product_ref_qr' => 'En Curso',

                ]);
                if ($request->status_cycle == 'En Curso') {
                    $preparation_detail = PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id);
                    $preparation_detail->update([
                        'product_state_preparation' => 'En Curso',
                    ]);
                }
            }
            Cart::instance('discharge')->destroy();
        });


        toast('Descarga Created!', 'success');

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
                    'product_type_process'   => $discharge_detail->product_type_process,
                    'product_package_wrap'   => $discharge_detail->product_package_wrap,
                    'product_ref_qr'   => $discharge_detail->product_ref_qr,
                    'product_eval_package' => $discharge_detail->product_eval_package,
                    'product_eval_indicator' => $discharge_detail->product_eval_indicator,
                    'product_expiration' => $discharge_detail->product_expiration
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
            $labelqr = Labelqr::findOrFail($request->labelqr_id);
            $labelqr->update([
                'status_cycle' => $request->status_cycle,

            ]);

            $discharge->update([
                'labelqr_id' => $request->labelqr_id,
                'machine_name' => $request->machine_name,
                'machine_type' => $request->machine_type,
                'lote_machine' => $request->lote_machine,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'ruta_process' => "Liberado",
                'note' => $request->note,
                'operator' => $request->operator
            ]);

            foreach (Cart::instance('discharge')->content() as $cart_item) {
                $labelqr_detail = LabelqrDetails::where("preparation_detail_id", $cart_item->id)->get()->first();
                DischargeDetails::create([
                    'discharge_id' => $discharge->id,
                    'labelqr_detail_id' => $labelqr_detail->id,
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
                $labelqr_detail = LabelqrDetails::findOrFail($cart_item->id);
                $labelqr_detail->update([
                    'product_ref_qr' => $request->validation_biologic,

                ]);
                if ($request->validation_biologic == 'Falla' || $request->status_cycle == 'Ciclo Falla') {
                    $preparation_detail = PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id);
                    $preparation_detail->update([
                        'product_state_preparation' => 'Reprocesar',
                        'product_coming_zone' => 'Zona Esteril',
                    ]);
                } elseif ($request->validation_biologic == 'Correcto' && $request->status_cycle == 'Ciclo Aprobado') {
                    $preparation_detail = PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id);
                    $preparation_detail->update([
                        'product_state_preparation' => 'Procesado',
                        //'product_coming_zone' => 'Recepcion',
                    ]);
                }
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
