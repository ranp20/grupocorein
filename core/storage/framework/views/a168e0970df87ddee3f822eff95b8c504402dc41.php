<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td><?php echo e($data->id); ?></td>
  <td><?php echo e($data->name); ?></td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm " href="<?php echo e(route('back.attributeroot.edit',$data->id)); ?>">
        <i class="fas fa-edit"></i>
      </a>
      <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="<?php echo e(route('back.attributeroot.destroy',$data->id)); ?>">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/attributeroot/table.blade.php ENDPATH**/ ?>