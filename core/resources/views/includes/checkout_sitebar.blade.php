@php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total = 0;
  $qty = 0;
  $option_price = 0;
  $cartTotal = 0;
  $orderGrandTotal = 0;
@endphp
<div class="col-xl-3 col-lg-4">
  <aside class="sidebar">
    <div class="padding-top-2x hidden-lg-up"></div>
    <section class="card widget widget-featured-posts widget-order-summary p-4" id="crdLEvent__sd343fg-34Gas">
      <h3 class="widget-title">{{__('Order Summary')}}</h3>
      @php
      $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first()
      @endphp
      @if ($free_shipping)
        @if ($free_shipping->minimum_price >= $cart_total)
          <p class="free-shippin-aa"><em>Envío gratis a partir de {{PriceHelper::setCurrencyPrice($free_shipping->minimum_price)}}</em></p>
        @endif
      @endif
      @php
        $shipSessionInfo = "";
        $amountDeliveryTotal = 0;
        $amountGrandTotal = 0;
        if(Session::has('shipping_address') && Session::get('shipping_address') != ""){
          $shipSessionInfo = Session::get('shipping_address');
          $amountDeliveryTotal = $shipSessionInfo['ship_amountaddress'];
          $amountGrandTotal = $shipSessionInfo['grand_total'];
        }
      @endphp
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
        @endforeach
      @endif

      <div id="tblCrtReview-hd46_asdFHG54">
        <table class="table">
          <tr>
            <td>{{__('Subtotal')}}:</td>
            <td class="fw-bold spnLstCart__fz1 text-gray-dark">{{PriceHelper::setCurrencyPrice($cartTotal)}}</td>
          </tr>
          <tr>
            <td>Envío:</td>
            @if($amountDeliveryTotal != 0 && $amountDeliveryTotal != "")
            <td class="text-gray-dark">
              <div class="cInfAmmtCart">
                <div class="cInfAmmtCart__c">
                  <span class="fw-bold spnLstCart__fz1" id="cInfAmmtCart__c-346hg">{{ PriceHelper::setCurrencyPrice($amountDeliveryTotal) }}</span>
                </div>
              </div>
            </td>
            @else
            <td class="text-gray-dark">
              <div class="cInfAmmtCart">
                <div class="cInfAmmtCart__c">
                  <span class="fw-bold spnLstCart__fz1" id="cInfAmmtCart__c-346hg">{{ PriceHelper::setCurrencyPrice($amountaddress) }}</span>
                </div>
              </div>
            </td>
            @endif
          </tr>
          <tr>
            <td class="text-lg text-primary">{{__('Order total')}}</td>
            @if($amountDeliveryTotal != 0 && $amountDeliveryTotal != "")
              <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set">{{ PriceHelper::setCurrencyPrice($amountGrandTotal) }}</td>
            @else
              @if($amountaddress != 0 && $amountaddress != "")
                @php
                  $orderGrandTotal = $cartTotal + $amountaddress;
                @endphp
                <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set">{{ PriceHelper::setCurrencyPrice($orderGrandTotal) }}</td>
              @else
                <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set">{{ PriceHelper::setCurrencyPrice($cartTotal) }}</td>
              @endif
            @endif
          </tr>
        </table>
      </div>
    </section>
    <section class="card widget widget-featured-posts widget-featured-products p-4">
      <h3 class="widget-title">{{__('Items In Your Cart')}}</h3>
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
            $pathProductPhoto = 'assets/images/items/'.$item['photo'];
            $pathProductPhotoDefault = 'assets/images/Utilities/default_product.png';
          @endphp
          @if(file_exists( $pathProductPhoto ))
          <a href="{{route('front.product',$item['slug'])}}">
            <img src="{{ asset($pathProductPhoto) }}" alt="Product">
          </a>
          @else
          <div class="product-thumb" style="display: block;border-radius: 5px;overflow: hidden;">
            <img src="{{ asset($pathProductPhotoDefault) }}" alt="ProductDefault">
          </div>
          @endif
        </div>
        <div class="entry-content">
          <h4 class="entry-title">
            <a href="{{route('front.product',$item['slug'])}}">{{ strlen(strip_tags($item['name'])) > 45 ? substr(strip_tags($item['name']), 0, 45) . '...' : strip_tags($item['name']) }}</a>
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
          @if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name']))
            @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
            <span class="entry-meta"><b>{{$option_name}}</b> : {{PriceHelper::setCurrencySign()}}{{$item['attribute']['option_price'][$optionkey]}}</span>
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
      </div>
      @endforeach
    </section>
  </aside>
</div>