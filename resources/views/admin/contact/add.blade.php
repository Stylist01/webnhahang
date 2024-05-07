@extends('admin.layouts.app')

@section('title')
<title>Thêm mới khách hàng gọi ship</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm mới khách hàng gọi ship</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('contacts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Họ và tên</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Họ và tên" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{old('phone')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{old('address')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tin nhắn</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name='message'>
                                    {{old('message')}}
                                </textarea>
                            </div>
                        </div>
                        
                        <div class="from-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection