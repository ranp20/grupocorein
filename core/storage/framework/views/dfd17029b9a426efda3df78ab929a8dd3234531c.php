<?php $__env->startSection('title'); ?>
  <?php echo e(__('Compare')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
<meta name="description" content="<?php echo e($setting->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Compare Products')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="card">
    <div class="card-body">
      <div class="comparison-table">
        <table class="table table-bordered">
          <tbody>
            <?php if(count($items) > 0): ?>
              <tr class="bg-secondary">
                <th class="text-uppercase"><?php echo e(__('Summary')); ?></th>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td><span class="text-medium"><?php echo e($item->name); ?></span></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tr>
              <?php if(count($items) != 1): ?>
                <tr>
                  <td>
                    <h6><?php echo e($items[0]->name); ?></h6>
                    <p>
                      <b><?php echo e(__('Brand')); ?></b> :  <?php echo e($items[0]->brand->name); ?> , <b><?php echo e(__('Price')); ?></b> :  <?php echo e(PriceHelper::grandCurrencyPrice($items[0])); ?>

                    </p>
                    <hr>
                    <h6 class="mt-2"><?php echo e($items[1]->name); ?></h6>
                    <p>
                      <b><?php echo e(__('Brand')); ?></b> :  <?php echo e($items[1]->brand->name); ?> , <b><?php echo e(__('Price')); ?></b> :  <?php echo e(PriceHelper::grandCurrencyPrice($items[1])); ?>

                    </p>
                  </td>
                  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <td>
                    <div class="comparison-item"><span class="remove-item compare_remove" data-href="<?php echo e(route('front.compare.remove',$item->id)); ?>"><i class="icon-x"></i></span><a class="comparison-item-thumb" href="<?php echo e(route('front.product',$item->slug)); ?>"><img src="<?php echo e(asset('assets/images/'.$item->thumbnail)); ?>" alt="Image"></a><a class="comparison-item-title" href="<?php echo e(route('front.product',$item->slug)); ?>"><?php echo e($item->name); ?></a><a class="btn btn-outline-primary btn-sm add_to_single_cart" href="javascript:;"  data-target="<?php echo e($item->id); ?>" ><?php echo e(__('Add to Cart')); ?></a></div>
                  </td>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
                <?php
                  // dd($sname,$sdesc)
                ?>
                <?php $__currentLoopData = $sname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($name); ?></th>
                  <td>
                    <?php if($items[0]->specification_name): ?>
                      <?php if(in_array($name,json_decode($items[0]->specification_name,true))): ?>
                        <?php if(isset($sdesc[0][$key])): ?>
                          <?php echo e($sdesc[0][$key]); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($items[1]->specification_name): ?>
                      <?php if(in_array($name,json_decode($items[1]->specification_name,true))): ?>
                        <?php if(isset($sdesc[1][$key])): ?>
                          <?php echo e($sdesc[1][$key]); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                <tr>
                  <h4><?php echo e($items[0]->name); ?></h4>
                  <p>
                    <b><?php echo e(__('Brand')); ?></b> :  <?php echo e($items[0]->brand->name); ?> , 
                    <b><?php echo e(__('Price')); ?></b> :  <?php echo e(PriceHelper::grandCurrencyPrice($items[0])); ?>

                  </p>
                  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <td>
                    <div class="comparison-item">
                      <span class="remove-item compare_remove" data-href="<?php echo e(route('front.compare.remove',$item->id)); ?>">
                        <i class="icon-x"></i>
                      </span>
                      <a class="comparison-item-thumb" href="<?php echo e(route('front.product',$item->slug)); ?>">
                        <img src="<?php echo e(asset('assets/images/'.$item->thumbnail)); ?>" alt="Image">
                      </a>
                      <a class="comparison-item-title" href="<?php echo e(route('front.product',$item->slug)); ?>"><?php echo e($item->name); ?></a>
                      <a class="btn btn-outline-primary btn-sm add_to_single_cart" href="javascript:;"  data-target="<?php echo e($item->id); ?>" ><?php echo e(__('Add to Cart')); ?></a>
                    </div>
                  </td>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
                <?php $__currentLoopData = $sname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($items[0]->specification_name): ?>
                  <tr>
                    <th><?php echo e($name); ?></th>
                    <td>
                      <?php if(in_array($name,json_decode($items[0]->specification_name,true))): ?>
                        <?php if(isset($sdesc[0][$key])): ?>
                        <?php echo e($sdesc[0][$key]); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              <tr>
                <th></th>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td>
                  <a class="btn btn-outline-primary btn-sm btn-block add_to_single_cart" href="javascript:;" data-target="<?php echo e($item->id); ?>"><?php echo e(__('Add to Cart')); ?></a>
                </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tr>
            <?php else: ?>
              <tr>
                <td class="text-center"><strong><?php echo e(__('Product not found')); ?></strong></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/compare.blade.php ENDPATH**/ ?>