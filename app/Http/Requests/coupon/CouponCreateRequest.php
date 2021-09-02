<?php

namespace App\Http\Requests\coupon;

use Illuminate\Foundation\Http\FormRequest;

class CouponCreateRequest extends FormRequest
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
        $type = $this->input('type');
        $rule_discount = $type === 'Porcentaje' ? 'min:0|max:100' : 'min:0';
        return [
            'code' => "required|min:1|max:50|unique:coupon,code,NULL,id,deleted_at,NULL",
            'discount' => 'required|numeric|' . $rule_discount,
            'type' => 'required|in:Porcentaje,Fijo',
            'date' => 'required',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'code' => "código",
            'discount' => "descuento",
            'type' => 'tipo',
            'date' => 'fecha',
            'stock' => 'stock',
        ];
    }
}
