@extends('admin.layout.index')

@section('content')   
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa đơn
                            <small>{{$bill->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br/>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif

                        <form action="admin/bill/edit/{{$bill->id}}" method="POST">
                           <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label></label>
                            </div>
                            <div class="form-group">
                            <label>ID khách hàng</label>
                                <input class="form-control" name="id_customer" value="{{$bill->id_customer}}" readonly/>
                            </div>   
                            <div class="form-group">
                                <label>Ngày đặt</label>
                                <input class="form-control" name="date_order" value="{{$bill->date_order}}" readonly/>
                            </div>
                            <div class="form-group">
                                <label>Tổng tiền</label>
                                <input class="form-control" name="total" value="{{$bill->total}}" readonly/>
                            </div>
                            <div class="form-group">
                                <label>Phương thức thanh toán</label>
                                <input class="form-control" name="payment" value="{{$bill->payment}}" readonly/>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái đơn hàng</label>
                                <select name="status">
                                    <option value="{{$bill->status}}">Đang xử lý</option>
                                    <option value="1">Đã giao</option>
                                </select>
                            </div>  
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" name="note" value="{{$bill->note}}"></textarea>
                            </div>    
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection