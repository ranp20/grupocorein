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
      <div class="mb-3">
        <div class="card">
          <div class="card-body d-flex flex-row justify-content-between align-items-center">
            <h5 class="mb-0"><?php echo e(__('All Tickets')); ?></h5>
            <a href="<?php echo e(route('user.ticket.create')); ?>" class="btn btn-primary btn-sm"><span><?php echo e(__('Add New')); ?></span></a>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="u-table-res">
            <table class="table table-bordered mb-0">
              <thead>
              <tr>
                <th><?php echo e(__('Subject')); ?> #</th>
                <th><?php echo e(__('Status')); ?></th>
                <th><?php echo e(__('Last Reply')); ?></th>
                <th><?php echo e(__('Action')); ?></th>
              </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo e($ticket->subject); ?></td>
                  <td>
                    <span class="badge badge-primary"><?php echo e($ticket->status); ?></span>
                  </td>
                  <?php if($ticket->lastMessage): ?>
                  <td><?php echo e(\Carbon\Carbon::parse($ticket->lastMessage->created_at)->diffForHumans()); ?></td>
                  <?php else: ?>
                  <td> <?php echo e(__('No Reply')); ?></td>
                  <?php endif; ?>
                  <td>
                    <a class="btn btn-info btn-sm" href="<?php echo e(route('user.ticket.view',$ticket->id)); ?>">
                      <i class="fas fa-eye"> </i> <?php echo e(__('View')); ?>

                    </a>
                    <a class="btn btn-sm btn-danger" href="<?php echo e(route('user.ticket.delete',$ticket->id)); ?>">
                      <i class="fas fa-trash"> </i> <?php echo e(__('Delete')); ?>

                    </a>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="text-center">
                  <td colspan="4"><?php echo e(__('Ticket Not Found')); ?></td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/dashboard/ticket.blade.php ENDPATH**/ ?>