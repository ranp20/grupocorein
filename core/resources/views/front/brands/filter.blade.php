@foreach ($brands as $brand)
  <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-6 ctSec-Brand__c__i">
    <a class="b-p-s-b ctSec-Brand__c__i__link" href="{{ route('front.catalog') . '?brand=' . $brand->slug }}">
      <img class="d-block himx-90" src="{{ asset('assets/images/brands/' . $brand->photo) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}" width="100" height="100" decoding="sync">
    </a>
  </div>
@endforeach