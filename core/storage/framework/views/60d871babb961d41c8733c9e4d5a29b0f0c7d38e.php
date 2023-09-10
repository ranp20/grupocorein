<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td><?php echo e($data->name); ?></td>
  <td>
    <a href="<?php echo e($data->photo ? asset('assets/images/catalog/'.$data->photo) : asset('assets/images/placeholder.png')); ?>" target="_blank">
      <img src="<?php echo e($data->photo ? asset('assets/images/catalog/'.$data->photo) : asset('assets/images/placeholder.png')); ?>" alt="Image Not Found">
    </a>
  </td>
  <td>
    <div class="dropdown">
      <button class="btn btn-<?php echo e($data->status == 1 ? 'success' : 'danger'); ?> btn-sm btn-rounded dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e($data->status == 1 ? __('Enabled') : __('Disabled')); ?>

      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?php echo e(route('back.catalog.status',[$data->id,1])); ?>"><?php echo e(__('Enable')); ?></a>
        <a class="dropdown-item" href="<?php echo e(route('back.catalog.status',[$data->id,0])); ?>"><?php echo e(__('Disable')); ?></a>
      </div>
    </div>
  </td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm btn-rounded" href="<?php echo e(route('back.catalog.edit',$data->id)); ?>">
        <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

      </a>
      <a class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="<?php echo e(route('back.catalog.destroy',$data->id)); ?>">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/catalog/table.blade.php ENDPATH**/ ?>