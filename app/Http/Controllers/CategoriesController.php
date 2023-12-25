<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
    }

    // hiển thị danh sách chuyên mục (GET)
    public function index(Request $request)
    {
        // if (isset($_GET['id'])) {
        //     echo $_GET['id'];
        // }
        $data = $request->all();
        echo $data['id'];

        return view('clients/categories/list');
    }

    // lấy ra chuyên mục theo id (GET)
    public function getCategorsy($id)
    {
        return view('clients/categories/edit');
    }

    // cập nhật chuyên mục (POST)
    public function updateCategory($id)
    {
    }

    // hiển thị form thêm dữ liệu (GET)
    public function addCategory()
    {
        return view('clients.categories.add');
    }

    // thêm dữ liệu vào chuyên mục (POST)
    public  function handleAddCategory(Request $request)
    {
        // print_r($_POST);
        $data = $request->all();
        dd($data);

        // return redirect(route('categories.add'));
    }

    // xóa dữ liệu (DELETE)
    public function deleteCategory($id)
    {
    }
}
