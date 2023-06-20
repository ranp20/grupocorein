@extends('master.front')
@section('title')
  {{__('Shipping')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
        <li class="separator"></li>
        <li>{{__('Shipping address')}}</li>
      </ul>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1  checkut-page">
  <div class="row">
    <div class="col-xl-9 col-lg-8">
      <div class="steps flex-sm-nowrap mb-2">
        <a class="step" href="{{route('front.checkout.billing')}}">
          <h4 class="step-title"><i class="icon-check-circle"></i>1. Datos Personales</h4>
        </a>
        <a class="step active" href="{{route('front.checkout.shipping')}}">
          <h4 class="step-title">2. Dirección de Envío</h4>
        </a>
        <a class="step" href="{{route('front.checkout.payment')}}">
          <h4 class="step-title">3. Comprobante de pago</h4>
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <h6>{{__('Shipping Address')}}</h6>
          @php
          $paisData = (isset($datauserinfo['pais']) && !empty($datauserinfo['pais'])) ? $datauserinfo['pais'] : '';
          $departamentoData = (isset($datauserinfo['departamento']) && !empty($datauserinfo['departamento'])) ? $datauserinfo['departamento'] : '';
          $provinciaData = (isset($datauserinfo['provincia']) && !empty($datauserinfo['provincia'])) ? $datauserinfo['provincia'] : '';
          $distritoData = (isset($datauserinfo['distrito']) && !empty($datauserinfo['distrito'])) ? $datauserinfo['distrito'] : '';

          $departamentoAll = DB::table('tbl_departamentos')->get();
          $provinciaAll = DB::table('tbl_provincias')->get();
          $distritoAll = DB::table('tbl_distritos')->get();
          @endphp          
          <form id="checkoutShipping" action="{{route('front.checkout.shipping.store')}}" method="POST">
          @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="checkout-zip">{{__('Zip Code')}}</label>
                  <input class="form-control" type="text" autocomplete="off" spellcheck="false" name="ship_zip" id="checkout-zip" value="{{ (!empty($user->reg_codepostal) && $user->reg_codepostal != '') ? $user->reg_codepostal : $user->ship_zip }}" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-country">{{ __('Country') }}</label>
                  <select class="form-control" name="ship_country" required id="billing-country">
                    <option selected value="">{{__('Choose Country')}}</option>
                    <option value="1" selected>PERU</option>
                    {{--
                    <!--
                    <option value="{{ (!empty($paisData->id) && $paisData->id != '') ? $paisData->id : $paisData->id }}">{{ (!empty($paisData->pais_name) && $paisData->pais_name != '') ? $paisData->pais_name : $paisData->pais_name }}</option>
                    -->
                    --}}
                  </select>
                </div>
              </div>
              <!--  NUEVO CONTENIDO(INICIO) -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-departamento">{{ __('Departamento') }}</label>
                  <select class="form-control" name="ship_departamento" id="billing-departamento" data-href="{{route('front.checkout.provincia')}}" required>
                    <option selected value="">{{__('Elige Departamento')}}</option>
                    @foreach ($departamentoAll as $departData)
                      <option data-code="{{ (!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $departData->id) ? $departamentoData->departamento_code : $departData->departamento_code }}" value="{{ (!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $departData->id) ? $departamentoData->id : $departData->id }}" {{ (!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $departData->id) ? 'selected' : '' }} >{{ $departData->departamento_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-provincia">{{ __('Provincia') }}</label>
                  <select class="form-control" name="ship_provincia" id="billing-provincia" data-href="{{route('front.checkout.distrito')}}" required>
                    <option selected value="">{{__('Elige Provincia')}}</option>
                    @foreach ($provinciaAll as $proviData)
                      <option data-code="{{ (!empty($provinciaData->id) && $provinciaData->id != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaData->provincia_code : $proviData->provincia_code }}" value="{{ (!empty($provinciaData->id) && $provinciaData->id != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaData->id : $proviData->id }}" {{ (!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $proviData->id) ? 'selected' : '' }} >{{$proviData->provincia_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-distrito">{{ __('Distrito') }}</label>
                  <select class="form-control" name="ship_distrito" id="billing-distrito" data-href="{{route('front.checkout.updateamountcart')}}" required>
                    <option selected value="">{{__('Elige Distrito')}}</option>
                    @foreach ($distritoAll as $distrData)
                      <option data-code="{{ (!empty($distritoData->id) && $distritoData->id != '' && $user->reg_distrito_id == $distrData->id) ? $distritoData->distrito_code : $distrData->distrito_code }}" value="{{ (!empty($distritoData->id) && $distritoData->id != '' && $user->reg_distrito_id == $distrData->id) ? $distritoData->id : $distrData->id }}" {{ (!empty($distritoData->id) && $distritoData->id != '' && $user->reg_distrito_id == $distrData->id) ? 'selected' : '' }} >{{$distrData->distrito_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="ship-streetaddress">Calle</label>
                  <input class="form-control" type="text" autocomplete="off" spellcheck="false" name="ship_streetaddress" placeholder="Calle" id="ship-streetaddress" value="{{ (!empty($user->reg_streetaddress) && $user->reg_streetaddress != '') ? $user->reg_streetaddress : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="ship-referenceaddress">Referencia</label>
                  <input class="form-control" type="text" name="ship_referenceaddress" placeholder="Referencia" id="ship-referenceaddress" value="{{ (!empty($user->reg_referenceaddress) && $user->reg_referenceaddress != '') ? $user->reg_referenceaddress : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="ship-addresseeaddress">Destinatario</label>
                  <input class="form-control" type="text" name="ship_addresseeaddress" placeholder="Destinatario" id="ship-addresseeaddress" value="{{ (!empty($user->reg_addresseeaddress) && $user->reg_addresseeaddress != '') ? $user->reg_addresseeaddress : '' }}" required>
                </div>
              </div>
            </div>
            <!--  NUEVO CONTENIDO(FIN) -->
            <div class="d-flex justify-content-between paddin-top-1x mt-4">
              <a class="btn btn-primary btn-sm" href="{{route('front.cart')}}">
                <span class="hidden-xs-down"><i class="icon-arrow-left"></i> {{__('Back To Cart')}}</span>
              </a>
              <button class="btn btn-primary  btn-sm" type="submit">
                <span class="hidden-xs-down">{{__('Continue')}}</span><i class="icon-arrow-right position-relative z-3 ms-1"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @include('includes.checkout_sitebar',$cart)
  </div>
</div>
<script type="text/javascript" src="{{asset('assets/front/js/shipping.js')}}"></script>
@endsection