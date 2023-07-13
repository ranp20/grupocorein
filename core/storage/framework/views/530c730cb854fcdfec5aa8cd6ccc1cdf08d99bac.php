<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class=" mb-0"><b><?php echo e(__('Payment')); ?></b></h3>
      </div>
    </div>
  </div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<div class="row">
            <div class="col-lg-3">
              <div class="nav flex-column m-3 nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                
                <a class="nav-link active" data-toggle="pill" href="#bank"><?php echo e(__('Bank Transfer')); ?></a>
                <a class="nav-link" data-toggle="pill" href="#izipay"><?php echo e(__('Izipay')); ?></a>
              </div>
            </div>
						<div class="col-lg-9">
							<div class="p-2">
								<div class="admin-form">
									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                    <div id="tabs">
                      <div class="tab-content">
                        
                        <div id="bank" class="container tab-pane active">
                          <div class="row justify-content-center">
                            <div class="col-lg-10">
                              <form action="<?php echo e(route('back.setting.payment.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                  <label class="switch-primary">
                                    <input type="checkbox" class="switch switch-bootstrap " name="status" value="1" <?php echo e($bank->status == 1 ? 'checked' : ''); ?>>
                                    <span class="switch-body"></span>
                                    <span class="switch-text"><?php echo e(__('Display Bank Transfer')); ?></span>
                                  </label>
                                </div>
                                <div class="image-show <?php echo e($bank->status == 1 ? '' : 'd-none'); ?>">
                                  <div class="form-group col-xl-12">
                                    <label for="name"><?php echo e(__('Current Image')); ?></label>
                                    <div class="col-lg-12 pb-1">
                                      <img class="admin-setting-img" src="<?php echo e($bank->photo ? asset('assets/back/images/payment/'.$bank->photo) : asset('assets/images/placeholder.png')); ?>" stripe="No Image Found">
                                    </div>
                                    <span><?php echo e(__('Image Size Should Be 52 x 35.')); ?></span>
                                  </div>
                                  <div class="form-group position-relative col-xl-12">
                                    <label class="file">
                                      <input type="file" class="upload-photo" name="photo" id="file" aria-label="File browser example">
                                      <span class="file-custom text-left"><?php echo e(__('Upload Image...')); ?></span>
                                    </label>
                                  </div>
                                  <div class="form-group">
                                    <label for="name"><?php echo e(__('Enter Name')); ?> *</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo e($bank->name); ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="text"><?php echo e(__('Enter Text')); ?> *</label>
                                    <textarea name="text" id="text" class="form-control text-editor" rows="5" placeholder="<?php echo e(__('Enter Text')); ?>"><?php echo e($bank->text); ?></textarea>
                                  </div>
                                  <input type="hidden" name="unique_keyword" value="bank">
                                </div>
                                <div>
                                  <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-secondary btn-block w-50"><?php echo e(__('Submit')); ?></button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div id="izipay" class="container tab-pane">
                          <div class="row justify-content-center">
                            <div class="col-lg-10">
                              <form action="<?php echo e(route('back.setting.payment.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                  <label class="switch-primary">
                                    <input type="checkbox" class="switch switch-bootstrap " name="status" value="1" <?php echo e($izipay->status == 1 ? 'checked' : ''); ?>>
                                    <span class="switch-body"></span>
                                    <span class="switch-text"><?php echo e(__('Display Izipay')); ?></span>
                                  </label>
                                </div>
                                <div class="image-show <?php echo e($izipay->status == 1 ? '' : 'd-none'); ?>">
                                  <div class="form-group">
                                    <label for="name"><?php echo e(__('Current Image')); ?></label>
                                    <div class="col-lg-12 pb-1">
                                      <img class="admin-setting-img" src="<?php echo e($izipay->photo ? asset('assets/back/images/payment/'.$izipay->photo) : asset('assets/images/placeholder.png')); ?>" alt="No Image Found">
                                    </div>
                                    <span><?php echo e(__('Image Size Should Be 52 x 35.')); ?></span>
                                  </div>
                                  <div class="form-group position-relative col-xl-12">
                                    <label class="file">
                                      <input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file" aria-label="File browser example">
                                      <span class="file-custom text-left"><?php echo e(__('Upload Image...')); ?></span>
                                    </label>
                                  </div>
                                  <div class="form-group">
                                    <label for="name"><?php echo e(__('Enter Name')); ?> *</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo e($izipay->name); ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="text"><?php echo e(__('Enter Text')); ?> *</label>
                                    <textarea name="text" id="text" class="form-control " rows="5" placeholder="<?php echo e(__('Enter Text')); ?>"><?php echo e($izipay->text); ?></textarea>
                                  </div>
                                  <?php
                                    $izipayInfoIndex = array("info" => $izipayData);  
                                    $chck_mode = $izipayInfoIndex['info']['check_mode'];
                                    $chck_credentials = $izipayInfoIndex['info']['credentials'];
                                  ?>                                  
                                  <?php if($chck_mode == 1): ?>
                                    <div class="form-group">
                                      <div class="mid swtchStyl--Rock">
                                      <span class="swtchStyl--Rock__spanTxt pr-2" mod-integration='production' id="txt-sl_chkModAccessMethodPay">Modo producción</span>
                                        <label for="sl_chkModAccessMethodPay" class="rocker rocker-small swtchStyl--Rock__label">
                                          <input type="checkbox" class="swtchStyl--Rock__label__ipt" name="check_mode" checked value="<?php echo e($chck_mode); ?>" id="sl_chkModAccessMethodPay">
                                          <span class="switch-left swtchStyl--Rock__label__spanL">Sí</span>
                                          <span class="switch-right swtchStyl--Rock__label__spanR">No</span>
                                        </label>
                                        <!-- <span class="swtchStyl--Rock__spanTxt pl-2" mod-integration='production' id="txt-sl_chkModAccessMethodPay">Modo producción</span> -->
                                      </div>
                                    </div>
                                  <?php else: ?>
                                  <div class="form-group">
                                    <div class="mid swtchStyl--Rock">
                                      <span class="swtchStyl--Rock__spanTxt pr-2" mod-integration='test' id="txt-sl_chkModAccessMethodPay">Modo producción</span>
                                      <label for="sl_chkModAccessMethodPay" class="rocker rocker-small swtchStyl--Rock__label">
                                        <input type="checkbox" class="swtchStyl--Rock__label__ipt" name="check_mode" value="0" id="sl_chkModAccessMethodPay">
                                        <span class="switch-left swtchStyl--Rock__label__spanL">Sí</span>
                                        <span class="switch-right swtchStyl--Rock__label__spanR">No</span>
                                      </label>
                                      <!-- <span class="swtchStyl--Rock__spanTxt pl-2" mod-integration='test' id="txt-sl_chkModAccessMethodPay">Modo producción</span> -->
                                    </div>
                                  </div>
                                  <?php endif; ?>
                                  <?php $__currentLoopData = $izipayInfoIndex['info']['credentials']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkey => $pdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="c-accessMethodPay__rFa6GBin8 <?php echo e(($chck_mode == 1 && $pkey == 'test') ? 'dc_show' : ''); ?>" id="<?php echo e($pkey); ?>">
                                      <div class="form-group">
                                        <label for="Server_API-REST"><?php echo e(__('Server_API-REST')); ?> - <?php echo e(ucfirst($pkey)); ?> *</label>
                                        <input type="text" class="form-control" name="Server_API-REST[]" id="Server_API-REST" value="<?php echo e($pdata['Server_API-REST']); ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="username"><?php echo e(__('Username')); ?> - <?php echo e(ucfirst($pkey)); ?> *</label>
                                        <input type="text" class="form-control" name="username[]" id="username" value="<?php echo e($pdata['username']); ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="public_key"><?php echo e(__('Pulic Key')); ?> - <?php echo e(ucfirst($pkey)); ?> *</label>
                                        <input type="text" class="form-control" name="public_key[]" id="public_key" value="<?php echo e($pdata['public_key']); ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="token"><?php echo e(__('Token')); ?> - <?php echo e(ucfirst($pkey)); ?> *</label>
                                        <input type="text" class="form-control" name="token[]" id="token" value="<?php echo e($pdata['token']); ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="SHA-256"><?php echo e(__('SHA-256')); ?> - <?php echo e(ucfirst($pkey)); ?> *</label>
                                        <input type="text" class="form-control" name="SHA-256[]" id="SHA-256" value="<?php echo e($pdata['SHA-256']); ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="password"><?php echo e(__('Password')); ?> - <?php echo e(ucfirst($pkey)); ?> *</label>
                                        <input type="text" class="form-control" name="password[]" id="password" value="<?php echo e($pdata['password']); ?>" required>
                                      </div>
                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <input type="hidden" name="unique_keyword" value="izipay">
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
		  </div>
	  </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/back/js/payment.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/settings/payment.blade.php ENDPATH**/ ?>