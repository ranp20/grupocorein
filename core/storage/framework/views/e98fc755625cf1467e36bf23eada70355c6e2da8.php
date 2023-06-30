<?php $__env->startSection('content'); ?>

<div class="container-fluid">

   	<!-- Page Heading -->
       <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 bc-title"> <b><?php echo e(__('Cookie Alert')); ?></b> </h3>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-12">
							<div class="p-5">
								<div class="admin-form">

									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <div class="row justify-content-center">

                                        <div class="col-lg-8">

                                            <form action="<?php echo e(route('back.setting.update')); ?>" method="POST"
                                            enctype="multipart/form-data">

                                            <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <label class="switch-primary">
                                                      <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_cookie" value="1" <?php echo e($setting->is_cookie == 1 ? 'checked' : ''); ?>>
                                                      <span class="switch-body"></span>
                                                      <span class="switch-text"><?php echo e(__('Cookie Alert')); ?></span>
                                                    </label>
                                                </div>

                                                

                                                <div class="image-show <?php echo e($setting->is_cookie == 1 ? '' : 'd-none'); ?>">
                                                   
                                                    <div class="form-group">
                                                        <label for="cookie_text"><?php echo e(__('Cookie Text')); ?> *</label>
                                                        <input type="text" name="cookie_text" class="form-control" id="cookie_text"
                                                            placeholder="<?php echo e(__('Cookies Text')); ?>" value="<?php echo e($setting->cookie_text); ?>" >
                                                    </div>
                                                </div>
                                                <div>

                                                    <div class="form-group d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/settings/cookie.blade.php ENDPATH**/ ?>