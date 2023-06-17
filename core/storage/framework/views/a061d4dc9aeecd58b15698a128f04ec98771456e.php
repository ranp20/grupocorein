<?php $__env->startSection('title'); ?>
  <?php echo e(__('Blog')); ?>

<?php $__env->stopSection(); ?>
<?php
function cambiaf_mysql($date){
  $originalDate = $date;
  setlocale(LC_ALL,"es_ES");
  date_default_timezone_set('America/Lima');
	
  $newDateFormat = date("F j, Y", strtotime($originalDate));
  
  /*
  $newDate = date_create_from_format("d/m/Y", $date);
  $newDateFormat = strftime("%A",$newDate->getTimestamp());
  */
  /*
  $newDateFormat = date('F', mktime(0, 0, 0, $date));
  */
  return $newDateFormat;
}
?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Blog')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1 blog-page">
  <div class="row ">
    <div class="col-xl-9 col-lg-8 order-lg-2">
      <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-md-6">
            <a href="<?php echo e(route('front.blog.details',$post->slug)); ?>" class="blog-post">
              <div class="post-thumb">
                <img class="lazy" data-src="<?php echo e(asset('assets/images/' . json_decode($post->photo, true)[array_key_first(json_decode($post->photo, true))])); ?>" alt="Blog Post">
              </div>
              <div class="post-body">
                <h3 class="post-title"> <?php echo e(strlen(strip_tags($post->title)) > 55 ? substr(strip_tags($post->title), 0, 55) : strip_tags($post->title)); ?></h3>
                <ul class="post-meta">
                  <li><i class="icon-user"></i><?php echo e(__('SiteProyectName')); ?></li>
                  <li><i class="icon-clock"></i><?php echo e(cambiaf_mysql($post->created_at)); ?></li>
                </ul>
                <p><?php echo e(strlen(strip_tags($post->details)) > 120 ? substr(strip_tags($post->details), 0, 120) : strip_tags($post->details)); ?>

                </p>
              </div>
            </a>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body text-center">
                <?php echo e(__('No Data Found')); ?>

              </div>
            </div>
          </div>
          <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-lg-12 text-center">
          <?php echo e($posts->links()); ?>

        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-4 order-lg-1">
      <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
      <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
        <section class="widget">
          <form action="<?php echo e(route('front.blog')); ?>" class="input-group form-group" method="get"><span class="input-group-btn">
            <button type="submit"><i class="icon-search"></i></button></span>
            <input class="form-control" name="search" type="text" placeholder="<?php echo e(__('Search blog')); ?>">
          </form>
        </section>
        <section class="widget widget-categories card rounded p-4 mt-n3">
          <h3 class="widget-title"><?php echo e(__('Blog Categories')); ?></h3>
          <ul>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(route('front.blog').'?category='.$category->slug); ?>"><?php echo e($category->name); ?></a><span><?php echo e($category->posts_count); ?></span></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </section>
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title"><?php echo e(__('Most Recent Added Posts')); ?></h3>
          <?php $__currentLoopData = $recent_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="entry">
          <div class="entry-thumb"><a href="<?php echo e(route('front.blog.details',$recent->slug)); ?>"><img src="<?php echo e(asset('assets/images/'.json_decode($recent->photo,true)[array_key_first(json_decode($recent->photo,true))])); ?>" alt="Post"></a></div>
          <div class="entry-content">
            <h4 class="entry-title"><a href="<?php echo e(route('front.blog.details',$recent->slug)); ?>">
              <?php echo e(strlen(strip_tags($recent->title)) > 55 ? substr(strip_tags($recent->title), 0, 55) . '...' : strip_tags($recent->title)); ?>

              </a>
            </h4>
            <span class="entry-meta"><?php echo e(__('By')); ?> <?php echo e(__('SiteProyectName')); ?></span>
          </div>
        </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title"><?php echo e(__('Popular Tags')); ?></h3>
          <div>
          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a class="tag" href="<?php echo e(route('front.blog').'?tag='.$tag); ?>"><?php echo e($tag); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </section>
      </aside>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/blog/index.blade.php ENDPATH**/ ?>