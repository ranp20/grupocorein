@extends('master.front')
@section('title')
  {{__('Address')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
          <li class="separator"></li>
          <li>{{__('Shipping - Billing Address')}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    @include('includes.user_sitebar')
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="padding-top-2x mt-2 hidden-lg-up"></div>
          <h5>{{__('Shipping Address')}}</h5>
          @php
            $paisData = (isset($user->reg_country_id) && !empty($user->reg_country_id)) ? $user->reg_country_id : '';
            $departamentoData = (isset($user->reg_departamento_id) && !empty($user->reg_departamento_id)) ? $user->reg_departamento_id : '';
            $provinciaData = (isset($user->reg_provincia_id) && !empty($user->reg_provincia_id)) ? $user->reg_provincia_id : '';
            $distritoData = (isset($user->reg_distrito_id) && !empty($user->reg_distrito_id)) ? $user->reg_distrito_id : '';

            $paisAll = DB::table('countries')->get();
            $departamentoAll = DB::table('tbl_departamentos')->get();
            $provinciaAll = DB::table('tbl_provincias')->get();
            $distritoAll = DB::table('tbl_distritos')->get();

            $paisByUser = DB::table('countries')->where('id',$paisData)->first();
            $departamentoByUser = DB::table('tbl_departamentos')->where('id',$departamentoData)->first();
            $provinciaByUser = DB::table('tbl_provincias')->where('id',$provinciaData)->first();
            $distritoByUser = DB::table('tbl_distritos')->where('id',$distritoData)->first();

          @endphp
          <form id="shippingForm" class="row" action="{{route('user.shipping.submit')}}" method="POST">
            @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-address1">{{__('Address 1')}} *</label>
                <input class="form-control" name="reg_address1" value="{{$user->reg_address1}}" type="text" id="reg-address1">
                @error('reg_address1')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-address2">{{__('Address 2 (Optional)')}} </label>
                <input class="form-control" value="{{$user->reg_address2}}" name="reg_address2" type="text" id="reg-address2">
                @error('reg_address2')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-codepostal">{{__('Zip Code')}}</label>
                <input class="form-control" type="text" value="{{$user->reg_codepostal}}" name="reg_codepostal" id="reg-codepostal">
              </div>
            </div> 
            <div class="{{DB::table('states')->count() > 0  ? 'col-md-12' : 'col-md-6'}} ">
              <div class="form-group">
                <label for="reg-country">País</label>
                <select class="form-control" name="reg_country_id" id="reg-country">
                  <option selected value="">{{__('Choose Country')}}</option>
                  @foreach ($paisAll as $countryData)
                    <option value="{{ (!empty($paisData) && $paisData != '' && $user->reg_country_id == $countryData->id) ? $paisData : $countryData->id }}" {{ (!empty($paisData) && $paisData != '' && $user->reg_country_id == $countryData->id) ? 'selected' : '' }} >{{ $countryData->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-departamento">Departamento</label>
                <select class="form-control" name="reg_departamento_id" id="reg-departamento" data-href="${locationsGET + '/provincia'}" required>
                  <option selected value="">Elige Departamento</option>
                  @foreach ($departamentoAll as $departData)
                    <option data-code="{{ ($departamentoData != '' && $user->reg_departamento_id == $departData->id) ? $departamentoByUser->departamento_code : $departData->departamento_code }}" value="{{ (!empty($departamentoData) && $departamentoData != '' && $user->reg_departamento_id == $departData->id) ? $departamentoData : $departData->id }}" {{ (!empty($departamentoData) && $departamentoData != '' && $user->reg_departamento_id == $departData->id) ? 'selected' : '' }} >{{ $departData->departamento_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-provincia">Provincia</label>
                <select class="form-control" name="reg_provincia_id" id="reg-provincia" data-href="${locationsGET + '/distrito'}" required>
                  <option selected value="">Elige Provincia</option>
                  @foreach ($provinciaAll as $proviData)
                    <option data-code="{{ ($provinciaData != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaByUser->provincia_code : $proviData->provincia_code }}" value="{{ (!empty($provinciaData) && $provinciaData != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaData : $proviData->id }}" {{ (!empty($provinciaData) && $provinciaData != '' && $user->reg_provincia_id == $proviData->id) ? 'selected' : '' }} >{{ $proviData->provincia_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-distrito">Distrito</label>
                <select class="form-control" name="reg_distrito_id" id="reg-distrito" required>
                  <option selected value="">Elige Distrito</option>
                    @foreach ($distritoAll as $distrData)
                      <option data-code="{{ ($distritoData != '' && $user->reg_distrito_id == $distrData->id) ? $distritoByUser->distrito_code : $distrData->distrito_code }}" value="{{ (!empty($distritoData) && $distritoData != '' && $user->reg_distrito_id == $distrData->id) ? $distritoData : $distrData->id }}" {{ (!empty($distritoData) && $distritoData != '' && $user->reg_distrito_id == $distrData->id) ? 'selected' : '' }} >{{ $distrData->distrito_name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-streetaddress">Calle</label>
                <input class="form-control" type="text" name="reg_streetaddress" placeholder="Calle" id="reg-streetaddress" value="{{ $user->reg_streetaddress }}" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="reg-referenceaddress">Referencia (Opcional)</label>
                <input class="form-control" type="text" name="reg_referenceaddress" placeholder="Referencia" id="reg-referenceaddress" value="{{ $user->reg_referenceaddress }}">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="reg-addresseeaddress">Destinatario (Opcional)</label>
                <input class="form-control" type="text" name="reg_addresseeaddress" placeholder="Destinatario" id="reg-addresseeaddress" value="{{ $user->reg_addresseeaddress }}">
              </div>
            </div>
            <div class="col-12 ">
              <div class="text-right">
                <button class="btn btn-primary margin-bottom-none btn-sm" type="submit"><span>{{__('Update Address')}}</span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('assets/front/js/profile.js') }}"></script>
@endsection