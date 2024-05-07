@extends('admin.layouts.app')

@section('title')
<title>Đặt bàn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đặt bàn</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="{{route('sets.status')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Mã khách hàng: {{$set_id}}</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="set_id" class="form-control" placeholder="Mã khách hàng" value="{{$set_id}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Bàn số</label>
                            <div class="col-sm-8">
                                <select name="table_id" class="form-control select2 select2-danger mb-3" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($tables as $table)
                                    @if($table->status == 0)
                                    <option value="{{$table->id}}">{{$table->name.' (Tối đa: '.$table->people.' người)'}}</option>
                                    @endif
                                    @endforeach
                                </select>
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
                            <h3 class="card-title">Bảng bàn đang đặt</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Bàn</th>
                                        <th>Số người tối đa</th>
                                        <th>Tầng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tabledetails as $tabledetail)
                                    @if($tabledetail->set_id == $set_id)
                                    <tr>
                                        <td>{{optional($tabledetail->table)->name}}</td>
                                        <td>{{optional($tabledetail->table)->people}}</td>
                                        <td>{{optional($tabledetail->table)->floor}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Bàn</th>
                                        <th>Số người tối đa</th>
                                        <th>Tầng</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-sm-6">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('sets.index')}}" class="btn btn-dark">Kết thúc</a>
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