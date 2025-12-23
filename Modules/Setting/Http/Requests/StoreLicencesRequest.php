<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Solo usuarios con permiso pueden actualizar configuración
        return $this->user()->can('access_settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'license_expiration_date' => [
                'required',
                'date',
                'after:today'
            ],
            'license_notification_enabled' => [
                'nullable',
                'boolean'
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'license_expiration_date' => 'fecha de vencimiento',
            'license_notification_enabled' => 'notificación habilitada',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'license_expiration_date.required' => 'La fecha de vencimiento es obligatoria.',
            'license_expiration_date.date' => 'Debe ser una fecha válida.',
            'license_expiration_date.after' => 'La fecha debe ser posterior al día de hoy.',
            'license_notification_enabled.boolean' => 'El valor debe ser verdadero o falso.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Convertir checkbox a boolean
        $this->merge([
            'license_notification_enabled' => $this->has('license_notification_enabled')
        ]);
    }
}