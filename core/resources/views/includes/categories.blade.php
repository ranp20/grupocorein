@php
  $categories = App\Models\Category::with('subcategory')->whereStatus(1)->orderby('serial','asc')->take(20)->get();
@endphp
<div class="left-category-area w-100 cLCategs__c" data-dropdown-contentmenu="products-menu">
  <!-- <div class="category-header cLCategs__c__cTitle">
    <h4><i class="icon-align-justify"></i> {{ __('Productos') }}</h4>
  </div> -->
  <div class="category-list">
    @foreach ($categories as $key => $pcategory)
    <div class="c-item">
      <a class="d-block navi-link" href="{{route('front.catalog').'?category='.$pcategory->slug}}">
        <img class="lazy" data-src="{{asset('assets/images/categories/'.$pcategory->photo)}}">
        <span class="text-gray-dark">{{$pcategory->name}}</span>
        @if ($pcategory->subcategory->count() > 0)
        <i class="icon-chevron-right"></i>
        @endif
      </a>
      @if ($pcategory->subcategory->count() > 0)
      <div class="sub-c-box">
        <div class="row">                                   
          <div class="col-md-12">
            <p class="titulo-as"> {{$pcategory->name}}</p>
          </div>
        </div>
        @foreach ($pcategory->subcategory as $scategory)
        <div class="child-c-box">
          <div class="row">         
            <div class="col-md-12">
              <a class="title" href="{{route('front.catalog').'?subcategory='.$scategory->slug}}">
                {{$scategory->name}}
                @if ($scategory->childcategory->count() > 0)    
                @endif
              </a>
                @if ($scategory->childcategory->count() > 0)
              <div class="col-md-12">
                @foreach ($scategory->childcategory as $childcategory)
                <div class="col-md-12">
                  <a href="{{route('front.catalog').'?childcategory='.$childcategory->slug}}" class="link-mega">{{$childcategory->name}}</a>
                </div>
                @endforeach
              </div>
              @endif 
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
    @endforeach
  </div>
</div>