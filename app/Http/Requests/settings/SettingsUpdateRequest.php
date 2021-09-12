<?php

namespace App\Http\Requests\settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|numeric|digits_between:9,10',
            'facebook' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'email',
            'address' => 'dirección',
            'phone' => 'teléfono',
            'facebook' => 'facebook',
            'instagram' => 'instagram',
            'twitter' => 'twitter',
            'logo' => 'logo',
        ];
    }
}
