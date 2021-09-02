<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class UserEditRequest extends FormRequest
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
        $roles = Role::all();
        return [
            'name' => 'required|max:100',
            'lastname' => 'required|max:100',
            'role' => 'required|in:' . implode(', ', $roles->pluck('id')->toarray()),
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'role' => 'rol',
            'avatar' => 'avatar',
        ];
    }
}
