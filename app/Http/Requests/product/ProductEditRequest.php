<?php

namespace App\Http\Requests\product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'code' => "required|unique:product,code,{$this->product->id},id,deleted_at,NULL|max:100",
            'name' => "required|unique:product,name,{$this->product->id},id,deleted_at,NULL|max:100",
            'category_id' => 'required|in:' . implode(', ', $categories->pluck('id')->toarray()),
            'price' => 'required|numeric|min:1',
            'discount' => 'nullable|numeric|min:1|max:100',
            'description' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'código',
            'name' => 'nombre',
            'category_id' => 'categoría',
            'price' => 'precio',
            'discount' => 'descuento',
            'description' => 'descripción',
        ];
    }
}
