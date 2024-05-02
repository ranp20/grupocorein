<?php

require_once base_path() . '/vendor/autoload.php';
require_once base_path() . '/keys.php';
require_once base_path() . '/helpers.php';

function addTwoDecimals($number){
  $output_final = "";
  if($number != "0" || $number != 0){
    $output_num = explode(".", $number);
    if(!isset($output_num[1]) || $output_num[1] == "undefined" || $output_num[1] == ""){
      $output_final = number_format($number).".00";
    }else if(isset($output_num[1]) && strlen($output_num[1]) < 2){
      $output_final = number_format($output_num[0]).".".$output_num[1]."0";
    }else{
      $output_final = number_format($output_num[0]).".".$output_num[1];
    }
  }else{
    $output_final = $number;
  }
  return $output_final;
}

function formatPhone($phone){
	$output_phone = "";
  $output_phone = preg_replace('/(\d{1,3})(?=(\d{3})+$)/', '$1 ', $phone);
	return $output_phone;
}

function genCodeRandom(){
  $format = 'xxxxxxxxy';
  return preg_replace_callback('/[xy]/', function($match) {
    $pattern = '1234567890';
    if($match[0] === 'x'){
      return substr($pattern, mt_rand(0, strlen($pattern)), 1);
    }else{
      return substr(date('y'), -2);
    }
  }, "GRPCOREIN-".$format);
}

mt_srand(3);
$orderIdGenFirst = genCodeRandom();
?>
@extends('master.front')
@section('title')
  {{__('Payment')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="{{route('front.index')}}">{{ __('Home') }}</a> </li>
        <li class="separator"></li>
        <li>{{ __('Review your order and pay') }}</li>
      </ul>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1  checkut-page">
  <div class="row">
    <?php
      // echo "<pre>";
      // print_r(Session::get('cart'));
      // echo "</pre>";
    ?>
    <div class="col-xl-9 col-lg-8">
      <div class="steps flex-sm-nowrap mb-2">
        <a class="step" href="{{route('front.checkout.billing')}}">
          <h4 class="step-title"><i class="icon-check-circle"></i>1. Datos:</h4>
        </a>
        <a class="step" href="{{route('front.checkout.shipping')}}">
          <h4 class="step-title"><i class="icon-check-circle"></i>2. Envío:</h4>
        </a>
        <a class="step active" href="{{route('front.checkout.payment')}}">
          <h4 class="step-title">3. {{__('Review and pay')}}</h4>
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="row cCrd__cTitle">
            <div class="col-9 cCrd__cTitle__cL">
              <h6 class="pb-0 mb-0">{{__('Review Your Order')}} :</h6>
            </div>
            <div class="col-3 cCrd__cTitle__cR">
              <a class="btn btn-primary ms-auto text-align-center d-flex align-items-end justify-content-center" data-href="{{route('front.checkout.pdforderpreview')}}" href="javascript:void(0);" id="cTentr-af1698__1prevChckp"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <span>VISUALIZAR PEDIDO</span>
                <span>
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path d="M93.08,48.24C92.3,47.16,73.71,22,50,22S7.7,47.16,6.91,48.24a3,3,0,0,0,0,3.53C7.7,52.84,26.29,78,50,78S92.3,52.84,93.08,51.77A3,3,0,0,0,93.08,48.24ZM50,72C32.72,72,17.69,55.51,13.16,50,17.68,44.48,32.68,28,50,28S82.31,44.49,86.84,50C82.32,55.52,67.32,72,50,72Z"/><path d="M50,32.38A17.62,17.62,0,1,0,67.62,50,17.64,17.64,0,0,0,50,32.38Zm0,29.24A11.62,11.62,0,1,1,61.62,50,11.63,11.63,0,0,1,50,61.62Z"/></svg> -->
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path class="cls-1" d="M53.41,25.71c-21.72,0-34.75,23.21-34.75,23.21s13,23.21,34.75,23.21S88.15,48.92,88.15,48.92s-13-23.21-34.75-23.21Zm0,39.79C43.85,65.5,36,58,36,48.92s7.82-16.58,17.37-16.58S70.78,39.8,70.78,48.92,63,65.5,53.41,65.5ZM63.83,48.92c0,5.8-5.21,9.95-10.42,9.95C47.32,58.87,43,54.72,43,48.92A10.32,10.32,0,0,1,53.41,39c5.21,0,10.42,5,10.42,9.95"/></svg> -->
                  <!-- <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:#000000;enable-background:accumulate;" d="m 49.984299,979.36218 c -17.5445,0 -33.2155,8.4765 -43.5623983,21.75002 a 2.0000048,2.0000048 0 0 0 0,2.4688 c 10.3468983,13.2735 26.0178983,21.7812 43.5623983,21.7812 17.5352,0 33.2371,-8.5085 43.5938,-21.7812 a 2.0000048,2.0000048 0 0 0 0,-2.4688 c -10.3567,-13.27272 -26.0586,-21.75002 -43.5938,-21.75002 z m -3,4.7188 c 10.4004,0 18.7813,8.2218 18.7813,18.37502 0,10.1531 -8.3809,18.375 -18.7813,18.375 -10.4003,0 -18.75,-8.2219 -18.75,-18.375 0,-10.15322 8.3497,-18.37502 18.75,-18.37502 z" fill-opacity="1" fill-rule="evenodd" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/><path d="m 46.996499,993.65468 c -4.8806,0 -8.9181,3.9418 -8.9181,8.79282 0,4.8586 4.0413,8.7928 8.9181,8.7928 4.8768,0 8.9182,-3.9342 8.9182,-8.7928 0,-4.85102 -4.0376,-8.79282 -8.9182,-8.79282 z" style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;enable-background:accumulate;" fill-opacity="1" fill-rule="evenodd" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></g></svg> -->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" viewBox="0 0 100 125" version="1.1" x="0px" y="0px"><g fill-rule="evenodd"><g><g><path d="M50,79 C25.147185,79 5.58444147,50.8058934 5.58444147,50.8058934 C5.2620127,50.3666672 5.26166336,49.6391892 5.58444147,49.1941066 C5.58444147,49.1941066 25.147185,21 50,21 C74.852815,21 94.4155585,49.1941066 94.4155585,49.1941066 C94.7379873,49.6333328 94.7383366,50.3608108 94.4155585,50.8058934 C94.4155585,50.8058934 74.852815,79 50,79 Z M50,67.4 C59.3198056,67.4 66.875,59.6097551 66.875,50 C66.875,40.3902449 59.3198056,32.6 50,32.6 C40.6801944,32.6 33.125,40.3902449 33.125,50 C33.125,59.6097551 40.6801944,67.4 50,67.4 Z M50,67.4"/><path d="M50,55.8 C53.1066019,55.8 55.625,53.2032517 55.625,50 C55.625,46.7967483 53.1066019,44.2 50,44.2 C46.8933981,44.2 44.375,46.7967483 44.375,50 C44.375,53.2032517 46.8933981,55.8 50,55.8 Z M50,55.8"/></g></g></g></svg>
                </span>
              </a>
            </div>
          </div>
          <hr>
          <div class="row padding-top-1x mb-4">
            @php
              $ship = Session::get('shipping_address');
              $bill = Session::get('billing_address');
            @endphp
            {{--  
            <!--
            <div class="col-sm-6">
              <h6>{{__('Invoice address')}} :</h6>
              <ul class="list-unstyled">
              <li><span class="text-muted">{{__('Nombres y Apellidos')}}: </span>{{$ship['ship_first_name']}} {{$ship['ship_last_name']}}</li>
              @if (PriceHelper::CheckDigital())
              <li><span class="text-muted">{{__('Address')}}: </span>{{$ship['ship_address1']}} {{$ship['ship_address2']}}</li>
              @endif
              <li><span class="text-muted">{{__('Phone')}}/Celular: </span>{{formatPhone($ship['ship_phone'])}}</li>
              </ul>
            </div>
            -->
            --}}
            <div class="col-sm-12">
              <h6>{{__('Shipping address')}} :</h6>
              <ul class="list-unstyled">
                <li>
                  <span class="text-muted">{{__('Nombres y Apellidos')}}: </span>
                  <span class="fw-bold">{{$bill['bill_first_name']}} {{$bill['bill_last_name']}}</span>
                </li>
                @if (PriceHelper::CheckDigital())
                <li>
                  <span class="text-muted">{{__('Address')}}: </span>
                  <span class="fw-bold">{{$ship['ship_address1']}} {{$ship['ship_address2']}}</span>
                </li>
                @endif
                <li>
                  <span class="text-muted">{{__('Phone')}}/Celular: </span>
                  <span class="fw-bold">{{formatPhone($bill['bill_phone'])}}</span>
                </li>
              </ul>
              @if (DB::table('states')->whereStatus(1)->count() > 0)
              <select name="state_id" class="form-control" id="state_id_select" required>
                <option value="" selected disabled>{{__('Select Shipping State')}}</option>
                @foreach (DB::table('states')->whereStatus(1)->get() as $state)
                  <option value="{{$state->id}}" data-href="{{route('front.state.setup',$state->id)}}" {{Auth::check() && Auth::user()->state_id == $state->id ? 'selected' : ''}} >{{$state->name}}
                    @if ($state->type == 'fixed')
                    ({{PriceHelper::setCurrencyPrice($state->price)}})
                    @else
                    ({{$state->price}}%)
                    @endif
                  </option>
                @endforeach
              </select>
              <small class="text-primary">{{__('please select shipping state')}}</small>
              @error('state_id')
              <p class="text-danger">{{$message}}</p>
              @enderror
              @endif
            </div>
          </div>
          <!-- NUEVO CONTENIDO (INICIO) -->
          @php
          $selOptsTable = [
            0 => [
              "id" => 1,
              "name" => 'boleta'
            ],
            1 => [
              "id" => 2,
              "name" => 'factura'
            ],
          ];
          $selOptVoucher = '';
          if(Session::has('data_voucher')){
            $selOptVoucher = Session::get('data_voucher');
          }
          @endphp
          <h6>{{__('Proof of payment')}} :</h6>
          <div>
            <div class="row mb-0" id="sl-docopts_order">
              <div class="col-sm-12">
                <div class="form-group">
                  <!-- <label for="reg-slOpts__voucher">Tipo de comprobante</label> -->
                  <select class="form-control" name="reg_slOpts__voucher" id="reg-slOpts__voucher" data-href="{{ route('front.checkout.setdatavoucher') }}" required>
                    <option selected value="">Elige una opción</option>
                    @foreach($selOptsTable as $k => $v)
                    <option value="{{ (isset($selOptVoucher['selOptSelectedId']) && $selOptVoucher['selOptSelectedId'] != '' && $v['id'] == $selOptVoucher['selOptSelectedId']) ? $selOptVoucher['selOptSelectedId'] : $v['id'] }}" {{ (isset($selOptVoucher['selOptSelected']) && $selOptVoucher['selOptSelected'] != '' && $v['id'] == $selOptVoucher['selOptSelectedId']) ? 'selected' : '' }}>{{ (isset($selOptVoucher['selOptSelected']) && $selOptVoucher['selOptSelected'] != '' && $v['name'] == $selOptVoucher['selOptSelected']) ? ucfirst($selOptVoucher['selOptSelected']) : ucfirst($v['name']) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <form id="dft443__gH09-checkoutvoucher" action="" method="POST" data-href="{{ route('front.checkout.submitdatavoucher') }}">
                @if(Session::has('data_voucher'))
                <div id="sl-docopts_conts">
                  @if($selOptVoucher['selOptSelected'] == 'boleta')
                  <div class="cBillgADtls">
                    <div class="cBillgADtls__c">
                      <div class="cBillgADtls__c__i">
                        <p><span><strong>Nombres: </strong></span><span>{{$selOptVoucher['first_name']}}</span></p>
                      </div>
                      <div class="cBillgADtls__c__i">
                        <p><span><strong>DNI: </strong></span><span>{{$selOptVoucher['dni']}}</span></p>
                      </div>
                      <div class="cBillgADtls__c__i">
                        <span><strong>Teléfono: </strong></span><span><a href="tel: +51 912845235">{{$selOptVoucher['phone']}}</a></span>
                      </div>
                      <button type="button" class="btnUpdtInf-voucher">
                        <span class="icon-updt">
                          <img src="{{ asset('assets/images/Utilities/icon-update.png') }}" alt="icon-update" width="100" height="100" decoding="sync">
                        </span>
                        <span>Editar información</span>
                      </button>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-start">
                      <div class="form-group mt-3 mb-0">
                        <div class="btn btn-success d-flex align-items-center" t-apparence="btn-sub__frm">
                          {{--
                        <!-- <div class="btn btn-success d-flex align-items-center" t-apparence="btn-sub__frm" data-href="{{ route('front.checkout.submitupdatesesscart') }}"> -->
                          <!-- <input type="hidden" name="_token_update" id="token_update" value="{{ csrf_token() }}"> -->
                          --}}
                          <span>Finalizar compra</span>
                          <span class="cNxticon-i">
                            <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div data-sec="setlist" style="display: none;">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-firt_name">Nombres</label>
                          <input class="form-control" name="chckpay_firt_name" type="text" id="chckpay-firt_name" value="{{$selOptVoucher['first_name']}}" placeholder="Nombres" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-dni">DNI</label>
                          <input class="form-control" name="chckpay_dni" type="text" id="chckpay-dni" value="{{$selOptVoucher['dni']}}" placeholder="DNI" data-valformat="onlydigits" maxlength="8" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-phone">Teléfono</label>
                          <input class="form-control" name="chckpay_phone" type="text" id="chckpay-phone" value="{{$selOptVoucher['phone']}}" placeholder="Teléfono" data-valformat="withspacesforthreenumbers" maxlength="9" required>
                        </div>
                      </div>
                      <div class="col-12 d-flex align-items-center justify-content-start">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <span>Confirmar Datos</span>
                            <span class="cNxticon-i">
                              <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                            </span>
                          </button>
                        </div>
                      </div>
                      <div class="col-12 d-flex align-items-center justify-content-start">
                        <div class="form-group">
                          <div class="btn btn-success d-flex align-items-center" disabled="disabled">
                            <span>Finalizar compra</span>
                            <span class="cNxticon-i">
                              <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @elseif($selOptVoucher['selOptSelected'] == 'factura')
                  <div class="cBillgADtls">
                    <div class="cBillgADtls__c">
                      <div class="cBillgADtls__c__i">
                        <p><span><strong>RUC - Reg unico contribuyente: </strong></span><span>{{ $selOptVoucher['ruc'] }}</span></p>
                      </div>
                      <div class="cBillgADtls__c__i">
                        <p><span><strong>Razon social: </strong></span><span>{{ $selOptVoucher['razonsocial'] }}</span></p>
                      </div>
                      <div class="cBillgADtls__c__i">
                        <p><span><strong>Dirección: </strong></span><span>{{ $selOptVoucher['address'] }}</span></p>
                      </div>
                      <div class="cBillgADtls__c__i">
                        <span><strong>Teléfono: </strong></span><span><a href="tel: +51 912845235">{{ $selOptVoucher['phone'] }}</a></span>
                      </div>
                      <button type="button" class="btnUpdtInf-voucher">
                        <span class="icon-updt">
                          <img src="{{ asset('assets/images/Utilities/icon-update.png') }}" alt="icon-update" width="100" height="100" decoding="sync">
                        </span>
                        <span>Editar información</span>
                      </button>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-start">
                      <div class="form-group mt-3 mb-0">
                        <div class="btn btn-success d-flex align-items-center" t-apparence="btn-sub__frm">
                        {{--
                        <!-- <div class="btn btn-success d-flex align-items-center" t-apparence="btn-sub__frm" data-href="{{ route('front.checkout.submitupdatesesscart') }}"> -->
                          <!-- <input type="hidden" name="_token_update" id="token_update" value="{{ csrf_token() }}"> -->
                          --}}
                          <span>Finalizar compra</span>
                          <span class="cNxticon-i">
                            <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div data-sec="setlist" style="display: none;">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-ruc">RUC</label>
                          <input class="form-control" name="chckpay_ruc" type="text" data-valformat="onlydigits" id="chckpay-ruc" value="{{ $selOptVoucher['ruc'] }}" placeholder="RUC" maxlength="11" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-razonsocial">Razón Social</label>
                          <input class="form-control" name="chckpay_razonsocial" type="text" id="chckpay-razonsocial" value="{{ $selOptVoucher['razonsocial'] }}" placeholder="Razón Social" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-address">Dirección</label>
                          <input class="form-control" name="chckpay_address" type="text" id="chckpay-address" value="{{ $selOptVoucher['address'] }}" placeholder="Dirección" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="chckpay-phone">Teléfono</label>
                          <input class="form-control" name="chckpay_phone" type="text" data-valformat="withspacesforthreenumbers" id="chckpay-phone" value="{{ $selOptVoucher['phone'] }}" placeholder="Teléfono" maxlength="9" required>
                        </div>
                      </div>
                      <div class="col-12 d-flex align-items-center justify-content-start">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <span>Confirmar Datos</span>
                            <span>
                              <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                            </span>
                          </button>
                        </div>
                      </div>
                      <div class="col-12 d-flex align-items-center justify-content-start">
                        <div class="form-group">
                          <div class="btn btn-success d-flex align-items-center" disabled="disabled">
                            <span>Finalizar compra</span>
                            <span class="cNxticon-i">
                              <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
                @else
                <div id="sl-docopts_conts"></div>
                @endif
              </form>
            </div>
          </div>
          <!-- NUEVO CONTENIDO (FIN) -->
          <div class="ctPayMthd-s">
            <div class="ctPayMthd-s__c" id="dkdr__fL236-ctPayMthd-s" style="display: none;">
              <h6>{{__('Pay with')}} :</h6>
              <div class="row mt-4">
                <div class="col-12">
                  <div class="payment-methods">
                    @php
                      $gateways = DB::table('payment_settings')->whereStatus(1)->orderBy('id','desc')->get();
                    @endphp
                    @foreach ($gateways as $gateway)
                    @if (PriceHelper::CheckDigitalPaymentGateway())
                    @if ($gateway->unique_keyword != 'cod')
                    <div class="single-payment-method">
                      <a class="text-decoration-none sLinkModal-shw__cPay" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#{{$gateway->unique_keyword}}">
                        <img class="" src="{{asset('assets/back/images/payment/'.$gateway->photo)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}">
                        <p>{{$gateway->name}}</p>
                      </a>
                    </div>
                    @endif
                    @else
                    <div class="single-payment-method">
                      <a class="text-decoration-none sLinkModal-shw__cPay" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#{{$gateway->unique_keyword}}">
                        <img class="" src="{{asset('assets/back/images/payment/'.$gateway->photo)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}">
                        <p>{{$gateway->name}}</p>
                      </a>
                    </div>
                    @endif
                    @endforeach                
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('includes.checkout_modal')
    
    @include('includes.checkout_sitebar',$cart)
  </div>  
</div>
<script type="text/javascript" src="{{ asset('node_modules/pdfobject/pdfobject.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/checkout.min.js')}}"></script>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" id="c-modalPrevOrderPDF">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">VISUALIZACIÓN DEL PEDIDO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow: hidden;height:100%;box-sizing:border-box;">
        <div class="row mb-2 cDownPDF__cTitle">
          <div class="row py-2 cDownPDF__cTitle__c">
            <div class="col-3 cDownPDF__cTitle__c__cBtnDown">
              <a class="btn btn-primary ms-auto text-align-center d-flex align-items-end justify-content-center" href="javascript:void(0);" id="cTentr-af1698__1prevChckpPDFDown">
                <span class="me-2">DESCARGAR PDF</span>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" version="1.1" viewBox="0 0 700 700"><g xmlns="http://www.w3.org/2000/svg"><path d="m515.29 81.621c0.69531 0.79688 1.7031 1.25 2.7539 1.25 1.0625 0 2.0625-0.45312 2.7656-1.25l25.48-25.691c0.96484-1.0938 1.1992-2.6367 0.60547-3.9648-0.60547-1.3164-1.9258-2.168-3.375-2.168h-9.1328l-0.003906-18.113c0.007813-2.0391-1.6328-3.6836-3.6719-3.6836h-25.328c-2.0391 0-3.6836 1.6445-3.6836 3.6836v18.109h-9.1289c-1.4492 0-2.7734 0.85156-3.3672 2.168-0.59766 1.3281-0.35156 2.8711 0.60547 3.9648z"/><path d="m392.98 256.95c-10.535-11.742-20.938-24.863-30.309-36.668-4.418-5.5781-8.6445-10.898-12.602-15.73l-0.29297-0.35156c5.7891-16.492 9.1016-29.988 9.8398-40.125 1.875-25.82-1.0078-42.453-8.8086-50.836-5.2695-5.6719-13.184-7.6484-20.625-5.1445-5.332 1.7852-12.551 6.5742-16.676 19.219-6.1484 18.848-3.168 52.23 14.312 79.84-7.8008 20.43-18.676 43.902-30.688 66.254-22.875 8.0195-41.109 18.562-54.195 31.355-17.098 16.688-24.047 33.254-19.074 45.438 3.0625 7.5469 10.148 12.051 18.945 12.051 6.125 0 12.75-2.2109 19.164-6.3906 16.191-10.586 37.328-45.848 48.668-66.281 23.457-7.3242 46.621-10.32 58.391-11.457 5.3242-0.51563 10.613-0.92578 15.703-1.2109 20.602 21.758 37.453 33.23 52.977 36.094 3.125 0.58203 6.25 0.875 9.3008 0.875 12.652 0 23.105-5.0469 27.984-13.496 3.6797-6.3828 3.6055-13.832-0.20703-20.441-8.6133-14.914-34.609-23.121-73.199-23.121-2.7734 0-5.6406 0.039063-8.6094 0.12891zm-141.75 82.5c-3.0625 2-6.2109 3.1914-8.4297 3.1914-0.42188 0-0.70703-0.042969-0.86719-0.085938-0.38672-1.9531 1.0039-10.406 14.695-23.781 6.4297-6.2812 14.559-12.02 24.188-17.09-12.148 19.543-23.078 33.516-29.586 37.766zm80.902-206.05c1.4297-4.375 3.1992-6.3516 4.3008-6.7188 0.027344-0.003906 0.050782-0.015625 0.074219-0.023437 1.0625 1.1992 5.5898 8.0469 3.5625 36.012-0.35156 4.8789-1.5391 11.043-3.5391 18.367-6.543-16.84-8.3398-35.555-4.3984-47.637zm35.008 125.22c-10.426 1.0039-26.309 3.0703-44.027 7.2617 6.8711-13.719 13.234-27.625 18.547-40.512 1.8438 2.3086 3.7305 4.6758 5.6445 7.1016 6.4102 8.082 13.613 17.164 21.078 26.035zm90.656 31.125c0.29297 0.50391 0.28516 0.70703 0.21094 0.83984-0.82422 1.4297-4.5469 3.6953-11.027 3.6953-1.8086 0-3.7344-0.18359-5.7227-0.55469-8.0859-1.4961-17.516-7.0859-28.758-17.051 30.504 1.457 42.828 8.8086 45.297 13.07z"/><path d="m434.52 28h-253.57c-15.539 0-28.168 12.594-28.168 28.172v447.65c0 15.562 12.629 28.172 28.168 28.172h338.09c15.574 0 28.168-12.609 28.168-28.172v-363.13zm0 39.832 72.863 72.863h-72.863zm84.527 436h-338.09v-447.66h225.39v84.52c0 15.562 12.602 28.172 28.168 28.172h84.527v334.96z"/><path d="m303.45 388.39c-2.3008-2.0312-5.0625-3.5117-8.1992-4.3789-3.0977-0.88672-7.5312-1.332-13.184-1.332h-18.754c-3.5664 0-6.2539 0.81641-7.9961 2.4453-1.7578 1.6445-2.6602 4.3125-2.6602 7.9141v55.621c0 3.2383 0.80078 5.7578 2.3789 7.5039 1.6055 1.793 3.7461 2.7031 6.3555 2.7031 2.4961 0 4.6016-0.91406 6.25-2.7148 1.6133-1.7695 2.4375-4.3242 2.4375-7.5898v-19.023h11.988c9.2578 0 16.367-2.0234 21.125-6.0156 4.8398-4.043 7.2969-10.023 7.2969-17.781 0-3.6133-0.59375-6.9141-1.7734-9.8281-1.1875-2.9453-2.957-5.4727-5.2656-7.5234zm-12.117 23.258c-1.0469 1.4102-2.543 2.4023-4.582 3.0391-2.168 0.67188-4.9297 1.0195-8.2227 1.0195h-8.4414v-19.254h8.4453c7.6094 0 10.695 1.5195 11.922 2.7539 1.6367 1.7461 2.4297 3.9805 2.4297 6.8203 0 2.3438-0.52344 4.2344-1.5508 5.6211z"/><path d="m372.73 389.56c-3.0391-2.6602-6.4805-4.5039-10.219-5.4727-3.6406-0.94141-8.0547-1.4219-13.098-1.4219h-19.047c-3.5234 0-6.1562 0.84375-7.8281 2.5273-1.6758 1.6797-2.5273 4.3125-2.5273 7.8281v52.91c0 2.4805 0.21875 4.4688 0.66797 6.0664 0.50781 1.8125 1.6055 3.2305 3.2578 4.2109 1.5742 0.95312 3.7812 1.4102 6.7266 1.4102h19.047c3.3711 0 6.4531-0.21875 9.1562-0.65625 2.7539-0.44922 5.3711-1.2305 7.7656-2.3242 2.418-1.1016 4.6719-2.5938 6.7148-4.4297 2.5586-2.3516 4.6914-5.0586 6.3398-8.0547 1.6289-2.9844 2.8555-6.3711 3.6289-10.059 0.77344-3.6523 1.1641-7.7461 1.1641-12.152-0.007813-13.48-3.9648-23.707-11.75-30.383zm-12.73 50.609c-0.94531 0.82422-2.082 1.4844-3.3828 1.9492-1.3594 0.48047-2.6836 0.78906-3.9414 0.90625-1.3281 0.125-3.2031 0.19141-5.5781 0.19141h-9.6758v-46.18h8.25c4.3164 0 8.0195 0.46875 11.008 1.3945 2.793 0.85156 5.2031 2.918 7.1562 6.1562 2.0039 3.3086 3.0234 8.4453 3.0234 15.27 0.003906 9.6289-2.3008 16.453-6.8594 20.312z"/><path d="m439.04 382.68h-34.453c-2.2969 0-4.1562 0.33984-5.6797 1.043-1.6289 0.73828-2.8438 1.9414-3.6172 3.5859-0.71875 1.5352-1.0625 3.4102-1.0625 5.7344v55.52c0 3.3438 0.81641 5.9141 2.4141 7.6367 1.6289 1.7695 3.7578 2.6719 6.3242 2.6719 2.5156 0 4.625-0.88672 6.2734-2.6367 1.6016-1.7305 2.4141-4.3125 2.4141-7.6719v-22.371h22.668c2.5352 0 4.5234-0.60938 5.8984-1.8242 1.4297-1.2617 2.1523-2.9531 2.1523-5.0352 0-2.0781-0.70703-3.7734-2.1055-5.0391-1.3594-1.2422-3.3594-1.8711-5.9414-1.8711h-22.668v-15.656h27.395c2.6836 0 4.75-0.64453 6.1445-1.9219 1.4297-1.3008 2.1523-3.0312 2.1523-5.1406 0-2.0664-0.72266-3.7812-2.1562-5.1016-1.4219-1.2852-3.4805-1.9219-6.1523-1.9219z"/></g></svg>
              </a>
            </div>
          </div>
          <hr>
        </div>
        <div id="cTentr-af1698__1prevChckp-show"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection