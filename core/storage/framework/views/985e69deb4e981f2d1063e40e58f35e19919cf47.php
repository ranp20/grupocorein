<?php $__env->startSection('title'); ?>
  <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(__('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Tickets')); ?> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    <?php echo $__env->make('includes.user_sitebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-lg-8">
      <div class="padding-top-2x mt-2 hidden-lg-up"></div>
      <div class="mb-3">
        <div class="card">
          <div class="card-body d-flex flex-row justify-content-between align-items-center">
            <h5 class="mb-0"><?php echo e(__('New Ticket')); ?></h5>
            <a href="<?php echo e(route('user.ticket')); ?>" class="btn btn-primary btn-sm m-0"><span><?php echo e(__('Back')); ?></span></a>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="<?php echo e(route('user.ticket.store')); ?>" method="post" enctype="multipart/form-data" class="contact-form">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="form-group col-lg-12">
                <label for="website"><?php echo e(__('Subject')); ?> *</label>
                <input type="text" class="form-control rounded-0" id="subject" name="subject" value="<?php echo e(old('subject')); ?>" placeholder="<?php echo e(__('Subject')); ?>">
                <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
              <div class="col-12 form-group">
                <label for="inputMessage"><?php echo e(__('Message')); ?> *</label>
                <textarea name="message" class="form-control" rows="6"></textarea>
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="row justify-content-between">
              <div class="col-md-12">
                <label for="inputAttachments" class="font-weight-bold"><?php echo e(__('Attachment')); ?></label>
                <div class="form-group custom-file">
                  <input type="file" name="file" id="customFile" class="form-control custom-file-input" style="line-height:2.3;padding: .375rem .75rem;">
                  <label class="custom-file-label" for="customFile"><?php echo e(__('Choose file')); ?></label>
                  <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div id="fileUploadsContainer"></div>
                <p class="my-2 ticket-attachments-message text-muted"><?php echo e(__('Allowed File Extension: .zip')); ?></p>
              </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
              <button class="btn btn-primary btn-sm" type="submit"><span><?php echo e(__('Submit')); ?></span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/dashboard/ticket-new.blade.php ENDPATH**/ ?>