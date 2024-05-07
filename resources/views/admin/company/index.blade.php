@extends('admin.layouts.app')

@section('title')
<title>Nhà hàng</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nhà hàng</h1>
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
                            <h3 class="card-title">Danh sách Nhà hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên Nhà hàng</th>
                                        <th>Logo</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>QR ngân hàng</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$company->name}}</td>
                                        <td><a href="{{asset($company->logo)}}" target="_blank"><img width="100px" src="{{$company->logo}}"></a></td>
                                        <td>{{$company->address}}</td>
                                        <td>{{$company->phone}}</td>
                                        <td>{{$company->email}}</td>
                                        <td><a href="{{asset($company->image)}}" target="_blank"><img width="100px" src="{{$company->image}}"></a></td>
                                        <td>{{optional($company->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('companies.edit', ['id' => $company->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên Nhà hàng</th>
                                        <th>Logo</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>QR ngân hàng</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
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