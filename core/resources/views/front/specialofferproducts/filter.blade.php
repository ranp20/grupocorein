<div class="row g-3" id="main_div">
  @foreach ($specialoffer_items as $item)
  <div class="col-gd">
    <div class="product-card">
      <div class="product-thumb">
        @if ($item->stock != 0)
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
          <div class="product-badge {{ $itm_istype }}">{{ ($item->is_type != 'undefine') ? ucfirst(str_replace('_',' ',$item->is_type)) : '' }}</div>
        @else
          <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
        @endif
        @if($item->previous_price && $item->previous_price != 0)
          <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
        @endif
        <a href="{{route('front.product',$item->slug)}}" class="d-flex align-items-center justify-content-center">
          <img src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product">
        </a>
        <div class="product-button-group">
          <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
          <a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
          @include('includes.item_footer',['sitem' => $item])
        </div>
      </div>
      <div class="product-card-body">
        <div class="product-category">
          <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
        </div>
        <h3 class="product-title">
          <a href="{{route('front.product',$item->slug)}}">
          {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
          </a>
        </h3>
        <h4 class="product-price">
        @if ($item->previous_price != 0)
        <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
        @endif
        @php
          $TaxesAll = DB::table('taxes')->get();
          $sumFinalPrice1 = 0;
          $sumFinalPrice2 = 0;
          $incIGV = $TaxesAll[0]->value;
          $sinIGV = $TaxesAll[1]->value;
          $incIGV_format = $incIGV / 100;
          $sinIGV_format = $sinIGV;
        @endphp
          @if(isset($item->sections_id) && $item->sections_id != 0)
            @if($item->sections_id == 1)
              @if($item->on_sale_price != 0 && $item->on_sale_price != "")
                @if(isset($item->tax_id) && $item->tax_id == 1)
                  @php
                    $sumFinalPrice1 = $item->on_sale_price * $incIGV_format;
                    $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                  @endphp
                  <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                @else
                  @php
                    $sumFinalPrice1 = $item->on_sale_price;
                    $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                  @endphp
                  <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                @endif
              @else
                <span>{{PriceHelper::setCurrencyPrice($item->discount_price)}}</span>
              @endif
            @else
              @if($item->special_offer_price != 0 && $item->special_offer_price != "")
                @if(isset($item->tax_id) && $item->tax_id == 1)
                  @php
                    $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
                    $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                  @endphp
                  <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                @else
                  @php
                    $sumFinalPrice1 = $item->special_offer_price;
                    $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                  @endphp
                  <span>{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                @endif
              @else
                <span>{{PriceHelper::setCurrencyPrice($item->discount_price)}}</span>
              @endif
            @endif
          @else
            <span>{{PriceHelper::setCurrencyPrice($item->discount_price)}}</span>
          @endif
        </h4>
        <div class="cWtspBtnCtc">
          <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
            <img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
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