<?php
namespace App\Traits;
use App\{
  Models\Order,
  Models\Setting,
  Models\TrackOrder,
  Helpers\EmailHelper,
  Helpers\PriceHelper,
  Models\Notification
};
use App\Helpers\SmsHelper;
use App\Models\Item;
use App\Models\PromoCode;
use App\Models\ShippingService;
use App\Models\State;
use App\Models\TempCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
trait IzipayCheckout{
  public function getUltimateIdGenCode($idgencodelast){
    if($idgencodelast){
      $idgencode = str_replace(' ','',$idgencodelast->id_gencode);
      if($idgencode != "" && $idgencode != null){
        $lastCodeArr = explode('-', $idgencode);
        $firstGroup = intval($lastCodeArr[0]);
        $secondGroup = intval($lastCodeArr[1]);
        if($secondGroup == 9999999){
          $firstGroup++;
          $secondGroup = 1;
        }else{
          $secondGroup++;
        }
      }else{
        $firstGroup = 1;
        $secondGroup = 1;
      }
    }else{
      $firstGroup = 1;
      $secondGroup = 1;
    }
    
    $firstGroupPadded = str_pad($firstGroup, 3, '0', STR_PAD_LEFT);
    $secondGroupPadded = str_pad($secondGroup, 7, '0', STR_PAD_LEFT);
    $code = $firstGroupPadded . '-' . $secondGroupPadded;
    return $code;
  }
  public function IzipaySubmit($data){
    $r = "";
    $ultimateIdGenCode = Order::select('id_gencode')->orderBy('id', 'desc')->take(1)->first();
    $nextIdGenCode = $this->getUltimateIdGenCode($ultimateIdGenCode);
    if(isset($data['kr-answer']) && $data['kr-answer'] != ""){
      $izzipay_r = json_decode($data['kr-answer'], TRUE);
      /*
      echo "<pre>";
      print_r($izzipay_r);
      echo "</pre>";
      exit();
      */
      
      $_token = uniqid('fk-srWong'); // TRANSACTION DATE
      $transactionDate = $izzipay_r['serverDate']; // TRANSACTION DATE
      $datetransacString = strtotime($transactionDate);
      $trans_date = date('Y-m-d H:i:s',$datetransacString);
      $orderStatus = $izzipay_r['transactions'][0]['status']; // ORDER STATUS
      $orderID = $izzipay_r['orderDetails']['orderId']; // ORDERID
      $currency = $izzipay_r['orderDetails']['orderCurrency']; // CURRENCY
      $payment_gateway_name = "IzziPay"; // PAYMENT GATEWAY NAME
      $credit_card_brand = $izzipay_r['transactions'][0]['transactionDetails']['cardDetails']['effectiveBrand']; // CREDIT CARD BRAND
      $ammountTotal = $izzipay_r['orderDetails']['orderTotalAmount']; // MONTO TOTAL
      $convertAmmount = floatval($ammountTotal / 100);

      // echo "UNIQID => " . $_token . "<br>";
      // echo "FECHA PAGO => " . $trans_date . "<br>";
      // echo "ESTADO DE PAGO => " . $orderStatus . "<br>";
      // echo "ID DE PAGO => " . $orderID . "<br>";
      // echo "NOMBRE DEL MÉTODO DE PAGO => ". $payment_gateway_name . "<br>";
      // echo "MONEDA => " . $currency . "<br>";
      // echo "MONTO => " . $convertAmmount . "<br>";
      // echo "TARGETA => " . $credit_card_brand . "<br>";
      // VALIDANDO EL ESTADO DE PAGO
      $pay_status = "";
      if($orderStatus == "PAID"){
        $pay_status = "paid";
      }else if($orderStatus == "RUNNING"){
        $pay_status = "in_process";
      }else{
        $pay_status = "unpaid";
      }

      $user = Auth::user();       
      $setting = Setting::first();
      $cart = Session::get('cart');
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
        $item = Item::findOrFail($key);
        if($item->tax){
          $total_tax += $item::taxCalculate($item);
        }
      }
      $shipping = [];
      if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
        $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
        if($cart_total >= $shipping->minimum_price){
          $shipping = $shipping;
        }else{
          $shipping = [];
        }
      }
      if(!$shipping){
        $shipping = ShippingService::whereStatus(1)->where('id','!=',1)->first(); 
      }
      if (!PriceHelper::Digital()){
        $shipping = null;
      }        
      $discount = [];
      if(Session::has('coupon')){
        $discount = Session::get('coupon');
      }
      $statePrice = 0;
      $state_id = 0;
      if(isset($data['state_id']) && $data['state_id'] != ""){
        $state_id = $data['state_id'];
        $statePrice = PriceHelper::StatePrce($data['state_id'],$cart_total);
      }

      $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
      $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
      $grand_total += $statePrice;
      $total_amount = PriceHelper::setConvertPrice($grand_total);
      $orderData['id_gencode'] = $nextIdGenCode;
      $orderData['state'] =  $state_id ? json_encode(State::findOrFail($state_id),true) : null;
      $orderData['cart'] = json_encode($cart,true);
      $orderData['discount'] = json_encode($discount,true);
      $orderData['shipping'] = json_encode($shipping,true);
      $orderData['tax'] = $total_tax;
      $orderData['state_price'] = $statePrice;
      $orderData['shipping_info'] = json_encode(Session::get('shipping_address'),true);
      $orderData['billing_info'] = json_encode(Session::get('billing_address'),true);
      $orderData['payment_method'] = 'Izipay';
      $orderData['user_id'] = isset($user) ? $user->id : 0;
      $orderData['transaction_number'] = Str::random(10);
      $orderData['currency_sign'] = PriceHelper::setCurrencySign();
      $orderData['currency_value'] = PriceHelper::setCurrencyValue();
      $orderData['payment_status'] = 'Unpaid';
      $orderData['order_status'] = 'Pending';

      /*
      echo "<pre>";
      print_r($orderData);
      echo "</pre>";
      exit();
      */

      $order = Order::create($orderData);
      TrackOrder::create([
        'title' => 'Pending',
        'order_id' => $order->id,
      ]);        
      PriceHelper::Transaction($order->id,$order->transaction_number,EmailHelper::getEmail(),PriceHelper::OrderTotal($order,'trns'));
      PriceHelper::LicenseQtyDecrese($cart);
      PriceHelper::stockDecrese();
      Notification::create([
        'order_id' => $order->id
      ]);
      $emailData = [
        'to' => EmailHelper::getEmail(),
        'type' => "Order",
        'user_name' => isset($user) ? $user->displayName() : Session::get('billing_address')['bill_first_name'],
        'order_cost' => $total_amount,
        'transaction_number' => $order->transaction_number,
        'site_title' => Setting::first()->title,
      ];
      $email = new EmailHelper();
      $email->sendTemplateMail($emailData);
      if($discount){
        $coupon_id = $discount['code']['id'];
        $get_coupon = PromoCode::findOrFail($coupon_id);
        $get_coupon->no_of_times -= 1;
        $get_coupon->update();
      }
      if($setting->is_twilio == 1){
        // message
        $sms = new SmsHelper();
        $user_number = json_decode($order->billing_info,true)['bill_phone'];
        if($user_number){
          $sms->SendSms($user_number,"'purchase'",$order->transaction_number);
        }
      }       
      Session::put('order_id',$order->id);
      $idusertempcart = isset($user) ? $user->id : 0;
      TempCart::where("user_id", $idusertempcart)->delete(); // ELIMINAR EL CARRITO DE COMPRAS DEL CLIENTE...

      Session::forget('cart');
      Session::forget('discount');
      Session::forget('coupon');
      return [
        'status' => true
      ];
    }
  }
}
