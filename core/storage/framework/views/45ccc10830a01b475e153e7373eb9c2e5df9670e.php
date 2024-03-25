<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<?php if(url()->current() == route('front.index')): ?>
<title><?php echo $__env->yieldContent('hometitle'); ?></title>
<?php else: ?>
<title><?php echo e($setting->title); ?>: <?php echo $__env->yieldContent('title'); ?></title>
<?php endif; ?>
<?php echo $__env->yieldContent('meta'); ?>
<meta name="author" content="<?php echo e($setting->title); ?>">
<meta name="distribution" content="web">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=6.0, minimum-scale=1.0, shrink-to-fit=no, viewport-fit=cover"/>
<meta name="theme-color" content="#8BC82F"/>
<link rel="icon" type="image/ico" href="<?php echo e(asset('assets/favicon.ico')); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<link rel="apple-touch-icon" sizes="167x167" href="<?php echo e(asset('assets/images/'.$setting->favicon)); ?>">
<?php echo $__env->yieldContent('styleplugins'); ?>
<link href="<?php echo e(asset('assets/front/css/color.php?primary_color=').str_replace('#','',$setting->primary_color)); ?>" rel="stylesheet">
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/modernizr.min.js')); ?>"></script>
<?php if(DB::table('languages')->where('is_default',1)->first()->rtl == 1): ?>
    <!-- <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/rtl.css')); ?>"> -->
<?php endif; ?>
<style>
    <?php echo e($setting->custom_css); ?>

</style>

<?php if($setting->is_google_adsense == '1'): ?>
    <?php echo $setting->google_adsense; ?>

<?php endif; ?>



<?php if($setting->is_google_analytics == '1'): ?>
    <?php echo $setting->google_analytics; ?>

<?php endif; ?>



<?php if($setting->is_facebook_pixel == '1'): ?>
    <?php echo $setting->facebook_pixel; ?>

<?php endif; ?>


</head>
<body class="
<?php if($setting->theme == 'theme1'): ?>
body_theme1
<?php elseif($setting->theme == 'theme2'): ?>
body_theme2
<?php elseif($setting->theme == 'theme3'): ?>
body_theme3
<?php elseif($setting->theme == 'theme4'): ?>
body_theme4
<?php endif; ?>
">
<?php if($setting->is_loader == 1): ?>
<div id="preloader">
    <img src="<?php echo e(asset('assets/images/'.$setting->loader)); ?>" alt="<?php echo e(__('Loading...')); ?>" width="100" height="100" decoding="sync">
</div>
<?php endif; ?>
<link rel="preload" href="<?php echo e(asset('assets/front/css/styles.min.css')); ?>" as="style">
<script rel="preload" href="<?php echo e(asset('assets/front/js/plugins/jquery-3.4.1.min.js')); ?>" as="script"></script>
<link id="mainStyles" rel="stylesheet" media="screen" href="<?php echo e(asset('assets/front/css/styles.min.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/plugins/jquery-3.4.1.min.js')); ?>" as="script"></script>
<?php echo $__env->make('includes.apiwhatsappbutton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <?php                    
                    $getSessProdSearch = '';
                    $getPathCurrent = Request::path();
                    if($getPathCurrent == "/"){
                        $getSessProdSearch = '';
                    }else{
                        if(Session::has('searhproduct_user')){
                            $getSessProdSearch = Session::get('searhproduct_user');
                        }
                    }
                ?>
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
                            <a class="site-logo align-self-center" href="<?php echo e(route('front.index')); ?>">
                                
                            
                                <img src="<?php echo e(asset('assets/images/'.$setting->logo)); ?>" alt="<?php echo e($setting->title); ?>">
                                

                                
                            </a>
                        </div>
                        <div class="search-box-wrap d-none d-lg-block d-flex">
                            <div class="search-box-inner align-self-center">
                                <div class="search-box d-flex">                               
                                    <form class="input-group" id="header_search_form" action="<?php echo e(route('front.catalog')); ?>" method="get">
                                        <input type="hidden" name="category" value="" id="search__category">
                                        <span class="input-group-btn">
                                            <button type="submit" title="Buscar..."><i class="icon-search"></i></button>
                                        </span>
                                        <input class="form-control" type="text" data-target="<?php echo e(route('front.search.suggest')); ?>" autocomplete="off" spellcheck="false" id="__product__search" name="search" placeholder="<?php echo e(__('What are you looking for?')); ?>" value="<?php echo e($getSessProdSearch); ?>">
                                        <div class="serch-result d-none px-0 pb-0"></div>
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
                                        <span class="text-label"><?php echo e(__('Menu')); ?></span>
                                    </div>
                                </a>
                            </div>
                            <div class="toolbar-item hidden-on-mobile d-flex align-items-center justify-content-center" id="c-mtoggleUserMob">
                                <?php if(!Auth::user()): ?>
                                <a href="<?php echo e(route('user.login')); ?>">
                                    <div>
                                        <span class="compare-icon">
                                            <i class="icon-user"></i>
                                        </span>
                                        <span class="text-label">Ingreso/Registro</span>
                                    </div>
                                </a>                                
                                <?php else: ?>
                                <div class="t-h-dropdown mx-0 link-a-menu-login">
                                    <div class="main-link d-flex align-items-center flex-column">
                                        <i class="icon-user pr-2"></i> <span class="text-label"><?php echo e(Auth::user()->first_name); ?></span>
                                    </div>
                                    <div class="t-h-dropdown-menu">
                                        <a href="<?php echo e(route('user.dashboard')); ?>"><span><?php echo e(__('Dashboard')); ?></span><i class="icon-chevron-right pr-2"></i></a>
                                        <a href="<?php echo e(route('user.logout')); ?>"><span><?php echo e(__('Logout')); ?></span><i class="icon-chevron-right pr-2"></i></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="toolbar-item hidden-on-mobile"><a href="<?php echo e(route('fornt.compare.index')); ?>">
                                <div><span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count"><?php echo e(Session::has('compare') ? count(Session::get('compare')) : '0'); ?></span></span><span class="text-label"><?php echo e(__('Compare')); ?></span></div>
                                </a>
                            </div>
                            <?php if(Auth::check()): ?>
                            <div class="toolbar-item hidden-on-mobile"><a href="<?php echo e(route('user.wishlist.index')); ?>">
                                <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count"><?php echo e(Auth::user()->wishlists->count()); ?></span></span><span class="text-label"><?php echo e(__('Wishlist')); ?></span></div>
                                </a>
                            </div>
                            <?php else: ?>
                            <div class="toolbar-item hidden-on-mobile"><a href="<?php echo e(route('user.wishlist.index')); ?>">
                            <div><span class="compare-icon"><i class="icon-heart"></i></span><span class="text-label"><?php echo e(__('Wishlist')); ?></span></div>
                            </a>
                            </div>
                            <?php endif; ?>
                            <div class="toolbar-item"><a href="<?php echo e(route('front.cart')); ?>">
                                <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count"><?php echo e(Session::has('cart') ? count(Session::get('cart')) : '0'); ?> </span></span><span class="text-label"><?php echo e(__('Cart')); ?></span></div>
                                </a>
                                <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="<?php echo e(route('front.header.cart')); ?>">
                                <?php echo $__env->make('includes.header_cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="cx-mobilemenu">
                            <div class="mobile-menu">
                                
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation99">
                                    <span class="active" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu"  role="tab" aria-controls="mmenu" aria-selected="true"><?php echo e(__('Menu')); ?></span>
                                    </li>
                                    <li class="nav-item" role="presentation99">
                                    <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat"  role="tab" aria-controls="mcat" aria-selected="false"><?php echo e(__('Category')); ?></span>
                                    </li>
                                </ul>
                                <div class="tab-content p-0" >
                                    <div class="tab-pane fade show active" id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                                        <nav class="slideable-menu">
                                            <ul>
                                                <li class="<?php echo e(request()->routeIs('front.index') ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('front.index')); ?>">
                                                        <i class="icon-chevron-right"></i>
                                                        <span><?php echo e(__('Home')); ?></span>
                                                    </a>
                                                </li>
                                                <?php if($setting->is_shop == 1): ?>
                                                <li class="<?php echo e(request()->routeIs('front.catalog*')  ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('front.catalog')); ?>">
                                                        <i class="icon-chevron-right"></i>
                                                        <span><?php echo e(__('Shop')); ?></span>
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                                
                                                <li class="<?php echo e(request()->routeIs('front.onsaleproducts')  ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('front.onsaleproducts')); ?>">
                                                        <i class="icon-chevron-right"></i>
                                                        <span><?php echo e(__('Promotions')); ?></span>
                                                    </a>
                                                </li>
                                                <li class="<?php echo e(request()->routeIs('front.specialoffer')  ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('front.specialoffer')); ?>">
                                                        <i class="icon-chevron-right"></i>
                                                        <span><?php echo e(__('Special offers')); ?></span>
                                                    </a>
                                                </li>
                                                <?php if($setting->is_brands == 1): ?>
                                                <li class="<?php echo e(request()->routeIs('front.brands')  ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('front.brands')); ?>">
                                                        <i class="icon-chevron-right"></i>
                                                        <span><?php echo e(__('Brand')); ?></span>
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                                <?php if($setting->is_blog == 1): ?>
                                                <!-- <li class="<?php echo e(request()->routeIs('front.blog*') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.blog')); ?>"><i class="icon-chevron-right"></i><?php echo e(__('Blog')); ?></a></li> -->
                                                <?php endif; ?>

                                                <?php if($setting->is_catalogs == 1): ?>
                                                <li class="<?php echo e((request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : ''); ?>">
                                                    <a class="<?php echo e((request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : ''); ?>" href="<?php echo e(route('front.journals')); ?>">
                                                        <i class="icon-chevron-right"></i>
                                                        <span>Catálogos</span>
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="tab-pane fade" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                                        <nav class="slideable-menu">
                                            <?php echo $__env->make('includes.mobile-category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                <form class="input-group" id="header_search_form-mob" action="<?php echo e(route('front.catalog')); ?>" method="get">
                                    <input type="hidden" name="category" value="" id="search__category-mob">
                                    <span class="input-group-btn">
                                        <button type="submit" title="Buscar..."><i class="icon-search"></i></button>
                                    </span>
                                    <input class="form-control" type="text" data-target="<?php echo e(route('front.search.suggest')); ?>" autocomplete="off" spellcheck="false" id="__product__search-mob" name="search" placeholder="<?php echo e(__('What are you looking for?')); ?>" value="<?php echo e($getSessProdSearch); ?>">
                                    <div class="serch-result d-none px-0 pb-0"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="csl-fGv8n09c__sGaYs45"><?php echo csrf_field(); ?></div>
    <div class="navbar theme-total">
        <div class="container">
            <div class="row g-3 w-100" id="sdonv98349-mfdJasl98C3f">
                
                <div class="col-lg-9 d-flex justify-content-between cGrpOptsNav">
                    <div class="row g-3 w-100 cGrpOptsNav__c">
                        <div class="col-lg-8 cGrpOptsNav__c__cLTabLinks">
                            <div class="nav-inner">
                                <nav class="site-menu">
                                    <ul>
                                        <?php if($setting->is_shop == 1): ?>
                                        <li class="<?php echo e(request()->routeIs('front.catalog*')  ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('front.catalog')); ?>" data-dropdown-custommenu="products-menu"><?php echo e(__('Shop')); ?></a>
                                            <?php echo $__env->make('includes.categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </li>
                                        <?php endif; ?>
                                        
                                        
                                        <?php if($setting->is_brands == 1): ?>
                                        <li class="<?php echo e(request()->routeIs('front.brands')  ? 'active' : ''); ?> allbrands_menulist">
                                            <a href="<?php echo e(route('front.brands')); ?>" class="allbrands-menu-item" data-dropdown-custommenu="brands-menu"><?php echo e(__('Brands')); ?></a>
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
                                                                <a class="letter-all" href="<?php echo e(route('front.brands')); ?>">Todas las Marcas</a>
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
                                        <?php endif; ?>
                                        <li class="<?php echo e(request()->routeIs('front.onsaleproducts')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.onsaleproducts')); ?>"><?php echo e(__('Promotions')); ?></a></li>
                                        <li class="<?php echo e(request()->routeIs('front.specialoffer')  ? 'active' : ''); ?>"><a href="<?php echo e(route('front.specialoffer')); ?>"><?php echo e(__('Special offers')); ?></a></li>
                                        <?php if($setting->is_blog == 1): ?>
                                        <!-- <li class="<?php echo e(request()->routeIs('front.blog*') ? 'active' : ''); ?>"><a href="<?php echo e(route('front.blog')); ?>"><?php echo e(__('Blog')); ?></a></li> -->
                                        <?php endif; ?>
                                        <?php if($setting->is_catalogs == 1): ?>
                                        <li class="<?php echo e((request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : ''); ?>">
                                            <a class="<?php echo e((request()->routeIs('front.journals*') || request()->routeIs('front.journals*') == 1) ? 'active' : ''); ?>" href="<?php echo e(route('front.journals')); ?>"></i>Catálogos</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-4 cGrpOptsNav__c__cSchdule">
                            <div class="row g-3 w-100 cGrpOptsNav__c__cSchdule__c mt-0">
                                <div class="col-lg-4 cGrpOptsNav__c__cSchdule__c__i">
                                    <span class=""><strong>Lunes - Viernes</strong></span>
                                    <span><?php echo e($setting->friday_start); ?> - <?php echo e($setting->friday_end); ?></span>
                                </div>
                                <div class="col-lg-4 cGrpOptsNav__c__cSchdule__c__i">
                                    <span class=""><strong>Sábado</strong></span>
                                    <span><?php echo e($setting->satureday_start); ?> - <?php echo e($setting->satureday_end); ?></span>                                    
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
<?php echo $__env->yieldContent('content'); ?>
<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
    <?php if($setting->announcement_type == 'newletter'): ?>
    <div class="announcement-with-content">
        <div class="left-area">
            <img src="<?php echo e(asset('assets/images/'.$setting->announcement)); ?>" alt="">
        </div>
        <div class="right-area">
            <h3 class=""><?php echo e($setting->announcement_title); ?></h3>
            <p><?php echo e($setting->announcement_details); ?></p>
            <form class="subscriber-form" action="<?php echo e(route('front.subscriber.submit')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="Su Correo">
                    <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                </div>
                <button class="btn btn-primary btn-block mt-2" type="submit">
                    <span><?php echo e(__('Subscribe')); ?></span>
                </button>
            </form>
        </div>
    </div>
    <?php else: ?>
    <a href="<?php echo e($setting->announcement_link); ?>">
        <img src="<?php echo e(asset('assets/images/'.$setting->announcement)); ?>" alt="">
    </a>
    <?php endif; ?>
</div>
<section class="service-section" style="padding: 0px;">
    <div class="container" style="border: 1px solid #003399;border-radius: 10px;margin-bottom: 25px;">
        <div class="row">
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="<?php echo e(route('front.index')); ?>/assets/images/1669243396carro.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Envío a domicilio</h6>
                        <p class="text-sm text-muted mb-0">Recíbelo donde tu quieras</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="<?php echo e(route('front.index')); ?>/assets/images/1669243349tienda.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Retiro en tienda</h6>
                        <p class="text-sm text-muted mb-0">Compra online y ahorra en el envío</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="<?php echo e(route('front.index')); ?>/assets/images/1669244306mapa.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Nuestras tiendas</h6>
                        <p class="text-sm text-muted mb-0">Conoce todas nuestras tiendas</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-service single-service2">
                    <img src="<?php echo e(route('front.index')); ?>/assets/images/1669243456telefono.png" alt="Shipping">
                    <div class="content" style="margin-left: 11px;">
                        <h6 style="margin-bottom: 0px;color: #003399  !important;font-weight: bold;">Servicio al Cliente</h6>
                        <p class="text-sm text-muted mb-0"><a href="<?php echo e(route('front.index')); ?>/contact" style="color:#000;text-decoration: underline !important;">Estamos para atenderte</a></p>
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
            <h3 class="widget-title"><?php echo e(__('Get In Touch')); ?></h3>
            <p class="mb-1"><strong><?php echo e(__('Address')); ?>: </strong> <?php echo e($setting->footer_address); ?></p>
            <p class="mb-1"><strong><?php echo e(__('Phone')); ?>: </strong> <?php echo e($setting->footer_phone); ?></p>
            <p class="mb-3"><strong><?php echo e(__('Email')); ?>: </strong> <?php echo e($setting->footer_email); ?></p>
            <ul class="list-unstyled text-sm">
                <li>
                    <span class=""><strong><?php echo e(__('Monday-Friday')); ?>: </strong></span>
                    <span><?php echo e($setting->friday_start); ?> - <?php echo e($setting->friday_end); ?></span>
                </li>
                <li>
                    <span class=""><strong><?php echo e(__('Saturday')); ?>: </strong></span>
                    <span><?php echo e($setting->satureday_start); ?> - <?php echo e($setting->satureday_end); ?></span>
                </li>
            </ul>
            <?php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];
          ?>
            <div class="footer-social-links">
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link); ?>" target="_blank">
                    <span><i class="<?php echo e($icons[$link_key]); ?>"></i></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"><?php echo e(__('Usefull Links')); ?></h3>
            <ul>
                <?php if($setting->is_contact == 1): ?>
                <li class="<?php echo e(request()->routeIs('front.contact') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('front.contact')); ?>"><?php echo e(__('Contact')); ?></a>
                </li>
                <?php endif; ?>
                <?php $__currentLoopData = DB::table('pages')->wherePos(2)->orwhere('pos',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(route('front.page',$page->slug)); ?>"><?php echo e($page->title); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
            <section class="widget">
                <h3 class="widget-title"><?php echo e(__('Newsletter')); ?></h3>
                <form class="row subscriber-form" action="<?php echo e(route('front.subscriber.submit')); ?>" method="post">
                    <?php echo csrf_field(); ?>
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
                            <span><?php echo e(__('Subscribe')); ?></span>
                        </button>
                    </div>
                    <div class="col-lg-12">
                        <p class="text-sm opacity-80 pt-2"><?php echo e(__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')); ?></p>
                    </div>
                </form>
                <div class="pt-3">
                    <img class="d-block gateway_image" src="<?php echo e($setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png')); ?>" alt="credit-card_list" width="100" height="100" decoding="sync">
                </div>
            </section>
          </div>
      </div>
      <p class="footer-copyright"> <?php echo e($setting->copy_right); ?></p>
    </div>
</footer>
<div class="dark-backdrop hide" id="backdrop"></div>
<a class="scroll-to-top-btn" href="javascript:void(0);">
    <i class="icon-chevron-up"></i>
</a>
<div class="site-backdrop"></div>
<?php if($setting->is_cookie == 1): ?>
<?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php
    $mainbs = [];
    $mainbs['is_announcement'] = $setting->is_announcement;
    $mainbs['announcement_delay'] = $setting->announcement_delay;
    $mainbs['overlay'] = $setting->overlay;
    $mainbs = json_encode($mainbs);
?>
<script>
    var mainbs = <?php echo $mainbs; ?>;
    var decimal_separator = '<?php echo $setting->decimal_separator; ?>';
    var thousand_separator = '<?php echo $setting->thousand_separator; ?>';
</script>
<script>
    let language = {
        Days : "<?php echo e(__('Days')); ?>",
        Hrs : "<?php echo e(__('Hrs')); ?>",
        Min : "<?php echo e(__('Min')); ?>",
        Sec : "<?php echo e(__('Sec')); ?>",
    }
</script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/plugins.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/scripts.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/lazy.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/lazy.plugin.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/myscript.js')); ?>"></script>
<?php
  $wstpCollection = json_decode($setting->whatsapp_numbers, TRUE);
  $ArrwpsNumbersButton = "";
  $wps_generalButton = [];
  if(isset($wstpCollection['whatsapp_numbers'])){
    $ArrwpsNumbersButton = $wstpCollection['whatsapp_numbers'];
    if(isset($ArrwpsNumbersButton['general'])){
      $wps_generalButton = $ArrwpsNumbersButton['general'][0];
    }
  }
?>
<div id="WAButton"></div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/plugins/floating-whatsapp/floating-wpp.min.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/front/js/plugins/floating-whatsapp/floating-wpp.min.css')); ?>">
<?php if(isset($wstpCollection['whatsapp_numbers'])): ?>
    <?php
        $ArrwpsNumbersButton = $wstpCollection['whatsapp_numbers'];
    ?>
    <?php if(isset($ArrwpsNumbersButton['general'])): ?>
        <script type="text/javascript">
        $(function() {
            let imgWAButton = "<?php echo e(asset('assets/front/js/plugins/floating-whatsapp/whatsapp.svg')); ?>";
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
    <?php endif; ?>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if($setting->is_facebook_messenger	== '1'): ?>
 <?php echo $setting->facebook_messenger; ?>

<?php endif; ?>
<script type="text/javascript">
    let mainurl = "<?php echo e(route('front.index')); ?>";
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
    <?php if(Session::has('error')): ?>
    <script>
      $(document).ready(function(){
        DangerNotification("<?php echo e(Session::get('error')); ?>");
      });
    </script>
    <?php endif; ?>
    <?php if(Session::has('success')): ?>
    <script>
      $(document).ready(function(){
        SuccessNotification("<?php echo e(Session::get('success')); ?>");
      });
    </script>
    <?php endif; ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/master/front.blade.php ENDPATH**/ ?>