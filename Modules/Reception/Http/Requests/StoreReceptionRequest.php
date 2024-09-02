<?php

namespace Modules\Reception\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreReceptionRequest extends FormRequest
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
            'delivery_staff' => 'required|string|max:255',
            'area' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
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
        return Gate::allows('create_receptions');
    }
}
