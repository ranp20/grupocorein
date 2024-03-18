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
  {{__('Contact')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{ __('Home') }}</a> </li>
          <li class="separator"></li>
          <li>{{ __('Contact Us') }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
  <div class="container padding-bottom-3x mb-1 contact-page">
    <div class="row">
      <div class="col-lg-4 col-md-5 col-sm-5 order-lg-1 order-md-2 order-sm-2">
        <section class="widget widget-featured-posts card rounded p-4 ">
          <h3 class="widget-title">{{__('Working Days')}}</h3>
          <ul class="list-unstyled text-sm">
            <li><span class="text-muted">{{__('Monday-Friday')}}:</span>{{$setting->friday_start}} - {{$setting->friday_end}}</li>
            <li><span class="text-muted">{{__('Saturday')}}:</span>{{$setting->satureday_start}} - {{$setting->satureday_end}}</li>
          </ul>          
        </section>
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title">{{__('Store address')}}</h3>
          <p>{{__('Our address information')}}</p>
          <ul class="list-icon margin-bottom-1x">
            <li><i class="icon-map-pin text-muted"></i>{{$setting->footer_address}}</li>
            <li><i class="icon-phone text-muted"></i>{{formatPhone($setting->footer_phone)}}</li>
          </ul>
          @php
          $links = json_decode($setting->social_link,true)['links'];
          $icons = json_decode($setting->social_link,true)['icons'];
          @endphp
          <div>
            @foreach ($links as $link_key => $link)
            <a class="social-button shape-circle sb-facebook" href="{{$link}}" data-toggle="tooltip" data-placement="top"><i class="{{$icons[$link_key]}}"></i></a>
            @endforeach
          </div>
        </section>
      </div>
      <div class="col-lg-8 col-md-7 col-sm-7 order-lg-2 order-md-1 order-sm-1">
        <div class="contact-form-box card">
          <h2 class="h4">{{ __('Tell Us Your Message :') }}</h2>
          <form class="row mt-2" method="Post" action="{{route('front.contact.submit')}}">
            @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label for="first-name">{{__('First Name')}}</label>
                <input class="form-control form-control-rounded" name="first_name" type="text" id="first-name" placeholder="{{__('First Name')}}" >
                @error('first_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="last-name">{{__('Last Name')}}</label>
                <input class="form-control form-control-rounded" name="last_name" type="text" id="last-name" placeholder="{{__('Last Name')}}" >
                @error('last_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contact-email">{{__('E-mail')}}</label>
                <input class="form-control form-control-rounded" type="email" name="email" id="contact-email" placeholder="{{__('E-mail')}}" >
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contact-tel">{{__('Phone')}}</label>
                <input class="form-control form-control-rounded" type="text" name="phone" id="contact-tel" placeholder="{{__('Phone')}}" data-valformat="withspacesforthreenumbers" maxlength="11">
                @error('phone')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-12  ">
              <div class="form-group">
                <label for="message-text">{{__('Message')}}</label>
                <textarea class="form-control form-control-rounded" rows="9" name="message" id="message-text" placeholder="{{__('Write your message here...')}}"></textarea>
                @error('message')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            @if ($setting->recaptcha == 1)
            <div class="col-lg-12 mb-4">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                @php
                    $errmsg = $errors->first('g-recaptcha-response');
                @endphp
                <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                @endif
            </div>
            @endif
            <div class="col-12 text-right">
              <button class="btn btn-primary" type="submit"><span>{{ __('Send message') }}</span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
 <div class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-lg-12"> 
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="container">
                  <p class = "text"></p>
                  <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'coding', 'arrow1')" id="defaultOpen">
                      <img src="https://grupopdg.com/web/assets/images/1669243349tienda.png">  Av. Guillermo  Dansey N°401 C.Plaza ferretero  2do  psj C  Piso Tda 2026 - Lima.
                      <span id="arrow1" class="arrow fas fa-caret-right"></span>
                    </button>
                    <button class="tablinks" onclick="openTab(event, 'wordPress', 'arrow2')">
                      <img src="https://grupopdg.com/web/assets/images/1669243349tienda.png">  AV. Guillermo Dansey n° 454 C. Comercial Nicolini Psj 5 Stand BB-9A - Lima.
                      <span id="arrow1" class="arrow fas fa-caret-right"></span>
                    </button>
                  </div>
                  <div id="coding" class="tabcontent">
                    <p>
                      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15607.907343172143!2d-77.0450926!3d-12.0451147!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6295b8295e8e7a78!2zQ09SRUlOSk0gUy4g0JAuINChLg!5e0!3m2!1ses-419!2spe!4v1669766173402!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </p>
                  </div>
                  <div id="wordPress" class="tabcontent">
                    <p>
                      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15607.902710465167!2d-77.0444584!3d-12.0451944!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4064839cd20cd011!2sCOREIN%20GROUP%20SAC!5e0!3m2!1ses-419!2spe!4v1669765979814!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div> 
  </div>
<script type="text/javascript" src="{{asset('assets/front/js/contact.min.js')}}"></script>
<script>
function openTab(evt, Services, arrows) {
  var i, tabcontent, tablinks, tabArrow;
  tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tabArrow = document.getElementsByClassName("arrow");
    for (i = 0; i < tabArrow.length; i++) {
    tabArrow[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(arrows).style.display = "block";
  document.getElementById(Services).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
@endsection