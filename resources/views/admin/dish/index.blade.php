@extends('admin.layouts.app')

@section('title')
<title>Món ăn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Món ăn <a href="{{ route('dishs.create') }}" class="btn btn-success">Thêm mới</a></h1>
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
                            <h3 class="card-title">Danh sách Món ăn</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên Món ăn</th>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Giá</th>
                                        <th>Người cập nhật cuối cùng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dishs as $dish)
                                    <tr>
                                        <td>{{$dish->name}}</td>
                                        <td><a href="{{asset($dish->image)}}" target="_blank"><img width="100px" src="{{$dish->image}}"></a></td>
                                        <td>{{optional($dish->category)->name}}</td>
                                        <td>{{number_format($dish->price, 0, ',', '.')}} đ</td>
                                        <td>{{optional($dish->user)->name}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('dishs.edit', ['id' => $dish->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('dishs.destroy',['id'=>$dish->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên Món ăn</th>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Giá</th>
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