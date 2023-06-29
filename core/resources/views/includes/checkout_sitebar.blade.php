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
      <div id="tblCrtReview-hd46_asdFHG54">
        <table class="table">
          <tr>
            <td>{{__('Subtotal')}}:</td>
            <td class="fw-bold spnLstCart__fz1 text-gray-dark">{{PriceHelper::setCurrencyPrice($cart_total)}}</td>
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
            <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set">{{ PriceHelper::setCurrencyPrice($grand_total) }}</td>
            @endif
          </tr>
        </table>
      </div>
    </section>
    <section class="card widget widget-featured-posts widget-featured-products p-4">
      <h3 class="widget-title">{{__('Items In Your Cart')}}</h3>
      @foreach ($cart as $key => $item)
      <div class="entry">
        <div class="entry-thumb"><a href="{{route('front.product',$item['slug'])}}"><img src="{{asset('assets/images/'.$item['photo'])}}" alt="Product"></a></div>
        <div class="entry-content">
          <h4 class="entry-title">
            <a href="{{route('front.product',$item['slug'])}}">{{ strlen(strip_tags($item['name'])) > 45 ? substr(strip_tags($item['name']), 0, 45) . '...' : strip_tags($item['name']) }}</a>
          </h4>
          <span class="entry-meta">{{$item['qty']}} x {{PriceHelper::setCurrencyPrice($item['main_price'])}}</span>
          @if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name']))
          @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
          <span class="entry-meta"><b>{{$option_name}}</b> : {{PriceHelper::setCurrencySign()}}{{$item['attribute']['option_price'][$optionkey]}}</span>
          @endforeach
          @endif
        </div>
      </div>
      @endforeach
    </section>
  </aside>
</div>