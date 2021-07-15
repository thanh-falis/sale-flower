@extends('admin.layout.index')

@section('content')   
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>{{$type->name}}</small>
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

                        <form action="admin/producttype/edit/{{$type->id}}" method="POST">
                           <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="name" placeholder="Nhập Tên Loại Tin" value="{{$type->name}}" />
                            </div>   
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="description" placeholder="Nhập Mô Tả" value="{{$type->description}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="delete">
                                    <option value="{{$type->delete}}">Không</option>
                                    <option value="1">Xóa</option>
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