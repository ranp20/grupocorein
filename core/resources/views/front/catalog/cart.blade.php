@extends('master.front')
@section('title')
  {{__('Shopping Cart')}}
@endsection
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
          <li class="separator"></li>
          <li>{{__('Cart')}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="rnvc_cart">
  <div id="ccksj934JBjFKScsKjs">
    @if(Session::has('cart') && count(Session::get('cart')) > 0)
    <div class="container padding-bottom-3x mb-1">
      <div class="row">
        <div class="col-lg-12">
          <div class="cTitleSec__c">
            <div class="section-title">
              <h2 class="cTitleSec__c__title">{{ __('Shopping cart') }}</h2>
            </div>
            <p class="cTitleSec__c__subtitle">Tienes <strong class="text-bold">{{count(Session::get('cart'))}} productos</strong> en tu carro de compras</p>
          </div>
        </div>
      </div>
      <div id="view_cart_load">
        @include('includes.cart')
      </div>
    </div>
    @else
    <div class="container padding-bottom-3x mb-1">
      <div class="card text-center">
        <div class="card-body padding-top-2x">
          <h3 class="card-title">{{__('Your shopping cart is empty.')}}</h3>
          <a class="btn btn-outline-primary m-4" href="{{route('front.catalog')}}">
            <i class="icon-package pr-2"></i>
            <span class="ms-1">{{__('View our products')}}</span>
          </a>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection