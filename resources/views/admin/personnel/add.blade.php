@extends('admin.layouts.app')

@section('title')
<title>Thêm mới nhân viên</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm mới nhân viên</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('personnels.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tên nhân viên</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Tên nhân viên" value="{{old('name')}}">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tuổi</label>
                            <div class="col-sm-8">
                                <input type="number" name="age" class="form-control" placeholder="Tuổi" value="{{old('age')}}">
                                @error('age')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Giới tính</label>
                            <div class="col-sm-8">
                                <input type="text" name="sex" class="form-control" placeholder="Giới tính" value="{{old('sex')}}">
                                @error('sex')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tỉnh/Thành phố</label>
                            <div class="col-sm-8">
                                <select id="province_id" name="province_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Quận/Huyện</label>
                            <div class="col-sm-8">
                                <select id="district_id" name="district_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                </select>
                                @error('district_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Xã/Phường</label>
                            <div class="col-sm-8">
                                <select id="commune_id" name="commune_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                </select>
                                @error('commune_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{old('phone')}}">
                                @error('phone')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Chức vụ</label>
                            <div class="col-sm-8">
                                <select name="position_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($positions as $position)
                                    <option value="{{$position->id}}">{{$position->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Ngân hàng</label>
                            <div class="col-sm-8">
                                <input type="text" name="bank" class="form-control" placeholder="Ngân hàng" value="{{old('bank')}}">
                                @error('bank')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số tài khoản</label>
                            <div class="col-sm-8">
                                <input type="text" name="account_number" class="form-control" placeholder="Số tài khoản" value="{{old('account_number')}}">
                                @error('account_number')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>QR ngân hàng</label>
                            <div class="col-sm-8">
                                <input type="file" name="image" class='form-control-file' onchange="preview_thumbail(this);">
                                <img id="img" src="#" alt="your image">
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