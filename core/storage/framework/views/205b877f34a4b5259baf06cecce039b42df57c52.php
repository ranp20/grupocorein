<?php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total = 0;
  $qty = 0;
  $option_price = 0;
  $cartTotal = 0;
?>
<div class="col-xl-3 col-lg-4">
  <aside class="sidebar">
    <div class="padding-top-2x hidden-lg-up"></div>
    <section class="card widget widget-featured-posts widget-order-summary p-4" id="crdLEvent__sd343fg-34Gas">
      <h3 class="widget-title"><?php echo e(__('Order Summary')); ?></h3>
      <?php
      $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first()
      ?>
      <?php if($free_shipping): ?>
        <?php if($free_shipping->minimum_price >= $cart_total): ?>
          <p class="free-shippin-aa"><em>Envío gratis a partir de <?php echo e(PriceHelper::setCurrencyPrice($free_shipping->minimum_price)); ?></em></p>
        <?php endif; ?>
      <?php endif; ?>
      <?php
        $shipSessionInfo = "";
        $amountDeliveryTotal = 0;
        $amountGrandTotal = 0;
        if(Session::has('shipping_address') && Session::get('shipping_address') != ""){
          $shipSessionInfo = Session::get('shipping_address');
          $amountDeliveryTotal = $shipSessionInfo['ship_amountaddress'];
          $amountGrandTotal = $shipSessionInfo['grand_total'];
        }
      ?>
      <div id="tblCrtReview-hd46_asdFHG54">
        <table class="table">
          <tr>
            <td><?php echo e(__('Subtotal')); ?>:</td>
            <td class="fw-bold spnLstCart__fz1 text-gray-dark"><?php echo e(PriceHelper::setCurrencyPrice($cart_total)); ?></td>
          </tr>
          <tr>
            <td>Envío:</td>
            <?php if($amountDeliveryTotal != 0 && $amountDeliveryTotal != ""): ?>
            <td class="text-gray-dark">
              <div class="cInfAmmtCart">
                <div class="cInfAmmtCart__c">
                  <span class="fw-bold spnLstCart__fz1" id="cInfAmmtCart__c-346hg"><?php echo e(PriceHelper::setCurrencyPrice($amountDeliveryTotal)); ?></span>
                </div>
              </div>
            </td>
            <?php else: ?>
            <td class="text-gray-dark">
              <div class="cInfAmmtCart">
                <div class="cInfAmmtCart__c">
                  <span class="fw-bold spnLstCart__fz1" id="cInfAmmtCart__c-346hg"><?php echo e(PriceHelper::setCurrencyPrice($amountaddress)); ?></span>
                </div>
              </div>
            </td>
            <?php endif; ?>
          </tr>
          <tr>
            <td class="text-lg text-primary"><?php echo e(__('Order total')); ?></td>
            <?php if($amountDeliveryTotal != 0 && $amountDeliveryTotal != ""): ?>
            <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set"><?php echo e(PriceHelper::setCurrencyPrice($amountGrandTotal)); ?></td>
            <?php else: ?>
            <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set"><?php echo e(PriceHelper::setCurrencyPrice($grand_total)); ?></td>
            <?php endif; ?>
          </tr>
        </table>
      </div>
    </section>
    <section class="card widget widget-featured-posts widget-featured-products p-4">
      <h3 class="widget-title"><?php echo e(__('Items In Your Cart')); ?></h3>
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
            $pathProductPhoto = 'assets/images/'.$item['photo'];
            $pathProductPhotoDefault = 'assets/images/Utilities/default_product.png';
          ?>
          <?php if(file_exists( $pathProductPhoto )): ?>
          <a href="<?php echo e(route('front.product',$item['slug'])); ?>">
            <img src="<?php echo e(asset($pathProductPhoto)); ?>" alt="Product">
          </a>
          <?php else: ?>
          <div class="product-thumb" style="display: block;border-radius: 5px;overflow: hidden;">
            <img src="<?php echo e(asset($pathProductPhotoDefault)); ?>" alt="ProductDefault">
          </div>
          <?php endif; ?>
        </div>
        <div class="entry-content">
          <h4 class="entry-title">
            <a href="<?php echo e(route('front.product',$item['slug'])); ?>"><?php echo e(strlen(strip_tags($item['name'])) > 45 ? substr(strip_tags($item['name']), 0, 45) . '...' : strip_tags($item['name'])); ?></a>
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
          <?php if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name'])): ?>
            <?php $__currentLoopData = $item['attribute']['option_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionkey => $option_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="entry-meta"><b><?php echo e($option_name); ?></b> : <?php echo e(PriceHelper::setCurrencySign()); ?><?php echo e($item['attribute']['option_price'][$optionkey]); ?></span>
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
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
  </aside>
</div><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/checkout_sitebar.blade.php ENDPATH**/ ?>