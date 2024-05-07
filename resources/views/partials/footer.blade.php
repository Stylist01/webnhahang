<!-- footer -->
<footer id="footer" class="footer-style01">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="site-logo-2" class="logo-footer">
          <a href="/"><img src="{{$company->logo}}" alt="images"></a>
        </div>
      </div>
      <div class="col-md-2">
        <div class="widget widget-link widget-footer">
          <h4 class="widget-title">Nhà hàng</h4>
          <ul class="widget-list">
            <li><a href="/">Trang chủ</a></li>
            <li><a href="/gioi-thieu">Giới thiệu</a></li>
            <li><a href="/mon-an">Món ăn</a></li>
            <li><a href="/tin-tuc">Tin tức</a></li>
            <li><a href="/lien-he">Liên hệ</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <div class="widget widget-link widget-Facilities widget-footer">
          <h4 class="widget-title">Chính sách</h4>
          <ul class="widget-list">
            @foreach($policies as $policy)
            <li><a href="/chinh-sach-{{$policy->id}}-{{$policy->name_link}}">{{$policy->name}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-4 no-pd-right">
        <div class="widget widget-link widget-contact widget-footer">
          <h4 class="widget-title">Liên hệ</h4>
          <ul class="widget-list">
            <li class="adress margin-right-1">Địa chỉ: {{$company->address}}</li>
            <li class="mail"><a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
            <li class="phone"><a href="tel:{{$company->phone}}">{{$company->phone}}</a></li>
            <li class="clock">Mở cửa: 08 am - 11 pm</li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 no-pd-left">
        <div class="widget widget-link widget-Newsletters widget-footer">
          <h4 class="widget-title">Bản đồ</h4>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.65718568529!2d105.78272751485471!3d21.046398585988875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb158a2305d%3A0x5c357d21c785ea3d!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyDEkGnhu4duIEzhu7Fj!5e0!3m2!1svi!2s!4v1642945872052!5m2!1svi!2s" width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
      <!-- scroll-top -->
      <div class="col-md-12">
        <div id="bottom" class="tf-bottom-inner">
          <div class="Copyright">
            <p>Copyright © 2024 {{$company->name}}. Designed by <a href="https://www.facebook.com/hieuvu0911/" target="_blank"> Vũ Trung Hiếu</a></p>
          </div>
          <ul class="widget widget_socials">
            <li><a href="#" class="active"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>