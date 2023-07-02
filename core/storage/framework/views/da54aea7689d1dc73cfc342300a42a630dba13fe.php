<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>
            <?php echo e($data->name); ?>

        </td>
        <td>
            <?php echo e($data->attribute); ?>

        </td>
        <td>
            <?php echo e($data->price == 0 ? __('Free') : PriceHelper::adminCurrencyPrice($data->price)); ?>

        </td>
        <td class="<?php echo e($data->stock < 10 && $data->stock != 'unlimited' ? 'bg-danger text-white'  :''); ?> ">
            <?php if($data->stock == '0'): ?>
            <?php echo e(__('Out of Stock')); ?>

            <?php else: ?>
            <?php echo e($data->stock); ?>

            <?php endif; ?>
        </td>
        <td>
            <div class="action-list">
                <a class="btn btn-secondary btn-sm "
                    href="<?php echo e(route('back.option.edit',[$item->id, $data->id])); ?>">
                    <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

                </a>
                <a class="btn btn-danger btn-sm " data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="<?php echo e(route('back.option.destroy',[$item->id, $data->id])); ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/item/attribute_option/table.blade.php ENDPATH**/ ?>