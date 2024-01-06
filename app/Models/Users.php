<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAllUser($filters = [], $keywords = null)
    {
        // TRUY VẤN SQL
        // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');

        // TRUY VẤN QUERY BUILDER
        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->orderBy('users.create_at', 'desc');

        if (!empty($filters)) {
            $users = $users->where($filters);
        }

        if (!empty($keywords)) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('fullname', 'like', '%' . $keywords . '%');
                $query->orWhere('email', 'like', '%' . $keywords . '%');
            });
        }

        $users = $users->get();

        return $users;
    }

    public function addUser($data)
    {
        DB::insert(
            'INSERT INTO users (fullname, email, create_at) values (?, ?, ?)',
            $data
        );
    }

    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    public function updateUser($data, $id)
    {
        $data[] = $id;
        return DB::select('UPDATE ' . $this->table . ' SET fullname=?, email=?, create_at=? WHERE id = ? ', $data);
    }

    public function deleteUser($id)
    {
        return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
    }


    // TRUY VAN BANG QUERY BUILDER
    public function learnQueryBuilder()
    {
        // lấy tất cả bản ghi của bảng
        // $list = DB::table($this->table)->get();


        // lấy tất cả bản ghi của bảng bằng select
        // $list = DB::table($this->table)
        // ->where('id', '=', 4)
        // ->select('fullname as hoTen', 'email', 'id', 'create_at')
        // // ->where([
        // //     ['id', '>=', 2],
        // //     ['id', '<=', 5]
        // // ])
        // // tifm kiem
        // // ->where('fullname', 'like', '%h%')
        // // tìm kiếm trong khoảng
        // // ->whereBetween('id', [0, 2])
        // // tìm kiếm ngoài khoảng
        // // ->whereNotBetween('id', [0, 2])
        // // tìm kiếm theo ngày - tháng - năm
        // // ->whereDate('create_at', '2023-12-31')
        // // // tìm kiếm theo tháng
        // // ->whereMonth('create_at', '01')
        // // // tìm kiếm theo ngày
        // // ->whereDay('create_at', '31')
        // // // tìm kiếm theo năm
        // // ->whereYear('create_at', '2023')
        // // so sánh 2 cột
        // ->whereColumn('create_at', '=', 'create_at')
        // ->get();

        // // LIÊN KẾT BẢNG
        // $list = DB::table('users')
        // ->select('users.*', 'groups.name as group_name')
        //     ->rightJoin('groups', 'users.group_id', '=', 'groups.id')
        //     // ->leftJoin('groups', 'users.group_id', '=', 'groups.id')
        //     // ->join('groups', 'users.group_id', '=', 'groups.id')
        //     ->get();
        // dd($list);

        // SẮP XẾP
        // $list = DB::table('users')
        //     // ->orderBy('id', 'desc')
        //     // ->orderBy('create_at', 'asc')

        //     // SẮP XẾP NGẪU NHIÊn
        //     // ->inRandomOrder()

        //     // TRUY VẤN THEO NHÓM => HAVING
        //     // ->select(DB::raw('count(id) as email_count'), 'email')
        //     // ->groupBy('email')
        //     // ->having('email_count', '>=', '2')

        //     // GIỚI HẠN (vd: từ 0 đến 2)
        //     ->offset(0)
        //     ->limit(2) 
        //     ->get();

        // dd($list);

        // lấy 1 bản ghi đầu tiên của table 
        // (thường là dùng lấy thông tin chi tiết)
        // $detail = DB::table($this->table)->first();
        // dd($detail);
        // dd($detail->email);

        //  THÊM DỮ LIỆU VÀO BẢNG
        // C1:
        // $status = DB::table('users')->insert([
        //     'fullname' => 'Nguyễn Văn B',
        //     'email' => 'bne123@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);
        // dd($status);
        // C2:
        // $lastID = DB::table('users')->insertGetId([
        //     'fullname' => 'Nguyễn Văn B',
        //     'email' => 'bn1e123@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);
        // dd($lastID);

        // // CẬP NHẬT DỮ LIỆU (note: cập nhật tất cả thì BỎ WHERE)
        // $status = DB::table('users')
        //     ->where('id', 7)
        //     ->update([
        //         'fullname' => 'Nguyễn Văn C',
        //         'email' => 'cncc123@gmail.com',
        //         'create_at' => date('Y-m-d H:i:s')
        //     ]);

        // dd($status);

        // // XÓA DỮ LIỆU (note:xóa tất cả thì BỎ WHERE)
        // $status = DB::table('users')
        //     ->where('id', 7)
        //     ->delete();

        // dd($status);

        // ĐẾM SỐ BẢN NGHI
        $List = DB::table('users')->where('id', '>', 2)->get();
        $countList = count($List);
        dd($countList);
    }
}
