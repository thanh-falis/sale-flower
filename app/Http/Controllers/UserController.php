<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function getList()
    {
        $user = User::all();
        return view('admin.user.list',['user'=>$user]);
    }

    // public function getEdit($id)
    // {
    //     $user = User::find($id);
    //     return view('admin.user.change_password',['user'=>$user]);
    // }
    
    // public function postEdit(Request $req, $id)
    // {
    //     $user = User::find($id);

    //     $this->validate($req, 
    //     [
    //         'name'=>'required|min:3'
    //     ],
    //     [
    //         'name.required'=>'Bạn chưa nhập loại sản phẩm',
    //         'name.min'=>'Tên loại sản phẩm phải trên 3 ký tự'
    //     ]
    //     );

    //     $type->name = $req->name;
    //     $type->description = $req->description;
    //     $type->delete = $req->delete;  
    //     $type->update(); 

    //     return redirect('admin/producttype/edit/'.$id)->with('thongbao','Sửa thành công');
    // } 

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

    public function postAdd()
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
            'password.required'=>'Vui vui lòng nhập mật khẩu',
            'repassword.same'=>'Mật khẩu không trùng khớp',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu tối đa 20 kí tự',
            'address.required'=>'Vui lòng nhập địa chỉ chính xác và đầy đủ',
            'phone.required'=>'Vui lòng nhập số điện thoại'
        ]
        );

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->remember_token = $req->_token;
        $user->save();
        return redirect()->back()->with('success', 'Thêm thành công');
    }
}
