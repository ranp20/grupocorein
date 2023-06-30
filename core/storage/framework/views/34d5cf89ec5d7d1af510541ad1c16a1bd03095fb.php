<?php $__env->startSection('content'); ?>


        <div class="wrapper wrapper-login">
            <div class="container container-login animated fadeIn">
                <h3 class="text-center"><?php echo e(__('Forgot Password')); ?></h3>
                <div class="login-form">

                    <form action="<?php echo e(route('back.forgot.submit')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="form-group form-floating-label">
                            <input id="username" name="email" type="email" class="form-control input-border-bottom" value="<?php echo e(old('email')); ?>" >
                            <label for="username" class="placeholder"><?php echo e(__('Email Address')); ?></label>
                        </div>


                        <div class="row justify-content-center form-sub m-0">
                            <a href="<?php echo e(route('back.login')); ?>" class="link float-right"><?php echo e(__('Remember Password?')); ?></a>
                        </div>

                        <div class="form-action mb-3">
                            <button type="submit" class="btn btn-secondary  btn-login"><?php echo e(__('Reset My Password')); ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/auth/forgot.blade.php ENDPATH**/ ?>