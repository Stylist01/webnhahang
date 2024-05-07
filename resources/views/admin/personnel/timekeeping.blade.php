@extends('admin.layouts.app')

@section('title')
<title>Chấm công</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chấm công nhân viên: {{$personnel->name}} <a href="{{route('personnels.checkin',['id'=>$personnel->id])}}" class="btn btn-success">Check in</a></h1>
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
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Bảng chấm công</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên Nhân viên</th>
                                        <th>Ngày</th>
                                        <th>Begin</th>
                                        <th>End</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timekeepings as $timekeeping)
                                    <tr>
                                        <td>{{optional($timekeeping->personnel)->name}}</td>
                                        <td>{{$timekeeping->day}}</td>
                                        <td>{{$timekeeping->begin}}</td>
                                        <td>{{$timekeeping->end}}</td>
                                        <td>
                                            <a href="/admin/personnels/checkout/{{$timekeeping->id}}/{{$timekeeping->personnel_id}}" class="btn btn-success">Check out</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên Nhân viên</th>
                                        <th>Ngày</th>
                                        <th>Begin</th>
                                        <th>End</th>
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