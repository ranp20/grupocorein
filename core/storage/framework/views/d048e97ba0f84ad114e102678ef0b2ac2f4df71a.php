<?php $__env->startSection('title'); ?>
  <?php echo e(__('Billing')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
    <div class="container">
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator"></li>
          <li><?php echo e(__('Billing address')); ?></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container padding-bottom-3x mb-1 checkut-page">
    <div class="row">
      <div class="col-xl-9 col-lg-8">
        <div class="steps flex-sm-nowrap mb-2">
          <a class="step active" href="<?php echo e(route('front.checkout.billing')); ?>">
            <h4 class="step-title">1. Datos Personales:</h4>
          </a>
          <a class="step" href="javascript:;">
            <h4 class="step-title">2. Dirección de envío:</h4>
          </a>
          <a class="step" href="<?php echo e(route('front.checkout.payment')); ?>">
            <h4 class="step-title">3. Comprobante de pago</h4>
          </a>
        </div>
        <div class="card">
          <div class="card-body">
            <h6><?php echo e(__('Datos Personales')); ?></h6>
            <form id="checkoutBilling" action="<?php echo e(route('front.checkout.store')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="checkout-fn"><?php echo e(__('Nombres')); ?></label>
                    <input class="form-control" name="bill_first_name" type="text" required id="checkout-fn" value="<?php echo e(isset($user) ? $user->first_name : ''); ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="checkout-ln"><?php echo e(__('Apellidos')); ?></label>
                    <input class="form-control" name="bill_last_name" type="text" required id="checkout-ln" value="<?php echo e(isset($user) ? $user->last_name : ''); ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="checkout_email_billing"><?php echo e(__('Correo electrónico')); ?></label>
                    <input class="form-control" name="bill_email"  type="email" required id="checkout_email_billing" value="<?php echo e(isset($user) ? $user->email : ''); ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="checkout-phone"><?php echo e(__('Teléfono/Celular')); ?></label>
                    <input class="form-control" name="bill_phone" type="text" id="checkout-phone" required value="<?php echo e(isset($user) ? $user->phone : ''); ?>">
                  </div>
                </div>
              </div>
              <?php if(PriceHelper::CheckDigital()): ?>
                <?php if(Session::has('billing_address')): ?>
                  <?php  
                  $billAddress = Session::get('billing_address');
                  ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="checkout-address1"><?php echo e(__('Address')); ?> 1</label>
                        <input class="form-control" name="bill_address1" required type="text" id="checkout-address1" value="<?php echo e((!empty($billAddress['bill_address1']) ? $billAddress['bill_address1'] : '')); ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="checkout-address2"><?php echo e(__('Address')); ?> 2</label>
                        <input class="form-control" name="bill_address2" type="text" id="checkout-address2" value="<?php echo e((!empty($billAddress['bill_address2']) ? $billAddress['bill_address2'] : '')); ?>">
                      </div>
                    </div>
                  </div>
                <?php else: ?>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-address1"><?php echo e(__('Address')); ?> 1</label>
                      <input class="form-control" name="bill_address1" required type="text" id="checkout-address1" value="<?php echo e(isset($user) ? $user->reg_address1 : ''); ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="checkout-address2"><?php echo e(__('Address')); ?> 2</label>
                      <input class="form-control" name="bill_address2" type="text" id="checkout-address2" value="<?php echo e(isset($user) ? $user->reg_address2 : ''); ?>">
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              <?php endif; ?>
              
              <?php if($setting->is_privacy_trams == 1): ?>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="trams__condition" >
                  <label class="custom-control-label" for="trams__condition">Este sitio está protegido por reCAPTCHA y el <a href="<?php echo e($setting->policy_link); ?>" target="_blank">Privacy Policy</a> y <a href="<?php echo e($setting->terms_link); ?>" target="_blank">Términos de servicio</a> aplicar.</label>
                </div>
              </div>
              <?php endif; ?>
              <div class="d-flex justify-content-between paddin-top-1x mt-4">
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('front.cart')); ?>"><span class="hidden-xs-down"><i class="icon-arrow-left"></i><?php echo e(__('Back To Cart')); ?></span></a>
                <?php if($setting->is_privacy_trams == 1): ?>
                <button disabled id="continue__button" class="btn btn-primary  btn-sm" type="button">
                  <span class="hidden-xs-down"><?php echo e(__('Continue')); ?></span><i class="icon-arrow-right position-relative z-3 ms-1"></i>
                </button>
                <?php else: ?>
                <button class="btn btn-primary btn-sm" type="submit">
                  <span class="hidden-xs-down"><?php echo e(__('Continue')); ?></span><i class="icon-arrow-right position-relative z-3 ms-1"></i>
                </button>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php echo $__env->make('includes.checkout_sitebar',$cart, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/checkout/billing.blade.php ENDPATH**/ ?>