<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>
            <?php echo e($data->name); ?>

        </td>
        <td>
            <div class="action-list">
                <a class="btn btn-secondary btn-sm "
                    href="<?php echo e(route('back.attribute.edit',[$item->id,$data->id])); ?>">
                    <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

                </a>
                <a class="btn btn-danger btn-sm " data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="<?php echo e(route('back.attribute.destroy',[$item->id,$data->id])); ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
  
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr class="text-center">
    <td colspan="3">
        <a class="btn btn-secondary btn-sm "
        href="<?php echo e(route('back.option.index',$item->id)); ?>">
        <i class="fas fa-tasks"></i> <?php echo e(__('Manage Options')); ?>

    </a>
    </td>
</tr><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/item/attribute/table.blade.php ENDPATH**/ ?>