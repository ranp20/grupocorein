@php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total =0;
  $option_price = 0;
  $cartTotal = 0;
@endphp
<?php
  // echo "<pre>";
  // print_r($cart);
  // echo "</pre>";
  // exit();
?>
<link rel="stylesheet" href="{{ asset('assets/front/js/plugins/sweetalert2/sweetalert2.min.css')}}">
<script type="text/javascript" src="{{ asset('assets/front/js/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<div class="row">
  <div class="col-xl-9 col-lg-8">
    <div class="card" id="cart-summarylist">
      <div class="card-body">
        <div class="table-responsive shopping-cart">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{__('Product')}}</th>
                <th class="text-center">{{__('Price')}}</th>
                <th class="text-center">{{__('Quantity')}}</th>
                <th class="text-center">{{__('Subtotal')}}</th>
                
                
                <th class="text-center">
                  <a class="btn btn-sm btn-primary remallwithoutic" href="{{route('front.cart.clear')}}"><span>{{__('Clear Cart')}}</span></a>
                </th>
                
              </tr>
            </thead>
            <tbody id="cart_view_load" data-target="{{route('cart.get.load')}}">
              @foreach ($cart as $key => $item)
              @php
                $totalwithoutcoupon = 0;
                $totalwithcoupon = 0;
                $totalwithoutcoupon_prod = 0;
                $totalwithcoupon_prod = 0;
                // ----------- CANTIDAD DE PRODUCTOS TOTAL...
                $prod_qty = floatval($item['qty']);
                // ----------- CANTIDAD DE PRODUCTOS SIN CUPÓN TOTAL...
                $prod_quantity_withoutcoupon = floatval($item['quantity_withoutcoupon']);
                // ----------- CANTIDAD DE PRODUCTOS CON CUPÓN...
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
                      $cartTotal += ($item['price'] + $total + $attribute_price) * $item['qty'];
                    }else{
                      $totalwithoutcoupon += ($item['price'] + $total + $attribute_price) * $prod_quantity_withoutcoupon;
                      $totalwithcoupon += ($item['coupon_price'] + $total + $attribute_price) * $prodwithcouponassoc;
                      $cartTotal += $totalwithoutcoupon + $totalwithcoupon;
                    }
                  }else{
                    $cartTotal += ($item['price'] + $total + $attribute_price) * $item['qty'];
                  }
                }else{
                  $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
                }
              @endphp
              <tr>
                <td>
                  <div class="product-item">
                    @php
                      $pathProductPhoto = 'assets/images/items/'.$item['photo'];
                      $pathProductPhotoDefault = 'assets/images/Utilities/default_product.png';
                    @endphp
                    @if(file_exists( $pathProductPhoto ))
                    <a class="product-thumb" href="{{route('front.product',$item['slug'])}}">
                      <img src="{{ asset($pathProductPhoto) }}" alt="Product">
                    </a>
                    @else
                    <div class="product-thumb">
                      <img src="{{ asset($pathProductPhotoDefault) }}" alt="ProductDefault">
                    </div>
                    @endif
                    <div class="product-info">
                      <h4 class="product-title">
                        <a href="{{route('front.product',$item['slug'])}}">{{ strlen(strip_tags($item['name'])) > 45 ? substr(strip_tags($item['name']), 0, 45) . '...' : strip_tags($item['name']) }}</a>
                      </h4>
                      <p class="product-sku">SKU: {{ strlen(strip_tags($item['sku'])) > 45 ? substr(strip_tags($item['sku']), 0, 45) . '...' : strip_tags($item['sku']) }}</p>
                      @if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name']))
                        @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                          <span><em>{{$item['attribute']['names'][$optionkey]}}:</em> {{$option_name}} ({{PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey])}})</span>
                        @endforeach
                      @endif
                      @if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00)
                        @if(count($namecouponbyid) != 0)
                          @if($remainingTime <= 0)
                          @else
                            <span class="product-withcoupon mt-05rm">
                              {{--
                              <!-- <small>Con cupón: <strong>{{ $nameofcouponbyid }}</strong></small> -->
                              --}}
                              <small>Descuento por CUPÓN: <strong>{{ $discount_percentage_format }} %</strong></small>
                            </span> 
                          @endif
                        @endif
                      @endif
                    </div>
                  </div>
                </td>
                @if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00)
                  @if(count($namecouponbyid) != 0)
                    @if($remainingTime <= 0)
                      <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['price'])}}</td>
                    @else
                      <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['coupon_price'])}}</td>
                    @endif
                  @else
                    <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['price'])}}</td>
                  @endif
                @else
                  <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['price'])}}</td>
                @endif
                <td class="text-center d-flex align-items-center justify-content-center border border-0">
                  @if ($item['item_type'] != 'digital')
                  <div class="qtySelector product-quantity pt-3">
                    <span class="decreaseQtycart cartsubclick" data-id="{{$key}}" data-target="{{PriceHelper::GetItemId($key)}}"><i class="fas fa-minus"></i></span>
                    <input type="text" disabled class="qtyValue cartcart-amount" value="{{$item['qty']}}">
                    <span class="increaseQtycart cartaddclick" data-id="{{$key}}" data-target="{{PriceHelper::GetItemId($key)}}"><i class="fas fa-plus"></i></span>
                    <input type="hidden" value="3333" id="current_stock">
                  </div>
                  @endif
                </td>
                @if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00)
                  @if(count($namecouponbyid) != 0)
                    @php
                      $totalwithoutcoupon_prod += ($item['price'] + $total + $attribute_price) * $prod_quantity_withoutcoupon;
                      $totalwithcoupon_prod += ($item['coupon_price'] + $total + $attribute_price) * $prodwithcouponassoc;
                      $cartTotal_prod = $totalwithoutcoupon_prod + $totalwithcoupon_prod;
                    @endphp
                    @if($remainingTime <= 0)
                      <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['price'] * $item['qty'])}}</td>
                    @else
                      <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($cartTotal_prod)}}</td>
                    @endif
                  @else
                    <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['price'] * $item['qty'])}}</td>
                  @endif
                @else
                  <td class="text-center text-lg text-bold">{{PriceHelper::setCurrencyPrice($item['price'] * $item['qty'])}}</td>
                @endif
                <td class="text-center">
                  {{--
                  <!--
                  <a class="remove-from-cart" href="{{route('front.cart.destroy',$key)}}" data-toggle="tooltip" title="{{ __('Remove product') }}">
                    <i class="icon-trash-2"></i>
                  </a>
                  -->
                  --}}
                  
                  <a class="remove-from-cart remwithsvg" href="{{route('front.cart.destroy',$key)}}" data-toggle="tooltip" title="{{ __('Remove product') }}">
                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:#000000;enable-background:accumulate;" d="m 50.09375,960.36218 c -3.70444,0 -6.42535,1.46 -8.28125,2.875 -1.8559,1.4148 -3.00288,2.5729 -4.9375,3.3437 -0.84766,0.2754 -1.55651,0.9489 -1.875,1.7813 l -18,0 0,6 66,0 0,-6 -18,0 c -0.31849,-0.8324 -1.02734,-1.5059 -1.875,-1.7813 -1.95325,-0.7762 -3.16919,-1.9466 -5,-3.3437 -1.83081,-1.3974 -4.47569,-2.875 -8.03125,-2.875 z m 0,6 c 2.20588,0.1249 3.45313,0.9328 4.84375,2 l -9.9375,0 c 1.75487,-1.3503 3.59004,-1.986 5.09375,-2 z m -30.09375,10 c 0,18.6771 0,37.35412 0,56.03122 0,3.4929 0.90933,6.6397 3.125,8.8438 2.21567,2.2038 5.38676,3.125 8.90625,3.125 l 36,0 c 3.48306,0 6.64414,-0.9212 8.84375,-3.125 2.19961,-2.204 3.125,-5.3509 3.125,-8.8438 0,-18.6771 0,-37.35412 0,-56.03122 -20.74916,0 -42.17916,0 -60,0 z m 6,6 48,0 0,50.03122 c 0,2.49 -0.58477,3.8332 -1.375,4.625 -0.79023,0.7918 -2.11755,1.3438 -4.59375,1.3438 l -36,0 c -2.52717,0 -3.86023,-0.5833 -4.65625,-1.375 -0.79602,-0.7919 -1.375,-2.1038 -1.375,-4.5938 z m 7,10 0,36.00002 6,0 0,-36.00002 z m 14,0 0,36.00002 6,0 0,-36.00002 z m 14,0 0,36.00002 6,0 0,-36.00002 z" fill="#f44336" fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></g></svg>
                  </a>
                  
                  
                  {{--
                  <!--
                  <a class="remove-from-cart remwithsvg" href="{{route('front.cart.deleteprodtocart')}}" data-toggle="tooltip" title="{{ __('Remove product') }}">
                    <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:#000000;enable-background:accumulate;" d="m 50.09375,960.36218 c -3.70444,0 -6.42535,1.46 -8.28125,2.875 -1.8559,1.4148 -3.00288,2.5729 -4.9375,3.3437 -0.84766,0.2754 -1.55651,0.9489 -1.875,1.7813 l -18,0 0,6 66,0 0,-6 -18,0 c -0.31849,-0.8324 -1.02734,-1.5059 -1.875,-1.7813 -1.95325,-0.7762 -3.16919,-1.9466 -5,-3.3437 -1.83081,-1.3974 -4.47569,-2.875 -8.03125,-2.875 z m 0,6 c 2.20588,0.1249 3.45313,0.9328 4.84375,2 l -9.9375,0 c 1.75487,-1.3503 3.59004,-1.986 5.09375,-2 z m -30.09375,10 c 0,18.6771 0,37.35412 0,56.03122 0,3.4929 0.90933,6.6397 3.125,8.8438 2.21567,2.2038 5.38676,3.125 8.90625,3.125 l 36,0 c 3.48306,0 6.64414,-0.9212 8.84375,-3.125 2.19961,-2.204 3.125,-5.3509 3.125,-8.8438 0,-18.6771 0,-37.35412 0,-56.03122 -20.74916,0 -42.17916,0 -60,0 z m 6,6 48,0 0,50.03122 c 0,2.49 -0.58477,3.8332 -1.375,4.625 -0.79023,0.7918 -2.11755,1.3438 -4.59375,1.3438 l -36,0 c -2.52717,0 -3.86023,-0.5833 -4.65625,-1.375 -0.79602,-0.7919 -1.375,-2.1038 -1.375,-4.5938 z m 7,10 0,36.00002 6,0 0,-36.00002 z m 14,0 0,36.00002 6,0 0,-36.00002 z m 14,0 0,36.00002 6,0 0,-36.00002 z" fill="#f44336" fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></g></svg>
                  </a>
                  -->
                  --}}

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-4">
    <div class="card mt-mob-t-tblt-4" id="cart-summaryorder">
      <div class="card-body">
        <div class="shopping-cart-top">
          <h3 class="widget-title">{{ __('Order Summary') }}</h3>
        </div>
        <div class="shopping-cart-footer">
          {{--
          <!--
          <div class="column">
            <form class="coupon-form" method="post" id="coupon_form" action="{{route('front.promo.submit')}}">
              @csrf
              <input class="form-control form-control-sm" name="code" type="text" placeholder="{{__('Coupon code')}}" required>
              <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Apply Coupon')}}</span></button>
            </form>
          </div>
          <div class="text-right text-lg column {{Session::has('coupon') ? '' : 'd-none'}}"><span class="text-muted">{{__('Discount')}} ({{Session::has('coupon') ? Session::get('coupon')['code']['title'] : ''}}) : </span><span class="text-gray-dark">{{PriceHelper::setCurrencyPrice(Session::has('coupon') ? Session::get('coupon')['discount'] : 0)}}</span></div>
          -->
          --}}
          {{--
          <!--
          <div class="text-right column text-lg">
            <span class="text-muted">{{__('Subtotal')}}: </span>
            <span class="txt-theme text-bold">{{PriceHelper::setCurrencyPrice($cartTotal)}}</span>
          </div>
          -->
          --}}
          <table class="cartdata infocarttotal w-100" id="dinfograndtotalcart">
            <tbody>
              <tr>
                <th class="text-left">{{__('Subtotal')}}: </th>
                <th class="text-bold text-right">{{PriceHelper::setCurrencyPrice($cartTotal)}}</th>
              </tr>
              <tr class="cartsumm_grandtotal">
                <th class="text-left">{{__('Grand Total')}}: </th>
                <th class="txt-theme text-bold text-right">{{PriceHelper::setCurrencyPrice($cartTotal)}}</th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="shopping-cart-footer">
          {{--  
          <!--
          <div class="column"><a class="btn btn-primary " href="{{route('front.catalog')}}"><span><i class="icon-arrow-left"></i> {{__('Back to Shopping')}}</span></a></div>
          -->
          --}}
          @if(Auth::check() && Auth::user()->role !== 'admin')
            @if(!empty(auth()->user()) || auth()->user() != "")
              @if(auth()->user()->reg_address1 != "" && auth()->user()->reg_address2 != "" && auth()->user()->reg_ruc != "off" && auth()->user()->reg_ruc != "" && auth()->user()->reg_razonsocial != "" && auth()->user()->reg_addressfiscal != "")
                <div class="column">
                  <a class="btn btn-primary d-flex align-items-center" data-role="nxt-checkoutinfo" href="{{route('front.checkout.payment')}}">
                    <span class="text-uppercase">{{__('Buy now')}}</span>
                    <span class="icon-arrrowight">
                      <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                    </span>
                  </a>
                </div>
              @else
                <div class="column">
                  <a class="btn btn-primary d-flex align-items-center" data-role="nxt-checkoutinfo" href="{{route('front.checkout.billing')}}">
                    <span class="text-uppercase">{{__('Buy now')}}</span>
                    <span class="icon-arrrowight">
                      <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                    </span>
                  </a>
                </div>
              @endif
            @endif
          @else
            <div class="column">
              <a class="btn btn-primary d-flex align-items-center" data-role="nxt-checkoutinfo" href="{{route('user.login')}}">
                <span class="text-uppercase">{{__('Buy now')}}</span>
                <span class="icon-arrrowight">
                  <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                </span>
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('assets/front/js/cart.js') }}"></script>