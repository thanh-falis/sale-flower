@extends('admin.layout.index')

@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Loại sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá gốc</th>
                                <th>Giá giảm</th>
                                <th>Hình ảnh</th>
                                <th>Tình trạng</th>
                                <th>Sản phẩm mới</th>
                                <th>Đã Xóa</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $product)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->id_type}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>{{$product->promotion_price}}</td>
                                    <td><image style="height:100px;" src="source/image/product/{{$product->image}}" alt=""></td>
                                    <td>{{$product->unit}}</td>
                                    <td>{{$product->new}}</td>
                                    <td>{{$product->flag}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/product/delete/{{$product->id}}"> Xóa</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/product/edit/{{$product->id}}"> Sửa</a></td>
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