<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreInstrumentalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $instrumentalId = $this->route('instrumental') ? $this->route('instrumental')->id : null;

        return [
            'product_id' => 'nullable|exists:products,id',
            'codigo_unico_ud' => [
                'required',
                'string',
                'max:255',
                Rule::unique('instrumentals', 'codigo_unico_ud')->ignore($instrumentalId),
            ],
            'nombre_generico' => 'required|string|max:255',
            'tipo_familia' => 'required|string|max:255',
            'marca_fabricante' => 'required|string|max:255',
            'fecha_compra' => 'required|date',
            'estado_actual' => 'required|string|in:DISPONIBLE,EN_USO,MANTENIMIENTO,BAJA',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'codigo_unico_ud.required' => 'El código único es obligatorio.',
            'codigo_unico_ud.unique' => 'Este código único ya existe.',
            'nombre_generico.required' => 'La descripción es obligatoria.',
            'tipo_familia.required' => 'La familia es obligatoria.',
            'marca_fabricante.required' => 'El fabricante es obligatorio.',
            'fecha_compra.required' => 'La fecha de compra es obligatoria.',
            'fecha_compra.date' => 'La fecha de compra debe ser una fecha válida.',
            'estado_actual.required' => 'El estado es obligatorio.',
            'estado_actual.in' => 'El estado seleccionado no es válido.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Verificar si es creación o edición
        if ($this->isMethod('post')) {
            return Gate::allows('create_instrumentals');
        }
        
        return Gate::allows('edit_instrumentals');
    }
}