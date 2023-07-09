

<?php $__env->startSection('content'); ?>

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0bc-title"><b><?php echo e(__('Sitemap')); ?></b></h3>
                <a class="btn btn-primary  btn-sm" href="<?php echo e(route('admin.sitemap.add')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>
                </div>
        </div>
    </div>


	<!-- DataTales -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th scope="col"><?php echo e(__('URL')); ?></th>
                        <th scope="col"><?php echo e(__('File Name')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sitemaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sitemap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($sitemap->sitemap_url); ?></td>
                            <td><?php echo e($sitemap->filename); ?></td>
                            <td>
                                <form class="d-inline-block" action="<?php echo e(route('admin.sitemap.download', $sitemap->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="filename" value="<?php echo e($sitemap->filename); ?>">
                                        <button type="submit" class="btn btn-info btn-sm">
                                        <span class="btn-label">
                                            <i class="fas fa-arrow-alt-circle-down"></i>
                                        </span>
                                        Download
                                        </button>
                                </form>
                                <a class="btn btn-danger btn-sm " data-toggle="modal"
                                    data-target="#confirm-delete" href="javascript:;"
                                    data-href="<?php echo e(route('admin.sitemap.delete',[$sitemap->id])); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    </table>
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
          <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Confirm Delete?')); ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			<?php echo e(__('You are going to delete this page. All contents related with this page will be lost.')); ?> <?php echo e(__('Do you want to delete it?')); ?>

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

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/settings/sitemap/index.blade.php ENDPATH**/ ?>