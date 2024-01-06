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

    // // TRUY VAN QUERY BUILDER
    // public function index()
    // {
    //     $dataView = [
    //         'title' => 'Danh sách người dùng',
    //         'userList' => $this->users->learnQueryBuilder()
    //     ];
    //     return view('clients.users.list', $dataView);
    // }

    // TRUY VAN SQL
    public function index(Request $request)
    {
        $filters = [];

        $keywords = null;

        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }

            $filters[] = [
                'users.status', '=', $status
            ];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;
            $filters[] = [
                'users.group_id', '=', $groupId
            ];
        }

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }

        $dataView = [
            'title' => 'Danh sách người dùng',
            'userList' => $this->users->getAllUser($filters, $keywords)
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

    public function getEdit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'Người dùng không tồn tại');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }

        $dataView = [
            'title' => 'Cập nhật người dùng',
            'userDetail' => $userDetail
        ];

        return view('clients.users.edit', $dataView);
    }

    public function postEdit(Request $request)
    {
        $id = session('id');

        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $rule = [
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users,email,' . $id
        ];

        $message = [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Phải lớn hơn 5 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại'
        ];

        $request->validate($rule, $message);

        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg', 'Cập nhật thành công');
    }

    public function delete($id = 0)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $deleteState =  $this->users->deleteUser($id);
                if ($deleteState) {
                    $msg = 'Xóa người dùng thành công';
                } else {
                    $msg = 'Bạn không thể xóa người dùng lúc này. Vui lòng thử lại sau';
                }
            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }
}
