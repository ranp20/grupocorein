
<?php $__env->startSection('title'); ?>
  <?php echo e(__('Special offers')); ?>

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
          <li><a href="<?php echo e(route('front.allcategories')); ?>"><?php echo e(__('All Categories')); ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="deal-of-day-section pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 class="h3"><?php echo e(__('All Categories')); ?></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <div class="row gx-3">
          <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-4 pb-3">
            <a href="<?php echo e(route('front.catalog').'?category='.$categ['slug']); ?>" class="genius-banner c-cMnul__Flinks" data-href="<?php echo e($categ['slug']); ?>" title="<?php echo e((isset($categ['name'])) ? $categ['name'] : ''); ?>">
              <div class="inner-content c-cMnul__Flinks__cDesc">
                <?php if(isset($categ['name'])): ?>
                  <h4><?php echo e($categ['name']); ?></h4>
                <?php endif; ?>
              </div>
              <div class="c-cMnul__Flinks__cImg">
                <img src="<?php echo e(asset('assets/images/'.$categ['photo'])); ?>" alt="<?php echo e($categ['slug']); ?>" width="100" height="100" decoding="sync">
              </div>
            </a>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/allcategories.blade.php ENDPATH**/ ?>