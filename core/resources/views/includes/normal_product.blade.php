@php
$user_id = 0;
if(Auth::check()){
  if(!empty(auth()->user()) || auth()->user() != ""){
    $user = Auth::user();
    $user_id = Auth::user()->id;
  }
}
@endphp
@forelse ($items as $item)
  <?php
    $TaxesAll = DB::table('taxes')->get();
    $sumFinalPrice1 = 0;
    $sumFinalPrice2 = 0;
    $sumTotalPriceFinal = 0;
    $couponInfo_totalprice = 0;
    $incIGV = $TaxesAll[0]->value;
    $sinIGV = $TaxesAll[1]->value;
    $incIGV_format = $incIGV / 100;
    $sinIGV_format = $sinIGV;
    $getAllCouponInfo = [];
    $getAllDataCouponById = [];
    // --------------- VALIDAR SI YA SE ACTIVÓ UN CUPÓN EN EL PRODUCTO ('tbl_applycoupons')
    if(!empty($item->coupon_id) && $item->coupon_id != "" && $item->coupon_id != null && $item->coupon_id != 0){
      $getAllCouponInfo = DB::table('tbl_applycoupons')->where("id_user","=",$user_id)->where("id_prod","=",$item->id)->where("id_coupon","=",$item->coupon_id)->where("status","!=",0)->select('id_user', 'id_prod', 'id_coupon', 'totalprice')->take(1)->get();
      if(count($getAllCouponInfo) > 0){
        $allDataConvert = json_decode($getAllCouponInfo, TRUE);
        $getAllDataCouponById = DB::table('tbl_coupons')->where("id","=",$allDataConvert[0]['id_coupon'])->where("status","!=",0)->select('name', 'discount_percentage')->take(1)->get();
        if(count($getAllDataCouponById) > 0){
          $allCouponDataConvertById = json_decode($getAllDataCouponById, TRUE);
          $coupinf_discount_percentage = $allCouponDataConvertById[0]['discount_percentage'];
          $couponInfo_totalprice = $allDataConvert[0]['totalprice']; // SETEAR LA VARIABLE DE PRECIO TOTAL PARA CUPÓN ACTIVADO
        }
      }
    }

    if($item->sections_id != 0){
      if($item->sections_id == 1 && $item->on_sale_price != 0 && $item->on_sale_price != ""){
        if($item->tax_id == 1){
          $sumFinalPrice1 = $item->on_sale_price * $incIGV_format;
          $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
          // if(count($getAllCouponInfo) > 0){
          //   $sumTotalPriceFinal = $couponInfo_totalprice;
          // }else{
          //   $sumTotalPriceFinal = $sumFinalPrice2;
          // }
          if(count($getAllDataCouponById) > 0){
            $sumTotalPriceFinal = $couponInfo_totalprice;
          }else{
            $sumTotalPriceFinal = $sumFinalPrice2;
          }
        }else{
          $sumFinalPrice1 = $item->on_sale_price;
          $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
          // if(count($getAllCouponInfo) > 0){
          //   $sumTotalPriceFinal = $couponInfo_totalprice;
          // }else{
          //   $sumTotalPriceFinal = $sumFinalPrice2;
          // }
          if(count($getAllDataCouponById) > 0){
            $sumTotalPriceFinal = $couponInfo_totalprice;
          }else{
            $sumTotalPriceFinal = $sumFinalPrice2;
          }
        }                    
      }else if($item->sections_id == 2 && $item->special_offer_price != 0 && $item->special_offer_price != ""){
        if($item->tax_id == 1){
          $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
          $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
          // if(count($getAllCouponInfo) > 0){
          //   $sumTotalPriceFinal = $couponInfo_totalprice;
          // }else{
          //   $sumTotalPriceFinal = $sumFinalPrice2;
          // }
          if(count($getAllDataCouponById) > 0){
            $sumTotalPriceFinal = $couponInfo_totalprice;
          }else{
            $sumTotalPriceFinal = $sumFinalPrice2;
          }
        }else{
          $sumFinalPrice1 = $item->special_offer_price;
          $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
          // if(count($getAllCouponInfo) > 0){
          //   $sumTotalPriceFinal = $couponInfo_totalprice;
          // }else{
          //   $sumTotalPriceFinal = $sumFinalPrice2;
          // }
          if(count($getAllDataCouponById) > 0){
            $sumTotalPriceFinal = $couponInfo_totalprice;
          }else{
            $sumTotalPriceFinal = $sumFinalPrice2;
          }
        }
      }else{
        if($item->tax_id == 1){                
          $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
          $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
          // if(count($getAllCouponInfo) > 0){
          //   $sumTotalPriceFinal = $couponInfo_totalprice;
          // }else{
          //   $sumTotalPriceFinal = $sumFinalPrice2;
          // }
          if(count($getAllDataCouponById) > 0){
            $sumTotalPriceFinal = $couponInfo_totalprice;
          }else{
            $sumTotalPriceFinal = $sumFinalPrice2;
          }
        }else{
          $sumFinalPrice1 = $item->special_offer_price;
          $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1; 
          // if(count($getAllCouponInfo) > 0){
          //   $sumTotalPriceFinal = $couponInfo_totalprice;
          // }else{
          //   $sumTotalPriceFinal = $sumFinalPrice2;
          // }
          if(count($getAllDataCouponById) > 0){
            $sumTotalPriceFinal = $couponInfo_totalprice;
          }else{
            $sumTotalPriceFinal = $sumFinalPrice2;
          }
        }
      }
    }else{
      // if(count($getAllCouponInfo) > 0){
      //   $sumTotalPriceFinal = $couponInfo_totalprice;
      // }else{
      //   $sumTotalPriceFinal = $item->discount_price;
      // }
      if(count($getAllDataCouponById) > 0){
        $sumTotalPriceFinal = $couponInfo_totalprice;
      }else{
        $sumTotalPriceFinal = $item->discount_price;
      }
    }
  ?>
  <div class="col-gd">
    <div class="product-card">
      @if (!$item->is_stock())
        <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
      @endif
      @if($item->previous_price && $item->previous_price !=0)
        <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
      @endif
      <div class="product-thumb" >
        <a href="{{route('front.product',$item->slug)}}" class="d-flex align-items-center justify-content-center">
          <img class="lazy" src="{{asset('assets/images/items/'.$item->thumbnail)}}" data-src="{{asset('assets/images/items/'.$item->thumbnail)}}" alt="Product">
        </a>  
        <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
          <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" class="{{__('Compare')}}"><i class="icon-repeat"></i></a>
            @include('includes.item_footer',['sitem' => $item])
        </div>
      </div>
      <div class="product-card-body">
        <div class="product-category">
          <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
        </div>
        <h3 class="product-title">
          <a href="{{route('front.product',$item->slug)}}">{{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}</a>
        </h3>
        <p class="product-sku__2">SKU: {{ strlen(strip_tags($item->sku)) > 35 ? substr(strip_tags($item->sku), 0, 35) : strip_tags($item->sku) }}</p>
        <h4 class="product-price">
          @if ($item->previous_price !=0)
          <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
          @endif
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
@empty
<div class="card">
  <div class="card-body text-center">{{__('No Product Found')}}</div>
</div>
@endforelse
<script type="text/javascript" src="{{asset('assets/front/js/extraindex.js')}}"></script>