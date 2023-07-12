<?php $__env->startSection('title'); ?>
    <?php echo e(__('Cart')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
<meta name="description" content="<?php echo e($setting->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator"></li>
          <li><?php echo e(__('Cart')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php if(Session::has('cart') && count(Session::get('cart')) > 0): ?>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    <div class="col-lg-12">
      <div class="cTitleSec__c">
        <div class="section-title">
          <h2 class="cTitleSec__c__title"><?php echo e(__('Shopping cart')); ?></h2>
        </div>
        <p class="cTitleSec__c__subtitle">Tienes <strong><?php echo e(count(Session::get('cart'))); ?> productos</strong> en tu carro de compras</p>
      </div>
    </div>
  </div>
  <div id="view_cart_load">
    <?php echo $__env->make('includes.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</div>
<?php else: ?>
<div class="container padding-bottom-3x mb-1">
  <div class="card text-center">
    <div class="card-body padding-top-2x">
      <h3 class="card-title"><?php echo e(__('Your shopping cart is empty.')); ?></h3>
      <a class="btn btn-outline-primary m-4" href="<?php echo e(route('front.catalog')); ?>">
        <i class="icon-package pr-2"></i>
        <span class="ms-1"><?php echo e(__('View our products')); ?></span>
      </a>
    </div>
  </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/catalog/cart.blade.php ENDPATH**/ ?>