<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Bill;
use App\Customer;
use App\BillDetail;

class BillDetailController extends Controller
{
    public function __construct()
    {
        $bill_detail = BillDetail::all();
        $customer = Customer::all();
        $bill = Bill::all();
        view()->share('bill',$bill);
        view()->share('bill_detail',$bill_detail);
        view()->share('customer',$customer);
    }

    public function getList()
    {
        $bill_detail = BillDetail::where('delete',0)->get();
        return view('admin/billdetail/list', ['bill_detail'=>$bill_detail]);
    }

    public function Delete($id)
    {
        $bill_detail = BillDetail::find($id);
        $bill_detail->delete = 1;
        $bill_detail->update();
        return redirect('admin/billdetail/list')->with('thongbao','Xóa thành công');
    }
}
