<?php $__env->startSection('title'); ?>
  <?php echo e(__('Wishlist')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
          <li class="separator"></li>
          <li><?php echo e(__('Wishlist')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    <?php echo $__env->make('includes.user_sitebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="padding-top-2x mt-2 hidden-lg-up"></div>
          <div class="u-table-res wishlist-table mb-0">
            <table class="table table-bordered mb-0">
              <thead>
                <tr>
                  <th><?php echo e(__('Wishlist Product')); ?></th>
                  <?php if($wishlist_items->count() > 0): ?>
                  <th class="text-center"><a class="btn btn-sm btn-primary" href="<?php echo e(route('user.wishlist.delete.all')); ?>"><span><?php echo e(__('Clear Wishlist')); ?></span></a></th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
              <?php if($wishlist_items->count() > 0): ?>
              <?php $__currentLoopData = $wishlist_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <div class="product-item"><a class="product-thumb" href="<?php echo e(route('front.product',$product->slug)); ?>"><img src="<?php echo e(asset('assets/images/'.$product->photo)); ?>" alt="Product"></a>
                    <div class="product-info">
                      <h4 class="product-title"><a href="<?php echo e(route('front.product',$product->slug)); ?>"><?php echo e($product->name); ?></a></h4>
                      <div class="text-lg mb-1"><?php echo e(PriceHelper::grandCurrencyPrice($product)); ?></div>
                      <div class="text-sm"><?php echo e(__('Availability')); ?>:
                        <div class="d-inline text-<?php echo e($product->stock == 0 ? 'danger' : 'success'); ?>"><?php echo e($product->stock == 0 ? __('Out of stock') : __('In Stock')); ?></div>
                      </div>
                    </div>
                  </div>
                  <?php if($product->is_stock()): ?>
                  <a class="product-button btn btn-primary btn-sm add_to_single_cart" href="javascript:;" data-target="<?php echo e($product->id); ?>">
                    <i class="icon-shopping-cart position-relative z-3"></i>
                    <span class="ms-2"><?php echo e(__('To Cart')); ?></span>
                  </a>
                  <?php else: ?>
                  <a class="product-button btn btn-primary btn-sm" href="<?php echo e(route('front.product',$product->slug)); ?>"><i class="icon-arrow-right"></i><span><?php echo e(__('Details')); ?></span></a>
                <?php endif; ?>
                </td>
                <td class="text-center">
                  <a class="remove-from-cart" href="<?php echo e(route('user.wishlist.delete',$product->getWishlistItemId())); ?>" data-toggle="tooltip" title="Remove item"><i class="icon-x"></i>
                  </a>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <tr class="text-center">
                <td colspan="3"><?php echo e(__('No Product Found')); ?></td>
              </tr>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
          <hr class="mb-4">
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/wishlist/index.blade.php ENDPATH**/ ?>