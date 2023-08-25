<?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="col-gd">
  <div class="product-card">
    <div class="product-thumb" >
      <?php if(!$item->is_stock()): ?>
        <div class="product-badge bg-secondary border-default text-body"><?php echo e(__('out of stock')); ?></div>
      <?php endif; ?>
      <?php if($item->previous_price && $item->previous_price !=0): ?>
        <div class="product-badge product-badge2 bg-info"> -<?php echo e(PriceHelper::DiscountPercentage($item)); ?></div>
      <?php endif; ?>
      <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$item->thumbnail)); ?>" alt="Product">
      <div class="product-button-group"><a class="product-button wishlist_store" href="<?php echo e(route('user.wishlist.store',$item->id)); ?>" title="<?php echo e(__('Wishlist')); ?>"><i class="icon-heart"></i></a>
        <a data-target="<?php echo e(route('fornt.compare.product',$item->id)); ?>" class="product-button product_compare" href="javascript:;" class="<?php echo e(__('Compare')); ?>"><i class="icon-repeat"></i></a>
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="card">
  <div class="card-body text-center"><?php echo e(__('No Product Found')); ?></div>
</div>
<?php endif; ?>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/extraindex.js')); ?>"></script><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/normal_product.blade.php ENDPATH**/ ?>