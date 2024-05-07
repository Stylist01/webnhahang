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
    </style>
@endsection
@section('content')
    <section class="page-title page-title-inner"
        style="background: url(https://image.slidesdocs.com/responsive-images/background/3d-illustration-of-a-passive-subscription-concept-for-vdo-multimedia-players-on-mobile-phones-with-a-modern-minimalistic-design-and-purple-pastel-powerpoint-background_804e366248__960_540.jpg) no-repeat center center; background-size: cover;">
        <div class="overlay-pagetitle"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="page-title-heading">
                    <h2 class="heading">Thanh toán</h2>
                </div>
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>Thanh toán</li>
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
                            <h2 class="heading-bg-style02">Thanh toán</h2>
                        </div>
                        <div class="tf-heading text-center">
                            <h4 class="tf-title tf-title-style2 wow zoomIn  animated" data-wow-delay="0.3ms"
                                data-wow-duration="1200ms"
                                style="visibility: visible; animation-duration: 1200ms; animation-delay: 0.3ms; animation-name: zoomIn;">
                                Thanh toán hóa đơn</h4>
                            <p class="tf-sub-heading">Best foods for you &amp; family</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="cart__section--inner">
                        <div class="cart-restaurant mb-60">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart__table">
                                        <table class="cart__table--inner">
                                            <thead class="cart__table--header">
                                                <tr class="cart__table--header__items">
                                                    <th class="cart__table--header__list">Món ăn</th>
                                                    <th class="cart__table--header__list text-center">Số lượng</th>
                                                    <th class="cart__table--header__list text-right">Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody class="cart__table--body">
                                                @php
                                                    $cart_details = \App\Model\CartDetail::leftJoin(
                                                        'dishes',
                                                        'dishes.id',
                                                        'cart_details.dish_id',
                                                    )
                                                        ->select(
                                                            'cart_details.*',
                                                            'dishes.id as dish_id',
                                                            'dishes.name_link as name_link',
                                                            'dishes.name as dish_name',
                                                            'dishes.price as dish_price',
                                                            'dishes.image as dish_image',
                                                        )
                                                        ->where('cart_details.order_id', $cart->order_id)
                                                        ->get();
                                                    $sum_total_restaurant = 0;
                                                @endphp
                                                @foreach ($cart_details as $cart_detail)
                                                    <tr
                                                        class="cart__table--body__items cart__table--body__items-{{ $cart_detail->id }}">
                                                        <input type="hidden" class="cart_detail_id"
                                                            value="{{ $cart_detail->id }}">
                                                        <td class="cart__table--body__list">
                                                            <div class="cart__product d-flex align-items-center">
                                                                <div class="cart__thumbnail">
                                                                    <a
                                                                        href="{{ route('dishs.show', ['id' => $cart_detail->dish_id, 'name_link' => $cart_detail->name_link]) }}">
                                                                        <img class="border-radius-5"
                                                                            src="{{ asset($cart_detail->dish_image) }}"
                                                                            alt="cart-product">
                                                                    </a>
                                                                </div>
                                                                <div class="cart__content">
                                                                    <h3 class="cart__content--title h4"><a
                                                                            href="{{ route('dishs.show', ['id' => $cart_detail->dish_id, 'name_link' => $cart_detail->name_link]) }}">{{ $cart_detail->dish_name }}</a>
                                                                    </h3>
                                                                    <span class="cart__content--variant">Giá: <span
                                                                            class="cart__price">{{ number_format($cart_detail->dish_price) }}
                                                                            VND</span></span>
                                                                    <input type="hidden" class="value_price"
                                                                        value="{{ $cart_detail->dish_price }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cart__table--body__list text-center">
                                                            <div class="">
                                                                {{ $cart_detail->quantity }}
                                                            </div>
                                                        </td>
                                                        <td class="cart__table--body__list text-right">
                                                            <span
                                                                class="cart__price end">{{ number_format($cart_detail->dish_price * $cart_detail->quantity) }}
                                                                VND</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $sum_total_restaurant += $cart_detail->dish_price * $cart_detail->quantity
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td rowspan="3">
                                                        <div id="paypal-button-container"></div>
                                                    </td>
                                                    <td class="text-center cart__price">TỔNG</td>
                                                    <td class="text-right cart__price sum_total_restaurant">
                                                        {{ number_format($sum_total_restaurant) }} VND</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center cart__price">VẬN CHUYỂN</td>
                                                    <td class="text-right cart__price shipping" data-price="30000">+ 30.000
                                                        VND</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center cart__price">THÀNH TIỀN</td>
                                                    <input type="hidden" class="total_money"
                                                        value="{{ $sum_total_restaurant + 30000 }}">
                                                    <td class="text-right cart__price into-money">
                                                        {{ number_format($sum_total_restaurant + 30000) }} VND</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="order_id" value="{{ $cart->order_id }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tf-section wrap-category-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="tf-icon-box tf-icon-box-style02 padding-right61  wow fadeInUp  animated"
                        data-wow-delay="0.3ms" data-wow-duration="600ms"
                        style="visibility: visible; animation-duration: 600ms; animation-delay: 0.3ms; animation-name: fadeInUp;">
                        <div class="icon-wrap margin-bt-18">
                            <img src="{{ asset('frontend/assets/icon/iconlettece.png') }}" alt="images">
                        </div>
                        <h5 class="heading">
                            <a href="about.html">Fresh Food</a>
                        </h5>
                        <p class="sub-heading">
                            Quis suspen ultrices gravida Risus commodo viverra maecen
                        </p>
                        <div class="btn-icon-box">
                            <a class="color-style2" href="about.html"><i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tf-icon-box tf-icon-box-style02 padding-right19 wow fadeInUp  animated"
                        data-wow-delay="0.3ms" data-wow-duration="800ms"
                        style="visibility: visible; animation-duration: 800ms; animation-delay: 0.3ms; animation-name: fadeInUp;">
                        <div class="icon-wrap margin-bt-18">
                            <img src="{{ asset('frontend/assets/icon/icondelivery.png') }}" alt="images">
                        </div>
                        <h5 class="heading">
                            <a href="about.html">Home Delivery</a>
                        </h5>
                        <p class="sub-heading">
                            Quis suspen ultrices gravida Risus commodo viverra maecen
                        </p>
                        <div class="btn-icon-box">
                            <a class="color-style2" href="about.html"><i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tf-icon-box tf-icon-box-style02 padding-left21 wow fadeInUp  animated"
                        data-wow-delay="0.3ms" data-wow-duration="1000ms"
                        style="visibility: visible; animation-duration: 1000ms; animation-delay: 0.3ms; animation-name: fadeInUp;">
                        <div class="icon-wrap margin-bt-18">
                            <img src="{{ asset('frontend/assets/icon/iconmoney.png') }}" alt="images">
                        </div>
                        <h5 class="heading">
                            <a href="about.html">Low Costs</a>
                        </h5>
                        <p class="sub-heading">
                            Quis suspen ultrices gravida Risus commodo viverra maecen
                        </p>
                        <div class="btn-icon-box">
                            <a class="color-style2" href="about.html"><i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tf-icon-box tf-icon-box-style02 padding-left62 wow fadeInUp  animated"
                        data-wow-delay="0.3ms" data-wow-duration="1200ms"
                        style="visibility: visible; animation-duration: 1200ms; animation-delay: 0.3ms; animation-name: fadeInUp;">
                        <div class="icon-wrap margin-bt-18">
                            <img src="{{ asset('frontend/assets/icon/iconparty.png') }}" alt="images">
                        </div>
                        <h5 class="heading">
                            <a href="about.html">Event &amp; Party</a>
                        </h5>
                        <p class="sub-heading">
                            Quis suspen ultrices gravida Risus commodo viverra maecen
                        </p>
                        <div class="btn-icon-box">
                            <a class="color-style2" href="about.html"><i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('addjs')
    @include('order.script')
@stop
