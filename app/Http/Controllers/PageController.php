<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\SendMail;
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
use Mail;

class PageController extends Controller
{
    function __construct()
	{
		if(Auth::guard('customer')->check())
		{
			view()->share('login',Auth::guard('customer'));
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
        $product_type = ProductType::all();
        $Type = Product::where('id_type',$type)->get();
        $other_product = Product::where('id_type','<>',$type)->paginate(3);
        return view('pages.loaisanpham',['Type'=>$Type, 'other_product'=>$other_product, 'product_type'=>$product_type]);
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
        if(!Auth::guard('customer')->check()){
            return view('pages.login');
        } 
        else
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
    }
    
    public function postCheckout(Request $req)
    {
        $to_email = $req->email;
        $cart = Session::get('cart');
        
        $bill = new Bill;
        $bill->id_customer = Auth::guard('customer')->user()->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->status = $req->status;
        $bill->note = $req->note;
        $bill->delete = $req->delete;
        $bill->save();

        foreach($cart->items as $key => $val){
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $val['qty'];
            $bill_detail->unit_price = $val['price']/$val['qty'];
            $bill_detail->delete = $req->delete;
            $bill_detail->save();
        }
        $this->Sendmail();
        Session::forget('cart');
        return redirect()->back()->with('thongbao', '?????t h??ng th??nh c??ng, Qu?? kh??ch vui l??ng check Mail');
        
    }

    public function Sendmail() {
        $to_email = Auth::guard('customer')->user()->email;
        $details = [
            'title' => 'Title: Mail from SunFlower',
            'body' => 'Body: This is for send email for your order'
        ];

        \Mail::to($to_email)->send(new SendMail($details));
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
                'email.required'=>'Vui l??ng nh???p email',
                'email.email'=>'Kh??ng ????ng ?????nh d???ng email',
                'password.required'=>'Vui vui l??ng nh???p m???t kh???u',
                'password.min'=>'M???t kh???u ??t nh???t 6 k?? t???',
                'password.max'=>'M???t kh???u t???i ??a 20 k?? t???'
            ]
        );

        if(Auth::guard('customer')->attempt(['email'=>$req->email,'password'=>$req->password]))
        {
            return redirect('/')->with('thongbao', '????ng nh???p th??nh c??ng');
        }
        else
        {
            return redirect('login')->with('thongbao','B???n ????ng Nh???p Kh??ng Th??nh C??ng');
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
            'name'=>'required',
            'email'=>'required|unique:customer,email',
            'password'=>'required|min:6|max:20',
            'repassword'=>'required|same:password',
            'address'=>'required',
            'phone'=>'required'
        ],
        [
            
            'email.required'=>'Vui l??ng nh???p email',
            'email.email'=>'Kh??ng ????ng ?????nh d???ng email',
            'email.unique'=>'Email ???? c?? ng?????i s??? d???ng',
            'password.required'=>'Vui vui l??ng nh???p m???t kh???u',
            'repassword.same'=>'M???t kh???u kh??ng tr??ng kh???p',
            'password.min'=>'M???t kh???u ??t nh???t 6 k?? t???',
            'password.max'=>'M???t kh???u t???i ??a 20 k?? t???',
            'address.required'=>'Vui l??ng nh???p ?????a ch??? ch??nh x??c v?? ?????y ?????',
            'phone.required'=>'Vui l??ng nh???p s??? ??i???n tho???i'
        ]
        );

        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;        
        $customer->email = $req->email;
        $customer->password = Hash::make($req->password);
        $customer->phone_number = $req->phone;
        $customer->address = $req->address;
        $customer->note = $req->note;
        $customer->save();
        return redirect()->back()->with('success', 'T???o t??i kho???n th??nh c??ng');
    }

    public function Logout()
	{
        if(Auth::guard('customer')->check())
        {
            Auth::guard('customer')->logout();
            return redirect()->back();
        }
	}
    
    public function Search(Request $req)
	{
		$product = Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        return view('pages.search',compact('product'));
	}

}
