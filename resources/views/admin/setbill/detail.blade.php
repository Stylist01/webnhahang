@extends('admin.layouts.app')

@section('title')
<title>Chi tiết hóa đơn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết hóa đơn: {{$setbill->id}}</h1>
                    <h4>Khách hàng: {{optional($setbill->set)->name}}</h4>
                    <h4>Bàn số: </h4>
                    <ul>
                        @foreach($tabledetails as $tabledetail)
                        @if($tabledetail->set_id == $setbill->set_id)
                        <li>{{optional($tabledetail->table)->name}}</li>
                        @endif
                        @endforeach
                    </ul>
                    <h5>Tổng tiền: {{number_format($setbill->total_money, 0, ',', '.')}} đ</h5>
                    <h5>Thời gian: {{$setbill->updated_at}}</h5>
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
                            <h3 class="card-title">Danh sách Chi tiết hóa đơn off</h3>
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
                                    @foreach($setdetails as $setdetail)
                                    @if($setdetail->setbill_id == $setbill->id)
                                    <tr>
                                        <td>{{optional($setdetail->dish)->name}}</td>
                                        <td><a href="{{asset(optional($setdetail->dish)->image)}}" target="_blank"><img width="100px" src="{{optional($setdetail->dish)->image}}"></a></td>
                                        <td>{{$setdetail->quantily}}</td>
                                        <td>{{number_format(optional($setdetail->dish)->price, 0, ',', '.')}} đ</td>
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