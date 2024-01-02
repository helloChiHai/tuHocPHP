<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAllUser()
    {
        $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
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
        $list = DB::table($this->table)
            // ->where('id', '=', 4)
            ->select('fullname as hoTen', 'email')
            ->where([
                ['id', '>=', 2],
                ['id', '<=', 5]
            ])
            ->get();
        dd($list);

        // lấy 1 bản ghi đầu tiên của table 
        // (thường là dùng lấy thông tin chi tiết)
        $detail = DB::table($this->table)->first();
        // dd($detail);
        // dd($detail->email);
    }
}
