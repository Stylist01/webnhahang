@extends('admin.layouts.app')

@section('title')
<title>Sửa danh mục</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa danh mục</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form class="form-horizontal" action="{{route('categories.update',['id'=>$category->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tên danh mục</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Tên danh mục" value="{{$category->name}}">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="col-sm-8">
                                <img style="margin-bottom: 5px ;" width="100px" id="img" src="{{$category->image}}" alt="hình ảnh">
                                <input type="file" name="image" class='form-control-file' onchange="preview_thumbail(this);">
                                @error('image')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="from-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </form>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection