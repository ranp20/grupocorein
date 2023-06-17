@if($sitem->item_type != 'affiliate')
  @if($sitem->is_stock())
  <?php
    $qtyProdSess = 0;
    if(Session::has('cart')){
      $cartInfoSess = Session::get('cart');
      if($cartInfoSess && isset($cartInfoSess[$sitem->id.'-'])){
        $qtyProdSess = $cartInfoSess[$sitem->id.'-']['qty'];
      }
    }
  ?>
  <a class="product-button add_to_single_cart" data-id="{{ $sitem->id }}-" data-target="{{ $sitem->id }}" data-qty="{{ $qtyProdSess }}" href="javascript:;"  title="{{__('To Cart')}}"><i class="icon-shopping-cart"></i></a>
  @else
  <a class="product-button" href="{{route('front.product',$sitem->slug)}}" title="{{__('Details')}}"><i class="icon-arrow-right"></i></a>
  @endif
@else
  <a class="product-button" href="{{$sitem->affiliate_link}}" target="_blank" title="{{__('Buy Now')}}"><i class="icon-arrow-right"></i></a>
@endif