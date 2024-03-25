<?php $__env->startSection('title'); ?>
  <?php echo e(__('Page')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title mb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator">&nbsp;</li>
          <li><?php echo e($page->title); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mb-4 mt-4">
        <div class="card">
          <div class="card-body px-4 py-5">
            <div class="d-page-content">
              <h4 class="d-block text-center"><b><?php echo e($page->title); ?></b></h4>
              <?php echo $page->details; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/page.blade.php ENDPATH**/ ?>