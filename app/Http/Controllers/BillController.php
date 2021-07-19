<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Bill;
use App\Customer;

class BillController extends Controller
{
    public function __construct()
    {
        $bill = Bill::all();
        $customer = Customer::all();
        view()->share('bill',$bill);
        view()->share('customer',$customer);
    }

    public function getList()
    {
        $bill = Bill::where('delete',0)->get();
        return view('admin/bill/list', ['bill'=>$bill]);
    }

    public function getEdit($id)
    {
        $bill = Bill::find($id);
        return view('admin.bill.edit',['bill'=>$bill]);
    }
    
    public function postEdit(Request $req, $id)
    {
        $bill = Bill::find($id);
        $bill->status = $req->status;
        $bill->update();
        return redirect('admin/bill/edit/'.$id)->with('thongbao','Sửa thành công');
    }

    public function Delete($id)
    {
        $bill = Bill::find($id);
        $bill->delete = 1;
        $bill->update();
        return redirect('admin/bill/list')->with('thongbao','Xóa thành công');
    }
}
