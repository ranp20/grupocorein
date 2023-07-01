<div class="row g-3" id="main_div">
  @foreach ($specialoffer_items as $item)
  <div class="col-gd">
    <div class="product-card">
      <div class="product-thumb">
        @if ($item->stock != 0)
          @php
          $classValStock = '';
          if($item->is_type == 'feature'){
            $classValStock = 'bg-warning';
          }else if($item->is_type == 'new'){
            $classValStock = '';
          }else if($item->is_type == 'top'){
            $classValStock = 'bg-info';
          }else if($item->is_type == 'best'){
            $classValStock = 'bg-dark';
          }else if($item->is_type == 'flash_deal'){
            $classValStock = 'bg-success';
          }else{
            $classValStock = '';
          }
          @endphp
          <div class="product-badge {{$classValStock}}">
          {{ ($item->is_type != 'undefine') ? ucfirst(str_replace('_',' ',$item->is_type)) : '' }}
          </div>
        @else
          <div class="product-badge bg-secondary border-default text-body">{{__('out of stock')}}</div>
        @endif
        @if($item->previous_price && $item->previous_price != 0)
          <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
        @endif
        <a href="{{route('front.product',$item->slug)}}"> <img src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
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
          @if(isset($item->sections_id) && $item->sections_id != 0)
            @if($item->sections_id == 1)
            <span>{{PriceHelper::setCurrencyPrice($item->on_sale_price)}}</span>
            @else
            <span>{{PriceHelper::setCurrencyPrice($item->special_offer_price)}}</span>
            @endif
          @endif
        </h4>
        <div class="cWtspBtnCtc">
          <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
            <img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
          </a>
          <div class="cWtspBtnCtc__pSubM">
            @if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers))
            @php
                $titles = json_decode($setting->whatsapp_numbers,true)['title'];
                $texts = json_decode($setting->whatsapp_numbers,true)['text'];
                $numbers = json_decode($setting->whatsapp_numbers,true)['number'];
            @endphp
            <ul class="cWtspBtnCtc__pSubM__m">
              @foreach ($numbers as $key => $number)
              <li class="cWtspBtnCtc__pSubM__m__i">
                  <a title="{{ $titles[$key] }}" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51{{ $numbers[$key] }}&text={{ $texts[$key] }}" target="_blank">
                      <!-- <img src="{{ asset('assets/back/images/WhatsApp') }}/icono-tienda-1.png" alt="Icono-tienda" width="100" height="100" decoding="sync"> -->
                      <img src="{{ asset('assets/images/Utilities') }}/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                      <!-- <span>912 831 232</span> -->
                      <span>{{ $titles[$key] }}</span>
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