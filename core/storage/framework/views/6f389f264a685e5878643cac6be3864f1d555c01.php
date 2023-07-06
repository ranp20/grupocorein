<?php
  $grandSubtotal = 0;
  $qty = 0;
  $option_price = 0;
?>
<?php if(Session::has('cart')): ?>
<?php $__currentLoopData = Session::get('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
  $attribute_price = (isset($cart['attribute_price']) && !empty($cart['attribute_price'])) ? $cart['attribute_price'] : 0;
  $grandSubtotal = ($cart['main_price'] + $grandSubtotal + $attribute_price) * $cart['qty'];
?>
<div class="entry">
  <div class="entry-thumb">
    <a href="<?php echo e(route('front.product',$cart['slug'])); ?>">
      <img src="<?php echo e(asset('assets/images/'.$cart['photo'])); ?>" alt="Product">
    </a>
  </div>
  <div class="entry-content">
    <h4 class="entry-title"><a href="<?php echo e(route('front.product',$cart['slug'])); ?>">
      <?php echo e(strlen(strip_tags($cart['name'])) > 15 ? substr(strip_tags($cart['name']), 0, 15) . '...' : strip_tags($cart['name'])); ?>

    </a></h4>
    <span class="entry-meta"><?php echo e($cart['qty']); ?> x <?php echo e(PriceHelper::setCurrencyPrice($cart['price'])); ?></span>
    <?php if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name'])): ?>
    <?php $__currentLoopData = $cart['attribute']['option_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionkey => $option_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="att"><em><?php echo e($cart['attribute']['names'][$optionkey]); ?>:</em> <?php echo e($option_name); ?> (<?php echo e(PriceHelper::setCurrencyPrice($cart['attribute']['option_price'][$optionkey])); ?>)</span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
 </div>
  <div class="entry-delete">
    <a href="<?php echo e(route('front.cart.destroy',$key)); ?>"><i class="icon-x"></i></a>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="text-right">
<p class="text-gray-dark py-2 mb-0"><span class="text-muted"><?php echo e(__('Subtotal')); ?>:</span> <?php echo e(PriceHelper::setCurrencyPrice($grandSubtotal)); ?></p>
</div>
<div class="d-flex justify-content-between">
<div class="w-50 d-block"><a class="btn btn-primary btn-sm  mb-0" href="<?php echo e(route('front.cart')); ?>"><span><?php echo e(__('Cart')); ?></span></a></div>
<?php if(!empty(auth()->user()) || auth()->user() != ""): ?>
  <?php if(auth()->user()->reg_ruc != "off" && auth()->user()->reg_ruc != "" && auth()->user()->reg_razonsocial != "" && auth()->user()->reg_addressfiscal != ""): ?>
    <div class="w-50 d-block text-end">
      <a class="btn btn-primary btn-sm  mb-0" href="<?php echo e(route('front.checkout.payment')); ?>"><span><?php echo e(__('Checkout')); ?></span></a>
    </div>
  <?php else: ?>
    <div class="w-50 d-block text-end">
      <a class="btn btn-primary btn-sm  mb-0" href="<?php echo e(route('front.checkout.billing')); ?>"><span><?php echo e(__('Checkout')); ?></span></a>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php else: ?>
<?php echo e(__('Cart empty')); ?>

<?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/header_cart.blade.php ENDPATH**/ ?>