@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 bc-title"><b>{{ __('Create Product') }}</b> </h3>
        <a class="btn btn-primary   btn-sm" href="{{route('back.item.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
      </div>
    </div>
  </div>
  <div id="iptc-A3gs4FS_token">
    @csrf
  </div>
  <?php
    $getAllTaxes = DB::table('taxes')->get()->toArray();
    $arrTaxesValue = [];
    foreach($getAllTaxes as $k => $v){
      $arrTaxesValue[$k]['value'] = $v->value;
    }
  ?>
  <input class="hidden" placeholder="" value="<?= $arrTaxesValue[0]['value'];?>" style="visibility:hidden;display:none;" id="e_hY-596kjkJN79">
  <input class="hidden" placeholder="" value="<?= $arrTaxesValue[1]['value'];?>" style="visibility:hidden;display:none;" id="e_hD-123kjkJN79">
  <div class="row">
    <div class="col-lg-12">
      @include('alerts.alerts')
    </div>
  </div>
  <form class="admin-form tab-form" action="{{ route('back.item.store') }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="normal" name="item_type">
    @csrf
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <!-- <div class="px-2">
              <h2><strong>Atributos</strong></h2>
            </div> -->
            <div class="form-group">
              <label for="unidadraiz">{{ __('Select Root Unit') }} *</label>
              <select name="unidadraiz" id="unidadraiz" class="form-control">
                <option value="" selected>{{__('Select One')}}</option>
                @foreach(DB::table('tbl_unidadraiz')->get() as $uraiz)
                <option value="{{ $uraiz->id }}">{{ $uraiz->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="atributoraiz">{{ __('Select Root Attribute') }} </label>
              <select name="atributoraiz" id="atributoraiz" class="form-control">
                <option value="" selected>{{__('Select One')}}</option>
                @foreach(DB::table('tbl_atributoraiz')->get() as $attraiz)
                <option value="{{ $attraiz->id }}">{{ $attraiz->name }}</option>
                @endforeach
              </select>
            </div>
            <div id="cTentr-af172698__p-adm"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="name">{{ __('Name') }} *</label>
              <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}" required>
              <span id="spn__iptequalsmssg"></span>
            </div>
            <div class="form-group">
              <label for="slug">{{ __('Slug') }} *</label>
              <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ old('slug') }}">
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group pb-0  mb-0">
              <label class="d-block">{{ __('Featured Image') }} *</label>
            </div>
            <div class="form-group pb-0 pt-0 mt-0 mb-0">
              <img class="admin-img lg" src="" >
            </div>
            <div class="form-group position-relative">
              <label class="file">
                <input type="file" accept="image/*" class="upload-photo" name="photo" id="file"  aria-label="File browser example" required>
                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
              </label>
              <br>
              <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group pb-0  mb-0">
              <label>{{ __('Gallery Images') }} </label>
            </div>
            <div class="form-group pb-0 pt-0 mt-0 mb-0">
              <div id="gallery-images" class="">
                <div class="d-block gallery_image_view">
                </div>
              </div>
            </div>
            <div class="form-group position-relative">
              <label class="file">
                <input type="file" accept="image/*" name="galleries[]" id="gallery_file" aria-label="File browser example" accept="image/*" multiple>
                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
              </label>
              <br>
              <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="sort_details">{{ __('Short Description') }} *</label>
              <textarea name="sort_details" id="sort_details" class="form-control" placeholder="{{ __('Short Description') }}" required>{{ old('sort_details') }}</textarea>
            </div>
            <div class="form-group">
              <label for="details">{{ __('Description') }} *</label>
              <textarea name="details" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}">{{ old('details') }}</textarea>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group mb-2">
              <label for="tags">{{ __('Product Tags') }} </label>
              <input type="text" name="tags" class="tags" id="tags" placeholder="{{ __('Tags') }}" value="">
            </div>
            <div class="form-group">
              <label class="switch-primary">
                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_specification" value="1" checked>
                <span class="switch-body"></span>
                <span class="switch-text">{{ __('Specifications') }}</span>
              </label>
            </div>
            <div id="cTentr-af1728903__p-adm">
              <div id="specifications-section">
                <div class="d-flex">
                  <div class="flex-grow-1">
                    <div class="form-group">
                      <input type="text" class="form-control aia843d__spcfname" name="specification_name[]" placeholder="{{ __('Specification Name') }}" value="">
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <div class="form-group">
                      <input type="text" class="form-control aia843d__spcfdsc" name="specification_description[]" placeholder="{{ __('Specification description') }}" value="">
                    </div>
                  </div>
                  <div class="flex-btn">
                    <button type="button" class="btn btn-success add-specification" data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}"> <i class="fa fa-plus"></i> </button>
                  </div>
                </div>
              </div>
              <div class="d-flex c-sctGroupList">
                <div class="flex-grow-1">
                  <div class="scGroupElems-sectionList">
                    <div class="c-zTitleSectionFloating">
                      <span class="c-zTitleSectionFloating__txt">Lista de <strong>Especificaciones Agregadas</strong></span>
                    </div>
                    <div class="scGroupElems-sectionList__c" id="specifications-sectionList__c">
                      <div class="scGroupElems-sectionList__c__deftxt" id="defTxt57vnj-espc__anyval">
                        <p>Sin Especificaciones</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="meta_keywords">{{ __('Meta Keywords') }} </label>
              <input type="text" name="meta_keywords" class="tags" id="meta_keywords" placeholder="{{ __('Enter Meta Keywords') }}" value="">
            </div>
            <div class="form-group">
              <label for="meta_description">{{ __('Meta Description') }} </label>
              <textarea name="meta_description" id="meta_description" class="form-control" rows="5" placeholder="{{ __('Enter Meta Description') }}">{{ old('meta_description') }}</textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <input type="hidden" class="check_button" name="is_button" value="0">
            <button type="submit" class="btn btn-secondary mr-2">{{ __('Save') }}</button>
            <button type="submit" class="btn btn-info save__edit">{{ __('Save & Edit') }}</button>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="coupon_id">{{ __('Select Coupon') }} </label>
              <select name="coupon_id" id="coupon_id" class="form-control" >
                <option value="" selected>{{__('Select Coupon')}}</option>
                @foreach(DB::table('tbl_coupons')->whereStatus(1)->get() as $coupon)
                <option value="{{ $coupon->id }}">{{ $coupon->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="discount_price">{{ __('Current Price') }} *</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">{{ PriceHelper::adminCurrency() }}</span>
                </div>
                <input type="text" id="discount_price" name="discount_price" class="form-control" placeholder="{{ __('Enter Current Price') }}" min="1" step="0.1" value="{{ old('discount_price') }}" required>
              </div>
            </div>
            <div class="form-group">
              <label for="previous_price">{{ __('Previous Price') }} </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{ $curr->sign }}</span>
                  </div>
                  <input type="text" id="previous_price" name="previous_price" class="form-control" placeholder="{{ __('Enter Previous Price') }}" min="1" step="0.1" value="{{ old('previous_price') }}" >
                </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="category_id">{{ __('Select Category') }} *</label>
              <select name="category_id" id="category_id" data-href="{{route('back.get.subcategory')}}" class="form-control" required>
                <option value="" selected>{{__('Select One')}}</option>
                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subcategory_id">{{ __('Select Sub Category') }} </label>
              <select name="subcategory_id" id="subcategory_id" data-href="{{route('back.get.childcategory')}}" class="form-control">
                <option value="">{{__('Select One')}}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="childcategory_id">{{ __('Select Child Category') }} </label>
              <select name="childcategory_id" id="childcategory_id" class="form-control">
                <option value="">{{__('Select One')}}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="brand_id">{{ __('Select Brand') }} </label>
              <select name="brand_id" id="brand_id" class="form-control" >
                <option value="" selected>{{__('Select Brand')}}</option>
                @foreach(DB::table('brands')->whereStatus(1)->get() as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="stock">{{ __('Total in stock') }} *</label>
              <div class="input-group mb-3">
                <input type="number" id="stock" name="stock" class="form-control" placeholder="{{ __('Total in stock') }}" value="{{ old('stock') }}" required>
              </div>
            </div>
            <div class="form-group">
              <label for="tax_id">{{ __('Select Tax') }} *</label>
              <select name="tax_id" id="tax_id" class="form-control" required>
                <option value="">{{__('Select One')}}</option>
                @foreach(DB::table('taxes')->whereStatus(1)->get() as $tax)
                <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="">{{ __('Seleccionar sección') }} *</label>
              <div class="border-list-switchs">
                <div class="form-check pb-0">
                  <section class="c-sRadioBtn__c--cDesign-1">
                    <div class="c-sRadioBtn__c--cDesign-1__c">
                    <input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="sections_id" value="0" id="0"/>
                      <label class="c-sRadioBtn__c--cDesign-1__c__label"></label>
                    </div>
                    <label for="0" style="cursor:pointer;">Ninguna</label>
                  </section>
                  @foreach(DB::table('tbl_sections')->get() as $section)
                    @php
                    $onSection = "";
                    if($section->name == "on_sale"){
                      $onSection = "En promoción";
                    }else if($section->name == "special_offer"){
                      $onSection = "Oferta Especial";
                    }else{
                      $onSection = $section->name;
                    }
                    @endphp
                    <section class="c-sRadioBtn__c--cDesign-1">
                      <div class="c-sRadioBtn__c--cDesign-1__c">
                      <input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="sections_id" value="{{ $section->id }}" id="{{ $onSection }}"/>
                        <label class="c-sRadioBtn__c--cDesign-1__c__label"></label>
                      </div>
                      <label for="{{ $onSection }}" style="cursor:pointer;">{{ $onSection }}</label>
                    </section>
                  @endforeach
                </div>
              </div>
              {{--
              <!--
              <select name="sections_id" id="sections_id" class="form-control" required>
                <option value="">{{__('Select One')}}</option>
                @foreach(DB::table('tbl_sections')->get() as $section)
                  @php
                  $onSection = "";
                  if($section->name == "on_sale"){
                    $onSection = "En promoción";
                  }else if($section->name == "special_offer"){
                    $onSection = "Oferta Especial";
                  }else{
                    $onSection = $section->name;
                  }
                  @endphp
                  <option value="{{ $section->id }}">{{ $onSection }}</option>
                @endforeach
              </select>
              -->
              --}}
            </div>
            <div id="cTentr-af1698__p-adm"></div>
            <div class="form-group">
              <label for="">{{ __('Seleccionar Tiendas') }} *</label>
              <div class="border-list-switchs">
                @foreach(DB::table('tbl_stores')->get() as $section)
                <div class="form-check pb-0">
                  <section class="c-sWitch__c--cDesign-1">
                    <div class="c-sWitch__c--cDesign-1__c">
                      <input type="checkbox" class="c-sWitch__c--cDesign-1__c__input" name="store_availables[]" value="{{ $section->id }}" id="{{ $section->name }}"/>
                      <label class="c-sWitch__c--cDesign-1__c__label"></label>
                    </div>
                    <label for="{{ $section->name }}" style="cursor:pointer;">{{ $section->name }}</label>
                  </section>
                </div>
                @endforeach
              </div>
            </div>
            <div class="form-group">
              <label for="sku">{{ __('SKU') }} *</label>
              <input type="text" name="sku" class="form-control" id="sku" placeholder="{{ __('Enter SKU') }}" value="{{Str::random(10)}}" >
            </div>
            <div class="form-group">
              <label for="video">{{ __('Video Link') }} </label>
              <input type="text" name="video" class="form-control" id="video" placeholder="{{ __('Enter Video Link') }}" value="{{ old('video') }}">
            </div>
            <!-- NUEVO CONTENIDO (INICIO) -->
            <div class="form-group">
              <label for="sku">{{ __('Código SAP') }} *</label>
              <input type="text" name="sap_code" class="form-control" id="sap_code" placeholder="{{ __('Enter SAP code') }}" value="{{Str::random(10)}}" >
            </div>
            <div>
              <div class="form-group pb-0  mb-0">
                <label class="d-block">{{ __('Adjuntar PDF') }} *</label>
              </div>
              <div class="form-group position-relative">
                <label class="file">
                  <input type="file" accept="application/pdf" class="upload-photo" name="adj_doc" id="adj_doc" aria-label="File browser example">
                  <span class="file-custom text-left">{{ __('Adjuntar PDF...') }}</span>
                </label>
              </div>
            </div>
            <!-- NUEVO CONTENIDO (FIN) -->
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="{{ asset('assets/front/js/plugins/jquery-3.7.0.min.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/item.js')}}"></script>
@endsection