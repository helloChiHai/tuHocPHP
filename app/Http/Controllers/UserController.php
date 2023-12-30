<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Users;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index()
    {
        $dataView = [
            'title' => 'Danh sách người dùng',
            'userList' => $this->users->getAllUser()
        ];
        return view('clients.users.list', $dataView);
    }

    public function add()
    {
        $dataView = [
            'title' => 'Thêm người dùng',
        ];
        return view('clients.users.add', $dataView);
    }

    public function postAdd(Request $request)
    {
        $rule = [
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ];

        $message = [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Phải lớn hơn 5 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại'
        ];

        $request->validate($rule, $message);

        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s'),
        ];

        $this->users->addUser($dataInsert);

        return redirect()->route('users.index')->with('msg', 'Thêm người dùng thành công');
    }
}
