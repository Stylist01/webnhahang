@extends('layouts.app')

@section('title')
<title>Món ăn</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- page-title -->
<section class="page-title page-title-inner" style="background: url(https://images.foody.vn/BlogsContents/kimbaphoangtu.jpg) no-repeat center center; background-size: cover;">
  <div class="overlay-pagetitle"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="page-title-heading">
        <h2 class="heading">Món ăn</h2>
      </div>
      <div class="breadcrumbs">
        <ul>
          <li><a href="/">Trang chủ</a></li>
          <li>Món ăn</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- page-title -->

<!-- flat-tabs -->
<section class="tf-section tf-blog tf-blog-style2">
  <div class="container-fluid">
    <div class="row">
      @foreach($categories as $category)
      <div class="col-md-12 cleafix">
        <div class="content-heading-wrap">
          <div class="tf-heading-bg cleafix">
            <h2 class="heading-bg-style02">Món ăn</h2>
          </div>
          <div class="tf-heading text-center">
            <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">{{$category->name}}</h4>
            <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="swiper-container carousel-5">
          <div class="swiper-wrapper">
            @foreach($dishs as $dish)
            @if($dish->category_id==$category->id)
            <div class="swiper-slide">
              <div class="slider-item ">
                <div class="post post2 wow fadeIn animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                  <div class="featured-post">
                    <img src="{{$dish->image}}" alt="images">
                  </div>
                  <div class="content-post">
                    <div class="date-style2">
                      <span>Giá: {{number_format($dish->price, 0, ',', '.')}} đ</span>
                    </div>
                    <div class="meta-post">
                      <div class="author-style2 flex">
                        <a href="/mon-an/{{$dish->id}}-{{$dish->name_link}}" class="name">Loại: {{$category->name}}</a>
                      </div>
                    </div>
                    <h5 class="title">
                      <a href="/mon-an/{{$dish->id}}-{{$dish->name_link}}">
                        {{$dish->name}}
                      </a>
                    </h5>
                    <div class="btn-blog flat-button">
                      <a href="/mon-an/{{$dish->id}}-{{$dish->name_link}}" class="tf-button color-style3">Chi tiết</a>
                    </div>
                  </div>
                </div>
              </div><!-- item-->
            </div>
            @endif
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- flat-tabs -->

<section class="tf-section counter-chefs-about">
  <div class="overlay-inner"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="wrap-counter wow fadeInUp animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
        <div class="col-box col-25">
          <div class="box box-countter-chefs text-center padding-right-121">
            <div class="wrap-icon">
              <i class="flaticon-chef"></i>
            </div>
            <div class="countter-box margin-top-3">
              <h6 class="heading">Tổng số lượng món ăn</h6>
              <span class="number" data-from="0" data-to="{{$dish_category[0]->value + $dish_category[1]->value + $dish_category[2]->value}}" data-speed="2500" data-inviewport="yes">{{$dish_category[0]->value + $dish_category[1]->value + $dish_category[2]->value}}</span>
            </div>
          </div>
        </div>
        <div class="col-box col-25">
          <div class="box box-countter-chefs text-center padding-right-73">
            <div class="wrap-icon">
              <i class="flaticon-fast-food"></i>
            </div>
            <div class="countter-box">
              <h6 class="heading">{{$dish_category[1]->category_name}}</h6>
              <span class="number" data-from="0" data-to="{{$dish_category[1]->value}}" data-speed="2500" data-inviewport="yes">{{$dish_category[1]->value}}</span>
            </div>
          </div>
        </div>
        <div class="col-box col-25">
          <div class="box box-countter-chefs text-center padding-right-5">
            <div class="wrap-icon">
              <i class="flaticon-fork"></i>
            </div>
            <div class="countter-box">
              <h6 class="heading">{{$dish_category[0]->category_name}}</h6>
              <span class="number" data-from="0" data-to="{{$dish_category[0]->value}}" data-speed="2500" data-inviewport="yes">{{$dish_category[0]->value}}</span>
            </div>
          </div>
        </div>
        <div class="col-box col-25 no-pd-right">
          <div class="box box-countter-chefs text-center padding-left-106">
            <div class="wrap-icon">
              <i class="flaticon-pizza-1"></i>
            </div>
            <div class="countter-box">
              <h6 class="heading">{{$dish_category[2]->category_name}}</h6>
              <span class="number" data-from="0" data-to="{{$dish_category[2]->value}}" data-speed="2500" data-inviewport="yes">{{$dish_category[2]->value}}</span>
            </div>
          </div>
        </div>
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
            <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Một số hình ảnh của nhà hàng</h4>
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
<!-- Gallery -->
@endsection