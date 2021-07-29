@extends('admin.layout.index') 

@section('content') 
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm
                            <small></small>
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
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/user/add" method="POST">
                         <input type="hidden" name="_token" value="{{csrf_token()}}" />
                         <input type="hidden" name="delete" value="0" />
                            
                            <div class="form-group">
                                <label>Họ tên *</label>
                                <input class="form-control" name="full_name" placeholder="Nhập Họ Tên" />
                            </div>

                            <div class="form-group">
                                <label>email *</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập Email"/>
                            </div>

                            <div class="form-group">
                                <label>Mât khẩu *</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập Mật Khẩu"/>
                            </div>

                            <div class="form-group">
                                <label>Nhập Lại mật khẩu *</label>
                                <input type="password" class="form-control" name="repassword" placeholder="Nhập Lại Mật Khẩu"/>
                            </div>

                            <div class="form-group">
                                <label>Điện thoại *</label>
                                <input class="form-control" name="phone" placeholder="Nhập Số Điện Thoại"/>
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ *</label>
                                <input class="form-control" name="address" placeholder="Nhập Địa Chỉ"/>
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
