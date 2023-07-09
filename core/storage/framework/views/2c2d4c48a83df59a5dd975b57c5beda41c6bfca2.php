<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b><?php echo e(__('All Quotation')); ?></b></h3>
				<a class="btn btn-primary  btn-sm" href="<?php echo e(route('back.quotation.create')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>
			</div>
		</div>
	</div>
  <input type="hidden" id="product_url" value="<?php echo e(route('back.quotation.index')); ?>">
	<div class="card shadow mb-4">
		<div class="card-body">
      <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="quotation-table" width="100%" cellspacing="0">
					<thead>
						<tr>
              <th><?php echo e(__('#')); ?></th>
              <th><?php echo e(__('Distrito_code')); ?></th>
              <th><?php echo e(__('Distrito_n')); ?></th>
              <th><?php echo e(__('Provincia_code')); ?></th>
              <th><?php echo e(__('Provincia_n')); ?></th>
              <th><?php echo e(__('Departamento_code')); ?></th>
              <th><?php echo e(__('Departamento_n')); ?></th>
              <th><?php echo e(__('Amount (Delivery)')); ?></th>
              <th><?php echo e(__('Amount equal to or greater than')); ?> S/1,600</th>
						</tr>
					</thead>
					<tbody>
            <?php echo $__env->make('back.quotation.table',compact('datas'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/core/jquery.3.6.0.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/plugin/datatables/datatables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/plugin/datatables/dataTables.bootstrap5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/quotation.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/quotation/index.blade.php ENDPATH**/ ?>