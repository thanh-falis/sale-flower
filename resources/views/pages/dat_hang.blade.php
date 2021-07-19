@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đặt hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(Session::has('thongbao'))<div class="alert alert-success">{{Session::get('thongbao')}}</div>@endif
        <form action="dat-hang" method="post" class="beta-form-checkout">
            <input type="hidden" name="status" value="0" />
            <input type="hidden" name="delete" value="0" />
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <h4>Đặt hàng</h4>
                    <div class="space20">&nbsp;</div>
                    @if(Auth::guard('customer')->check())
                        
                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" name="name" value="{{Auth::guard('customer')->user()->name}}" readonly>
                        </div>

                        <div class="form-block">
                            <label>Giới tính </label>
                            @if(Auth::guard('customer')->user()->gender == 'nam')
                                <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                                <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
                            @else
                                <input id="gender" type="radio" class="input-radio" name="gender" value="nam" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                                <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" checked="checked" style="width: 10%"><span>Nữ</span>
                            @endif           
                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" required value="{{Auth::guard('customer')->user()->email}}"  readonly>
                        </div>

                        <div class="form-block">
                            <label for="address">Địa chỉ*</label>
                            <input type="text" id="address" name="address" value="{{Auth::guard('customer')->user()->address}}"  readonly>
                        </div>
                        

                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone" value="{{Auth::guard('customer')->user()->phone_number}}" readonly>
                        </div>
                     @endif
                    <div class="form-block">
                        <label for="notes">Ghi chú</label>
                        <textarea id="notes" name="note" value="{{Auth::guard('customer')->user()->note}}"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        <div class="your-order-body" style="padding: 0px 10px">
                            <div class="your-order-item">
                                <div>
                                <!--  one item	 -->
                                @if(Session::has('cart'))
                                    <div class="media">
                                        @foreach($product_cart as $order)
                                            <img width="25%" style="margin-right: 10px;" src="source/image/product/{{$order['item']['image']}}" alt="" class="pull-left">
                                            <div class="media-body">
                                                <p class="font-large">{{$order['item']['name']}}</p>
                                                <span class="color-gray your-order-info">Đơn giá: {{number_format($order['item']['unit_price'])}}</span>
                                                <span class="color-gray your-order-info">Số lượng: {{$order['qty']}}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <!-- end one item -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                <div class="pull-right"><h5 class="color-black">@if(Session::has('cart')) {{number_format($totalPrice)}} @else 0 @endif đ</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
                        
                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment" value="COD" checked="checked" data-order_button_text="">
                                    <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                        Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                    </div>						
                                </li>

                                <li class="payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment" value="ATM" data-order_button_text="">
                                    <label for="payment_method_cheque">Chuyển khoản </label>
                                    <div class="payment_box payment_method_cheque" style="display: none;">
                                        Chuyển tiền đến tài khoản sau:
                                        <br>- Số tài khoản: 123 456 789
                                        <br>- Chủ TK: Nguyễn Văn Thanh
                                        <br>- Ngân hàng VCB, Chi nhánh Long Thành - Đồng Nai
                                    </div>						
                                </li>
                                
                            </ul>
                        </div>

                        <div class="text-center"><button type="submit" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
