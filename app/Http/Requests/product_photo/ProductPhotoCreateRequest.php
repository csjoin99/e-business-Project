<?php

namespace App\Http\Requests\product_photo;

use Illuminate\Foundation\Http\FormRequest;

class ProductPhotoCreateRequest extends FormRequest
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
            'order' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif'
        ];
    }

    public function attributes()
    {
        return [
            'order' => 'orden',
            'image' => 'imagen'
        ];
    }
}
