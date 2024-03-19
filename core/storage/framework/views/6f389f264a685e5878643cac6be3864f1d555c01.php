<?php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total = 0;
  $qty = 0;
  $option_price = 0;
  $cartTotal = 0;
?>
<?php
  // echo "<pre>";
  // print_r($cart);
  // echo "</pre>";
  // exit();
?>
<?php if(Session::has('cart')): ?>
  <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php
  $totalwithoutcoupon = 0;
  $totalwithcoupon = 0;
  $totalwithoutcoupon_prod = 0;
  $totalwithcoupon_prod = 0;
  $prod_qty = floatval($item['qty']);
  $prod_quantity_withoutcoupon = floatval($item['quantity_withoutcoupon']);
  $prodwithcouponassoc = $prod_qty - $prod_quantity_withoutcoupon;
  $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
  if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00){

    $namecouponbyid = DB::table('tbl_coupons')->where("id","=",$item['coupon_id'])->where("status","!=",0)->take(1)->get();
    if(count($namecouponbyid) != 0){
      $couponbyiddecode = json_decode($namecouponbyid, TRUE);
      $nameofcouponbyid = $couponbyiddecode[0]['name'];
      $expiresAtTimer = $couponbyiddecode[0]['time_end'];
      // ----------- Crear un objeto DateTime a partir de la fecha final...
      $currentDate = new DateTime();
      $expirationDate = DateTime::createFromFormat('Y-m-d H:i:s', $expiresAtTimer, new DateTimeZone('America/Lima'));
      // ----------- Asegurarse que la fecha es válida...
      if (!$expirationDate) {
        die('Invalid date format for countdown.');
      }
      // ----------- Obtener las fechas en milisegundos...
      $millisecondsCurrentDate = $currentDate->getTimestamp() * 1000;
      $millisecondsExpirationDate = $expirationDate->getTimestamp() * 1000;
      // ----------- Calcular el tiempo restante...
      $remainingTime = max(0, $millisecondsExpirationDate - $millisecondsCurrentDate);
      if($remainingTime <= 0){
        $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
      }else{
        $totalwithoutcoupon += ($item['price'] + $total + $attribute_price) * $prod_quantity_withoutcoupon;
        $totalwithcoupon += ($item['coupon_price'] + $total + $attribute_price) * $prodwithcouponassoc;
        $cartTotal += $totalwithoutcoupon + $totalwithcoupon; 
      }
    }else{
      $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
    }
  }else{
    $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
  }
  ?>
  <div class="entry">
    <div class="entry-thumb">
      <?php
        $pathProductCartPhoto = 'assets/images/'.$item['photo'];
        $pathProductCartPhotoDefault = 'assets/images/Utilities/default_product.png';
      ?>
      <?php if(file_exists( $pathProductCartPhoto )): ?>
      <a href="<?php echo e(route('front.product',$item['slug'])); ?>">
        <img src="<?php echo e(asset($pathProductCartPhoto)); ?>" alt="Product">
      </a>
      <?php else: ?>
      <div class="product-thumb">
        <img src="<?php echo e(asset($pathProductCartPhotoDefault)); ?>" alt="ProductDefault">
      </div>
      <?php endif; ?>
    </div>
    <div class="entry-content">
      <h4 class="entry-title">
        <a href="<?php echo e(route('front.product',$item['slug'])); ?>"><?php echo e(strlen(strip_tags($item['name'])) > 15 ? substr(strip_tags($item['name']), 0, 15) . '...' : strip_tags($item['name'])); ?></a>
      </h4>
      
      <?php if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00): ?>
        <?php if(count($namecouponbyid) != 0): ?>
          <?php if($remainingTime <= 0): ?>
            <span class="entry-meta"><?php echo e($item['qty']); ?> x <?php echo e(PriceHelper::setCurrencyPrice($item['price'])); ?></span>
          <?php else: ?>
            <span class="entry-meta"><?php echo e($item['qty']); ?> x <?php echo e(PriceHelper::setCurrencyPrice($item['coupon_price'])); ?></span>
          <?php endif; ?>
        <?php else: ?>
          <span class="entry-meta"><?php echo e($item['qty']); ?> x <?php echo e(PriceHelper::setCurrencyPrice($item['price'])); ?></span>
        <?php endif; ?>
      <?php else: ?>
        <span class="entry-meta"><?php echo e($item['qty']); ?> x <?php echo e(PriceHelper::setCurrencyPrice($item['price'])); ?></span>
      <?php endif; ?>


      <?php if(isset($item['attribute']['option_name']) && !empty($item['attribute']['option_name'])): ?>
        <?php $__currentLoopData = $item['attribute']['option_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionkey => $option_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="att"><em><?php echo e($item['attribute']['names'][$optionkey]); ?>:</em> <?php echo e($option_name); ?> (<?php echo e(PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey])); ?>)</span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <?php if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00): ?>
        <?php if(count($namecouponbyid) != 0): ?>
          <?php if($remainingTime <= 0): ?>
          <?php else: ?>
            <span class="product-withcoupon">
              <small>Con cupón: <strong><?php echo e($nameofcouponbyid); ?></strong></small>
            </span>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="entry-delete">
      <a href="<?php echo e(route('front.cart.destroy',$key)); ?>"><i class="icon-x"></i></a>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <div class="text-right">
    <p class="text-gray-dark py-2 mb-0"><span class="text-muted"><?php echo e(__('Subtotal')); ?>:</span> <?php echo e(PriceHelper::setCurrencyPrice($cartTotal)); ?></p>
  </div>
  <div class="d-flex justify-content-between">
    <div class="w-50 d-block">
      <a class="btn btn-primary btn-sm  mb-0" href="<?php echo e(route('front.cart')); ?>">
        <span><?php echo e(__('Cart')); ?></span>
      </a>
    </div>
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
  </div>
<?php else: ?>
  <?php echo e(__('Cart empty')); ?>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/header_cart.blade.php ENDPATH**/ ?>