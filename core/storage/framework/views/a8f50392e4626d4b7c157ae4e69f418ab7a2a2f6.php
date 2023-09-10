<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

    <td>
        <?php echo e($data->name); ?>

    </td>
    <td>
        <?php if($data->section != 'null'): ?>
        <?php $__currentLoopData = json_decode($data->section,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="badge badge-primary m-1 p-2"><?php echo e($item); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        --
        <?php endif; ?>
    </td>

    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="<?php echo e(route('back.role.edit',$data->id)); ?>">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="<?php echo e(route('back.role.destroy',$data->id)); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/role/table.blade.php ENDPATH**/ ?>