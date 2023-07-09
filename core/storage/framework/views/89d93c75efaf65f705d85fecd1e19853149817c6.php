<?php $__env->startSection('content'); ?>

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b><?php echo e(__('Language')); ?></b></h3>
                </div>
        </div>
    </div>

    


    <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


	<!-- DataTales -->
	<div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="card-title"><?php echo e(__('Frontend Translate')); ?></h4>
        </div>
		<div class="card-body">
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped"  width="100%" cellspacing="0">

					<thead>
						<tr>
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Direction')); ?></th>
                            <th><?php echo e(__('Language')); ?></th>
							<th><?php echo e(__('Actions')); ?></th>
						</tr>
					</thead>

					<tbody>
                        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data->type == 'Website'): ?>
                            <tr>
                                <td>
                                    <?php echo e($data->language); ?>

                                </td>
                                <td>
                                    <?php if($data->rtl == 0): ?>
                                        <?php echo e(__('LTR')); ?>

                                    <?php else: ?>
                                        <?php echo e(__('RTL')); ?>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-<?php echo e($data->is_default == 1 ? 'success' : 'danger'); ?> btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e($data->is_default == 1 ? __('Active') : __('Deactive')); ?>

                                        </button>
                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?php echo e(route('back.language.status',[$data->id,1])); ?>"><?php echo e(__('Active')); ?></a>
                                        <a class="dropdown-item" href="<?php echo e(route('back.language.status',[$data->id,0])); ?>"><?php echo e(__('Deactive')); ?></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-list">
                                        <a class="btn btn-secondary btn-sm "
                                            href="<?php echo e(route('back.language.edit',$data->id)); ?>">
                                            <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

                                        </a>

                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="card-title"><?php echo e(__('Dashboard Translate')); ?></h4>
        </div>
		<div class="card-body">
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped"  width="100%" cellspacing="0">

					<thead>
						<tr>
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Direction')); ?></th>
                            <th><?php echo e(__('Language')); ?></th>
							<th><?php echo e(__('Actions')); ?></th>
						</tr>
					</thead>

					<tbody>
                        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data->type == 'Dashboard'): ?>
                            <tr>
                                <td>
                                    <?php echo e($data->language); ?>

                                </td>
                                <td>
                                    <?php if($data->rtl == 0): ?>
                                        <?php echo e(__('LTR')); ?>

                                    <?php else: ?>
                                        <?php echo e(__('RTL')); ?>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-<?php echo e($data->is_default == 1 ? 'success' : 'danger'); ?> btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e($data->is_default == 1 ? __('Active') : __('Deactive')); ?>

                                        </button>
                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?php echo e(route('back.language.status',[$data->id,1])); ?>"><?php echo e(__('Active')); ?></a>
                                        <a class="dropdown-item" href="<?php echo e(route('back.language.status',[$data->id,0])); ?>"><?php echo e(__('Deactive')); ?></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-list">
                                        <a class="btn btn-secondary btn-sm "
                                            href="<?php echo e(route('back.language.edit',$data->id)); ?>">
                                            <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

                                        </a>

                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
          <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Confirm Delete?')); ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			<?php echo e(__('You are going to delete this Currency. All contents related with this Currency will be lost.')); ?> <?php echo e(__('Do you want to delete it?')); ?>

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

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/language/index.blade.php ENDPATH**/ ?>