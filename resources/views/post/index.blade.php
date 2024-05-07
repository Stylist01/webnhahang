@extends('layouts.app')

@section('title')
<title>Tin tức</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<!-- page-title -->
<section class="page-title page-title-inner" style="background: url(https://themesflat.com/html/kababi/assets/img/page-title/imgbgpagetitleinner.jpg) no-repeat center center; background-size: cover;">
  <div class="overlay-pagetitle"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="page-title-heading">
        <h2 class="heading">Tin tức</h2>
      </div>
      <div class="breadcrumbs">
        <ul>
          <li><a href="/">Trang chủ</a></li>
          <li>Tin tức</li>
        </ul>
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
                      <a href="/tin-tuc/{{$post->id}}-{{$post->name_link}}" class="tf-button color-style color-style4">Chi tiết</a>
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
<!-- page-title -->
@endsection