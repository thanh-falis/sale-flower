<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
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
        $request->session->put('cart',$cart);
        
        return redirect()->back();
    }
}
