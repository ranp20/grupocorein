<?php if($sitem->item_type != 'affiliate'): ?>
  <?php if($sitem->is_stock()): ?>
  <?php
    $qtyProdSess = 0;
    if(Session::has('cart')){
      $cartInfoSess = Session::get('cart');
      if($cartInfoSess && isset($cartInfoSess[$sitem->id.'-'])){
        $qtyProdSess = $cartInfoSess[$sitem->id.'-']['qty'];
      }
    }
  ?>
  <a class="product-button add_to_single_cart" data-id="<?php echo e($sitem->id); ?>-" data-target="<?php echo e($sitem->id); ?>" data-qty="<?php echo e($qtyProdSess); ?>" href="javascript:;"  title="<?php echo e(__('To Cart')); ?>"><i class="icon-shopping-cart"></i></a>
  <?php else: ?>
  <a class="product-button" href="<?php echo e(route('front.product',$sitem->slug)); ?>" title="<?php echo e(__('Details')); ?>"><i class="icon-arrow-right"></i></a>
  <?php endif; ?>
<?php else: ?>
  <a class="product-button" href="<?php echo e($sitem->affiliate_link); ?>" target="_blank" title="<?php echo e(__('Buy Now')); ?>"><i class="icon-arrow-right"></i></a>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/item_footer.blade.php ENDPATH**/ ?>