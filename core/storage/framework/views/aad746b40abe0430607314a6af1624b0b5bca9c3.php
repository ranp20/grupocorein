<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td><?php echo e($data->id); ?></td>
  <td><?php echo e($data->provincia_code); ?></td>
  <td><?php echo e($data->provincia_name); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/provincia/table.blade.php ENDPATH**/ ?>