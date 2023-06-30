<?php $__env->startSection('content'); ?>

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b><?php echo e(__('Social Login')); ?></b></h3>
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
                        <div class="col-4 col-md-3">
                            <div class="nav flex-column m-3 nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                    <a class="nav-link active" data-toggle="pill" href="#facebook"><?php echo e(__('Facebook')); ?></a>
                                    <a class="nav-link" data-toggle="pill" href="#google"><?php echo e(__('Google')); ?></a>


                            </div>
                        </div>
						<div class="col-lg-9">
							<div class="p-5">
								<form class="admin-form" action="<?php echo e(route('back.setting.update')); ?>" method="POST"
									enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>

									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                        <div id="tabs">

                                        <!-- Tab panes -->
                                        <div class="tab-content">

                                          <div id="facebook" class="container tab-pane active"><br>

                                            <div class="row justify-content-center">

                                                <div class="col-lg-8">

                                                    <div class="form-group">
                                                        <label class="switch-primary">
                                                          <input type="checkbox" class="switch switch-bootstrap status radio-check" name="facebook_check" value="1" <?php echo e($setting->facebook_check == 1 ? 'checked' : ''); ?>>
                                                          <span class="switch-body"></span>
                                                          <span class="switch-text"><?php echo e(__('Facebook Login')); ?></span>
                                                        </label>
                                                    </div>

                                                    <div class="radio-show <?php echo e($setting->facebook_check == 0 ? 'd-none' : ''); ?>">

                                                        <div class="form-group ">
                                                            <label for="facebook_client_id"><?php echo e(__('App ID')); ?></label> <small>(<?php echo e(__('From developers.facebook.com')); ?>)</small>
                                                            <input type="text" class="form-control" id="facebook_client_id" name="facebook_client_id" placeholder="<?php echo e(__('Enter App ID')); ?>" value="<?php echo e($setting->facebook_client_id); ?>" ="">
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="facebook_client_secret"><?php echo e(__('App Secret')); ?></label> <small>(<?php echo e(__('From developers.facebook.com')); ?>)</small>
                                                            <input type="text" class="form-control" id="facebook_client_secret" name="facebook_client_secret" placeholder="<?php echo e(__('Enter App Secret')); ?>" value="<?php echo e($setting->facebook_client_secret); ?>" ="">
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="facebook_redirect"><?php echo e(__('Redirect URL')); ?></label> <small>(<?php echo e(__('Set this to your Valid OAuth Redirect URI in developers.facebook.com')); ?>)</small>
                                                            <input type="text" class="form-control" id="facebook_redirect" name="facebook_redirect" placeholder="<?php echo e(__('Enter Redirect URL')); ?>" value="<?php echo e($facebook_url); ?>" readonly>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                          </div>

                                          <div id="google" class="container tab-pane"><br>

                                            <div class="row justify-content-center">

                                                <div class="col-lg-8">

                                                    <div class="form-group">
                                                        <label class="switch-primary">
                                                          <input type="checkbox" class="switch switch-bootstrap status radio-check" name="google_check" value="1" <?php echo e($setting->google_check == 1 ? 'checked' : ''); ?>>
                                                          <span class="switch-body"></span>
                                                          <span class="switch-text"><?php echo e(__('Google Login')); ?></span>
                                                        </label>
                                                    </div>

                                                    <div class="radio-show <?php echo e($setting->google_check == 0 ? 'd-none' : ''); ?>">

                                                        <div class="form-group ">
                                                            <label for="google_client_id"><?php echo e(__('Client ID')); ?></label> <small>(<?php echo e(__('From console.cloud.google.com')); ?>)</small>
                                                            <input type="text" class="form-control " id="google_client_id" name="google_client_id" placeholder="<?php echo e(__('Enter Client ID')); ?>" value="<?php echo e($setting->google_client_id); ?>" ="">
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="google_client_secret"><?php echo e(__('Client Secret')); ?></label> <small>(<?php echo e(__('From console.cloud.google.com')); ?>)</small>
                                                            <input type="text" class="form-control " id="google_client_secret" name="google_client_secret" placeholder="<?php echo e(__('Enter Client Secret')); ?>" value="<?php echo e($setting->google_client_secret); ?>" ="">
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="google_redirect"><?php echo e(__('Redirect URL')); ?></label> <small>(<?php echo e(__('Set this to your Redirect URL in console.cloud.google.com')); ?>)</small>
                                                            <input type="text" class="form-control " id="google_redirect" name="google_redirect" placeholder="<?php echo e(__('Enter Redirect URL')); ?>" value="<?php echo e($google_url); ?>" readonly>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                          </div>

                                        </div>

                                    </div>

                                      </div>

									<div>

                                        <div class="form-group d-flex justify-content-center">
                                            <button type="submit" class="btn btn-secondary"><?php echo e(__('Submit')); ?></button>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/settings/social.blade.php ENDPATH**/ ?>