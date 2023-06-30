<?php $__env->startSection('content'); ?>

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b><?php echo e(__('Role Edit')); ?></b> </h3>
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('back.role.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
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
						<div class="col-lg-10">
							<div class="p-5">
								<form class="admin-form" action="<?php echo e(route('back.role.update',$role->id)); ?>" method="POST"
									enctype="multipart/form-data">
									<?php echo method_field('PUT'); ?>
                                    <?php echo csrf_field(); ?>

									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<?php
										if($role->section != 'null'){
											$section = json_decode($role->section,true);
										}else{
											$section = [];
										}
									?>

									<div class="form-group">
										<label for="name"><?php echo e(__('Name')); ?> *</label>
										<input type="text" name="name" class="form-control" id="name"
											placeholder="<?php echo e(__('Enter Role Name')); ?>" value="<?php echo e($role->name); ?>" >
									</div>
								<div class="row">
										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage Categories" <?php echo e(in_array('Manage Categories',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage Categories')); ?>

										</div>
										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage Products" <?php echo e(in_array('Manage Products',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage Products')); ?>

										</div>

										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage Orders" <?php echo e(in_array('Manage Orders',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage Orders')); ?>

										</div>
										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Transactions" <?php echo e(in_array('Transactions',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Transactions')); ?>

										</div>

										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Ecommerce" <?php echo e(in_array('Ecommerce',$section) ? 'checked' : ''); ?> id=""> Ecommerce
										</div>

										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Customer List" <?php echo e(in_array('Customer List',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Customer List')); ?>

										</div>

										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manages Tickets" <?php echo e(in_array('Manages Tickets',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manages Tickets')); ?>

										</div>
										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage Site" <?php echo e(in_array('Manage Site',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage Site')); ?>

										</div>

										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage Faqs Contents" <?php echo e(in_array('Manage Faqs Contents',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage Faqs Contents')); ?>

										</div>
										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage Blogs" <?php echo e(in_array('Manage Blogs',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage Blogs')); ?>

										</div>
	
										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manages Pages" <?php echo e(in_array('Manages Pages',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manages Pages')); ?>

										</div>


										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Subscribers List" <?php echo e(in_array('Subscribers List',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Subscribers List')); ?>

										</div>

										<div class="col-md-4 my-3">
											<input type="checkbox" name="section[]" value="Manage System User" <?php echo e(in_array('Manage System User',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('Manage System User')); ?>

										</div>


									<div class="col-md-4 my-3">
										<input type="checkbox" name="section[]" value="System Backup" <?php echo e(in_array('System Backup',$section) ? 'checked' : ''); ?> id=""> <?php echo e(__('System Backup')); ?>

									</div>

								<div class="form-group">
										<button type="submit"
											class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
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

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/role/edit.blade.php ENDPATH**/ ?>