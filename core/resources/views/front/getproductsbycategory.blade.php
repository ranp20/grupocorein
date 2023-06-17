@extends('master.front')
@section('title')
    {{__('Special offers')}}
@endsection
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
          <li class="separator"></li>
          <li><a href="{{route('front.specialoffer')}}">{{__('Special offers')}}</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@php
function renderStarRating($rating,$maxRating=5) {
  $fullStar = "<i class = 'far fa-star filled'></i>";
  $halfStar = "<i class = 'far fa-star-half filled'></i>";
  $emptyStar = "<i class = 'far fa-star'></i>";
  $rating = $rating <= $maxRating?$rating:$maxRating;

  $fullStarCount = (int)$rating;
  $halfStarCount = ceil($rating)-$fullStarCount;
  $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

  $html = str_repeat($fullStar,$fullStarCount);
  $html .= str_repeat($halfStar,$halfStarCount);
  $html .= str_repeat($emptyStar,$emptyStarCount);
  $html = $html;
  return $html;
}
@endphp
<div class="deal-of-day-section pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 class="h3">{{__('Special offers')}}</h2>
        </div>
      </div>
    </div>
    <div class="row g-3">
      @foreach ($specialoffer_items as $item)
      <div class="col-gd">
        <div class="product-card">
          <div class="product-thumb">
            @if ($item->stock != 0)
              @php
              $classValStock = '';
              if($item->is_type == 'feature'){
                $classValStock = 'bg-warning';
              }else if($item->is_type == 'new'){
                $classValStock = '';
              }else if($item->is_type == 'top'){
                $classValStock = 'bg-info';
              }else if($item->is_type == 'best'){
                $classValStock = 'bg-dark';
              }else if($item->is_type == 'flash_deal'){
                $classValStock = 'bg-success';
              }else{
                $classValStock = '';
              }
              @endphp
              <div class="product-badge {{$classValStock}}">
              {{ ($item->is_type != 'undefine') ? ucfirst(str_replace('_',' ',$item->is_type)) : '' }}
              </div>
            @else
              <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
            @endif
            @if($item->previous_price && $item->previous_price != 0)
              <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
            @endif
            <a href="{{route('front.product',$item->slug)}}"> <img src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
            <div class="product-button-group">
              <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
              <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
              @include('includes.item_footer',['sitem' => $item])
            </div>
          </div>
          <div class="product-card-body">
            <div class="product-category">
              <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
            </div>
            <h3 class="product-title">
              <a href="{{route('front.product',$item->slug)}}">
              {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
              </a>
            </h3>
            <div class="rating-stars">
              {!! renderStarRating($item->reviews->avg('rating')) !!}
            </div>
            <h4 class="product-price">
            @if ($item->previous_price != 0)
            <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
            @endif
            {{PriceHelper::grandCurrencyPrice($item)}}
            </h4>
            <p><a href="https://api.whatsapp.com/send?phone=51{{$setting->footer_phone}}&text=Solicito información sobre: {{route('front.product',$item->slug)}}" target="_blank" ><img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" class="boton-as"></a></p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection