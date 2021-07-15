<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Session;
use Hash;

class PageController extends Controller
{
    function __construct()
	{
		if(Auth::check())
		{
			view()->share('login',Auth::user());
		}
	}

    public function Index()
    {
        $new_product = Product::where('new',1)->paginate(4);
        $slide = Slide::all();
        $Sale = Product::where('promotion_price','<>',0)->paginate(8);
        return view('pages.trangchu',['slide'=>$slide, 'new_product'=>$new_product, 'Sale'=>$Sale]);
    }

    public function Loaisanpham($type)
    {
        $Type = Product::where('id_type',$type)->get();
        $other_product = Product::where('id_type','<>',$type)->paginate(3);
        return view('pages.loaisanpham',['Type'=>$Type, 'other_product'=>$other_product]);
    }

    public function ChitietSP(Request $req)
    {
        $product = Product::where('id',$req->id)->first();
        $similar_product = Product::where('id_type', $product->id_type)->paginate(3);
        return view('pages.chitiet_sanpham',['product' => $product, 'similar_product' => $similar_product]);
    }

    public function Lienhe()
    {
        return view('pages.lienhe');
    }

    public function Gioithieu()
    {
        return view('pages.gioithieu');
    }

    public function Addcart(Request $request, $id)
    {
        $Product = Product::find($id);
        //echo '<pre>'; print_r($Product);exit;
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($Product, $id);//print_r($cart);exit;
        $request->session()->put('cart',$cart);
        
        return redirect()->back();
    }
    
    public function DeleteCart($id)
    {
        $oldcart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldcart);
        $cart->removeItem($id);
        if(count($cart->items) > 0) {
            Session::put('cart',$cart);
        }
        else {
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function getCheckout()
    {
        if(Session::has('cart')){
            $oldcart = Session::get('cart');
            $cart = new Cart($oldcart);
            //dd($cart);
            return view('pages.dat_hang', ['product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'totalQty'=>$cart->totalQty]);
        }
        else {
            return view('pages.dat_hang');
        }
    }
    
    public function postCheckout(Request $req)
    {
        
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->note;
        $customer->save();

        $cart = Session::get('cart');
        
        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->note = $req->note;
        $bill->save();

        foreach($cart->items as $key => $val){
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $val['qty'];
            $bill_detail->unit_price = $val['price']/$val['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao', 'Đặt hàng thành công');
    }

    public function getLogin()
    {
        return view('pages.login');
    }

    public function postLogin(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'password.required'=>'Vui vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu tối đa 20 kí tự'
            ]
        );

        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password]))
        {
            return redirect('/')->with('thongbao', 'Đăng nhập thành công');
        }
        else
        {
            return redirect('login')->with('thongbao','Bạn Đăng Nhập Không Thành Công');
        }

        
    }

    public function getRegister()
    {
         return view('pages.register');
    }

    public function postRegister(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'full_name'=>'required',
                'repassword'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui vui lòng nhập mật khẩu',
                'repassword.same'=>'Mật khẩu không trùng khớp',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu tối đa 20 kí tự'
            ]
        );

        $user = new User;
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->power = $req->power;
        $user->save();
        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }

    public function Logout()
	{
		Auth::logout();
		return redirect()->back();
	}
    
    public function Search(Request $req)
	{
		$product = Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        return view('pages.search',compact('product'));
	}
}
