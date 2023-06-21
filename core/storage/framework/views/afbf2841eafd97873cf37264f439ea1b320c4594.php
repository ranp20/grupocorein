<?php $__env->startSection('title'); ?>
  <?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('user.order.index')); ?>"><?php echo e(__('Orders')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Order Invoice')); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
  if($order->state){
    $state = json_decode($order->state,true);
  }else{
    $state = [];
  }
?>
<div class="container padding-bottom-3x mb-1 print_invoice">
  <div class="card card-body p-5">
    <div class="row">
      <div class="col-lg-12">
        <a href="<?php echo e(route('user.order.index')); ?>" class="btn btn-sm btn-primary d-inline-block"><span><?php echo e(__('Back')); ?></span></a>
        <a href="<?php echo e(route('user.order.print',$order->id)); ?>" target="_blank" class="btn btn-sm btn-primary invoice_price d-inline-block"><span><?php echo e(__('Print')); ?></span></a>
      </div>
    </div>
    <div class="row">
      <div class="col text-center">
        <img class="img-fluid mb-5 mh-70"  alt="Logo" src="<?php echo e(asset('assets/images/'.$setting->logo)); ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h5><b><?php echo e(__('Order Details :')); ?></b></h5>
        <span class="text-muted"><?php echo e(__('Transaction Id')); ?> :</span><?php echo e($order->txnid); ?><br>
        <span class="text-muted"><?php echo e(__('Order Id')); ?> :</span><?php echo e($order->transaction_number); ?><br>
        <span class="text-muted"><?php echo e(__('Order Date')); ?> :</span><?php echo e($order->created_at->format('M d, Y')); ?><br>
        <span class="text-muted"><?php echo e(__('Payment Status')); ?> :</span>
        <?php if($order->payment_status == 'Paid'): ?>
        <div class="badge badge-success"><?php echo e(__('Paid')); ?></div>
        <?php else: ?>
        <div class="badge badge-danger"><?php echo e(__('Unpaid')); ?></div>
        <?php endif; ?>
        <br>
        <span class="text-muted"><?php echo e(__('Payment Method')); ?> :</span><?php echo e($order->payment_method); ?><br>
        <br>
        <br>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-6">
        <h5><?php echo e(__('Billing Address')); ?> :</h5>
        <?php
          $bill = json_decode($order->billing_info,true);
        ?>
        <span class="text-muted"><?php echo e(__('Name')); ?>: </span><?php echo e($bill['bill_first_name']); ?> <?php echo e($bill['bill_last_name']); ?><br>
        <span class="text-muted"><?php echo e(__('Email')); ?>: </span><?php echo e($bill['bill_email']); ?><br>
        <span class="text-muted"><?php echo e(__('Phone')); ?>: </span><?php echo e($bill['bill_phone']); ?><br>
        <?php if(isset($bill['bill_address1'])): ?>
        <span class="text-muted"><?php echo e(__('Address')); ?>: </span><?php echo e($bill['bill_address1']); ?>, <?php echo e(isset($bill['bill_address2']) ? $bill['bill_address2'] : ''); ?><br>
        <?php endif; ?>
        <?php if(isset($bill['bill_country'])): ?>
        <span class="text-muted"><?php echo e(__('Country')); ?>: </span><?php echo e($bill['bill_country']); ?><br>
        <?php endif; ?>
        <?php if(isset($bill['bill_city'])): ?>
        <span class="text-muted"><?php echo e(__('City')); ?>: </span><?php echo e($bill['bill_city']); ?><br>
        <?php endif; ?>
        <?php if(isset($state['name'])): ?>
        <span class="text-muted"><?php echo e(__('State')); ?>: </span><?php echo e($state['name']); ?><br>
        <?php endif; ?>
        <?php if(isset($bill['bill_zip'])): ?>
        <span class="text-muted"><?php echo e(__('Postal Code')); ?>: </span><?php echo e($bill['bill_zip']); ?><br>
        <?php endif; ?>
        <?php if(isset($bill['bill_company'])): ?>
        <span class="text-muted"><?php echo e(__('Company')); ?>: </span><?php echo e($bill['bill_company']); ?><br>
        <?php endif; ?>
      </div>
      <div class="col-12 col-md-6">
        <h5><?php echo e(__('Shipping Address :')); ?></h5>
        <?php
          $ship = json_decode($order->shipping_info,true)
        ?>
        <span class="text-muted"><?php echo e(__('Name')); ?>: </span><?php echo e($ship['ship_first_name']); ?> <?php echo e($ship['ship_last_name']); ?> <br>
        <?php if(isset($ship['ship_email'])): ?>
        <span class="text-muted"><?php echo e(__('Email')); ?>: </span><?php echo e($ship['ship_email']); ?><br>
        <?php endif; ?>
        <span class="text-muted"><?php echo e(__('Phone')); ?>: </span><?php echo e($ship['ship_phone']); ?><br>
        <?php if(isset($ship['ship_address1'])): ?>
        <span class="text-muted"><?php echo e(__('Address')); ?>: </span><?php echo e($ship['ship_address1']); ?>, <?php echo e(isset($ship['ship_address2']) ? $ship['ship_address2'] : ''); ?><br>
        <?php endif; ?>
        <?php if(isset($ship['ship_country'])): ?>
        <span class="text-muted"><?php echo e(__('Country')); ?>: </span><?php echo e($ship['ship_country']); ?><br>
        <?php endif; ?>
        <?php if(isset($ship['ship_city'])): ?>
        <span class="text-muted"><?php echo e(__('City')); ?>: </span><?php echo e($ship['ship_city']); ?><br>
        <?php endif; ?>
        <?php if(isset($state['name'])): ?>
        <span class="text-muted"><?php echo e(__('State')); ?>: </span><?php echo e($state['name']); ?><br>
        <?php endif; ?>
        <?php if(isset($ship['ship_zip'])): ?>
        <span class="text-muted"><?php echo e(__('Postal Code')); ?>: </span><?php echo e($ship['ship_zip']); ?><br>
        <?php endif; ?>
        <?php if(isset($ship['ship_company'])): ?>
        <span class="text-muted"><?php echo e(__('Company')); ?>: </span><?php echo e($ship['ship_company']); ?><br>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="gd-responsive-table">
          <table class="table my-4">
            <thead>
              <tr>
                <th width="50%" class="px-0 bg-transparent border-top-0"><span class="h6"><?php echo e(__('Products')); ?></span></th>
                <th class="px-0 bg-transparent border-top-0"><span class="h6"><?php echo e(__('Attribute')); ?></span></th>
                <th class="px-0 bg-transparent border-top-0"><span class="h6"><?php echo e(__('Quantity')); ?></span></th>
                <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?php echo e(__('Price')); ?></span></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $option_price = 0;
                $total = 0;
              ?>
              <?php $__currentLoopData = json_decode($order->cart,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key  => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $total += $item['main_price'] * $item['qty'];
                if($item['attribute_price'] != "" && count($item['attribute_price']) > 0){
                  $option_price += $item['attribute_price'];
                }
                $grandSubtotal = $total + $option_price;
                if(App\Models\Item::where('id',$key)->exists()){
                  $main_item = App\Models\Item::findOrFail($key);
                }else{
                  $main_item = null;
                }
              ?>
              <tr>
                <td class="">
                  <?php echo e($item['name']); ?>

                  <p>
                    <?php if($main_item): ?>
                    <?php if($item['item_type'] == 'digital'): ?>
                      <?php if($order->payment_status == 'Paid'): ?>
                        <?php if($main_item['file_type'] == 'link'): ?>
                        <a href="<?php echo e($main_item->link); ?>" target="_blank" class="btn btn-sm btn-success"><?php echo e(__('Click Here')); ?></a>
                        <?php else: ?>
                        <a href="<?php echo e(asset('assets/files/'.$main_item->file)); ?>" class="btn btn-sm btn-success"><?php echo e(__('Download')); ?></a>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php if($item['item_type'] == 'license'): ?>
                    <?php if($order->payment_status == 'Paid'): ?>
                        <?php if($main_item['file_type'] == 'link'): ?>
                        <a href="<?php echo e($main_item->link); ?>" target="_blank" class="btn btn-sm my-2 btn-success"><?php echo e(__('Click Here')); ?></a>
                        <p class="py-2"><?php echo e(__('License Information')); ?> : <?php echo e($item['item_l_n']); ?> : <?php echo e($item['item_l_k']); ?></p>
                        <?php else: ?>
                        <a href="<?php echo e(asset('assets/files/'.$main_item->file)); ?>" class="btn my-2 btn-sm btn-success"><?php echo e(__('Download')); ?></a>
                        <p class="py-2"><?php echo e(__('License Information')); ?> : <?php echo e($item['item_l_n']); ?> : <?php echo e($item['item_l_k']); ?></p>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  </p>
                </td>
                <td class="px-0">
                  <?php if($item['attribute_price'] != "" && count($item['attribute_price']) > 0 && $item['attribute']['option_name']): ?>
                  <?php $__currentLoopData = $item['attribute']['option_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionkey => $option_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span class="entry-meta"><b><?php echo e($option_name); ?></b> :
                    <?php if($setting->currency_direction == 1): ?>
                    <?php echo e($order->currency_sign); ?><?php echo e(round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2)); ?>

                    <?php else: ?>
                    <?php echo e(round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2)); ?><?php echo e($order->currency_sign); ?>

                    <?php endif; ?>

                  </span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  --
                  <?php endif; ?>
                </td>
                <td class="px-0"><?php echo e($item['qty']); ?></td>
                <td class="px-0 text-right">
                  <?php if($setting->currency_direction == 1): ?>
                    <?php echo e($order->currency_sign); ?><?php echo e(round($item['main_price']*$order->currency_value,2)); ?>

                  <?php else: ?>
                    <?php echo e(round($item['main_price']*$order->currency_value,2)); ?><?php echo e($order->currency_sign); ?>

                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="padding-top-2x" colspan="5"></td>
              </tr>
              <?php if($order->tax!=0): ?>
              <tr>
                <td class="px-0 border-top border-top-2"><span class="text-muted"><?php echo e(__('Tax')); ?></span></td>
                <td class="px-0 text-right border-top border-top-2" colspan="5">
                  <span>
                  <?php if($setting->currency_direction == 1): ?>
                    <?php echo e($order->currency_sign); ?><?php echo e(round($order->tax*$order->currency_value,2)); ?>

                  <?php else: ?>
                  <?php echo e(round($order->tax*$order->currency_value,2)); ?><?php echo e($order->currency_sign); ?>

                  <?php endif; ?>
                  </span>
                </td>
              </tr>
              <?php endif; ?>
              <?php if(json_decode($order->discount,true)): ?>
              <?php
                $discount = json_decode($order->discount,true);
              ?>
              <tr>
                <td class="px-0 border-top border-top-2"><span class="text-muted"><?php echo e(__('Coupon discount')); ?> (<?php echo e($discount['code']['code_name']); ?>)</span></td>
                <td class="px-0 text-right border-top border-top-2" colspan="5">
                  <span class="text-danger">
                  <?php if($setting->currency_direction == 1): ?>
                    -<?php echo e($order->currency_sign); ?><?php echo e(round($discount['discount'] * $order->currency_value,2)); ?>

                  <?php else: ?>
                    -<?php echo e(round($discount['discount'] * $order->currency_value,2)); ?><?php echo e($order->currency_sign); ?>

                  <?php endif; ?>
                  </span>
                </td>
              </tr>
              <?php endif; ?>
              <?php if(json_decode($order->shipping,true)): ?>
              <?php
                $shipping = json_decode($order->shipping,true);
              ?>
              <tr>
                <td class="px-0 border-top border-top-2"><span class="text-muted"><?php echo e(__('Shipping')); ?></span></td>
                <td class="px-0 text-right border-top border-top-2" colspan="5">
                  <span >
                  <?php if($setting->currency_direction == 1): ?>
                    <?php echo e($order->currency_sign); ?><?php echo e(round($shipping['price']*$order->currency_value,2)); ?>

                  <?php else: ?>
                    <?php echo e(round($shipping['price']*$order->currency_value,2)); ?><?php echo e($order->currency_sign); ?>

                  <?php endif; ?>
                  </span>
                </td>
              </tr>
              <?php endif; ?>
              <?php if(json_decode($order->state_price,true)): ?>
              <tr>
                <td class="px-0 border-top border-top-2">
                <span class="text-muted"><?php echo e(__('State Tax')); ?></span>
                </td>
                <td class="px-0 text-right border-top border-top-2" colspan="5">
                  <span >
                  <?php if($setting->currency_direction == 1): ?>
                  <?php echo e(isset($state['type']) && $state['type'] == 'percentage' ?  ' ('.$state['price'].'%) ' : ''); ?>  <?php echo e($order->currency_sign); ?><?php echo e(round($order['state_price']*$order->currency_value,2)); ?>

                  <?php else: ?>
                  <?php echo e(isset($state['type']) &&  $state['type'] == 'percentage' ?  ' ('.$state['price'].'%) ' : ''); ?>  <?php echo e(round($order['state_price']*$order->currency_value,2)); ?><?php echo e($order->currency_sign); ?>

                  <?php endif; ?>
                  </span>
                </td>
              </tr>
              <?php endif; ?>
              <tr>
                <td class="px-0 border-top border-top-2">
                <?php if($order->payment_method == 'Cash On Delivery'): ?>
                <strong><?php echo e(__('Total amount')); ?></strong>
                <?php else: ?>
                <strong><?php echo e(__('Total due')); ?></strong>
                <?php endif; ?>
                </td>
                <td class="px-0 text-right border-top border-top-2" colspan="5">
                  <span class="h3">
                    <?php if($setting->currency_direction == 1): ?>
                    <?php echo e($order->currency_sign); ?><?php echo e(PriceHelper::OrderTotal($order)); ?>

                    <?php else: ?>
                    <?php echo e(PriceHelper::OrderTotal($order)); ?><?php echo e($order->currency_sign); ?>

                    <?php endif; ?>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/user/order/invoice.blade.php ENDPATH**/ ?>