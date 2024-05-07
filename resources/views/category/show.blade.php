@section('category_item')
@foreach($products as $product)
@if($product->category_id==$id)
<div class="our-menu-box">
  <div class="our-menu-item-style3 flex active">
    <div class="image">
      <img class="image-inner" src="{{$base_url.$product->image}}" alt="images">
    </div>
    <div class="content-menu-item">
      <h4 class="heading">{{$product->name}}</h4>
      <div class="sub-heading">Loại: {{optional($product->category)->name}}</div>
      <div class="pricing">
        {{number_format($product->price, 0, ',', '.')}} đ
      </div>
    </div>
  </div>
</div>
@endif
@endforeach
@endsection