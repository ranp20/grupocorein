@php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total = 0;
  $qty = 0;
  $option_price = 0;
  $cartTotal = 0;
@endphp
<?php
  // echo "<pre>";
  // print_r($cart);
  // echo "</pre>";
  // exit();
?>
@if (Session::has('cart'))
  @foreach ($cart as $key => $item)
  @php
    $totalwithoutcoupon = 0;
    $totalwithcoupon = 0;
    $totalwithoutcoupon_prod = 0;
    $totalwithcoupon_prod = 0;
    $prod_qty = floatval($item['qty']);
    $prod_quantity_withoutcoupon = floatval($item['quantity_withoutcoupon']);
    $prodwithcouponassoc = $prod_qty - $prod_quantity_withoutcoupon;
    $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
    if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00){

      $namecouponbyid = DB::table('tbl_coupons')->where("id","=",$item['coupon_id'])->where("status","!=",0)->select('name', 'discount_percentage', 'time_end', 'status')->take(1)->get();
      if(count($namecouponbyid) != 0){
        $couponbyiddecode = json_decode($namecouponbyid, TRUE);
        $nameofcouponbyid = $couponbyiddecode[0]['name'];
        $discount_percentageofcouponbyid = floatval($couponbyiddecode[0]['discount_percentage']);
        $discount_percentage_format = $discount_percentageofcouponbyid;
        $expiresAtTimer = $couponbyiddecode[0]['time_end'];
        // ----------- Crear un objeto DateTime a partir de la fecha final...
        $currentDate = new DateTime();
        $expirationDate = DateTime::createFromFormat('Y-m-d H:i:s', $expiresAtTimer, new DateTimeZone('America/Lima'));
        // ----------- Asegurarse que la fecha es válida...
        if (!$expirationDate) {
          die('Invalid date format for countdown.');
        }
        // ----------- Obtener las fechas en milisegundos...
        $millisecondsCurrentDate = $currentDate->getTimestamp() * 1000;
        $millisecondsExpirationDate = $expirationDate->getTimestamp() * 1000;
        // ----------- Calcular el tiempo restante...
        $remainingTime = max(0, $millisecondsExpirationDate - $millisecondsCurrentDate);
        if($remainingTime <= 0){
          $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
        }else{
          $totalwithoutcoupon += ($item['price'] + $total + $attribute_price) * $prod_quantity_withoutcoupon;
          $totalwithcoupon += ($item['coupon_price'] + $total + $attribute_price) * $prodwithcouponassoc;
          $cartTotal += $totalwithoutcoupon + $totalwithcoupon; 
        }
      }else{
        $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
      }
    }else{
      $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
    }
  @endphp
  <div class="entry">
    <div class="entry-thumb">
      @php
        $pathProductCartPhoto = 'assets/images/items/'.$item['photo'];
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
      <h4 class="entry-title">
        <a href="{{route('front.product',$item['slug'])}}">{{ strlen(strip_tags($item['name'])) > 15 ? substr(strip_tags($item['name']), 0, 15) . '...' : strip_tags($item['name']) }}</a>
      </h4>
      
      @if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00)
        @if(count($namecouponbyid) != 0)
          @if($remainingTime <= 0)
            <span class="entry-meta">{{$item['qty']}} x {{PriceHelper::setCurrencyPrice($item['price'])}}</span>
          @else
            <span class="entry-meta">{{$item['qty']}} x {{PriceHelper::setCurrencyPrice($item['coupon_price'])}}</span>
          @endif
        @else
          <span class="entry-meta">{{$item['qty']}} x {{PriceHelper::setCurrencyPrice($item['price'])}}</span>
        @endif
      @else
        <span class="entry-meta">{{$item['qty']}} x {{PriceHelper::setCurrencyPrice($item['price'])}}</span>
      @endif


      @if(isset($item['attribute']['option_name']) && !empty($item['attribute']['option_name']))
        @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
          <span class="att"><em>{{$item['attribute']['names'][$optionkey]}}:</em> {{$option_name}} ({{PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey])}})</span>
        @endforeach
      @endif
      @if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00)
        @if(count($namecouponbyid) != 0)
          @if($remainingTime <= 0)
          @else
            <span class="product-withcoupon">
              {{--
              <!-- <small>Con cupón: <strong>{{ $nameofcouponbyid }}</strong></small> -->
              --}}
              <small>CUPÓN: <strong>{{ $discount_percentage_format }} %</strong></small>
            </span>
          @endif
        @endif
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