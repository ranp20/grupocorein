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
        <div class="rating-stars">
          {!! renderStarRating($item->reviews->avg('rating')) !!}
        </div>
        <h4 class="product-price">
        @if ($item->previous_price != 0)
        <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
        @endif
        <span>{{PriceHelper::grandCurrencyPrice($item)}}</span>
        </h4>
        <div class="cWtspBtnCtc">
          <a title="Solicitar información" href="https://api.whatsapp.com/send?phone=51{{$setting->footer_phone}}&text=Solicito información sobre: {{route('front.product',$item->slug)}}" target="_blank" class="cWtspBtnCtc__pLink">
            <img src="{{route('front.index')}}/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
          </a>
          <div class="cWtspBtnCtc__pSubM">
            <ul class="cWtspBtnCtc__pSubM__m">
              <li class="cWtspBtnCtc__pSubM__m__i">
                <a class="cWtspBtnCtc__pSubM__m__link" href="" target="_blank">
                  <!-- <img src="{{ asset('assets/back/images/WhatsApp') }}/icono-tienda-1.png" alt="Icono-tienda" width="100" height="100" decoding="sync"> -->
                  <img src="{{ asset('assets/images/Utilities') }}/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                  <!-- <span>912 831 232</span> -->
                  <span>Tienda #1</span>
                </a>
              </li>
              <li class="cWtspBtnCtc__pSubM__m__i">
                <a class="cWtspBtnCtc__pSubM__m__link" href="" target="_blank">
                  <!-- <img src="{{ asset('assets/back/images/WhatsApp') }}/icono-tienda-1.png" alt="Icono-tienda" width="100" height="100" decoding="sync"> -->
                  <img src="{{ asset('assets/images/Utilities') }}/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                  <!-- <span>974 124 991</span> -->
                  <span>Tienda #2</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>