<?php $__env->startSection('title'); ?>
 <?php echo e($item->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="<?php echo e($item->meta_keywords); ?>">
<meta name="description" content="<?php echo e($item->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/front/js/plugins/jquery-3.7.0.min.js')); ?>"></script>
  <link rel="stylesheet" href="<?php echo e(asset('node_modules/owl-carousel/owl-carousel/owl.carousel.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('node_modules/owl-carousel/owl-carousel/owl.theme.css')); ?>">
  <script type="text/javascript" src="<?php echo e(asset('node_modules/owl-carousel/owl-carousel/owl.carousel.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('assets/front/js/extraindex.js')); ?>"></script>

<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator"></li>
          <li><a href="<?php echo e(route('front.catalog')); ?>"><?php echo e(__('Shop')); ?></a></li>
          <li class="separator"></li>
          <li><?php echo e($item->name); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-1x mb-1">
  <div class="row">
    <div class="col-xxl-5 col-lg-6 col-md-6">
      <div class="product-gallery">
        <?php if($item->video): ?>
        <div class="gallery-wrapper">
          <div class="gallery-item video-btn text-center">
            <a href="<?php echo e($item->video); ?>" title="Watch video"></a>
          </div>
        </div>
        <?php endif; ?>
        <?php if($item->is_stock()): ?>
        <span class="product-badge
        <?php if($item->is_type == 'feature'): ?>
        bg-warning
        <?php elseif($item->is_type == 'new'): ?>
        bg-success
        <?php elseif($item->is_type == 'top'): ?>
        bg-info
        <?php elseif($item->is_type == 'best'): ?>
        bg-dark
        <?php elseif($item->is_type == 'flash_deal'): ?>
          bg-success
        <?php endif; ?>
        "><?php echo e($item->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$item->is_type)) : ''); ?></span>
        <?php else: ?>
        <span class="product-badge bg-secondary border-default text-body
        "><?php echo e(__('out of stock')); ?></span>
        <?php endif; ?>
        <?php if($item->previous_price && $item->previous_price !=0): ?>
        <div class="product-badge bg-goldenrod  ppp-t"> -<?php echo e(PriceHelper::DiscountPercentage($item)); ?></div>
        <?php endif; ?>
        <div class="product-thumbnails insize">
          <div class="product-details-slider owl-carousel" >
            <div class="item"><img src="<?php echo e(asset('assets/images/'.$item->photo)); ?>" alt="zoom"  /></div>
            <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item"><img src="<?php echo e(asset('assets/images/'.$gallery->photo)); ?>" alt="zoom"  /></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
    <?php
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
    ?>
    <div class="col-xxl-7 col-lg-6 col-md-6">
      <div class="details-page-top-right-content d-flex align-items-center">
        <div class="div w-100">
          <input type="hidden" id="item_id" value="<?php echo e($item->id); ?>">
          <input type="hidden" id="demo_price" value="<?php echo e(PriceHelper::setConvertPrice($item->discount_price)); ?>">
          <input type="hidden" value="<?php echo e(PriceHelper::setCurrencySign()); ?>" id="set_currency">
          <input type="hidden" value="<?php echo e(PriceHelper::setCurrencyValue()); ?>" id="set_currency_val">
          <input type="hidden" value="<?php echo e($setting->currency_direction); ?>" id="currency_direction">
          <h4 class="mb-2 p-title-main"><?php echo e($item->name); ?></h4>
          <div class="mb-3">
            <?php if($item->is_stock()): ?>
              <span class="text-success  d-inline-block"><?php echo e(__('In Stock')); ?></span>
            <?php else: ?>
              <span class="text-danger  d-inline-block"><?php echo e(__('Out of stock')); ?></span>
            <?php endif; ?>
          </div>
          <?php if($item->is_type == 'flash_deal'): ?>
          <?php if(date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y')): ?>
          <div class="countdown countdown-alt mb-3" data-date-time="<?php echo e($item->date); ?>">
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <span class="h3 d-block price-area">
          <?php if($item->previous_price != 0): ?>
            <small class="d-inline-block"><del><?php echo e(PriceHelper::setPreviousPrice($item->previous_price)); ?></del></small>
          <?php endif; ?>
          <?php
            $TaxesAll = DB::table('taxes')->get();
            $sumFinalPrice1 = 0;
            $sumFinalPrice2 = 0;
            $incIGV = $TaxesAll[0]->value;
            $sinIGV = $TaxesAll[1]->value;
            $incIGV_format = $incIGV / 100;
            $sinIGV_format = $sinIGV;
          ?>
            <?php if(isset($item->sections_id) && $item->sections_id != 0): ?>
              <?php if($item->sections_id == 1): ?>
                <?php if($item->on_sale_price != 0 && $item->on_sale_price != ""): ?>
                  <?php if(isset($item->tax_id) && $item->tax_id == 1): ?>
                    <?php
                      $sumFinalPrice1 = $item->on_sale_price * $incIGV_format;
                      $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                    ?>
                    <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php else: ?>
                    <?php
                      $sumFinalPrice1 = $item->on_sale_price;
                      $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                    ?>
                    <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php endif; ?>
                <?php else: ?>
                <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($item->discount_price)); ?></span>
                <?php endif; ?>
              <?php else: ?>
                <?php if($item->special_offer_price != 0 && $item->special_offer_price != ""): ?>
                  <?php if(isset($item->tax_id) && $item->tax_id == 1): ?>
                    <?php
                      $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
                      $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                    ?>
                    <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php else: ?>
                    <?php
                      $sumFinalPrice1 = $item->special_offer_price;
                      $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                    ?>
                    <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php endif; ?>
                <?php else: ?>
                  <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($item->discount_price)); ?></span>
                <?php endif; ?>
              <?php endif; ?>
            <?php else: ?>
              <span id="main_price" class="main-price"><?php echo e(PriceHelper::setCurrencyPrice($item->discount_price)); ?></span>
            <?php endif; ?>
            <?php if(isset($item->tax_id) && $item->tax_id == 1): ?>
            <span style="font-size: 13px;margin-left: 5px;">Inc. IGV</span>
            <?php else: ?>
            <span style="font-size: 13px;margin-left: 5px;">Sin IGV</span>
            <?php endif; ?>
          </span>
          <p class="text-muted"><?php echo e($item->sort_details); ?> <a href="#details" class="txtd-underline scroll-to"><?php echo e(__('Read more')); ?></a></p>
          <div class="row margin-top-1x">
            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($attribute->options->count() != 0): ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="<?php echo e($attribute->name); ?>"><?php echo e($attribute->name); ?></label>
                  <select class="form-control attribute_option" id="<?php echo e($attribute->name); ?>">
                    <?php $__currentLoopData = $attribute->options->where('stock','!=','0'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($option->name); ?>" data-type="<?php echo e($attribute->id); ?>" data-href="<?php echo e($option->id); ?>" data-target="<?php echo e(PriceHelper::setConvertPrice($option->price)); ?>"><?php echo e($option->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div class="row align-items-end pb-4">
            <div class="col-sm-12 cCtActions__Prd">
              <?php if($item->item_type == 'normal'): ?>
              <div class="qtySelector product-quantity">
                <span class="decreaseQty subclick"><i class="fas fa-minus"></i></span>
                <input type="text" class="qtyValue cart-amount" value="1">
                <span class="increaseQty addclick"><i class="fas fa-plus"></i></span>
                <input type="hidden" value="3333" id="current_stock">
              </div>
              <?php endif; ?>
              <div class="p-action-button" style="display: flex;align-items:center;justify-content:flex-start;flex-flow:wrap;">
                <?php if($item->item_type != 'affiliate'): ?>
                  <?php if($item->is_stock()): ?>
                  <button class="btn btn-primary m-0 a-t-c-mr" id="add_to_cart"><i class="icon-bag"></i><span><?php echo e(__('Add to Cart')); ?></span></button>  
                  <?php else: ?>
                    <button class="btn btn-primary m-0"><i class="icon-bag"></i><span><?php echo e(__('Out of stock')); ?></span></button>
                  <?php endif; ?>
                <?php else: ?>
                <?php endif; ?>
                <div class="cWtspBtnCtc">
                  <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
                    <img src="../assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
                  </a>
                  <div class="cWtspBtnCtc__pSubM">
                  <?php if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers)): ?>
                  <?php
                    $titles = json_decode($setting->whatsapp_numbers,true)['title'];
                    $texts = json_decode($setting->whatsapp_numbers,true)['text'];
                    $numbers = json_decode($setting->whatsapp_numbers,true)['number'];
                  ?>
                    <ul class="cWtspBtnCtc__pSubM__m">
                      <?php $__currentLoopData = $numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="cWtspBtnCtc__pSubM__m__i">
                        <a title="<?php echo e($titles[$key]); ?>" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51<?php echo e($numbers[$key]); ?>&text=<?php echo e($texts[$key]); ?>" target="_blank">
                          <!-- <img src="<?php echo e(asset('assets/back/images/WhatsApp')); ?>/icono-tienda-1.png" alt="Icono-tienda" width="100" height="100" decoding="sync"> -->
                          <img src="<?php echo e(asset('assets/images/Utilities')); ?>/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                          <!-- <span>912 831 232</span> -->
                          <span><?php echo e($titles[$key]); ?></span>
                        </a>
                      </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php else: ?>
                    <p>No hay información</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="cPrd__cGrpModls">
            <ul class="cPrd__cGrpModls__m">
              <li class="cPrd__cGrpModls__m__i">
                <img src="<?php echo e(route('front.index')); ?>/assets/images/1669243396carro.png">
                <span class="fw-bold"> Disponible despacho a domicilio </span>
                <a href="javascript:void(0);" class="txtd-underline" data-bs-toggle="modal" data-bs-target="#calcDespacho">Calcular despacho</a>
              </li>
              <li class="cPrd__cGrpModls__m__i">
                <img src="<?php echo e(route('front.index')); ?>/assets/images/1669243349tienda.png">
                <span class="fw-bold"> Disponibilidad de retiro en tienda </span>
                <a href="javascript:void(0);" class="txtd-underline" data-bs-toggle="modal" data-bs-target="#viewLocationStore">Ver ubicación de la tienda</a>
              </li>
            </ul>
            <div class="modal fade" id="calcDespacho" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <?php
                    $paisAll = DB::table('countries')->get();
                    $departamentoAll = DB::table('tbl_departamentos')->get();
                    $provinciaAll = DB::table('tbl_provincias')->get();
                    $distritoAll = DB::table('tbl_distritos')->get();
                  ?>
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
                      <?php echo csrf_field(); ?>
                      <div class="pt-3">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_country" class="label">País</label>
                              <select name="consult_country_id" id="consult_country" title="País" class="form-control">
                                <option selected value="">Elige País</option>
                                <?php $__currentLoopData = $paisAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countryData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($countryData->id); ?>" selected><?php echo e($countryData->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_departamento" class="label">Departamento</label>
                              <select name="consult_departamento_id" id="consult_departamento" title="Departamento" class="form-control" data-href="<?php echo e(route('front.provincia')); ?>">
                                <option value="">Elige una opción</option>
                                <?php $__currentLoopData = $departamentoAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($departData->id); ?>" data-code="<?php echo e($departData->departamento_code); ?>"><?php echo e($departData->departamento_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_provincia" class="label">Provincia</label>
                              <select name="consult_provincia_id" id="consult_provincia" title="Provincia" class="form-control" data-href="<?php echo e(route('front.distrito')); ?>">
                                <option value="">Elige Departamento</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="consult_distrito" class="label">Distrito</label>
                              <select name="consult_distrito_id" id="consult_distrito" title="Distrito" class="form-control" data-href="<?php echo e(route('front.getammountdispath')); ?>">
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
                        <?php
                          $StoresAll = "";
                          $arrStoresAdd = [];
                          if(isset($item->store_availables) && $item->store_availables != ""){
                            $storesAvailables = json_decode($item->store_availables, TRUE);
                            $storesAvailables_list = $storesAvailables['store'];
                            foreach($storesAvailables_list as $key => $val){
                              $arrStoresAdd[$key]['id'] = $val['id'];
                            }
                          }
                          $StoresAll = [];
                          if(count($arrStoresAdd) > 0){
                            foreach($arrStoresAdd as $k => $v){
                              $StoresAll[$k]['store'] = DB::table('tbl_stores')->where('id',$v['id'])->get()->toArray()[0];
                            }
                          }
                        ?>                        
                        <?php if(!empty($StoresAll) && count($StoresAll) > 0): ?>
                        <ul class="cBodyMdBy__c__cList__m">
                          <?php $__currentLoopData = $StoresAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stores): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                          
                          <li href="javascript:void(0);" class="cBodyMdBy__c__cList__m__i">
                            <div style="display: block;width:100%;">
                              <div class="cBodyMdBy__c__cList__m__i__cTop">
                                <div class="cBodyMdBy__c__cList__m__i__cTop__cIcon">
                                  <img src="<?php echo e(route('front.index')); ?>/assets/images/1669243349tienda.png" target="_blank">
                                </div>
                                <div class="cBodyMdBy__c__cList__m__i__cTop__cNameStr"><?php echo e($stores['store']->name); ?></div>
                              </div>
                            </div>
                            <div class="cBodyMdBy__c__cList__m__i__cBott">
                              <ul class="cBodyMdBy__c__cList__m__i__cBott__m">
                                <li><span><strong>Dirección: </strong><?php echo e($stores['store']->address); ?></span></li>
                                <li><span><strong>Teléfono: </strong><?php echo e($stores['store']->telephone); ?></span></li>
                              </ul>
                            </div>
                          </li>                          
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <div class="text-center">
                          <h5>Sin tiendas disponibles.</h5>
                        </div>
                        <?php endif; ?>
                        
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="t-c-b-area">
              <?php if($item->brand_id): ?>
              <div class="pt-1 mb-1"><span class="text-medium"><?php echo e(__('Brand')); ?>:</span>
                <a href="<?php echo e(route('front.catalog').'?brand='.$item->brand->slug); ?>"><?php echo e($item->brand->name); ?></a>
              </div>
              <?php endif; ?>
              <div class="pt-1 mb-1"><span class="text-medium"><?php echo e(__('Categories')); ?>:</span>
                <a href="<?php echo e(route('front.catalog').'?category='.$item->category->slug); ?>"><?php echo e($item->category->name); ?></a>
                  <?php if($item->subcategory->name): ?>
                  /
                  <?php endif; ?>
                <a href="<?php echo e(route('front.catalog').'?subcategory='.$item->subcategory->slug); ?>"><?php echo e($item->subcategory->name); ?></a>
                  <?php if($item->childcategory->name): ?>
                  /
                  <?php endif; ?>
                <a href="<?php echo e(route('front.catalog').'?childcategory='.$item->childcategory->slug); ?>"><?php echo e($item->childcategory->name); ?></a>
              </div>
              <div class="pt-1 mb-1"><span class="text-medium">Etiquetas:</span>
                <?php if($item->tags): ?>
                <?php $__currentLoopData = explode(',',$item->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->last): ?>
                <a href="<?php echo e(route('front.catalog').'?tag='.$tag); ?>"><?php echo e($tag); ?></a>
                <?php else: ?>
                <a href="<?php echo e(route('front.catalog').'?tag='.$tag); ?>"><?php echo e($tag); ?></a>,
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </div>
              <?php if($item->item_type == 'normal'): ?>
              <div class="pt-1 mb-1"><span class="text-medium">STOCK:</span> <?php echo e($item->stock); ?></div>
              <?php endif; ?>
              <?php if($item->item_type == 'normal'): ?>
              <div class="pt-1 mb-1"><span class="text-medium">CÓDIGO SAP:</span> <?php echo e($item->sap_code); ?></div>
              <?php endif; ?>
              <?php if($item->item_type == 'normal'): ?>
              <div class="pt-1 mb-1"><span class="text-medium"><?php echo e(__('SKU')); ?>:</span><?php echo e($item->sku); ?></div>
              <?php endif; ?>
              <?php if($item->unidad_raiz): ?>
              <?php
                $unidad_raiz_byItem = DB::table('tbl_unidadraiz')->where('id',$item->unidad_raiz)->get()->toArray()[0];
              ?>
              <div class="pt-1 mb-1"><span class="text-medium"><?php echo e(__('Unidad de medida')); ?>:</span> <strong><?php echo e($unidad_raiz_byItem->name); ?></strong></div>
              <?php endif; ?>
              <?php if($item->atributo_raiz): ?>
              <?php
                $atributo_raiz_byItem = DB::table('tbl_atributoraiz')->where('id',$item->atributo_raiz)->get()->toArray()[0];
              ?>
              <div class="pt-1 mb-1"><span class="text-medium"><?php echo e(__('Root Attribute')); ?>:</span> <strong><?php echo e($atributo_raiz_byItem->name); ?></strong></div>
              <?php endif; ?>
              <!-- NUEVO CONTENIDO (INICIO) -->
              <?php if($item->adj_doc != "" && $item->adj_doc != null): ?>
              <div class="ficha">
                <a href="<?php echo e(asset('assets/files/item/adj_doc/'.$item->adj_doc)); ?>" target="_blank" title="Ficha Técnica del producto">
                  <img class="fic" src="<?php echo e(route('front.index')); ?>/assets/images/ficha-tecnica.png">
                </a>
              </div>
              <?php endif; ?>
              <!-- NUEVO CONTENIDO (FIN) -->
            </div>
            <div class="mt-4 p-d-f-area">
              <div class="left">
                <a class="btn btn-primary btn-sm wishlist_store wishlist_text" href="<?php echo e(route('user.wishlist.store',$item->id)); ?>"><span><i class="icon-heart"></i></span>
                <?php if(Auth::check() && App\Models\Wishlist::where('user_id',Auth::user()->id)->where('item_id',$item->id)->exists()): ?>
                <span><?php echo e(__('Added To Wishlist')); ?></span>
                <?php else: ?>
                <span class="wishlist1"><?php echo e(__('Wishlist')); ?></span>
                <span class="wishlist2 d-none"><?php echo e(__('Added To Wishlist')); ?></span>
                <?php endif; ?>
                </a>
                <button class="btn btn-primary btn-sm  product_compare" data-target="<?php echo e(route('fornt.compare.product',$item->id)); ?>" ><span><i class="icon-repeat"></i><?php echo e(__('Compare')); ?></span></button>
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
            <a class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"><?php echo e(__('Descriptions')); ?></a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false"><?php echo e(__('Specifications')); ?></a>
          </li>
        </ul>
        <div class="tab-content card">
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"">
          <?php echo $item->details; ?>

          </div>
          <div class="tab-pane fade show" id="specification" role="tabpanel" aria-labelledby="specification-tab">
            <div class="comparison-table">
              <table class="table table-bordered">
                <thead class="bg-secondary">
                </thead>
                <tbody>
                <tr class="bg-secondary">
                  <th class="text-uppercase"><?php echo e(__('Specifications')); ?></th>
                  <td><span class="text-medium"><?php echo e(__('Descriptions')); ?></span></td>
                </tr>
                <?php if($sec_name): ?>
                <?php $__currentLoopData = array_combine($sec_name,$sec_details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sname => $sdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($sname); ?></th>
                  <td><?php echo e($sdetail); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <tr class="text-center">
                  <td colspan="2"><?php echo e(__('No Specifications')); ?></td>
                </tr>
                <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if(count($related_items)>0): ?>
<div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
  <div class="row">
    <div class="col-lg-12">
      <div class="section-title">
        <h2 class="h3"><?php echo e(__('También te puede interesar')); ?></h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="relatedproductslider owl-carousel" >
        <?php $__currentLoopData = $related_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="slider-item" style="margin-right: 15px;">
            <div class="product-card">
              <?php if($related->is_stock()): ?>
                <?php if($related->is_type == 'new'): ?>
                <?php else: ?>
                  <div class="product-badge
                  <?php if($related->is_type == 'feature'): ?>
                  bg-warning

                  <?php elseif($related->is_type == 'top'): ?>
                  bg-info
                  <?php elseif($related->is_type == 'best'): ?>
                  bg-dark
                  <?php elseif($related->is_type == 'flash_deal'): ?>
                  bg-success
                  <?php endif; ?>
                  "><?php echo e($related->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$related->is_type)) : ''); ?></div>
                  <?php endif; ?>
                  <?php else: ?>
                  <div class="product-badge bg-secondary border-default text-body
                  "><?php echo e(__('out of stock')); ?></div>
              <?php endif; ?>
              <?php if($related->previous_price && $related->previous_price !=0): ?>
              <div class="product-badge product-badge2 bg-info"> -<?php echo e(PriceHelper::DiscountPercentage($related)); ?></div>
              <?php endif; ?>
              <?php if($related->previous_price && $related->previous_price !=0): ?>
              <div class="product-badge product-badge2 bg-info"> -<?php echo e(PriceHelper::DiscountPercentage($related)); ?></div>
              <?php endif; ?>
              <div class="product-thumb">
                <a href="<?php echo e(route('front.product',$related->slug)); ?>"><img class="lazy" data-src="<?php echo e(asset('assets/images/'.$related->thumbnail)); ?>" alt="Product"></a>
                <div class="product-button-group">
                  <a class="product-button wishlist_store" href="<?php echo e(route('user.wishlist.store',$related->id)); ?>" title="<?php echo e(__('Wishlist')); ?>"><i class="icon-heart"></i></a>
                  <a class="product-button product_compare" href="javascript:;" data-target="<?php echo e(route('fornt.compare.product',$related->id)); ?>" title="<?php echo e(__('Compare')); ?>"><i class="icon-repeat"></i></a>
                  <?php echo $__env->make('includes.item_footer',['sitem' => $related], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="product-card-body">
                <div class="product-category"><a href="<?php echo e(route('front.catalog').'?category='.$related->category->slug); ?>"><?php echo e($related->category->name); ?></a></div>
                <h3 class="product-title">
                  <a href="<?php echo e(route('front.product',$related->slug)); ?>">
                  <?php echo e(strlen(strip_tags($related->name)) > 35 ? substr(strip_tags($related->name), 0, 35) : strip_tags($related->name)); ?>

                  </a>
                </h3>
                <h4 class="product-price">
                <?php if($related->previous_price !=0): ?>
                <del><?php echo e(PriceHelper::setPreviousPrice($related->previous_price)); ?></del>
                <?php endif; ?>
                <?php echo e(PriceHelper::grandCurrencyPrice($related)); ?> </h4>
                <div class="cWtspBtnCtc">
                  <a title="Solicitar información" href="https://api.whatsapp.com/send?phone=51<?php echo e($setting->footer_phone); ?>&text=Solicito información sobre: <?php echo e(route('front.product',$related->slug)); ?>" target="_blank" class="cWtspBtnCtc__pLink">
                    <img src="../assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" width="100" height="100" decoding="sync">
                  </a>
                  <div class="cWtspBtnCtc__pSubM">
                    <ul class="cWtspBtnCtc__pSubM__m">
                      <li class="cWtspBtnCtc__pSubM__m__i">
                        <a class="cWtspBtnCtc__pSubM__m__link" href="" target="_blank">
                          <!-- <img src="<?php echo e(asset('assets/back/images/WhatsApp')); ?>/icono-tienda-1.png" alt="Icono-tienda" width="100" height="100" decoding="sync"> -->
                          <img src="<?php echo e(asset('assets/images/Utilities')); ?>/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                          <!-- <span>912 831 232</span> -->
                          <span>Tienda #1</span>
                        </a>
                      </li>
                      <li class="cWtspBtnCtc__pSubM__m__i">
                        <a class="cWtspBtnCtc__pSubM__m__link" href="" target="_blank">
                          <!-- <img src="<?php echo e(asset('assets/back/images/WhatsApp')); ?>/icono-tienda-1.png" alt="Icono-tienda" width="100" height="100" decoding="sync"> -->
                          <img src="<?php echo e(asset('assets/images/Utilities')); ?>/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/product-details.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/catalog/product.blade.php ENDPATH**/ ?>