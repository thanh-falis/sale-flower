@extends('admin.layout.index')

@section('content')   
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit
                            <small>{{$product->name}}</small>
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

                        <form action="admin/product/edit/{{$product->id}}" method="POST">
                           <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Sửa</label>
                            </div>
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập Tên Sản Phẩm" value="{{$product->name}}"/>
                            </div>

                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control" name="product_type">
                                    @foreach($product_type as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" name="description" placeholder="Nhập Mô Tả" value="{{$product->description}}"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input class="form-control" name="unit_price" placeholder="Nhập giá gốc" value="{{$product->unit_price}}">
                            </div>

                            <div class="form-group">
                                <label>Giá giảm</label>
                                <input class="form-control" name="promotion_price" placeholder="Nhập giá giảm" value="{{$product->promotion_price}}">
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input class="form-control" type="file" name="image" value="{{$product->image}}">
                            </div>

                            <div class="form-group">
                                <label>Số lượng có sẵn</label>
                                <input class="form-control" name="unit" value="{{$product->unit}}">
                            </div>

                            <div class="form-group">
                                <label>Sản phẩm mới</label>
                                <select class="form-control" name="new">
                                    <option value="{{$product->new}}">Chọn làm sản phẩm mới</option>
                                    <option value="0">Không</option>
                                </select>
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