@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
  {{__('Brand')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{(route('front.index'))}}">{{__('Home')}}</a></li>
          <li class="separator">&nbsp;</li>
          <li>{{__('Brand')}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php                  
  $AllbrandsList = DB::table('brands')->select('name','slug','photo','status')->get()->toArray();
  $brandGroups = [];
  function sanitizeLetter2($letter){
    return is_numeric($letter) ? '#' : $letter;
  }
  foreach ($AllbrandsList as $brand){
    $firstLetter = strtoupper(substr($brand->name, 0, 1));
    $groupName = is_numeric($firstLetter) ? '#' : $firstLetter;
    // $groupName = $firstLetter;
    if (!isset($brandGroups[$groupName])){
      $brandGroups[$groupName] = [];
    }      
    $brandGroups[$groupName][] = $brand;
  }
  $availableLetters = array_keys($brandGroups);
  $alphabetLetters = range('A', 'Z');
  $allLetters = array_unique(array_merge($availableLetters, $alphabetLetters));
  $filteredLetters = array_map('sanitizeLetter2', $allLetters);
  sort($filteredLetters);

  // echo "<pre>";
  // print_r($filteredLetters);
  // echo "</pre>";

?>
<div class="container pt-0 pb-5 ctSec-Brand">
  <div class="row">
    <div class="col-lg-12">
      <div class="shop-top-filter-wrapper">
        <div class="row">
          <div class="col-md-10 gd-text-sm-center">
            <div class="sptfl">
              <div class="shop-sorting">
                <label for="sorting">{{__('Sort by')}}:</label>
                <select class="form-control" id="sorting_brandsletter">
                  <option value="">{{__('All Brands')}}</option>
                  @foreach($filteredLetters as $letter)
                    @if(in_array($letter, $availableLetters))
                      @php
                        $iptSelecLetter = 'letter-'.$letter;
                      @endphp
                      <option value="{{ $iptSelecLetter }}" {{request()->input($iptSelecLetter) ? 'selected' : ''}}>{{ $letter }}</option>
                    @endif
                  @endforeach
                </select>
                <span class="text-muted">{{__('Showing')}}:</span>
                <span>1 - {{$setting->view_product}} {{__('items')}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row g-3 ctSec-Brand__c">

    <div class="row g-3 ctSec-Brand__c" id="list_view_ajax">
      @include('front.brands.filter')
    </div>
    <form id="search_form_marcas" class="d-none" action="{{route('front.getBrandsByLetter')}}" method="GET">
      <input type="text" name="page" id="page" value="{{isset($page) ? $page : ''}}">
      <input type="text" name="sorting_brandletter" id="sorting_brandletter" value="{{isset($sorting_brandletter) ? $sorting_brandletter : ''}}">
      <button type="submit" id="search_button_marcas" class="d-none"></button>
    </form>
  </div>
</div>
<script type="text/javascript" src="{{asset('assets/front/js/brands.js')}}"></script>
@endsection