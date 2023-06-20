<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b><?php echo e(__('Distritos')); ?></b></h3>
			</div>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-body">
			<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th><?php echo e(__('#')); ?></th>
							<th><?php echo e(__('Distrito_code')); ?></th>
              <th><?php echo e(__('Distrito_name')); ?></th>
						</tr>
					</thead>
					<tbody>
            <?php echo $__env->make('back.distrito.table',compact('datas'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/distrito/index.blade.php ENDPATH**/ ?>