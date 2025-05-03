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
use PhpParser\Node\Stmt\Else_;
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

        Cart::instance('discharge')->destroy();

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
                'lote_agente' => $request->lote_agente,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'ruta_process' => "Sin Ruta",
                'note' => $request->note,
                'operator' => $request->operator,
                'operator_discharge' => $request->operator_discharge, // se añade
                'total_amount' => $request->total_amount,  // se añade

            ]);



            Lote::create([
                'lote_code' => $request->lote_machine,
                'equipo_lote' => $request->machine_name,
                'tipo_equipo' => $request->machine_type,
                'tipo_lote' => "Esterilizacion",
                'status_lote' => $request->status_cycle,
            ]);

            foreach (Cart::instance('discharge')->content() as $cart_item) {

                $labelqr_detail = LabelqrDetails::findOrFail($cart_item->id);

                DischargeDetails::create([
                    'discharge_id' => $discharge->id,
                    'labelqr_detail_id' => $labelqr_detail->id,
                    'product_id' => $cart_item->options->product_id,
                    'product_name' => $cart_item->name,
                    'product_quantity' => $cart_item->qty,
                    'price' => $cart_item->price, // se añade
                    'unit_price' => $cart_item->options->unit_price, // se añade
                    'sub_total' => $cart_item->options->sub_total, // se añade
                    'product_code' => $cart_item->options->code,
                    'product_patient' => $cart_item->options->product_patient,
                    'product_info' => $cart_item->options->product_info,
                    'product_area' => $cart_item->options->product_area,
                    'product_outside_company' => $cart_item->options->product_outside_company,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' => $cart_item->options->product_ref_qr,
                    'product_eval_package' => $cart_item->options->product_eval_package,
                    'product_eval_indicator' => $cart_item->options->product_eval_indicator,
                    'product_expiration' => $cart_item->options->product_expiration

                ]);

                $labelqr_detail = LabelqrDetails::findOrFail($cart_item->id);
                $preparation_detail = PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id);
                $A0 = $preparation_detail->product_quantity; //cantidad productos en preparacion detalles
                $A1 = $labelqr_detail->product_quantity; // cantidad de productos de klabelqr detalles
                $B1 = $labelqr_detail->product_quantity_fail; // Cantidad de productos labelqre con fallas
                $A2 = $cart_item->qty; // cantidad actual y validado en descarga

                $labelqr_detail->update([
                    'product_ref_qr' => 'En Curso',

                ]);
                if ($request->status_cycle == 'En Curso') {
                    $preparation_detail = PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id);
                    $preparation_detail->update([
                        'product_state_preparation' => 'En Curso',
                        'product_quantity' => $A0 - $A2
                    ]);
                    $labelqr_detail = LabelqrDetails::findOrFail($cart_item->id);
                    $labelqr_detail->update([
                        'product_quantity' =>  $A2,
                        'product_quantity_fail' => $A1 - $A2,

                    ]);
                }
            }
            Cart::instance('discharge')->destroy();
        });


        toast('Descarga Created!', 'success');

        return redirect()->route('labelqrs.index');
    }


    public function show(Discharge $discharge, DischargeDetails $labelqr_details)
    {
        abort_if(Gate::denies('show_discharges'), 403);
        $labelqr = Labelqr::findorfail($discharge->labelqr_id);



        return view('discharge::discharges.show', compact('discharge', 'labelqr'));
    }


    public function edit(Discharge $discharge)
    {
        abort_if(Gate::denies('edit_discharges'), 403);

        $discharge_details = $discharge->dischargeDetails;

        Cart::instance('discharge')->destroy();

        $cart = Cart::instance('discharge');

        foreach ($discharge_details as $discharge_detail) {
            $labelqr_detail = LabelqrDetails::where("id", $discharge_detail->labelqr_detail_id)->get()->first();
            $cart->add([
                'id'      => $discharge_detail->id,
                'name'    => $discharge_detail->product_name,
                'qty'     => $discharge_detail->product_quantity,
                'price'     => $discharge_detail->price,
                'weight'     => 1,
                'options' => [
                    'code'     => $discharge_detail->product_code,
                    'stock'       => $labelqr_detail->product_quantity,
                    'product_id'   => $discharge_detail->product_id,
                    'labelqr_detail_id'   => $discharge_detail->labelqr_detail_id,
                    'product_type_process'   => $discharge_detail->product_type_process,
                    'product_patient'   => $discharge_detail->product_patient,
                    'product_info'   => $discharge_detail->product_info,
                    'product_package_wrap'   => $discharge_detail->product_package_wrap,
                    'product_ref_qr'   => $discharge_detail->product_ref_qr,
                    'product_eval_package' => $discharge_detail->product_eval_package,
                    'product_eval_indicator' => $discharge_detail->product_eval_indicator,
                    'product_expiration' => $discharge_detail->product_expiration,
                    'sub_total'   => $discharge_detail->sub_total, // se añade
                    'unit_price'  => $discharge_detail->unit_price, // se añade
                    'product_outside_company'   => $discharge_detail->product_outside_company,
                    'product_area'   => $discharge_detail->product_area,
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

            if ($request->validation_biologic != 'sin_validar' && $request->status_cycle != 'En Curso') {
                $ruta_process = "Liberado";
            } else {
                $ruta_process = "Sin Ruta";
            }

            $discharge->update([
                'labelqr_id' => $request->labelqr_id,
                'machine_name' => $request->machine_name,
                'machine_type' => $request->machine_type,
                'lote_machine' => $request->lote_machine,
                'lote_agente' => $request->lote_agente,
                'temp_machine' => $request->temp_machine,
                'type_program' => $request->type_program,
                'lote_biologic' => $request->lote_biologic,
                'validation_biologic' => $request->validation_biologic,
                'temp_ambiente' => $request->temp_ambiente,
                'status_cycle' => $request->status_cycle,
                'ruta_process' => $ruta_process,
                'note' => $request->note,
                'operator' => $request->operator,
                'operator_discharge' => $request->operator_discharge, // se añade
                'total_amount' => $request->total_amount // se añade

            ]);



            if ($request->validation_biologic == 'Falla' || $request->status_cycle == 'Ciclo Falla') {
                $labelqr = Labelqr::findOrFail($request->labelqr_id);
                $labelqr->update([
                    'status_cycle' => "Ciclo Falla",

                ]);
                $lote = Lote::where("lote_code", $request->lote_machine)->get()->first();
                $lote->update([
                    'status_lote' => 'Ciclo Falla',
                ]);
            } elseif ($request->validation_biologic == 'Correcto' && $request->status_cycle == 'Ciclo Aprobado') {
                $labelqr = Labelqr::findOrFail($request->labelqr_id);
                $labelqr->update([
                    'status_cycle' => "Ciclo Aprobado",

                ]);
                $lote = Lote::where("lote_code", $request->lote_machine)->get()->first();
                $lote->update([
                    'status_lote' => 'Ciclo Aprobado',
                ]);
            }

            foreach (Cart::instance('discharge')->content() as $cart_item) {

                if ($request->validation_biologic == 'Falla' || $request->status_cycle == 'Ciclo Falla') {
                    $result_qr_ref = "Reprocesar";
                } elseif ($request->validation_biologic == 'Correcto' && $request->status_cycle == 'Ciclo Aprobado') {
                    $result_qr_ref = "Esteril";
                } else {
                    $result_qr_ref = "Sin Validar";
                }

                DischargeDetails::create([
                    'discharge_id' => $discharge->id,
                    'labelqr_detail_id' => $cart_item->options->labelqr_detail_id,
                    'product_id' => $cart_item->options->product_id,
                    'product_name' => $cart_item->name,
                    'product_quantity' => $cart_item->qty,
                    'product_code' => $cart_item->options->code,
                    'product_type_process' => $cart_item->options->product_type_process,
                    'product_patient' => $cart_item->options->product_patient,
                    'product_info' => $cart_item->options->product_info,
                    'product_package_wrap' => $cart_item->options->product_package_wrap,
                    'product_ref_qr' =>   $result_qr_ref,
                    'product_eval_package' => $cart_item->options->product_eval_package,
                    'product_eval_indicator' => $cart_item->options->product_eval_indicator,
                    'product_expiration' => $cart_item->options->product_expiration,
                    'price' => $cart_item->price, // se añade
                    'unit_price' => $cart_item->options->unit_price, // se añade
                    'sub_total' => $cart_item->options->sub_total, // se añade
                    'product_outside_company' => $cart_item->options->product_outside_company,
                    'product_area' => $cart_item->options->product_area,
                ]);

                $labelqr_detail = LabelqrDetails::where("id", $cart_item->options->labelqr_detail_id)->get()->first();
                $preparation_detail = PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id);

                $A0 = $preparation_detail->product_quantity; //cantidad productos en preparacion detalles
                $A1 = $labelqr_detail->product_quantity; // cantidad de productos de klabelqr detalles
                $B1 = $labelqr_detail->product_quantity_fail; // Cantidad de productos labelqre con fallas
                $A2 = $cart_item->qty; // cantidad actual y validado en descarga


                if ($request->validation_biologic == 'Falla' || $request->status_cycle == 'Ciclo Falla') {
                    $labelqr_detail->update([
                        'product_ref_qr' => 'Falla',
                        'product_quantity_fail' => $A2,
                    ]);

                    $preparation_detail->update([
                        'product_quantity' => $A0 + $A2,
                    ]);
                } elseif ($request->validation_biologic == 'Correcto' && $request->status_cycle == 'Ciclo Aprobado') {
                    $labelqr_detail->update([
                        'product_ref_qr' => 'Aprobado',
                    ]);
                    $preparation_detail->update([
                        'product_state_preparation' => 'Procesado',
                    ]);

                    if ($A1 == $A2) {
                        $labelqr_detail->update([
                            'product_quantity_fail' => $A1 - $A2,
                        ]);
                        $preparation_detail->update([
                            'product_quantity' => $A0 - ($A1 - $A2),
                        ]);
                    } elseif (($A1 != $A2) || ($B1 != 0)) {
                        if ($B1 < ($A1 - $A2)) {
                            $labelqr_detail->update([
                                'product_quantity_fail' => $A1 - $A2,
                            ]);
                            $preparation_detail->update([
                                'product_quantity' => $A0 + ($A1 - $A2 - $B1),
                            ]);
                        } elseif ($B1 >= ($A1 - $A2)) {
                            $labelqr_detail->update([
                                'product_quantity_fail' => $A1 - $A2,
                            ]);
                            $preparation_detail->update([
                                'product_quantity' => $A0 - ($B1 - ($A1 - $A2)),
                            ]);
                        }
                    }
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
