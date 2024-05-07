@extends('admin.layouts.app')

@section('title')
<title>Sửa hình ảnh</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa món ăn</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('blogs.update',['id'=>$blog->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="col-sm-8">
                                <label className='cursor-pointer select-wrapper'>
                                    <div className='logo-wrapper'>
                                        <img width="100px" id="img" src="{{$blog->image}}" alt="hình ảnh">
                                    </div>
                                    <input type="file" style="display: none;" onchange="preview_thumbail(this);" name='image' />
                                    @error('image')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        
                        <div class="from-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </form>
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