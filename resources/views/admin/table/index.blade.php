@extends('admin.layouts.app')

@section('title')
<title>Bàn ăn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bàn ăn <a href="{{ route('tables.create') }}" class="btn btn-success">Thêm mới</a></h1>
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
                            <h3 class="card-title">Danh sách Bàn ăn</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Bàn số</th>
                                        <th>Số người tối đa</th>
                                        <th>Tầng số</th>
                                        <th>Trạng thái</th>
                                        <th>Người cập nhật lần cuối</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tables as $table)
                                    <tr>
                                        <td>{{$table->name}}</td>
                                        <td>{{$table->people}}</td>
                                        <td>{{$table->floor}}</td>
                                        <td>
                                            <?php if ($table['status'] == 0) {
                                                echo 'Đang trống';
                                            } else {
                                                if($table['status'] == 1){
                                                    echo 'Đang sử dụng';
                                                }else{
                                                    echo 'Đã được đặt';
                                                }
                                            } ?>
                                        </td>
                                        <td>{{optional($table->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('tables.edit', ['id' => $table->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('tables.destroy',['id'=>$table->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Bàn số</th>
                                        <th>Số người tối đa</th>
                                        <th>Tầng số</th>
                                        <th>Trạng thái</th>
                                        <th>Người cập nhật lần cuối</th>
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