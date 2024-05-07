@extends('admin.layouts.app')

@section('title')
<title>Hóa đơn đặt online</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hóa đơn đặt online</h1>
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
                            <h3 class="card-title">Danh sách Hóa đơn đặt online</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->order_id}}</td>
                                        <td>{{optional($order->customer)->name}}</td>
                                        <td>{{number_format($order->total_money, 0, ',', '.')}} đ</td>
                                        <td>{{ $status_payment[$order->status_payment] }}</td>
                                        <td>
                                            <ul>
                                                @foreach (json_decode($order->status) as $item)
                                                    <li>{{ $status[$item[0]] }} - ({{ $item[1] }})</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('order.detail', ['id' => $order->id]) }}"><i class="fa fa-edit"></i>Chi tiết hóa đơn</a>
                                            <a class="btn btn-xs btn-primary" href="{{route('contacts.print',['id'=>$order->id])}}" target="_blank">In hóa đơn</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Trạng thái đơn hàng</th>
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
