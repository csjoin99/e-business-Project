<?php

namespace App\Http\Requests\provider;

use Illuminate\Foundation\Http\FormRequest;

class ProviderEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'ruc' => 'required|unique:provider,ruc,NULL,id,deleted_at,NULL|max:11|min:11',
            'phone' => 'required|numeric',
            'address' => 'required|max:150',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'razón social',
            'ruc' => 'RUC',
            'phone' => 'teléfono',
            'address' => 'dirección',
        ];
    }
}
