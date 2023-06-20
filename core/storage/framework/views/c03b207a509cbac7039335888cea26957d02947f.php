<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 bc-title"><b><?php echo e(__('Add Quotation')); ?></b> </h3>
        <a class="btn btn-primary   btn-sm" href="<?php echo e(route('back.quotation.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
  <form class="admin-form tab-form" action="<?php echo e(route('back.quotation.store')); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="normal" name="item_type">
    <?php echo csrf_field(); ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group pb-0  mb-0">
              <label class="d-block"><?php echo e(__('Import Excel')); ?> *</label>
            </div>
            <div class="form-group position-relative">
              <label class="file">
                <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="upload-photo" name="spreadsheet" id="file" aria-label="File browser example" required>
                <span class="file-custom text-left"><?php echo e(__('Upload Excel...')); ?></span>
              </label>
              <br>
              <span class="mt-1 text-info"><?php echo e(__('The file size should be a maximum of 5MB')); ?></span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/plugins/jquery-3.7.0.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/quotationspreadsheet.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/quotation/create.blade.php ENDPATH**/ ?>