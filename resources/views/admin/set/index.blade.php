@extends('admin.layouts.app')

@section('title')
<title>Khách hàng đặt bàn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Khách hàng đặt bàn <a href="{{ route('sets.create') }}" class="btn btn-success">Thêm mới</a></h1>
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
                            <h3 class="card-title">Danh sách Khách hàng đặt bàn</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã số</th>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Số lượng người</th>
                                        <th>Ngày đặt</th>
                                        <th>Giờ đặt</th>
                                        <th>Xác nhận</th>
                                        <th>Đặt bàn</th>
                                        <th>Hành động</th>
                                        <th>Đặt bàn</th>
                                        <th>Hóa đơn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sets as $set)
                                    <tr>
                                        <td>{{$set->id}}</td>
                                        <td>{{$set->name}}</td>
                                        <td><a href="tel:{{$set->phone}}">{{$set->phone}}</a></td>
                                        <td>{{$set->quantily}}</td>
                                        <td>{{$set->date}}</td>
                                        <td>{{$set->time}}</td>
                                        <td>
                                            <?php if ($set['activated'] == 0) {
                                                echo 'Chưa xác nhận';
                                            } else {
                                                echo 'Đã xác nhận';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($set['status'] == 0) {
                                                echo 'Chưa đặt bàn';
                                            } else {
                                                echo 'Đã đặt bàn';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('sets.edit', ['id' => $set->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('sets.destroy',['id'=>$set->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                            <a class="btn btn-xs btn-warning" href="/admin/sets/activated/{{$set->id}}/{{$set->activated}}">Xác nhận</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-secondary" href="{{ route('sets.table', ['id' => $set->id]) }}"><i class="fa fa-edit"></i>Đặt</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('sets.setbill', ['id' => $set->id]) }}"><i class="fa fa-edit"></i>Tạo</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã số</th>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Số lượng người</th>
                                        <th>Ngày đặt</th>
                                        <th>Giờ đặt</th>
                                        <th>Xác nhận</th>
                                        <th>Đặt bàn</th>
                                        <th>Hành động</th>
                                        <th>Đặt bàn</th>
                                        <th>Hóa đơn</th>
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