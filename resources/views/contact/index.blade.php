@extends('layouts.app')

@section('title')
<title>Liên hệ</title>
@endsection

@section('content')
<!-- page-title -->
<section class="page-title page-title-inner" style="background: url(https://oic.com.vn/wp-content/uploads/2021/03/banner_lien_he.png) no-repeat center center; background-size: cover;">
    <div class="overlay-pagetitle"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="page-title-heading">
                <h2 class="heading">Liên hệ</h2>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li>Liên hệ</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- page-title -->

<section class="tf-section contact-us">
    <div class="container-fluid">
        <div class="row">
            <div class="col-box col-45">
                <div class="infor-contact border-style2">
                    <h4 class="heading">{{$company->name}}</h4>
                    <div class="widget widget-info flex">
                        <div class="icon icon-afress">
                            <i class="icon-kababimap"></i>
                        </div>
                        <div class="infor-text">
                            <h6 class="title">Địa chỉ</h6>
                            <p>{{$company->address}}</p>
                        </div>
                    </div>
                    <div class="widget widget-info flex">
                        <div class="icon icon-mail">
                            <i class="icon-kababiemail"></i>
                        </div>
                        <div class="infor-text">
                            <h6 class="title">Email</h6>
                            <a style="color:black" href="mailto:{{$company->email}}">
                                <p>{{$company->email}}</p>
                            </a>
                        </div>
                    </div>
                    <div class="widget widget-info style2 flex">
                        <div class="icon icon-call">
                            <i class="icon-kababicall"></i>
                        </div>
                        <div class="infor-text">
                            <h6 class="title">Số điện thoại</h6>
                            <a style="color:black" href="tel:{{$company->phone}}">
                                <p>{{$company->phone}}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-box col-55">
                <div class="form-contact color-bg-style4">
                    <h4 class="heading">Liên hệ với chúng tôi</h4>
                    <div class="text">Chúng tôi luôn sẵn sàng</div>
                    <?php if ($errors->any()) {
                        foreach($errors->all() as $error){
                            echo "<script>alert('".$error."')</script>";
                        }
                    } ?>
                    <form action="/lien-he/store" method="POST" class="comment-form comment-form-style2 style2" novalidate="novalidate">
                        @csrf
                        <fieldset class="name">
                            <input type="text" id="name" placeholder="Full Name" class="tb-my-input" name="name" tabindex="2" value="{{old('name')}}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="phone">
                            <input type="text" id="phone" placeholder="Số điện thoại" class="tb-my-input" name="phone" tabindex="2" value="{{old('phone')}}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="address">
                            <input type="text" id="address" placeholder="Địa chỉ" class="tb-my-input" name="address" tabindex="2" value="{{old('address')}}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="message">
                            <textarea id="message" name="message" rows="5" placeholder="Tin nhắn" tabindex="4" aria-required="true" required="">{{old('message')}}</textarea>
                        </fieldset>
                        <div class="btn-submit flat-button flat-button-style2">
                            <button id="comment-reply" name="submit" class="tf-button color-style color-style1" type="submit">
                                Gửi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tf-section map">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-map">
                    <iframe class="map-content wow fadeInUp animated" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.65718568529!2d105.78272751485471!3d21.046398585988875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb158a2305d%3A0x5c357d21c785ea3d!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyDEkGnhu4duIEzhu7Fj!5e0!3m2!1svi!2s!4v1642945872052!5m2!1svi!2s" width="1720" height="655" style="border: 0px; visibility: visible; animation-name: fadeInUp;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection