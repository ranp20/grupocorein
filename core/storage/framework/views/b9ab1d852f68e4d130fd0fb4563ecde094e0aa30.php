<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card mb-4">
		<div class="d-sm-flex align-items-center justify-content-between py-1 px-3">
			<h3 class="mb-0 bc-title"><b><?php echo e(__('Change Password')); ?></b></h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo e(route('back.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
				<li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo e(__('Change Password')); ?></a></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="p-5">
								<form class="admin-form" action="<?php echo e(route('back.password.update')); ?>" method="POST" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<div class="form-group">
										<label for="current_password"><?php echo e(__('Current Password')); ?> *</label>
										<input type="password" name="current_password" class="form-control" id="current_password" placeholder="<?php echo e(__('Enter Your Current Password')); ?>" value="" >
									</div>
									<div class="form-group">
										<label for="new_password"><?php echo e(__('New Password')); ?> *</label>
										<input type="password" name="new_password" class="form-control" id="new_password" placeholder="<?php echo e(__('Enter Your New Password')); ?>" value="" >
									</div>
									<div class="form-group">
										<label for="renew_password"><?php echo e(__('Re-Type New Password')); ?> *</label>
										<input type="password" name="renew_password" class="form-control" id="renew_password" placeholder="<?php echo e(__('Re-Type Your New Password')); ?>" value="" >
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-secondary btn-block"><?php echo e(__('Submit')); ?></button>
									</div>
									<div>
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
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/dashboard/password.blade.php ENDPATH**/ ?>