<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Str;

use App\Product;
use App\ProductType;

class ProductController extends Controller
{
    public function __construct()
    {
        $product = Product::all();
        $product_type = ProductType::all();
        view()->share('product',$product);
        view()->share('product_type',$product_type);
    }

    public function getList()
    {
        $product = Product::where('flag',0)->get();
        return view('admin/product/list', ['product'=>$product]);
    }

    public function getAdd()
    {
        return view('admin.product.add');
    }

    public function postAdd(Request $req)
    {
        $this->validate($req, [
            'name'=>'required|min:3|unique:products,name',
            'unit_price'=>'required',
            'promotion_price'=>'required',
            'unit'=>'required'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm đã tồn tại',
            'name.min'=>'Tên loại sản phẩm phải trên 3 ký tự',
            'unit_price.required'=>'Bạn chưa nhập giá gốc',
            'promotion_price.required'=>'Bạn chưa nhập giá giảm',
            'unit.required'=>'Bạn chưa nhập tình trạng sản phẩm',
        ]
        );
        if($req->hasFile('image'))
        {
            //config image
            $file = $req->file('image');
            
            $name = $file->getClientOriginalName(); 
            $hinh = Str::random(4)."_".$name;
            while(file_exists("upload/product/".$hinh))
            {
                $hinh = Str::random(4)."_".$name;
            }
            $file->move("source/image/product/", $hinh);//move image to upload folder
            //
        }
        
        $product = new Product;
        $product->name = $req->name;
        $product->id_type = $req->product_type;
        $product->description = $req->description;
        $product->unit_price = $req->unit_price;
        $product->promotion_price = $req->promotion_price; 
        $product->image = $hinh;
        $product->unit = $req->unit;
        $product->new = $req->new;
        $product->flag = $req->flag;
       
        $product->save();

        return redirect('admin/product/list')->with('message','Thêm thành công');
    }

    public function getEdit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit',['product'=>$product]);
    }
    
    public function postEdit(Request $req, $id)
    {
        $product = Product::find($id);

        $this->validate($req, [
            'name'=>'required|min:3|unique:products,name',
            'unit_price'=>'required',
            'promotion_price'=>'required',
            'unit'=>'required'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm đã tồn tại',
            'name.min'=>'Tên loại sản phẩm phải trên 3 ký tự',
            'unit_price.required'=>'Bạn chưa nhập giá gốc',
            'promotion_price.required'=>'Bạn chưa nhập giá giảm',
            'unit.required'=>'Bạn chưa nhập tình trạng sản phẩm',
        ]
        );

        if($req->hasFile('image'))
        {
            //config image
            $file = $req->file('image');
            
            $name = $file->getClientOriginalName(); 
            $hinh = Str::random(4)."_".$name;
            while(file_exists("upload/product/".$hinh))
            {
                $hinh = Str::random(4)."_".$name;
            }
            $file->move("source/image/product/", $hinh);//move image to upload folder
            //
        }
        
        $product->name = $req->name;
        $product->id_type = $req->product_type;
        $product->description = $req->description;
        $product->unit_price = $req->unit_price;
        $product->promotion_price = $req->promotion_price; 
        $product->image = $hinh;
        $product->unit = $req->unit;
        $product->new = $req->new;
        $product->flag = $req->flag;
        $product->update(); 

        return redirect('admin/product/list')->with('thongbao','Sửa thành công');
    } 
    
    public function Delete($id)
    {
        $product = Product::find($id);
        $product->flag = 1;
        $product->update();
        return redirect('admin/product/list')->with('thongbao','Xóa thành công');
    }
}
