<?php
namespace App\Helpers;
use App\Models\AttributeOption;
use App\Models\Coupons;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Tax;
use App\Models\PaymentSetting;
use App\Models\Setting;
use App\Models\State;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateTimeZone;
class PriceHelper{
  public static function setPrice($price){
    $curr = Currency::where('is_default',1)->first();
    return round($price*$curr->value,2);
  }
  public static function adminCurrencyPrice($price){
    $curr = Currency::where('is_default',1)->first();
    $setting = Setting::first();
    $price = self::testPrice($price*$curr->value,2);
    if($setting->currency_direction == 1){
      return $curr->sign . $price;
    }else{
      return  $price.$curr->sign;
    }
  }
  public static function adminCurrency(){
    $curr = Currency::where('is_default',1)->first();
    return $curr->sign;
  }
  public static function storePrice($price){
    $curr = Currency::where('is_default',1)->first();
    return round($price*$curr->value,2);
  }
  public static function setCurrencyPrice($price){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    $setting = Setting::first();
    $price = self::testPrice(round($price*$curr->value,2));
    if($setting->currency_direction == 1){
      return $curr->sign . $price;
    }else{
      return  $price.$curr->sign;
    }
  }
  public static function setCurrencyOfCoupon($coupon_price){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    $setting = Setting::first();
    $coupon_price = self::testPriceofCoupon(round($coupon_price*$curr->value,2));
    if($setting->currency_direction == 1){
      return $curr->sign . $coupon_price;
    }else{
      return  $coupon_price.$curr->sign;
    }
  }
  public static function testPriceofCoupon($coupon_price){
    $setting = Setting::first();
    if($setting->is_decimal == 1){
      if(is_numeric( $coupon_price ) || floor( $coupon_price ) != $coupon_price){
        return number_format($coupon_price, 2, $setting->decimal_separator, $setting->thousand_separator);
      }else{
        return number_format($coupon_price, 2, $setting->decimal_separator, $setting->thousand_separator);
      }
    }else{
      return number_format($coupon_price);
    }
  }
  public static function setPreviousPrice($price){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    if($price != 0){
      $setting = Setting::first();
      $price = self::testPrice($price*$curr->value,2);
      if($setting->currency_direction == 1){
        return $curr->sign . $price;
      }else{
        return  $price.$curr->sign;
      }
    }else{
      $price = '';
    }
    return html_entity_decode($price);
  }
  public static function setConvertPrice($price){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    return round($price*$curr->value,2);
  }
  public static function convertPrice($price){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    return round($price/$curr->value,2);
  }
  public static function setCurrencySign(){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    return $curr->sign;
  }
  public static function setCurrencyValue(){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    return $curr->value;
  }
  public static function setCurrencyName(){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    return $curr->name;
  }
  public static function grandCurrencyPrice($item){
    $option_price = 0;
    if(count($item->attributes) > 0){
      foreach($item->attributes as $attr){
        if(isset($attr->options[0])){
          $option_price += $attr->options[0]->price;
        }
      }
    }
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    $discount_price = (isset($item->discount_price)) ? $item->discount_price : 0;
    $price = $discount_price + $option_price;
    $setting = Setting::first();
    $price = self::testPrice(round($price*$curr->value,2));
    if($setting->currency_direction == 1){
      return $curr->sign . $price;
    }else{
      return  $price.$curr->sign;
    }
  }
  public static function grandPrice($item){
    $option_price = 0;
    $taxes = 0;
    $taxesformat = 0;
    if(isset($item->tax_id)){
      $taxes = Tax::where('id',$item->tax_id)->select('id','name','value','status')->first();
      $taxes = $taxes->value;
      $taxesformat = $taxes / 100;
    }
    
    $price1 = 0;
    $price2 = 0;
    if(isset($item->attributes) && count($item->attributes) > 0){
      foreach($item->attributes as $attr){
        if(isset($attr->options[0])){
          $option_price += PriceHelper::convertPrice($attr->options[0]->price);
        }
      }
    }
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }

    $discount_price = (isset($item->discount_price)) ? $item->discount_price : 0;
    $sum1 = 0;
    $sum2 = 0;
    $sum3 = 0;
    if(isset($item->sections_id)){
      if($item->sections_id != 0){
        if($item->sections_id != 0 && $item->sections_id == 1){
          $sum1 = $item->on_sale_price;
          $sum2 = $sum1 * $taxesformat;
          $sum3 = $sum1 + $sum2;
        }else{
          $sum1 = $item->special_offer_price;
          $sum2 = $sum1 * $taxesformat;
          $sum3 = $sum1 + $sum2;
        }
      }else{
        $sum1 = $discount_price + $option_price;
        $sum2 = $sum1;
        $sum3 = $sum2;
      }
    }

    $price = $sum3;
    return $price;
  }
  public static function Discount($discount){
    if($discount){
      $discount = json_decode($discount,true);
    }else{
      $discount = 0;
    }
    return $discount;
  }
  public static function OrderTotal($order,$trns=null){
    $cart = json_decode($order->cart,true);
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;

    // echo "<pre>";
    // print_r($order);
    // echo "</pre>";
    // exit();

    foreach($cart as $key => $item){
      $keywithoutguion = str_replace("-","",$key);
      $keywithoutguion2 = (int) $keywithoutguion;

      if(Item::where('id',$keywithoutguion2)->exists()){
        $itemBD = Item::findOrFail($keywithoutguion2);
        if(isset($itemBD)){
          if($itemBD && $itemBD->tax){
            $total_tax += $itemBD::taxCalculate($itemBD);
          }
        }

        $total =0;
        $option_price = 0;
        $cartTotal = 0;

        // -------------------------- VALIDACIÓN DE CUPONES
        $totalwithoutcoupon = 0;
        $totalwithcoupon = 0;
        $totalwithoutcoupon_prod = 0;
        $totalwithcoupon_prod = 0;
        // ----------- CANTIDAD DE PRODUCTOS TOTAL...
        $prod_qty = floatval($item['qty']);
        // ----------- CANTIDAD DE PRODUCTOS SIN CUPÓN TOTAL...
        $prod_quantity_withoutcoupon = floatval($item['quantity_withoutcoupon']);
        // ----------- CANTIDAD DE PRODUCTOS CON CUPÓN...
        $prodwithcouponassoc = $prod_qty - $prod_quantity_withoutcoupon;
        $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
        if($item['coupon_id'] != "" && $item['coupon_id'] != "0" && $item['coupon_price'] != "" && $item['coupon_price'] != 0 && $item['coupon_price'] != 0.00){
          $namecouponbyid = Coupons::where("id","=",$item['coupon_id'])->take(1)->get();
          // NOTA: VALIDAR POR EL ESTADO DEL CUPÓN ALMACENADO EN LA VARIABLES "CART", NO VALIDAR SU EXISTENCIA Y/O ESTADO DESDE LA BD...
          if(count($namecouponbyid) != 0){
            $totalwithoutcoupon += ($item['price'] + $total + $attribute_price) * $prod_quantity_withoutcoupon;
            $totalwithcoupon += ($item['coupon_price'] + $total + $attribute_price) * $prodwithcouponassoc;
            $cart_total += $totalwithoutcoupon + $totalwithcoupon;
          }else{
            if($item['coupon_id'] != 0 && $item['coupon_price'] != 0){
              if($item['coupon_valid'] == "available"){ // --------- VALIDAR SI EL CUPÓN AÚN ERA VÁLIDO ANTES DE SELECCIONAR EL MÉTODO DE PAGO
                $cart_total += ($item['coupon_price'] + $total + $attribute_price) * $item['qty'];
              }else{
                $cart_total += ($item['price'] + $total + $attribute_price) * $item['qty'];
              }
            }else{
              $cart_total += ($item['price'] + $total + $attribute_price) * $item['qty'];
            }
          }
        }else{
          $cart_total +=  ($item['price'] + $total + $attribute_price) * $item['qty'];
        }

      }
    }

    $shipping = [];
    if(json_decode($order->shipping)){
      $shipping = json_decode($order->shipping,true);
    }
    $discount = [];
    if(json_decode($order->discount)){
      $discount = json_decode($order->discount,true);
    }

    $shipping_info = [];
    if(json_decode($order->shipping_info)){
      $shipping_info = json_decode($order->shipping_info, true);
    }

    $ship_amountaddress = $shipping_info['ship_amountaddress']; // MONTO DEL ENVÍO...
    $grand_total = ($cart_total + ($shipping ? $shipping['price'] : 0)) + $ship_amountaddress;

    $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    $grand_total = $grand_total + $order->state_price;
    $total_amount = round($grand_total * $order->currency_value,2);
    if(!$trns){
      $total_amount = self::testPrice($total_amount);
    }
    return $total_amount;
  }
  public static function OrderTotalChart($order){
    $cart = json_decode($order->cart,true);
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $option_price = 0;
    foreach($cart as $key => $item){
      $total += $item['price'] * $item['qty'];
      if($item['attribute_price'] != "" && count($item['attribute_price']) > 0){
        $option_price += $item['attribute_price'];
      }
      $cart_total = $total + $option_price;
      if(Item::where('id',$key)->exists()){
        $item = Item::findOrFail($key);
        if(isset($item)){
          if($item && $item->tax){
            $total_tax += $item::taxCalculate($item);
          }
        }
      }
    }
    $shipping = [];
    if(json_decode($order->shipping)){
      $shipping = json_decode($order->shipping,true);
    }
    $discount = [];
    if(json_decode($order->discount)){
      $discount = json_decode($order->discount,true);
    }
    $grand_total = ($cart_total + ($shipping?$shipping['price']:0)) + $total_tax;
    $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    $curr = Currency::where('is_default',1)->first();
    $total_amount = round($grand_total * $curr->value,2);
    return $total_amount;
  }
  public static function cartTotal($cartt,$trns=null){
    $total = 0;
    $attribute_price = 0;
    foreach ($cartt as $key => $cart){
      $attribute_price = (isset($cart['attribute_price']) && !empty($cart['attribute_price'])) ? $cart['attribute_price'] : 0;
      $total =($cart['price'] + $total + $attribute_price) * $cart['qty'];
    }
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    if($trns){
      if($trns == 2){
        return $total;
      }
      return round($total / $curr->value,2);
    }
    $price = self::testPrice($total / $curr->value);
    return $price;
  }
  public static function CheckDigital(){
    $cart = Session::get('cart');
    $check_digital = false;
    foreach ($cart as $key => $item){
      if($item['item_type'] == 'normal'){
        $check_digital = true;
      }
    }
    return $check_digital;
  }
  public static function CheckDigitalPaymentGateway(){
    $cart = Session::get('cart');
    $check_digital = true;
    foreach ($cart as $key => $item){
      if($item['item_type'] == 'normal'){
        $check_digital = false;
      }
    }
    return $check_digital;
  }
  public static function Transaction($order_id,$txn_id,$user_email,$amount){
    if(Session::has('currency')){
      $curr = Currency::findOrFail(Session::get('currency'));
    }else{
      $curr = Currency::where('is_default',1)->first();
    }
    $transaction = New Transaction();
    $transaction->order_id = $order_id;
    $transaction->txn_id = $txn_id;
    $transaction->user_email = $user_email;
    $transaction->amount = round($amount/$curr->value);
    $transaction->currency_sign = $curr->sign;
    $transaction->currency_value = $curr->value;
    $transaction->save();
  }
  public static function GatewayText($keyword){
    return PaymentSetting::where('unique_keyword',$keyword)->first()->text;
  }
  public static function DiscountPercentage($item){
    if($item->previous_price && $item->previous_price !=0){
      $discount_price = $item->previous_price - $item->discount_price;
      $percentage = round($discount_price / $item->previous_price * 100);
      return $percentage.'%';
    }
  }
  public static function GetItemId($cart_id){
    $item_id = explode('-',$cart_id);
    return $item_id[0];
  }
  public static function LicenseQtyDecrese($cart){
    foreach($cart as $item_id => $item){
      if($item['item_type'] == 'license'){
        $item = Item::findOrFail(PriceHelper::GetItemId($item_id));
        $license_key_new = json_decode($item->license_key,true);
        $last_key = array_key_last($license_key_new);
        unset($license_key_new[$last_key]);
        $license_name_new = json_decode($item->license_key,true);
        unset($license_name_new[$last_key]);
        $item->license_name = json_encode($license_name_new,true);
        $item->license_key = json_encode($license_key_new,true);
        $item->update();
      }
    }
  }
  public static function stockDecrese(){
    $cart = Session::get('cart');
    foreach($cart as $key => $item){
      $main_item = Item::findOrFail($key);
      if($main_item->item_type == 'normal'){
        $current = $main_item->stock - $item['qty'];
        if($current <= 0){
          $main_item->stock = 0;
        }else{
          $main_item->stock = $current;
        }
        $main_item->update();
        foreach($item['options_id'] as $id){
          $option = AttributeOption::findOrFail($id);
          if($option->stock != 'unlimited'){
            $new_stock = (int)$option->stock - $item['qty'];
            if($new_stock <=0){
              $option->stock = '0';
            }else{
              $option->stock = (string)$new_stock;
            }
            $option->save();
          }
        }
      }
    }
  }
  public static function testPrice($price){        
    $setting = Setting::first();           
    if($setting->is_decimal == 1){
      if(is_numeric( $price ) || floor( $price ) != $price){
        return number_format($price, 2, $setting->decimal_separator, $setting->thousand_separator);
      }else{
        return number_format($price, 2, $setting->decimal_separator, $setting->thousand_separator);
      }
    }else{
      return number_format($price);
    }
  }
  public static function Digital(){
    $cart = Session::get('cart');
    $return = false;
    foreach($cart as $item){
      if($item['type'] == 'normal'){
        $return = true;
      }
    }
    return $return;
  }
  public static function StatePrce($state_id,$grand_total){
    $state_price = 0;
    if($state_id){
      $state = State::findOrFail($state_id);
      if($state->type == 'fixed'){
        $state_price = $state->price;
      }else{
        $state_price = ($grand_total * $state->price) / 100;
      }
    }
    return $state_price;
  }
}