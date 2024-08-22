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
  {{__('Stores')}}
@endsection
@section('content')
<div class="page-title mb-0 brbttm_Theme-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{ __('Home') }}</a> </li>
          <li class="separator"></li>
          <li>{{ __('Stores') }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="c-bgTheme-2 pt-4 pb-5 mb-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 class="h3">{{__('Stores')}}</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <p class="text"></p>
        <div class="tab">
          <button class="tablinks" onclick="openTab(event, 'coding', 'arrow1')" id="defaultOpen">
            <img src="{{ asset('assets/images/1669243349tienda.png') }}">
            <span>Av. Guillermo  Dansey N°401 C.Plaza ferretero  2do  psj C  Piso Tda 2026 - Lima.</span>
            <span id="arrow1" class="arrow fas fa-caret-right"></span>
          </button>
          <button class="tablinks" onclick="openTab(event, 'wordPress', 'arrow2')">
            <img src="{{ asset('assets/images/1669243349tienda.png') }}">
            <span>AV. Guillermo Dansey n° 454 C. Comercial Nicolini Psj 5 Stand BB-9A - Lima.</span>
            <span id="arrow1" class="arrow fas fa-caret-right"></span>
          </button>
        </div>
        <div id="coding" class="tabcontent">
          <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15607.907343172143!2d-77.0450926!3d-12.0451147!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6295b8295e8e7a78!2zQ09SRUlOSk0gUy4g0JAuINChLg!5e0!3m2!1ses-419!2spe!4v1669766173402!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div id="wordPress" class="tabcontent">
          <p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243.87347497421544!2d-77.04503715083902!3d-12.0451997695408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c95cf36fb7b3%3A0x795ce3f560c0f791!2sComercial%20Ferretera%20Quintana%20Nicolini!5e0!3m2!1ses!2spe!4v1724344261531!5m2!1ses!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </p>
        </div>
      </div>  
    </div>
  </div> 
</div>
<script type="text/javascript" src="{{asset('assets/front/js/contact.min.js')}}"></script>
<script>
function openTab(evt, Services, arrows){
  console.log(arrows);
  console.log(Services);
  var i, tabcontent, tablinks, tabArrow;
  tabcontent = document.getElementsByClassName("tabcontent");
  tabArrow = document.getElementsByClassName("arrow");
  tablinks = document.getElementsByClassName("tablinks");
  for(i = 0; i < tabcontent.length; i++){
    tabcontent[i].style.display = "none";
  }
  for(i = 0; i < tabArrow.length; i++){
    tabArrow[i].style.display = "none";
  }
  for(i = 0; i < tablinks.length; i++){
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  // document.getElementById(arrows).style.display = "block";
  document.getElementById(Services).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
@endsection