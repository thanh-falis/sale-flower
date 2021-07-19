@extends('admin.layout.index')

@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Id Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Phương thức thanh toán</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $bill)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$bill->id}}</td>
                                    <td>{{$bill->id_customer}}</td>
                                    <td>{{$bill->date_order}}</td>
                                    <td>{{$bill->total}}</td>
                                    <td>{{$bill->payment}}</td>
                                    <td>{{$bill->note}}</td>
                                    @if($bill->status == 0)
                                    <td>Chờ xử lý</td>
                                    @else
                                    <td>Đã giao</td>
                                    @endif
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/bill/delete/{{$bill->id}}"> Xóa</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/bill/edit/{{$bill->id}}"> Sửa</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection