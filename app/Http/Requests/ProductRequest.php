<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            // 'required' => 'Trường :attribute không được để trống',
            // 'min' => 'Độ dài phải lớn hơn :min',
            // 'integer' => 'Phải là số'
            'product_name.required' => 'Vui lòng nhập :attribute',
            'product_name.min' => ':attribute phải lớn hơn :min ký tự',
            'product_price.required' => 'Vui lòng nhập :attribute',
            'product_price.integer' => ':attribute phải là số'
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá trị sản phẩm'
        ];
    }
}
