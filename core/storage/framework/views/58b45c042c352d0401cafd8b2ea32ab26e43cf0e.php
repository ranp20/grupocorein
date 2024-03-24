<?php
  $categories = App\Models\Category::with('subcategory')->whereStatus(1)->orderby('serial','asc')->take(20)->get();
?>
<div class="left-category-area w-100 cLCategs__c" data-dropdown-contentmenu="products-menu">
  <!-- <div class="category-header cLCategs__c__cTitle">
    <h4><i class="icon-align-justify"></i> <?php echo e(__('Productos')); ?></h4>
  </div> -->
  <div class="category-list">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="c-item">
      <a class="d-block navi-link" href="<?php echo e(route('front.catalog').'?category='.$pcategory->slug); ?>">
        <img class="lazy" data-src="<?php echo e(asset('assets/images/'.$pcategory->photo)); ?>">
        <span class="text-gray-dark"><?php echo e($pcategory->name); ?></span>
        <?php if($pcategory->subcategory->count() > 0): ?>
        <i class="icon-chevron-right"></i>
        <?php endif; ?>
      </a>
      <?php if($pcategory->subcategory->count() > 0): ?>
      <div class="sub-c-box">
        <div class="row">                                   
          <div class="col-md-12">
            <p class="titulo-as"> <?php echo e($pcategory->name); ?></p>
          </div>
        </div>
        <?php $__currentLoopData = $pcategory->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="child-c-box">
          <div class="row">         
            <div class="col-md-12">
              <a class="title" href="<?php echo e(route('front.catalog').'?subcategory='.$scategory->slug); ?>">
                <?php echo e($scategory->name); ?>

                <?php if($scategory->childcategory->count() > 0): ?>    
                <?php endif; ?>
              </a>
                <?php if($scategory->childcategory->count() > 0): ?>
              <div class="col-md-12">
                <?php $__currentLoopData = $scategory->childcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                  <a href="<?php echo e(route('front.catalog').'?childcategory='.$childcategory->slug); ?>" class="link-mega"><?php echo e($childcategory->name); ?></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <?php endif; ?> 
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/includes/categories.blade.php ENDPATH**/ ?>