<?php

namespace Modules\Expedition\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateExpeditionRequest extends FormRequest
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
            'area_expedition' => 'required|string|max:255',
            'staff_expedition' => 'required|string|max:255',
            'temp_ambiente' => 'required|string|max:255',
            'status_expedition' => 'required|string|max:255',
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
        return Gate::allows('edit_expeditions');
    }
}
