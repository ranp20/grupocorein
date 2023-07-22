<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b><?php echo e(__('Update Store')); ?></b></h3>
				<a class="btn btn-primary btn-sm" href="<?php echo e(route('back.store.index')); ?>"><i class="fas fa-chevron-left"></i><?php echo e(__('Back')); ?></a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="admin-form" action="<?php echo e(route('back.store.update',$store->id)); ?>"	method="POST" enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
								<?php echo method_field('PUT'); ?>
								<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								
								<div class="form-group">
									<label for="name"><?php echo e(__('Name')); ?> *</label>
									<input type="text" name="name" class="form-control item-name" id="name" placeholder="<?php echo e(__('Enter Name')); ?>" value="<?php echo e($store->name); ?>" >
								</div>
								<div class="form-group">
									<label for="telephone"><?php echo e(__('Telephone')); ?> *</label>
									<input type="text" name="telephone" class="form-control item-name" id="telephone" placeholder="<?php echo e(__('Enter Telephone')); ?>" value="<?php echo e($store->telephone); ?>" >
								</div>
								<div class="form-group">
									<label for="address"><?php echo e(__('Address')); ?> *</label>
									<input type="text" name="address" class="form-control item-name" id="address" placeholder="<?php echo e(__('Enter Address')); ?>" value="<?php echo e($store->address); ?>" >
								</div>
								<div class="form-group">
									<button type="submit"class="btn btn-secondary"><?php echo e(__('Submit')); ?></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/store/edit.blade.php ENDPATH**/ ?>