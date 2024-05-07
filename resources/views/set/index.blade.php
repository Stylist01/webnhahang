@extends('layouts.app')

@section('title')
<title>Đặt bàn</title>
@endsection

@section('content')
<!-- page-title -->
<!-- page-title -->
<section class="page-title page-title-inner">
    <div class="overlay-pagetitle"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="page-title-heading">
                <h2 class="heading">Đặt bàn</h2>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li>Đặt bàn</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- page-title -->

<!-- about-us -->
<section class="tf-section wrap-reservation">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading-bg color-style1 cleafix">
                        <h2 class="heading-bg-style02 style3">Đặt bàn</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Đặt bàn trước cho chúng tôi</h4>
                        <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
                    </div>
                </div>
            </div>
            <div class="col-box col-30">
                <div class="image-reservation padding-top134">
                    <img src="https://toplist.vn/images/800px/mi-cay-seoul-nha-trang-490850.jpg" alt="images">
                </div>
            </div>
            <div class="col-box col-40">
                <div class="wrap-form-reservation wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1300ms">
                    <div class="form-reservation">
                        <div class="overlay"></div>
                        <?php if ($errors->any()) {
                            foreach ($errors->all() as $error) {
                                echo "<script>alert('" . $error . "')</script>";
                            }
                        } ?>
                        <form action="/dat-ban/store" method="POST" class="comment-form" novalidate="novalidate">
                            @csrf
                            <fieldset class="name">
                                <input type="text" id="name" placeholder="Đầy đủ tên của bạn" class="tb-my-input" name="name" tabindex="1" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="name">
                                <input type="number" id="quantily" placeholder="Số người" class="tb-my-input" name="quantily" tabindex="1" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="name">
                                <input type="date" id="date-booking" placeholder="Ngày" class="tb-my-input" name="date" tabindex="1" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="name">
                                <input type="time" id="time-booking" placeholder="Thời gian" class="tb-my-input" name="time" tabindex="1" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="phone-wrap">
                                <input type="text" id="phone" placeholder="Số điện thoại" class="tb-my-input" name="phone" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="message">
                                <input type="text" id="message" placeholder="Tin nhắn" class="tb-my-input" name="message" tabindex="1" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="btn-submit">
                                <button id="comment-reply" name="submit" class="tf-button-submit tf-button color-text color-style1" type="submit">
                                    Đặt bàn ngay
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-box col-30">
                <div class="image-reservation style2">
                    <img src="https://product.hstatic.net/200000078599/product/my_cay_bo_my_f359123b168f457d982c91572027a8cc_grande.jpg" alt="images">
                </div>
            </div>
            <div class="popup-thanks">
                <div class="popup-thanks-overlay"></div>
                <div class="popup-thanks-inner">
                    <div class="content-popup">
                        <i class="fas fa-heart"></i>
                        <p class="title">
                            Cảm ơn bạn đã đặt chỗ
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection