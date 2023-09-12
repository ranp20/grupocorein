@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
  {{__('Catalogs')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{(route('front.index'))}}">{{__('Home')}}</a></li>
          <li class="separator">&nbsp;</li>
          <li>{{__('Catalogs')}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12" >
      <img src="{{route('front.index')}}/assets/images/catalogo-pro.jpg" style="margin-bottom: 20px;">
    </div>
  </div>
  <?php                  
    $tbl_catalogs = DB::table('tbl_catalogs')->get()->toArray();
    $arrCatalogsYears = [];
    $arrCatalogsYears2 = [];
    $arrCatalogsYears3 = [];
    foreach($tbl_catalogs as $k => $v){
      $date = $v->created_at;
      $dateYears = date("Y",strtotime($date));
      $arrCatalogsYears[$k] = $dateYears;
    }
    $arrCatalogsFilterUnique = array_unique($arrCatalogsYears);
    $arrCatalogsYears2 = array_values($arrCatalogsFilterUnique);
    foreach($arrCatalogsYears2 as $k => $v){
      $arrCatalogsYears3[$k]['year'] = $v;
    }
  ?>
  <div>
    <div class="deal-of-day-section pb-5">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2 class="h3">{{__('Catalogs')}}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="shop-top-filter-wrapper">
            <div class="row">
              <div class="col-md-10 gd-text-sm-center">
                <div class="sptfl">
                  <div class="shop-sorting">
                    <label for="sorting">{{__('Sort by')}}:</label>
                    <select class="form-control" id="sorting">
                      <option value="">{{__('All catalogs')}}</option>
                      @foreach($arrCatalogsYears3 as $k => $v)
                      @php
                        $iptSelecYear = 'y-'.$v['year'];
                      @endphp
                      <option value="{{ $iptSelecYear }}" {{request()->input($iptSelecYear) ? 'selected' : ''}}>{{ $v['year'] }}</option>
                      @endforeach
                    </select>
                    <span class="text-muted">{{__('Showing')}}:</span>
                    <span>1 - {{$setting->view_product}} {{__('items')}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 order-lg-2" id="list_view_ajax">
            @include('front.journals.filter')
          </div>
        
          {{--
          <!--
          <div class="container pt-3 pb-3">
            <div class="row pb-4">
              <div class="col-lg-3 col-md-6">
                <div class="">               
                  <p><a class="boton-as"><img src="{{route('front.index')}}/assets/images/1610202007194386.png"></a></p>
                  <p class="titulo-we">CATÁLOGO CINTILLOS Y TERMINALES 2020</p>
                  <p class="boton-aed"><a href="{{route('front.index')}}/assets/images/catalogo_5f898ea24f109.pdf" class="btn_add_cart" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a></p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="">
                  <p><a class="boton-as"><img src="{{route('front.index')}}/assets/images/1610202007142666.png"></a></p>
                  <p class="titulo-we">CATALOGO LINEA CONDUIT Y ACCESORIOS 2020</p>
                  <p class="boton-aed"><a href="{{route('front.index')}}/assets/images/catalogo_5f898ea24f109.pdf" class="btn_add_cart" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a></p>
                </div>
              </div>
            </div>
          </div>
          -->
          --}}

          <form id="search_form" class="d-none" action="{{route('front.getCatalogsByAnio')}}" method="GET">
            <input type="text" name="page" id="page" value="{{isset($page) ? $page : ''}}">
            <input type="text" name="sorting_cataloganio" id="sorting_cataloganio" value="{{isset($sorting_cataloganio) ? $sorting_cataloganio : ''}}">
            <button type="submit" id="search_button_catalog" class="d-none"></button>
          </form>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="{{asset('assets/front/js/faq.js')}}"></script>
@endsection