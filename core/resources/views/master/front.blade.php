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
                                    <input class="form-control" type="text" data-target="{{route('front.search.suggest')}}" autocomplete="off" spellcheck="false" id="__product__search" name="search" placeholder="{{__('Search')}}" value="{{ $getSessProdSearch }}">
                                    <div class="serch-result d-none px-0 pb-0">{{-- search result --}}</div>
                                </form>
                            </div>
                        </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div>
                        <div class="toolbar d-flex">
                        <div class="toolbar-item close-m-serch visible-on-mobile">
                            <a href="javascript:void(0);">
                                <div>
                                    <i class="icon-search"></i>
                                </div>
                            </a>
                        </div>
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle">
                            <a href="javascript:void(0);">
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
                                    <a href="javascript:void(0);">
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
                                        <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }} allbrands_menulist">
                                            <a href="{{route('front.brand')}}" class="allbrands-menu-item" data-dropdown-custommenu="brands-menu">{{__('Brands')}}</a>
                                            <div class="allbrands-list-popup" data-allbrands-js="brands-popup">
                                                <div class="allbrands-list-container">
                                                    <div class="allbrands-letters-filter">
                                                        <a href="https://www.promelsa.com.pe/marcas/" class="allbrands-letter -letter-all -active" title="Todas las marcas">Todas las marcas</a>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-A">A</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-B">B</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-C">C</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-D">D</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-E">E</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-F">F</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-G">G</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-H">H</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-I">I</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-J">J</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-K">K</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-L">L</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-M">M</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-N">N</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-O">O</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-P">P</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter -disabled">Q</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-R">R</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-S">S</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-T">T</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-U">U</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-V">V</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-W">W</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter -disabled">X</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter -disabled">Y</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter -disabled">Z</button>
                                                        <button data-allbrands-js="popup-filter-letter" class="allbrands-letter letter-#">#</button>
                                                    </div>
                                                    <div class="allbrands-popup-items">
                                                        <section class="allbrands-letters-list">
                                                            <div class="allbrands-letter letter-#" data-allbrands-js="popup-brand-letter">
                                                                <span class="allbrands-title">#</span>
                                                                <div class="allbrands-content">
                                                                    <div class="allbrands-brand-item -no-logo">
                                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/3m" class="allbrands-inner" title="3M">
                                                                            <span class="allbrands-label">3M</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                            <div class="allbrands-letter letter-A" data-allbrands-js="popup-brand-letter">
                                                                <span class="allbrands-title">A</span>
                                                                <div class="allbrands-content">
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/abb" class="allbrands-inner" title="ABB">
                                                                        <span class="allbrands-label">ABB</span>
                                                                    </a>
                                                                </div>
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/amprobe" class="allbrands-inner" title="AMPROBE">
                                                                        <span class="allbrands-label">AMPROBE</span>
                                                                    </a>
                                                                </div>
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/anako" class="allbrands-inner" title="ANAKO">
                                                                        <span class="allbrands-label">ANAKO</span>
                                                                    </a>
                                                                </div>
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/apc_fittings" class="allbrands-inner" title="APC FITTINGS">
                                                                        <span class="allbrands-label">APC FITTINGS</span>
                                                                    </a>
                                                                </div>
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/ardy" class="allbrands-inner" title="ARDY">
                                                                        <span class="allbrands-label">ARDY</span>
                                                                    </a>
                                                                </div>
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/ares" class="allbrands-inner" title="ARES">
                                                                        <span class="allbrands-label">ARES</span>
                                                                    </a>
                                                                </div>
                                                                <div class="allbrands-brand-item -no-logo">
                                                                    <a href="https://www.promelsa.com.pe/todas-las-marcas/aristoncavi" class="allbrands-inner" title="ARISTONCAVI">
                                                                        <span class="allbrands-label">ARISTONCAVI</span>
                                                                    </a>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-B" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">B</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/baldor" class="allbrands-inner" title="BALDOR">
                                                                <span class="allbrands-label">
                                                        BALDOR                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/basf_engelhard" class="allbrands-inner" title="BASF/ENGELHARD">
                                                                <span class="allbrands-label">
                                                        BASF/ENGELHARD                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/basor" class="allbrands-inner" title="BASOR">
                                                                <span class="allbrands-label">
                                                        BASOR                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/bhartia" class="allbrands-inner" title="BHARTIA">
                                                                <span class="allbrands-label">
                                                        BHARTIA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/bremas" class="allbrands-inner" title="BREMAS">
                                                                <span class="allbrands-label">
                                                        BREMAS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/bticino" class="allbrands-inner" title="BTICINO">
                                                                <span class="allbrands-label">
                                                        BTICINO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/burndy" class="allbrands-inner" title="BURNDY">
                                                                <span class="allbrands-label">
                                                        BURNDY                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-C" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">C</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cablofil" class="allbrands-inner" title="CABLOFIL">
                                                                <span class="allbrands-label">
                                                        CABLOFIL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cadweld" class="allbrands-inner" title="CADWELD">
                                                                <span class="allbrands-label">
                                                        CADWELD                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/capt" class="allbrands-inner" title="CAPT">
                                                                <span class="allbrands-label">
                                                        CAPT                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cargill" class="allbrands-inner" title="CARGILL">
                                                                <span class="allbrands-label">
                                                        CARGILL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/carlon" class="allbrands-inner" title="CARLON">
                                                                <span class="allbrands-label">
                                                        CARLON                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/catu" class="allbrands-inner" title="CATU">
                                                                <span class="allbrands-label">
                                                        CATU                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/chemsearch" class="allbrands-inner" title="CHEMSEARCH">
                                                                <span class="allbrands-label">
                                                        CHEMSEARCH                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/coel" class="allbrands-inner" title="COEL">
                                                                <span class="allbrands-label">
                                                        COEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/colmena" class="allbrands-inner" title="COLMENA CONDUIT">
                                                                <span class="allbrands-label">
                                                        COLMENA CONDUIT                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/comar" class="allbrands-inner" title="COMAR">
                                                                <span class="allbrands-label">
                                                        COMAR                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/comem" class="allbrands-inner" title="COMEM">
                                                                <span class="allbrands-label">
                                                        COMEM                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/conducrete" class="allbrands-inner" title="CONDUCRETE">
                                                                <span class="allbrands-label">
                                                        CONDUCRETE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/conexel" class="allbrands-inner" title="CONEXEL">
                                                                <span class="allbrands-label">
                                                        CONEXEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/connectwell" class="allbrands-inner" title="CONNECTWELL">
                                                                <span class="allbrands-label">
                                                        CONNECTWELL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/control_switchgear" class="allbrands-inner" title="CONTROL SWITCHGEAR">
                                                                <span class="allbrands-label">
                                                        CONTROL SWITCHGEAR                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cooper_b_line" class="allbrands-inner" title="COOPER B-LINE">
                                                                <span class="allbrands-label">
                                                        COOPER B-LINE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cooper_bussman" class="allbrands-inner" title="COOPER BUSSMAN">
                                                                <span class="allbrands-label">
                                                        COOPER BUSSMAN                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cooper_power" class="allbrands-inner" title="COOPER POWER">
                                                                <span class="allbrands-label">
                                                        COOPER POWER                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/copperclad" class="allbrands-inner" title="COPPERCLAD">
                                                                <span class="allbrands-label">
                                                        COPPERCLAD                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/copperpro" class="allbrands-inner" title="COPPERPRO">
                                                                <span class="allbrands-label">
                                                        COPPERPRO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/coppersteel" class="allbrands-inner" title="COPPERSTEEL">
                                                                <span class="allbrands-label">
                                                        COPPERSTEEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/crouse_hinds" class="allbrands-inner" title="CROUSE HINDS">
                                                                <span class="allbrands-label">
                                                        CROUSE HINDS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/cz_ex" class="allbrands-inner" title="CZ-EX">
                                                                <span class="allbrands-label">
                                                        CZ-EX                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-D" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">D</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/delga" class="allbrands-inner" title="DELGA">
                                                                <span class="allbrands-label">
                                                        DELGA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/derancourt" class="allbrands-inner" title="DERANCOURT">
                                                                <span class="allbrands-label">
                                                        DERANCOURT                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/df" class="allbrands-inner" title="DF">
                                                                <span class="allbrands-label">
                                                        DF                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-E" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">E</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/e_f" class="allbrands-inner" title="E.F.">
                                                                <span class="allbrands-label">
                                                        E.F.                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/elster" class="allbrands-inner" title="ELSTER">
                                                                <span class="allbrands-label">
                                                        ELSTER                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/erico" class="allbrands-inner" title="ERICO">
                                                                <span class="allbrands-label">
                                                        ERICO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/ermco" class="allbrands-inner" title="ERMCO">
                                                                <span class="allbrands-label">
                                                        ERMCO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/esitas" class="allbrands-inner" title="ESITAS">
                                                                <span class="allbrands-label">
                                                        ESITAS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/eti" class="allbrands-inner" title="ETI">
                                                                <span class="allbrands-label">
                                                        ETI                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/extech" class="allbrands-inner" title="EXTECH">
                                                                <span class="allbrands-label">
                                                        EXTECH                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-F" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">F</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/fanox" class="allbrands-inner" title="FANOX">
                                                                <span class="allbrands-label">
                                                        FANOX                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/finder" class="allbrands-inner" title="FINDER">
                                                                <span class="allbrands-label">
                                                        FINDER                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/flir" class="allbrands-inner" title="FLIR">
                                                                <span class="allbrands-label">
                                                        FLIR                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-G" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">G</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/gala" class="allbrands-inner" title="GALA">
                                                                <span class="allbrands-label">
                                                        GALA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/general_cable" class="allbrands-inner" title="GENERAL CABLE">
                                                                <span class="allbrands-label">
                                                        GENERAL CABLE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/general_electric" class="allbrands-inner" title="GENERAL ELECTRIC">
                                                                <span class="allbrands-label">
                                                        GENERAL ELECTRIC                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/gewiss" class="allbrands-inner" title="GEWISS">
                                                                <span class="allbrands-label">
                                                        GEWISS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/gqele" class="allbrands-inner" title="GQELE">
                                                                <span class="allbrands-label">
                                                        GQELE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/grasslin" class="allbrands-inner" title="GRASSLIN">
                                                                <span class="allbrands-label">
                                                        GRASSLIN                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-H" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">H</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/haenke" class="allbrands-inner" title="HAENKE">
                                                                <span class="allbrands-label">
                                                        HAENKE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/hastings" class="allbrands-inner" title="HASTINGS">
                                                                <span class="allbrands-label">
                                                        HASTINGS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/hellermanntyton" class="allbrands-inner" title="HELLERMANNTYTON">
                                                                <span class="allbrands-label">
                                                        HELLERMANNTYTON                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/helukabel" class="allbrands-inner" title="HELUKABEL">
                                                                <span class="allbrands-label">
                                                        HELUKABEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/hex" class="allbrands-inner" title="HEX">
                                                                <span class="allbrands-label">
                                                        HEX                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/hioki" class="allbrands-inner" title="HIOKI">
                                                                <span class="allbrands-label">
                                                        HIOKI                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/hollingsworth" class="allbrands-inner" title="HOLLINGSWORTH">
                                                                <span class="allbrands-label">
                                                        HOLLINGSWORTH                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-I" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">I</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/icet" class="allbrands-inner" title="ICET">
                                                                <span class="allbrands-label">
                                                        ICET                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/inael" class="allbrands-inner" title="INAEL">
                                                                <span class="allbrands-label">
                                                        INAEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/indeco" class="allbrands-inner" title="INDECO">
                                                                <span class="allbrands-label">
                                                        INDECO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/intelli" class="allbrands-inner" title="INTELLI">
                                                                <span class="allbrands-label">
                                                        INTELLI                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/inter_teknik" class="allbrands-inner" title="INTER-TEKNIK">
                                                                <span class="allbrands-label">
                                                        INTER-TEKNIK                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/italian_cable_company" class="allbrands-inner" title="ITALIAN CABLE COMPANY">
                                                                <span class="allbrands-label">
                                                        ITALIAN CABLE COMPANY                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-J" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">J</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/jean_muller" class="allbrands-inner" title="JEAN MULLER">
                                                                <span class="allbrands-label">
                                                        JEAN MULLER                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/jng" class="allbrands-inner" title="JNG">
                                                                <span class="allbrands-label">
                                                        JNG                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-K" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">K</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/kap" class="allbrands-inner" title="KAP">
                                                                <span class="allbrands-label">
                                                        KAP                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/kcl" class="allbrands-inner" title="KCL">
                                                                <span class="allbrands-label">
                                                        KCL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/kess" class="allbrands-inner" title="KESS">
                                                                <span class="allbrands-label">
                                                        KESS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/kurt_haufe" class="allbrands-inner" title="KURT HAUFE">
                                                                <span class="allbrands-label">
                                                        KURT HAUFE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-L" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">L</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/ledvance" class="allbrands-inner" title="LEDVANCE">
                                                                <span class="allbrands-label">
                                                        LEDVANCE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/legrand" class="allbrands-inner" title="LEGRAND">
                                                                <span class="allbrands-label">
                                                        LEGRAND                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/leviton" class="allbrands-inner" title="LEVITON">
                                                                <span class="allbrands-label">
                                                        LEVITON                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/liat" class="allbrands-inner" title="LIAT">
                                                                <span class="allbrands-label">
                                                        LIAT                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/lifasa" class="allbrands-inner" title="LIFASA">
                                                                <span class="allbrands-label">
                                                        LIFASA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/linkwell" class="allbrands-inner" title="LINKWELL">
                                                                <span class="allbrands-label">
                                                        LINKWELL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/longxiang" class="allbrands-inner" title="LONGXIANG">
                                                                <span class="allbrands-label">
                                                        LONGXIANG                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-M" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">M</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/maclean" class="allbrands-inner" title="MACLEAN">
                                                                <span class="allbrands-label">
                                                        MACLEAN                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/macroled" class="allbrands-inner" title="MACROLED">
                                                                <span class="allbrands-label">
                                                        MACROLED                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/matsu" class="allbrands-inner" title="MATSU">
                                                                <span class="allbrands-label">
                                                        MATSU                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/megabras" class="allbrands-inner" title="MEGABRAS">
                                                                <span class="allbrands-label">
                                                        MEGABRAS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/metal_coraza" class="allbrands-inner" title="METAL CORAZA">
                                                                <span class="allbrands-label">
                                                        METAL CORAZA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/metelsa" class="allbrands-inner" title="METELSA">
                                                                <span class="allbrands-label">
                                                        METELSA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/miguelez" class="allbrands-inner" title="MIGUELEZ">
                                                                <span class="allbrands-label">
                                                        MIGUELEZ                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/milwaukee" class="allbrands-inner" title="MILWAUKEE">
                                                                <span class="allbrands-label">
                                                        MILWAUKEE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-N" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">N</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/naci_com" class="allbrands-inner" title="NACI_COM">
                                                                <span class="allbrands-label">
                                                        NACI_COM                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/njz_lighting" class="allbrands-inner" title="NJZ LIGHTING">
                                                                <span class="allbrands-label">
                                                        NJZ LIGHTING                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-O" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">O</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/ocal_blue" class="allbrands-inner" title="OCAL BLUE">
                                                                <span class="allbrands-label">
                                                        OCAL BLUE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/osram" class="allbrands-inner" title="OSRAM">
                                                                <span class="allbrands-label">
                                                        OSRAM                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-P" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">P</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/pavco" class="allbrands-inner" title="PAVCO">
                                                                <span class="allbrands-label">
                                                        PAVCO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/philips" class="allbrands-inner" title="PHILIPS">
                                                                <span class="allbrands-label">
                                                        PHILIPS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/plastica" class="allbrands-inner" title="PLASTICA">
                                                                <span class="allbrands-label">
                                                        PLASTICA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/plus_rite" class="allbrands-inner" title="PLUS RITE">
                                                                <span class="allbrands-label">
                                                        PLUS RITE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/plyon" class="allbrands-inner" title="PLYON">
                                                                <span class="allbrands-label">
                                                        PLYON                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/produit" class="allbrands-inner" title="PRODUIT">
                                                                <span class="allbrands-label">
                                                        PRODUIT                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/promelsa" class="allbrands-inner" title="PROMELSA">
                                                                <span class="allbrands-label">
                                                        PROMELSA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/promelux" class="allbrands-inner" title="PROMELUX">
                                                                <span class="allbrands-label">
                                                        PROMELUX                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-R" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">R</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/raas_controls" class="allbrands-inner" title="RAAS-CONTROLS">
                                                                <span class="allbrands-label">
                                                        RAAS-CONTROLS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/ramcro" class="allbrands-inner" title="RAMCRO">
                                                                <span class="allbrands-label">
                                                        RAMCRO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/raychem_rpg" class="allbrands-inner" title="RAYCHEM RPG">
                                                                <span class="allbrands-label">
                                                        RAYCHEM RPG                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/releco" class="allbrands-inner" title="RELECO">
                                                                <span class="allbrands-label">
                                                        RELECO                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/rishabh" class="allbrands-inner" title="RISHABH">
                                                                <span class="allbrands-label">
                                                        RISHABH                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/rittal" class="allbrands-inner" title="RITTAL">
                                                                <span class="allbrands-label">
                                                        RITTAL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-S" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">S</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/safybox" class="allbrands-inner" title="SAFYBOX">
                                                                <span class="allbrands-label">
                                                        SAFYBOX                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/scame" class="allbrands-inner" title="SCAME">
                                                                <span class="allbrands-label">
                                                        SCAME                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/schirtec" class="allbrands-inner" title="SCHIRTEC">
                                                                <span class="allbrands-label">
                                                        SCHIRTEC                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/schneider_electric" class="allbrands-inner" title="SCHNEIDER ELECTRIC">
                                                                <span class="allbrands-label">
                                                        SCHNEIDER ELECTRIC                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/semikron" class="allbrands-inner" title="SEMIKRON">
                                                                <span class="allbrands-label">
                                                        SEMIKRON                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/sew" class="allbrands-inner" title="SEW">
                                                                <span class="allbrands-label">
                                                        SEW                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/shenzen_woer" class="allbrands-inner" title="SHENZEN WOER">
                                                                <span class="allbrands-label">
                                                        SHENZEN WOER                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/shurtape" class="allbrands-inner" title="SHURTAPE">
                                                                <span class="allbrands-label">
                                                        SHURTAPE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/siemens" class="allbrands-inner" title="SIEMENS">
                                                                <span class="allbrands-label">
                                                        SIEMENS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/sirena" class="allbrands-inner" title="SIRENA">
                                                                <span class="allbrands-label">
                                                        SIRENA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/skyscan" class="allbrands-inner" title="SKYSCAN">
                                                                <span class="allbrands-label">
                                                        SKYSCAN                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/sofamel" class="allbrands-inner" title="SOFAMEL">
                                                                <span class="allbrands-label">
                                                        SOFAMEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/solsa" class="allbrands-inner" title="SOLSA">
                                                                <span class="allbrands-label">
                                                        SOLSA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/sonel" class="allbrands-inner" title="SONEL">
                                                                <span class="allbrands-label">
                                                        SONEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/stielectronica" class="allbrands-inner" title="STIELECTRONICA">
                                                                <span class="allbrands-label">
                                                        STIELECTRONICA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/sunj" class="allbrands-inner" title="SUNJ">
                                                                <span class="allbrands-label">
                                                        SUNJ                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/super_strut" class="allbrands-inner" title="SUPER STRUT">
                                                                <span class="allbrands-label">
                                                        SUPER STRUT                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/sylvania" class="allbrands-inner" title="SYLVANIA">
                                                                <span class="allbrands-label">
                                                        SYLVANIA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-T" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">T</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/talma" class="allbrands-inner" title="TALMA">
                                                                <span class="allbrands-label">
                                                        TALMA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tc" class="allbrands-inner" title="TC">
                                                                <span class="allbrands-label">
                                                        TC                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tec" class="allbrands-inner" title="TEC">
                                                                <span class="allbrands-label">
                                                        TEC                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tecfuse" class="allbrands-inner" title="TECFUSE">
                                                                <span class="allbrands-label">
                                                        TECFUSE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tee" class="allbrands-inner" title="TEE">
                                                                <span class="allbrands-label">
                                                        TEE                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/telergon" class="allbrands-inner" title="TELERGON">
                                                                <span class="allbrands-label">
                                                        TELERGON                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/terasaki" class="allbrands-inner" title="TERASAKI">
                                                                <span class="allbrands-label">
                                                        TERASAKI                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/thermoweld" class="allbrands-inner" title="THERMOWELD">
                                                                <span class="allbrands-label">
                                                        THERMOWELD                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/thomas_betts" class="allbrands-inner" title="THOMAS &amp; BETTS">
                                                                <span class="allbrands-label">
                                                        THOMAS &amp; BETTS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/thor_cem" class="allbrands-inner" title="THOR CEM">
                                                                <span class="allbrands-label">
                                                        THOR CEM                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/thor_gel" class="allbrands-inner" title="THOR-GEL">
                                                                <span class="allbrands-label">
                                                        THOR-GEL                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tramontina" class="allbrands-inner" title="TRAMONTINA">
                                                                <span class="allbrands-label">
                                                        TRAMONTINA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tuboplas" class="allbrands-inner" title="TUBOPLAS">
                                                                <span class="allbrands-label">
                                                        TUBOPLAS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/tyco_electronics" class="allbrands-inner" title="TYCO ELECTRONICS">
                                                                <span class="allbrands-label">
                                                        TYCO ELECTRONICS                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-U" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">U</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/unex" class="allbrands-inner" title="UNEX">
                                                                <span class="allbrands-label">
                                                        UNEX                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/uskuna" class="allbrands-inner" title="USKUNA">
                                                                <span class="allbrands-label">
                                                        USKUNA                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-V" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">V</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/veneta_isolatori" class="allbrands-inner" title="VENETA ISOLATORI">
                                                                <span class="allbrands-label">
                                                        VENETA ISOLATORI                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                        <section class="allbrands-letters-list">
                                                        <div class="allbrands-letter letter-W" data-allbrands-js="popup-brand-letter">
                                                        <span class="allbrands-title">W</span>
                                                        <div class="allbrands-content">
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/weifang" class="allbrands-inner" title="WEIFANG">
                                                                <span class="allbrands-label">
                                                        WEIFANG                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        <div class="allbrands-brand-item -no-logo">
                                                        <a href="https://www.promelsa.com.pe/todas-las-marcas/wheatland" class="allbrands-inner" title="WHEATLAND">
                                                                <span class="allbrands-label">
                                                        WHEATLAND                                                                                                    </span>
                                                        </a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
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
<div class="dark-backdrop hide" id="backdrop"></div>
<a class="scroll-to-top-btn" href="javascript:void(0);">
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
        DangerNotification("{{Session::get('error')}}");
      });
    </script>
    @endif
    @if(Session::has('success'))
    <script>
      $(document).ready(function(){
        SuccessNotification("{{Session::get('success')}}");
      });
    </script>
    @endif
</body>
</html>