<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
@if (url()->current() == route('front.index'))
<title>@yield('hometitle')</title>
@else
<title>{{$setting->title}}: @yield('title')</title>
@endif
@yield('meta')
<meta name="author" content="{{$setting->title}}">
<meta name="distribution" content="web">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=6.0, minimum-scale=1.0, shrink-to-fit=no, viewport-fit=cover"/>
<meta name="theme-color" content="#8BC82F"/>
<link rel="icon" type="image/ico" href="{{ asset('assets/favicon.ico') }}">
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
<?php
function maxcharacters($string, $maxletters){
    $output_strg = "";
    if(strlen($string) > $maxletters){
        $output_strg = substr($string, 0, $maxletters) . "...";
    }else{
        $output_strg = $string;
    }
    return $output_strg;
}
?>
@if($setting->is_loader == 1)
<div id="preloader">
    <img src="{{ asset('assets/images/'.$setting->loader) }}" class="img-fluid" alt="{{ __('Loading...') }}" width="100" height="100" decoding="sync">
</div>
@endif
<link rel="preload" href="{{asset('assets/front/css/styles.min.css')}}" as="style">
<script rel="preload" href="{{asset('assets/front/js/plugins/jquery-3.4.1.min.js')}}" as="script"></script>
<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">
<script type="text/javascript" src="{{asset('assets/front/js/plugins/jquery-3.4.1.min.js')}}" as="script"></script>
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
                    <div class="d-flex justify-content-between" id="c-topBarDskMb35mBd6Fhe">
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle" id="btn-toggMenuMob__only">
                            <a href="javascript:void(0);">
                                <div>
                                    <i class="icon-menu"></i>
                                    <span class="text-label">Menu</span>
                                </div>
                            </a>
                        </div>
                        <div class="site-branding">
                            <a class="site-logo align-self-center" href="{{route('front.index')}}">
                                
                            
                                <img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}">
                                

                                {{--
                                <!--
                                <img src="{{asset('assets/logotype__white.png' )}}" alt="{{$setting->title}}">
                                -->
                                --}}
                            </a>
                        </div>
                        <div class="search-box-wrap d-none d-lg-block d-flex">
                            <div class="search-box-inner align-self-center">
                                <div class="search-box d-flex">                               
                                    <form class="input-group" id="header_search_form" action="{{route('front.catalog')}}" method="get">
                                        <input type="hidden" name="category" value="" id="search__category">
                                        <span class="input-group-btn">
                                            <button type="submit" title="Buscar..."><i class="icon-search"></i></button>
                                        </span>
                                        <input class="form-control" type="text" data-target="{{route('front.search.suggest')}}" autocomplete="off" spellcheck="false" id="__product__search" name="search" placeholder="{{__('What are you looking for?')}}" value="{{ $getSessProdSearch }}">
                                        <div class="serch-result d-none px-0 pb-0">{{-- search result --}}</div>
                                    </form>
                                </div>
                            </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div>
                        <div class="toolbar d-flex">
                            <div class="toolbar-item close-m-serch visible-on-mobile d-none">
                                <a href="javascript:void(0);">
                                    <div>
                                        <i class="icon-search"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="toolbar-item visible-on-mobile mobile-menu-toggle d-none">
                                <a href="javascript:void(0);">
                                    <div>
                                        <i class="icon-menu"></i>
                                        <span class="text-label">{{__('Menu')}}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="toolbar-item hidden-on-mobile d-flex align-items-center justify-content-center" id="c-mtoggleUserMob">
                                @if(!Auth::user())
                                <a href="{{route('user.login')}}">
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
                                        <i class="icon-user pr-2"></i> <span class="text-label">{{ maxcharacters(Auth::user()->first_name, 11) }}</span>
                                    </div>
                                    <div class="t-h-dropdown-menu">
                                        <a href="{{route('user.order.index')}}">
                                            <span class="cIcon-profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 32 32"><path fill="currentColor" d="M4 16h12v2H4zm-2-5h10v2H2z"/><path fill="currentColor" d="m29.919 16.606l-3-7A1 1 0 0 0 26 9h-3V7a1 1 0 0 0-1-1H6v2h15v12.556A4 4 0 0 0 19.142 23h-6.284a4 4 0 1 0 0 2h6.284a3.98 3.98 0 0 0 7.716 0H29a1 1 0 0 0 1-1v-7a1 1 0 0 0-.081-.394M9 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m14-15h2.34l2.144 5H23Zm0 15a2 2 0 1 1 2-2a2 2 0 0 1-2 2m5-3h-1.142A3.995 3.995 0 0 0 23 20v-2h5Z"/></svg>
                                            </span>
                                            <span>{{ __('My orders') }}</span>
                                        </a>
                                        <a href="{{route('user.dashboard')}}">
                                            <span class="cIcon-profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 256 256"><path fill="currentColor" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24M74.08 197.5a64 64 0 0 1 107.84 0a87.83 87.83 0 0 1-107.84 0M96 120a32 32 0 1 1 32 32a32 32 0 0 1-32-32m97.76 66.41a79.66 79.66 0 0 0-36.06-28.75a48 48 0 1 0-59.4 0a79.66 79.66 0 0 0-36.06 28.75a88 88 0 1 1 131.52 0"/></svg>
                                            </span>
                                            <span>{{ __('My account') }}</span>
                                        </a>
                                        <a href="{{route('user.logout')}}">
                                            <span class="cIcon-profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/></svg>
                                            </span>
                                            <span>{{ __('Logout') }}</span>
                                        </a>
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
                                <div class="toolbar-dropdown cart-dropdown">
                                    <div class="widget-cart cartviewheader__c cart_view_header" id="header_cart_load" data-target="{{route('front.header.cart')}}">
                                    @include('includes.header_cart')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cx-mobilemenu">
                            <div class="mobile-menu">
                                {{--
                                <!--
                                <div class="mm-heading-area">
                                    <h4>{{ __('Navigation') }}</h4>
                                    <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                        <a href="javascript:void(0);">
                                            <div><i class="icon-x"></i></div>
                                        </a>
                                    </div>
                                </div>
                                -->
                                --}}
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
                                                <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}">
                                                    <a href="{{route('front.index')}}">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>{{__('Home')}}</span>
                                                    </a>
                                                </li>
                                                @if ($setting->is_shop == 1)
                                                <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}">
                                                    <a href="{{route('front.catalog')}}">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>{{__('Shop')}}</span>
                                                    </a>
                                                </li>
                                                @endif
                                                {{--
                                                <!--
                                                @if ($setting->is_campaign == 1)
                                                <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}"><i class="icon-chevron-right"></i>Promociones</a></li>
                                                @endif
                                                -->
                                                --}}
                                                <li class="{{ request()->routeIs('front.onsaleproducts')  ? 'active' : '' }}">
                                                    <a href="{{route('front.onsaleproducts')}}">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>{{__('Promotions')}}</span>
                                                    </a>
                                                </li>
                                                <li class="{{ request()->routeIs('front.specialoffer')  ? 'active' : '' }}">
                                                    <a href="{{route('front.specialoffer')}}">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>{{__('Special offers')}}</span>
                                                    </a>
                                                </li>
                                                @if ($setting->is_brands == 1)
                                                <li class="{{ request()->routeIs('front.brands')  ? 'active' : '' }}">
                                                    <a href="{{route('front.brands')}}">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>{{__('Brand')}}</span>
                                                    </a>
                                                </li>
                                                @endif
                                                @if ($setting->is_blog == 1)
                                                <!-- <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}"><i class="icon-chevron-right"></i>{{__('Blog')}}</a></li> -->
                                                @endif

                                                @if ($setting->is_catalogs == 1)
                                                <li class="{{ (request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : '' }}">
                                                    <a class="{{ (request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : '' }}" href="{{route('front.journals')}}">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>Catálogos</span>
                                                    </a>
                                                </li>
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
                            <div class="hmenu-close-icon">
                                <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100" xml:space="preserve"><path d="m26 82 24-25 25 25 7-7-25-25 25-24-7-8-25 25-24-25-8 8 25 24-25 25z"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="c-mtoggSearchMob">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="search-box-wrap d-lg-block d-flex">
                        <div class="search-box-inner align-self-center">
                            <div class="search-box d-flex">                               
                                <form class="input-group" id="header_search_form-mob" action="{{route('front.catalog')}}" method="get">
                                    <input type="hidden" name="category" value="" id="search__category-mob">
                                    <span class="input-group-btn">
                                        <button type="submit" title="Buscar..."><i class="icon-search"></i></button>
                                    </span>
                                    <input class="form-control" type="text" data-target="{{route('front.search.suggest')}}" autocomplete="off" spellcheck="false" id="__product__search-mob" name="search" placeholder="{{__('What are you looking for?')}}" value="{{ $getSessProdSearch }}">
                                    <div class="serch-result d-none px-0 pb-0">{{-- search result --}}</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="csl-fGv8n09c__sGaYs45">@csrf</div>
    <div class="navbar theme-total">
        <div class="container">
            <div class="row g-3 w-100" id="sdonv98349-mfdJasl98C3f">
                {{--
                <!--
                <div class="col-lg-3 d-flex align-items-center justify-content-flex-start cLCategs">
                    @include('includes.categories')
                </div>
                -->
                --}}
                <div class="col-lg-9 d-flex justify-content-between cGrpOptsNav">
                    <div class="row g-3 w-100 cGrpOptsNav__c">
                        <div class="col-lg-8 cGrpOptsNav__c__cLTabLinks">
                            <div class="nav-inner">
                                <nav class="site-menu">
                                    <ul>
                                        @if ($setting->is_shop == 1)
                                        <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}">
                                            <a href="{{route('front.catalog')}}" data-dropdown-custommenu="products-menu">{{__('Shop')}}</a>
                                            @include('includes.categories')
                                        </li>
                                        @endif
                                        {{--
                                        <!--
                                        <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                                        -->
                                        --}}
                                        {{--
                                        <!--
                                        @if ($setting->is_shop == 1)
                                        <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}">{{__('Shop')}}</a></li>
                                        @endif
                                        -->
                                        --}}
                                        @if ($setting->is_brands == 1)
                                        <li class="{{ request()->routeIs('front.brands')  ? 'active' : '' }} allbrands_menulist">
                                            <a href="{{route('front.brands')}}" class="allbrands-menu-item" data-dropdown-custommenu="brands-menu">{{__('Brands')}}</a>
                                            <div class="allbrands-list-popup" data-allbrands-js="brands-popup" data-dropdown-contentmenu="brands-menu">
                                                <div class="allbrands-list-container">
                                                    <?php
                                                        $Allbrands = DB::table('brands')->select('name','slug')->get()->toArray();
                                                        // $Allbrands2 = json_decode($Allbrands, TRUE);

                                                        $brandGroups = [];
                                                        
                                                        // Check if a letter is a number and replace it with #
                                                        function sanitizeLetter($letter) {
                                                            return is_numeric($letter) ? '#' : $letter;
                                                        }

                                                        foreach ($Allbrands as $brand) {
                                                            // $firstLetter = strtoupper(substr($brand["name"], 0, 1));
                                                            $firstLetter = strtoupper(substr($brand->name, 0, 1));
                                                            $groupName = is_numeric($firstLetter) ? '#' : $firstLetter;
                                                              if (!isset($brandGroups[$groupName])) {
                                                                $brandGroups[$groupName] = [];
                                                              }
                                                            
                                                              $brandGroups[$groupName][] = $brand;
                                                            
                                                        }

                                                        // Move # group to the front if present
                                                        if (isset($brandGroups['#'])) {
                                                            $hashGroup = $brandGroups['#'];
                                                            unset($brandGroups['#']);
                                                            $brandGroups = array_merge(['#' => $hashGroup], $brandGroups);
                                                        }

                                                        $availableLetters = array_keys($brandGroups);
                                                        // Create an array with all letters of the alphabet
                                                        $alphabetLetters = range('A', 'Z');
                                                        // Combine the available letters from the groups with the alphabet letters
                                                        $allLetters = array_unique(array_merge($availableLetters, $alphabetLetters));

                                                        $filteredLetters = array_map('sanitizeLetter', $allLetters);
                                                        // $filteredLetters = array_map('sanitizeLetter', $availableLetters);

                                                        // Sort the letters
                                                        sort($filteredLetters);

                                                        // Move # to the front if present
                                                        if (($key = array_search('#', $filteredLetters)) !== false) {
                                                            unset($filteredLetters[$key]);
                                                            // array_unshift($filteredLetters, '#'); // COLOCAR AL INICIO
                                                            array_push($filteredLetters, '#'); // COLOCAR AL FINAL
                                                        }
                                                    ?>
                                                    <div class="cgBtns">
                                                        <div class="cgBtns__List">
                                                            <div class="filter-buttons">
                                                                <!-- Add buttons for each letter of the alphabet -->
                                                                <a class="letter-all" href="{{route('front.brands')}}">Todas las Marcas</a>
                                                                <?php
                                                                    foreach ($filteredLetters as $letter) {
                                                                        // $disabled = $letter === '#' ? '' : (in_array($letter, range('0', '9')) ? 'disabled' : '');
                                                                        $disabled = $letter === '#' ? '' : (!in_array($letter, $availableLetters) ? 'disabled' : '');
                                                                        echo "<button class='filter-button' data-letter='$letter' $disabled>$letter</button>";
                                                                        // echo "<button class='filter-button' data-letter='$letter'>$letter</button>";
                                                                    }
                                                                ?>
                                                            </div>
                                                            <div class="brand-list">
                                                                <?php
                                                                    // Move # to the front if present
                                                                    if (isset($filteredLetters['#'])) {
                                                                        $hashGroup = $brandGroups['#'];
                                                                        unset($brandGroups['#']);
                                                                        $brandGroups = array_merge(['#' => $hashGroup], $brandGroups);
                                                                    }

                                                                    foreach ($brandGroups as $letter => $group) {
                                                                        echo "<div class='brand-group' id='$letter'>";
                                                                        echo "<h2 class='brand-group-title'><strong>$letter</strong></h2>";
                                                                        
                                                                        foreach ($group as $brand){
                                                                            $urlBrand = route('front.catalog') . '?brand=' . $brand->slug;
                                                                            // echo "<a href='#{$brand['slug']}' class='brand-group-item' title='{$brand['name']}'>{$brand['name']}</a>";
                                                                            echo "<a href='{$urlBrand}' class='brand-group-item' title='{$brand->name}'><span>{$brand->name}</span></a>";
                                                                        }
                                                                        
                                                                        echo "</div>";
                                                                    }
                                                                ?>
                                                            </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        <li class="{{ request()->routeIs('front.onsaleproducts')  ? 'active' : '' }}"><a href="{{route('front.onsaleproducts')}}">{{__('Promotions')}}</a></li>
                                        <li class="{{ request()->routeIs('front.specialoffer')  ? 'active' : '' }}"><a href="{{route('front.specialoffer')}}">{{__('Special offers')}}</a></li>
                                        @if ($setting->is_blog == 1)
                                        <!-- <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}">{{__('Blog')}}</a></li> -->
                                        @endif
                                        @if ($setting->is_catalogs == 1)
                                        <li class="{{ (request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : '' }}">
                                            <a class="{{ (request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : '' }}" href="{{route('front.journals')}}"></i>Catálogos</a>
                                        </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-4 cGrpOptsNav__c__cSchdule">
                            <div class="row g-3 w-100 cGrpOptsNav__c__cSchdule__c mt-0">
                                <div class="col-lg-4 cGrpOptsNav__c__cSchdule__c__i">
                                    <span class=""><strong>Lunes - Viernes</strong></span>
                                    <span>{{$setting->friday_start}} - {{$setting->friday_end}}</span>
                                </div>
                                <div class="col-lg-4 cGrpOptsNav__c__cSchdule__c__i">
                                    <span class=""><strong>Sábado</strong></span>
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
<?php
?>
@yield('content')
<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
    @if ($setting->announcement_type == 'newletter')
    <div class="announcement-with-content">
        <div class="left-area">
            <img src="{{ asset('assets/images/announcements/'.$setting->announcement) }}" alt="">
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
        <img src="{{ asset('assets/images/announcements/'.$setting->announcement) }}" alt="">
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

{{--
<!-- <footer class="site-footer">
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
                <a href="{{$link}}" target="_blank">
                    <span><i class="{{$icons[$link_key]}}"></i></span>
                </a>
                @endforeach
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title">{{__('Usefull Links')}}</h3>
            <ul>
                @if ($setting->is_contact == 1)
                <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}">
                    <a href="{{route('front.contact')}}">{{__('Contact')}}</a>
                </li>
                @endif
                @foreach (DB::table('pages')->wherePos(2)->orwhere('pos',1)->get() as $page)
                <li>
                    <a href="{{route('front.page',$page->slug)}}">{{$page->title}}</a>
                </li>
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
</footer> -->
--}}
<?php
    $pagesListOfDB = DB::table('pages')->wherePos(2)->orwhere('pos',1)->get();
    $links = json_decode($setting->social_link,true)['links'];
    $icons = json_decode($setting->social_link,true)['icons'];
    $message_subject = "Información sobre GRUPOCOREIN S.A.C.";
    $l_break = "%0D%0A";
    $message_body = "Hola, mucho gusto.{$l_break}Desearía más información sobre la plataforma GRUPOCOREIN S.A.C.";
    function formatNumberPhoneSettings($phone){
		$output_phone = "";
		$output_phone = preg_replace('/(\d{1,3})(?=(\d{3})+$)/', '$1 ', $phone);
		return $output_phone;
	}
?>
<footer class="cFootCus--v1">
    <div class="cFootCus--v1__c">
        <div class="cFootCus--v1__c__cFTop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <section class="widget widget-light-skin">
                            <div class="cFootCus--v1__c__cFTop__cLogo">
                                <div class="cFootCus--v1__c__cFTop__cLogo__cIcon">
                                    <a class="align-self-center" href="{{route('front.index')}}" target="_self">
                                        {{-- <!-- <img src="{{ asset('assets/logotype__white.png') }}" alt="logotypesystem_white"> --> --}}
                                        <img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}" width="100" height="100">
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <section class="widget widget-links widget-light-skin">
                            <h3 class="widget-title">INFORMACIÓN PARA EL CLIENTE</h3>
                            <ul>
                                @foreach($pagesListOfDB as $page)
                                    @if($page->title != 'Nosotros' && $page->title != 'nosotros' && $page->slug != 'nosotros')
                                    <li>
                                        <a href="{{route('front.page',$page->slug)}}" target="_self" title="{{$page->title}}">
                                            <span>{{$page->title}}</span>
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <section class="widget widget-links widget-light-skin">
                            <h3 class="widget-title">NUESTRA EMPRESA</h3>
                            <ul>
                                @if($setting->is_contact == 1)
                                <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}">
                                    <a href="{{route('front.contact')}}" target="_self" title="{{__('Contact')}}">
                                        <span>{{__('Contact')}}</span>
                                    </a>
                                </li>
                                @endif
                                @foreach($pagesListOfDB as $page)
                                    @if($page->title == 'Nosotros' || $page->title == 'nosotros' || $page->slug == 'nosotros')
                                    <li>
                                        <a href="{{route('front.page',$page->slug)}}" target="_self" title="{{$page->title}}">
                                            <span>{{$page->title}}</span>
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <section class="widget widget-links widget-light-skin">
                            <h3 class="widget-title">CLIENTES</h3>
                            <?php
                            $linkBySessionInitUser_dashboard = "";
                            $linkBySessionInitUser_compare = "";
                            $linkBySessionInitUser_whishlist = "";
                            $linkBySessionInitUser_cartlist = "";
                            if(Auth::check() && Auth::user()->role !== 'admin'){
                                if(!empty(auth()->user()) || auth()->user() != ""){
                                    $linkBySessionInitUser_dashboard = route('user.profile');
                                    $linkBySessionInitUser_compare = route('fornt.compare.index');
                                    $linkBySessionInitUser_whishlist = route('user.wishlist.index');
                                    $linkBySessionInitUser_cartlist = route('front.cart');
                                }else{
                                    $linkBySessionInitUser_dashboard = route('user.login');
                                    $linkBySessionInitUser_compare = route('fornt.compare.index');
                                    $linkBySessionInitUser_whishlist = route('user.login');
                                    $linkBySessionInitUser_cartlist = route('front.cart');
                                }
                            }else{
                                $linkBySessionInitUser_dashboard = route('user.login');
                                $linkBySessionInitUser_compare = route('fornt.compare.index');
                                $linkBySessionInitUser_whishlist = route('user.login');
                                $linkBySessionInitUser_cartlist = route('front.cart');
                            }
                            ?>
                            <ul>
                                <li>
                                    <a href="{{ $linkBySessionInitUser_dashboard }}" target="_self" title="Mi cuenta">
                                        <span>Mi cuenta</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $linkBySessionInitUser_dashboard }}" target="_self" title="Registrarme">
                                        <span>Registrarme</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $linkBySessionInitUser_dashboard }}" target="_self" title="Actualizar datos">
                                        <span>Actualizar datos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $linkBySessionInitUser_compare }}" target="_self" title="Comparar">
                                        <span>Comparar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $linkBySessionInitUser_whishlist }}" target="_self" title="Lista de deseos">
                                        <span>Lista de deseos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $linkBySessionInitUser_cartlist }}" target="_self" title="Carrito de compras">
                                        <span>Carrito de compras</span>
                                    </a>
                                </li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <section class="widget widget-light-skin">
                            <h3 class="widget-title">MEDIOS DE PAGO</h3>
                            <div class="cFootCus--v1__c__cFTop__cMPaymntsList">
                                <div class="cFootCus--v1__c__cFTop__cMPaymntsList__m">
                                    <div class="cFootCus--v1__c__cFTop__cMPaymntsList__m__i">
                                        <img src="{{asset('assets/images/Utilities/mediosdepago.png')}}" alt="{{$setting->title}}" width="100" height="100">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="cFootCus--v1__c__cFBottom">
            <div class="container hr-themecust-py--15">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="cFootCus--v1__c__cFBottom__c">
                            <ul class="cFootCus--v1__c__cFBottom__c__mLstLeft">
                                <li class="cFootCus--v1__c__cFBottom__c__mLstLeft__i">
                                    <span class="cFootCus--v1__c__cFBottom__c__mLstLeft__i__cIcon mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" witdh="20px" height="20px"><path d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152V422.8c0 9.8-6 18.6-15.1 22.3L416 503V200.4zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6V451.8L32.9 502.7C17.1 509 0 497.4 0 480.4V209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77V504.3L192 449.4V255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg></span>
                                    <span class="cFootCus--v1__c__cFBottom__c__mLstLeft__i__cTxt mb-1">{{$setting->footer_address}}</span>
                                </li>
                                <li class="cFootCus--v1__c__cFBottom__c__mLstLeft__i">
                                    <span class="cFootCus--v1__c__cFBottom__c__mLstLeft__i__cIcon mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" witdh="20px" height="20px"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
                                    <a class="cFootCus--v1__c__cFBottom__c__mLstLeft__i__cLink mb-3" href="mailto:{{ $setting->footer_email }}?subject={{ $message_subject }}&body={{ $message_body }}">
                                        <span>{{$setting->footer_email}}</span>
                                    </a>
                                </li>
                                <li class="cFootCus--v1__c__cFBottom__c__mLstLeft__i">
                                    <span class="cFootCus--v1__c__cFBottom__c__mLstLeft__i__cIcon mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" witdh="20px" height="20px"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg></span>
                                    <a class="cFootCus--v1__c__cFBottom__c__mLstLeft__i__cLink mb-3" href="tel:{{$setting->footer_phone}}">
                                        <span>{{ formatNumberPhoneSettings($setting->footer_phone) }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="cFootCus--v1__c__cFBottom__c d-flex justify-content-end">
                            <section class="">
                                <h3 class="widget-title">SÍGUENOS EN</h3>
                                <div class="footer-social-links">
                                    @foreach($links as $link_key => $link)
                                    <a href="{{$link}}" target="_blank">
                                        <span><i class="{{$icons[$link_key]}}"></i></span>
                                    </a>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cFootCus--v1__c__cFFixBottom hr-themecust-py--0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <section class="cFootCus--v1__c__cFFixBottom__c">
                            <div class="cFootCus--v1__c__cFFixBottom__c__cSc">
                                <span>{{$setting->copy_right}} <?php echo date("Y"); ?>.</span>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
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
<?php
  $wstpCollection = json_decode($setting->whatsapp_numbers, TRUE);
  $ArrwpsNumbersButton = "";
  $wps_generalButton = [];
  if(isset($wstpCollection['whatsapp_numbers'])){
    $ArrwpsNumbersButton = $wstpCollection['whatsapp_numbers'];
    if(isset($ArrwpsNumbersButton['general'])){
      $wps_generalButton = $ArrwpsNumbersButton['general'][0];
      if($wps_generalButton['number'] == "" || $wps_generalButton['number'] == NULL || $wps_generalButton['number'] == "NaN"){
        // echo "------------------------NO EXISTE NÚMERO";
        $wps_generalButton = [
            'title' => 'WhatsApp GENERAL COREIN',
            'text' => 'Me interesa saber más sobre los productos en GRUPOCOREIN',
            'number' => '994264025',
        ];
      }
    }
  }
?>
<div id="WAButton"></div>
<script type="text/javascript" src="{{ asset('assets/front/js/plugins/floating-whatsapp/floating-wpp.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/front/js/plugins/floating-whatsapp/floating-wpp.min.css') }}">
@if(isset($wstpCollection['whatsapp_numbers']))
    @php
        $ArrwpsNumbersButton = $wstpCollection['whatsapp_numbers'];
    @endphp
    @if(isset($ArrwpsNumbersButton['general']))
        @php
            $wps_generalButton = $ArrwpsNumbersButton['general'][0];
            if($wps_generalButton['number'] == "" || $wps_generalButton['number'] == NULL || $wps_generalButton['number'] == "NaN"){
                $wps_generalButton = [
                    'title' => 'WhatsApp GENERAL COREIN',
                    'text' => 'Me interesa saber más sobre los productos en GRUPOCOREIN',
                    'number' => '994264025',
                ];
            }
        @endphp
        <script type="text/javascript">
        $(function() {
            let imgWAButton = "{{ asset('assets/front/js/plugins/floating-whatsapp/whatsapp.svg') }}";
            $('#WAButton').floatingWhatsApp({
            phone: '+51<?php echo $wps_generalButton['number']; ?>', //WhatsApp Business phone number International format-
            //Get it with Toky at https://toky.co/en/features/whatsapp.
            headerTitle: '¡Chatea con nosotros en WhatsApp!', //Popup Title
            popupMessage: 'Hola, ¿Cómo podemos ayudarte?', //Popup Message
            showPopup: true, //Enables popup display
            buttonImage: `<img src="${imgWAButton}" />`, //Button Image
            //headerColor: 'crimson', //Custom header color
            //backgroundColor: 'crimson', //Custom background button color
            position: "right"    
            });
        });
        </script>
    @endif
@endif
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