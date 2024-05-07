@extends('layouts.app')

@section('title')
    <title>Thanh toán</title>
@endsection
@section('addcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/cart.css') }}">
    <style>
        table {
            margin: 0;
            table-layout: auto;
        }

        table,
        th,
        td {
            border: unset;
            vertical-align: middle;
        }

        .mapboxgl-ctrl-geocoder input[type='text'] {
            padding: 10px 10px 10px 35px;
        }

        .sum_total_restaurant {
            font-weight: bold;
        }

        /* The Modal (background) */
        .modal-custom {
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 9999;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-custom-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            z-index: 999999;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <section class="page-title page-title-inner"
        style="background: url(https://image.slidesdocs.com/responsive-images/background/3d-illustration-of-a-passive-subscription-concept-for-vdo-multimedia-players-on-mobile-phones-with-a-modern-minimalistic-design-and-purple-pastel-powerpoint-background_804e366248__960_540.jpg) no-repeat center center; background-size: cover;">
        <div class="overlay-pagetitle"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="page-title-heading">
                    <h2 class="heading">Đơn hàng</h2>
                </div>
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>Đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="tf-section tf-blog tf-blog-style2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 cleafix">
                    <div class="content-heading-wrap">
                        <div class="tf-heading-bg cleafix">
                            <h2 class="heading-bg-style02">Đơn hàng</h2>
                        </div>
                        <div class="tf-heading text-center">
                            <h4 class="tf-title tf-title-style2 wow zoomIn  animated" data-wow-delay="0.3ms"
                                data-wow-duration="1200ms"
                                style="visibility: visible; animation-duration: 1200ms; animation-delay: 0.3ms; animation-name: zoomIn;">
                                Đơn hàng của bạn</h4>
                            <p class="tf-sub-heading">Best foods for you &amp; family</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="">
                        <div class="account__content">
                            <div class="account__table--area">
                                <table class="account__table">
                                    <thead class="account__table--header">
                                        <tr class="account__table--header__child">
                                            <th class="account__table--header__child--items">Mã hóa đơn</th>
                                            <th class="account__table--header__child--items">Ngày tạo</th>
                                            <th class="account__table--header__child--items">Trạng thái thanh toán</th>
                                            <th class="account__table--header__child--items">Tình trạng đơn hàng</th>
                                            <th class="account__table--header__child--items">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody class="account__table--body mobile__none">
                                        @foreach ($orders as $order)
                                            <tr class="account__table--body__child">
                                                <td class="account__table--body__child--items"><a data-toggle="modal"
                                                        data-target="#detailOrderModal" class="link_detail_order"
                                                        href="javascript:void(0)">{{ $order->order_id }}</a>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    {{ $order->implementation_date }}</td>
                                                <td class="account__table--body__child--items">
                                                    {{ $status_payment[$order->status_payment] }}
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <ul>
                                                        @foreach (json_decode($order->status) as $item)
                                                            <li>{{ $status[$item[0]] }} - ({{ $item[1] }})</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <b>{{ number_format($order->total_money) }}
                                                        VND</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="detailOrderModal" class="modal-custom d-none" tabindex="-1" aria-labelledby="detailOrderModalLabel" aria-hidden="true">
        <!-- Modal content -->
        <div class="modal-custom-content">
            <div class="modal-header">
                <h5 class="modal-title account__content--title" id="detailOrderModalLabel">Chi tiết đơn hàng: <span
                        class="order_id text-danger"></span>
                </h5>
            </div>
            <div class="modal-body">
                <div id="modal-order-detail">

                </div>
            </div>
        </div>
    </div>
@stop

@section('addjs')
    @include('order.modal.script')
@stop
