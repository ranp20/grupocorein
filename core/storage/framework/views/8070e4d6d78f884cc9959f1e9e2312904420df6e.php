<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-login">
  <div class="container container-login animated fadeIn">
    <h3 class="text-center"><?php echo e(__('Sign In - Admin')); ?></h3>
    <div class="login-form">
      <form action="<?php echo e(route('back.login.submit')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="form-group">
          <label for="username" class="placeholder"><?php echo e(__('Email Address')); ?></label>
          <input id="username" name="login_email" type="email" class="form-control input-border-bottom" value="<?php echo e(old('login_email')); ?>" required>
        </div>
        <div class="form-group">
          <label for="password" class="placeholder"><?php echo e(__('Password')); ?></label>  
          <div class="input-group">
            <input id="password" name="login_password" type="password" class="form-control input-border-bottom" autocomplete="off" required>
            <div class="cFrmCtrl__cIcon--R fnc-icon_passCtrl me-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>
            </div>
          </div>
        </div>
        <div class="row justify-content-start form-sub m-0">
          <a href="<?php echo e(route('back.forgot')); ?>" class="link float-right"><?php echo e(__('Forget Password ?')); ?></a>
        </div>
        <div class="form-action mb-3">
          <button type="submit" class="btn btn-secondary  btn-login"><?php echo e(__('Sign In')); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/auth/login.blade.php ENDPATH**/ ?>