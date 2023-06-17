@php
  $grandSubtotal = 0;
  $qty = 0;
  $option_price = 0;
@endphp
@if (Session::has('cart'))
@foreach (Session::get('cart') as $key => $cart)
@php
  $attribute_price = (isset($cart['attribute_price']) && !empty($cart['attribute_price'])) ? $cart['attribute_price'] : 0;
  $grandSubtotal = ($cart['main_price'] + $grandSubtotal + $attribute_price) * $cart['qty'];
@endphp
<div class="entry">
  <div class="entry-thumb">
    <a href="{{route('front.product',$cart['slug'])}}">
      <img src="{{asset('assets/images/'.$cart['photo'])}}" alt="Product">
    </a>
  </div>
  <div class="entry-content">
    <h4 class="entry-title"><a href="{{route('front.product',$cart['slug'])}}">
      {{ strlen(strip_tags($cart['name'])) > 15 ? substr(strip_tags($cart['name']), 0, 15) . '...' : strip_tags($cart['name']) }}
    </a></h4>
    <span class="entry-meta">{{$cart['qty']}} x {{PriceHelper::setCurrencyPrice($cart['main_price'])}}</span>
    @if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name']))
    @foreach ($cart['attribute']['option_name'] as $optionkey => $option_name)
    <span class="att"><em>{{$cart['attribute']['names'][$optionkey]}}:</em> {{$option_name}} ({{PriceHelper::setCurrencyPrice($cart['attribute']['option_price'][$optionkey])}})</span>
    @endforeach
    @endif
 </div>
  <div class="entry-delete">
    <a href="{{route('front.cart.destroy',$key)}}"><i class="icon-x"></i></a>
  </div>
</div>
@endforeach
<div class="text-right">
<p class="text-gray-dark py-2 mb-0"><span class="text-muted">{{__('Subtotal')}}:</span> {{PriceHelper::setCurrencyPrice($grandSubtotal)}}</p>
</div>
<div class="d-flex justify-content-between">
<div class="w-50 d-block"><a class="btn btn-primary btn-sm  mb-0" href="{{route('front.cart')}}"><span>{{__('Cart')}}</span></a></div>
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
@else
{{__('Cart empty')}}
@endif
</div>