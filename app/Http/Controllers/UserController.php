<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function getList()
    {
        $user = User::all();
        return view('admin.user.list',['user'=>$user]);
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }
    
     public function postEdit(Request $req, $id)
     {
         $user = User::find($id);

         $this->validate($req,
        [   
            'full_name'=>'required',
            'email'=>'required|unique:users,email',
            'address'=>'required',
            'phone'=>'required'
        ],
        [
            'full_name.required'=>'Vui lòng nhập họ tên',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử dụng',
            'address.required'=>'Vui lòng nhập địa chỉ chính xác và đầy đủ',
            'phone.required'=>'Vui lòng nhập số điện thoại'
        ]
        );

         $user->full_name = $req->full_name;
         $user->email = $req->email;
         $user->phone = $req->phone;  
         $user->address = $req->address;
         $user->remember_token = $req->_token;  
         $user->update(); 

        return redirect('admin/user/edit/'.$id)->with('thongbao','Sửa thành công');
     } 

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

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd(Request $req)
    {
        $this->validate($req,
        [
            'full_name'=>'required',
            'email'=>'required|unique:customer,email',
            'password'=>'required|min:6|max:20',
            'repassword'=>'required|same:password',
            'address'=>'required',
            'phone'=>'required'
        ],
        [
            
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử dụng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'repassword.same'=>'Mật khẩu không trùng khớp',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu tối đa 20 kí tự',
            'address.required'=>'Vui lòng nhập địa chỉ chính xác và đầy đủ',
            'phone.required'=>'Vui lòng nhập số điện thoại'
        ]
        );

        $user = new User;
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->remember_token = $req->_token;
        $user->save();
        return redirect()->back()->with('thongbao', 'Thêm thành công');
    }

    public function getChange_Password($id)
    {
        $user = User::find($id);
        return view('admin.user.change_password',['user'=>$user]);
    }

    public function postChange_Password(Request $req, $id)
    {
        $this->validate($req,
        [
            'current_password'=>'required',
            'new_password'=>'required|min:6|max:20',
            're_new_password'=>'required|same:new_password'
        ],
        [
            'current_password.required'=>'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required'=>'Vui lòng nhập mật khẩu mới',
            'new_password.min'=>'Mật khẩu tối thiểu cần 6 kí tự',
            'new_password.max'=>'Mật khẩu tối ta 20 kí tự',
            're_new_password.same'=>'Mật khẩu mới không trùng khớp'
        ]
        );

        $user = User::find($id);
        $current_user = auth()->user();
        if(Hash::check($req->current_password, $current_user->password)){
            $user->password = $req->new_password;
            $user->update();
            return redirect()->back()->with('thongbao','Đổi mật khẩu thành công');
        }
        else {
            return redirect()->back()->with('error', 'Đổi mật khẩu không thành công');
        }
        
    }
}
