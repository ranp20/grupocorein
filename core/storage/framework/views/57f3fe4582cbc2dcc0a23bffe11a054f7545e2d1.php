
<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <?php echo e($data->user->displayName()); ?>

    </td>

    <td>
        <a href="<?php echo e(route('front.product',$data->item->slug)); ?>"><?php echo e($data->item->name); ?></a>
    </td>
    <td>
        <?php echo e($data->rating); ?>

    </td>
    <td>
        <div class="dropdown">
            <button class="btn btn-<?php echo e($data->status == 1 ? 'success' : 'danger'); ?> btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo e($data->status == 1 ? __('Enabled') : __('Disabled')); ?>

            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?php echo e(route('back.review.status',[$data->id,1])); ?>"><?php echo e(__('Enable')); ?></a>
              <a class="dropdown-item" href="<?php echo e(route('back.review.status',[$data->id,0])); ?>"><?php echo e(__('Disable')); ?></a>
            </div>
          </div>

        </div>
    </td>
    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="<?php echo e(route('back.review.show',$data->id)); ?>">
                <i class="fas fa-eye"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="<?php echo e(route('back.review.destroy',$data->id)); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/review/table.blade.php ENDPATH**/ ?>