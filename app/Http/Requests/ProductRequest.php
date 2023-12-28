<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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



    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // khi xuất hiện bất kỳ lỗi nào thì sẽ add error vào 
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add(
                    'msg',
                    'Đã có lỗi xảy ra, vui lòng nhập lại!'
                );
            }
            dd('ok');
        });
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }

    protected function failedAuthorization()
    {
        // throw new HttpResponseException(redirect('/')->with('msg', 'Bạn không có quyền truy cập')->with('type', 'danger'));

        throw new HttpResponseException(abort(404));
    }
}
