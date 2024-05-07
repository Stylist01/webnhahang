@extends('layouts.app')

@section('title')
<title>Trang chủ</title>
@endsection

@section('addcss')
<style>
  .test {
    color: blue;
  }
</style>
@endsection

@section('content')
<!-- page-title -->
<section class="page-title">
  <div class="slider">
    <div class="img-bg2">
      <img src="{{$company->logo}}" alt="">
    </div>
    <div class="swiper-container mainslider">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="slider-item">
            <div class="container-fluid">
              <div class="page-tittle-slider distance">
                <div class="heading-tittle">
                  <h1 class="title color-style4 margin-6 margin-bt30">Nhìn <br>Là<br>Thích
                  </h1>
                  <div class="flat-button">
                    <a href="/mon-an" class="tf-button color-text color-style2">Món ăn</a>
                  </div>
                </div>
                <div class="wrap-video">
                  <a href="https://www.youtube.com/watch?v=T_qC4I-LDPE" class="popup-youtube">
                    <i class="fas fa-play"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="slider-item">
            <div class="container-fluid">
              <div class="page-tittle-slider ">
                <div class="heading-tittle">
                  <h1 class="title color-style4 margin-6 margin-bt30">Chén <br>Là<br>Ngon
                  </h1>
                  <div class="flat-button">
                    <a href="/mon-an" class="tf-button color-text color-style2">Món ăn</a>
                  </div>
                </div>
                <div class="wrap-video">
                  <a href="https://www.youtube.com/watch?v=rktHbLCESTA" class="popup-youtube">
                    <i class="fas fa-play"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-button-next btn-slide-next"></div>
      <div class="swiper-button-prev btn-slide-prev active"></div>
    </div>
  </div>
</section>
<!-- page-title -->

<!-- best category -->
<section class="tf-section wrap-category">
  <div class="overlay-bg-style01"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg color-style1 cleafix">
            <h2 class="heading-bg-style">Menu</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 class="tf-title wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Menu món ăn</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
      <div class="flat-tabs">
        <ul class="menu-tab">
          @foreach($categories as $category)
          <li class="col-box col-16">
            <div class="tf-icon-box tf-iconbox-category wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="500ms">
              <div class="icon-wrap margin-bt-2">
                <img width="65px" src="{{$category->image}}" alt="image">
              </div>
              <h6 class="heading">
                {{$category->name}}
              </h6>
              <div class="btn-icon-box">
                <a class="color-style2" href="/mon-an"><i class="fal fa-arrow-right"></i></a>
              </div>
            </div>
          </li>
          @endforeach
          <li class="col-box col-16">
            <div class="tf-icon-box tf-iconbox-category wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1100ms">
              <div class="icon-wrap margin-bt-2">
                <i class="flaticon-chicken-leg"></i>
              </div>
              <h6 class="heading">
                Ăn
              </h6>
              <div class="btn-icon-box">
                <a class="color-style2" href="/mon-an"><i class="fal fa-arrow-right"></i></a>
              </div>
            </div>
          </li>
          <li class="col-box col-16">
            <div class="tf-icon-box tf-iconbox-category wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1300ms">
              <div class="icon-wrap margin-bt-2">
                <i class="flaticon-drink"></i>
              </div>
              <h6 class="heading">
                Là
              </h6>
              <div class="btn-icon-box">
                <a class="color-style2" href="/mon-an"><i class="fal fa-arrow-right"></i></a>
              </div>
            </div>
          </li>
          <li class="col-box col-16">
            <div class="tf-icon-box tf-iconbox-category wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
              <div class="icon-wrap margin-bt-2">
                <i class="flaticon-shrimp"></i>
              </div>
              <h6 class="heading">
                Thích
              </h6>
              <div class="btn-icon-box">
                <a class="color-style2" href="/mon-an"><i class="fal fa-arrow-right"></i></a>
              </div>
            </div>
          </li>
        </ul>
        <div class="content-tab style2">
          <div class="content-inner">
            <div class="wrap-img-food-inner flex">
              <div class="img-food-1">
                <img style="border-radius: 50%;" src="<?php echo $categories[1]['image'] ?>" alt="images">
              </div>
              <div class="img-food-2">
                <img class="img-style-bg" src="<?php echo $categories[0]['image'] ?>" alt="images">
              </div>
              <div class="img-food-3">
                <img style="border-radius: 50%;" src="<?php echo $categories[2]['image'] ?>" alt="images">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- best category -->

<!-- about-us -->
<section class="tf-section wrap-about-us">
  <img class="iconbg_about" src="{{$company->logo}}" width="155px" alt="images">
  <div class="container-fluid cleafix">
    <div class="row">
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg color-style1 cleafix">
            <h2 class="heading-bg-style">Giới thiệu</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 class="tf-title wow zoomIn animated test" data-wow-delay="0.3ms" data-wow-duration="1200ms">Tại sao chọn chúng tôi</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tf-img-about wow fadeIn animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
          <img src="frontend/assets/img/about-us/ab.png" alt="">
        </div>
      </div>
      <div class="col-md-6 no-pd-left">
        <div class="content-about-us">
          <p>{{$company->description}}</p>
          <div class="flat-button flat-button-style2">
            <a href="/gioi-thieu" class="tf-button color-style1">Xem thêm</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- about-us -->
<!-- our menu -->
<section class="tf-section wrap-our-menu">
  <div class="overlay-bg-style01"></div>
  <img class="imgbg1" src="frontend/assets/img/our-menu/untitled-session00798-6301.jpg" alt="images">
  <img class="imgbg2" src="frontend/assets/img/our-menu/tintuc2.jpg" alt="images">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg color-style1 cleafix">
            <h2 class="heading-bg-style">Menu</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 class="tf-title wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Hãy thử các món ăn chính</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        @foreach($dishs1 as $dish)
        <div class="our-menu-box mb">
          <div class="our-menu-item wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1300ms">
            <div class="content-menu-item">
              <h4 class="heading">{{$dish->name}}</h4>
              <div class="sub-heading">{{number_format($dish->price, 0, ',', '.')}} đ</div>
            </div>
            <div class="pricing-menu-item"><span><img src="{{$dish->image}}" alt="image" width="100px"></span></div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-md-6">
        @foreach($dishs2 as $dish)
        <div class="our-menu-box mb">
          <div class="our-menu-item wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1300ms">
            <div class="content-menu-item">
              <h4 class="heading">{{$dish->name}}</h4>
              <div class="sub-heading">{{number_format($dish->price, 0, ',', '.')}} đ</div>
            </div>
            <div class="pricing-menu-item"><span><img src="{{$dish->image}}" alt="image" width="100px"></span></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Gallery -->
<section class="tf-section wrap-gallery-our-menu">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg color-style1 cleafix">
            <h2 class="heading-bg-style02 magin-left-12">Hình ảnh</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 style="color: black;" class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Một số hình ảnh của nhà hàng</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
    </div>

    <section class="wrap-gallery-box-style02">
      <div class="container-fluid">
        <div class="swiper-container carousel-6">
          <div class="swiper-wrapper">
            @foreach($blogs as $blog)
            <div class="swiper-slide">
              <div class="gallery-box-style02 h-100">
                <div class="hover-effect h-100">
                  <div class="image h-100">
                    <img src="{{$blog->image}}" alt="">
                  </div>
                  <div class="content-box">
                    <div class="icon">
                      <a href="{{$blog->image}}" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  </div>
</section>

<!-- booking -->
<section class="tf-section wrap-booking">
  <img class="icon-style1" src="{{$company->logo}}" width="155px" alt="images">
  <img class="icon-style2" src="frontend/assets/img/booking/iconbg2.png" alt="images">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg cleafix">
            <h2 class="heading-bg-style ">Đặt bàn</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 class="tf-title wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Đặt bàn cho bạn và người thân</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
      <div class="col-md-12 cleafix">
        <div class="image-form-booking flex">
          <div class="image wow slideInLeft animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
            <img src="frontend/assets/img/booking/img01booking.jpg" alt="images">
          </div>
          <div class="wrap-form bg-style2 wow slideInRight animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
            <h5 class="heading color-style3 margin-bt-1">
              Đặt bàn online
            </h5>
            <div class="sub-heading color-style2 margin-bt30">
              Hãy điền thông tin...
            </div>
            <div class="form-reservation" style="padding: 0px 0px 0px 0px;">
              <div class="overlay"></div>
              <?php if ($errors->any()) {
                foreach ($errors->all() as $error) {
                  echo "<script>alert('" . $error . "')</script>";
                }
              } ?>
              <form action="/dat-ban/store" method="post" class="comment-form" novalidate="novalidate">
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

<!-- Blog -->
<section class="tf-section tf-blog">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg cleafix">
            <h2 class="heading-bg-style ">Tin tức</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 class="tf-title wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Tin tức mới</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="swiper-container carousel-3">
          <div class="swiper-wrapper">
            @foreach($posts as $post)
            <div class="swiper-slide">
              <div class="slider-item ">
                <div class="post wow fadeIn animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                  <div class="featured-post">
                    <img src="{{$post->image}}" alt="images">
                  </div>
                  <div class="content-post bg-blog">
                    <ul class="meta-post">
                      <li class="author"><a href="/tin-tuc/{{$post->id}}-{{$post->name_link}}">By Admin</a></li>
                      <li class="date"><a href="/tin-tuc/{{$post->id}}-{{$post->name_link}}">{{$post->updated_at}}</a></li>
                    </ul>
                    <h6 class="title">
                      <a href="/tin-tuc/{{$post->id}}-{{$post->name_link}}">
                        {{$post->name}}
                      </a>
                    </h6>
                    <div class="btn-blog">
                      <a href="/tin-tuc/{{$post->id}}-{{$post->name_link}}" class="tf-button color-style color-style4">Xem thêm</a>
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
@endsection