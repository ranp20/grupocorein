
<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
<meta name="description" content="<?php echo e($setting->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
  <?php echo e(__('Brand')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e((route('front.index'))); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator">&nbsp;</li>
          <li><?php echo e(__('Brand')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php                  
  $AllbrandsList = DB::table('brands')->select('name','slug','photo','status')->get()->toArray();
  $brandGroups = [];
  function sanitizeLetter2($letter){
    return is_numeric($letter) ? '#' : $letter;
  }
  foreach ($AllbrandsList as $brand){
    $firstLetter = strtoupper(substr($brand->name, 0, 1));
    $groupName = is_numeric($firstLetter) ? '#' : $firstLetter;
    // $groupName = $firstLetter;
    if (!isset($brandGroups[$groupName])){
      $brandGroups[$groupName] = [];
    }      
    $brandGroups[$groupName][] = $brand;
  }
  $availableLetters = array_keys($brandGroups);
  $alphabetLetters = range('A', 'Z');
  $allLetters = array_unique(array_merge($availableLetters, $alphabetLetters));
  $filteredLetters = array_map('sanitizeLetter2', $allLetters);
  sort($filteredLetters);

  // echo "<pre>";
  // print_r($filteredLetters);
  // echo "</pre>";

?>
<div class="container pt-0 pb-5 ctSec-Brand">
  <div class="row">
    <div class="col-lg-12">
      <div class="shop-top-filter-wrapper">
        <div class="row">
          <div class="col-md-10 gd-text-sm-center">
            <div class="sptfl">
              <div class="shop-sorting">
                <label for="sorting"><?php echo e(__('Sort by')); ?>:</label>
                <select class="form-control" id="sorting_brandsletter">
                  <option value=""><?php echo e(__('All Brands')); ?></option>
                  <?php $__currentLoopData = $filteredLetters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($letter, $availableLetters)): ?>
                      <?php
                        $iptSelecLetter = 'letter-'.$letter;
                      ?>
                      <option value="<?php echo e($iptSelecLetter); ?>" <?php echo e(request()->input($iptSelecLetter) ? 'selected' : ''); ?>><?php echo e($letter); ?></option>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-muted"><?php echo e(__('Showing')); ?>:</span>
                <span>1 - <?php echo e($setting->view_product); ?> <?php echo e(__('items')); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row g-3 ctSec-Brand__c">

    <div class="row g-3 ctSec-Brand__c" id="list_view_ajax">
      <?php echo $__env->make('front.brands.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <form id="search_form_marcas" class="d-none" action="<?php echo e(route('front.getBrandsByLetter')); ?>" method="GET">
      <input type="text" name="page" id="page" value="<?php echo e(isset($page) ? $page : ''); ?>">
      <input type="text" name="sorting_brandletter" id="sorting_brandletter" value="<?php echo e(isset($sorting_brandletter) ? $sorting_brandletter : ''); ?>">
      <button type="submit" id="search_button_marcas" class="d-none"></button>
    </form>
  </div>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/brands.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/brands/index.blade.php ENDPATH**/ ?>