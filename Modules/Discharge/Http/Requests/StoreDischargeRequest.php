<?php

namespace Modules\Discharge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreDischargeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference' => 'required|string|max:255',
            'operator' => 'required|string|max:255',
            'operator_discharge' => 'nullable|string|max:255',
            'machine_name' => 'required|string|max:255',
            'machine_type' => 'required|string|max:255',
            'lote_machine' => 'required|string|max:255',
            'lote_agente' => 'nullable|string|max:255',
            'temp_machine' => 'required|string|max:255',
            'type_program' => 'required|string|max:255',
            'lote_biologic' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            'validation_biologic' => 'required|string|max:255',
            'temp_ambiente' => 'required|string|max:255',
            'status_cycle' => 'required|string|max:255',
            'ruta_process' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255'

            ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create_discharges');
    }
}
