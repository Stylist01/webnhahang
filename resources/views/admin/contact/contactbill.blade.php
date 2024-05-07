@extends('admin.layouts.app')

@section('title')
<title>Tạo hóa đơn cho khách hàng gọi ship</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tạo hóa đơn cho khách hàng gọi ship</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('contacts.contactdetail')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Mã hóa đơn: {{$contactbill_id}}</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="contactbill_id" class="form-control" placeholder="Mã hóa đơn" value="{{$contactbill_id}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Món ăn</label>
                            <div class="col-sm-8">
                                <select name="dish_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($dishs as $dish)
                                    <option value="{{$dish->id}}">{{$dish->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Số lượng</label>
                            <div class="col-sm-8">
                                <input type="number" name="quantily" class="form-control" placeholder="Số lượng">
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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bảng món ăn đang đặt</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Món ăn</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contactdetails as $contactdetail)
                                    @if($contactdetail->contactbill_id == $contactbill_id)
                                    <tr>
                                        <td>{{optional($contactdetail->dish)->name}}</td>
                                        <td><a href="{{asset(optional($contactdetail->dish)->image)}}" target="_blank"><img width="100px" src="{{optional($contactdetail->dish)->image}}"></a></td>
                                        <td>{{$contactdetail->quantily}}</td>
                                        <td>{{number_format(optional($contactdetail->dish)->price, 0, ',', '.')}} đ</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Món ăn</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <form class="form-horizontal" action="{{route('contacts.contactpersonnel')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Mã hóa đơn: {{$contactbill_id}}</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="id" class="form-control" placeholder="Mã hóa đơn" value="{{$contactbill_id}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Chọn nhân viên ship</label>
                            <div class="col-sm-8">
                                <select name="personnel_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($personnels as $personnel)
                                    <option value="{{$personnel->id}}">{{$personnel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="from-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Lưu nhân viên</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('contacts.print',['id'=>$contactbill_id])}}" class="btn btn-warning" target="_blank">In hóa đơn</a>
                    </div>
                </div>

                <br>

                <div class="col-sm-6">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('contacts.index')}}" class="btn btn-dark">Kết thúc</a>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection