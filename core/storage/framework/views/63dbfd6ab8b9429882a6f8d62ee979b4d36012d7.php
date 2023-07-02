<?php $__env->startSection('content'); ?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-0 bc-title"><b><?php echo e(__('Product CSV Import & Export')); ?></b> </h3>
            <a class="btn btn-primary  btn-sm" href="<?php echo e(route('back.item.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Go Items')); ?></a>
        </div>
    </div>
</div>

<!-- Form -->
<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12">

    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body pt4">
            <!-- Nested Row within Card Body -->
            <div class="row text-center">
                <div class="col-lg-12">
                    <form class="admin-form tab-form" action="<?php echo e(route('back.csv.import')); ?>" method="POST"enctype="multipart/form-data">
                        <input type="hidden" value="normal" name="item_type">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-left">
                                    <a class="btn btn-info btn-sm" href="<?php echo e(route('back.csv.export')); ?>"><?php echo e(__('Products CSV Export')); ?></a>
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-info btn-sm" href="<?php echo e(asset('assets/test_csv_file.csv')); ?>" download><?php echo e(__('Simple Csv Download')); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                               
                                <div class="form-group position-relative ">
                                    <label for="file"><?php echo e(__('Uplaod Your CSV File')); ?></label>
                                    <input type="file"  accept="csv" class="form-control" name="csv"
                                    id="file"  >
                             
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
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

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/item/bulk-upload.blade.php ENDPATH**/ ?>