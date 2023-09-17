<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-6 ctSec-Brand__c__i">
    <a class="b-p-s-b ctSec-Brand__c__i__link" href="<?php echo e(route('front.catalog') . '?brand=' . $brand->slug); ?>">
      <img class="d-block himx-90" src="<?php echo e(asset('assets/images/' . $brand->photo)); ?>" alt="<?php echo e($brand->name); ?>" title="<?php echo e($brand->name); ?>" width="100" height="100" decoding="sync">
    </a>
  </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/brands/filter.blade.php ENDPATH**/ ?>