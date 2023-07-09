@extends('master.front')
@section('title')
 {{ $item->name}}
@endsection
@section('meta')
<meta name="keywords" content="{{$item->meta_keywords}}">
<meta name="description" content="{{$item->meta_description}}">
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
          <li class="separator"></li>
          <li><a href="{{route('front.catalog')}}">{{__('Shop')}}</a></li>
          <li class="separator"></li>
          <li>{{$item->name}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-1x mb-1">
  <div class="row">
    <div class="col-xxl-5 col-lg-6 col-md-6">
      <div class="product-gallery">
        @if ($item->video)
        <div class="gallery-wrapper">
          <div class="gallery-item video-btn text-center">
            <a href="{{ $item->video }}" title="Watch video"></a>
          </div>
        </div>
        @endif
        @if($item->is_stock())
        <span class="product-badge
        @if($item->is_type == 'feature')
        bg-warning
        @elseif($item->is_type == 'new')
        bg-success
        @elseif($item->is_type == 'top')
        bg-info
        @elseif($item->is_type == 'best')
        bg-dark
        @elseif($item->is_type == 'flash_deal')
          bg-success
        @endif
        ">{{  $item->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$item->is_type)) : ''   }}</span>
        @else
        <span class="product-badge bg-secondary border-default text-body
        ">{{__('out of stock')}}</span>
        @endif
        @if($item->previous_price && $item->previous_price !=0)
        <div class="product-badge bg-goldenrod  ppp-t"> -{{PriceHelper::DiscountPercentage($item)}}</div>
        @endif
        <div class="product-thumbnails insize">
          <div class="product-details-slider owl-carousel" >
            <div class="item"><img src="{{asset('assets/images/'.$item->photo)}}" alt="zoom"  /></div>
            @foreach ($galleries as $key => $gallery)
            <div class="item"><img src="{{asset('assets/images/'.$gallery->photo)}}" alt="zoom"  /></div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @php
    function renderStarRating($rating,$maxRating=5) {
      $fullStar = "<i class = 'far fa-star filled'></i>";
      $halfStar = "<i class = 'far fa-star-half filled'></i>";
      $emptyStar = "<i class = 'far fa-star'></i>";
      $rating = $rating <= $maxRating?$rating:$maxRating;

      $fullStarCount = (int)$rating;
      $halfStarCount = ceil($rating)-$fullStarCount;
      $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

      $html = str_repeat($fullStar,$fullStarCount);
      $html .= str_repeat($halfStar,$halfStarCount);
      $html .= str_repeat($emptyStar,$emptyStarCount);
      $html = $html;
      return $html;
    }
    @endphp
    <div class="col-xxl-7 col-lg-6 col-md-6">
      <div class="details-page-top-right-content d-flex align-items-center">
        <div class="div w-100">
          <input type="hidden" id="item_id" value="{{$item->id}}">
          <input type="hidden" id="demo_price" value="{{PriceHelper::setConvertPrice($item->discount_price)}}">
          <input type="hidden" value="{{PriceHelper::setCurrencySign()}}" id="set_currency">
          <input type="hidden" value="{{PriceHelper::setCurrencyValue()}}" id="set_currency_val">
          <input type="hidden" value="{{$setting->currency_direction}}" id="currency_direction">
          <h4 class="mb-2 p-title-main">{{$item->name}}</h4>
          <div class="mb-3">
            @if ($item->is_stock())
              <span class="text-success  d-inline-block">{{__('In Stock')}}</span>
            @else
              <span class="text-danger  d-inline-block">{{__('Out of stock')}}</span>
            @endif
          </div>
          @if($item->is_type == 'flash_deal')
          @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
          <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}">
          </div>
          @endif
          @endif
          <span class="h3 d-block price-area">
          @if ($item->previous_price != 0)
            <small class="d-inline-block"><del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del></small>
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
                    <span id="main_price" class="main-price">{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                  @else
                    @php
                      $sumFinalPrice1 = $item->on_sale_price;
                      $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                    @endphp
                    <span id="main_price" class="main-price">{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                  @endif
                @else
                <span id="main_price" class="main-price">{{PriceHelper::setCurrencyPrice($item->discount_price)}}</span>
                @endif
              @else
                @if($item->special_offer_price != 0 && $item->special_offer_price != "")
                  @if(isset($item->tax_id) && $item->tax_id == 1)
                    @php
                      $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
                      $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                    @endphp
                    <span id="main_price" class="main-price">{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                  @else
                    @php
                      $sumFinalPrice1 = $item->special_offer_price;
                      $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                    @endphp
                    <span id="main_price" class="main-price">{{PriceHelper::setCurrencyPrice($sumFinalPrice2)}}</span>
                  @endif
                @else
                  <span id="main_price" class="main-price">{{PriceHelper::setCurrencyPrice($item->discount_price)}}</span>
                @endif
              @endif
            @endif
            @if(isset($item->tax_id) && $item->tax_id == 1)
            <span style="font-size: 13px;margin-left: 5px;">Inc. IGV</span>
            @else
            <span style="font-size: 13px;margin-left: 5px;">Sin IGV</span>
            @endif
          </span>
          <p class="text-muted">{{$item->sort_details}} <a href="#details" class="txtd-underline scroll-to">{{__('Read more')}}</a></p>
          <div class="row margin-top-1x">
            @foreach($attributes as $attribute)
            @if($attribute->options->count() != 0)
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                  <select class="form-control attribute_option" id="{{ $attribute->name }}">
                    @foreach($attribute->options->where('stock','!=','0') as $option)
                    <option value="{{ $option->name }}" data-type="{{$attribute->id}}" data-href="{{$option->id}}" data-target="{{PriceHelper::setConvertPrice($option->price)}}">{{ $option->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @endif
            @endforeach
          </div>
          <div class="row align-items-end pb-4">
            <div class="col-sm-12 cCtActions__Prd">
              @if ($item->item_type == 'normal')
              <div class="qtySelector product-quantity">
                <span class="decreaseQty subclick"><i class="fas fa-minus"></i></span>
                <input type="text" class="qtyValue cart-amount" value="1">
                <span class="increaseQty addclick"><i class="fas fa-plus"></i></span>
                <input type="hidden" value="3333" id="current_stock">
              </div>
              @endif
              <div class="p-action-button" style="display: flex;align-items:center;justify-content:flex-start;flex-flow:wrap;">
                @if ($item->item_type != 'affiliate')
                  @if ($item->is_stock())
                  <button class="btn btn-primary m-0 a-t-c-mr" id="add_to_cart"><i class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>  
                  @else
                    <button class="btn btn-primary m-0"><i class="icon-bag"></i><span>{{__('Out of stock')}}</span></button>
                  @endif
                @else
                @endif
                <div class="cWtspBtnCtc">
                  <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
                    <img src="../assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
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
          <div class="cPrd__cGrpModls">
            <ul class="cPrd__cGrpModls__m">
              <li class="cPrd__cGrpModls__m__i">
                <img src="{{route('front.index')}}/assets/images/1669243396carro.png">
                <span class="fw-bold"> Disponible despacho a domicilio </span>
                <a href="javascript:void(0);" class="txtd-underline" data-bs-toggle="modal" data-bs-target="#calcDespacho">Calcular despacho</a>
              </li>
              <li class="cPrd__cGrpModls__m__i">
                <img src="{{route('front.index')}}/assets/images/1669243349tienda.png">
                <span class="fw-bold"> Disponibilidad de retiro en tienda </span>
                <a href="javascript:void(0);" class="txtd-underline" data-bs-toggle="modal" data-bs-target="#viewLocationStore">Ver ubicación de la tienda</a>
              </li>
            </ul>
            <div class="modal fade" id="calcDespacho" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  @php
                    $paisAll = DB::table('countries')->get();
                    $departamentoAll = DB::table('tbl_departamentos')->get();
                    $provinciaAll = DB::table('tbl_provincias')->get();
                    $distritoAll = DB::table('tbl_distritos')->get();
                  @endphp
                  <div class="modal-header">
                    <span class="text-uppercase ms-auto me-auto"><strong>Calcular despacho</strong></span>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <div class="cTitleMdBy__c">
                      <div class="cTitleMdBy__c__cTitle">
                        <h3>Selecciona tu localidad  donde desees que se envie tu producto</h3>
                      </div>
                    </div>
                    <hr>
                    <form action="" method="POST">
                      @csrf
                      <div class="pt-3">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_country" class="label">País</label>
                              <select name="consult_country_id" id="consult_country" title="País" class="form-control">
                                <option selected value="">Elige País</option>
                                @foreach($paisAll as $countryData)
                                <option value="{{ $countryData->id }}" selected>{{ $countryData->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_departamento" class="label">Departamento</label>
                              <select name="consult_departamento_id" id="consult_departamento" title="Departamento" class="form-control" data-href="{{route('front.provincia')}}">
                                <option value="">Elige una opción</option>
                                @foreach($departamentoAll as $departData)
                                <option value="{{ $departData->id }}" data-code="{{ $departData->departamento_code }}">{{ $departData->departamento_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_provincia" class="label">Provincia</label>
                              <select name="consult_provincia_id" id="consult_provincia" title="Provincia" class="form-control" data-href="{{route('front.distrito')}}">
                                <option value="">Elige Departamento</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_distrito" class="label">Distrito</label>
                              <select name="consult_distrito_id" id="consult_distrito" title="Distrito" class="form-control" data-href="{{ route('front.getammountdispath') }}">
                                <option value="">Elige Provincia</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <div>
                      <div id="svalgscirn45__3FgH3" style="display: none;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="viewLocationStore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <span class="text-uppercase ms-auto me-auto"><strong>Consultar retiro</strong></span>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <div class="pt-1 cBodyMdBy__c">
                      <div class="d-block cBodyMdBy__c__cList">
                        @php
                          $StoresAll = "";
                          $arrStoresAdd = [];
                          if(isset($item->store_availables) && $item->store_availables != ""){
                            $storesAvailables = json_decode($item->store_availables, TRUE);
                            $storesAvailables_list = $storesAvailables['store'];
                            foreach($storesAvailables_list as $key => $val){
                              $arrStoresAdd['id'] = $val['id'];
                            }
                          }
                          if(isset($arrStoresAdd['id'])){
                            $StoresAll = DB::table('tbl_stores')->where('id',$arrStoresAdd['id'])->get();
                          }
                        @endphp
                        @if(!empty($StoresAll) && count($StoresAll) > 0)
                        <ul class="cBodyMdBy__c__cList__m">
                          @foreach(json_decode($StoresAll, TRUE) as $stores)
                          <li href="javascript:void(0);" class="cBodyMdBy__c__cList__m__i">
                            <div style="display: block;width:100%;">
                              <div class="cBodyMdBy__c__cList__m__i__cTop">
                                <div class="cBodyMdBy__c__cList__m__i__cTop__cIcon">
                                  <img src="{{route('front.index')}}/assets/images/1669243349tienda.png" target="_blank">
                                </div>
                                <div class="cBodyMdBy__c__cList__m__i__cTop__cNameStr">{{ $stores['name'] }}</div>
                              </div>
                            </div>
                            <div class="cBodyMdBy__c__cList__m__i__cBott">
                              <ul class="cBodyMdBy__c__cList__m__i__cBott__m">
                                <li><span><strong>Dirección: </strong>{{ $stores['address'] }}</span></li>
                                <li><span><strong>Teléfono: </strong>{{ $stores['telephone'] }}</span></li>
                              </ul>
                            </div>
                          </li>
                        @endforeach
                        @else
                        <div class="text-center">
                          <h5>Sin tiendas disponibles.</h5>
                        </div>
                        @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="t-c-b-area">
              @if ($item->brand_id)
              <div class="pt-1 mb-1"><span class="text-medium">{{__('Brand')}}:</span>
                <a href="{{route('front.catalog').'?brand='.$item->brand->slug}}">{{$item->brand->name}}</a>
              </div>
              @endif
              <div class="pt-1 mb-1"><span class="text-medium">{{__('Categories')}}:</span>
                <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
                  @if ($item->subcategory->name)
                  /
                  @endif
                <a href="{{route('front.catalog').'?subcategory='.$item->subcategory->slug}}">{{$item->subcategory->name}}</a>
                  @if ($item->childcategory->name)
                  /
                  @endif
                <a href="{{route('front.catalog').'?childcategory='.$item->childcategory->slug}}">{{$item->childcategory->name}}</a>
              </div>
              <div class="pt-1 mb-1"><span class="text-medium">Etiquetas:</span>
                @if($item->tags)
                @foreach (explode(',',$item->tags) as $tag)
                @if ($loop->last)
                <a href="{{route('front.catalog').'?tag='.$tag}}">{{$tag}}</a>
                @else
                <a href="{{route('front.catalog').'?tag='.$tag}}">{{$tag}}</a>,
                @endif
                @endforeach
                @endif
              </div>
              @if ($item->item_type == 'normal')
              <div class="pt-1 mb-1"><span class="text-medium">STOCK:</span> {{$item->stock}}</div>
              @endif
              @if ($item->item_type == 'normal')
              <div class="pt-1 mb-1"><span class="text-medium">CÓDIGO SAP:</span> {{$item->sap_code}}</div>
              @endif
              @if ($item->item_type == 'normal')
              <div class="pt-1 mb-4"><span class="text-medium">{{__('SKU')}}:</span>{{$item->sku}}</div>
              @endif
              <!-- NUEVO CONTENIDO (INICIO) -->
              @if($item->adj_doc != "" && $item->adj_doc != null)
              <div class="ficha">
                <a href="{{ asset('assets/files/item/adj_doc/'.$item->adj_doc) }}" target="_blank" title="Ficha Técnica del producto">
                  <img class="fic" src="{{route('front.index')}}/assets/images/ficha-tecnica.png">
                </a>
              </div>
              @endif
              <!-- NUEVO CONTENIDO (FIN) -->
            </div>
            <div class="mt-4 p-d-f-area">
              <div class="left">
                <a class="btn btn-primary btn-sm wishlist_store wishlist_text" href="{{route('user.wishlist.store',$item->id)}}"><span><i class="icon-heart"></i></span>
                @if (Auth::check() && App\Models\Wishlist::where('user_id',Auth::user()->id)->where('item_id',$item->id)->exists())
                <span>{{__('Added To Wishlist')}}</span>
                @else
                <span class="wishlist1">{{__('Wishlist')}}</span>
                <span class="wishlist2 d-none">{{__('Added To Wishlist')}}</span>
                @endif
                </a>
                <button class="btn btn-primary btn-sm  product_compare" data-target="{{route('fornt.compare.product',$item->id)}}" ><span><i class="icon-repeat"></i>{{__('Compare')}}</span></button>
              </div>
              <div class="d-flex align-items-center">
                <span class="text-muted mr-1">Compartir: </span>
                <div class="d-inline-block a2a_kit">
                  <a class="facebook  a2a_button_facebook" href="">
                    <span><i class="fab fa-facebook-f"></i></span>
                  </a>
                  <a class="twitter  a2a_button_twitter" href="">
                    <span><i class="fab fa-twitter"></i></span>
                  </a>
                  <a class="linkedin  a2a_button_linkedin" href="">
                    <span><i class="fab fa-linkedin-in"></i></span>
                  </a>
                  <a class="pinterest   a2a_button_pinterest" href="">
                    <span><i class="fab fa-pinterest"></i></span>
                  </a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class=" padding-top-3x mb-3" id="details">
      <div class="col-lg-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">{{__('Descriptions')}}</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">{{__('Specifications')}}</a>
          </li>
        </ul>
        <div class="tab-content card">
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"">
          {!! $item->details !!}
          </div>
          <div class="tab-pane fade show" id="specification" role="tabpanel" aria-labelledby="specification-tab">
            <div class="comparison-table">
              <table class="table table-bordered">
                <thead class="bg-secondary">
                </thead>
                <tbody>
                <tr class="bg-secondary">
                  <th class="text-uppercase">{{__('Specifications')}}</th>
                  <td><span class="text-medium">{{__('Descriptions')}}</span></td>
                </tr>
                @if($sec_name)
                @foreach(array_combine($sec_name,$sec_details) as  $sname => $sdetail)
                <tr>
                  <th>{{$sname}}</th>
                  <td>{{$sdetail}}</td>
                </tr>
                @endforeach
                @else
                <tr class="text-center">
                  <td colspan="2">{{__('No Specifications')}}</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if(count($related_items)>0)
<div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
  <div class="row">
    <div class="col-lg-12">
      <div class="section-title">
        <h2 class="h3">{{ __('También te puede interesar') }}</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="relatedproductslider owl-carousel" >
        @foreach ($related_items as $related)
          <div class="slider-item">
            <div class="product-card">
              @if ($related->is_stock())
                @if($related->is_type == 'new')
                @else
                  <div class="product-badge
                  @if($related->is_type == 'feature')
                  bg-warning

                  @elseif($related->is_type == 'top')
                  bg-info
                  @elseif($related->is_type == 'best')
                  bg-dark
                  @elseif($related->is_type == 'flash_deal')
                  bg-success
                  @endif
                  ">{{  $related->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$related->is_type)) : ''   }}</div>
                  @endif
                  @else
                  <div class="product-badge bg-secondary border-default text-body
                  ">{{__('out of stock')}}</div>
              @endif
              @if($related->previous_price && $related->previous_price !=0)
              <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($related)}}</div>
              @endif
              @if($related->previous_price && $related->previous_price !=0)
              <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($related)}}</div>
              @endif
              <div class="product-thumb">
                <a href="{{route('front.product',$related->slug)}}"><img class="lazy" data-src="{{asset('assets/images/'.$related->thumbnail)}}" alt="Product"></a>
                <div class="product-button-group">
                  <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$related->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                  <a class="product-button product_compare" href="javascript:;" data-target="{{route('fornt.compare.product',$related->id)}}" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                  @include('includes.item_footer',['sitem' => $related])
                </div>
              </div>
              <div class="product-card-body">
                <div class="product-category"><a href="{{route('front.catalog').'?category='.$related->category->slug}}">{{$related->category->name}}</a></div>
                <h3 class="product-title">
                  <a href="{{route('front.product',$related->slug)}}">
                  {{ strlen(strip_tags($related->name)) > 35 ? substr(strip_tags($related->name), 0, 35) : strip_tags($related->name) }}
                  </a>
                </h3>
                <h4 class="product-price">
                @if ($related->previous_price !=0)
                <del>{{PriceHelper::setPreviousPrice($related->previous_price)}}</del>
                @endif
                {{PriceHelper::grandCurrencyPrice($related)}} </h4>
                <div class="cWtspBtnCtc">
                  <a title="Solicitar información" href="https://api.whatsapp.com/send?phone=51{{$setting->footer_phone}}&text=Solicito información sobre: {{route('front.product',$related->slug)}}" target="_blank" class="cWtspBtnCtc__pLink">
                    <img src="../assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
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
    </div>
  </div>
</div>
@endif
<script type="text/javascript" src="{{ asset('assets/front/js/product-details.js') }}"></script>
@endsection