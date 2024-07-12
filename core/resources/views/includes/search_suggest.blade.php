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
    <div class="lSearchM__m__l p-col py-0 mb-0">
      <a class="lSearchM__m__link" href="{{route('front.product',$item->slug)}}">
        <span class="product-thumb">
          <img class="lazy" alt="Product" src="{{asset('assets/images/items/'.$item->thumbnail)}}" width="100" height="100">
        </span>
        <span class="product-card-body">
          <span class="product-title">
            {{-- <!-- <span>{{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}</span> --> --}}
            <span>{{ $item->name }}</span>
          </span>
          {{--
          <!--
          <div class="rating-stars">
            {!! renderStarRating($item->reviews->avg('rating')) !!}
          </div>
          -->
          --}}
          <span class="product-price">
            {{PriceHelper::grandCurrencyPrice($item)}}
          </span>
        </span>
      </a>
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