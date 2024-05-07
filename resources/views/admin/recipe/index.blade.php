@extends('admin.layouts.app')

@section('title')
<title>Công thức</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Công thức <a href="{{ route('recipes.create') }}" class="btn btn-success">Thêm mới</a></h1>
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
                            <h3 class="card-title">Danh sách Công thức</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên món ăn</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recipes as $recipe)
                                    <tr>
                                        <td>{{optional($recipe->dish)->name}}</td>
                                        <td><a href="{{asset(optional($recipe->dish)->image)}}" target="_blank"><img width="100px" src="{{optional($recipe->dish)->image}}"></a></td>
                                        <td>{{optional($recipe->ingredient)->name}}</td>
                                        <td>{{$recipe->quantity}}</td>
                                        <td>{{optional($recipe->ingredient)->units}}</td>
                                        <td>{{optional($recipe->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('recipes.edit', ['id' => $recipe->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('recipes.destroy',['id'=>$recipe->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên món ăn</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
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