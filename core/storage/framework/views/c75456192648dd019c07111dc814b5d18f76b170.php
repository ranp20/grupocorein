<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr id="product-bulk-delete">
  <td><input type="checkbox" class="bulk-item" value="<?php echo e($data->id); ?>"></td>
  <td>
    <img src="<?php echo e($data->thumbnail ? asset('assets/images/'.$data->thumbnail) : asset('assets/images/placeholder.png')); ?>" alt="Image Not Found">
  </td>
  <td>
    <?php echo e($data->name); ?>

  </td>
  <td>
    <?php
    $newPrice = 0;
    ?>
    <?php if($data->sections_id != 0): ?>
      <?php
      if($data->on_sale_price != 0){
        $newPrice = $data->on_sale_price;
      }else if($data->special_offer_price != 0){
        $newPrice = $data->special_offer_price;
      }else{
        $newPrice = $data->discount_price;
      }
      ?>
    <?php else: ?>
      <?php
        $newPrice = $data->discount_price;
      ?>
    <?php endif; ?>
    <span><?php echo e(PriceHelper::adminCurrencyPrice($newPrice)); ?></span>
  </td>
  <td>
    <?php
    $nameSection = "";
    $nameSectionClassSpan = "";
    ?>
    <?php if($data->sections_id != 0): ?>
      <?php
        if($data->sections_id == 1){
          $nameSection = "En promoción";
          $nameSectionClassSpan = "sptxt_prod-prom";
        }else if($data->sections_id == 2){
          $nameSection = "Oferta Especial";
          $nameSectionClassSpan = "sptxt_prod-offspecial";
        }else{
          $nameSection = "Normal";
          $nameSectionClassSpan = "sptxt_prod-normal";
        }
      ?>
    <?php else: ?>
      <?php
        $nameSection = "Normal";
        $nameSectionClassSpan = "sptxt_prod-normal";
      ?>
    <?php endif; ?>
    <span class="<?php echo e($nameSectionClassSpan); ?>"><?php echo e($nameSection); ?></span>
  </td>
  <td>
    <div class="dropdown">
      <button class="btn btn-<?php echo e($data->status == 1 ? 'success' : 'danger'); ?> btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e($data->status == 1 ? __('Publish') : __('Unpublish')); ?>

      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?php echo e(route('back.item.status',[$data->id,1])); ?>"><?php echo e(__('Publish')); ?></a>
        <a class="dropdown-item" href="<?php echo e(route('back.item.status',[$data->id,0])); ?>"><?php echo e(__('Unpublish')); ?></a>
      </div>
    </div>
  </td>
  
  <td class="d-tr_none">
    <?php echo e($data->sap_code); ?> 
  </td>
  <td>
    <div class="dropdown">
      <button class="btn btn-secondary btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('Options')); ?>

      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <?php if($data->item_type == 'normal'): ?>
        <a class="dropdown-item" href="<?php echo e(route('back.item.edit',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Edit')); ?></a>
        <?php elseif($data->item_type =='digital'): ?>
        <a class="dropdown-item" href="<?php echo e(route('back.digital.item.edit',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Edit')); ?></a>
        <?php elseif($data->item_type =='affiliate'): ?>
        <a class="dropdown-item" href="<?php echo e(route('back.affiliate.edit',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Edit')); ?></a>
        <?php else: ?>
        <a class="dropdown-item" href="<?php echo e(route('back.license.item.edit',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Edit')); ?></a>
        <?php endif; ?>
          <?php if($data->status == 1): ?>
          <a class="dropdown-item" target="_blank" href="<?php echo e(route('front.product',$data->slug)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('View')); ?></a>
        <?php endif; ?>
        <?php if($data->item_type == 'normal'): ?>
        <a class="dropdown-item" href="<?php echo e(route('back.attribute.index',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Attributes')); ?></a>
        <a class="dropdown-item" href="<?php echo e(route('back.option.index',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Attribute Options')); ?></a>
        <?php endif; ?>
        <a class="dropdown-item" href="<?php echo e(route('back.item.highlight',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Highlight')); ?></a>
        <a class="dropdown-item" data-toggle="modal"
        data-target="#confirm-delete" href="javascript:;"
        data-href="<?php echo e(route('back.item.destroy',$data->id)); ?>"><i class="fas fa-angle-double-right"></i> <?php echo e(__('Delete')); ?></a>
      </div>
    </div>
  </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/back/item/table.blade.php ENDPATH**/ ?>