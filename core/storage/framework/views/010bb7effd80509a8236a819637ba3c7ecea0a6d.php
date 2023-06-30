<?php $__env->startSection('content'); ?>

<div class="container-fluid">

   	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 bc-title"> <b><?php echo e(__('Announcement')); ?></b> </h3>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-12">
							<div class="p-5">
								<div class="admin-form">

									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <div class="row justify-content-center">

                                        <div class="col-lg-8">

                                            <form action="<?php echo e(route('back.setting.update')); ?>" method="POST"
                                            enctype="multipart/form-data">

                                            <?php echo csrf_field(); ?>


                                                <div class="form-group">
                                                    <label class="switch-primary">
                                                      <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_announcement" value="1" <?php echo e($setting->is_announcement == 1 ? 'checked' : ''); ?>>
                                                      <span class="switch-body"></span>
                                                      <span class="switch-text"><?php echo e(__('Announcement Banner')); ?></span>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <label for="announcement_type"><?php echo e(__('Select Type')); ?> *</label>
                                                    <select name="announcement_type" id="announcement_type" class="form-control" >
                                                        <option value="banner" <?php echo e($setting->announcement_type =='banner' ? 'selected' : ''); ?> ><?php echo e(__('Announcement')); ?></option>
                                                        <option value="newletter" <?php echo e($setting->announcement_type =='newletter' ? 'selected' : ''); ?>><?php echo e(__('Newsletter Popup')); ?></option>
                                                    </select>
                                                </div>

                                                <div class="image-show <?php echo e($setting->is_announcement == 1 ? '' : 'd-none'); ?>">

                                                    <div class="form-group">
                                                        <label for="name"><?php echo e(__('Image')); ?></label>
                                                        <div class="col-lg-12 pb-1">
                                                            <img class="admin-img lg"
                                                                src="<?php echo e($setting->announcement ? asset('assets/images/'.$setting->announcement) : asset('assets/images/placeholder.png')); ?>"
                                                                alt="No Image Found">
                                                        </div>
                                                        <span><?php echo e(__('Image Size Should Be 520 x 529. For Announcement Popuop')); ?></span> <br>
                                                        <span><?php echo e(__('Image Size Should Be 300 x 400. For Newsletter Popuop')); ?></span>
                                                    </div>

                                                    <div class="form-group position-relative ">
                                                        <label class="file">
                                                            <input type="file"  accept="image/*"  class="upload-photo" name="announcement" id="file" aria-label="File browser example">
                                                            <span class="file-custom text-left"><?php echo e(__('Upload Image...')); ?></span>
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="announcement_delay"><?php echo e(__('Announcement Delay (secend)')); ?> *</label>
                                                        <input type="text" name="announcement_delay" class="form-control" id="announcement_delay"
                                                            placeholder="<?php echo e(__('Announcement Delay')); ?>" value="<?php echo e($setting->announcement_delay); ?>" >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="announcement_title"><?php echo e(__('Newsletter Title')); ?> *</label>
                                                        <input type="text" name="announcement_title" class="form-control" id="announcement_title"
                                                            placeholder="<?php echo e(__('Popup Title')); ?>" value="<?php echo e($setting->announcement_title); ?>" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="announcement_details"><?php echo e(__('Newsletter Text')); ?> *</label>
                                                        <textarea name="announcement_details" class="form-control" id="announcement_details" ><?php echo e($setting->announcement_details); ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="announcement_link"><?php echo e(__('Announcement Link')); ?> *</label>
                                                        <input type="text" name="announcement_link" class="form-control" id="announcement_link"
                                                            placeholder="<?php echo e(__('Link')); ?>" value="<?php echo e($setting->announcement_link); ?>" >
                                                    </div>

                                                </div>



                                                <div>

                                                    <div class="form-group d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/settings/announcement.blade.php ENDPATH**/ ?>