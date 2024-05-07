@extends('admin.layouts.app')

@section('title')
<title>Trang chủ</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nhà hàng mỳ cay Lizardon</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$bill_count}}</h3>

                            <p>Hóa đơn bán hàng tại quán</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$setbill_count}}</h3>

                            <p>Hóa đơn đặt bàn</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$contactbill_count}}</h3>

                            <p>Hóa đơn giao hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{number_format($total_money, 0, ',', '.')}} đ</h3>

                            <p>Tổng thu nhập</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <div style="margin-bottom: 2%;" class="row">
                <div class="col-sm-8">
                    <div id="bill_chart" data-bill_chart="{{ $bill_chart }}" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-sm-4">
                    <div id="dishbill_chart" data-dishbill_chart="{{ $dishbill_chart }}" style="width: 100%; height: 400px;"></div>
                </div>
            </div>

            <div style="margin-bottom: 2%;" class="row">
                <div class="col-sm-8">
                    <div id="contactbill_chart" data-contactbill_chart="{{ $contactbill_chart }}" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-sm-4">
                    <div id="dishcontactbill_chart" data-dishcontactbill_chart="{{ $dishcontactbill_chart }}" style="width: 100%; height: 400px;"></div>
                </div>
            </div>

            <div style="margin-bottom: 2%;" class="row">
                <div class="col-sm-8">
                    <div id="setbill_chart" data-setbill_chart="{{ $setbill_chart }}" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-sm-4">
                    <div id="dishsetbill_chart" data-dishsetbill_chart="{{ $dishsetbill_chart }}" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection