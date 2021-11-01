<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class WebRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:user,email,NULL,id,deleted_at,NULL|max:100',
            'password' => 'required|confirmed|min:1|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'email' => 'email',
            'password' => 'password',
        ];
    }
}
