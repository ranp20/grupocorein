@extends('master.front')
@section('title')
  {{__('Special offers')}}
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
          <li><a href="{{route('front.allcategories')}}">{{__('All Categories')}}</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="deal-of-day-section pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 class="h3">{{__('All Categories')}}</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <div class="row gx-3">
          @foreach($category as $categ)
          <div class="col-md-4 pb-3">
            <a href="{{ route('front.catalog').'?category='.$categ['slug'] }}" class="genius-banner c-cMnul__Flinks" data-href="{{ $categ['slug'] }}" title="{{ (isset($categ['name'])) ? $categ['name'] : '' }}">
              <div class="inner-content c-cMnul__Flinks__cDesc">
                @if (isset($categ['name']))
                  <h4>{{$categ['name']}}</h4>
                @endif
              </div>
              <div class="c-cMnul__Flinks__cImg">
                <img src="{{ asset('assets/images/categories/'.$categ['photo']) }}" alt="{{ $categ['slug'] }}" width="100" height="100" decoding="sync">
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
{{--
<!--
<script type="text/javascript" src="{{asset('assets/front/js/specialofferproducts.js')}}"></script>
-->
--}}
@endsection