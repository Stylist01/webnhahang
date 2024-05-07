@extends('admin.layouts.app')

@section('title')
<title>Nguyên liệu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nguyên liệu <a href="{{ route('ingredients.create') }}" class="btn btn-success">Thêm mới</a></h1>
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
                            <h3 class="card-title">Danh sách Nguyên liệu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
                                        <th>Giá</th>
                                        <th>Người cập nhật lần cuối</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ingredients as $ingredient)
                                    <tr>
                                        <td>{{$ingredient->name}}</td>
                                        <td>{{$ingredient->quantity}}</td>
                                        <td>{{$ingredient->units}}</td>
                                        <td>{{number_format($ingredient->price, 0, ',', '.')}} đ</td>
                                        <td>{{optional($ingredient->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('ingredients.edit', ['id' => $ingredient->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('ingredients.destroy',['id'=>$ingredient->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
                                        <th>Giá</th>
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