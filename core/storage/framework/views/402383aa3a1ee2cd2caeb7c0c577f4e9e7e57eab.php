<?php $__env->startSection('content'); ?>

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 bc-title"><b><?php echo e(__('Update Blog')); ?></b> </h3>
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('back.post.index')); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-12">
								<form class="admin-form" action="<?php echo e(route('back.post.update',$post->id)); ?>"
									method="POST" enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('PUT'); ?>

									<?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

									<h5 class="">
                                        <b><?php echo e(__('Multiple Images Uploading Are Allowed')); ?></b>
                                    </h5>

                                    <br>

                                    <div class="d-block">

                                        <?php $__empty_1 = true; $__currentLoopData = json_decode($post->photo,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="single-g-item d-inline-block m-2">
                                                    <span data-toggle="modal"
                                                    data-target="#confirm-delete" href="javascript:;"
                                                    data-href="<?php echo e(route('back.post.photo.delete',[$key,$post->id])); ?>" class="remove-gallery-img">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <a class="popup-link" href="<?php echo e($photo ? asset('assets/images/'.$photo) : asset('assets/images/placeholder.png')); ?>">
                                                        <img class="admin-gallery-img" src="<?php echo e($photo ? asset('assets/images/'.$photo) : asset('assets/images/placeholder.png')); ?>"
                                                            alt="No Image Found">
                                                    </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                            <h6><b><?php echo e(__('No Images Added')); ?></b></h6>

                                        <?php endif; ?>

                                    </div>


                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file"  accept="image/*"  name="photo[]" id="file"
                                                aria-label="File browser example" accept="image/*" multiple>
                                            <span class="file-custom text-left"><?php echo e(__('Upload Images...')); ?></span>
                                        </label>
                                    </div>
									<div class="form-group">
										<label for="title"><?php echo e(__('Title')); ?> *</label>
										<input type="text" name="title" class="form-control" id="title"
											placeholder="<?php echo e(__('Enter Title')); ?>" value="<?php echo e($post->title); ?>" >
									</div>

									<div class="form-group">
										<label for="category_id"><?php echo e(__('Select Category')); ?> *</label>
										<select name="category_id" id="category_id" class="form-control" >
											<option value="" selected disabled><?php echo e(__('Select Category')); ?></option>
											<?php $__currentLoopData = DB::table('bcategories')->whereStatus(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($category->id); ?>" <?php echo e($post->category_id == $category->id ? 'selected' : ''); ?> ><?php echo e($category->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>

									<div class="form-group">
										<label for="details"><?php echo e(__('Details')); ?> *</label>
										<textarea name="details" id="details" class="form-control text-editor" rows="5"
											placeholder="<?php echo e(__('Enter Details')); ?>"
											><?php echo e($post->details); ?></textarea>
									</div>

									<div class="form-group">
										<label for="tags"><?php echo e(__('Tags')); ?>

											</label>
										<input type="text" name="tags" class="tags"
											id="tags"
											placeholder="<?php echo e(__('Tags')); ?>"
											value="<?php echo e($post->tags); ?>">
									</div>

									<div class="form-group">
										<label for="meta_keywords"><?php echo e(__('Meta Keywords')); ?>

											</label>
										<input type="text" name="meta_keywords" class="tags"
											id="meta_keywords"
											placeholder="<?php echo e(__('Enter Meta Keywords')); ?>"
											value="<?php echo e($post->meta_keywords); ?>">
									</div>

									<div class="form-group">
										<label
											for="meta_description"><?php echo e(__('Meta Description')); ?>

											</label>
										<textarea name="meta_descriptions" id="meta_descriptions"
											class="form-control" rows="5"
											placeholder="<?php echo e(__('Enter Meta Description')); ?>"
										><?php echo e($post->meta_descriptions); ?></textarea>
									</div>

								    <div class="form-group">
										<button type="submit"
											class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
									</div>
								</form>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Confirm Delete?')); ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			<?php echo e(__('You are going to delete this image from gallery.')); ?> <?php echo e(__('Do you want to delete it?')); ?>

		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
			<form action="" class="d-inline btn-ok" method="POST">

                <?php echo csrf_field(); ?>

                <?php echo method_field('DELETE'); ?>

                <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>

			</form>
		</div>

      </div>
    </div>
  </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/post/edit.blade.php ENDPATH**/ ?>