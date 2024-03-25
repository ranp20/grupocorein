@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('content')

    <link rel="stylesheet" href="{{ asset('node_modules/owl-carousel/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('node_modules/owl-carousel/owl-carousel/owl.theme.css')}}">
    <script type="text/javascript" src="{{ asset('node_modules/owl-carousel/owl-carousel/owl.carousel.min.js')}}"></script>
    @php
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

    @endphp
    @if ($extra_settings->is_t3_slider == 1)
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
                @foreach ($sliders as $slider)
                
                <div class="item cSldcPrd1__m__itm" style="background: url('{{ asset('assets/images/' . $slider->photo) }}')">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 d-flex align-self-center">
                                <div class="left-content color-white">
                                    <div class="content"></div>
                                </div>
                            </div>
                            @if (isset($slider->logo) && $slider->logo != "")
                            <div class="col-xl-7 col-lg-6 order-first order-lg-last">
                                <div class="layer-4">
                                    <div class="right-img">
                                    <img class="img-fluid full-img" src="{{ asset('assets/images/' . $slider->logo) }}" alt="{{$slider->logo}}" width="100" height="100" decoding="sync">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="bannner-section mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="h3">Categorías destacadas</h2>
                        <div class="c-LinksViewsAll__c">
                            <a href="{{ route('front.allcategories') }}" class="c-LinksViewsAll__c--cMob-link c-linkAc8S5__s57ds">
                                <span>{{__('View all')}} </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path d="M20.81,86.25a11.25,11.25,0,0,0,19.2,8L75.9,58.32a11.23,11.23,0,0,0,3.29-8c0-.13,0-.25,0-.37a11.2,11.2,0,0,0-3.28-8.32L40,5.79A11.25,11.25,0,0,0,24.1,21.7L52.4,50,24.1,78.3A11.23,11.23,0,0,0,20.81,86.25Z"/></svg>
                                </span>
                            </a>
                            <a href="{{ route('front.allcategories') }}" class="c-LinksViewsAll__c--cDesk-link c-linkAc8S5__s57ds">
                                <span>{{__('All Categories')}} </span>
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

    @if ($setting->is_three_c_b_first == 1)
        <div class="bannner-section">
            <div>
                <div class="row gx-3">
                    <div class="col-md-4">
                        <a href="{{ route('front.catalog').'?category='.$banner_first['firsturl1'] }}" class="genius-banner" data-href="{{ $banner_first['firsturl1'] }}" title="{{ (isset($banner_first['title1'])) ? $banner_first['title1'] : '' }}">
                            <img src="{{ asset('assets/images/'.$banner_first['img1']) }}" alt="{{ __('Category') }} {{ $banner_first['firsturl1'] }}" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                @if (isset($banner_first['title1']))
                                    <h4>{{$banner_first['title1']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('front.catalog').'?category='.$banner_first['firsturl2'] }}" class="genius-banner" data-href="{{ $banner_first['firsturl2'] }}" title="{{ (isset($banner_first['title1'])) ? $banner_first['title2'] : '' }}">
                            <img src="{{ asset('assets/images/'.$banner_first['img2']) }}" alt="{{ __('Category') }} {{ $banner_first['firsturl2'] }}" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                @if (isset($banner_first['title2']))
                                    <h4>{{$banner_first['title2']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('front.catalog').'?category='.$banner_first['firsturl3'] }}" class="genius-banner" data-href="{{ $banner_first['firsturl3'] }}" title="{{ (isset($banner_first['title1'])) ? $banner_first['title3'] : '' }}">
                            <img src="{{ asset('assets/images/'.$banner_first['img3']) }}" alt="{{ __('Category') }} {{ $banner_first['firsturl3'] }}" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                @if (isset($banner_first['title3']))
                                    <h4>{{$banner_first['title3']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($setting->is_three_c_b_second == 1)
        <div class="bannner-section mt-20">
            <div>
                <div class="row gx-3">
                    <div class="col-md-4">
                        <a href="{{ route('front.catalog').'?category='.$banner_secend['url1'] }}" class="genius-banner" data-href="{{ $banner_secend['url1'] }}" title="{{ (isset($banner_secend['title1'])) ? $banner_secend['title1'] : '' }}">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_secend['img1']) }}" alt="{{ __('Category') }} {{ $banner_secend['url1'] }}" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                @if (isset($banner_secend['title1']))
                                    <h4>{{$banner_secend['title1']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('front.catalog').'?category='.$banner_secend['url2'] }}" class="genius-banner" data-href="{{ $banner_secend['url2'] }}" title="{{ (isset($banner_secend['title2'])) ? $banner_secend['title2'] : '' }}">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_secend['img2']) }}" alt="{{ __('Category') }} {{ $banner_secend['url2'] }}" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                @if (isset($banner_secend['title2']))
                                    <h4> {{$banner_secend['title2']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('front.catalog').'?category='.$banner_secend['url3'] }}" class="genius-banner" data-href="{{ $banner_secend['url3'] }}" title="{{ (isset($banner_secend['title3'])) ? $banner_secend['title3'] : '' }}">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_secend['img3']) }}" alt="{{ __('Category') }} {{ $banner_secend['url3'] }}" width="100" height="100" decoding="sync">
                            <div class="inner-content">
                                @if (isset($banner_secend['title3']))
                                    <h4>{{$banner_secend['title3']}}</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
    @if ($setting->is_popular_category == 1)
        <section class="newproduct-section popular-category-sec mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ $popular_category_title }}</h2>
                            <div class="links">
                                @foreach ($popular_categories as $key => $popular_categorie)
                                <a class="category_get {{$loop->first ? 'active' : ''}}" data-target="popular_category_view" data-href="{{route('front.popular.category',[$popular_categorie->slug,'popular_category','slider'])}}"  href="javascript:;" class="{{$loop->first ? 'active' : ''}}">{{$popular_categorie->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popular_category_view d-none">
                    <img  src="{{asset('assets/images/ajax_loader.gif')}}" alt="">
                </div>
                <div class="row" id="popular_category_view">
                    <div class="col-lg-12">
                        <div class="popular-category-slider  owl-carousel">
                            @foreach ($popular_category_items as $popular_category_item)
                            <div class="slider-item">
                                <div class="product-card">
                                    <div class="product-thumb">
                                        @if (!$popular_category_item->is_stock())
                                            <div class="product-badge bg-secondary border-default text-body
                                            ">{{__('out of stock')}}</div>
                                        @endif
                                        @if($popular_category_item->previous_price && $popular_category_item->previous_price !=0)
                                        <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($popular_category_item)}}</div>
                                        @endif
                                        <a href="{{route('front.product',$popular_category_item->slug)}}" class="d-flex align-items-center justify-content-center">
                                            <img class="lazy" data-src="{{asset('assets/images/'.$popular_category_item->thumbnail)}}" alt="Product">
                                        </a>
                                        <div class="product-button-group">
                                            <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$popular_category_item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                            <a data-target="{{route('fornt.compare.product',$popular_category_item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                            @include('includes.item_footer',['sitem'=>$popular_category_item])
                                        </div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-category">
                                            <a href="{{route('front.catalog').'?category='.$popular_category_item->category->slug}}">{{$popular_category_item->category->name}}</a>
                                        </div>
                                        <h3 class="product-title text-bold">
                                            <a class="text-bold" href="{{route('front.product',$popular_category_item->slug)}}">{{ strlen(strip_tags($popular_category_item->name)) > 35 ? substr(strip_tags($popular_category_item->name), 0, 35) : strip_tags($popular_category_item->name) }}</a>
                                        </h3>
                                        <p class="product-sku__2">SKU: {{ strlen(strip_tags($popular_category_item->sku)) > 35 ? substr(strip_tags($popular_category_item->sku), 0, 35) : strip_tags($popular_category_item->sku) }}</p>
                                        <h4 class="product-price">
                                        @if ($popular_category_item->previous_price != 0)
                                        <del>{{PriceHelper::setPreviousPrice($popular_category_item->previous_price)}}</del>
                                        @endif
                                            @if(isset($popular_category_item->sections_id) && $popular_category_item->sections_id != 0)
                                                @if($popular_category_item->sections_id == 1)
                                                    @if($popular_category_item->on_sale_price != 0 && $popular_category_item->on_sale_price != "")
                                                        @if(isset($popular_category_item->tax_id) && $popular_category_item->tax_id == 1)
                                                            @php
                                                            $sumFinalPrice1 = $popular_category_item->on_sale_price * $incIGV_format;
                                                            $sumFinalPrice2 = $popular_category_item->on_sale_price + $sumFinalPrice1;
                                                            @endphp
                                                            <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                        @else
                                                            @php
                                                            $sumFinalPrice1 = $popular_category_item->on_sale_price;
                                                            $sumFinalPrice2 = $popular_category_item->on_sale_price + $sumFinalPrice1;
                                                            @endphp
                                                            <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                        @endif
                                                    @else
                                                        <span>{{PriceHelper::setCurrencyPrice($popular_category_item->discount_price)}}</span>
                                                    @endif
                                                @else
                                                    @if($popular_category_item->special_offer_price != 0 && $popular_category_item->special_offer_price != "")
                                                        @if(isset($popular_category_item->tax_id) && $popular_category_item->tax_id == 1)
                                                            @php
                                                            $sumFinalPrice1 = $popular_category_item->special_offer_price * $incIGV_format;
                                                            $sumFinalPrice2 = $popular_category_item->special_offer_price + $sumFinalPrice1;
                                                            @endphp
                                                            <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                        @else
                                                            @php
                                                            $sumFinalPrice1 = $popular_category_item->special_offer_price;
                                                            $sumFinalPrice2 = $popular_category_item->special_offer_price + $sumFinalPrice1;
                                                            @endphp
                                                            <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                        @endif
                                                    @else
                                                    <span>{{PriceHelper::setCurrencyPrice($popular_category_item->discount_price)}}</span>
                                                    @endif
                                                @endif
                                            @else
                                                <span>{{PriceHelper::setCurrencyPrice($popular_category_item->discount_price)}}</span>
                                            @endif
                                        </h4>
                                        <div class="cWtspBtnCtc">
                                            <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
                                                <img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" alt="whatsapp_icon" width="100" height="100" decoding="sync">
                                            </a>
                                            <div class="cWtspBtnCtc__pSubM">
                                                @if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers))
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
                                                    @foreach ($wps_inproducts as $k => $v)
                                                    <li class="cWtspBtnCtc__pSubM__m__i">
                                                        <a title="{{ $v['title'] }}" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51{{ $v['number'] }}&text={{ $v['text'] }}" target="_blank">
                                                            <img src="{{ asset('assets/images/Utilities') }}/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">                                                            
                                                            <span>{{ $v['title'] }}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <p>No hay información</p>
                                                @endif
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($setting->is_two_c_b == 1)
        <div class="bannner-section mt-50">
            <div class="container ">
                <div class="row gx-3">
                    <div class="col-md-12">
                        <a href="{{ route('front.catalog').'?category='.$banner_third['url1']}}" data-href="{{ $banner_third['url1'] }}" class="">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_third['img1']) }}" alt="{{ (isset($banner_third['title1'])) ? $banner_third['title1'] : '' }}" width="100" height="100" decoding="sync">
                        </a>
                    </div>                 
                </div>
            </div>
        </div>
    @endif
    @if ($setting->is_featured_category == 1)
        <section class="selected-product-section featured_cat_sec sps-two mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ $feature_category_title }}</h2>
                            <div class="links">
                                @foreach ($feature_categories as $key => $feature_category)
                                <a class="category_get {{$loop->first ? 'active' : ''}}" data-target="feature_category_view"  data-href="{{route('front.popular.category',[$feature_category->slug,'feature_category','normal'])}}" href="javascript:;" class="{{$loop->first ? 'active' : ''}}">{{$feature_category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature_category_view d-none">
                    <img  src="{{asset('assets/images/ajax_loader.gif')}}" alt="" width="100" height="100" decoding="sync">
                </div>
                <div class="row g-3" id="feature_category_view">
                    <div class="col-lg-12">
                        <div class="feature-category-slider  owl-carousel">
                            @foreach ($feature_category_items as $feature_category_item)
                            <div class="slider-item">
                                <div class="product-card">
                                    <div class="product-thumb" >
                                        @if (!$feature_category_item->is_stock())
                                            <div class="product-badge bg-secondary border-default text-body
                                            ">{{__('out of stock')}}</div>
                                        @endif
                                        @if($feature_category_item->previous_price && $feature_category_item->previous_price !=0)
                                        <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($feature_category_item)}}</div>
                                        @endif                                
                                        <a href="{{route('front.product',$feature_category_item->slug)}}" class="d-flex align-items-center justify-content-center">
                                            <img class="lazy" data-src="{{asset('assets/images/'.$feature_category_item->thumbnail)}}" alt="Product">
                                        </a>
                                        <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$feature_category_item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                                            <a data-target="{{route('fornt.compare.product',$feature_category_item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                            @include('includes.item_footer',['sitem'=>$feature_category_item])
                                        </div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-category"><a href="{{route('front.catalog').'?category='.$feature_category_item->category->slug}}">{{$feature_category_item->category->name}}</a></div>
                                        <h3 class="product-title">
                                            <a href="{{route('front.product',$feature_category_item->slug)}}">
                                            {{ strlen(strip_tags($feature_category_item->name)) > 35 ? substr(strip_tags($feature_category_item->name), 0, 35) : strip_tags($feature_category_item->name) }}
                                            </a>
                                        </h3>
                                        <p class="product-sku__2">SKU: {{ strlen(strip_tags($feature_category_item->sku)) > 35 ? substr(strip_tags($feature_category_item->sku), 0, 35) : strip_tags($feature_category_item->sku) }}</p>
                                        <h4 class="product-price">
                                        @if ($feature_category_item->previous_price != 0)
                                        <del>{{PriceHelper::setPreviousPrice($feature_category_item->previous_price)}}</del>
                                        @endif
                                        @if(isset($feature_category_item->sections_id) && $feature_category_item->sections_id != 0)
                                            @if($feature_category_item->sections_id == 1)
                                                @if($feature_category_item->on_sale_price != 0 && $feature_category_item->on_sale_price != "")
                                                    @if(isset($feature_category_item->tax_id) && $feature_category_item->tax_id == 1)
                                                        @php
                                                        $sumFinalPrice1 = $feature_category_item->on_sale_price * $incIGV_format;
                                                        $sumFinalPrice2 = $feature_category_item->on_sale_price + $sumFinalPrice1;
                                                        @endphp
                                                        <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                    @else
                                                        @php
                                                        $sumFinalPrice1 = $feature_category_item->on_sale_price;
                                                        $sumFinalPrice2 = $feature_category_item->on_sale_price + $sumFinalPrice1;
                                                        @endphp
                                                        <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                    @endif
                                                @else
                                                    <span>{{PriceHelper::setCurrencyPrice($feature_category_item->discount_price)}}</span>
                                                @endif
                                            @else
                                                @if($feature_category_item->special_offer_price != 0 && $feature_category_item->special_offer_price != "")
                                                    @if(isset($feature_category_item->tax_id) && $feature_category_item->tax_id == 1)
                                                        @php
                                                        $sumFinalPrice1 = $feature_category_item->special_offer_price * $incIGV_format;
                                                        $sumFinalPrice2 = $feature_category_item->special_offer_price + $sumFinalPrice1;
                                                        @endphp
                                                        <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                    @else
                                                        @php
                                                        $sumFinalPrice1 = $feature_category_item->special_offer_price;
                                                        $sumFinalPrice2 = $feature_category_item->special_offer_price + $sumFinalPrice1;
                                                        @endphp
                                                        <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                                                    @endif
                                                @else
                                                    <span>{{PriceHelper::setCurrencyPrice($feature_category_item->discount_price)}}</span>
                                                @endif
                                            @endif
                                        @else
                                            <span>{{PriceHelper::setCurrencyPrice($feature_category_item->discount_price)}}</span>
                                        @endif
                                        </h4>
                                        <div class="cWtspBtnCtc">
                                            <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
                                                <img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" alt="whatsapp_icon" width="100" height="100" decoding="sync">
                                            </a>
                                            <div class="cWtspBtnCtc__pSubM">
                                                @if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers))
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
                                                    @foreach ($wps_inproducts as $k => $v)
                                                    <li class="cWtspBtnCtc__pSubM__m__i">
                                                        <a title="{{ $v['title'] }}" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51{{ $v['number'] }}&text={{ $v['text'] }}" target="_blank">
                                                            <img src="{{ asset('assets/images/Utilities') }}/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                                                            <span>{{ $v['title'] }}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <p>No hay información</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($setting->is_blogs == 1)
        <div class="blog-section-h page_section mt-50 mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ __('Our Blog') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" id="contInfoBlog_1">
                    <div class="col-lg-12">
                        <div class="home-blog-slider owl-carousel">
                            @foreach ($posts as $post)
                                <div class="slider-item">
                                    <a href="{{route('front.blog.details',$post->slug)}}" class="blog-post">
                                        <div class="post-thumb">
                                            <img class="lazy" data-src="{{ asset('assets/images/' . json_decode($post->photo, true)[array_key_first(json_decode($post->photo, true))]) }}" alt="Blog Post" width="100" height="100" decoding="sync">
                                        </div>
                                        <div class="post-body">
                                            <h3 class="post-title"> {{ strlen(strip_tags($post->title)) > 100 ? substr(strip_tags($post->title), 0, 100) : strip_tags($post->title) }}
                                            </h3>
                                            <ul class="post-meta">
                                                <li><i class="icon-user"></i>{{ __('SiteProyectName') }}</li>
                                                <li><i class="icon-clock"></i>{{ date('jS F, Y', strtotime($post->created_at)) }}</li>
                                            </ul>
                                            <p>{{ strlen(strip_tags($post->details)) > 120 ? substr(strip_tags($post->details), 0, 120) : strip_tags($post->details) }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($setting->is_popular_brand == 1)
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
                            @foreach ($brands as $brand)
                            <?php

                            //Combiar arrays de Foto principal y fotos de galería
                            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                            $urlBaseDomain = $actual_link . "/grupocorein/"; // LOCAL
                            // $urlBaseDomain = $actual_link . "/"; // SERVIDOR
                            // Directorio donde se encuentra la imagen
                            $imgDirectoryPhoto = $urlBaseDomain . 'assets/images/';
                            $imgDirectoryDefault = $urlBaseDomain . 'assets/images/Utilities/default_product.png';
                            // Ruta completa de la imagen
                            $routePhotoBrand = $imgDirectoryPhoto . $brand->photo;
                            $routePhotoFinal = "";

                            ?>
                            <div class="slider-item">
                                <a class="text-center" href="{{ route('front.catalog') . '?brand=' . $brand->slug }}">
                                    <img class="d-block hi-100 lazy" data-src="{{ asset('assets/images/' . $brand->photo) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}" width="100" height="100" decoding="sync">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <script type="text/javascript" src="{{ asset('assets/front/js/homepage.js') }}"></script>
    <script type="text/javascript">
        // $(document).ready(function(){
        //     let imgDirectoryDefault = "{{ $imgDirectoryDefault}}";
        //     $('img').each(function(){
        //         if($(this)[0].naturalHeight == 0){
        //             $(this).attr('src',imgDirectoryDefault);
        //         }
        //     });
        // });
    </script>
@endsection