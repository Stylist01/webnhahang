@extends('admin.layouts.app')

@section('title')
<title>Khách hàng gọi ship</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Khách hàng gọi ship <a href="{{ route('contacts.create') }}" class="btn btn-success">Thêm mới</a></h1>
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
                            <h3 class="card-title">Danh sách Khách hàng gọi ship</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Tin nhắn</th>
                                        <th>Thời gian</th>
                                        <th>Xác nhận</th>
                                        <th>Hành động</th>
                                        <th>Hóa đơn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->name}}</td>
                                        <td><a href="tel:{{$contact->phone}}">{{$contact->phone}}</a></td>
                                        <td>{{$contact->address}}</td>
                                        <td>{{$contact->message}}</td>
                                        <td>{{$contact->updated_at}}</td>
                                        <td>
                                            <?php if ($contact['activated'] == 0) {
                                                echo 'Chưa xác nhận';
                                            } else {
                                                echo 'Đã xác nhận';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('contacts.edit', ['id' => $contact->id]) }}"><i class="fa fa-edit"></i>Sửa</a>
                                            <a class="btn btn-xs btn-danger" href="{{route('contacts.destroy',['id'=>$contact->id])}}"><i class="fa fa-times"></i>Xóa</a>
                                            <a class="btn btn-xs btn-warning" href="/admin/contacts/activated/{{$contact->id}}/{{$contact->activated}}">Xác nhận</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('contacts.contactbill', ['id' => $contact->id]) }}"><i class="fa fa-edit"></i>Tạo</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Tin nhắn</th>
                                        <th>Thời gian</th>
                                        <th>Xác nhận</th>
                                        <th>Hành động</th>
                                        <th>Hóa đơn</th>
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