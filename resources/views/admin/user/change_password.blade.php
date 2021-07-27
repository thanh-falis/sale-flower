@extends('admin.layout.index')

@section('content')   
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User Admin
                            <small>{{$user->full_name}}</small>
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

                        <form action="admin/user/change-password/{{$user->id}}" method="POST">
                           <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Đổi Mật Khẩu</label>
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu Hiện Tại *</label>
                                <input class="form-control" type="password" name="current_password" autofocus/>
                            </div>   
                            <div class="form-group">
                                <label>Mật Khẩu Mới *</label>
                                <input class="form-control"  type="password" name="new_password" />
                            </div>

                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu Mới *</label>
                                <input class="form-control" type="password" name="re_new_password" />
                            </div>

                            <button type="submit" class="btn btn-default">Đổi Mật Khẩu</button>
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