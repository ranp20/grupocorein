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
          <li><a href="{{route('front.specialoffer')}}">{{__('Special offers')}}</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@php
function renderStarRating($rating,$maxRating=5) {
  $fullStar = "<i class = 'far fa-star filled'></i>";
  $halfStar = "<i class = 'far fa-star-half filled'></i>";
  $emptyStar = "<i class = 'far fa-star'></i>";
  $rating = $rating <= $maxRating?$rating:$maxRating;

  $fullStarCount = (int)$rating;
  $halfStarCount = ceil($rating)-$fullStarCount;
  $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

  $html = str_repeat($fullStar,$fullStarCount);
  $html .= str_repeat($halfStar,$halfStarCount);
  $html .= str_repeat($emptyStar,$emptyStarCount);
  $html = $html;
  return $html;
}

$user_id = 0;
if(Auth::check()){
  if(!empty(auth()->user()) || auth()->user() != ""){
    $user = Auth::user();
    $user_id = Auth::user()->id;
  }
}
@endphp
<div class="deal-of-day-section pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 class="h3">{{__('Special offers')}}</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="shop-top-filter-wrapper">
          <div class="row">
            <div class="col-md-10 gd-text-sm-center">
              <div class="sptfl">
                <div class="shop-sorting">
                  <label for="sorting">{{__('Sort by')}}:</label>
                  <select class="form-control" id="sorting">
                    <option value="">{{__('All Products')}}</option>
                    <option value="low_to_high" {{request()->input('low_to_high') ? 'selected' : ''}}>{{__('Low - High Price')}}</option>
                    <option value="high_to_low" {{request()->input('high_to_low') ? 'selected' : ''}}>{{__('High - Low Price')}}</option>
                  </select>
                  <span class="text-muted">{{__('Showing')}}:</span>
                  <span>1 - {{$setting->view_product}} {{__('items')}}</span>
                </div>
              </div>
            </div>
            <div class="col-md-2 gd-text-sm-center">
              <div class="shop-view">
                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : ''}} " data-step="grid" href="javascript:;" data-href="{{route('front.catalog').'?view_check=grid'}}"><i class="fas fa-th-large"></i></a>
                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : ''}}" href="javascript:;" data-step="list" data-href="{{route('front.catalog').'?view_check=list'}}"><i class="fas fa-list"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-lg-12 order-lg-2" id="list_view_ajax">
        @include('front.specialofferproducts.filter')
      </div>
      {{--
      <!--
      <div class="col-lg-3 order-lg-1">
        <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
        <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
          <section class="widget widget-categories card rounded p-4">
            <h3 class="widget-title">{{__('Shop Categories')}}</h3>
            <ul id="category_list" class="category-scroll">
              @foreach ($categories as $getcategory)
              <li class="has-children  {{isset($category) && $category->id == $getcategory->id ? 'expanded active' : ''}} ">
                <a class="category_search" href="javascript:;"  data-href="{{$getcategory->slug}}">{{$getcategory->name}}</a>
                  <ul id="subcategory_list">
                    @foreach ($getcategory->subcategory as $getsubcategory)
                    <li class="{{isset($subcategory) && $subcategory->id == $getsubcategory->id ? 'active' : ''}}">
                      <a class="subcategory" href="javascript:;" data-href="{{$getsubcategory->slug}}">{{$getsubcategory->name}}</a>
                      <ul id="childcategory_list">
                        @foreach ($getsubcategory->childcategory as $getchildcategory)
                        <li class="{{isset($childcategory) && $getchildcategory->id == $getchildcategory->id ? 'active' : ''}}">
                          <a class="childcategory" href="javascript:;" data-href="{{$getchildcategory->slug}}">{{$getchildcategory->name}}</a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                    @endforeach
                  </ul>
                </li>
              @endforeach
            </ul>
          </section>
          @if ($setting->is_range_search == 1)
          <section class="widget widget-categories card rounded p-4">
            <h3 class="widget-title">{{ __('Filter by Price') }}</h3>
            <form class="price-range-slider" method="post" data-start-min="{{request()->input('minPrice') ? request()->input('minPrice') : '0'}}" data-start-max="{{request()->input('maxPrice') ? request()->input('maxPrice') : $setting->max_price}}" data-min="0" data-max="{{$setting->max_price}}" data-step="5">
              <div class="ui-range-slider"></div>
              <footer class="ui-range-slider-footer">
                <div class="column">
                  <button class="btn btn-primary btn-sm" id="price_filter" type="button"><span>Filtrar</span></button>
                </div>
                <div class="column">
                  <div class="ui-range-values">
                    <div class="ui-range-value-min">{{PriceHelper::setCurrencySign()}}<span class="min_price"></span>
                      <input type="hidden">
                    </div>-
                    <div class="ui-range-value-max">{{PriceHelper::setCurrencySign()}}<span class="max_price"></span>
                      <input type="hidden">
                    </div>
                  </div>
                </div>
              </footer>
            </form>
          </section>
          @endif
          @if ($setting->is_attribute_search == 1)
          @foreach ($attrubutes as $attrubute)              
          <section class="widget widget-categories card rounded p-4">
            <h3 class="widget-title">{{ __('Filter by') }} {{$attrubute->name}}</h3>
            @foreach ($options as $option)
            @if ($attrubute->keyword == $option->attribute->keyword)
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input option" {{isset($subcategory) && $subcategory->id == $option->id ? 'checked' : ''}}   type="checkbox" value="{{$option->name}}" id="{{$attrubute->id}}{{$option->name}}">
              <label class="custom-control-label" for="{{$attrubute->id}}{{$option->name}}">{{$option->name}}<span class="text-muted"></span></label>
            </div>  
            @endif
            @endforeach
          </section>
          @endforeach
          @endif
          <section class="widget widget-categories card rounded p-4">
            <h3 class="widget-title">{{__('Filter by Brand')}}</h3>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input brand-select" type="checkbox" value="" id="all-brand">
              <label class="custom-control-label" for="all-brand">{{__('All Brands')}}</label>
            </div>
            @foreach ($brands as $getbrand)
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input brand-select" {{isset($brand) && $brand->id == $getbrand->id ? 'checked' : ''}} type="checkbox" value="{{$getbrand->slug}}" id="{{$getbrand->slug}}">
              <label class="custom-control-label" for="{{$getbrand->slug}}">{{$getbrand->name}}</label>
            </div>
            @endforeach
          </section>
        </aside>
      </div>
      -->
      --}}
    </div>
  </div>
</div>
<form id="search_form_specialofferproducts" class="d-none" action="{{route('front.getFilterSpecialOfferProducts')}}" method="GET">
  <input type="text" name="maxPrice" id="maxPrice" value="{{request()->input('maxPrice') ? request()->input('maxPrice') : ''}}">
  <input type="text" name="minPrice" id="minPrice" value="{{request()->input('minPrice') ? request()->input('minPrice') : ''}}">
  <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug : ''}}">
  <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug : ''}}">
  <input type="text" name="category" id="category" value="{{isset($category) ? $category->slug : ''}}">
  <input type="text" name="quick_filter" id="quick_filter" value="">
  <input type="text" name="childcategory" id="childcategory" value="{{isset($childcategory) ? $childcategory->slug : ''}}">
  <input type="text" name="page" id="page" value="{{isset($page) ? $page : ''}}">
  <input type="text" name="attribute" id="attribute" value="{{isset($attribute) ? $attribute : ''}}">
  <input type="text" name="option" id="option" value="{{isset($option) ? $option : ''}}">
  <input type="text" name="subcategory" id="subcategory" value="{{isset($subcategory) ? $subcategory->slug : ''}}">
  <input type="text" name="sorting" id="sorting" value="{{isset($sorting) ? $sorting : ''}}">
  <input type="text" name="view_check" id="view_check" value="{{isset($view_check) ? $view_check : ''}}">
  <button type="submit" id="search_button_specialofferproducts" class="d-none"></button>
</form>
<script type="text/javascript" src="{{asset('assets/front/js/specialofferproducts.js')}}"></script>
@endsection