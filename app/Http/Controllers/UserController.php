<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function getLoginAdmin()
    {
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32'
            ],
            [
            'email.request'=>'Bạn Chưa Nhập Email',
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Mật Khẩu Không Được Nhỏ Hơn 3 Ký Tự',
            'password.max'=>'Mật Khẩu Không Được Nhỏ Hơn 32 Ký Tự'
            ]);

        if( Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/producttype/list');
        }
        else
        {
            return redirect('admin/login')->with('thongbao','Bạn Đăng Nhập Không Thành Công');
        }
    }

    public function LogoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
