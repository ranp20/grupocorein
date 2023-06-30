<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr id="blog-bulk-delete">
    <td><input type="checkbox" class="bulk-item" value="<?php echo e($data->id); ?>"></td>

  <td>
      <img src="<?php echo e(isset(json_decode($data->photo,true)[0]) ?  asset('assets/images/'.json_decode($data->photo,true)[0]) : asset('assets/images/placeholder.png')); ?>" alt="">

  </td>
    <td>
        <?php echo e($data->title); ?>

    </td>
    <td>
        <?php echo e($data->category->name); ?>

    </td>

    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="<?php echo e(route('back.post.edit',$data->id)); ?>">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="<?php echo e(route('back.post.destroy',$data->id)); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/post/table.blade.php ENDPATH**/ ?>