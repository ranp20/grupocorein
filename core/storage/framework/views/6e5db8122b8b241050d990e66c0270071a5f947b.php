<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <img class="admin-img"
        src="<?php echo e($data->photo ? asset('assets/images/'.$data->photo) : asset('assets/images/placeholder.png')); ?>"
        alt="No Image Found">
    </td>
    <td>
        <?php echo e($data->name); ?>

    </td>
    <td>
        <?php echo e($data->role->name); ?>

    </td>
    <td>
        <?php echo e($data->email); ?>

    </td>
    <td>
        <?php echo e($data->phone); ?>

    </td>

    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="<?php echo e(route('back.staff.edit',$data->id)); ?>">
                <i class="fas fa-eye"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="<?php echo e(route('back.staff.destroy',$data->id)); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/staff/table.blade.php ENDPATH**/ ?>