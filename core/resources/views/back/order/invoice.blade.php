@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class=" mb-0">{{ __('Order Invoice') }} </h3>
        <div>
          <a class="btn btn-primary btn-sm" href="{{route('back.order.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
          <a class="btn btn-primary btn-sm" href="{{ route('back.order.print',$order->id) }}" target="_blank"><i class="fas fa-print"></i> {{ __('print') }}</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="asda_al-IIDASD88tokeN">
    @csrf
  </div>
  @php
    if($order->state){
      $state = json_decode($order->state,true);
    }else{
      $state = [];
    }
  @endphp
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">          
          <div class="row cCrd__cTitle">
            <div class="col-9 cCrd__cTitle__cL">
              <!-- <h3 class="pb-0 mb-0"><strong>Revise su orden :</strong></h3> -->
            </div>
            <div class="col-3 cCrd__cTitle__cR">
              <a class="btn btn-primary ms-auto text-align-center d-flex align-items-center justify-content-center" data-href="{{ route('back.order.pdforderpreview',$order->id) }}" href="javascript:void(0);" id="cTentr-af1698__1prevChckp" data-getsend="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <span>VISUALIZAR PEDIDO</span>
                <span>
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path d="M93.08,48.24C92.3,47.16,73.71,22,50,22S7.7,47.16,6.91,48.24a3,3,0,0,0,0,3.53C7.7,52.84,26.29,78,50,78S92.3,52.84,93.08,51.77A3,3,0,0,0,93.08,48.24ZM50,72C32.72,72,17.69,55.51,13.16,50,17.68,44.48,32.68,28,50,28S82.31,44.49,86.84,50C82.32,55.52,67.32,72,50,72Z"/><path d="M50,32.38A17.62,17.62,0,1,0,67.62,50,17.64,17.64,0,0,0,50,32.38Zm0,29.24A11.62,11.62,0,1,1,61.62,50,11.63,11.63,0,0,1,50,61.62Z"/></svg> -->
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path class="cls-1" d="M53.41,25.71c-21.72,0-34.75,23.21-34.75,23.21s13,23.21,34.75,23.21S88.15,48.92,88.15,48.92s-13-23.21-34.75-23.21Zm0,39.79C43.85,65.5,36,58,36,48.92s7.82-16.58,17.37-16.58S70.78,39.8,70.78,48.92,63,65.5,53.41,65.5ZM63.83,48.92c0,5.8-5.21,9.95-10.42,9.95C47.32,58.87,43,54.72,43,48.92A10.32,10.32,0,0,1,53.41,39c5.21,0,10.42,5,10.42,9.95"/></svg> -->
                  <!-- <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:#000000;enable-background:accumulate;" d="m 49.984299,979.36218 c -17.5445,0 -33.2155,8.4765 -43.5623983,21.75002 a 2.0000048,2.0000048 0 0 0 0,2.4688 c 10.3468983,13.2735 26.0178983,21.7812 43.5623983,21.7812 17.5352,0 33.2371,-8.5085 43.5938,-21.7812 a 2.0000048,2.0000048 0 0 0 0,-2.4688 c -10.3567,-13.27272 -26.0586,-21.75002 -43.5938,-21.75002 z m -3,4.7188 c 10.4004,0 18.7813,8.2218 18.7813,18.37502 0,10.1531 -8.3809,18.375 -18.7813,18.375 -10.4003,0 -18.75,-8.2219 -18.75,-18.375 0,-10.15322 8.3497,-18.37502 18.75,-18.37502 z" fill-opacity="1" fill-rule="evenodd" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/><path d="m 46.996499,993.65468 c -4.8806,0 -8.9181,3.9418 -8.9181,8.79282 0,4.8586 4.0413,8.7928 8.9181,8.7928 4.8768,0 8.9182,-3.9342 8.9182,-8.7928 0,-4.85102 -4.0376,-8.79282 -8.9182,-8.79282 z" style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;enable-background:accumulate;" fill-opacity="1" fill-rule="evenodd" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></g></svg> -->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" viewBox="0 0 100 125" version="1.1" x="0px" y="0px"><g fill-rule="evenodd"><g><g><path d="M50,79 C25.147185,79 5.58444147,50.8058934 5.58444147,50.8058934 C5.2620127,50.3666672 5.26166336,49.6391892 5.58444147,49.1941066 C5.58444147,49.1941066 25.147185,21 50,21 C74.852815,21 94.4155585,49.1941066 94.4155585,49.1941066 C94.7379873,49.6333328 94.7383366,50.3608108 94.4155585,50.8058934 C94.4155585,50.8058934 74.852815,79 50,79 Z M50,67.4 C59.3198056,67.4 66.875,59.6097551 66.875,50 C66.875,40.3902449 59.3198056,32.6 50,32.6 C40.6801944,32.6 33.125,40.3902449 33.125,50 C33.125,59.6097551 40.6801944,67.4 50,67.4 Z M50,67.4"></path><path d="M50,55.8 C53.1066019,55.8 55.625,53.2032517 55.625,50 C55.625,46.7967483 53.1066019,44.2 50,44.2 C46.8933981,44.2 44.375,46.7967483 44.375,50 C44.375,53.2032517 46.8933981,55.8 50,55.8 Z M50,55.8"></path></g></g></g></svg>
                </span>
              </a>
            </div>
          </div>          
          <div class="row">
            <div class="col text-center">
              <img class="img-fluid mb-5 mh-70" width="180" alt="Logo" src="{{asset('assets/images/'.$setting->logo)}}">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <h5><b>{{__('Order Details')}} :</b></h5>
              <span class="text-muted">{{__('Transaction Id')}} :</span>{{$order->txnid}}<br>
              <span class="text-muted">{{__('Order Id')}} :</span>{{$order->transaction_number}}<br>
              <span class="text-muted">{{__('Order Date')}} :</span>{{$order->created_at->format('M d, Y')}}<br>
              <span class="text-muted">{{__('Payment Status')}} :</span>
              @if($order->payment_status == 'Paid')
              <div class="badge badge-success">
                {{__('Paid')}}
              </div>
              @else
              <div class="badge badge-danger">
                {{__('Unpaid')}}
              </div>
              @endif
              <br>
              <span class="text-muted">{{__('Payment Method')}} :</span>{{$order->payment_method }}<br>
              <br>
              <br>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-6">
              <h5>{{__('Billing Address')}} :</h5>
              @php
                $bill = json_decode($order->billing_info,true);
              @endphp
              <span class="text-muted">{{__('Name')}}: </span>{{$bill['bill_first_name']}} {{$bill['bill_last_name']}}<br>
              <span class="text-muted">{{__('Email')}}: </span>{{$bill['bill_email']}}<br>
              <span class="text-muted">{{__('Phone')}}: </span>{{$bill['bill_phone']}}<br>
              @if (isset($bill['bill_address1']))
              <span class="text-muted">{{__('Address')}}: </span>{{$bill['bill_address1']}}, {{isset($bill['bill_address2']) ? $bill['bill_address2'] : ''}}<br>
              @endif
              @if (isset($bill['bill_country']))
              <span class="text-muted">{{__('Country')}}: </span>{{$bill['bill_country']}}<br>
              @endif
              @if (isset($bill['bill_city']))
              <span class="text-muted">{{__('City')}}: </span>{{$bill['bill_city']}}<br>
              @endif
              @if (isset($state['name']))
              <span class="text-muted">{{__('State')}}: </span>{{$state['name']}}<br>
              @endif
              @if (isset($bill['bill_zip']))
              <span class="text-muted">{{__('Zip')}}: </span>{{$bill['bill_zip']}}<br>
              @endif
              @if (isset($bill['bill_company']))
              <span class="text-muted">{{__('Company')}}: </span>{{$bill['bill_company']}}<br>
              @endif
            </div>
            <div class="col-12 col-md-6">
              <h5>{{__('Shipping Address')}} :</h5>
              @php
                $ship = json_decode($order->shipping_info,true)
              @endphp
              <span class="text-muted">{{__('Name')}}: </span>{{$ship['ship_first_name']}} {{$ship['ship_last_name']}} <br>
              @if(isset($ship['ship_email']))
              <span class="text-muted">{{__('Email')}}: </span>{{$ship['ship_email']}}<br>
              @endif
              <span class="text-muted">{{__('Phone')}}: </span>{{$ship['ship_phone']}}<br>
              @if (isset($ship['ship_address1']))
              <span class="text-muted">{{__('Address')}}: </span>{{$ship['ship_address1']}}, {{isset($ship['ship_address2']) ? $ship['ship_address2'] : ''}}<br>
              @endif
              @if (isset($ship['ship_country']))
              <span class="text-muted">{{__('Country')}}: </span>{{$ship['ship_country']}}<br>
              @endif
              @if (isset($ship['ship_city']))
              <span class="text-muted">{{__('City')}}: </span>{{$ship['ship_city']}}<br>
              @endif
              @if (isset($state['name']))
              <span class="text-muted">{{__('State')}}: </span>{{$state['name']}}<br>
              @endif
              @if (isset($ship['ship_zip']))
              <span class="text-muted">{{__('Postal Code')}}: </span>{{$ship['ship_zip']}}<br>
              @endif
              @if (isset($ship['ship_company']))
              <span class="text-muted">{{__('Company')}}: </span>{{$ship['ship_company']}}<br>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="gd-responsive-table">
                <table class="table my-4">
                <thead>
                  <tr>
                    <th width="50%" class="px-0 bg-transparent border-top-0"><span class="h6">{{__('Products')}}</span></th>
                    {{--
                    <!--
                    <th class="px-0 bg-transparent border-top-0"><span class="h6">{{__('Attribute')}}</span></th>
                    -->
                    --}}
                    <th class="px-0 bg-transparent border-top-0"><span class="h6">{{__('Quantity')}}</span></th>
                    <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6">{{__('Price')}}</span></th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $option_price = 0;
                    $total = 0;
                  @endphp
                  @foreach (json_decode($order->cart,true) as $item)
                  @php
                    $total += $item['main_price'] * $item['qty'];
                    if($item['attribute_price'] != "" && count($item['attribute_price']) > 0){
                      $option_price += $item['attribute_price'];
                    }
                    $grandSubtotal = $total + $option_price;
                  @endphp
                  <tr>
                    <td class="px-0">{{$item['name']}}</td>
                    {{--
                    <!--
                    <td class="px-0">
                      @if($item['attribute_price'] != "" && count($item['attribute_price']) > 0 && $item['attribute']['option_name'])
                        @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                        <span class="entry-meta"><b>{{$option_name}}</b> :
                          @if ($setting->currency_direction == 1)
                          {{$order->currency_sign}}{{round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2)}}
                          @else
                          {{round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2)}}{{$order->currency_sign}}
                          @endif
                        </span>
                        @endforeach
                        @else
                        --
                      @endif
                    </td>
                    -->
                    --}}
                    <td class="px-0">{{$item['qty']}}</td>
                    <td class="px-0 text-right">
                      @if ($setting->currency_direction == 1)
                        {{$order->currency_sign}}{{round($item['price']*$order->currency_value,2)}}
                      @else
                        {{round($item['price']*$order->currency_value,2)}}{{$order->currency_sign}}
                      @endif
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td class="padding-top-2x" colspan="5"></td>
                  </tr>
                  {{--
                  <!--
                  @if($order->tax!=0)
                  <tr>
                    <td class="px-0 border-top border-top-2">
                    <span class="text-muted">{{__('Tax')}}</span>
                    </td>
                    <td class="px-0 text-right border-top border-top-2" colspan="5">
                      <span>
                      @if ($setting->currency_direction == 1)
                        {{$order->currency_sign}}{{round($order->tax*$order->currency_value,2)}}
                      @else
                      {{round($order->tax*$order->currency_value,2)}}{{$order->currency_sign}}
                      @endif
                      </span>
                    </td>
                  </tr>
                  @endif
                  @if(json_decode($order->discount,true))
                  @php
                    $discount = json_decode($order->discount,true);
                  @endphp
                  <tr>
                    <td class="px-0 border-top border-top-2">
                    <span class="text-muted">{{__('Coupon discount')}} ({{$discount['code']['code_name']}})</span>
                    </td>
                    <td class="px-0 text-right border-top border-top-2" colspan="5">
                      <span class="text-danger">
                      @if ($setting->currency_direction == 1)
                        -{{$order->currency_sign}}{{round($discount['discount'] * $order->currency_value,2)}}
                      @else
                        -{{round($discount['discount'] * $order->currency_value,2)}}{{$order->currency_sign}}
                      @endif
                      </span>
                    </td>
                  </tr>
                  @endif
                  @if(json_decode($order->shipping,true))
                  @php
                    $shipping = json_decode($order->shipping,true);
                  @endphp
                  <tr>
                    <td class="px-0 border-top border-top-2">
                      <span class="text-muted">{{__('Shipping')}}</span>
                    </td>
                    <td class="px-0 text-right border-top border-top-2" colspan="5">
                      <span>
                      @if ($setting->currency_direction == 1)
                        {{$order->currency_sign}}{{round($shipping['price']*$order->currency_value,2)}}
                      @else
                        {{round($shipping['price']*$order->currency_value,2)}}{{$order->currency_sign}}
                      @endif
                      </span>
                    </td>
                  </tr>
                  @endif
                  @if(json_decode($order->state_price,true))
                  <tr>
                    <td class="px-0 border-top border-top-2"><span class="text-muted">{{__('State Tax')}}</span></td>
                    <td class="px-0 text-right border-top border-top-2" colspan="5">
                      <span >
                      @if ($setting->currency_direction == 1)
                      {{isset($state['type']) && $state['type'] == 'percentage' ?  ' ('.$state['price'].'%) ' : ''}}  {{$order->currency_sign}}{{round($order['state_price']*$order->currency_value,2)}}
                      @else
                      {{isset($state['type']) &&  $state['type'] == 'percentage' ?  ' ('.$state['price'].'%) ' : ''}}  {{round($order['state_price']*$order->currency_value,2)}}{{$order->currency_sign}}
                      @endif
                      </span>
                    </td>
                  </tr>
                  @endif
                  -->
                  --}}
                  <tr>
                    <td class="px-0 border-top border-top-2">
                    @if ($order->payment_method == 'Cash On Delivery')
                    <strong>{{__('Total amount')}}</strong>
                    @else
                    <strong>{{__('Total due')}}</strong>
                    @endif
                    </td>
                    <td class="px-0 text-right border-top border-top-2" colspan="5">
                      <span class="h3">
                        @if ($setting->currency_direction == 1)
                        {{$order->currency_sign}}{{PriceHelper::OrderTotal($order)}}
                        @else
                        {{PriceHelper::OrderTotal($order)}}{{$order->currency_sign}}
                        @endif
                      </span>
                    </td>
                  </tr>
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('assets/back/js/order-invoice.js') }}"></script>
@endsection