<?php
$TaxesAll = DB::table('taxes')->get();
$sumFinalPrice1 = 0;
$sumFinalPrice2 = 0;
$incIGV = $TaxesAll[0]->value;
$sinIGV = $TaxesAll[1]->value;
$incIGV_format = $incIGV / 100;
$sinIGV_format = $sinIGV;
?>
<?php if($items->count() > 0): ?>
<div class="col-lg-12">
  <div class="popular-category-slider  owl-carousel" id="">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="slider-item">
      <div class="product-card">
        <div class="product-thumb">
          <?php if(!$item->is_stock()): ?>
          <div class="product-badge bg-secondary border-default text-body"><?php echo e(__('out of stock')); ?></div>
          <?php endif; ?>
          <?php if($item->previous_price && $item->previous_price !=0): ?>
          <div class="product-badge product-badge2 bg-info"> -<?php echo e(PriceHelper::DiscountPercentage($item)); ?></div>
          <?php endif; ?>
          <img class="lazy" src="<?php echo e(asset('assets/images/'.$item->thumbnail)); ?>" data-src="<?php echo e(asset('assets/images/'.$item->thumbnail)); ?>" alt="Product">
          <div class="product-button-group"><a class="product-button wishlist_store" href="<?php echo e(route('user.wishlist.store',$item->id)); ?>" title="<?php echo e(__('Wishlist')); ?>"><i class="icon-heart"></i></a>
            <a data-target="<?php echo e(route('fornt.compare.product',$item->id)); ?>" class="product-button product_compare" href="javascript:;" title="<?php echo e(__('Compare')); ?>"><i class="icon-repeat"></i></a>
            <?php echo $__env->make('includes.item_footer',['sitem' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <div class="product-card-body">
          <div class="product-category">
            <a href="<?php echo e(route('front.catalog').'?category='.$item->category->slug); ?>"><?php echo e($item->category->name); ?></a>
          </div>
          <h3 class="product-title">
            <a href="<?php echo e(route('front.product',$item->slug)); ?>"><?php echo e(strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name)); ?></a>
          </h3>
          <h4 class="product-price">
            <?php if($item->previous_price !=0): ?>
            <del><?php echo e(PriceHelper::setPreviousPrice($item->previous_price)); ?></del>
            <?php endif; ?>
            <?php if(isset($item->sections_id) && $item->sections_id != 0): ?>
              <?php if($item->sections_id == 1): ?>
                <?php if($item->on_sale_price != 0 && $item->on_sale_price != ""): ?>
                  <?php if(isset($item->tax_id) && $item->tax_id == 1): ?>
                    <?php
                    $sumFinalPrice1 = $item->on_sale_price * $incIGV_format;
                    $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                    ?>
                    <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php else: ?>
                    <?php
                    $sumFinalPrice1 = $item->on_sale_price;
                    $sumFinalPrice2 = $item->on_sale_price + $sumFinalPrice1;
                    ?>
                    <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php endif; ?>
                <?php else: ?>
                  <span><?php echo e(PriceHelper::setCurrencyPrice($item->discount_price)); ?></span>
                <?php endif; ?>
              <?php else: ?>
                <?php if($item->special_offer_price != 0 && $item->special_offer_price != ""): ?>
                  <?php if(isset($item->tax_id) && $item->tax_id == 1): ?>
                    <?php
                    $sumFinalPrice1 = $item->special_offer_price * $incIGV_format;
                    $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                    ?>
                    <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php else: ?>
                    <?php
                    $sumFinalPrice1 = $item->special_offer_price;
                    $sumFinalPrice2 = $item->special_offer_price + $sumFinalPrice1;
                    ?>
                    <span><?php echo e(PriceHelper::setCurrencyPrice($sumFinalPrice2)); ?></span>
                  <?php endif; ?>
                <?php else: ?>
                <span><?php echo e(PriceHelper::setCurrencyPrice($item->discount_price)); ?></span>
                <?php endif; ?>
              <?php endif; ?>
            <?php else: ?>
              <span><?php echo e(PriceHelper::setCurrencyPrice($item->discount_price)); ?></span>
            <?php endif; ?>
          </h4>
          <div class="cWtspBtnCtc">
            <a title="Solicitar información" href="javascript:void(0);" target="_blank" class="cWtspBtnCtc__pLink">
            <img src="<?php echo e(route('front.index')); ?>/assets/images/boton-pedir-por-whatsapp.png" class="boton-as cWtspBtnCtc__pLink__imgInit" alt="whatsapp_icon" width="100" height="100" decoding="sync">
            </a>
            <div class="cWtspBtnCtc__pSubM">
              <?php if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers)): ?>
              <?php
                $whatsappCollection = json_decode($setting->whatsapp_numbers, TRUE);
                $ArrwpsNumbers = "";
                $wps_inproducts = [];
                if(isset($whatsappCollection['whatsapp_numbers'])){
                  $ArrwpsNumbers = $whatsappCollection['whatsapp_numbers'];
                  if(isset($ArrwpsNumbers['in_product'])){
                    $wps_inproducts = $ArrwpsNumbers['in_product'];
                  }
                }
              ?>
              <ul class="cWtspBtnCtc__pSubM__m">
                <?php $__currentLoopData = $wps_inproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="cWtspBtnCtc__pSubM__m__i">
                  <a title="<?php echo e($v['title']); ?>" class="cWtspBtnCtc__pSubM__m__link" href="https://api.whatsapp.com/send?phone=51<?php echo e($v['number']); ?>&text=<?php echo e($v['text']); ?>" target="_blank">
                    <img src="<?php echo e(asset('assets/images/Utilities')); ?>/whatsapp-icon.png" alt="Icono-tienda" width="100" height="100" decoding="sync">
                    <span><?php echo e($v['title']); ?></span>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<?php else: ?>
<div class="card">
  <div class="card-body text-center "><?php echo e(__('No Product Found')); ?></div>
</div>
<?php endif; ?>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/extraindex.js')); ?>"></script><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/slider_product.blade.php ENDPATH**/ ?>