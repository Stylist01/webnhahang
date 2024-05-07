@extends('admin.layouts.app')

@section('title')
<title>Hóa đơn khách hàng đặt bàn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hóa đơn khách hàng đặt bàn</h1>
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
                            <h3 class="card-title">Danh sách Hóa đơn khách hàng đặt bàn</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Thời gian</th>
                                        <th>Thanh toán</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($setbills as $setbill)
                                    <tr>
                                        <td>{{$setbill->id}}</td>
                                        <td>{{optional($setbill->set)->name}}</td>
                                        <td>{{number_format($setbill->total_money, 0, ',', '.')}} đ</td>
                                        <td>{{$setbill->updated_at}}</td>
                                        <td>
                                            <?php if ($setbill['payment'] == 0) {
                                                echo 'Chưa thanh toán';
                                            } else {
                                                echo 'Đã thanh toán';
                                            } ?>
                                        </td>
                                        <td>{{optional($setbill->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('sets.detail', ['id' => $setbill->id]) }}"><i class="fa fa-edit"></i>Chi tiết hóa đơn</a>
                                            <a class="btn btn-xs btn-dark" href="/admin/setbills/payment/{{$setbill->id}}/{{$setbill->payment}}">Thanh toán</a>
                                            <a class="btn btn-xs btn-primary" href="{{route('sets.print',['id'=>$setbill->id])}}" target="_blank">In hóa đơn</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Thời gian</th>
                                        <th>Thanh toán</th>
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