<?php $__env->startSection('content'); ?>

<div class="container-fluid">

	<!-- Tax Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 "><b><?php echo e(__('Update Tax')); ?></b> </h3>
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('back.tax.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-12">
								<form class="admin-form" action="<?php echo e(route('back.tax.update',$tax->id)); ?>"
									method="POST" enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('PUT'); ?>

									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

									<div class="form-group">
										<label for="title"><?php echo e(__('Title')); ?> *</label>
										<input type="text" name="name" class="form-control" id="title"
											placeholder="<?php echo e(__('Enter Title')); ?>" value="<?php echo e($tax->name); ?>" >
									</div>

                                    <div class="form-group">
                                        <label for="price"><?php echo e(__(' Price')); ?> *</label>
                                        <small>(<?php echo e(__('Set 0 to make it free')); ?>)</small>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text">%</span>
                                            </div>
                                            <input type="text" id="price"
                                                name="value" class="form-control"
                                                placeholder="<?php echo e(__('Enter Price')); ?>"
                                                value="<?php echo e($tax->value); ?>" >
                                        </div>
                                    </div>

									<div class="form-group">
										<button type="submit" class="btn btn-secondary"><?php echo e(__('Submit')); ?></button>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/tax/edit.blade.php ENDPATH**/ ?>