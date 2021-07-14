<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use Session;

class PageController extends Controller
{
    // public function __construct()
    // {

    // }

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
        // $this->validate($req,[
        //     'name'=>'require',
        //     'email'=>'required',
        //     'address'=>'require',
        //     'phone'=>'require'
        //     ],
        //     [
        //     'name.request'=>'Bạn Chưa Nhập Họ Tên',
        //     'email.request'=>'Bạn Chưa Nhập Email',
        //     'address.request'=>'Bạn Chưa Nhập Địa Chỉ',
        //     'phone.request'=>'Bạn Chưa Nhập Số Điện Thoại',
        //     ]);

        

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
}
