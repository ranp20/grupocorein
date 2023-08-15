<?php $__env->startSection('title'); ?>
  <?php echo e(__('Order Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
        <li class="separator"></li>
        <li><?php echo e(__('Success')); ?></li>
      </ul>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="card text-center">
    <div class="card-body padding-top-2x">
      <h3 class="card-title text-success"><?php echo e(__('Thank you for your order')); ?>!</h3>
      <p class="card-text"><?php echo e(__('Your order has been placed and will be processed as soon as possible.')); ?></p>
      <p class="card-text"><?php echo e(__('Make sure you make note of your order number, which is')); ?> <span class="fw-bold"><?php echo e($order->id_gencode); ?></span></p>
      <!-- <p class="card-text"><?php echo e(__('You will be receiving an email shortly with confirmation of your order.')); ?></p> -->
      <div class="padding-top-1x padding-bottom-1x">
        <a class="btn btn-primary m-4" href="<?php echo e(route('front.catalog')); ?>"><span><i class="icon-package pr-2"></i> <?php echo e(__('View our products again')); ?></span></a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/checkout/success.blade.php ENDPATH**/ ?>