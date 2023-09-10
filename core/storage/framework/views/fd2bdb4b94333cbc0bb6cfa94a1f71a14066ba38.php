<?php $__env->startSection('content'); ?>

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b><?php echo e(__('Manage Blogs')); ?></b> </h3>

                <div class="right">
                  <a class="btn btn-primary  btn-sm" href="<?php echo e(route('back.post.create')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>
                    <form class="d-inline-block" action="<?php echo e(route('back.bulk.delete')); ?>" method="get">
                      <input type="hidden" value="" name="ids[]" id="bulk_delete">
                      <input type="hidden" value="posts" name="table">
                      <button class="btn btn-danger btn-sm"><?php echo e(__('Delete')); ?></button>
                    </form>
                </div>
              </div>

        </div>
    </div>

	<!-- DataTales -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">

					<thead>
						<tr>
                            <th> <input type="checkbox" data-target="blog-bulk-delete" class="form-control bulk_all_delete"> </th>
                            <th><?php echo e(__('Image')); ?></th>
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('Category')); ?></th>
							<th><?php echo e(__('Actions')); ?></th>
						</tr>
					</thead>

					<tbody>
              <?php echo $__env->make('back.post.table',compact('datas'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>

</div>

</div>
<!-- End of Main Content -->



  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel"><?php echo e(__('Confirm Delete?')); ?></h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			<?php echo e(__('You are going to delete this post. All contents related with this post will be lost.')); ?> <?php echo e(__('Do you want to delete it?')); ?>

		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
			<form action="" class="d-inline btn-ok" method="POST">

                <?php echo csrf_field(); ?>

                <?php echo method_field('DELETE'); ?>

                <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>

			</form>
		</div>

      </div>
    </div>
  </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/post/index.blade.php ENDPATH**/ ?>