
<?php $__env->startSection('title'); ?>
  <?php echo e(__('Catalogs')); ?>

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
          <li><a href="<?php echo e((route('front.index'))); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator">&nbsp;</li>
          <li><a href="<?php echo e(route('front.journals')); ?>"><?php echo e(__('Catalogs')); ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php                  
  $tbl_catalogs = DB::table('tbl_catalogs')->get()->toArray();
  $arrCatalogsYears = [];
  $arrCatalogsYears2 = [];
  $arrCatalogsYears3 = [];
  foreach($tbl_catalogs as $k => $v){
    $date = $v->created_at;
    $dateYears = date("Y",strtotime($date));
    $arrCatalogsYears[$k] = $dateYears;
  }
  $arrCatalogsFilterUnique = array_unique($arrCatalogsYears);
  $arrCatalogsYears2 = array_values($arrCatalogsFilterUnique);
  foreach($arrCatalogsYears2 as $k => $v){
    $arrCatalogsYears3[$k]['year'] = $v;
  }
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12" >
      <img src="<?php echo e(route('front.index')); ?>/assets/images/catalogo-pro.jpg" style="margin-bottom: 20px;">
    </div>
  </div>
  <div>
    <div class="deal-of-day-section pb-5">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2 class="h3"><?php echo e(__('Catalogs')); ?></h2>
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
                    <select class="form-control" id="sorting-catalogs">
                      <option value=""><?php echo e(__('All catalogs')); ?></option>
                      <?php $__currentLoopData = $arrCatalogsYears3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $iptSelecYear = 'y-'.$v['year'];
                      ?>
                      <option value="<?php echo e($iptSelecYear); ?>" <?php echo e(request()->input($iptSelecYear) ? 'selected' : ''); ?>><?php echo e($v['year']); ?></option>
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
      <div class="container">
        <div class="row">
          <div class="col-lg-12 order-lg-2" id="list_view_ajax">
            <?php echo $__env->make('front.journals.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <form id="search_form_catalog" class="d-none" action="<?php echo e(route('front.getCatalogsByAnio')); ?>" method="GET">
            <input type="text" name="page" id="page" value="<?php echo e(isset($page) ? $page : ''); ?>">
            <input type="text" name="sorting_cataloganio" id="sorting_cataloganio" value="<?php echo e(isset($sorting_cataloganio) ? $sorting_cataloganio : ''); ?>">
            <button type="submit" id="search_button_catalog" class="d-none"></button>
          </form>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/journals.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/journals/index.blade.php ENDPATH**/ ?>