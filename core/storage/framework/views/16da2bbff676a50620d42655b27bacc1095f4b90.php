<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

    <td>
        <?php echo e($data->title); ?>

    </td>
    <td>
        <?php echo e($data->category->name); ?>

    </td>
    <td>
        <?php echo e($data->details); ?>

    </td>
    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm btn-rounded"
                href="<?php echo e(route('back.faq.edit',$data->id)); ?>">
                <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

            </a>
            <a class="btn btn-danger btn-sm btn-rounded" data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="<?php echo e(route('back.faq.destroy',$data->id)); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/faq/table.blade.php ENDPATH**/ ?>