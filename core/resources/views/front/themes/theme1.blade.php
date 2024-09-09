@extends('master.front')
@section('meta')
  <meta name="keywords" content="{{ $setting->meta_keywords }}">
  <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('content')
  <!-- OWLCAROUSEL -->
  <link rel="stylesheet" href="{{ asset('node_modules/owl-carousel/owl-carousel/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{ asset('node_modules/owl-carousel/owl-carousel/owl.theme.css')}}">
  <script type="text/javascript" src="{{ asset('node_modules/owl-carousel/owl-carousel/owl.carousel.min.js')}}"></script>
  <!-- SWIPERJS -->
  <link rel="stylesheet" href="{{ asset('node_modules/swiper/swiper-bundle.min.css') }}">
  <script type="text/javascript" src="{{ asset('node_modules/swiper/swiper-bundle.min.js') }}"></script>
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

    $user_id = 0;
    if(Auth::check()){
      if(!empty(auth()->user()) || auth()->user() != ""){
        $user = Auth::user();
        $user_id = Auth::user()->id;
      }
    }
  @endphp
  @if($extra_settings->is_t3_slider == 1)
    <div class="hero-area3 swiper mySwiperHeroImage">
      <div class="background"></div>
      <!-- <div class="heroarea-slider owl-carousel"> -->
      <div class="heroarea-slider swiper-wrapper">
        @foreach($sliders as $slider)
        <div class="item cSldcPrd1__m__itm swiper-slide" style="background: url('{{ asset('assets/images/sliders/'.$slider->photo) }}')">
          {{--
          <!-- <img src="{{ asset('assets/images/sliders/'.$slider->photo) }}" alt="" width="100" height="100"> -->
          --}}
          @if($slider->content_check != "false")
            @if($slider->content_info != "")
              @php
                $content_infoFormat = json_decode($slider->content_info, TRUE);
                $content_alignment = "";
                if($content_infoFormat['content_alignment'] == '2'){
                  $content_alignment = "c-alignment--center";
                }else if($content_infoFormat['content_alignment'] == '3'){
                  $content_alignment = "c-alignment--right";
                }else{
                  $content_alignment = "c-alignment--left";
                }
              @endphp
              <div class="container">
                <div class="row">
                  <div class="col-xl-5 col-lg-6 d-flex align-self-center {{ $content_alignment }}">
                    <div class="left-content color-white">
                      <div class="content">
                        <div class="cSldcPrd1__m__itm__c">
                          <div class="cSldcPrd1__m__itm__c--cTitle">
                            <h2>{{ $content_infoFormat['content_title'] }}</h2>
                          </div>
                          <div class="cSldcPrd1__m__itm__c--cDesc">
                            <p>{{ $content_infoFormat['content_description'] }}</p>
                          </div>
                          @if($content_infoFormat['content_btncheck'] != "off")
                          <div class="cSldcPrd1__m__itm__c--cBtnLink">
                            <a href="{{ $content_infoFormat['content_btn_link'] }}" class="btn btn-primary" title="{{ $content_infoFormat['content_btn_title'] }}">
                              <span>{{ $content_infoFormat['content_btn_title'] }}</span>
                            </a>
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  @if(isset($slider->logo) && $slider->logo != "")
                  <div class="col-xl-7 col-lg-6 order-first order-lg-last">
                    <div class="layer-4">
                      <div class="right-img">
                        <img class="img-fluid full-img" src="{{ asset('assets/images/sliders/'.$slider->logo) }}" alt="{{$slider->logo}}" width="100" height="100" decoding="sync">
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            @endif
          @endif
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
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
    @if($setting->is_three_c_b_first == 1)
      <div class="categories-f__desing-2">
        <div class="container">
          <div class="wrapper">
            <div class="categoryf-wrapper c-md-3">
              <a class="shop-card card-grid-item c-md-3" href="{{ route('front.catalog').'?category='.$banner_first['firsturl1'] }}" data-href="{{ $banner_first['firsturl1'] }}" title="{{ (isset($banner_first['title1'])) ? $banner_first['title1'] : '' }}">
                <div class="shop-card__content card-grid-content-img">
                  <img class="img-fluid" decoding="async" src="{{ asset('assets/images/banners/'.$banner_first['img1']) }}" alt="{{ __('Category') }} {{ $banner_first['firsturl1'] }}" width="100" height="100" decoding="sync">
                </div>
                <div class="shop-card__footer card-grid-footer">
                  @if(isset($banner_first['title1']))
                    <h4 class="card-grid-item__title">{{$banner_first['title1']}}</h4>
                  @endif
                </div>
              </a>
            </div>
            <div class="categoryf-wrapper c-md-3">
              <a class="shop-card card-grid-item c-md-3" href="{{ route('front.catalog').'?category='.$banner_first['firsturl2'] }}" data-href="{{ $banner_first['firsturl2'] }}" title="{{ (isset($banner_first['title1'])) ? $banner_first['title2'] : '' }}">
                <div class="shop-card__content card-grid-content-img">
                  <img class="img-fluid" decoding="async" src="{{ asset('assets/images/banners/'.$banner_first['img2']) }}" alt="{{ __('Category') }} {{ $banner_first['firsturl2'] }}" width="100" height="100" decoding="sync">
                </div>
                <div class="shop-card__footer card-grid-footer">
                  @if(isset($banner_first['title2']))
                    <h4 class="card-grid-item__title">{{$banner_first['title2']}}</h4>
                  @endif
                </div>
              </a>
            </div>
            <div class="categoryf-wrapper c-md-3">
              <a class="shop-card card-grid-item c-md-3" href="{{ route('front.catalog').'?category='.$banner_first['firsturl3'] }}" data-href="{{ $banner_first['firsturl3'] }}" title="{{ (isset($banner_first['title1'])) ? $banner_first['title3'] : '' }}">
                <div class="shop-card__content card-grid-content-img">
                  <img class="img-fluid" decoding="async" src="{{ asset('assets/images/banners/'.$banner_first['img3']) }}" alt="{{ __('Category') }} {{ $banner_first['firsturl3'] }}" width="100" height="100" decoding="sync">
                </div>
                <div class="shop-card__footer card-grid-footer">
                  @if(isset($banner_first['title3']))
                    <h4 class="card-grid-item__title">{{$banner_first['title3']}}</h4>
                  @endif
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    @endif
    @if($setting->is_three_c_b_second == 1)
      <div class="categories-f__desing-2">
        <div class="container">
          <div class="wrapper">
            <div class="categoryf-wrapper c-md-3">
              <a class="shop-card card-grid-item c-md-3" href="{{ route('front.catalog').'?category='.$banner_secend['url1'] }}" data-href="{{ $banner_secend['url1'] }}" title="{{ (isset($banner_secend['title1'])) ? $banner_secend['title1'] : '' }}">
                <div class="shop-card__content card-grid-content-img">  
                  <img class="lazy" data-src="{{ asset('assets/images/banners/'.$banner_secend['img1']) }}" alt="{{ __('Category') }} {{ $banner_secend['url1'] }}" width="100" height="100" decoding="sync">
                </div>
                <div class="shop-card__footer card-grid-footer">
                  @if(isset($banner_secend['title1']))
                    <h4 class="card-grid-item__title">{{$banner_secend['title1']}}</h4>
                  @endif
                </div>
              </a>
            </div>
            <div class="categoryf-wrapper c-md-3">
              <a class="shop-card card-grid-item c-md-3" href="{{ route('front.catalog').'?category='.$banner_secend['url2'] }}" data-href="{{ $banner_secend['url2'] }}" title="{{ (isset($banner_secend['title2'])) ? $banner_secend['title2'] : '' }}">
                <div class="shop-card__content card-grid-content-img">
                  <img class="lazy" data-src="{{ asset('assets/images/banners/'.$banner_secend['img2']) }}" alt="{{ __('Category') }} {{ $banner_secend['url2'] }}" width="100" height="100" decoding="sync">
                </div>
                <div class="shop-card__footer card-grid-footer">
                  @if(isset($banner_secend['title2']))
                    <h4 class="card-grid-item__title">{{$banner_secend['title2']}}</h4>
                  @endif
                </div>
              </a>
            </div>
            <div class="categoryf-wrapper c-md-3">
              <a class="shop-card card-grid-item c-md-3" href="{{ route('front.catalog').'?category='.$banner_secend['url3'] }}" data-href="{{ $banner_secend['url3'] }}" title="{{ (isset($banner_secend['title3'])) ? $banner_secend['title3'] : '' }}">
                <div class="shop-card__content card-grid-content-img">  
                  <img class="lazy" data-src="{{ asset('assets/images/banners/'.$banner_secend['img3']) }}" alt="{{ __('Category') }} {{ $banner_secend['url3'] }}" width="100" height="100" decoding="sync">
                </div>
                <div class="shop-card__footer card-grid-footer">
                  @if(isset($banner_secend['title3']))
                    <h4 class="card-grid-item__title">{{$banner_secend['title3']}}</h4>
                  @endif
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
  @if($setting->is_popular_category == 1)
    <section class="newproduct-section popular-category-sec mt-50">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2 class="h3">{{ $popular_category_title }}</h2>
              <div class="links">
                @foreach($popular_categories as $key => $popular_categorie)
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
          @if(!empty($popular_category_items) && count($popular_category_items) > 0)
          <div class="col-lg-12">
            <div class="popular-category-slider owl-carousel">
              @foreach($popular_category_items as $popularcateg_item)
                <?php
                  $TaxesAll = DB::table('taxes')->get();
                  $incIGV = $TaxesAll[0]->value;
                  $sinIGV = $TaxesAll[1]->value;
                  $incIGV_format = $incIGV / 100;
                  $sinIGV_format = $sinIGV;
                  $sumFinalPrice1 = 0;
                  $sumFinalPrice2 = 0;
                  $coupinf_discount_percentage = 0;
                  $coupinf_discount_percentage_nonapply = 0;
                  $couponInfo_totalprice = 0;
                  $getAllCouponInfo = [];
                  $getAllDataCouponById = [];
                  $getAllDataCouponById_nonapply = [];
                  $allCouponDataConvertById = [];
                  $allCouponDataConvertById_nonapply = [];
                  $sumTotalPriceFinal = 0;
                  $sumTotalDiscountPriceFinalPrevious = 0;
                  $txtFlagToProduct = "";
                  $txtFlagAvaiCouponToProduct = "";
                  // --------------- VALIDAR SI YA SE ACTIVÓ UN CUPÓN EN EL PRODUCTO ('tbl_applycoupons')
                  if(!empty($popularcateg_item->coupon_id) && $popularcateg_item->coupon_id != "" && $popularcateg_item->coupon_id != null && $popularcateg_item->coupon_id != 0){
                    $getAllCouponInfo = DB::table('tbl_applycoupons')->where("id_user","=",$user_id)->where("id_prod","=",$popularcateg_item->id)->where("id_coupon","=",$popularcateg_item->coupon_id)->where("status","!=",0)->select('id_user', 'id_prod', 'id_coupon', 'totalprice')->take(1)->get();
                    if(count($getAllCouponInfo) > 0){
                      $txtFlagAvaiCouponToProduct = "txt-yesapply";
                      $allDataConvert = json_decode($getAllCouponInfo, TRUE);
                      $getAllDataCouponById = DB::table('tbl_coupons')->where("id","=",$allDataConvert[0]['id_coupon'])->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
                      if(count($getAllDataCouponById) > 0){
                        $allCouponDataConvertById = json_decode($getAllDataCouponById, TRUE);
                        $coupinf_discount_percentage = $allCouponDataConvertById[0]['discount_percentage'];
                        $couponInfo_totalprice = $allDataConvert[0]['totalprice']; // SETEAR LA VARIABLE DE PRECIO TOTAL PARA CUPÓN ACTIVADO
                      }
                    }else{
                      $txtFlagAvaiCouponToProduct = "txt-nonapply";
                      $getAllDataCouponById_nonapply = DB::table('tbl_coupons')->where("id","=",$popularcateg_item->coupon_id)->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
                      if(count($getAllDataCouponById_nonapply) > 0){
                        $allCouponDataConvertById_nonapply = json_decode($getAllDataCouponById_nonapply, TRUE);
                        $coupinf_discount_percentage_nonapply = $allCouponDataConvertById_nonapply[0]['discount_percentage'];
                      }
                    }
                  }
        
                  if($popularcateg_item->sections_id != 0){
                    if($popularcateg_item->sections_id == 1 && $popularcateg_item->on_sale_price != 0 && $popularcateg_item->on_sale_price != ""){
                      if($popularcateg_item->tax_id == 1){
                        $sumFinalPrice1 = $popularcateg_item->on_sale_price * $incIGV_format;
                        $sumFinalPrice2 = $popularcateg_item->on_sale_price + $sumFinalPrice1;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-on_sale";
                          $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->discount_price; // PRECIO ACTUAL (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }else{
                        $sumFinalPrice2 = $popularcateg_item->on_sale_price;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-on_sale";
                          $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->discount_price; // PRECIO ACTUAL (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }
                    }else if($popularcateg_item->sections_id == 2 && $popularcateg_item->special_offer_price != 0 && $popularcateg_item->special_offer_price != ""){
                      if($popularcateg_item->tax_id == 1){
                        $sumFinalPrice1 = $popularcateg_item->special_offer_price * $incIGV_format;
                        $sumFinalPrice2 = $popularcateg_item->special_offer_price + $sumFinalPrice1;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (special_offer_price)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-special_offer";
                          $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->discount_price; // PRECIO ACTUAL (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }else{
                        $sumFinalPrice2 = $popularcateg_item->special_offer_price;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-special_offer";
                          $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }
                    }else{
                      if($popularcateg_item->tax_id == 1){                
                        $sumFinalPrice1 = $popularcateg_item->discount_price * $incIGV_format;
                        $sumFinalPrice2 = $popularcateg_item->discount_price + $sumFinalPrice1;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "";
                          $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }else{
                        $sumFinalPrice2 = $popularcateg_item->discount_price;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "";
                          $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }
                    }
                  }else{
                    if(count($getAllDataCouponById) > 0){
                      $txtFlagToProduct = "txt-applycoupon";
                      $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                      $sumTotalPriceFinal = $couponInfo_totalprice;
                    }else{
                      $txtFlagToProduct = "";
                      $sumTotalDiscountPriceFinalPrevious = $popularcateg_item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
                      $sumTotalPriceFinal = $popularcateg_item->discount_price;
                    }
                  }
                ?>
                <div class="slider-item">
                  <div class="product-card">
                    <div class="product-thumb">
                      @if($popularcateg_item->stocktype_id == 1)
                      @elseif($popularcateg_item->stocktype_id == 2)
                        @if(!$popularcateg_item->is_stock())
                          <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
                        @endif
                      @endif
                      @if($popularcateg_item->previous_price && $popularcateg_item->previous_price !=0)
                      <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($popularcateg_item)}}</div>
                      @endif
                      <a href="{{route('front.product',$popularcateg_item->slug)}}" class="d-flex align-items-center justify-content-center">
                        <img class="lazy" data-src="{{asset('assets/images/items/'.$popularcateg_item->photo)}}" alt="Product">
                      </a>
                      <div class="product-button-group">
                        <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$popularcateg_item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                        <a data-target="{{route('fornt.compare.product',$popularcateg_item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                        @include('includes.item_footer',['sitem'=>$popularcateg_item])
                      </div>
                      @if($popularcateg_item->stocktype_id == 1)
                        @if($txtFlagAvaiCouponToProduct != "")
                          @if($txtFlagAvaiCouponToProduct == "txt-nonapply")
                            <?php
                              $colorPercentageVal = "";
                              $coupinf_discount_percentage_nonapplyFormatInt = (int) $coupinf_discount_percentage_nonapply;
                              $coupinf_discount_percentage_nonapplyFormatFloat = floatval($coupinf_discount_percentage_nonapply);
                              // if($coupinf_discount_percentage_nonapplyFormatInt > 0 && $coupinf_discount_percentage_nonapplyFormatInt <= 29){
                              //   $colorPercentageVal = "bg__avaicoupon--20";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 30 && $coupinf_discount_percentage_nonapplyFormatInt <= 49){
                              //   $colorPercentageVal = "bg__avaicoupon--30";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 50 && $coupinf_discount_percentage_nonapplyFormatInt <= 69){
                              //   $colorPercentageVal = "bg__avaicoupon--50";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 70 && $coupinf_discount_percentage_nonapplyFormatInt <= 99){
                              //   $colorPercentageVal = "bg__avaicoupon--70";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt == 100){
                              //   $colorPercentageVal = "bg__avaicoupon--100";
                              // }else{
                              //   $colorPercentageVal = "bg__avaicoupon--10";
                              // }
                            ?>
                            <div class="product-avaicoupon post-abs">
                              <div class="product-avaicoupon__c pos-r">
                                <span class="product-avaicoupon__c__cType">
                                  <span class="product-avaicoupon__c__cType__spn">
                                    <span class="product-avaicoupon__c__cType__spn__txtTitle">CUPÓN</span>  
                                    <span class="product-avaicoupon__c__cType__spn__txtNumb">{{ $coupinf_discount_percentage_nonapplyFormatFloat }}%</span>  
                                  </span>
                                </span>
                              </div>
                            </div>
                          @endif
                        @endif
                      @elseif($popularcateg_item->stocktype_id == 2)
                        @if($popularcateg_item->is_stock())
                          @if($txtFlagAvaiCouponToProduct != "")
                            @if($txtFlagAvaiCouponToProduct == "txt-nonapply")
                              <?php
                                $colorPercentageVal = "";
                                $coupinf_discount_percentage_nonapplyFormatInt = (int) $coupinf_discount_percentage_nonapply;
                                $coupinf_discount_percentage_nonapplyFormatFloat = floatval($coupinf_discount_percentage_nonapply);
                                // if($coupinf_discount_percentage_nonapplyFormatInt > 0 && $coupinf_discount_percentage_nonapplyFormatInt <= 29){
                                //   $colorPercentageVal = "bg__avaicoupon--20";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 30 && $coupinf_discount_percentage_nonapplyFormatInt <= 49){
                                //   $colorPercentageVal = "bg__avaicoupon--30";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 50 && $coupinf_discount_percentage_nonapplyFormatInt <= 69){
                                //   $colorPercentageVal = "bg__avaicoupon--50";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 70 && $coupinf_discount_percentage_nonapplyFormatInt <= 99){
                                //   $colorPercentageVal = "bg__avaicoupon--70";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt == 100){
                                //   $colorPercentageVal = "bg__avaicoupon--100";
                                // }else{
                                //   $colorPercentageVal = "bg__avaicoupon--10";
                                // }
                              ?>
                              <div class="product-avaicoupon post-abs">
                                <div class="product-avaicoupon__c pos-r">
                                  <span class="product-avaicoupon__c__cType">
                                    <span class="product-avaicoupon__c__cType__spn">
                                      <span class="product-avaicoupon__c__cType__spn__txtTitle">CUPÓN</span>  
                                      <span class="product-avaicoupon__c__cType__spn__txtNumb">{{ $coupinf_discount_percentage_nonapplyFormatFloat }}%</span>  
                                    </span>
                                  </span>
                                </div>
                              </div>
                            @endif
                          @endif
                        @endif
                      @endif
                    </div>
                    <div class="product-card-body">
                      @if($txtFlagToProduct != "")
                        @if($txtFlagToProduct == "txt-applycoupon")
                        <div class="product-flag">
                          <div class="product-flag__c pos-r">
                            <span class="product-flag__c__cType bg__applycoupon">
                              <span class="product-flag__c__cType__spn">Cupón Activado</span>
                            </span>
                          </div>
                        </div>
                        @elseif($txtFlagToProduct == "txt-on_sale")
                        <div class="product-flag">
                          <div class="product-flag__c pos-r">
                            <span class="product-flag__c__cType bg__onsale">
                              <span class="product-flag__c__cType__spn">En Promoción</span>
                            </span>
                          </div>
                        </div>
                        @elseif($txtFlagToProduct == "txt-special_offer")
                        <div class="product-flag">
                          <div class="product-flag__c pos-r">
                            <span class="product-flag__c__cType bg__specialoffer">
                              <span class="product-flag__c__cType__spn">Oferta Especial</span>
                            </span>
                          </div>
                        </div>
                        @else
                        @endif
                      @endif
                      <div class="product-category">
                        <a href="{{route('front.catalog').'?category='.$popularcateg_item->category->slug}}">{{$popularcateg_item->category->name}}</a>
                      </div>
                      <h3 class="product-title text-bold">
                        <a class="text-bold" href="{{route('front.product',$popularcateg_item->slug)}}">{{ strlen(strip_tags($popularcateg_item->name)) > 35 ? substr(strip_tags($popularcateg_item->name), 0, 35) : strip_tags($popularcateg_item->name) }}</a>
                      </h3>
                      <p class="product-sku__2">SKU: {{ strlen(strip_tags($popularcateg_item->sku)) > 35 ? substr(strip_tags($popularcateg_item->sku), 0, 35) : strip_tags($popularcateg_item->sku) }}</p>
                      <h4 class="product-price">
                        <del>{{PriceHelper::setPreviousPrice($sumTotalDiscountPriceFinalPrevious)}}</del>
                        <span>{{PriceHelper::setCurrencyPrice($sumTotalPriceFinal)}}</span>
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
                            @foreach($wps_inproducts as $k => $v)
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
          @else
          <div class="card">
            <div class="card-body text-center">{{__('No Product Found')}}</div>
          </div>
          @endif
        </div>
      </div>
    </section>
  @endif
  @if($setting->is_two_c_b == 1)
    <div class="bannner-section mt-50">
      <div class="container">
        <div class="row gx-3">
          <div class="col-md-12">
            <a href="{{ route('front.catalog').'?category='.$banner_third['url1']}}" data-href="{{ $banner_third['url1'] }}" class="">
              <img class="lazy" data-src="{{ asset('assets/images/banners/'.$banner_third['img1']) }}" alt="{{ (isset($banner_third['title1'])) ? $banner_third['title1'] : '' }}" width="100" height="100" decoding="sync">
            </a>
          </div>
        </div>
      </div>
    </div>
  @endif
  @if($setting->is_featured_category == 1)
    <section class="selected-product-section featured_cat_sec sps-two mt-50">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2 class="h3">{{ $feature_category_title }}</h2>
              <div class="links">
                @foreach($feature_categories as $key => $feature_category)
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
          @if(!empty($feature_category_items) && count($feature_category_items) > 0)
          <div class="col-lg-12">
            <div class="feature-category-slider  owl-carousel">
              @foreach($feature_category_items as $featurecateg_item)
                <?php
                  $TaxesAll = DB::table('taxes')->get();
                  $incIGV = $TaxesAll[0]->value;
                  $sinIGV = $TaxesAll[1]->value;
                  $incIGV_format = $incIGV / 100;
                  $sinIGV_format = $sinIGV;
                  $sumFinalPrice1 = 0;
                  $sumFinalPrice2 = 0;
                  $coupinf_discount_percentage = 0;
                  $coupinf_discount_percentage_nonapply = 0;
                  $couponInfo_totalprice = 0;
                  $getAllCouponInfo = [];
                  $getAllDataCouponById = [];
                  $getAllDataCouponById_nonapply = [];
                  $allCouponDataConvertById = [];
                  $allCouponDataConvertById_nonapply = [];
                  $sumTotalPriceFinal = 0;
                  $sumTotalDiscountPriceFinalPrevious = 0;
                  $txtFlagToProduct = "";
                  $txtFlagAvaiCouponToProduct = "";
                  // --------------- VALIDAR SI YA SE ACTIVÓ UN CUPÓN EN EL PRODUCTO ('tbl_applycoupons')
                  if(!empty($featurecateg_item->coupon_id) && $featurecateg_item->coupon_id != "" && $featurecateg_item->coupon_id != null && $featurecateg_item->coupon_id != 0){
                    $getAllCouponInfo = DB::table('tbl_applycoupons')->where("id_user","=",$user_id)->where("id_prod","=",$featurecateg_item->id)->where("id_coupon","=",$featurecateg_item->coupon_id)->where("status","!=",0)->select('id_user', 'id_prod', 'id_coupon', 'totalprice')->take(1)->get();
                    if(count($getAllCouponInfo) > 0){
                      $txtFlagAvaiCouponToProduct = "txt-yesapply";
                      $allDataConvert = json_decode($getAllCouponInfo, TRUE);
                      $getAllDataCouponById = DB::table('tbl_coupons')->where("id","=",$allDataConvert[0]['id_coupon'])->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
                      if(count($getAllDataCouponById) > 0){
                        $allCouponDataConvertById = json_decode($getAllDataCouponById, TRUE);
                        $coupinf_discount_percentage = $allCouponDataConvertById[0]['discount_percentage'];
                        $couponInfo_totalprice = $allDataConvert[0]['totalprice']; // SETEAR LA VARIABLE DE PRECIO TOTAL PARA CUPÓN ACTIVADO
                      }
                    }else{
                      $txtFlagAvaiCouponToProduct = "txt-nonapply";
                      $getAllDataCouponById_nonapply = DB::table('tbl_coupons')->where("id","=",$featurecateg_item->coupon_id)->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
                      if(count($getAllDataCouponById_nonapply) > 0){
                        $allCouponDataConvertById_nonapply = json_decode($getAllDataCouponById_nonapply, TRUE);
                        $coupinf_discount_percentage_nonapply = $allCouponDataConvertById_nonapply[0]['discount_percentage'];
                      }
                    }
                  }
        
                  if($featurecateg_item->sections_id != 0){
                    if($featurecateg_item->sections_id == 1 && $featurecateg_item->on_sale_price != 0 && $featurecateg_item->on_sale_price != ""){
                      if($featurecateg_item->tax_id == 1){
                        $sumFinalPrice1 = $featurecateg_item->on_sale_price * $incIGV_format;
                        $sumFinalPrice2 = $featurecateg_item->on_sale_price + $sumFinalPrice1;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-on_sale";
                          $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->discount_price; // PRECIO ACTUAL (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }else{
                        $sumFinalPrice2 = $featurecateg_item->on_sale_price;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-on_sale";
                          $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->discount_price; // PRECIO ACTUAL (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }
                    }else if($featurecateg_item->sections_id == 2 && $featurecateg_item->special_offer_price != 0 && $featurecateg_item->special_offer_price != ""){
                      if($featurecateg_item->tax_id == 1){
                        $sumFinalPrice1 = $featurecateg_item->special_offer_price * $incIGV_format;
                        $sumFinalPrice2 = $featurecateg_item->special_offer_price + $sumFinalPrice1;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (special_offer_price)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-special_offer";
                          $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->discount_price; // PRECIO ACTUAL (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }else{
                        $sumFinalPrice2 = $featurecateg_item->special_offer_price;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "txt-special_offer";
                          $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }
                    }else{
                      if($featurecateg_item->tax_id == 1){                
                        $sumFinalPrice1 = $featurecateg_item->discount_price * $incIGV_format;
                        $sumFinalPrice2 = $featurecateg_item->discount_price + $sumFinalPrice1;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "";
                          $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }else{
                        $sumFinalPrice2 = $featurecateg_item->discount_price;
                        if(count($getAllDataCouponById) > 0){
                          $txtFlagToProduct = "txt-applycoupon";
                          $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                          $sumTotalPriceFinal = $couponInfo_totalprice;
                        }else{
                          $txtFlagToProduct = "";
                          $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
                          $sumTotalPriceFinal = $sumFinalPrice2;
                        }
                      }
                    }
                  }else{
                    if(count($getAllDataCouponById) > 0){
                      $txtFlagToProduct = "txt-applycoupon";
                      $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                      $sumTotalPriceFinal = $couponInfo_totalprice;
                    }else{
                      $txtFlagToProduct = "";
                      $sumTotalDiscountPriceFinalPrevious = $featurecateg_item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
                      $sumTotalPriceFinal = $featurecateg_item->discount_price;
                    }
                  }
                ?>
                <div class="slider-item">
                  <div class="product-card">
                    <div class="product-thumb" >
                      @if($featurecateg_item->stocktype_id == 1)
                      @elseif($featurecateg_item->stocktype_id == 2)
                        @if(!$featurecateg_item->is_stock())
                          <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
                        @endif
                      @endif
                      @if($featurecateg_item->previous_price && $featurecateg_item->previous_price !=0)
                      <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($featurecateg_item)}}</div>
                      @endif                                
                      <a href="{{route('front.product',$featurecateg_item->slug)}}" class="d-flex align-items-center justify-content-center">
                        <img class="lazy" data-src="{{asset('assets/images/items/'.$featurecateg_item->photo)}}" alt="Product">
                      </a>
                      <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$featurecateg_item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                        <a data-target="{{route('fornt.compare.product',$featurecateg_item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                        @include('includes.item_footer',['sitem'=>$featurecateg_item])
                      </div>
                      @if($featurecateg_item->stocktype_id == 1)
                        @if($txtFlagAvaiCouponToProduct != "")
                          @if($txtFlagAvaiCouponToProduct == "txt-nonapply")
                            <?php
                              $colorPercentageVal = "";
                              $coupinf_discount_percentage_nonapplyFormatInt = (int) $coupinf_discount_percentage_nonapply;
                              $coupinf_discount_percentage_nonapplyFormatFloat = floatval($coupinf_discount_percentage_nonapply);
                              // if($coupinf_discount_percentage_nonapplyFormatInt > 0 && $coupinf_discount_percentage_nonapplyFormatInt <= 29){
                              //   $colorPercentageVal = "bg__avaicoupon--20";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 30 && $coupinf_discount_percentage_nonapplyFormatInt <= 49){
                              //   $colorPercentageVal = "bg__avaicoupon--30";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 50 && $coupinf_discount_percentage_nonapplyFormatInt <= 69){
                              //   $colorPercentageVal = "bg__avaicoupon--50";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 70 && $coupinf_discount_percentage_nonapplyFormatInt <= 99){
                              //   $colorPercentageVal = "bg__avaicoupon--70";
                              // }else if($coupinf_discount_percentage_nonapplyFormatInt == 100){
                              //   $colorPercentageVal = "bg__avaicoupon--100";
                              // }else{
                              //   $colorPercentageVal = "bg__avaicoupon--10";
                              // }
                            ?>
                            <div class="product-avaicoupon post-abs">
                              <div class="product-avaicoupon__c pos-r">
                                <span class="product-avaicoupon__c__cType">
                                  <span class="product-avaicoupon__c__cType__spn">
                                    <span class="product-avaicoupon__c__cType__spn__txtTitle">CUPÓN</span>  
                                    <span class="product-avaicoupon__c__cType__spn__txtNumb">{{ $coupinf_discount_percentage_nonapplyFormatFloat }}%</span>  
                                  </span>
                                </span>
                              </div>
                            </div>
                          @endif
                        @endif
                      @elseif($featurecateg_item->stocktype_id == 2)
                        @if($featurecateg_item->is_stock())
                          @if($txtFlagAvaiCouponToProduct != "")
                            @if($txtFlagAvaiCouponToProduct == "txt-nonapply")
                              <?php
                                $colorPercentageVal = "";
                                $coupinf_discount_percentage_nonapplyFormatInt = (int) $coupinf_discount_percentage_nonapply;
                                $coupinf_discount_percentage_nonapplyFormatFloat = floatval($coupinf_discount_percentage_nonapply);
                                // if($coupinf_discount_percentage_nonapplyFormatInt > 0 && $coupinf_discount_percentage_nonapplyFormatInt <= 29){
                                //   $colorPercentageVal = "bg__avaicoupon--20";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 30 && $coupinf_discount_percentage_nonapplyFormatInt <= 49){
                                //   $colorPercentageVal = "bg__avaicoupon--30";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 50 && $coupinf_discount_percentage_nonapplyFormatInt <= 69){
                                //   $colorPercentageVal = "bg__avaicoupon--50";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt <= 70 && $coupinf_discount_percentage_nonapplyFormatInt <= 99){
                                //   $colorPercentageVal = "bg__avaicoupon--70";
                                // }else if($coupinf_discount_percentage_nonapplyFormatInt == 100){
                                //   $colorPercentageVal = "bg__avaicoupon--100";
                                // }else{
                                //   $colorPercentageVal = "bg__avaicoupon--10";
                                // }
                              ?>
                              <div class="product-avaicoupon post-abs">
                                <div class="product-avaicoupon__c pos-r">
                                  <span class="product-avaicoupon__c__cType">
                                    <span class="product-avaicoupon__c__cType__spn">
                                      <span class="product-avaicoupon__c__cType__spn__txtTitle">CUPÓN</span>  
                                      <span class="product-avaicoupon__c__cType__spn__txtNumb">{{ $coupinf_discount_percentage_nonapplyFormatFloat }}%</span>  
                                    </span>
                                  </span>
                                </div>
                              </div>
                            @endif
                          @endif
                        @endif
                      @endif
                    </div>
                    <div class="product-card-body">
                      @if($txtFlagToProduct != "")
                        @if($txtFlagToProduct == "txt-applycoupon")
                        <div class="product-flag">
                          <div class="product-flag__c pos-r">
                            <span class="product-flag__c__cType bg__applycoupon">
                              <span class="product-flag__c__cType__spn">Cupón Activado</span>
                            </span>
                          </div>
                        </div>
                        @elseif($txtFlagToProduct == "txt-on_sale")
                        <div class="product-flag">
                          <div class="product-flag__c pos-r">
                            <span class="product-flag__c__cType bg__onsale">
                              <span class="product-flag__c__cType__spn">En Promoción</span>
                            </span>
                          </div>
                        </div>
                        @elseif($txtFlagToProduct == "txt-special_offer")
                        <div class="product-flag">
                          <div class="product-flag__c pos-r">
                            <span class="product-flag__c__cType bg__specialoffer">
                              <span class="product-flag__c__cType__spn">Oferta Especial</span>
                            </span>
                          </div>
                        </div>
                        @else
                        @endif
                      @endif
                      <div class="product-category"><a href="{{route('front.catalog').'?category='.$featurecateg_item->category->slug}}">{{$featurecateg_item->category->name}}</a></div>
                      <h3 class="product-title">
                        <a class="text-bold" href="{{route('front.product',$featurecateg_item->slug)}}">
                          {{ strlen(strip_tags($featurecateg_item->name)) > 35 ? substr(strip_tags($featurecateg_item->name), 0, 35) : strip_tags($featurecateg_item->name) }}
                        </a>
                      </h3>
                      <p class="product-sku__2">SKU: {{ strlen(strip_tags($featurecateg_item->sku)) > 35 ? substr(strip_tags($featurecateg_item->sku), 0, 35) : strip_tags($featurecateg_item->sku) }}</p>
                      <h4 class="product-price">
                        <del>{{PriceHelper::setPreviousPrice($sumTotalDiscountPriceFinalPrevious)}}</del>
                        <span>{{PriceHelper::setCurrencyPrice($sumTotalPriceFinal)}}</span>
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
                            @foreach($wps_inproducts as $k => $v)
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
          @else
            <div class="card">
              <div class="card-body text-center">{{__('No Product Found')}}</div>
            </div>
          @endif
        </div>
      </div>
    </section>
  @endif
  @if($setting->is_blogs == 1)
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
              @foreach($posts as $post)
                <div class="slider-item">
                  <a href="{{route('front.blog.details',$post->slug)}}" class="blog-post">
                    <div class="post-thumb">
                      @if(isset(json_decode($post->photo, true)[0]))
                        <img class="lazy" data-src="{{ asset('assets/images/blogs/' . json_decode($post->photo, true)[array_key_first(json_decode($post->photo, true))]) }}" alt="Blog Post" width="100" height="100" decoding="sync">
                      @else
                        <img class="lazy" data-src="{{ asset('assets/images/placeholder.png') }}" alt="Blog Post" width="100" height="100" decoding="sync">
                      @endif
                    </div>
                    <div class="post-body">
                      <h3 class="post-title">{{ strlen(strip_tags($post->title)) > 100 ? substr(strip_tags($post->title), 0, 100) : strip_tags($post->title) }}
                      </h3>
                      <ul class="post-meta">
                        <li><i class="icon-user"></i>{{ __('SiteProyectName') }}</li>
                        <li><i class="icon-clock"></i>{{ date('jS F, Y', strtotime($post->created_at)) }}</li>
                      </ul>
                      <p>{{ strlen(strip_tags($post->details)) > 120 ? substr(strip_tags($post->details), 0, 120) : strip_tags($post->details) }}</p>
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
  @if($setting->is_popular_brand == 1)
    <section class="brand-section mt-30 mb-60">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2 class="h3">Marcas</h2>
            </div>
          </div>
        </div>
        <div class="row" id="contBrandList_1">
          <div class="col-lg-12">
            <div class="brand-slider owl-carousel">
              @foreach($brands as $brand)
                <?php
                  //Combiar arrays de Foto principal y fotos de galería
                  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                  $urlBaseDomain = $actual_link . "/grupocorein/"; // LOCAL
                  // $urlBaseDomain = $actual_link . "/"; // SERVIDOR
                  // Directorio donde se encuentra la imagen
                  $imgDirectoryPhoto = $urlBaseDomain . 'assets/images/brands/';
                  $imgDirectoryDefault = $urlBaseDomain . 'assets/images/Utilities/default_product.png';
                  // Ruta completa de la imagen
                  $routePhotoBrand = $imgDirectoryPhoto . $brand->photo;
                  $routePhotoFinal = "";
                ?>
                <div class="slider-item">
                  <a class="text-center" href="{{ route('front.catalog') . '?brand=' . $brand->slug }}">
                    <img class="d-block hi-100 lazy" data-src="{{ asset('assets/images/brands/' . $brand->photo) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}" width="100" height="100" decoding="sync">
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
    //   let imgDirectoryDefault = "{{ $imgDirectoryDefault}}";
    //   $('img').each(function(){
    //     if($(this)[0].naturalHeight == 0){
    //       $(this).attr('src',imgDirectoryDefault);
    //     }
    //   });
    // });
  </script>
@endsection