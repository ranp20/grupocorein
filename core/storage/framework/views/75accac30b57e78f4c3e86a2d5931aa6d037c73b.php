<?php $__env->startSection('title'); ?>
  <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Welcome Back')); ?>, <?php echo e($user->first_name); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    <?php echo $__env->make('includes.user_sitebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="padding-top-2x mt-2 hidden-lg-up"></div>
          <form class="row" action="<?php echo e(route('user.profile.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div>
              <h5><?php echo e(__('Personal information')); ?></h5>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="avater" class="form-label"><?php echo e(__('Avater Photo')); ?></label>
                <input class="form-control" type="file" name="photo" id="avater" style="line-height:2.3;padding: .375rem .75rem;">
              <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-danger"><?php echo e($message); ?></p>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-fn"><?php echo e(__('Names')); ?></label>
                <input class="form-control" name="first_name" type="text" id="account-fn" value="<?php echo e($user->first_name); ?>">
                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-ln"><?php echo e(__('SurNames')); ?></label>
                <input class="form-control" type="text" name="last_name" id="account-ln" value="<?php echo e($user->last_name); ?>">
                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-email"><?php echo e(__('E-mail Address')); ?></label>
                <input class="form-control" name="email" type="email" id="account-email" value="<?php echo e($user->email); ?>" >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-phone"><?php echo e(__('Phone/Telephone')); ?></label>
                <input class="form-control" name="phone" type="text" id="account-phone" value="<?php echo e($user->phone); ?>">
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group position-relative">
                <label for="account-pass"><?php echo e(__('New Password')); ?></label>
                <div class="position-relative">
                  <input class="form-control" name="password" type="text" id="account-pass" placeholder="<?php echo e(__('Change your password')); ?>">
                  <div class="cFrmCtrl__cIcon--R fnc-icon_passCtrl ps-1 pe-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>
                  </div>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-12"><hr class="mt-2 mb-3"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-address1"><?php echo e(__('Address 1')); ?> *</label>
                <input class="form-control" name="reg_address1" placeholder="<?php echo e((isset($user->reg_address1) && $user->reg_address1 != '') ? $user->reg_address1 : 'Dirección 1'); ?>" value="<?php echo e($user->reg_address1); ?>" type="text" id="reg-address1">
                <?php $__errorArgs = ['reg_address1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-address2"><?php echo e(__('Address 2 (Optional)')); ?> </label>
                <input class="form-control" name="reg_address2" placeholder="<?php echo e((isset($user->reg_address2) && $user->reg_address2 != '') ? $user->reg_address2 : 'Dirección 2'); ?>" value="<?php echo e($user->reg_address2); ?>" type="text" id="reg-address2">
                <?php $__errorArgs = ['reg_address2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-12"><hr class="mt-2 mb-3"></div>
            <div>
              <h5><?php echo e(__('Enterprise data')); ?></h5>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-ruc">RUC</label>
                <input class="form-control" type="text" data-valformat="onlydigits" name="reg_ruc" placeholder="RUC" id="reg-ruc" value="<?php echo e($user->reg_ruc); ?>" maxlength="11">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-razosocial">Razón social</label>
                <input class="form-control" type="text" name="reg_razonsocial" placeholder="Razón social" id="reg-razosocial" value="<?php echo e($user->reg_razonsocial); ?>">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="reg-addressfiscal">Dirección Fiscal</label>
                <input class="form-control" type="text" name="reg_addressfiscal" placeholder="Dirección Fiscal" id="reg-addressfiscal" value="<?php echo e($user->reg_addressfiscal); ?>">
              </div>
            </div>
            <div class="col-12">
              <hr class="mt-2 mb-3">
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                
                <button class="btn btn-primary margin-right-auto ms-auto" type="submit"><span><?php echo e(__('Update Profile')); ?></span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/profile.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/dashboard/index.blade.php ENDPATH**/ ?>