
<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
<meta name="description" content="<?php echo e($setting->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
  <?php echo e(__('Catalogs')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e((route('front.index'))); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator">&nbsp;</li>
          <li><?php echo e(__('Catalogs')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12" >
      <img src="<?php echo e(route('front.index')); ?>/assets/images/catalogo-pro.jpg" style="margin-bottom: 20px;">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
        <div class="shop-sorting">
          <label for="lang"><?php echo e(__('Sort by')); ?>:</label>
          <select class="form-control" id="sorting-catalogs">
            <option value="">Catálogo 2020</option>
            <option value="php">Catálogo 2021</option>
            <option value="java">Catálogo 2022</option>
          </select>
        </div>
    </div>
  </div>
</div>  
<div class="container pt-3 pb-3">
  <div class="row pb-4">        
    <div class="col-lg-3 col-md-6">
      <div class="">               
        <p><a class="boton-as"><img src="<?php echo e(route('front.index')); ?>/assets/images/1610202007194386.png"></a></p>
        <p class="titulo-we">CATÁLOGO CINTILLOS Y TERMINALES 2020</p>
        <p class="boton-aed"><a href="<?php echo e(route('front.index')); ?>/assets/images/catalogo_5f898ea24f109.pdf" class="btn_add_cart" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a></p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="">
        <p><a class="boton-as"><img src="<?php echo e(route('front.index')); ?>/assets/images/1610202007142666.png"></a></p>
        <p class="titulo-we">CATALOGO LINEA CONDUIT Y ACCESORIOS 2020</p>
        <p class="boton-aed"><a href="<?php echo e(route('front.index')); ?>/assets/images/catalogo_5f898ea24f109.pdf" class="btn_add_cart" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a></p>
      </div>
    </div>
  </div>
</div>
<form id="search_form" class="d-none" action="<?php echo e(route('front.getCatalogsByAnio')); ?>" method="GET">
  <input type="text" name="page" id="page" value="<?php echo e(isset($page) ? $page : ''); ?>">
  <input type="text" name="sorting_cataloganio" id="sorting_cataloganio" value="<?php echo e(isset($sorting_cataloganio) ? $sorting_cataloganio : ''); ?>">
  <button type="submit" id="search_button_catalog" class="d-none"></button>
</form>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/faq.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/catalogs/index.blade.php ENDPATH**/ ?>