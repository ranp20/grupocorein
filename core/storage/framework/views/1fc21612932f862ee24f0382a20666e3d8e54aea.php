<?php
  $cart = Session::has('cart') ? Session::get('cart') : [];
  $total =0;
  $option_price = 0;
  $cartTotal = 0;
?>
<?php
  /*
  echo "<pre>";
  print_r(Session::get('cart'));
  echo "<pre>";
  */
?>
<div class="row">
  <div class="col-xl-9 col-lg-8">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive shopping-cart">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th><?php echo e(__('Product Name')); ?></th>
                <th class="text-center"><?php echo e(__('Price')); ?></th>
                <th class="text-center"><?php echo e(__('Quantity')); ?></th>
                <th class="text-center"><?php echo e(__('Subtotal')); ?></th>
                <th class="text-center">
                  <a class="btn btn-sm btn-primary" href="<?php echo e(route('front.cart.clear')); ?>"><span><?php echo e(__('Clear Cart')); ?></span></a>
                </th>
              </tr>
            </thead>
            <tbody id="cart_view_load" data-target="<?php echo e(route('cart.get.load')); ?>">
              <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
                $cartTotal +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
              ?>
              <tr>
                <td>
                  <div class="product-item">
                    <?php
                      $pathProductPhoto = 'assets/images/'.$item['photo'];
                      $pathProductPhotoDefault = 'assets/images/Utilities/default_product.png';
                    ?>
                    <?php if(file_exists( $pathProductPhoto )): ?>
                    <a class="product-thumb" href="<?php echo e(route('front.product',$item['slug'])); ?>">
                      <img src="<?php echo e(asset($pathProductPhoto)); ?>" alt="Product">
                    </a>
                    <?php else: ?>
                    <div class="product-thumb">
                      <img src="<?php echo e(asset($pathProductPhotoDefault)); ?>" alt="ProductDefault">
                    </div>
                    <?php endif; ?>
                    <div class="product-info">
                      <h4 class="product-title">
                        <a href="<?php echo e(route('front.product',$item['slug'])); ?>">
                        <?php echo e(strlen(strip_tags($item['name'])) > 45 ? substr(strip_tags($item['name']), 0, 45) . '...' : strip_tags($item['name'])); ?>

                        </a>
                      </h4>
                      <?php if(isset($cart['attribute']['option_name']) && !empty($cart['attribute']['option_name'])): ?>
                      <?php $__currentLoopData = $item['attribute']['option_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionkey => $option_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <span><em><?php echo e($item['attribute']['names'][$optionkey]); ?>:</em> <?php echo e($option_name); ?> (<?php echo e(PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey])); ?>)</span>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </td>
                <td class="text-center text-lg"><?php echo e(PriceHelper::setCurrencyPrice($item['price'])); ?></td>
                <td class="text-center d-flex align-items-center justify-content-center border border-0">
                  <?php if($item['item_type'] != 'digital'): ?>
                  <div class="qtySelector product-quantity pt-3">
                    <span class="decreaseQtycart cartsubclick" data-id="<?php echo e($key); ?>" data-target="<?php echo e(PriceHelper::GetItemId($key)); ?>"><i class="fas fa-minus"></i></span>
                    <input type="text" disabled class="qtyValue cartcart-amount" value="<?php echo e($item['qty']); ?>">
                    <span class="increaseQtycart cartaddclick" data-id="<?php echo e($key); ?>" data-target="<?php echo e(PriceHelper::GetItemId($key)); ?>"><i class="fas fa-plus"></i></span>
                    <input type="hidden" value="3333" id="current_stock">
                  </div>
                  <?php endif; ?>
                </td>
                <td class="text-center text-lg"><?php echo e(PriceHelper::setCurrencyPrice($item['price'] * $item['qty'])); ?></td>
                <td class="text-center">
                  <a class="remove-from-cart" href="<?php echo e(route('front.cart.destroy',$key)); ?>" data-toggle="tooltip" title="<?php echo e(__('Remove product')); ?>"><i class="icon-trash-2"></i>
                  </a>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-4">
    <div class="card mt-mob-t-tblt-4">
      <div class="card-body">
        <div class="shopping-cart-top">
          <h3 class="widget-title"><?php echo e(__('Order Summary')); ?></h3>
        </div>
        <div class="shopping-cart-footer">
          
          <div class="text-right column text-lg">
            <span class="text-muted"><?php echo e(__('Subtotal')); ?>: </span>
            <span class="text-gray-dark"><?php echo e(PriceHelper::setCurrencyPrice($cartTotal - (Session::has('coupon') ? Session::get('coupon')['discount'] : 0))); ?></span>
          </div>
        </div>
        <div class="shopping-cart-footer">
          
          <?php if(Auth::check() && Auth::user()->role !== 'admin'): ?>
            <?php if(!empty(auth()->user()) || auth()->user() != ""): ?>
              <?php if(auth()->user()->reg_address1 != "" && auth()->user()->reg_address2 != "" && auth()->user()->reg_ruc != "off" && auth()->user()->reg_ruc != "" && auth()->user()->reg_razonsocial != "" && auth()->user()->reg_addressfiscal != ""): ?>
                <div class="column">
                  <a class="btn btn-primary d-flex align-items-center" data-role="nxt-checkoutinfo" href="<?php echo e(route('front.checkout.payment')); ?>">
                    <span class="text-uppercase"><?php echo e(__('Buy now')); ?></span>
                    <span class="icon-arrrowight">
                      <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                    </span>
                  </a>
                </div>
              <?php else: ?>
                <div class="column">
                  <a class="btn btn-primary d-flex align-items-center" data-role="nxt-checkoutinfo" href="<?php echo e(route('front.checkout.billing')); ?>">
                    <span class="text-uppercase"><?php echo e(__('Buy now')); ?></span>
                    <span class="icon-arrrowight">
                      <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                    </span>
                  </a>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          <?php else: ?>
            <div class="column">
              <a class="btn btn-primary d-flex align-items-center" data-role="nxt-checkoutinfo" href="<?php echo e(route('user.login')); ?>">
                <span class="text-uppercase"><?php echo e(__('Buy now')); ?></span>
                <span class="icon-arrrowight">
                  <svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><switch><foreignObject requiredExtensions="http://ns.adobe.com/AdobeIllustrator/10.0/" x="0" y="0" width="1" height="1"/><g i:extraneous="self"><path d="M95.9,46.2L65.4,15.7c-2.1-2.1-5.5-2.1-7.5,0c-2.1,2.1-2.1,5.5,0,7.5l21.5,21.5H7.8c-2.9,0-5.3,2.4-5.3,5.3    c0,2.9,2.4,5.3,5.3,5.3h71.5L57.9,76.8c-2.1,2.1-2.1,5.5,0,7.5c1,1,2.4,1.6,3.8,1.6s2.7-0.5,3.8-1.6l30.6-30.6    c1-1,1.6-2.4,1.6-3.8C97.5,48.6,96.9,47.2,95.9,46.2z"/></g></switch></svg>
                </span>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/cart.blade.php ENDPATH**/ ?>