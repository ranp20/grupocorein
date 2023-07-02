<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
@if (url()->current() == route('front.index'))
<title>@yield('hometitle')</title>
@else
<title>{{$setting->title}} -@yield('title')</title>
@endif
@yield('meta')
<meta name="author" content="{{$setting->title}}">
<meta name="distribution" content="web">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="icon" type="image/png" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets/images/'.$setting->favicon)}}">
@yield('styleplugins')
<link href="{{ asset('assets/front/css/color.php?primary_color=').str_replace('#','',$setting->primary_color) }}" rel="stylesheet">
<script type="text/javascript" src="{{asset('assets/front/js/modernizr.min.js')}}"></script>
@if (DB::table('languages')->where('is_default',1)->first()->rtl == 1)
    <!-- <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}"> -->
@endif
<style>
    {{$setting->custom_css}}
</style>
{{-- Google AdSense Start --}}
@if ($setting->is_google_adsense == '1')
    {!! $setting->google_adsense !!}
@endif
{{-- Google AdSense End --}}

{{-- Google AnalyTics Start --}}
@if ($setting->is_google_analytics == '1')
    {!! $setting->google_analytics !!}
@endif
{{-- Google AnalyTics End --}}

{{-- Facebook pixel  Start --}}
@if ($setting->is_facebook_pixel == '1')
    {!! $setting->facebook_pixel !!}
@endif
{{-- Facebook pixel End --}}

</head>
<body class="
@if($setting->theme == 'theme1')
body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4
@endif
">
@if ($setting->is_loader == 1)
<div id="preloader">
    <img src="{{ asset('assets/images/'.$setting->loader) }}" alt="{{ __('Loading...') }}" width="100" height="100" decoding="sync">
</div>
@endif
<link rel="preload" href="{{asset('assets/front/css/styles.min.css')}}" as="style">
<script rel="preload" href="{{asset('assets/front/js/plugins/jquery-3.6.4.min.js')}}" as="script"></script>
<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">
<script type="text/javascript" src="{{asset('assets/front/js/plugins/jquery-3.6.4.min.js')}}" as="script"></script>
@include('includes.apiwhatsappbutton')
<header class="site-header navbar-sticky">
    <div class="menu-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="t-m-s-a">
                        <div>
                            <a href="tel:016802680">
                                <i class="icon-phone-call"></i>
                                <span>(01) 493-6666 / (01) 382-7473</span>
                            </a>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <div class="topbar">
        <div class="container">
            <div class="row">
                @php                    
                    $getSessProdSearch = '';
                    $getPathCurrent = Request::path();
                    if($getPathCurrent == "/"){
                        $getSessProdSearch = '';
                    }else{
                        if(Session::has('searhproduct_user')){
                            $getSessProdSearch = Session::get('searhproduct_user');
                        }
                    }
                @endphp
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <div class="site-branding"><a class="site-logo align-self-center" href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}"></a></div>
                        <div class="search-box-wrap d-none d-lg-block d-flex">
                        <div class="search-box-inner align-self-center">
                            <div class="search-box d-flex">                               
                                <form class="input-group" id="header_search_form" action="{{route('front.catalog')}}" method="get">
                                    <input type="hidden" name="category" value="" id="search__category">
                                    <span class="input-group-btn">
                                        <button type="submit" title="Buscar..."><i class="icon-search"></i></button>
                                    </span>
                                    <input class="form-control" type="text" data-target="{{route('front.search.suggest')}}" autocomplete="off" spellcheck="false" id="__product__search" name="search" placeholder="{{__('Search by product name')}}" value="{{ $getSessProdSearch }}">
                                    <div class="serch-result d-none px-0 pb-0">
                                       {{-- search result --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div>
                        <div class="toolbar d-flex">
                        <div class="toolbar-item close-m-serch visible-on-mobile">
                            <a href="#">
                                <div>
                                    <i class="icon-search"></i>
                                </div>
                            </a>
                        </div>
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle">
                            <a href="#">
                                <div>
                                    <i class="icon-menu"></i>
                                    <span class="text-label">{{__('Menu')}}</span>
                                </div>
                            </a>
                        </div>
                            <div class="toolbar-item hidden-on-mobile d-flex align-items-center justify-content-center">
                                <a href="{{route('user.login')}}">
                                @if(!Auth::user())
                                    <div>
                                        <span class="compare-icon">
                                            <i class="icon-user"></i>
                                        </span>
                                        <span class="text-label">Ingreso/Registro</span>
                                    </div>
                                </a>                                
                                @else
                                <div class="t-h-dropdown mx-0 link-a-menu-login">
                                    <div class="main-link d-flex align-items-center flex-column">
                                        <i class="icon-user pr-2"></i> <span class="text-label">{{Auth::user()->first_name}}</span>
                                    </div>
                                    <div class="t-h-dropdown-menu">
                                        <a href="{{route('user.dashboard')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                        <a href="{{route('user.logout')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('fornt.compare.index')}}">
                            <div><span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span><span class="text-label">{{ __('Compare') }}</span></div>
                            </a>
                        </div>
                        @if(Auth::check())
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                            <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count">{{Auth::user()->wishlists->count()}}</span></span><span class="text-label">{{__('Wishlist')}}</span></div>
                            </a>
                        </div>
                        @else
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                          <div><span class="compare-icon"><i class="icon-heart"></i></span><span class="text-label">{{__('Wishlist')}}</span></div>
                          </a>
                      </div>
                        @endif
                        <div class="toolbar-item"><a href="{{route('front.cart')}}">
                            <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count">{{Session::has('cart') ? count(Session::get('cart')) : '0'}} </span></span><span class="text-label">{{ __('Cart') }}</span></div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="{{route('front.header.cart')}}">
                            @include('includes.header_cart')
                            </div>
                        </div>
                        </div>
                        <div class="mobile-menu">
                            <div class="mm-heading-area">
                                <h4>{{ __('Navigation') }}</h4>
                                <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                    <a href="#">
                                        <div><i class="icon-x"></i></div>
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation99">
                                  <span class="active" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu"  role="tab" aria-controls="mmenu" aria-selected="true">{{ __('Menu') }}</span>
                                </li>
                                <li class="nav-item" role="presentation99">
                                  <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat"  role="tab" aria-controls="mcat" aria-selected="false">{{ __('Category') }}</span>
                                </li>
                              </ul>
                              <div class="tab-content p-0" >
                                <div class="tab-pane fade show active" id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                                    <nav class="slideable-menu">
                                        <ul>
                                            <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}"><i class="icon-chevron-right"></i>{{__('Home')}}</a></li>
                                            @if ($setting->is_shop == 1)
                                            <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}"><i class="icon-chevron-right"></i>{{__('Shop')}}</a></li>
                                            @endif
                                            {{--
                                            <!--
                                            @if ($setting->is_campaign == 1)
                                            <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}"><i class="icon-chevron-right"></i>Promociones</a></li>
                                            @endif
                                            -->
                                            --}}
                                            <li class="{{ request()->routeIs('front.onsaleproducts')  ? 'active' : '' }}"><a href="{{route('front.onsaleproducts')}}"><i class="icon-chevron-right"></i>{{__('Promotions')}}</a></li>
                                            <li class="{{ request()->routeIs('front.specialoffer')  ? 'active' : '' }}"><a href="{{route('front.specialoffer')}}"><i class="icon-chevron-right"></i>{{__('Special offers')}}</a></li>
                                            @if ($setting->is_brands == 1)
                                            <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }}"><a href="{{route('front.brand')}}"><i class="icon-chevron-right"></i>{{__('Brand')}}</a></li>
                                            @endif
                                            @if ($setting->is_blog == 1)
                                            <!-- <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}"><i class="icon-chevron-right"></i>{{__('Blog')}}</a></li> -->
                                            @endif
                                            @if ($setting->is_faq == 1)
                                            <li><a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}" href="{{route('front.faq')}}"><i class="icon-chevron-right pr-2"></i>Catálogo</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                                <div class="tab-pane fade" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                                    <nav class="slideable-menu">
                                        @include('includes.mobile-category')
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar theme-total">
        <div class="container">
            <div class="row g-3 w-100">
                <div class="col-lg-3 d-flex align-items-center justify-content-flex-start cLCategs">
                    @include('includes.categories')
                </div>
                <div class="col-lg-9 d-flex justify-content-between cGrpOptsNav">
                    <div class="row g-3 w-100 cGrpOptsNav__c">
                        <div class="col-lg-8 cGrpOptsNav__c__cLTabLinks">
                            <div class="nav-inner">
                                <nav class="site-menu">
                                    <ul>
                                        <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                                        @if ($setting->is_shop == 1)
                                        <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}">{{__('Shop')}}</a></li>
                                        @endif
                                        {{--
                                        <!--
                                        @if ($setting->is_campaign == 1)
                                        <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}">Promociones</a></li>
                                        @endif
                                        -->
                                        --}}
                                        <li class="{{ request()->routeIs('front.onsaleproducts')  ? 'active' : '' }}"><a href="{{route('front.onsaleproducts')}}">{{__('Promotions')}}</a></li>
                                        <li class="{{ request()->routeIs('front.specialoffer')  ? 'active' : '' }}"><a href="{{route('front.specialoffer')}}">{{__('Special offers')}}</a></li>
                                        @if ($setting->is_brands == 1)
                                        <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }}"><a href="{{route('front.brand')}}">{{__('Brands')}}</a></li>
                                        @endif
                                        @if ($setting->is_blog == 1)
                                        <!-- <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}">{{__('Blog')}}</a></li> -->
                                        @endif                                        
                                        @if ($setting->is_faq == 1)
                                        <li><a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}" href="{{route('front.faq')}}">Catálogo</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-4 cGrpOptsNav__c__cSchdule">
                            <div class="row g-3 w-100 cGrpOptsNav__c__cSchdule__c">
                                <div class="col-lg-6 cGrpOptsNav__c__cSchdule__c__i">
                                    <span class=""><strong>Lunes - Viernes</strong></span><br>
                                    <span>{{$setting->friday_start}} - {{$setting->friday_end}}</span>
                                </div>
                                <div class="col-lg-6 cGrpOptsNav__c__cSchdule__c__i">
                                    <span class=""><strong>Sábado</strong></span><br>
                                    <span>{{$setting->satureday_start}} - {{$setting->satureday_end}}</span>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@yield('content')
<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
    @if ($setting->announcement_type == 'newletter')
    <div class="announcement-with-content">
        <div class="left-area">
            <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
        </div>
        <div class="right-area">
            <h3 class="">{{  $setting->announcement_title }}</h3>
            <p>{{ $setting->announcement_details }}</p>
            <form class="subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="Su Correo">
                    <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                </div>
                <button class="btn btn-primary btn-block mt-2" type="submit">
                    <span>{{__('Subscribe')}}</span>
                </button>
            </form>
        </div>
    </div>
    @else
    <a href="{{ $setting->announcement_link }}">
        <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
    </a>
    @endif
</div>
<section class="service-section" style="padding: 0px;">
    <div class="container" style="border: 1px solid #003399;border-radius: 10px;margin-bottom: 25px;">
        <div class="row">
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="{{route('front.index')}}/assets/images/1669243396carro.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Envío a domicilio</h6>
                        <p class="text-sm text-muted mb-0">Recíbelo donde tu quieras</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="{{route('front.index')}}/assets/images/1669243349tienda.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Retiro en tienda</h6>
                        <p class="text-sm text-muted mb-0">Compra online y ahorra en el envío</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="{{route('front.index')}}/assets/images/1669244306mapa.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Nuestras tiendas</h6>
                        <p class="text-sm text-muted mb-0">Conoce todas nuestras tiendas</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="{{route('front.index')}}/assets/images/1669243456telefono.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Servicio al Cliente</h6>
                        <p class="text-sm text-muted mb-0"><a href="{{route('front.index')}}/contact" style="color:#000;text-decoration: underline !important;">Estamos para atenderte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <section class="widget widget-light-skin">
            <h3 class="widget-title">{{__('Get In Touch')}}</h3>
            <p class="mb-1"><strong>{{__('Address')}}: </strong> {{$setting->footer_address}}</p>
            <p class="mb-1"><strong>{{__('Phone')}}: </strong> {{$setting->footer_phone}}</p>
            <p class="mb-3"><strong>{{__('Email')}}: </strong> {{$setting->footer_email}}</p>
            <ul class="list-unstyled text-sm">
                <li>
                    <span class=""><strong>{{__('Monday-Friday')}}: </strong></span>
                    <span>{{$setting->friday_start}} - {{$setting->friday_end}}</span>
                </li>
                <li>
                    <span class=""><strong>{{__('Saturday')}}: </strong></span>
                    <span>{{$setting->satureday_start}} - {{$setting->satureday_end}}</span>
                </li>
            </ul>
            @php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];
          @endphp
            <div class="footer-social-links">
                @foreach ($links as $link_key => $link)
                <a href="{{$link}}"><span><i class="{{$icons[$link_key]}}"></i></span></a>
                @endforeach
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title">{{__('Usefull Links')}}</h3>
            <ul>
               @if ($setting->is_contact == 1)
                <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}"><a href="{{route('front.contact')}}">{{__('Contact')}}</a></li>
                @endif
                @foreach (DB::table('pages')->wherePos(2)->orwhere('pos',1)->get() as $page)
                <li><a href="{{route('front.page',$page->slug)}}">{{$page->title}}</a></li>
                @endforeach
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
            <section class="widget">
                <h3 class="widget-title">{{__('Newsletter')}}</h3>
                <form class="row subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                    @csrf
                    <div class="col-sm-12">
                    <div class="input-group">
                        <input class="form-control" type="email" name="email" placeholder="Su correo">
                        <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                    <div aria-hidden="true">
                        <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                    </div>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-block mt-2" type="submit">
                            <span>{{__('Subscribe')}}</span>
                        </button>
                    </div>
                    <div class="col-lg-12">
                        <p class="text-sm opacity-80 pt-2">{{__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')}}</p>
                    </div>
                </form>
                <div class="pt-3">
                    <img class="d-block gateway_image" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}" alt="credit-card_list" width="100" height="100" decoding="sync">
                </div>
            </section>
          </div>
      </div>
      <p class="footer-copyright"> {{$setting->copy_right}}</p>
    </div>
</footer>
<a class="scroll-to-top-btn" href="#">
    <i class="icon-chevron-up"></i>
</a>
<div class="site-backdrop"></div>
@if ($setting->is_cookie == 1)
@include('cookieConsent::index')
@endif
@php
    $mainbs = [];
    $mainbs['is_announcement'] = $setting->is_announcement;
    $mainbs['announcement_delay'] = $setting->announcement_delay;
    $mainbs['overlay'] = $setting->overlay;
    $mainbs = json_encode($mainbs);
@endphp
<script>
    var mainbs = {!! $mainbs !!};
    var decimal_separator = '{!! $setting->decimal_separator !!}';
    var thousand_separator = '{!! $setting->thousand_separator !!}';
</script>
<script>
    let language = {
        Days : "{{__('Days')}}",
        Hrs : "{{__('Hrs')}}",
        Min : "{{__('Min')}}",
        Sec : "{{__('Sec')}}",
    }
</script>
<script type="text/javascript" src="{{asset('assets/front/js/plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/scripts.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/myscript.js')}}"></script>
@yield('script')
@if($setting->is_facebook_messenger	== '1')
 {!!  $setting->facebook_messenger !!}
@endif
<script type="text/javascript">
    let mainurl = "{{route('front.index')}}";
    let view_extra_index = 0;
      // Notifications
      function SuccessNotification(title){
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
                },{
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title){
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
                },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>
    @if(Session::has('error'))
    <script>
      $(document).ready(function(){
        DangerNotification('{{Session::get('error')}}')
      });
    </script>
    @endif
    @if(Session::has('success'))
    <script>
      $(document).ready(function(){
        SuccessNotification('{{Session::get('success')}}');
      });
    </script>
    @endif
</body>
</html>