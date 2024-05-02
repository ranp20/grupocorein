<div class="row g-3" id="">
  <?php
    
    // echo "<pre>";
    // print_r($catalogos);
    // echo "</pre>";
    
  ?>
  @if($catalogos->count() > 0)
    @foreach ($catalogos as $item)
    <div class="col-gd">
      <div class="product-card">
        <div class="product-thumb cCatalogItm__cImgItm">
          <a href="{{ asset('assets/images/catalogs/'.$item->photo) }}" class="d-flex align-items-center justify-content-center" target="_blank">
            <img src="{{asset('assets/images/catalogs/'.$item->photo)}}" alt="{{ $item->name }}">
          </a>
        </div>
        <div class="product-card-body">
          <h2 class="product-title text-center">
            <span><strong>{{ $item->name }}</strong></span>
          </h2>
        </div>
        <div class="cCatalogItm__cBtnDownload__dcWb">
          <a href="{{asset('assets/files/catalogs/'.$item->adj_doc)}}" download="{{ $item->adj_doc }}" class="cCatalogItm__cBtnDownload__dcWb__link">
            <span class="cCatalogItm__cBtnDownload__dcWb__link__cIcon">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" width="32px" height="32px" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M64.07,77.305L50,92.525l-14.07-15.22h4.91c1.11,0,2-0.9,2-2v-23.65h14.32v23.65c0,1.1,0.89,2,2,2H64.07z"/><path d="M90.92,46.685c0,9.42-7.01,17.34-16.33,18.47H61.16v-15.5c0-1.1-0.9-2-2-2H40.84c-1.1,0-2,0.9-2,2v15.5H25.41  c-9.32-1.13-16.33-9.05-16.33-18.47c0-10.26,8.35-18.6,18.61-18.6c0.51,0,1.03,0.02,1.54,0.06c0.56,0.04,1.11-0.18,1.52-0.56  c0.41-0.37,0.64-0.94,0.64-1.5c0-10.26,8.35-18.61,18.61-18.61s18.61,8.35,18.61,18.68c0,0.56,0.23,1.09,0.64,1.47  s0.97,0.56,1.52,0.52c0.51-0.04,1.03-0.06,1.54-0.06C82.57,28.085,90.92,36.425,90.92,46.685z"/></svg>
            </span>
            <span class="cCatalogItm__cBtnDownload__dcWb__link__cTxt">DESCARGAR</span>
          </a>
        </div>
      </div>
    </div>
    @endforeach
  @else
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body text-center">
        <h4 class="h4 mb-0">{{ __('No Journal Found') }}</h4>
      </div>
    </div>
  </div>
  @endif
</div>