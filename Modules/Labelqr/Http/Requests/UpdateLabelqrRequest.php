<?php

namespace Modules\Labelqr\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateLabelqrRequest extends FormRequest
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
            'machine_name' => 'required|string|max:255',
            'lote_machine' => 'required|string|max:255',
            'temp_machine' => 'required|string|max:255',
            'type_program' => 'required|string|max:255',
            'lote_biologic' => 'required|string|max:255',
            'validation_biologic' => 'required|string|max:255',
            'temp_ambiente' => 'required|string|max:255',
            'status_cycle' => 'required|string|max:255',
            'note_labelqr' => 'nullable|string|max:255'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_labelqrs');
    }
}
