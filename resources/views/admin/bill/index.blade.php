@extends('admin.layouts.app')

@section('title')
<title>Hóa đơn tại quán</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hóa đơn tại quán</h1>
                </div>
                <div class="col-sm-6">
                    <form class="form-horizontal" action="{{route('bills.create')}}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="col-sm-2 control-lable">Bàn số</label>
                            <div class="col-sm-6">
                                <select name="table_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($tables as $table)
                                    @if($table->status == 0)
                                    <option value="{{$table->id}}">{{$table->name.' (Tối đa: '.$table->people.' người)'}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Bắt đầu lập hóa đơn</button>
                        </div>
                    </form>
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
                            <h3 class="card-title">Danh sách Hóa đơn tại quán</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Bàn số</th>
                                        <th>Tổng tiền</th>
                                        <th>Xác nhận</th>
                                        <th>Thanh toán</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bills as $bill)
                                    <tr>
                                        <td>{{$bill->id}}</td>
                                        <td>{{optional($bill->table)->name}}</td>
                                        <td>{{number_format($bill->total_money, 0, ',', '.')}} đ</td>
                                        <td>
                                            <?php if ($bill['activated'] == 0) {
                                                echo 'Chưa xác nhận';
                                            } else {
                                                echo 'Đã xác nhận';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($bill['payment'] == 0) {
                                                echo 'Chưa thanh toán';
                                            } else {
                                                echo 'Đã thanh toán';
                                            } ?>
                                        </td>
                                        <td>{{optional($bill->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('bills.edit', ['id' => $bill->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('bills.show',['id'=>$bill->id])}}">Chi tiết</a>
                                            <a class="btn btn-xs btn-warning" href="/admin/bills/payment/{{$bill->id}}/{{$bill->payment}}/{{optional($bill->table)->id}}">Thanh toán</a>
                                            <a class="btn btn-xs btn-primary" href="{{route('bills.print',['id'=>$bill->id])}}" target="_blank">In hóa đơn</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Bàn số</th>
                                        <th>Tổng tiền</th>
                                        <th>Xác nhận</th>
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