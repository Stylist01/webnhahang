@extends('layouts.app')

@section('title')
<title>{{$post->name}}</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<section class="page-title page-title-inner" style="background: url({{$post->image}}) no-repeat center center; background-size: cover;">
    <div class="overlay-pagetitle"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="page-title-heading">
                <h2 class="heading">{{$post->name}}</h2>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li>Chi tiết tin tức</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- about-us -->
<section class="tf-section wrap-about-us-style4">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading-bg color-style1 cleafix">
                        <h2 class="heading-bg-style02 style3">Tin tức</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">{{$post->name}}</h4>
                        <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo $post['content'] ?>
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
                        <h2 class="heading-bg-style02">Tin tức</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Tin tức khác</h4>
                        <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="swiper-container carousel-5">
                    <div class="swiper-wrapper">
                        @foreach($posts as $item)
                        <div class="swiper-slide">
                            <div class="slider-item ">
                                <div class="post post2 wow fadeIn animated" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                                    <div class="featured-post">
                                        <img src="{{$item->image}}" alt="images">
                                    </div>
                                    <div class="content-post">
                                        <div class="date-style2">
                                            <span>{{$item->updated_at}}</span>
                                        </div>
                                        <div class="meta-post">
                                            <div class="author-style2 flex">
                                                <a href="/tin-tuc/{{$item->id}}-{{$item->name_link}}" class="name">By Admin</a>
                                            </div>
                                        </div>
                                        <h5 class="title">
                                            <a href="/tin-tuc/{{$item->id}}-{{$item->name_link}}">
                                                {{$item->name}}
                                            </a>
                                        </h5>
                                        <div class="btn-blog flat-button">
                                            <a href="/tin-tuc/{{$item->id}}-{{$item->name_link}}" class="tf-button color-style3">Chi tiết</a>
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