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

                        <form action="admin/user/edit/{{$user->id}}" method="POST">
                           <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>User</label>
                            </div>
                            <div class="form-group">
                                <label>UserName</label>
                                <input class="form-control" name="full_name" value="{{$user->full_name}}" autofocus/>
                            </div>   
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" value="{{$user->email}}"/>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" value="{{$user->password}}" readonly/>
                            </div>

                            <div class="form-group">
                                <label>??i???n Tho???i</label>
                                <input class="form-control" name="phone" value="{{$user->phone}}" reaonly/>
                            </div>

                            <div class="form-group">
                                <label>?????a Ch???</label>
                                <input class="form-control" name="address" value="{{$user->address}}" reaonly/>
                            </div>
        
                            <button type="submit" class="btn btn-default">S???a</button>
                            <button type="reset" class="btn btn-default">L??m M???i</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection