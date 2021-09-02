<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'lastname' => 'required|max:100',
            'password' => 'nullable|confirmed|min:1|max:100',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'password' => 'password',
            'avatar' => 'avatar',
        ];
    }
}
