<?php

namespace App\Http\Controllers\backend;
use App\Http\Requests\{AddUserRequest,EditUserRequest};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    function GetAddUser(){
        return view("backend.user.adduser");
    }
    function PostAddUser(AddUserRequest $r){
        $user=new User;
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('admin/user')->with('thongbao','Thêm thành viên thành công!');
    }
    function GetEditUser($id){
        $data['user']=User::find($id);
        
        return view("backend.user.edituser",$data);
    }
    function PostEditUser($id,EditUserRequest $r){
        $user=User::find($id);
        $user->email=$r->email;
        if($r->password!="")
        {
            $user->password=bcrypt($r->password);
        }
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('admin/user')->with('thongbao','Đã sửa thành công!');
        
    }
    function GetListUser(){
        $data['users']=User::paginate(3);
        return view("backend.user.listuser",$data);
    }
    function DelUser($id){
        // $user=User::find($id);
        User::destroy($id);
        return redirect('admin/user')->with('thongbao','Đã xóa thành công');
    }
}
