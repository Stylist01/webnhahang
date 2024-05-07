@extends('layouts.app')

@section('title')
<title>Giới thiệu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- page-title -->
<section class="page-title page-title-inner">
    <div class="overlay-pagetitle"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="page-title-heading">
                <h2 class="heading">Giới thiệu</h2>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li>Giới thiệu</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- about-us -->
<section class="tf-section wrap-about-us-style4">
    <img class="iconbg_about style2" src="{{$company->logo}}" alt="images" width="155px">
    <div class="container-fluid cleafix">
        <div class="row">
            <div class="col-md-12 cleafix">
                <div class="content-heading-wrap">
                    <div class="tf-heading-bg color-style1 cleafix">
                        <h2 class="heading-bg-style02 style3">Giới thiệu</h2>
                    </div>
                    <div class="tf-heading text-center">
                        <h4 class="tf-title tf-title-style2 wow zoomIn animated" data-wow-delay="0.3ms" data-wow-duration="1200ms">Tại sao chọn chúng tôi</h4>
                        <p class="tf-sub-heading">Món ăn tốt nhất cho bạn và gia đình</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo $company['content']?>
            </div>
        </div>
    </div>
</section>
<!-- about-us -->
<!-- page-title -->
@endsection