<?php

namespace Modules\Testbd\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTestbdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'testbd_reference' => ['required', 'string', 'max:255'],
            'machine_name' => ['required', 'string', 'max:255'],
            'lote_machine' => ['required', 'string', 'max:255'],
            'temp_machine' => ['required', 'string', 'max:255'],
            'lote_bd' => ['required', 'string', 'max:255'],
            'validation_bd' => ['required', 'string', 'max:255'],
            'temp_ambiente' => ['required', 'integer', 'min:1'],
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
        return Gate::allows('edit_testbds');
    }
}
