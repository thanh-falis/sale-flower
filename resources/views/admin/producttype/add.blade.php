@extends('admin.layout.index') 

@section('content') 
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach                           
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif
                        <form action="admin/producttype/add" method="POST">
                         <input type="hidden" name="_token" value="{{csrf_token()}}" />
                         <input type="hidden" name="delete" value="0">
                            
                            <div class="form-group">
                                <label>Tên Loại Sản Phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập Tên Sản Phẩm" />
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="description" placeholder="Nhập Mô Tả"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm</button>
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
