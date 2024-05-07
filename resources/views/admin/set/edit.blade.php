@extends('admin.layouts.app')

@section('title')
<title>Sửa khách hàng đặt bàn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa khách hàng đặt bàn</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('sets.update',['id'=>$set->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Họ và tên</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Họ và tên" value="{{$set->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{$set->phone}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số lượng người</label>
                            <div class="col-sm-8">
                                <input type="text" name="quantily" class="form-control" placeholder="Số lượng người" value="{{$set->quantily}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Ngày đặt</label>
                            <div class="col-sm-8">
                                <input type="text" name="date" class="form-control" placeholder="Ngày đặt" value="{{$set->date}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Giờ đặt</label>
                            <div class="col-sm-8">
                                <input type="text" name="time" class="form-control" placeholder="Giờ đặt" value="{{$set->time}}">
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