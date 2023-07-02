<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/back/css/select2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/back/css/datepicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
    .ds-nonvisible{
        display: none;
        visibility: hidden;
        opacity: 0;
        user-select: none;
    }
</style>
<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b><?php echo e(__('Campaign Offer')); ?></b></h3>
                </div>
        </div>
    </div>

    

	<!-- DataTales -->
	<div class="card shadow mb-4">
		<div class="card-body">
            <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <form action="<?php echo e(route('back.setting.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row">
                    
                    <div class="col-md-5">
                        <div class="form-group product-serch">
                            <label for="name"><?php echo e(__('Campaign Title')); ?> *</label>
                            <input type="text" required class="form-control" name="campaign_title" value="<?php echo e($setting->campaign_title); ?>" placeholder="<?php echo e(__('Campaign Section Title')); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group product-serch">
                            <label for="name"><?php echo e(__('Campaign Last Date Time')); ?> *</label>
                            <input type="text" required class="form-control" name="campaign_end_date" value="<?php echo e($setting->campaign_end_date); ?>" placeholder="<?php echo e(__('Enter Date')); ?>" id="datepicker">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group product-serch">
                            <label for="campaign_status"><?php echo e(__('Status')); ?> *</label>
                            <select name="campaign_status" class="form-control" id="campaign_status">
                                <option value="1" <?php echo e($setting->campaign_status == 1 ? 'selected' : ''); ?> ><?php echo e(__('Publish')); ?></option>
                                <option value="2" <?php echo e($setting->campaign_status == 2 ? 'selected' : ''); ?>><?php echo e(__('Unpublish')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>

    <?php
        //$alldata = json_decode($datas[0], TRUE);
    ?>
    
	<div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="card-title"><?php echo e(__('Product Added for Campaign')); ?></h4>
            <div class="row">
                <form action="<?php echo e(route('back.campaign.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <select id="basic" name="item_id" class="form-control campaignfiltered">
                                 
                                
                                <option value="" disabled selected><?php echo e(__('Select Product')); ?></option>
                                <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" data-sku="<?php echo e($item->sku); ?>" data-sapcode="<?php echo e($item->sap_code); ?>">
                                        <span><?php echo e($item->name); ?></span>
                                        
                                        <span class='ds-nonvisible'>&nbsp;&nbsp; - &nbsp;&nbsp; [ Código de producto: <?php echo e($item->sku); ?> | CÓDIGO SAP: <?php echo e($item->sap_code); ?> ]</span>
                                        
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                
                            </select>
                            <?php $__errorArgs = ['item_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Add To Campaign')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       
		<div class="card-body">

            <table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th><?php echo e(__('Image')); ?></th>
                        <th width="40%"><?php echo e(__('Name')); ?></th>
                        <th><?php echo e(__('Price')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Show Home Page')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php if($items->count() > 0): ?>
                      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><img src="<?php echo e(asset('assets/images/'.$data->item->photo)); ?>" alt=""></td>
                              <td><?php echo e($data->item->name); ?></td>
                              <td> <?php echo e(PriceHelper::adminCurrencyPrice($data->item->discount_price)); ?></td>
                              <td>
                                <div class="dropdown">
                                    <button class="btn btn-<?php echo e($data->status == 1 ? 'success' : 'danger'); ?> btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?php echo e($data->status == 1 ? __('Publish') : __('Unpublish')); ?>

                                    </button>
                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="<?php echo e(route('back.campaign.status',[$data->id,1,'status'])); ?>"><?php echo e(__('Publish')); ?></a>
                                      <a class="dropdown-item" href="<?php echo e(route('back.campaign.status',[$data->id,0,'status'])); ?>"><?php echo e(__('Unpublish')); ?></a>
                                    </div>
                                  </div>
                            </td>
                              <td>
                                <div class="dropdown">
                                    <button class="btn btn-<?php echo e($data->is_feature == 1 ? 'success' : 'danger'); ?> btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?php echo e($data->is_feature == 1 ? __('Active') : __('Deactive')); ?>

                                    </button>
                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="<?php echo e(route('back.campaign.status',[$data->id,1,'is_feature'])); ?>"><?php echo e(__('Active')); ?></a>
                                      <a class="dropdown-item" href="<?php echo e(route('back.campaign.status',[$data->id,0,'is_feature'])); ?>"><?php echo e(__('Deactive')); ?></a>
                                    </div>
                                  </div>
                            </td>
                              <td>
                                <a class="btn btn-danger btn-sm " data-toggle="modal"
                                    data-target="#confirm-delete" href="javascript:;"
                                    data-href="<?php echo e(route('back.campaign.destroy',$data->id)); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <p class="d-block text-center">
                        <?php echo e(__('No Product Found')); ?>

                    </p>
                    <?php endif; ?>
                   
                    
                </tbody>

            </table>
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
			<?php echo e(__('You are going to delete this item. All contents related with this item will be lost.')); ?> <?php echo e(__('Do you want to delete it?')); ?>

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
<?php $__env->startSection('scripts'); ?>
    <script type="" src="<?php echo e(asset('assets/back/js/select2.js')); ?>"></script>
    <script type="text/javascript">
        
        $selectfiltered = $(".campaignfiltered");
        
        $selectfiltered.select2({
            theme: "bootstrap"
        });
        /*
        .on('select2:open', function(){
            var menulist = $(".select2-results__options li");
            $.each(menulist, function(i,e){
                var listitem = $(this).text();
                console.log(listitem);
                listitem.toString().split('//--')[0];
            });
        });
        */
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/item/campaign.blade.php ENDPATH**/ ?>