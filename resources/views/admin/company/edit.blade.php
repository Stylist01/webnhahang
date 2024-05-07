@extends('admin.layouts.app')

@section('title')
<title>Sửa nhà hàng</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa nhà hàng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('companies.update',['id'=>$company->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tên nhà hàng</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Tên nhà hàng" value="{{$company->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name='description'>
                                    {{$company->description}}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <div class="col-sm-8">
                                <label className='cursor-pointer select-wrapper'>
                                    <div className='logo-wrapper'>
                                        <img width="100px" id="logo" src="{{$company->logo}}" alt="hình ảnh">
                                    </div>
                                    <input type="file" style="display: none;" onchange="preview_thumbail_logo(this);" name='logo' />
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{$company->address}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{$company->phone}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{$company->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Ngân hàng</label>
                            <div class="col-sm-8">
                                <input type="text" name="bank" class="form-control" placeholder="Ngân hàng" value="{{$company->bank}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số tài khoản</label>
                            <div class="col-sm-8">
                                <input type="text" name="account_number" class="form-control" placeholder="Số tài khoản" value="{{$company->account_number}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label>QR Bank</label>
                            <div class="col-sm-8">
                                <label className='cursor-pointer select-wrapper'>
                                    <div className='logo-wrapper'>
                                        <img width="100px" id="img" src="{{$company->image}}" alt="hình ảnh">
                                    </div>
                                    <input type="file" style="display: none;" onchange="preview_thumbail(this);" name='image' />
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='content'>
                                {{$company->content}}
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