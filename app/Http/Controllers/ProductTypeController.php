<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        $type = ProductType::all();
        view()->share('product_type',$type);
    }

    public function getList()
    {
        $type = ProductType::where('delete',0)->get();
        return view('admin.producttype.list', ['producttype'=>$type]);
    }

    public function getAdd()
    {
        return view('admin.producttype.add');
    }

    public function postAdd(Request $req)
    {
        $this->validate($req, 
        [
            'name'=>'required|uique:type_product,name|min:3',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm đã tồn tại',
            'name.min'=>'Tên loại sản phẩm phải trên 3 ký tự',
        ]
        );

        $producttype = new ProductType;
        $producttype->name = $req->name;
        $producttype->description = $req->name;
        $producttype->delete = $req->delete;
        $producttype->save();

        return redirect('admin/producttype/add')->with('message','Thêm thành công');
    }

    public function getEdit($id)
    {
        $type = ProductType::find($id);
        return view('admin.producttype.edit',['type'=>$type]);
    }
    
    public function postEdit(Request $req, $id)
    {
        $type = ProductType::find($id);

        $this->validate($req, 
        [
            'name'=>'required|min:3'
        ],
        [
            'name.required'=>'Bạn chưa nhập loại sản phẩm',
            'name.min'=>'Tên loại sản phẩm phải trên 3 ký tự'
        ]
        );

        $type->name = $req->name;
        $type->description = $req->description;
        $type->delete = $req->delete;  
        $type->update(); 

        return redirect('admin/producttype/edit/'.$id)->with('thongbao','Sửa thành công');
    } 
    
    public function Delete($id)
    {
        $type = ProductType::find($id);
        $type->delete = 1;
        $type->update();
        return redirect('admin/producttype/list')->with('thongbao','Xóa thành công');
    }
    
}
