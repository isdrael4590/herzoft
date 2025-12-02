<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateInstrumentalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'product_id' => 'required|exists:products,id',
            'codigo_unico_ud' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('instrumentals', 'codigo_unico_ud')->ignore($this->instrumental->id),
            ],
            'nombre_generico' => 'nullable|string|max:255',
            'tipo_familia' => 'nullable|string|max:255',
            'marca_fabricante' => 'nullable|string|max:255',
            'fecha_compra' => 'nullable|date',
            'estado_actual' => 'required|string|in:DISPONIBLE,EN_USO,MANTENIMIENTO,BAJA',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_subproducts');
    }
}
