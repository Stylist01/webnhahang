@extends('admin.layouts.app')

@section('title')
<title>Nhân viên</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nhân viên <a href="{{ route('personnels.create') }}" class="btn btn-success">Thêm mới</a></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách Nhân viên</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên Nhân viên</th>
                                        <th>Tuổi</th>
                                        <th>Giới tính</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Chức vụ</th>
                                        <th>QR Ngân hàng</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                        <th>Tài khoản</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($personnels as $personnel)
                                    <tr>
                                        <td>{{$personnel->name}}</td>
                                        <td>{{$personnel->age}}</td>
                                        <td>{{$personnel->sex}}</td>
                                        <td>{{optional($personnel->commune)->name}} - {{optional($personnel->district)->name}} - {{optional($personnel->province)->name}}</td>
                                        <td>{{$personnel->phone}}</td>
                                        <td>{{$personnel->email}}</td>
                                        <td>{{optional($personnel->position)->name}}</td>
                                        <td><a href="{{asset($personnel->image)}}" target="_blank"><img width="100px" src="{{$personnel->image}}"></a></td>
                                        <td>{{optional($personnel->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('personnels.edit', ['id' => $personnel->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('personnels.destroy',['id'=>$personnel->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                            <a class="btn btn-xs btn-warning" href="{{route('personnels.timekeeping',['id'=>$personnel->id])}}">Chấm công</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-warning" href="{{ route('personnels.accountCreate', ['id' => $personnel->id]) }}">Tạo</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('personnels.accountDestroy',['id'=>$personnel->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên Nhân viên</th>
                                        <th>Tuổi</th>
                                        <th>Giới tính</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Chức vụ</th>
                                        <th>QR Ngân hàng</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                        <th>Tài khoản</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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