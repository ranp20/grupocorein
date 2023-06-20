<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$newMinAmount = number_format($data->min_amount);
?>
<tr>
  <td><?php echo e($data->id); ?></td>
  <td><?php echo e($data->distrito_code); ?></td>
  <td><?php echo e($data->distrito_nombre); ?></td>
  <td><?php echo e($data->provincia_code); ?></td>
  <td><?php echo e($data->provincia_nombre); ?></td>
  <td><?php echo e($data->departamento_code); ?></td>
  <td><?php echo e($data->departamento_nombre); ?></td>
  <td><?php echo e(PriceHelper::adminCurrencyPrice($newMinAmount)); ?></td>
  <td><?php echo e($data->max_amount); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/quotation/table.blade.php ENDPATH**/ ?>