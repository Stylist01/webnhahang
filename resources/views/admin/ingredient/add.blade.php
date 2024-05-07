@extends('admin.layouts.app')

@section('title')
<title>Thêm mới nguyên liệu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm mới nguyên liệu</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('ingredients.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tên nguyên liệu</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Tên nguyên liệu" value="{{old('name')}}">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số lượng</label>
                            <div class="col-sm-8">
                                <input type="number" name="quantity" class="form-control" placeholder="Số lượng" value="{{old('quantity')}}" min=1>
                                @error('quantity')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Đơn vị</label>
                            <div class="col-sm-8">
                                <input type="text" name="units" class="form-control" placeholder="Đơn vị" value="{{old('units')}}">
                                @error('units')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Giá</label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control" placeholder="Giá" value="{{old('price')}}" min=1>
                                @error('price')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
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