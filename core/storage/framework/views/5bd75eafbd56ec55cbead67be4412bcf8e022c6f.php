<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b><?php echo e(__('Update Catalog')); ?></b></h3>
				<a class="btn btn-primary  btn-sm" href="<?php echo e(route('back.catalog.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body p-0">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="p-5">
								<form class="admin-form" action="<?php echo e(route('back.catalog.update',$catalog->id)); ?>" method="POST" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<?php echo method_field('PUT'); ?>
									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<div class="form-group">
										<label for="name"><?php echo e(__('Name')); ?> *</label>
										<input type="text" name="name" class="form-control item-name" id="name" placeholder="<?php echo e(__('Enter Name')); ?>" value="<?php echo e($catalog->name); ?>" required>
									</div>
									<div class="">
										<div class="">
											<div class="form-group pb-0  mb-0">
												<label class="d-block"><?php echo e(__('Featured Image')); ?> *</label>
											</div>
											<div class="form-group pb-0 pt-0 mt-0 mb-0">
												<img class="admin-img lg" src="<?php echo e($catalog->photo ? asset('assets/images/catalog/'.$catalog->photo) : asset('assets/images/placeholder.png')); ?>">
											</div>
											<div class="form-group position-relative ">
												<?php if($catalog->photo != ""): ?>
												<label class="file mxw-100">
													<input type="file" accept="image/*" class="upload-photo" name="photo" id="file"  aria-label="File browser example">
													<span class="file-custom text-left"><?php echo e($catalog->photo); ?></span>
												</label>
												<?php else: ?>
												<label class="file mxw-100">
													<input type="file" accept="image/*" class="upload-photo" name="photo" id="file"  aria-label="File browser example">
													<span class="file-custom text-left"><?php echo e(__('Upload Image...')); ?></span>
												</label>
												<?php endif; ?>
												<br>
												<span class="mt-1 text-info"><?php echo e(__('Image Size Should Be 640 x 840. or square size')); ?></span>
											</div>
										</div>
									</div>
									<div>
										<div class="form-group pb-0  mb-0">
											<label class="d-block"><?php echo e(__('Adjuntar PDF')); ?> *</label>
										</div>
										<div class="form-group position-relative ">
											<label class="file mxw-100">
												<input type="file" accept="application/pdf" class="upload-photo" name="adj_doc" id="adj_doc" aria-label="File browser example" value="<?php echo e($catalog->adj_doc); ?>">
												<?php if($catalog->adj_doc): ?>
												<span class="file-custom text-left"><?php echo e($catalog->adj_doc); ?></span>
												<?php else: ?>
												<span class="file-custom text-left"><?php echo e(__('Adjuntar PDF...')); ?></span>
												<?php endif; ?>
											</label>
										</div>
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
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

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/catalog/edit.blade.php ENDPATH**/ ?>