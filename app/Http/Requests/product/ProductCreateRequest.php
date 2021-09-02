<?php

namespace App\Http\Requests\product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
        $categories = Category::all();
        return [
            'name' => 'required|unique:product,name,NULL,id,deleted_at,NULL|max:100',
            'category_id' => 'required|in:' . implode(', ', $categories->pluck('id')->toarray()),
            'price' => 'required|numeric|min:1',
            'discount' => 'nullable|numeric|min:1|max:100',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'category_id' => 'categoría',
            'price' => 'precio',
            'discount' => 'descuento',
            'stock' => 'stock',
            'description' => 'descripción',
        ];
    }
}
