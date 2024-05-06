<?php $__env->startSection('title'); ?>
  <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(__('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Welcome Back')); ?> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    <?php echo $__env->make('includes.user_sitebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-lg-8">
      <div class="padding-top-2x mt-2 hidden-lg-up"></div>
      <div class="row u-d-d">
        <div class="col-md-6 mb-4">
          <div class="card round">
            <div class="card-body text-center">
              <i class="icon-shopping-bag"></i>
              <p class="mt-3"><?php echo e(__('All Order')); ?></p>
              <h4><b><?php echo e($allorders); ?></b></h4>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card round">
            <div class="card-body text-center">
              <i class="icon-shopping-bag"></i>
              <p class="mt-3"><?php echo e(__('Completed Order')); ?></p>
              <h4><b><?php echo e($delivered); ?></b></h4>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card round">
            <div class="card-body text-center">
              <i class="icon-shopping-bag"></i>
              <p class="mt-3"><?php echo e(__('Processing Order')); ?></p>
              <h4><b><?php echo e($progress); ?></b></h4>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card round">
            <div class="card-body text-center">
              <i class="icon-shopping-bag"></i>
              <p class="mt-3"><?php echo e(__('Canceled Order')); ?></p>
              <h4><b><?php echo e($canceled); ?></b></h4>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card round">
            <div class="card-body text-center">
              <i class="icon-shopping-bag"></i>
              <p class="mt-3"><?php echo e(__('Pending Order')); ?></p>
              <h4><b><?php echo e($pending); ?></b></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/dashboard/dashboard.blade.php ENDPATH**/ ?>