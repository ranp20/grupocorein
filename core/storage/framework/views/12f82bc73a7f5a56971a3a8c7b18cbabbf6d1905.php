<?php $__env->startSection('title'); ?>
  <?php echo e(__('Shipping')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
        <li class="separator"></li>
        <li><?php echo e(__('Shipping address')); ?></li>
      </ul>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1  checkut-page">
  <div class="row">
    <div class="col-xl-9 col-lg-8">
      <div class="steps flex-sm-nowrap mb-2">
        <a class="step" href="<?php echo e(route('front.checkout.billing')); ?>">
          <h4 class="step-title"><i class="icon-check-circle"></i>1. Datos Personales</h4>
        </a>
        <a class="step active" href="<?php echo e(route('front.checkout.shipping')); ?>">
          <h4 class="step-title">2. Dirección de Envío</h4>
        </a>
        <a class="step" href="<?php echo e(route('front.checkout.payment')); ?>">
          <h4 class="step-title">3. Comprobante de pago</h4>
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <h6><?php echo e(__('Shipping Address')); ?></h6>
          <?php
          $paisData = (isset($datauserinfo['pais']) && !empty($datauserinfo['pais'])) ? $datauserinfo['pais'] : '';
          $departamentoData = (isset($datauserinfo['departamento']) && !empty($datauserinfo['departamento'])) ? $datauserinfo['departamento'] : '';
          $provinciaData = (isset($datauserinfo['provincia']) && !empty($datauserinfo['provincia'])) ? $datauserinfo['provincia'] : '';
          $distritoData = (isset($datauserinfo['distrito']) && !empty($datauserinfo['distrito'])) ? $datauserinfo['distrito'] : '';

          $departamentoAll = DB::table('tbl_departamentos')->get();
          $provinciaAll = DB::table('tbl_provincias')->get();
          $distritoAll = DB::table('tbl_distritos')->get();
          ?>          
          <form id="checkoutShipping" action="<?php echo e(route('front.checkout.shipping.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="checkout-zip"><?php echo e(__('Zip Code')); ?></label>
                  <input class="form-control" type="text" autocomplete="off" spellcheck="false" name="ship_zip" id="checkout-zip" value="<?php echo e((!empty($user->reg_codepostal) && $user->reg_codepostal != '') ? $user->reg_codepostal : $user->ship_zip); ?>" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-country"><?php echo e(__('Country')); ?></label>
                  <select class="form-control" name="ship_country" required id="billing-country">
                    <option selected value=""><?php echo e(__('Choose Country')); ?></option>
                    <option value="1" selected>PERU</option>
                    
                  </select>
                </div>
              </div>
              <!--  NUEVO CONTENIDO(INICIO) -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-departamento"><?php echo e(__('Departamento')); ?></label>
                  <select class="form-control" name="ship_departamento" id="billing-departamento" data-href="<?php echo e(route('front.checkout.provincia')); ?>" required>
                    <option selected value=""><?php echo e(__('Elige Departamento')); ?></option>
                    <?php $__currentLoopData = $departamentoAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-code="<?php echo e((!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $departData->id) ? $departamentoData->departamento_code : $departData->departamento_code); ?>" value="<?php echo e((!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $departData->id) ? $departamentoData->id : $departData->id); ?>" <?php echo e((!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $departData->id) ? 'selected' : ''); ?> ><?php echo e($departData->departamento_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-provincia"><?php echo e(__('Provincia')); ?></label>
                  <select class="form-control" name="ship_provincia" id="billing-provincia" data-href="<?php echo e(route('front.checkout.distrito')); ?>" required>
                    <option selected value=""><?php echo e(__('Elige Provincia')); ?></option>
                    <?php $__currentLoopData = $provinciaAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proviData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-code="<?php echo e((!empty($provinciaData->id) && $provinciaData->id != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaData->provincia_code : $proviData->provincia_code); ?>" value="<?php echo e((!empty($provinciaData->id) && $provinciaData->id != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaData->id : $proviData->id); ?>" <?php echo e((!empty($departamentoData->id) && $departamentoData->id != '' && $user->reg_departamento_id == $proviData->id) ? 'selected' : ''); ?> ><?php echo e($proviData->provincia_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="billing-distrito"><?php echo e(__('Distrito')); ?></label>
                  <select class="form-control" name="ship_distrito" id="billing-distrito" data-href="<?php echo e(route('front.checkout.updateamountcart')); ?>" required>
                    <option selected value=""><?php echo e(__('Elige Distrito')); ?></option>
                    <?php $__currentLoopData = $distritoAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-code="<?php echo e((!empty($distritoData->id) && $distritoData->id != '' && $user->reg_distrito_id == $distrData->id) ? $distritoData->distrito_code : $distrData->distrito_code); ?>" value="<?php echo e((!empty($distritoData->id) && $distritoData->id != '' && $user->reg_distrito_id == $distrData->id) ? $distritoData->id : $distrData->id); ?>" <?php echo e((!empty($distritoData->id) && $distritoData->id != '' && $user->reg_distrito_id == $distrData->id) ? 'selected' : ''); ?> ><?php echo e($distrData->distrito_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="ship-streetaddress">Calle</label>
                  <input class="form-control" type="text" autocomplete="off" spellcheck="false" name="ship_streetaddress" placeholder="Calle" id="ship-streetaddress" value="<?php echo e((!empty($user->reg_streetaddress) && $user->reg_streetaddress != '') ? $user->reg_streetaddress : ''); ?>" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="ship-referenceaddress">Referencia</label>
                  <input class="form-control" type="text" name="ship_referenceaddress" placeholder="Referencia" id="ship-referenceaddress" value="<?php echo e((!empty($user->reg_referenceaddress) && $user->reg_referenceaddress != '') ? $user->reg_referenceaddress : ''); ?>" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="ship-addresseeaddress">Destinatario</label>
                  <input class="form-control" type="text" name="ship_addresseeaddress" placeholder="Destinatario" id="ship-addresseeaddress" value="<?php echo e((!empty($user->reg_addresseeaddress) && $user->reg_addresseeaddress != '') ? $user->reg_addresseeaddress : ''); ?>" required>
                </div>
              </div>
            </div>
            <!--  NUEVO CONTENIDO(FIN) -->
            <div class="d-flex justify-content-between paddin-top-1x mt-4">
              <a class="btn btn-primary btn-sm" href="<?php echo e(route('front.cart')); ?>">
                <span class="hidden-xs-down"><i class="icon-arrow-left"></i> <?php echo e(__('Back To Cart')); ?></span>
              </a>
              <button class="btn btn-primary  btn-sm" type="submit">
                <span class="hidden-xs-down"><?php echo e(__('Continue')); ?></span><i class="icon-arrow-right position-relative z-3 ms-1"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php echo $__env->make('includes.checkout_sitebar',$cart, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/shipping.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/checkout/shipping.blade.php ENDPATH**/ ?>