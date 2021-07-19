@extends('admin.layout.index')

@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết hóa đơn
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>ID Hóa đơn</th>
                                <th>ID Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Trạng thái</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill_detail as $detail)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$detail->id}}</td>
                                    <td>{{$detail->id_bill}}</td>
                                    <td>{{$detail->id_customer}}</td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>{{number_format($detail->unit_price)}}</td>
                                    <td>{{$detail->delete}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/billdetail/delete/{{$detail->id}}"> Xóa</a></td>
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