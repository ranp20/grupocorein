<?php $__env->startSection('title'); ?>
  <?php echo e(__('Address')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Shipping - Billing Address')); ?></li>
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
          <h5><?php echo e(__('Shipping Address')); ?></h5>
          <?php
            $paisData = (isset($user->reg_country_id) && !empty($user->reg_country_id)) ? $user->reg_country_id : '';
            $departamentoData = (isset($user->reg_departamento_id) && !empty($user->reg_departamento_id)) ? $user->reg_departamento_id : '';
            $provinciaData = (isset($user->reg_provincia_id) && !empty($user->reg_provincia_id)) ? $user->reg_provincia_id : '';
            $distritoData = (isset($user->reg_distrito_id) && !empty($user->reg_distrito_id)) ? $user->reg_distrito_id : '';

            $paisAll = DB::table('countries')->get();
            $departamentoAll = DB::table('tbl_departamentos')->get();
            $provinciaAll = DB::table('tbl_provincias')->get();
            $distritoAll = DB::table('tbl_distritos')->get();

            $paisByUser = DB::table('countries')->where('id',$paisData)->first();
            $departamentoByUser = DB::table('tbl_departamentos')->where('id',$departamentoData)->first();
            $provinciaByUser = DB::table('tbl_provincias')->where('id',$provinciaData)->first();
            $distritoByUser = DB::table('tbl_distritos')->where('id',$distritoData)->first();

          ?>
          <form id="shippingForm" class="row" action="<?php echo e(route('user.shipping.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-address1"><?php echo e(__('Address 1')); ?> *</label>
                <input class="form-control" name="reg_address1" value="<?php echo e($user->reg_address1); ?>" type="text" id="reg-address1">
                <?php $__errorArgs = ['reg_address1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-address2"><?php echo e(__('Address 2 (Optional)')); ?> </label>
                <input class="form-control" value="<?php echo e($user->reg_address2); ?>" name="reg_address2" type="text" id="reg-address2">
                <?php $__errorArgs = ['reg_address2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger"><?php echo e($message); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg-codepostal"><?php echo e(__('Zip Code')); ?></label>
                <input class="form-control" type="text" value="<?php echo e($user->reg_codepostal); ?>" name="reg_codepostal" id="reg-codepostal">
              </div>
            </div> 
            <div class="<?php echo e(DB::table('states')->count() > 0  ? 'col-md-12' : 'col-md-6'); ?> ">
              <div class="form-group">
                <label for="reg-country">País</label>
                <select class="form-control" name="reg_country_id" id="reg-country">
                  <option selected value=""><?php echo e(__('Choose Country')); ?></option>
                  <?php $__currentLoopData = $paisAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countryData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e((!empty($paisData) && $paisData != '' && $user->reg_country_id == $countryData->id) ? $paisData : $countryData->id); ?>" <?php echo e((!empty($paisData) && $paisData != '' && $user->reg_country_id == $countryData->id) ? 'selected' : ''); ?> ><?php echo e($countryData->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-departamento">Departamento</label>
                <select class="form-control" name="reg_departamento_id" id="reg-departamento" data-href="${locationsGET + '/provincia'}" required>
                  <option selected value="">Elige Departamento</option>
                  <?php $__currentLoopData = $departamentoAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option data-code="<?php echo e(($departamentoData != '' && $user->reg_departamento_id == $departData->id) ? $departamentoByUser->departamento_code : $departData->departamento_code); ?>" value="<?php echo e((!empty($departamentoData) && $departamentoData != '' && $user->reg_departamento_id == $departData->id) ? $departamentoData : $departData->id); ?>" <?php echo e((!empty($departamentoData) && $departamentoData != '' && $user->reg_departamento_id == $departData->id) ? 'selected' : ''); ?> ><?php echo e($departData->departamento_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-provincia">Provincia</label>
                <select class="form-control" name="reg_provincia_id" id="reg-provincia" data-href="${locationsGET + '/distrito'}" required>
                  <option selected value="">Elige Provincia</option>
                  <?php $__currentLoopData = $provinciaAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proviData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option data-code="<?php echo e(($provinciaData != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaByUser->provincia_code : $proviData->provincia_code); ?>" value="<?php echo e((!empty($provinciaData) && $provinciaData != '' && $user->reg_provincia_id == $proviData->id) ? $provinciaData : $proviData->id); ?>" <?php echo e((!empty($provinciaData) && $provinciaData != '' && $user->reg_provincia_id == $proviData->id) ? 'selected' : ''); ?> ><?php echo e($proviData->provincia_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-distrito">Distrito</label>
                <select class="form-control" name="reg_distrito_id" id="reg-distrito" required>
                  <option selected value="">Elige Distrito</option>
                    <?php $__currentLoopData = $distritoAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-code="<?php echo e(($distritoData != '' && $user->reg_distrito_id == $distrData->id) ? $distritoByUser->distrito_code : $distrData->distrito_code); ?>" value="<?php echo e((!empty($distritoData) && $distritoData != '' && $user->reg_distrito_id == $distrData->id) ? $distritoData : $distrData->id); ?>" <?php echo e((!empty($distritoData) && $distritoData != '' && $user->reg_distrito_id == $distrData->id) ? 'selected' : ''); ?> ><?php echo e($distrData->distrito_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-streetaddress">Calle</label>
                <input class="form-control" type="text" name="reg_streetaddress" placeholder="Calle" id="reg-streetaddress" value="<?php echo e($user->reg_streetaddress); ?>" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="reg-referenceaddress">Referencia (Opcional)</label>
                <input class="form-control" type="text" name="reg_referenceaddress" placeholder="Referencia" id="reg-referenceaddress" value="<?php echo e($user->reg_referenceaddress); ?>">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="reg-addresseeaddress">Destinatario (Opcional)</label>
                <input class="form-control" type="text" name="reg_addresseeaddress" placeholder="Destinatario" id="reg-addresseeaddress" value="<?php echo e($user->reg_addresseeaddress); ?>">
              </div>
            </div>
            <div class="col-12 ">
              <div class="text-right">
                <button class="btn btn-primary margin-bottom-none btn-sm" type="submit"><span><?php echo e(__('Update Address')); ?></span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/profile.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/dashboard/address.blade.php ENDPATH**/ ?>