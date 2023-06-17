<?php
function formatPhone($phone){
	$output_phone = "";
  $output_phone = preg_replace('/(\d{1,3})(?=(\d{3})+$)/', '$1 ', $phone);
	return $output_phone;
}
?>

<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
<meta name="description" content="<?php echo e($setting->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
  <?php echo e(__('Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Contact Us')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
  <div class="container padding-bottom-3x mb-1 contact-page">
    <div class="row">
      <div class="col-lg-4 col-md-5 col-sm-5 order-lg-1 order-md-2 order-sm-2">
        <section class="widget widget-featured-posts card rounded p-4 ">
          <h3 class="widget-title padding-bottom-1x"><?php echo e(__('Working Days')); ?></h3>
          <ul class="list-unstyled text-sm">
            <li><span class="text-muted"><?php echo e(__('Monday-Friday')); ?>:</span><?php echo e($setting->friday_start); ?> - <?php echo e($setting->friday_end); ?></li>
            <li><span class="text-muted"><?php echo e(__('Saturday')); ?>:</span><?php echo e($setting->satureday_start); ?> - <?php echo e($setting->satureday_end); ?></li>
          </ul>          
        </section>
        <section class="widget widget-featured-posts card rounded p-4">
          <h3 class="widget-title padding-bottom-1x"><?php echo e(__('Store address')); ?></h3>
          <p><?php echo e(__('Our address information')); ?></p>
          <ul class="list-icon margin-bottom-1x">
            <li><i class="icon-map-pin text-muted"></i><?php echo e($setting->footer_address); ?></li>
            <li><i class="icon-phone text-muted"></i><?php echo e(formatPhone($setting->footer_phone)); ?></li>
          </ul>
          <?php
          $links = json_decode($setting->social_link,true)['links'];
          $icons = json_decode($setting->social_link,true)['icons'];
          ?>
          <div>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="social-button shape-circle sb-facebook" href="<?php echo e($link); ?>" data-toggle="tooltip" data-placement="top"><i class="<?php echo e($icons[$link_key]); ?>"></i></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </section>
      </div>
      <div class="col-lg-8 col-md-7 col-sm-7 order-lg-2 order-md-1 order-sm-1">
        <div class="contact-form-box card">
          <h2 class="h4"><?php echo e(__('Tell Us Your Message :')); ?></h2>
          <form class="row mt-2" method="Post" action="<?php echo e(route('front.contact.submit')); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-md-6">
              <div class="form-group">
                <label for="first-name"><?php echo e(__('First Name')); ?></label>
                <input class="form-control form-control-rounded" name="first_name" type="text" id="first-name" placeholder="<?php echo e(__('First Name')); ?>" >
                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="last-name"><?php echo e(__('Last Name')); ?></label>
                <input class="form-control form-control-rounded" name="last_name" type="text" id="last-name" placeholder="<?php echo e(__('Last Name')); ?>" >
                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contact-email"><?php echo e(__('E-mail')); ?></label>
                <input class="form-control form-control-rounded" type="email" name="email" id="contact-email" placeholder="<?php echo e(__('E-mail')); ?>" >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contact-tel"><?php echo e(__('Phone')); ?></label>
                <input class="form-control form-control-rounded" type="text" name="phone" id="contact-tel" placeholder="<?php echo e(__('Phone')); ?>" >
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-12  ">
              <div class="form-group">
                <label for="message-text"><?php echo e(__('Message')); ?></label>
                <textarea class="form-control form-control-rounded" rows="9" name="message" id="message-text" placeholder="<?php echo e(__('Write your message here...')); ?>"></textarea>
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <?php if($setting->recaptcha == 1): ?>
            <div class="col-lg-12 mb-4">
                <?php echo NoCaptcha::renderJs(); ?>

                <?php echo NoCaptcha::display(); ?>

                <?php if($errors->has('g-recaptcha-response')): ?>
                <?php
                    $errmsg = $errors->first('g-recaptcha-response');
                ?>
                <p class="text-danger mb-0"><?php echo e(__("$errmsg")); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="col-12 text-right">
              <button class="btn btn-primary" type="submit"><span><?php echo e(__('Send message')); ?></span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
 <div class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-lg-12"> 
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="container">
                  <p class = "text"></p>
                  <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'coding', 'arrow1')" id="defaultOpen">
                      <img src="https://grupopdg.com/web/assets/images/1669243349tienda.png">  Av. Guillermo  Dansey N°401 C.Plaza ferretero  2do  psj C  Piso Tda 2026 - Lima.
                      <span id="arrow1" class="arrow fas fa-caret-right"></span>
                    </button>
                    <button class="tablinks" onclick="openTab(event, 'wordPress', 'arrow2')">
                      <img src="https://grupopdg.com/web/assets/images/1669243349tienda.png">  AV. Guillermo Dansey n° 454 C. Comercial Nicolini Psj 5 Stand BB-9A - Lima.
                      <span id="arrow1" class="arrow fas fa-caret-right"></span>
                    </button>
                  </div>
                  <div id="coding" class="tabcontent">
                    <p><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15607.907343172143!2d-77.0450926!3d-12.0451147!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6295b8295e8e7a78!2zQ09SRUlOSk0gUy4g0JAuINChLg!5e0!3m2!1ses-419!2spe!4v1669766173402!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                  </div>
                  <div id="wordPress" class="tabcontent">
                    <p><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15607.902710465167!2d-77.0444584!3d-12.0451944!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4064839cd20cd011!2sCOREIN%20GROUP%20SAC!5e0!3m2!1ses-419!2spe!4v1669765979814!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div> 
  </div>
<script>
function openTab(evt, Services, arrows) {
  var i, tabcontent, tablinks, tabArrow;
  tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tabArrow = document.getElementsByClassName("arrow");
    for (i = 0; i < tabArrow.length; i++) {
    tabArrow[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(arrows).style.display = "block";
  document.getElementById(Services).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/contact.blade.php ENDPATH**/ ?>