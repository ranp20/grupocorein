@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 bc-title"><b>{{ __('Update Product') }}</b> </h3>
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
  <form class="admin-form" action="{{ route('back.item.update',$item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="unidadraiz">{{ __('Select Root Unit') }} *</label>
              <select name="unidadraiz" id="unidadraiz" class="form-control">
                <option value="" selected>{{__('Select One')}}</option>
                @foreach(DB::table('tbl_unidadraiz')->get() as $uraiz)
                <option value="{{ $uraiz->id }}" {{ $uraiz->id == $item->unidad_raiz ? 'selected' : '' }}>{{ $uraiz->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="atributoraiz">{{ __('Select Root Attribute') }} </label>
              <select name="atributoraiz" id="atributoraiz" class="form-control">
                <option value="" selected>{{__('Select One')}}</option>
                @foreach(DB::table('tbl_atributoraiz')->get() as $attraiz)
                <option value="{{ $attraiz->id }}" {{ $attraiz->id == $item->atributo_raiz ? 'selected' : '' }}>{{ $attraiz->name }}</option>
                @endforeach
              </select>
            </div>
            <?php
              $attrRoot_name = DB::table('tbl_atributoraiz')->where('id',$item->atributo_raiz)->get()->toArray();
            ?>
            @if($item->atributo_raiz != 0 || count($attrRoot_name) != 0)
              @if($attrRoot_name[0]->name == "COLOR" || $attrRoot_name[0]->name == "color" || $attrRoot_name[0]->name == "COLORES" || $attrRoot_name[0]->name == "colores")
                @if($item->atributoraiz_collection != "" && $item->atributoraiz_collection != "[]")
                <div id="cTentr-af172698__p-adm">
                  <div id="attrcolors-section">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <span><strong>Lista de colores</strong></span>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <input type="text" class="form-control aia848d__clrcode" placeholder="Código de Producto" value="">
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <label class="color-picker">
                            <span>
                              <input type="color" class="form-control aia848d__clrname" placeholder="Código de Color" value="">
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="flex-btn">
                        <button type="button" class="btn btn-success add-color" data-text="" data-text1=""> <i class="fa fa-plus"></i> </button>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex c-sctGroupList">
                    <div class="flex-grow-1">
                      <div class="scGroupElems-sectionList">
                        <div class="c-zTitleSectionFloating">
                          <span class="c-zTitleSectionFloating__txt">Lista de <strong>Colores Agregados</strong></span>
                        </div>
                        <div class="scGroupElems-sectionList__c" id="attrcolors-sectionList__c">
                          <?php
                            $arrColorAdd = [];
                            $ColorAll = [];
                            $ColorAll2 = [];
                            if(isset($item->atributoraiz_collection) && $item->atributoraiz_collection != ""){
                              $colorsAvailables = json_decode($item->atributoraiz_collection, TRUE);
                              if(count($colorsAvailables) > 0){
                                $colorsAvailables_list = $colorsAvailables['atributoraiz_collection']['color'];
                              
                                foreach($colorsAvailables_list as $key => $val){
                                  $arrColorAdd[$key]['code'] = $val['code'];
                                  $arrColorAdd[$key]['name'] = $val['name'];
                                }
                              }
                            }
                          ?>
                          @foreach($arrColorAdd as $k => $v)
                            @if($v['code'] != null && $v['code'] != "")
                            <div class="d-flex attrcolor-item">
                              <div class="flex-grow-1">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="color_code[]" placeholder="Código de Producto" value="{{ $v['code'] }}">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <div class="form-group">
                                  <label class="color-picker">
                                    <span>
                                      <input type="color" class="form-control" name="color_name[]" placeholder="Código de Color" value="{{ $v['name'] }}">
                                    </span>
                                  </label>
                                </div>
                              </div>
                              <div class="flex-btn">
                                <button type="button" class="btn btn-danger remove-color">
                                  <i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div id="cTentr-af172698__p-adm">
                  <div id="attrcolors-section">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <span><strong>Lista de colores</strong></span>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <input type="text" class="form-control aia848d__clrcode" placeholder="Código de Producto" value="">
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <label class="color-picker">
                            <span>
                              <input type="color" class="form-control aia848d__clrname" placeholder="Código de Color" value="">
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="flex-btn">
                        <button type="button" class="btn btn-success add-color" data-text="" data-text1=""> <i class="fa fa-plus"></i> </button>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex c-sctGroupList">
                    <div class="flex-grow-1">
                      <div class="scGroupElems-sectionList">
                        <div class="c-zTitleSectionFloating">
                          <span class="c-zTitleSectionFloating__txt">Lista de <strong>Colores Agregados</strong></span>
                        </div>
                        <div class="scGroupElems-sectionList__c" id="attrcolors-sectionList__c">
                          <div class="scGroupElems-sectionList__c__deftxt" id="defTxt57vnj-attrclr__anyval">
                            <p>Sin Colores</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              @else
                <div id="cTentr-af172698__p-adm"></div>
              @endif
            @else
              <div id="cTentr-af172698__p-adm"></div>
            @endif
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="name">{{ __('Name') }} *</label>
              <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $item->name }}">
              <span id="spn__iptequalsmssg"></span>
            </div>
            <div class="form-group">
              <label for="slug">{{ __('Slug') }} *</label>
              <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ $item->slug }}">
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group pb-0  mb-0">
              <label class="d-block">{{ __('Featured Image') }} *</label>
            </div>
            <div class="form-group pb-0 pt-0 mt-0 mb-0">
              <img class="admin-img lg" src="{{ $item->photo ? asset('assets/images/items/'.$item->photo) : asset('assets/images/placeholder.png') }}">
            </div>
            <div class="form-group position-relative ">
              <label class="file">
                <input type="file"  accept="image/*"   class="upload-photo" name="photo" id="file"  aria-label="File browser example">
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
              <div id="gallery-images">
                <div class="d-block gallery_image_view">
                @forelse($item->galleries as $gallery)
                  <div class="single-g-item d-inline-block m-2">
                    <span data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.item.gallery.delete',$gallery->id) }}" class="remove-gallery-img">
                      <i class="fas fa-trash"></i>
                    </span>
                    <a class="popup-link" href="{{ $gallery->photo ? asset('assets/images/items/'.$gallery->photo) : asset('assets/images/placeholder.png') }}">
                      <img class="admin-gallery-img" src="{{ $gallery->photo ? asset('assets/images/items/'.$gallery->photo) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
                    </a>
                  </div>
                  @empty
                  <h6><b>{{ __('No Images Added') }}</b></h6>
                @endforelse
                </div>
              </div>
            </div>
            <div class="form-group position-relative ">
              <label class="file">
                <input type="file"  accept="image/*"   name="galleries[]" id="gallery_file" aria-label="File browser example" accept="image/*" multiple>
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
              <textarea name="sort_details" id="sort_details" class="form-control" placeholder="{{ __('Short Description') }}" required>{{$item->sort_details}}</textarea>
            </div>
            <div class="form-group">
              <label for="details">{{ __('Description') }} *</label>
              <textarea name="details" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}">{{$item->details}}</textarea>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="tags">{{ __('Product Tags') }}</label>
              <input type="text" name="tags" class="tags" id="tags" placeholder="{{ __('Tags') }}" value="{{$item->tags}}">
            </div>
            <div class="form-group">
              <label class="switch-primary">
                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_specification" value="1" {{$item->is_specification ==1 ? 'checked' : ''}}>
                <span class="switch-body"></span>
                <span class="switch-text">{{ __('Specifications') }}</span>
              </label>
            </div>
            <div id="cTentr-af1728903__p-adm" class="{{ $item->is_specification == 0 ? 'd-none' : '' }}">
              @if($item->is_specification != 0)
                @if($item->specification_collection != "" && $item->specification_collection != "[]")
                  <div id="specifications-section">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <input type="text" class="form-control aia843d__spcfname" placeholder="{{ __('Specification Name') }}" value="">
                          <span id="ccffs89_51-2ifc099"></span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <input type="text" class="form-control aia843d__spcfdsc" placeholder="{{ __('Specification description') }}" value="">
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
                          
                          <?php
                            $arrSpecificationAdd = [];
                            $ColorAll = [];
                            $ColorAll2 = [];
                            if(isset($item->specification_collection) && $item->specification_collection != ""){
                              $specificationsAvailables = json_decode($item->specification_collection, TRUE);
                              if(count($specificationsAvailables) > 0){
                                $specificationsAvailables_list = $specificationsAvailables['specification_collection']['product'];
                              
                                foreach($specificationsAvailables_list as $key => $val){
                                  $arrSpecificationAdd[$key]['name'] = $val['name'];
                                  $arrSpecificationAdd[$key]['description'] = $val['description'];
                                }
                              }
                            }
                          ?>
                          @foreach($arrSpecificationAdd as $k => $v)
                            @if($v['name'] != null && $v['name'] != "")
                            <div class="d-flex specification-item">
                              <div class="flex-grow-1">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="specification_name[]" placeholder="{{ $v['name'] }}" value="{{ $v['name'] }}">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="specification_description[]" placeholder="{{ $v['description'] }}" value="{{ $v['description'] }}">
                                </div>
                              </div>
                              <div class="flex-btn">
                                <button type="button" class="btn btn-danger remove-spcification">
                                  <i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            @endif
                          @endforeach

                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div id="specifications-section">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <input type="text" class="form-control aia843d__spcfname" placeholder="{{ __('Specification Name') }}" value="">
                          <span id="ccffs89_51-2ifc099"></span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <div class="form-group">
                          <input type="text" class="form-control aia843d__spcfdsc" placeholder="{{ __('Specification description') }}" value="">
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
                @endif
              @else
                <div id="specifications-section">
                  <div class="d-flex">
                    <div class="flex-grow-1">
                      <div class="form-group">
                        <input type="text" class="form-control aia843d__spcfname" placeholder="{{ __('Specification Name') }}" value="">
                        <span id="ccffs89_51-2ifc099"></span>
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <div class="form-group">
                        <input type="text" class="form-control aia843d__spcfdsc" placeholder="{{ __('Specification description') }}" value="">
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
              @endif
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="meta_keywords">{{ __('Meta Keywords') }}</label>
              <input type="text" name="meta_keywords" class="tags" id="meta_keywords" placeholder="{{ __('Enter Meta Keywords') }}" value="{{ $item->meta_keywords }}">
            </div>
            <div class="form-group">
              <label for="meta_description">{{ __('Meta Description') }}</label>
              <textarea name="meta_description" id="meta_description" class="form-control" rows="5" placeholder="{{ __('Enter Meta Description') }}">{{ $item->meta_description }}</textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <input type="hidden" class="check_button" name="is_button" value="0">
            <button type="submit" class="btn btn-secondary mr-2">{{ __('Update') }}</button>
            {{--
            <!--
            <a class="btn btn-success" href="{{ route('back.attribute.index',$item->id) }}">{{ __('Manage Attributes') }}</a>
            -->
            --}}
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="coupon_id">{{ __('Select Coupon') }} </label>
              <select name="coupon_id" id="coupon_id" class="form-control">
                <option value="" selected>{{__('Select Coupon')}}</option>
                @foreach(DB::table('tbl_coupons')->whereStatus(1)->get() as $coupon)
                <option value="{{ $coupon->id }}" {{$coupon->id == $item->coupon_id ? 'selected' : ''}} >{{ $coupon->name }}</option>
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
                  <span class="input-group-text">{{ $curr->sign }}</span>
                </div>
                <input type="text" id="discount_price" name="discount_price" class="form-control" placeholder="{{ __('Enter Current Price') }}" min="1" step="0.1" value="{{ round($item->discount_price * $curr->value,2) }}" required>
              </div>
            </div>
            <div class="form-group">
              <label for="previous_price">{{ __('Previous Price') }}</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">{{ $curr->sign }}</span>
                </div>
                <input type="text" id="previous_price" name="previous_price" class="form-control" placeholder="{{ __('Enter Previous Price') }}" min="1" step="0.1" value="{{ round($item->previous_price*$curr->value ,2)}}">
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="category_id">{{ __('Select Category') }} *</label>
              <select name="category_id" id="category_id" data-href="{{route('back.get.subcategory')}}" class="form-control">
                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $item->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subcategory_id">{{ __('Select Sub Category') }} </label>
              <select name="subcategory_id" id="subcategory_id" class="form-control" data-href="{{route('back.get.childcategory')}}">
                <option value="">{{__('Select one')}}</option>
                @foreach(DB::table('subcategories')->where('category_id',$item->category_id)->whereStatus(1)->get() as $subcat)
                <option value="{{ $subcat->id }}" {{ $subcat->id == $item->subcategory_id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="childcategory_id">{{ __('Select Child Category') }} </label>
              <select name="childcategory_id" id="childcategory_id" class="form-control">
                <option value="">{{__('Select one')}}</option>
                @foreach(DB::table('chield_categories')->where('category_id',$item->category_id)->whereStatus(1)->get() as $chieldcategory)
                <option value="{{ $chieldcategory->id }}" {{ $chieldcategory->id == $item->childcategory_id ? 'selected' : '' }}>{{ $chieldcategory->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="brand_id">{{ __('Select Brand') }} </label>
              <select name="brand_id" id="brand_id" class="form-control">
                <option value="" selected>{{__('Select Brand')}}</option>
                @foreach(DB::table('brands')->whereStatus(1)->get() as $brand)
                <option value="{{ $brand->id }}" {{$brand->id == $item->brand_id ? 'selected' : ''}} >{{ $brand->name }}</option>
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
                <input type="number" id="stock" name="stock" class="form-control" placeholder="{{ __('Total in stock') }}" value="{{$item->stock}}">
              </div>
            </div>
            <div class="form-group">
              <label for="tax_id">{{ __('Select Tax') }} *</label>
              <select name="tax_id" id="tax_id" class="form-control">
                <option value="">{{__('Select One')}}</option>
                @foreach(DB::table('taxes')->whereStatus(1)->get() as $tax)
                <option value="{{ $tax->id }}" {{$item->tax_id == $tax->id ? 'selected' : ''}} >{{ $tax->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="">{{ __('Seleccionar sección') }} *</label>
              <div class="border-list-switchs">
                <div class="form-check pb-0">
                  @if($item->sections_id != 0)
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
                        <input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="sections_id" value="{{ $section->id }}" {{$item->sections_id == $section->id ? 'checked' : ''}} id="{{ $onSection }}"/>
                          <label class="c-sRadioBtn__c--cDesign-1__c__label"></label>
                        </div>
                        <label for="{{ $onSection }}" style="cursor:pointer;">{{ $onSection }}</label>
                      </section>
                    @endforeach
                  @else
                    <section class="c-sRadioBtn__c--cDesign-1">
                      <div class="c-sRadioBtn__c--cDesign-1__c">
                      <input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="sections_id" checked value="0" id="0"/>
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
                        <input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="sections_id" value="{{ $section->id }}" {{$item->sections_id == $section->id ? 'checked' : ''}} id="{{ $onSection }}"/>
                          <label class="c-sRadioBtn__c--cDesign-1__c__label"></label>
                        </div>
                        <label for="{{ $onSection }}" style="cursor:pointer;">{{ $onSection }}</label>
                      </section>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            @php
              $TaxesAll = DB::table('taxes')->get();
              $sumFinalPriceIGV1 = 0;
              $sumFinalPriceIGV2 = 0;
              $incIGV = $TaxesAll[0]->value;
              $sinIGV = $TaxesAll[1]->value;
              $incIGV_format = $incIGV / 100;
              $sinIGV_format = $sinIGV;
            @endphp
            @if($item->sections_id != 0 || $item->sections_id != "")
              <div id="cTentr-af1698__p-adm">
                @if($item->sections_id == 1)
                <div class="form-group">
                  <label for="on-sale-price">En Promoción *</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">S/.</span>
                    </div>
                    <input type="text" data-valformat="withcomedecimal" data-archorigv="product" id="on-sale-price" name="on_sale_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="{{$item->on_sale_price}}" required>
                  </div>
                </div>
                <div class="c_cPreviewAmmountIGV">
                  @if($item->tax_id != 0 && $item->tax_id == 1)
                  @php
                    $sumFinalPriceIGV1 = $incIGV_format * $item->on_sale_price;
                    $sumFinalPriceIGV2 = $item->on_sale_price + $sumFinalPriceIGV1;
                  @endphp
                  <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
                    <span style="display:block;"><strong>INCLUYE IGV: </strong></span>
                    <span>Monto Final: </span>
                    <span id="c-prevammt__igvGs23s">S/. {{ $sumFinalPriceIGV2 }}</span>
                  </div>
                  @endif
                </div>
                @elseif($item->sections_id == 2)
                <div class="form-group">
                  <label for="special-offer-price">Oferta Especial *</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">S/.</span>
                    </div>
                    <input type="text" data-valformat="withcomedecimal" data-archorigv="product" id="special-offer-price" name="special_offer_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="{{$item->special_offer_price}}" required>
                  </div>
                </div>
                <div class="c_cPreviewAmmountIGV">
                  @if($item->tax_id != 0 && $item->tax_id == 1)
                  @php
                    $sumFinalPriceIGV1 = $incIGV_format * $item->special_offer_price;
                    $sumFinalPriceIGV2 = $item->special_offer_price + $sumFinalPriceIGV1;
                  @endphp
                  <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
                    <span style="display:block;"><strong>INCLUYE IGV: </strong></span>
                    <span>Monto Final: </span>
                    <span id="c-prevammt__igvGs23s">S/. {{ $sumFinalPriceIGV2 }}</span>
                  </div>
                  @endif
                </div>
                @else
                <div></div>
                @endif
              </div>
            @else
              <div id="cTentr-af1698__p-adm"></div>
            @endif
            <?php
            $arrStoresAdd = [];
            $StoresAll = [];
            $StoresAll2 = [];
            if(isset($item->store_availables) && $item->store_availables != ""){
              $storesAvailables = json_decode($item->store_availables, TRUE);
              $storesAvailables_list = $storesAvailables['store'];
              foreach($storesAvailables_list as $key => $val){
                $arrStoresAdd[$key]['id'] = $val['id'];
              }
            }

            if(count($arrStoresAdd) > 0){
              foreach($arrStoresAdd as $k => $v){
                $StoresAll[$k]['store'] = DB::table('tbl_stores')->where('id',$v['id'])->get()->toArray()[0];
              }
            }

            if($selectedIds != ""){
              foreach($selectedIds as $k => $v){
                $StoresAll2[$k] = $v['id'];
              }
            }
            ?>
            
            <div class="form-group">
              <label for="">{{ __('Seleccionar Tiendas') }} *</label>
              <div class="border-list-switchs">
                @foreach(DB::table('tbl_stores')->get() as $k => $v)                
                <div class="form-check pb-0">
                  <section class="c-sWitch__c--cDesign-1">
                    <div class="c-sWitch__c--cDesign-1__c">
                      <input type="checkbox" class="c-sWitch__c--cDesign-1__c__input" name="store_availables[]" id="{{ $v->name }}" value="{{ (isset($arrStoresAdd[$k]['id']) && $v->id == $arrStoresAdd[$k]['id']) ? $arrStoresAdd[$k]['id'] : $v->id }}" @if($selectedIds != '') @foreach($selectedIds as $v2) {{($v->id == $v2['id'])? 'checked':''}} @endforeach @endif />
                      <label class="c-sWitch__c--cDesign-1__c__label"></label>
                    </div>
                    <label for="{{ $v->name }}" style="cursor:pointer;">{{ $v->name }}</label>
                  </section>
                </div>                
                @endforeach                
              </div>
            </div>
            
            <div class="form-group">
              <label for="sku">{{ __('SKU') }} *</label>
              <input type="text" name="sku" class="form-control" id="sku" placeholder="{{ __('Enter SKU') }}" value="{{$item->sku}}">
            </div>
            <div class="form-group">
              <label for="video">{{ __('Vido Link') }} </label>
              <input type="text" name="video" class="form-control" id="video" placeholder="{{ __('Enter Video Link') }}" value="{{$item->video}}">
            </div>                    
            <!-- NUEVO CONTENIDO (INICIO) -->
            <div class="form-group">
              <label for="sku">{{ __('Código SAP') }} *</label>
              <input type="text" name="sap_code" class="form-control" id="sap_code" placeholder="{{ __('Enter SAP code') }}" value="{{$item->sap_code}}">
            </div>                    
            <div>
              <div class="form-group pb-0  mb-0">
                <label class="d-block">{{ __('Adjuntar PDF') }} *</label>
              </div>
              <div class="form-group position-relative ">
                <label class="file">
                  <input type="file" accept="application/pdf" class="upload-photo" name="adj_doc" id="adj_doc" aria-label="File browser example" value="{{ $item->adj_doc }}">
                  @if($item->adj_doc)
                  <span class="file-custom text-left">{{ $item->adj_doc }}</span>
                  @else
                  <span class="file-custom text-left">{{ __('Adjuntar PDF...') }}</span>
                  @endif
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
{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('You are going to delete this image from gallery.') }} {{ __('Do you want to delete it?') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
        <form action="" class="d-inline btn-ok" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- DELETE MODAL ENDS --}}
<script type="text/javascript" src="{{ asset('assets/front/js/plugins/jquery-3.7.0.min.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/item.js')}}"></script>
@endsection