<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b><?php echo e(__('Update Coupon')); ?></b> </h3>
				<a class="btn btn-primary btn-sm" href="<?php echo e(route('back.coupons.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
			</div>
		</div>
	</div>
	<form class="admin-form" action="<?php echo e(route('back.coupons.update',$coupons->id)); ?>"	method="POST" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<?php echo method_field('PUT'); ?>
		<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<input type="hidden" id="id" name="id" value="<?php echo e($coupons->id); ?>">
		<div class="row">
			<div class="col-lg-7">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="name"><?php echo e(__('Name')); ?> *</label>
										<input type="text" name="name" class="form-control item-name" id="name" placeholder="<?php echo e(__('Enter Name')); ?>" value="<?php echo e($coupons->name); ?>" >
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label for="discount_percentage"><?php echo e(__('Discount percentage')); ?> (%)</label>
										<input type="number" step="0.01" min="0" max="100" name="discount_percentage" id="discount_percentage" class="form-control" value="<?php echo e(isset($coupons) ? $coupons->discount_percentage : old('discount_percentage')); ?>" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<label for="name"><?php echo e(__('Current Image')); ?> *</label><br>
								<img class="admin-img" src="<?php echo e($coupons->photo ? asset('assets/images/coupons/'.$coupons->photo) : asset('assets/images/placeholder.png')); ?>" alt="No Image Found"><br>
							<span class="mt-1"><?php echo e(__('The image must be no smaller than 720 x 640.')); ?></span>
						</div>
						<div class="form-group position-relative">
							<label class="file">
								<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file"
									aria-label="File browser example">
								<span class="file-custom text-left"><?php echo e(__('Upload Image...')); ?></span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<button type="submit" class="btn btn-secondary "><?php echo e(__('Update')); ?></button>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name"><?php echo e(__('Start Date')); ?></label>
								<input class="form-control" type="date" name="date_init" value="<?php echo e($coupons->date_init); ?>" id="date_init">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name"><?php echo e(__('End Date')); ?></label>
								<input class="form-control" type="date" name="date_end" value="<?php echo e($coupons->date_end); ?>" id="date_end">
							</div>
						</div>
						<?php
							$formattedTime = date('H:i', strtotime($coupons->time_end));
						?>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name"><?php echo e(__('End Time')); ?></label>
								<input class="form-control" type="time" name="time_end" min="<?php echo date('h:i'); ?>" value="<?php echo e($formattedTime); ?>" id="time_end">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/coupons/edit.blade.php ENDPATH**/ ?>