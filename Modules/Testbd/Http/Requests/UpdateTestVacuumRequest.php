<?php

namespace Modules\Testbd\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTestVacuumRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'testvacuum_reference' => ['required', 'string', 'max:255'],
            'machine_name' => ['required', 'string', 'max:255'],
            'lote_machine' => ['required', 'string', 'max:255'],
            'temp_ambiente' => ['required', 'integer', 'min:1'],
            'tipo_equipo' => ['required', 'string', 'max:255'],
            'validation_vacuum' => ['required', 'string', 'max:255'],
            'operator' => ['nullable', 'string', 'max:1000'],
            'observation' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_testvacuums');
    }
}
