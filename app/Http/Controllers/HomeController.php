<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ';
        $SuccessAlert = "Đặt hàng thành công";
        return view('clients.home', compact('title', 'SuccessAlert'));
    }

    public function product()
    {
        $title = 'Sản phẩm';
        return   view('clients.product', compact('title'));
    }

    public function getProductDetail($id)
    {
        return view('clients.products.detail', compact('id'));
    }

    public function getAdd()
    {
        $dataView = [
            'title' => 'Thêm sản phẩm',
            'ErrorMessage' => 'Vui lòng kiểm tra lại dữ liệu'
        ];
        return view('clients.add', $dataView);
    }

    // ĐANG DÙNG CLASS VALIDATOR
    public function postAdd(Request $request)
    {
        $rules = [
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer'
        ];

        $message = [
            'required' => ':attribute không được để trống',
            'min' => 'Tên phải lớn hơn :min ký tự',
            'integer' => 'Giá trị phải là số'
        ];

        $attribute = [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá trị sản phẩm',
        ];

        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        // $validator->validate();
        if ($validator->fails()) {
            $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu');
            // return 'thất bại';
        } else {
            // return 'Thành công';
            return redirect()->route('product')->with('msg', 'Thêm sản phẩm thành công');
        }

        return back()->withErrors($validator);

        // xử lý việc thêm dữ liệu vào database
    }

    // // ĐANG DÙNG FORM VALIDATION
    // public function postAdd(ProductRequest $request)
    // {
    //     dd($request);
    //     // xử lý việc thêm dữ liệu vào database
    // }

    // public function postAdd(Request $request)
    // {
    //     $rules = [
    //         // min:6 => 6 ký tự
    //         'product_name' => 'required|min:6',
    //         // integer => số
    //         'product_price' => 'required|integer'
    //     ];

    //     // $message = [
    //     //     'product_name.required' => 'Vui lòng nhập tên sản sản phẩm',
    //     //     'product_name.min' => 'Độ dài phải lớn hơn :min ký tự',
    //     //     'product_price.required' => 'Vui lòng nhập giá trị sản phẩm',
    //     //     'product_price.integer' => 'Giá trị phải là số'
    //     // ];

    //     $message = [
    //         'required' => ':attribute bắt buộc phải nhập',
    //         'min' => 'Độ dài phải lớn hơn :min ký tự',
    //         'integer' => 'Giá trị phải là số'
    //     ];
    //     $request->validate($rules, $message);

    //     // xử lý việc thêm dữ liệu vào database
    // }

    public function putAdd(Request $request)
    {
        dd($request);
    }

    public function downloadImage_out(Request $request)
    {
        if (!empty($request->image)) {
            $img = trim($request->image);

            $fileName = basename($img);

            return response()->streamDownload(function () use ($img) {
                $imageContent = file_get_contents($img);
                echo $imageContent;
            }, $fileName);
        }
    }
    public function downloadImage_in(Request $request)
    {
        if (!empty($request->image)) {
            $img = trim($request->image);

            $fileName = basename($img);

            return response()->download($img, $fileName);
        }
    }

    public function downloadDoc(Request $request)
    {
        if (!empty($request->file)) {
            $file = trim($request->file);

            // $fileName = basename($file);

            $fileName = 'tai-lieu_' . uniqid() . '.pdf';

            $header = [
                'Content-Type' => 'application/pdf'
            ];

            return response()->download($file, $fileName, $header);
        }
    }
}
