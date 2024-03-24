<?php $__env->startSection('title'); ?>
  <?php echo e(__('Password Reset')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Password Reset')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <form class="card mt-4" method="POST" action="<?php echo e(route('user.forgot.submit')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body">
          <div class="form-group">
          <h4 class="d-block text-center mb-4"><?php echo e(__('Forgot your password?')); ?></h4>
            <label for="email-for-pass"><?php echo e(__('Enter your email address')); ?></label>
            <input class="form-control" type="text" name="email" id="email-for-pass" placeholder="<?php echo e(__('Enter your email address')); ?>">
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
            <small class="text-muted"><?php echo e(__('Type in the email address you used when you registered with our website')); ?></small>
          </div>
          <button class="btn btn-primary btn-sm" type="submit"><span><?php echo e(__('Get New Password')); ?></span></button>
          <a href="<?php echo e(route('user.login')); ?>" class="btn btn-primary btn-sm" ><span><?php echo e(__('Login')); ?></span></a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/auth/forgot.blade.php ENDPATH**/ ?>