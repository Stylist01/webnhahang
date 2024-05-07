@extends('admin.layouts.app')

@section('title')
<title>Sửa món ăn</title>
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
                    <form class="form-horizontal" action="{{route('dishs.update',['id'=>$dish->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tên món ăn</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Tên món ăn" value="{{$dish->name}}">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="col-sm-8">
                                <label className='cursor-pointer select-wrapper'>
                                    <div className='logo-wrapper'>
                                        <img width="100px" id="img" src="{{$dish->image}}" alt="hình ảnh">
                                    </div>
                                    <input type="file" style="display: none;" onchange="preview_thumbail(this);" name='image' />
                                    @error('image')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Danh mục</label>
                            <div class="col-sm-8">
                                <select name="category_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($categories as $category)
                                    <option <?php if ($dish['category_id'] == $category['id']) echo 'selected' ?> value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Giá</label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control" placeholder="Giá" value="{{$dish->price}}" min=1>
                                @error('price')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='content'>
                                {{$dish->content}}
                                </textarea>
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