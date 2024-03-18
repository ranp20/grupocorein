<?php $__env->startSection('meta'); ?>
    <meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
    <meta name="description" content="<?php echo e($setting->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('node_modules/owl-carousel/owl-carousel/owl.carousel.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('node_modules/owl-carousel/owl-carousel/owl.theme.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('node_modules/owl-carousel/owl-carousel/owl.carousel.min.js')); ?>"></script>
    <?php
        function renderStarRating($rating, $maxRating = 5){
            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating ? $rating : $maxRating;

            $fullStarCount = (int) $rating;
            $halfStarCount = ceil($rating) - $fullStarCount;
            $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

            $html = str_repeat($fullStar, $fullStarCount);
            $html .= str_repeat($halfStar, $halfStarCount);
            $html .= str_repeat($emptyStar, $emptyStarCount);
            $html = $html;
            return $html;
        }

        $TaxesAll = DB::table('taxes')->get();
        $sumFinalPrice1 = 0;
        $sumFinalPrice2 = 0;
        $incIGV = $TaxesAll[0]->value;
        $sinIGV = $TaxesAll[1]->value;
        $incIGV_format = $incIGV / 100;
        $sinIGV_format = $sinIGV;

    ?>
    <?php if($extra_settings->is_t3_slider == 1): ?>
        <div  class="hero-area3" >
            <div class="background"></div>
            <div class="heroarea-slider owl-carousel">
                <?php
                /*
                echo "<pre>";
                print_r($sliders);
                echo "</pre>";
                */
                ?>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div class="item cSldcPrd1__m__itm" style="background: url('<?php echo e(asset('assets/images/' . $slider->photo)); ?>')">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 d-flex align-self-center">
                                <div class="left-content color-white">
                                    <div class="content"></div>
                                </div>
                            </div>
                            <?php if(isset($slider->logo) && $slider->logo != ""): ?>
                            <div class="col-xl-7 col-lg-6 order-first order-lg-last">
                                <div class="layer-4">
                                    <div class="right-img">
                                    <img class="img-fluid full-img" src="<?php echo e(asset('assets/images/' . $slider->logo)); ?>" alt="<?php echo e($slider->logo); ?>" width="100" height="100" decoding="sync">
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="bannner-section mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="h3">Categorías destacadas</h2>
                        <div class="c-LinksViewsAll__c">
                            <a href="<?php echo e(route('front.allcategories')); ?>" class="c-LinksViewsAll__c--cMob-link c-linkAc8S5__s57ds">
                                <span><?php echo e(__('View all')); ?> </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path d="M20.81,86.25a11.25,11.25,0,0,0,19.2,8L75.9,58.32a11.23,11.23,0,0,0,3.29-8c0-.13,0-.25,0-.37a11.2,11.2,0,0,0-3.28-8.32L40,5.79A11.25,11.25,0,0,0,24.1,21.7L52.4,50,24.1,78.3A11.23,11.23,0,0,0,20.81,86.25Z"/></svg>
                                </span>
                            </a>
                            <a href="<?php echo e(route('front.allcategories')); ?>" class="c-LinksViewsAll__c--cDesk-link c-linkAc8S5__s57ds">
                                <span><?php echo e(__('All Categories')); ?> </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path d="M20.81,86.25a11.25,11.25,0,0,0,19.2,8L75.9,58.32a11.23,11.23,0,0,0,3.29-8c0-.13,0-.25,0-.37a11.2,11.2,0,0,0-3.28-8.32L40,5.79A11.25,11.25,0,0,0,24.1,21.7L52.4,50,24.1,78.3A11.23,11.23,0,0,0,20.81,86.25Z"/></svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="contBannSec_1">

    <?php if($setting->is_three_c_b_first == 1): ?>
        <div class="bannner-section">
            <div>
                <div class="row gx-3">
                    <div class="col-md-4">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_first['firsturl1']); ?>" class="genius-banner" data-href="<?php echo e($banner_first['firsturl1']); ?>" title="<?php echo e((isset($banner_first['title1'])) ? $banner_first['title1'] : ''); ?>">
                            <img src="<?php echo e(asset('assets/images/'.$banner_first['img1'])); ?>" alt="<?php echo e(__('Category')); ?> <?php echo e($banner_first['firsturl1']); ?>" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                <?php if(isset($banner_first['title1'])): ?>
                                    <h4><?php echo e($banner_first['title1']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_first['firsturl2']); ?>" class="genius-banner" data-href="<?php echo e($banner_first['firsturl2']); ?>" title="<?php echo e((isset($banner_first['title1'])) ? $banner_first['title2'] : ''); ?>">
                            <img src="<?php echo e(asset('assets/images/'.$banner_first['img2'])); ?>" alt="<?php echo e(__('Category')); ?> <?php echo e($banner_first['firsturl2']); ?>" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                <?php if(isset($banner_first['title2'])): ?>
                                    <h4><?php echo e($banner_first['title2']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_first['firsturl3']); ?>" class="genius-banner" data-href="<?php echo e($banner_first['firsturl3']); ?>" title="<?php echo e((isset($banner_first['title1'])) ? $banner_first['title3'] : ''); ?>">
                            <img src="<?php echo e(asset('assets/images/'.$banner_first['img3'])); ?>" alt="<?php echo e(__('Category')); ?> <?php echo e($banner_first['firsturl3']); ?>" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                <?php if(isset($banner_first['title3'])): ?>
                                    <h4><?php echo e($banner_first['title3']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($setting->is_three_c_b_second == 1): ?>
        <div class="bannner-section mt-20">
            <div>
                <div class="row gx-3">
                    <div class="col-md-4">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_secend['url1']); ?>" class="genius-banner" data-href="<?php echo e($banner_secend['url1']); ?>" title="<?php echo e((isset($banner_secend['title1'])) ? $banner_secend['title1'] : ''); ?>">
                            <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$banner_secend['img1'])); ?>" alt="<?php echo e(__('Category')); ?> <?php echo e($banner_secend['url1']); ?>" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                <?php if(isset($banner_secend['title1'])): ?>
                                    <h4><?php echo e($banner_secend['title1']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_secend['url2']); ?>" class="genius-banner" data-href="<?php echo e($banner_secend['url2']); ?>" title="<?php echo e((isset($banner_secend['title2'])) ? $banner_secend['title2'] : ''); ?>">
                            <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$banner_secend['img2'])); ?>" alt="<?php echo e(__('Category')); ?> <?php echo e($banner_secend['url2']); ?>" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                <?php if(isset($banner_secend['title2'])): ?>
                                    <h4> <?php echo e($banner_secend['title2']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_secend['url3']); ?>" class="genius-banner" data-href="<?php echo e($banner_secend['url3']); ?>" title="<?php echo e((isset($banner_secend['title3'])) ? $banner_secend['title3'] : ''); ?>">
                            <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$banner_secend['img3'])); ?>" alt="<?php echo e(__('Category')); ?> <?php echo e($banner_secend['url3']); ?>" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                <?php if(isset($banner_secend['title3'])): ?>
                                    <h4><?php echo e($banner_secend['title3']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
    <?php if($setting->is_popular_category == 1): ?>
        <section class="newproduct-section popular-category-sec mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3"><?php echo e($popular_category_title); ?></h2>
                            <div class="links">
                                <?php $__currentLoopData = $popular_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $popular_categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="category_get <?php echo e($loop->first ? 'active' : ''); ?>" data-target="popular_category_view" data-href="<?php echo e(route('front.popular.category',[$popular_categorie->slug,'popular_category','slider'])); ?>"  href="javascript:;" class="<?php echo e($loop->first ? 'active' : ''); ?>"><?php echo e($popular_categorie->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popular_category_view d-none">
                    <img  src="<?php echo e(asset('assets/images/ajax_loader.gif')); ?>" alt="">
                </div>
                <div class="row" id="popular_category_view">
                    <div class="col-lg-12">
                        <div class="popular-category-slider  owl-carousel">
                            <?php $__currentLoopData = $popular_category_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular_category_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="slider-item">
                                <div class="product-card">
                                    <div class="product-thumb">
                                        <?php if(!$popular_category_item->is_stock()): ?>
                                            <div class="product-badge bg-secondary border-default text-body
                                            "><?php echo e(__('out of stock')); ?></div>
                                        <?php endif; ?>
                                        <?php if($popular_category_item->previous_price && $popular_category_item->previous_price !=0): ?>
                                        <div class="product-badge product-badge2 bg-info"> -<?php echo e(PriceHelper::DiscountPercentage($popular_category_item)); ?></div>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('front.product',$popular_category_item->slug)); ?>" class="d-flex align-items-center justify-content-center">
                                            <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$popular_category_item->thumbnail)); ?>" alt="Product">
                                        </a>
                                        <div class="product-button-group">
                                            <a class="product-button wishlist_store" href="<?php echo e(route('user.wishlist.store',$popular_category_item->id)); ?>" title="<?php echo e(__('Wishlist')); ?>"><i class="icon-heart"></i></a>
                                            <a data-target="<?php echo e(route('fornt.compare.product',$popular_category_item->id)); ?>" class="product-button product_compare" href="javascript:;" title="<?php echo e(__('Compare')); ?>"><i class="icon-repeat"></i></a>
                                            <?php echo $__env->make('includes.item_footer',['sitem'=>$popular_category_item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-category">
                                            <a href="<?php echo e(route('front.catalog').'?category='.$popular_category_item->category->slug); ?>"><?php echo e($popular_category_item->category->name); ?></a>
                                        </div>
                                        <h3 class="product-title text-bold">
                                            <a class="text-bold" href="<?php echo e(route('front.product',$popular_category_item->slug)); ?>"><?php echo e(strlen(strip_tags($popular_category_item->name)) > 35 ? substr(strip_tags($popular_category_item->name), 0, 35) : strip_tags($popular_category_item->name)); ?></a>
                                        </h3>
                                        <p class="product-sku__2">SKU: <?php echo e(strlen(strip_tags($popular_category_item->sku)) > 35 ? substr(strip_tags($popular_category_item->sku), 0, 35) : strip_tags($popular_category_item->sku)); ?></p>
                                        <h4 class="product-price">
                                        <?php if($popular_category_item->previous_price != 0): ?>
                                        <del><?php echo e(PriceHelper::setPreviousPrice($popular_category_item->previous_price)); ?></del>
                                        <?php endif; ?>
                                            <?php if(isset($popular_category_item->sections_id) && $popular_category_item->sections_id != 0): ?>
                                                <?php if($popular_category_item->sections_id == 1): ?>
                                                    <?php if($popular_category_item->on_sale_price != 0 && $popular_category_item->on_sale_price != ""): ?>
                                                        <?php if(isset($popular_category_item->tax_id) && $popular_category_item->tax_id == 1): ?>
                                                            <?php
                                                            $sumFinalPrice1 = $popular_category_item->on_sale_price * $incIGV_format;
                                                            $sumFinalPrice2 = $popular_category_item->on_sale_price + $sumFinalPrice1;
                                                            ?>
                                                            <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                        <?php else: ?>
                                                            <?php
                                                            $sumFinalPrice1 = $popular_category_item->on_sale_price;
                                                            $sumFinalPrice2 = $popular_category_item->on_sale_price + $sumFinalPrice1;
                                                            ?>
                                                            <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span><?php echo e(PriceHelper::setCurrencyPrice($popular_category_item->discount_price)); ?></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if($popular_category_item->special_offer_price != 0 && $popular_category_item->special_offer_price != ""): ?>
                                                        <?php if(isset($popular_category_item->tax_id) && $popular_category_item->tax_id == 1): ?>
                                                            <?php
                                                            $sumFinalPrice1 = $popular_category_item->special_offer_price * $incIGV_format;
                                                            $sumFinalPrice2 = $popular_category_item->special_offer_price + $sumFinalPrice1;
                                                            ?>
                                                            <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                        <?php else: ?>
                                                            <?php
                                                            $sumFinalPrice1 = $popular_category_item->special_offer_price;
                                                            $sumFinalPrice2 = $popular_category_item->special_offer_price + $sumFinalPrice1;
                                                            ?>
                                                            <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                    <span><?php echo e(PriceHelper::setCurrencyPrice($popular_category_item->discount_price)); ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span><?php echo e(PriceHelper::setCurrencyPrice($popular_category_item->discount_price)); ?></span>
                                            <?php endif; ?>
                                        </h4>
                                        <div class="cWtspBtnCtc">
                                            <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
                                                <img src="<?php echo e(route('front.index')); ?>/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" alt="whatsapp_icon" width="100" height="100" decoding="sync">
                                            </a>
                                            <div class="cWtspBtnCtc__pSubM">
                                                <?php if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers)): ?>
                                                <?php
                                                    $whatsappCollection = json_decode($setting->whatsapp_numbers, TRUE);
                                                    $ArrwpsNumbers = "";
                                                    $wps_inproducts = [];
                                                    if(isset($whatsappCollection['whatsapp_numbers'])){
                                                        $ArrwpsNumbers = $whatsappCollection['whatsapp_numbers'];
                                                        if(isset($ArrwpsNumbers['in_product'])){
                                                            $wps_inproducts = $ArrwpsNumbers['in_product'];
                                                        }
                                                    }
                                                ?>
                                                <ul class="cWtspBtnCtc__pSubM__m">
                                                    <?php $__currentLoopData = $wps_inproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="cWtspBtnCtc__pSubM__m__i">
                                                        <a title="<?php echo e($v['title']); ?>" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51<?php echo e($v['number']); ?>&text=<?php echo e($v['text']); ?>" target="_blank">
                                                            <img src="<?php echo e(asset('assets/images/Utilities')); ?>/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">                                                            
                                                            <span><?php echo e($v['title']); ?></span>
                                                        </a>
                                                    </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <?php else: ?>
                                                <p>No hay información</p>
                                                <?php endif; ?>
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if($setting->is_two_c_b == 1): ?>
        <div class="bannner-section mt-50">
            <div class="container ">
                <div class="row gx-3">
                    <div class="col-md-12">
                        <a href="<?php echo e(route('front.catalog').'?category='.$banner_third['url1']); ?>" data-href="<?php echo e($banner_third['url1']); ?>" class="">
                            <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$banner_third['img1'])); ?>" alt="<?php echo e((isset($banner_third['title1'])) ? $banner_third['title1'] : ''); ?>" width="100" height="100" decoding="sync">
                        </a>
                    </div>                 
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($setting->is_featured_category == 1): ?>
        <section class="selected-product-section featured_cat_sec sps-two mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3"><?php echo e($feature_category_title); ?></h2>
                            <div class="links">
                                <?php $__currentLoopData = $feature_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $feature_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="category_get <?php echo e($loop->first ? 'active' : ''); ?>" data-target="feature_category_view"  data-href="<?php echo e(route('front.popular.category',[$feature_category->slug,'feature_category','normal'])); ?>" href="javascript:;" class="<?php echo e($loop->first ? 'active' : ''); ?>"><?php echo e($feature_category->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature_category_view d-none">
                    <img  src="<?php echo e(asset('assets/images/ajax_loader.gif')); ?>" alt="" width="100" height="100" decoding="sync">
                </div>
                <div class="row g-3" id="feature_category_view">
                    <div class="col-lg-12">
                        <div class="feature-category-slider  owl-carousel">
                            <?php $__currentLoopData = $feature_category_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature_category_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="slider-item">
                                <div class="product-card">
                                    <div class="product-thumb" >
                                        <?php if(!$feature_category_item->is_stock()): ?>
                                            <div class="product-badge bg-secondary border-default text-body
                                            "><?php echo e(__('out of stock')); ?></div>
                                        <?php endif; ?>
                                        <?php if($feature_category_item->previous_price && $feature_category_item->previous_price !=0): ?>
                                        <div class="product-badge product-badge2 bg-info"> -<?php echo e(PriceHelper::DiscountPercentage($feature_category_item)); ?></div>
                                        <?php endif; ?>                                
                                        <a href="<?php echo e(route('front.product',$feature_category_item->slug)); ?>" class="d-flex align-items-center justify-content-center">
                                            <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$feature_category_item->thumbnail)); ?>" alt="Product">
                                        </a>
                                        <div class="product-button-group"><a class="product-button wishlist_store" href="<?php echo e(route('user.wishlist.store',$feature_category_item->id)); ?>" title="<?php echo e(__('Wishlist')); ?>"><i class="icon-heart"></i></a>
                                            <a data-target="<?php echo e(route('fornt.compare.product',$feature_category_item->id)); ?>" class="product-button product_compare" href="javascript:;" title="<?php echo e(__('Compare')); ?>"><i class="icon-repeat"></i></a>
                                            <?php echo $__env->make('includes.item_footer',['sitem'=>$feature_category_item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-category"><a href="<?php echo e(route('front.catalog').'?category='.$feature_category_item->category->slug); ?>"><?php echo e($feature_category_item->category->name); ?></a></div>
                                        <h3 class="product-title">
                                            <a href="<?php echo e(route('front.product',$feature_category_item->slug)); ?>">
                                            <?php echo e(strlen(strip_tags($feature_category_item->name)) > 35 ? substr(strip_tags($feature_category_item->name), 0, 35) : strip_tags($feature_category_item->name)); ?>

                                            </a>
                                        </h3>
                                        <p class="product-sku__2">SKU: <?php echo e(strlen(strip_tags($feature_category_item->sku)) > 35 ? substr(strip_tags($feature_category_item->sku), 0, 35) : strip_tags($feature_category_item->sku)); ?></p>
                                        <h4 class="product-price">
                                        <?php if($feature_category_item->previous_price != 0): ?>
                                        <del><?php echo e(PriceHelper::setPreviousPrice($feature_category_item->previous_price)); ?></del>
                                        <?php endif; ?>
                                        <?php if(isset($feature_category_item->sections_id) && $feature_category_item->sections_id != 0): ?>
                                            <?php if($feature_category_item->sections_id == 1): ?>
                                                <?php if($feature_category_item->on_sale_price != 0 && $feature_category_item->on_sale_price != ""): ?>
                                                    <?php if(isset($feature_category_item->tax_id) && $feature_category_item->tax_id == 1): ?>
                                                        <?php
                                                        $sumFinalPrice1 = $feature_category_item->on_sale_price * $incIGV_format;
                                                        $sumFinalPrice2 = $feature_category_item->on_sale_price + $sumFinalPrice1;
                                                        ?>
                                                        <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                    <?php else: ?>
                                                        <?php
                                                        $sumFinalPrice1 = $feature_category_item->on_sale_price;
                                                        $sumFinalPrice2 = $feature_category_item->on_sale_price + $sumFinalPrice1;
                                                        ?>
                                                        <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span><?php echo e(PriceHelper::setCurrencyPrice($feature_category_item->discount_price)); ?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($feature_category_item->special_offer_price != 0 && $feature_category_item->special_offer_price != ""): ?>
                                                    <?php if(isset($feature_category_item->tax_id) && $feature_category_item->tax_id == 1): ?>
                                                        <?php
                                                        $sumFinalPrice1 = $feature_category_item->special_offer_price * $incIGV_format;
                                                        $sumFinalPrice2 = $feature_category_item->special_offer_price + $sumFinalPrice1;
                                                        ?>
                                                        <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                    <?php else: ?>
                                                        <?php
                                                        $sumFinalPrice1 = $feature_category_item->special_offer_price;
                                                        $sumFinalPrice2 = $feature_category_item->special_offer_price + $sumFinalPrice1;
                                                        ?>
                                                        <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span><?php echo e(PriceHelper::setCurrencyPrice($feature_category_item->discount_price)); ?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span><?php echo e(PriceHelper::setCurrencyPrice($feature_category_item->discount_price)); ?></span>
                                        <?php endif; ?>
                                        </h4>
                                        <div class="cWtspBtnCtc">
                                            <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
                                                <img src="<?php echo e(route('front.index')); ?>/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" alt="whatsapp_icon" width="100" height="100" decoding="sync">
                                            </a>
                                            <div class="cWtspBtnCtc__pSubM">
                                                <?php if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers)): ?>
                                                <?php
                                                    $whatsappCollection = json_decode($setting->whatsapp_numbers, TRUE);
                                                    $ArrwpsNumbers = "";
                                                    $wps_inproducts = [];
                                                    if(isset($whatsappCollection['whatsapp_numbers'])){
                                                        $ArrwpsNumbers = $whatsappCollection['whatsapp_numbers'];
                                                        if(isset($ArrwpsNumbers['in_product'])){
                                                            $wps_inproducts = $ArrwpsNumbers['in_product'];
                                                        }
                                                    }
                                                ?>
                                                <ul class="cWtspBtnCtc__pSubM__m">
                                                    <?php $__currentLoopData = $wps_inproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="cWtspBtnCtc__pSubM__m__i">
                                                        <a title="<?php echo e($v['title']); ?>" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51<?php echo e($v['number']); ?>&text=<?php echo e($v['text']); ?>" target="_blank">
                                                            <img src="<?php echo e(asset('assets/images/Utilities')); ?>/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                                                            <span><?php echo e($v['title']); ?></span>
                                                        </a>
                                                    </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <?php else: ?>
                                                <p>No hay información</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if($setting->is_blogs == 1): ?>
        <div class="blog-section-h page_section mt-50 mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3"><?php echo e(__('Our Blog')); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" id="contInfoBlog_1">
                    <div class="col-lg-12">
                        <div class="home-blog-slider owl-carousel">
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="slider-item">
                                    <a href="<?php echo e(route('front.blog.details',$post->slug)); ?>" class="blog-post">
                                        <div class="post-thumb">
                                            <img class="lazy" data-src="<?php echo e(asset('assets/images/' . json_decode($post->photo, true)[array_key_first(json_decode($post->photo, true))])); ?>" alt="Blog Post" width="100" height="100" decoding="sync">
                                        </div>
                                        <div class="post-body">
                                            <h3 class="post-title"> <?php echo e(strlen(strip_tags($post->title)) > 100 ? substr(strip_tags($post->title), 0, 100) : strip_tags($post->title)); ?>

                                            </h3>
                                            <ul class="post-meta">
                                                <li><i class="icon-user"></i><?php echo e(__('SiteProyectName')); ?></li>
                                                <li><i class="icon-clock"></i><?php echo e(date('jS F, Y', strtotime($post->created_at))); ?></li>
                                            </ul>
                                            <p><?php echo e(strlen(strip_tags($post->details)) > 120 ? substr(strip_tags($post->details), 0, 120) : strip_tags($post->details)); ?>

                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($setting->is_popular_brand == 1): ?>
        <section class="brand-section mt-30 mb-60">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="section-title">
                            <h2 class="h3">Marcas</h2>
                        </div>
                    </div>
                </div>
                <div class="row" id="contBrandList_1">
                    <div class="col-lg-12">
                        <div class="brand-slider owl-carousel">
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="slider-item">
                                <a class="text-center" href="<?php echo e(route('front.catalog') . '?brand=' . $brand->slug); ?>">
                                    <img class="d-block hi-100 lazy" data-src="<?php echo e(asset('assets/images/' . $brand->photo)); ?>" alt="<?php echo e($brand->name); ?>" title="<?php echo e($brand->name); ?>" width="100" height="100" decoding="sync">
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/front/js/homepage.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/themes/theme1.blade.php ENDPATH**/ ?>