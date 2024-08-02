@php
function formatPhone($phone){
	$output_phone = "";
  $output_phone = preg_replace('/(\d{1,3})(?=(\d{3})+$)/', '$1 ', $phone);
	return $output_phone;
}
@endphp
@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
  {{__('Complaints book')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{ __('Home') }}</a> </li>
          <li class="separator"></li>
          <li>{{ __('Complaints book') }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1 complaintsbook-page">
  <div class="row">
    <div class="col-lg-12">
      <div class="section-title">
        <h2 class="h3">{{ __('Complaints book') }}</h2>
      </div>
    </div>
    <form class="row mt-2" method="Post" action="{{route('front.complaintsbook.submit')}}">
      @csrf
      <div class="col-lg-6 col-md-6 col-sm-12">
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title wt-custm--sbtitle">{{__('Identification of the complaining consumer')}}</h3>
          <div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_name" class="ifield-required">{{__('Name')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_name" id="cmptbk_name" placeholder="" required>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_departamento_id" class="ifield-required">{{__('Department')}}</label>
                <select class="form-control" name="cmptbk_departamento_id" id="cmptbk_departamento_id" data-href="{{route('front.complaintsbook.provincia')}}" required>
                  <option value="">{{__('Select an option')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_provincia_id" class="ifield-required">{{__('Province')}}</label>
                <select class="form-control" name="cmptbk_provincia_id" id="cmptbk_provincia_id" data-href="{{route('front.complaintsbook.distrito')}}" required>
                  <option value="">{{__('Select an option')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_distrito_id" class="ifield-required">{{__('District')}}</label>
                <select class="form-control" name="cmptbk_distrito_id" id="cmptbk_distrito_id" data-href="" required>
                  <option value="">{{__('Select an option')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_domicilio" class="ifield-required">{{__('Domicilie')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_domicilio" id="cmptbk_domicilio" placeholder="" required>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_dni_ce" class="ifield-required">{{__('DNI/CE')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_dni_ce" id="cmptbk_dni_ce" placeholder="" maxlength="20" required>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_ruc" class="ifield-required">{{__('RUC')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_ruc" id="cmptbk_ruc" placeholder="" maxlength="20" required>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_razonsocial" class="ifield-required">{{__('Business name')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_razonsocial" id="cmptbk_razonsocial" placeholder="" required>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_telefono" class="ifield-required">{{__('Phone')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_telefono" id="cmptbk_telefono" placeholder="" data-valformat="withspacesforthreenumbers" maxlength="11" required>
              </div>
            </div>
            <div class="col-md-12 pb-1">
              <div class="form-group">
                <label for="cmptbk_email" class="ifield-required">{{__('E_mail')}}</label>
                <input class="form-control form-control-rounded" type="email" name="cmptbk_email" id="cmptbk_email" placeholder="" required>
              </div>
            </div>
            <div class="col-12 py-3">
              <button class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-between" type="submit">
                <span>{{ __('Send a complaint form') }}</span>
                <span>></span>
              </button>
            </div>
          </div>
        </section>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title wt-custm--sbtitle">{{__("Details of the consumer's claim and request")}}</h3>
          <div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="cmptbk_typeofclaim" class="ifield-required">{{__('Type of Claim')}}</label>
                <select class="form-control" name="cmptbk_typeofclaim" id="cmptbk_typeofclaim" data-href="" required>
                  <option value="">{{__('Select an option')}}</option>
                  <option value="{{ __('Claim') }}">{{ __('Claim') }}</option>
                  <option value="{{ __('Complaint') }}">{{ __('Complaint') }}</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="cmptbk_detail" class="ifield-required">{{__('Detail')}}</label>
                <textarea class="form-control form-control-rounded ipt-mssgtxt_cmptbk" rows="3" maxlength="350" name="cmptbk_detail" id="cmptbk_detail" placeholder="{{__('Enter the details of your claim')}}"></textarea>
                <div class="text-right" id="c-charCount">
                  <span id="charCount">0</span>
                  <span>/350</span>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="cmptbk_order" class="ifield-required">{{__('Order')}}</label>
                <textarea class="form-control form-control-rounded ipt-mssgtxt_cmptbk" rows="3" maxlength="350" name="cmptbk_order" id="cmptbk_order" placeholder="{{__('Enter the details of your order')}}"></textarea>
                <div class="text-right" id="c-charCount">
                  <span id="charCount">0</span>
                  <span>/350</span>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title wt-custm--sbtitle">{{__('Younger')}}</h3>
          <div>
            <div class="col-md-12">
              <div class="custm_field-choice pb-3">
                <input type="checkbox" name="cmptbk_agecheck" id="cmptbk_agecheck" title="{{ __('I am a minor') }}" value="0" class="chk-dnone">
                <label for="cmptbk_agecheck" class="curs-pointer">
                  <span id="ic-agecheck" class="ic-chklinear">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 18 18"><defs><clipPath id="clip-Web_1920_1"><rect width="18" height="18"/></clipPath></defs><g id="Web_1920_1" data-name="Web 1920 – 1" clip-path="url(#clip-Web_1920_1)"><rect width="18" height="18" fill="#fff"/><g id="Rectángulo_1" data-name="Rectángulo 1" fill="none" stroke="#696158" stroke-width="1.8"><rect width="18" height="18" stroke="none"/><rect x="0.9" y="0.9" width="16.2" height="16.2" fill="none"/></g></g></svg>
                  </span>
                  <span class="usrslct-none">{{ __('I am a minor') }}</span>
                </label>
              </div>
              <div id="c-agevaldchck" class="d-none">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="cmptbk_younger_namesparents" class="ifield-required">{{__('Name of father/mother')}}</label>
                    <input class="form-control form-control-rounded" type="text" name="cmptbk_younger_namesparents" id="cmptbk_younger_namesparents" placeholder="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="cmptbk_younger_dni_ce" class="ifield-required">{{__('DNI/CE')}}</label>
                    <input class="form-control form-control-rounded" type="text" name="cmptbk_younger_dni_ce" id="cmptbk_younger_dni_ce" placeholder="" maxlength="20">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="cmptbk_younger_phone" class="ifield-required">{{__('Phone')}}</label>
                    <input class="form-control form-control-rounded" type="text" name="cmptbk_younger_phone" id="cmptbk_younger_phone" placeholder="" data-valformat="withspacesforthreenumbers" maxlength="11">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="cmptbk_younger_email" class="ifield-required">{{__('E_mail')}}</label>
                    <input class="form-control form-control-rounded" type="email" name="cmptbk_younger_email" id="cmptbk_younger_email" placeholder="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title wt-custm--sbtitle">{{__('Identification of the contracted good')}}</h3>
          <div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="cmptbk_typeofgod" class="ifield-required">{{__('Type of Good')}}</label>
                <select class="form-control" name="cmptbk_typeofgod" id="cmptbk_typeofgod" data-href="" required>
                  <option value="">{{__('Select type of property')}}</option>
                  <option value="{{__('Product')}}">{{__('Product')}}</option>
                  <option value="{{__('Service')}}">{{__('Service')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="cmptbk_reclaimedamount" class="ifield-required">{{__('Reclaimed amount')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_reclaimedamount" id="cmptbk_reclaimedamount" data-valformat="withcomedecimal" placeholder="{{__('Reclaimed amount')}}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="cmptbk_description" class="ifield-required">{{__('Description')}}</label>
                <input class="form-control form-control-rounded" type="text" name="cmptbk_description" id="cmptbk_description" placeholder="{{__('Description')}}">
              </div>
            </div>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="{{asset('assets/front/js/complaintsbook.min.js')}}"></script>
@endsection