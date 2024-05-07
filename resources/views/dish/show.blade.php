@extends('layouts.app')

@section('title')
    <title>{{ $dish->name }}</title>
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title page-title-inner"
        style="background: url({{ $dish->image }}) no-repeat center center; background-size: cover;">
        <div class="overlay-pagetitle"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="page-title-heading">
                    <h2 class="heading">{{ $dish->name }}</h2>
                </div>
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="index.html">Trang chủ</a></li>
                        <li>Chi tiết món ăn</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- page-title -->

    <div class="tf-section dish-details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="image-details">
                        <div class="image wow fadeIn animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                            <img src="{{ $dish->image }}" alt="images" width="630px">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="details_content">
                        <h3 class="name-dish">{{ $dish->name }}</h3>
                        <p class="pricing">Giá: {{ number_format($dish->price, 0, ',', '.') }} đ</p>
                        <p class="text"><?php echo $dish->content; ?></p>
                        <form method="POST" action="{{ route('addCart') }}" class="product-actions style2 flex">
                            @csrf
                            <div class="quantity">
                                <span class="btn-quantity minus-btn"><i class="fas fa-caret-down"></i></span>
                                <input class="quantity__number" type="number" name="quantity" id="number" value="1">
                                <span class="btn-quantity plus-btn"><i class="fas fa-caret-up"></i></span>
                            </div>
                            <input type="hidden" name="dish_id" class="dish_id" value="{{ $dish->id }}">
                            <input type="hidden" name="customer_id" class="customer_id"
                                value="{{ Auth::guard('customer')->user() ? Auth::guard('customer')->user()->id : '' }}">
                            <button type="submit" class="quickview__cart--btn tf-button color-text color-style1">Thêm
                                vào giỏ hàng</button>
                        </form>
                        <div class="tag-category">
                            <ul class="category">
                                <li>Danh mục:</li>
                                <li><a href="/mon-an">{{ optional($dish->category)->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="comments" class="comments-area">
                        <div id="respond" class="comment-respond">
                            <h5 id="title">Liên hệ mua hàng tại đây</h5>
                            <?php if ($errors->any()) {
                                foreach ($errors->all() as $error) {
                                    echo "<script>alert('" . $error . "')</script>";
                                }
                            } ?>
                            <form action="/lien-he/store" method="post" class="comment-form comment-form-style2">
                                @csrf
                                <fieldset class="name active">
                                    <input type="text" id="name" placeholder="Tên đầy đủ" class="tb-my-input"
                                        name="name" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <fieldset class="phone">
                                    <input type="text" id="phone" placeholder="Số điện thoại" class="tb-my-input"
                                        name="phone" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <fieldset class="address">
                                    <input type="text" id="address" placeholder="Địa chỉ" class="tb-my-input"
                                        name="address" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <fieldset class="message">
                                    <textarea id="message" name="message" rows="4" placeholder="Tin nhắn" tabindex="4" aria-required="true"
                                        required=""></textarea>
                                </fieldset>
                                <div class="btn-submit flat-button flat-button-style2">
                                    <div class="btn-submit">
                                        <button id="comment-reply" name="submit" class="tf-button color-text color-style1"
                                            type="submit">
                                            Liên hệ
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- shop -->
    <section class="tf-section wrap-shop-details">
        <div class="container-fluid cleafix">
            <div class="row">
                <div class="col-md-12 cleafix">
                    <div class="content-heading-wrap">
                        <div class="tf-heading-bg color-style1 cleafix">
                            <h2 class="heading-bg-style02 style3">Món ăn</h2>
                        </div>
                        <div class="tf-heading text-center">
                            <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms"
                                data-wow-duration="1200ms">Món ăn liên quan</h4>
                            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="swiper-container carousel-5">
                        <div class="swiper-wrapper">
                            @foreach ($dishs as $dish)
                                <div class="swiper-slide">
                                    <div class="slider-item ">
                                        <div class="post post2 wow fadeIn animated" data-wow-delay="0.3ms"
                                            data-wow-duration="1500ms">
                                            <div class="featured-post">
                                                <img src="{{ $dish->image }}" alt="images">
                                            </div>
                                            <div class="content-post">
                                                <div class="date-style2">
                                                    <span>Giá: {{ number_format($dish->price, 0, ',', '.') }} đ</span>
                                                </div>
                                                <h5 class="title">
                                                    <a href="/mon-an/{{ $dish->id }}-{{ $dish->name_link }}">
                                                        {{ $dish->name }}
                                                    </a>
                                                </h5>
                                                <div class="btn-blog flat-button">
                                                    <a href="/mon-an/{{ $dish->id }}-{{ $dish->name_link }}"
                                                        class="tf-button color-style3">Chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- item-->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- shop -->
@endsection
