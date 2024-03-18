@php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total = 0;
  $qty = 0;
  $option_price = 0;
  $cartTotal = 0;
@endphp
<?php
/*
echo "<pre>";
print_r(Session::get('cart'));
echo "</pre>";
exit();
*/
?>
@if (Session::has('cart'))
  @foreach ($cart as $key => $item)
  @php
    $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
    $cartTotal += ($item['price'] + $total + $attribute_price) * $item['qty'];
  @endphp
  <div class="entry">
    <div class="entry-thumb">
      @php
        $pathProductCartPhoto = 'assets/images/'.$item['photo'];
        $pathProductCartPhotoDefault = 'assets/images/Utilities/default_product.png';
      @endphp
      @if(file_exists( $pathProductCartPhoto ))
      <a href="{{route('front.product',$item['slug'])}}">
        <img src="{{ asset($pathProductCartPhoto) }}" alt="Product">
      </a>
      @else
      <div class="product-thumb">
        <img src="{{ asset($pathProductCartPhotoDefault) }}" alt="ProductDefault">
      </div>
      @endif
    </div>
    <div class="entry-content">
      <h4 class="entry-title"><a href="{{route('front.product',$item['slug'])}}">
        {{ strlen(strip_tags($item['name'])) > 15 ? substr(strip_tags($item['name']), 0, 15) . '...' : strip_tags($item['name']) }}
      </a></h4>
      <span class="entry-meta">{{$item['qty']}} x {{PriceHelper::setCurrencyPrice($item['price'])}}</span>
      @if(isset($item['attribute']['option_name']) && !empty($item['attribute']['option_name']))
      @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
      <span class="att"><em>{{$item['attribute']['names'][$optionkey]}}:</em> {{$option_name}} ({{PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey])}})</span>
      @endforeach
      @endif
    </div>
    <div class="entry-delete">
      <a href="{{route('front.cart.destroy',$key)}}"><i class="icon-x"></i></a>
    </div>
  </div>
  @endforeach
  <div class="text-right">
    <p class="text-gray-dark py-2 mb-0"><span class="text-muted">{{__('Subtotal')}}:</span> {{PriceHelper::setCurrencyPrice($cartTotal)}}</p>
  </div>
  <div class="d-flex justify-content-between">
    <div class="w-50 d-block">
      <a class="btn btn-primary btn-sm  mb-0" href="{{route('front.cart')}}">
        <span>{{__('Cart')}}</span>
      </a>
    </div>
    @if(!empty(auth()->user()) || auth()->user() != "")
      @if(auth()->user()->reg_ruc != "off" && auth()->user()->reg_ruc != "" && auth()->user()->reg_razonsocial != "" && auth()->user()->reg_addressfiscal != "")
        <div class="w-50 d-block text-end">
          <a class="btn btn-primary btn-sm  mb-0" href="{{route('front.checkout.payment')}}"><span>{{__('Checkout')}}</span></a>
        </div>
      @else
        <div class="w-50 d-block text-end">
          <a class="btn btn-primary btn-sm  mb-0" href="{{route('front.checkout.billing')}}"><span>{{__('Checkout')}}</span></a>
        </div>
      @endif
    @endif
  </div>
@else
  {{__('Cart empty')}}
@endif