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
@endphp
<div class="s-r-inner">
  @if(isset($items) && count($items) > 0)
    @foreach ($items as $item)
    <div class="product-card lSearchM__m__l p-col py-0 mb-0">
      <a class="product-thumb" href="{{route('front.product',$item->slug)}}">
        <img class="lazy" alt="Product" src="{{asset('assets/images/'.$item->thumbnail)}}" style="">
      </a>
      <div class="product-card-body">
        <h3 class="product-title">
          <a href="{{route('front.product',$item->slug)}}">
            {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
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
          {{PriceHelper::grandCurrencyPrice($item)}}
        </h4>
      </div>
    </div>
    @endforeach
  @else
  <div class="text-center">
    <p>No se encontraron resultados</p>
  </div>
  @endif
</div>
<div class="bottom-area">
  <a id="view_all_search_" href="{{route('front.catalog')}}">{{ __('View all result') }}</a>
</div>