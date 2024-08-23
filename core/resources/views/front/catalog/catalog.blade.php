@php
function renderStarRating($rating,$maxRating=5) {
  $fullStar = "<i class = 'far fa-star filled'></i>";
  $halfStar = "<i class = 'far fa-star-half filled'></i>";
  $emptyStar = "<i class = 'far fa-star'></i>";
  $rating = $rating <= $maxRating?$rating:$maxRating;

  $fullStarCount = (int)$rating;
  $halfStarCount = ceil($rating)-$fullStarCount;
  $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

  $html = str_repeat($fullStar,$fullStarCount);
  $html .= str_repeat($halfStar,$halfStarCount);
  $html .= str_repeat($emptyStar,$emptyStarCount);
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
<div class="row g-3" id="main_div">
  @if(isset($items) && !empty($items) && $items->count() > 0)
    @if($checkType != 'list')
      @foreach($items as $item)
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
          if(!empty($item->coupon_id) && $item->coupon_id != "" && $item->coupon_id != null && $item->coupon_id != 0){
            $getAllCouponInfo = DB::table('tbl_applycoupons')->where("id_user","=",$user_id)->where("id_prod","=",$item->id)->where("id_coupon","=",$item->coupon_id)->where("status","!=",0)->select('id_user', 'id_prod', 'id_coupon', 'totalprice')->take(1)->get();
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
              $getAllDataCouponById_nonapply = DB::table('tbl_coupons')->where("id","=",$item->coupon_id)->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
              if(count($getAllDataCouponById_nonapply) > 0){
                $allCouponDataConvertById_nonapply = json_decode($getAllDataCouponById_nonapply, TRUE);
                $coupinf_discount_percentage_nonapply = $allCouponDataConvertById_nonapply[0]['discount_percentage'];
              }
            }
          }

          if($item->sections_id != 0){
            if($item->sections_id == 1 && $item->on_sale_price != 0 && $item->on_sale_price != ""){
              if($item->tax_id == 1){
                $sumFinalPrice1 = $item->on_sale_price * $incIGV_format;
                $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-on_sale";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO ACTUAL (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }else{
                $sumFinalPrice2 = $item->on_sale_price;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-on_sale";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO ACTUAL (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }
            }else if($item->sections_id == 2 && $item->special_offer_price != 0 && $item->special_offer_price != ""){
              if($item->tax_id == 1){
                $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
                $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (special_offer_price)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-special_offer";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO ACTUAL (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }else{
                $sumFinalPrice2 = $item->special_offer_price;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-special_offer";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }
            }else{
              if($item->tax_id == 1){                
                $sumFinalPrice1 = $item->discount_price * $incIGV_format;
                $sumFinalPrice2 = $item->discount_price + $sumFinalPrice1;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }else{
                $sumFinalPrice2 = $item->discount_price;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "";
                  $sumTotalDiscountPriceFinalPrevious = $item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }
            }
          }else{
            if(count($getAllDataCouponById) > 0){
              $txtFlagToProduct = "txt-applycoupon";
              $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
              $sumTotalPriceFinal = $couponInfo_totalprice;
            }else{
              $txtFlagToProduct = "";
              $sumTotalDiscountPriceFinalPrevious = $item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
              $sumTotalPriceFinal = $item->discount_price;
            }
          }
        ?>
        <div class="col-gd">
          <div class="product-card ">
            @if($item->stocktype_id == 1)
            @elseif($item->stocktype_id == 2)
              @if($item->is_stock())
              @php
                $itm_istype = '';
                if($item->is_type == 'feature'){
                  $itm_istype = 'bg-warning';
                }else if($item->is_type == 'new'){
                  $itm_istype = 'bg-danger';
                }else if($item->is_type == 'top'){
                  $itm_istype = 'bg-info';
                }else if($item->is_type == 'best'){
                  $itm_istype = 'bg-dark';
                }else if($item->is_type == 'flash_deal'){
                  $itm_istype = 'bg-success';
                }else{
                  $itm_istype = '';
                }
              @endphp
              <div class="product-badge {{ $itm_istype }}"> {{  $item->is_type != 'undefine' ?  (str_replace('_',' ',__("$item->is_type"))) : ''   }}</div>
              @else
              <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
              @endif
            @endif
            @if($item->previous_price && $item->previous_price !=0)
            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
            @endif
            <div class="product-thumb">
              <a href="{{route('front.product',$item->slug)}}" class="d-flex align-items-center justify-content-center">
                <img class="lazy" data-src="{{asset('assets/images/items/'.$item->photo)}}" alt="Product" width="100" height="100" decoding="sync">
              </a>
              <div class="product-button-group">
                <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                <a class="product-button product_compare" href="javascript:;" data-target="{{route('fornt.compare.product',$item->id)}}" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                @include('includes.item_footer',['sitem' => $item])
              </div>
              @if($item->stocktype_id == 1)
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
              @elseif($item->stocktype_id == 2)
                @if($item->is_stock())
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
                <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
              </div>
              <h3 class="product-title">
                <a class="text-bold" href="{{route('front.product',$item->slug)}}">
                  <span>{{ strlen(strip_tags($item->name)) > $name_string_count ? substr(strip_tags($item->name), 0, 38) . '...' : strip_tags($item->name) }}</span>
                </a>
              </h3>
              <p class="product-sku__2">SKU: {{ strlen(strip_tags($item->sku)) > $name_string_count ? substr(strip_tags($item->sku), 0, 38) . '...' : strip_tags($item->sku) }}</p>
              <h4 class="product-price">
                <del>{{PriceHelper::setPreviousPrice($sumTotalDiscountPriceFinalPrevious)}}</del>
                <span>{{PriceHelper::setCurrencyPrice($sumTotalPriceFinal)}}</span>
              </h4>
              <div class="cWtspBtnCtc">
                <a title="Solicitar información" href="https://api.whatsapp.com/send?phone=51{{$setting->footer_phone}}&text=Solicito información sobre: {{route('front.product',$item->slug)}}" target="_blank" class="cWtspBtnCtc__pLink">
                  <img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" alt="WhatsApp imagen - Solicitar información" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
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
    @else
      @foreach($items as $item)
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
          if(!empty($item->coupon_id) && $item->coupon_id != "" && $item->coupon_id != null && $item->coupon_id != 0){
            $getAllCouponInfo = DB::table('tbl_applycoupons')->where("id_user","=",$user_id)->where("id_prod","=",$item->id)->where("id_coupon","=",$item->coupon_id)->where("status","!=",0)->select('id_user', 'id_prod', 'id_coupon', 'totalprice')->take(1)->get();
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
              $getAllDataCouponById_nonapply = DB::table('tbl_coupons')->where("id","=",$item->coupon_id)->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
              if(count($getAllDataCouponById_nonapply) > 0){
                $allCouponDataConvertById_nonapply = json_decode($getAllDataCouponById_nonapply, TRUE);
                $coupinf_discount_percentage_nonapply = $allCouponDataConvertById_nonapply[0]['discount_percentage'];
              }
            }
          }

          if($item->sections_id != 0){
            if($item->sections_id == 1 && $item->on_sale_price != 0 && $item->on_sale_price != ""){
              if($item->tax_id == 1){
                $sumFinalPrice1 = $item->on_sale_price * $incIGV_format;
                $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-on_sale";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO ACTUAL (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }else{
                $sumFinalPrice2 = $item->on_sale_price;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (on_sale_price)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-on_sale";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO ACTUAL (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }
            }else if($item->sections_id == 2 && $item->special_offer_price != 0 && $item->special_offer_price != ""){
              if($item->tax_id == 1){
                $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
                $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (special_offer_price)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-special_offer";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO ACTUAL (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }else{
                $sumFinalPrice2 = $item->special_offer_price;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "txt-special_offer";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }
            }else{
              if($item->tax_id == 1){                
                $sumFinalPrice1 = $item->discount_price * $incIGV_format;
                $sumFinalPrice2 = $item->discount_price + $sumFinalPrice1;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "";
                  $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }else{
                $sumFinalPrice2 = $item->discount_price;
                if(count($getAllDataCouponById) > 0){
                  $txtFlagToProduct = "txt-applycoupon";
                  $sumTotalDiscountPriceFinalPrevious = $sumFinalPrice2; // PRECIO DE LA SECCIÓN (NO_SECTION)
                  $sumTotalPriceFinal = $couponInfo_totalprice;
                }else{
                  $txtFlagToProduct = "";
                  $sumTotalDiscountPriceFinalPrevious = $item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
                  $sumTotalPriceFinal = $sumFinalPrice2;
                }
              }
            }
          }else{
            if(count($getAllDataCouponById) > 0){
              $txtFlagToProduct = "txt-applycoupon";
              $sumTotalDiscountPriceFinalPrevious = $item->discount_price; // PRECIO DE LA SECCIÓN (discount_price)
              $sumTotalPriceFinal = $couponInfo_totalprice;
            }else{
              $txtFlagToProduct = "";
              $sumTotalDiscountPriceFinalPrevious = $item->previous_price; // PRECIO DE LA SECCIÓN (discount_price)
              $sumTotalPriceFinal = $item->discount_price;
            }
          }
        ?>
        <div class="col-lg-12">
          <div class="product-card product-list">
            <div class="product-thumb">
              @if($item->stocktype_id == 1)
              @elseif($item->stocktype_id == 2)
                @if($item->is_stock())
                @php
                  $itm_istype = '';
                  if($item->is_type == 'feature'){
                    $itm_istype = 'bg-warning';
                  }else if($item->is_type == 'new'){
                    $itm_istype = 'bg-danger';
                  }else if($item->is_type == 'top'){
                    $itm_istype = 'bg-info';
                  }else if($item->is_type == 'best'){
                    $itm_istype = 'bg-dark';
                  }else if($item->is_type == 'flash_deal'){
                    $itm_istype = 'bg-success';
                  }else{
                    $itm_istype = '';
                  }
                @endphp
                <div class="product-badge {{ $itm_istype }}">{{  $item->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$item->is_type)) : ''   }}</div>
                @else
                <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
                @endif
              @endif
              @if($item->previous_price && $item->previous_price !=0)
              <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
              @endif
              <div class="product-thumb">
                <a href="{{route('front.product',$item->slug)}}" class="d-flex align-items-center justify-content-center">
                  <img class="lazy" data-src="{{asset('assets/images/items/'.$item->photo)}}" alt="Product" width="100" height="100" decoding="sync">
                </a>
                <div class="product-button-group">
                  <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                  <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                  @include('includes.item_footer',['sitem' => $item])
                </div>
                @if($item->stocktype_id == 1)
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
                @elseif($item->stocktype_id == 2)
                  @if($item->is_stock())
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
            </div>
            <div class="product-card-inner">
              @if($txtFlagToProduct != "")
                @if($txtFlagToProduct == "txt-applycoupon")
                <div class="product-flag">
                  <div class="product-flag__c pos-rleft0">
                    <span class="product-flag__c__cType bg__applycoupon">
                      <span class="product-flag__c__cType__spn">Cupón Activado</span>
                    </span>
                  </div>
                </div>
                @elseif($txtFlagToProduct == "txt-on_sale")
                <div class="product-flag">
                  <div class="product-flag__c pos-rleft0">
                    <span class="product-flag__c__cType bg__onsale">
                      <span class="product-flag__c__cType__spn">En Promoción</span>
                    </span>
                  </div>
                </div>
                @elseif($txtFlagToProduct == "txt-special_offer")
                <div class="product-flag">
                  <div class="product-flag__c pos-rleft0">
                    <span class="product-flag__c__cType bg__specialoffer">
                      <span class="product-flag__c__cType__spn">Oferta Especial</span>
                    </span>
                  </div>
                </div>
                @else
                @endif
              @endif
              <div class="product-card-body">
                <div class="product-category">
                  <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
                </div>
                <h3 class="product-title">
                  <a class="text-bold" href="{{route('front.product',$item->slug)}}">
                    <span>{{ strlen(strip_tags($item->name)) > $name_string_count ? substr(strip_tags($item->name), 0, 75) . '...' : strip_tags($item->name) }}</span>
                  </a>
                </h3>
                {{--
                <!--
                <div class="rating-stars">
                  {!! renderStarRating($item->reviews->avg('rating')) !!}
                </div>
                -->
                --}}
                <h4 class="product-price">
                  <del>{{PriceHelper::setPreviousPrice($sumTotalDiscountPriceFinalPrevious)}}</del>
                  <span>{{PriceHelper::setCurrencyPrice($sumTotalPriceFinal)}}</span>
                </h4>
                <p class="text-sm sort_details_show  text-muted hidden-xs-down my-1">
                {{ strlen(strip_tags($item->sort_details)) > 100 ? substr(strip_tags($item->sort_details), 0, 100) : strip_tags($item->sort_details) }}
                </p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  @else
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body text-center">
        <h4 class="h4 mb-0">{{ __('No Product Found') }}</h4>
      </div>
    </div>
  </div>
  @endif
</div>
<div class="row mt-15" id="item_pagination">
  <div class="col-lg-12 text-center">
    @if(isset($items) && !empty($items) && $items->count() > 0)
      {{$items->links()}}
    @endif
  </div>
</div>
<script type="text/javascript" src="{{asset('assets/front/js/catalog.js')}}"></script>