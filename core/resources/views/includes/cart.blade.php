@php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total =0;
  $option_price = 0;
  $cartTotal = 0;
@endphp
<?php
  /*
  echo "<pre>";
  print_r(Session::get('cart'));
  echo "<pre>";
  */
?>
<div class="row">
  <div class="col-xl-9 col-lg-8">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive shopping-cart">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{__('Product Name')}}</th>
                <th class="text-center">{{__('Price')}}</th>
                <th class="text-center">{{__('Quantity')}}</th>
                <th class="text-center">{{__('Subtotal')}}</th>
                <th class="text-center">
                  <a class="btn btn-sm btn-primary" href="{{route('front.cart.clear')}}"><span>{{__('Clear Cart')}}</span></a>
                </th>
              </tr>
            </thead>
            <tbody id="cart_view_load" data-target="{{route('cart.get.load')}}">
              @foreach ($cart as $key => $item)
              @php
                $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
                $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
              @endphp
              <tr>
                <td>
                  <div class="product-item">
                    @php
                      $pathProductPhoto = 'assets/images/'.$item['photo'];
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
                        <a href="{{route('front.product',$item['slug'])}}">
                        {{ strlen(strip_tags($item['name'])) > 45 ? substr(strip_tags($item['name']), 0, 45) . '...' : strip_tags($item['name']) }}
                        </a>
                      </h4>
                      @if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name']))
                      @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                      <span><em>{{$item['attribute']['names'][$optionkey]}}:</em> {{$option_name}} ({{PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey])}})</span>
                      @endforeach
                      @endif
                    </div>
                  </div>
                </td>
                <td class="text-center text-lg">{{PriceHelper::setCurrencyPrice($item['price'])}}</td>
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
                <td class="text-center text-lg">{{PriceHelper::setCurrencyPrice($item['price'] * $item['qty'])}}</td>
                <td class="text-center">
                  <a class="remove-from-cart" href="{{route('front.cart.destroy',$key)}}" data-toggle="tooltip" title="{{ __('Remove product') }}"><i class="icon-trash-2"></i>
                  </a>
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
    <div class="card mt-mob-t-tblt-4">
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
          <div class="text-right column text-lg">
            <span class="text-muted">{{__('Subtotal')}}: </span>
            <span class="text-gray-dark">{{PriceHelper::setCurrencyPrice($cartTotal - (Session::has('coupon') ? Session::get('coupon')['discount'] : 0))}}</span>
          </div>
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