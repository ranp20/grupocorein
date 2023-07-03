<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class=" mb-0  pl-3"><b><?php echo e(__('Customers Details')); ?></b> </h3>
        <a class="btn btn-primary btn-sm" href="<?php echo e(route('back.user.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
      </div>
    </div>
  </div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
      <form action="<?php echo e(route('back.user.update',$user->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			  <div class="card">
          <div class="card-body">
            <div class="gd-responsive-table">
              <table class="table table-bordered table-striped">
                <tr>
                  <th><?php echo e(__("Names")); ?></th>
                  <td><input type="text" name="first_name" id="first_name" value="<?php echo e($user->first_name); ?>" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th><?php echo e(__("SurNames")); ?></th>
                  <td><input type="text" name="last_name" id="last_name" value="<?php echo e($user->last_name); ?>" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th><?php echo e(__("Email Address")); ?></th>
                  <td><input type="text" name="email" id="email" value="<?php echo e($user->email); ?>" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th><?php echo e(__("Phone Number")); ?></th>
                  <td><input type="text" name="phone" id="phone" value="<?php echo e($user->phone); ?>" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo e($user->id); ?>">
                <tr>
                  <th><?php echo e(__("Password")); ?></th>
                  <td><input type="password" name="password" id="password" placeholder="<?php echo e(__('Password')); ?>" autocomplete="false" value="" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th><?php echo e(__("Total Orders")); ?></th>
                  <td><?php echo e(count($user->orders)); ?></td>
                </tr>
                <?php
                  $notifCreate = \Carbon\Carbon::parse($user->created_at);
                  $notifDate = ucfirst($notifCreate->locale('es_ES')->diffForHumans(null, false, false, 1));
                ?>
                <tr>
                  <th><?php echo e(__("Joined")); ?></th>
                  <td><?php echo e($notifDate); ?></td>
                </tr>
              </table>
              <button type="submit" class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
            </div>
          </div>
        </div>
      </form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/user/show.blade.php ENDPATH**/ ?>