<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td>
    <?php echo e($data->first_name); ?> <?php echo e($data->last_name); ?>

  </td>
  <td>
    <?php echo e($data->email); ?>

  </td>
  <td>
    <?php echo e($data->phone); ?>

  </td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm" href="<?php echo e(route('back.user.show',$data->id)); ?>">
        <i class="fas fa-eye"></i>
      </a>
      
    </div>
  </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/user/table.blade.php ENDPATH**/ ?>