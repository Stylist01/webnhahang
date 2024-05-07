@extends('admin.layouts.app')

@section('title')
<title>Hóa đơn khách hàng gọi ship</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hóa đơn khách hàng gọi ship</h1>
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
                            <h3 class="card-title">Danh sách Hóa đơn khách hàng gọi ship</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tên nhân viên giao hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Thời gian</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contactbills as $contactbill)
                                    <tr>
                                        <td>{{$contactbill->id}}</td>
                                        <td>{{optional($contactbill->contact)->name}}</td>
                                        <td>{{optional($contactbill->personnel)->name}}</td>
                                        <td>{{number_format($contactbill->total_money, 0, ',', '.')}} đ</td>
                                        <td>{{$contactbill->updated_at}}</td>
                                        <td>{{optional($contactbill->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('contacts.detail', ['id' => $contactbill->id]) }}"><i class="fa fa-edit"></i>Chi tiết hóa đơn</a>
                                            <a class="btn btn-xs btn-primary" href="{{route('contacts.print',['id'=>$contactbill->id])}}" target="_blank">In hóa đơn</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tên nhân viên giao hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Thời gian</th>
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