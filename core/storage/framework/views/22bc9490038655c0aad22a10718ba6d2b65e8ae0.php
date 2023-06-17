
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
          <li><a href="<?php echo e(route('front.specialoffer')); ?>"><?php echo e(__('Special offers')); ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
function renderStarRating($rating,$maxRating=5) {
  $fullStar = "<i class = 'far fa-star filled'></i>";
  $halfStar = "<i class = 'far fa-star-half filled'></i>";
  $emptyStar = "<i class = 'far fa-star'></i>";
  $rating = $rating <= $maxRating?$rating:$maxRating;

  $fullStarCount = (int)$rating;
  $halfStarCount = ceil($rating)-$fullStarCount;
  $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

  $html = str_repeat($fullStar,$fullStarCount);
  $html .= str_repeat($halfStar,$halfStarCount);
  $html .= str_repeat($emptyStar,$emptyStarCount);
  $html = $html;
  return $html;
}
?>
<div class="deal-of-day-section pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 class="h3"><?php echo e(__('Special offers')); ?></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="shop-top-filter-wrapper">
          <div class="row">
            <div class="col-md-10 gd-text-sm-center">
              <div class="sptfl">
                <div class="shop-sorting">
                  <label for="sorting"><?php echo e(__('Sort by')); ?>:</label>
                  <select class="form-control" id="sorting">
                    <option value=""><?php echo e(__('All Products')); ?></option>
                    <option value="low_to_high" <?php echo e(request()->input('low_to_high') ? 'selected' : ''); ?>><?php echo e(__('Low - High Price')); ?></option>
                    <option value="high_to_low" <?php echo e(request()->input('high_to_low') ? 'selected' : ''); ?>><?php echo e(__('High - Low Price')); ?></option>
                  </select>
                  <span class="text-muted"><?php echo e(__('Showing')); ?>:</span>
                  <span>1 - <?php echo e($setting->view_product); ?> <?php echo e(__('items')); ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-2 gd-text-sm-center">
              <div class="shop-view">
                <a class="list-view <?php echo e(Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : ''); ?> " data-step="grid" href="javascript:;" data-href="<?php echo e(route('front.catalog').'?view_check=grid'); ?>"><i class="fas fa-th-large"></i></a>
                <a class="list-view <?php echo e(Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : ''); ?>" href="javascript:;" data-step="list" data-href="<?php echo e(route('front.catalog').'?view_check=list'); ?>"><i class="fas fa-list"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-lg-12 order-lg-2" id="list_view_ajax">
        <?php echo $__env->make('front.specialofferproducts.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
    </div>
  </div>
</div>
<form id="search_form_specialofferproducts" class="d-none" action="<?php echo e(route('front.getFilterSpecialOfferProducts')); ?>" method="GET">
  <input type="text" name="maxPrice" id="maxPrice" value="<?php echo e(request()->input('maxPrice') ? request()->input('maxPrice') : ''); ?>">
  <input type="text" name="minPrice" id="minPrice" value="<?php echo e(request()->input('minPrice') ? request()->input('minPrice') : ''); ?>">
  <input type="text" name="brand" id="brand" value="<?php echo e(isset($brand) ? $brand->slug : ''); ?>">
  <input type="text" name="brand" id="brand" value="<?php echo e(isset($brand) ? $brand->slug : ''); ?>">
  <input type="text" name="category" id="category" value="<?php echo e(isset($category) ? $category->slug : ''); ?>">
  <input type="text" name="quick_filter" id="quick_filter" value="">
  <input type="text" name="childcategory" id="childcategory" value="<?php echo e(isset($childcategory) ? $childcategory->slug : ''); ?>">
  <input type="text" name="page" id="page" value="<?php echo e(isset($page) ? $page : ''); ?>">
  <input type="text" name="attribute" id="attribute" value="<?php echo e(isset($attribute) ? $attribute : ''); ?>">
  <input type="text" name="option" id="option" value="<?php echo e(isset($option) ? $option : ''); ?>">
  <input type="text" name="subcategory" id="subcategory" value="<?php echo e(isset($subcategory) ? $subcategory->slug : ''); ?>">
  <input type="text" name="sorting" id="sorting" value="<?php echo e(isset($sorting) ? $sorting : ''); ?>">
  <input type="text" name="view_check" id="view_check" value="<?php echo e(isset($view_check) ? $view_check : ''); ?>">
  <button type="submit" id="search_button_specialofferproducts" class="d-none"></button>
</form>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/specialofferproducts.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/specialofferproducts/index.blade.php ENDPATH**/ ?>