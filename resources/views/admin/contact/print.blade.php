<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>In Hóa đơn</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-size: 12pt;
            font-family: DejaVu Sans, sans-serif;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            padding: 1.1cm;
            margin-left: auto;
            margin-right: auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        button {
            width: 100px;
            height: 24px;
        }

        .logo {
            background-color: #FFFFFF;
            text-align: left;
            float: left;
        }

        .company {
            padding-top: 24px;
            text-transform: uppercase;
            background-color: #FFFFFF;
            text-align: right;
            float: right;
            font-size: 16px;
        }

        .title {
            text-align: center;
            position: relative;
            color: black;
            font-size: 24px;
            top: 1px;
            margin-top: 100px;
        }

        .footer-left {
            text-align: center;
            text-transform: uppercase;
            padding-top: 24px;
            position: relative;
            height: 150px;
            width: 50%;
            color: #000;
            float: left;
            font-size: 12px;
            bottom: 1px;
        }

        .footer-right {
            text-align: center;
            text-transform: uppercase;
            padding-top: 24px;
            position: relative;
            height: 150px;
            width: 50%;
            color: #000;
            font-size: 12px;
            float: right;
            bottom: 1px;
        }

        .TableData {
            background: #ffffff;
            font: 11px;
            text-align: center;
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            border: thin solid #d3d3d3;
        }

        .TableData TH {
            background: rgba(0, 0, 255, 0.1);
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
        }

        .TableData TR {
            height: 24px;
            border: thin solid #d3d3d3;
        }

        .TableData TR TD {
            padding-right: 2px;
            padding-left: 2px;
            border: thin solid #d3d3d3;
        }

        .TableData TR:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .TableData .cotSTT {
            text-align: center;
            width: 10%;
        }

        .TableData .cotTenSanPham {
            text-align: center;
            width: 40%;
        }

        .TableData .cotHangSanXuat {
            text-align: center;
            width: 20%;
        }

        .TableData .cotGia {
            text-align: center;
            width: 120px;
        }

        .TableData .cotSoLuong {
            text-align: center;
            width: 50px;
        }

        .TableData .cotSo {
            text-align: center;
            width: 120px;
        }

        .TableData .tong {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            padding-right: 4px;
        }

        .TableData .cotSoLuong input {
            text-align: center;
        }

        .company_img {
            width: 120px;
        }

        .dish_img {
            width: 50px;
        }

        @media print {
            @page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div id="page" class="page">
        <div class="header">
            <div class="logo"><img src="{{asset($company->logo)}}" class="company_img" /></div>
            <div class="company">Nhà hàng mỳ cay Lizardon</div>
        </div>
        <br />
        <div class="title">
            HÓA ĐƠN THANH TOÁN
            <br />
            -------oOo-------
            <br>
            Đơn Hàng : #<b>MHD_CONTACTBILL_{{$contactbill->id}}_{{$dt}}</b>
        </div>
        <br />
        <br />
        <p>Khách hàng : {{optional($contactbill->contact)->name}}</p>
        <p>Nhân viên giao hàng : {{optional($contactbill->personnel)->name}}</p>
        <br>
        <table class="TableData">
            <tr>
                <th>Tên món ăn</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
            @foreach($contactdetails as $contactdetail)
            @if($contactdetail->contactbill_id == $contactbill->id)
            <tr>
                <td>{{optional($contactdetail->dish)->name}}</td>
                <td><img src="{{asset(optional($contactdetail->dish)->image)}}" class="dish_img"></td>
                <td>{{$contactdetail->quantily}}</td>
                <td>{{number_format(optional($contactdetail->dish)->price, 0, ',', '.')}} đ</td>
            </tr>
            @endif
            @endforeach
            <tr>
                <td colspan="3" class="tong">Tổng cộng</td>
                <td class="cotSo">{{number_format($contactbill->total_money, 0, ',', '.')}} đ</td>
            </tr>
        </table>
        <div class="footer-left"><br />
            Khách hàng </div>
        <div class="footer-right"> Hà Nội, ngày {{date('d')}} tháng {{date('m')}} năm {{date('Y')}} <br /> Người tạo <br />
            {{ Auth::user()->name }}
        </div>
    </div>
</body>
</html>