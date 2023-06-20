<?php
namespace App\Http\Controllers\Front;
use App\{
  Models\Order,
  Models\PaymentSetting,
  Traits\StripeCheckout,
  Traits\MollieCheckout,
  Traits\PaypalCheckout,
  Traits\PaystackCheckout,
  Http\Controllers\Controller,
  Http\Requests\PaymentRequest,
  Traits\CashOnDeliveryCheckout,
  Traits\BankCheckout
};
use App\Helpers\PriceHelper;
use App\Helpers\SmsHelper;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Setting;
use App\Models\ShippingService;
use App\Models\State;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\File;
use PDF;
class CheckoutController extends Controller{
  use StripeCheckout{
    StripeCheckout::__construct as private __stripeConstruct;
  }
  use PaypalCheckout{
    PaypalCheckout::__construct as private __paypalConstruct;
  }
  use MollieCheckout{
    MollieCheckout::__construct as private __MollieConstruct;
  }
  use BankCheckout;
  use PaystackCheckout;
  use CashOnDeliveryCheckout;
  public function __construct(){
    $setting = Setting::first();
    if($setting->is_guest_checkout != 1){
      $this->middleware('auth');
    }
    $this->middleware('localize');
    $this->__stripeConstruct();
    $this->__paypalConstruct();
  }
  /* ---------------- AL HACER CLICK EN EL TAB DE "DATOS PERSONALES" ---------------- */
	public function ship_address(){
    if (!Session::has('cart')){
      return redirect(route('front.cart'));
    }
    $data['user'] = Auth::user() ? Auth::user() : null;
    $cart = Session::get('cart');
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $total_amount = 0;
    $grand_total = 0;
    $attribute_price = 0;
    foreach($cart as $key => $item){
      $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
      $total += ($item['main_price'] + $attribute_price) * $item['qty'];
      $cart_total = $total;
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
    $discount = [];
    if(Session::has('coupon')){
      $discount = Session::get('coupon');
    }
    if (!PriceHelper::Digital()){
      $shipping = null;
    }
    // $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
    // $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    // $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
    // $total_amount = $grand_total + $state_tax;
    $grand_total = $cart_total;
    $total_amount = $grand_total;
    $data['cart'] = $cart;
    $data['cart_total'] = $cart_total;
    $data['grand_total'] = $total_amount;
    $data['discount'] = $discount;
    $data['shipping'] = $shipping;
    $data['tax'] = $total_tax;
    $data['payments'] = PaymentSetting::whereStatus(1)->get();
    return view('front.checkout.billing',$data);
  }
  /* ---------------- BILLING ---------------- */
  public function billingStore(Request $request){
    if($request->same_ship_address){
      Session::put('billing_address',$request->all());
      if(PriceHelper::CheckDigital()){
        $shipping = [
          "ship_first_name" => $request->bill_first_name,
          "ship_last_name" => $request->bill_last_name,
          "ship_email" => $request->bill_email,
          "ship_phone" => $request->bill_phone,
          "ship_address1" => $request->bill_address1,
          "ship_address2" => $request->bill_address2,
        ];
      }else{
        $shipping = [
          "ship_first_name" => $request->bill_first_name,
          "ship_last_name" => $request->bill_last_name,
          "ship_email" => $request->bill_email,
          "ship_phone" => $request->bill_phone,
          "ship_address1" => $request->bill_address1,
          "ship_address2" => $request->bill_address2,
        ];
      }
      Session::put('shipping_address',$shipping);
    }else{
      Session::put('billing_address',$request->all());
      Session::forget('shipping_address');
    }
    if(Session::has('shipping_address')){
      return redirect()->route('front.checkout.payment');
    }else{
      return redirect()->route('front.checkout.shipping');
    }
  }
  /* ---------------- AL HACER CLICK EN EL TAB DE "DIRECCIÓN DE ENVÍO" ---------------- */
  public function shipping(){
    if(Session::has('shipping_address')){
      return redirect(route('front.checkout.payment'));
    }
    if(!Session::has('cart')){
      return redirect(route('front.cart'));
    }
    $getUserData = Auth::user();
    $getPaisData = json_encode(["id" => 1,"pais_code" => 1,"pais_name" => "PERU"], TRUE);
    $getDepartamentoData = Departamento::where("id","=",$getUserData->reg_departamento_id)->select('id','departamento_code','departamento_name')->get()->first();
    $getProvinciaData = Provincia::where("id","=",$getUserData->reg_provincia_id)->select('id','provincia_code','provincia_name')->get()->first();
    $getDistritoData = Distrito::where("id","=",$getUserData->reg_distrito_id)->select('id','distrito_code','distrito_name')->get()->first();
    
    $data['datauserinfo'] = [
      "pais" => $getPaisData,
      "departamento" => $getDepartamentoData,
      "provincia" => $getProvinciaData,
      "distrito" => $getDistritoData,
    ];
    $data['user'] = Auth::user();
    $cart = Session::get('cart');
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $total_amount = 0;
    $grand_total = 0;
    $attribute_price = 0;
    foreach($cart as $key => $item){
      $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
      $total += ($item['main_price'] + $attribute_price) * $item['qty'];
      $cart_total = $total;
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
    $discount = [];
    if(Session::has('coupon')){
      $discount = Session::get('coupon');
    }
    if (!PriceHelper::Digital()){
      $shipping = null;
    }
    // $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
    // $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    // $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
    // $grand_total = $grand_total + $state_tax;
    $grand_total = $cart_total;
    $total_amount = $grand_total;
    $total_amount = $grand_total;
    $data['cart'] = $cart;
    $data['cart_total'] = $cart_total;
    $data['grand_total'] = $total_amount;
    $data['discount'] = $discount;
    $data['shipping'] = $shipping;
    $data['tax'] = $total_tax;
    $data['payments'] = PaymentSetting::whereStatus(1)->get();
    return view('front.checkout.shipping',$data);
  }
  /* ---------------- SHIPPING ---------------- */
  public function shippingStore(Request $request){

    $ship = Session::get('shipping_address');
    $bill = Session::get('billing_address');
    $ship_array = explode(',', $ship);
    $ship_data = [];
    $ship_data['_token'] = (isset($request->_token) && $request->_token != "") ? $request->_token : "No definido";

    $distritoRequest = $request['ship_distrito'];
    $distritoGet = Distrito::where('id',$distritoRequest)->select('id','distrito_name','distrito_min_amount','distrito_max_amount')->first();
    $cartGetInfo = Session::get('cart');
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $total_amount_operation = 0;
    $total_amount = 0;
    $grand_total = 0;
    $attribute_price = 0;
    foreach($cartGetInfo as $key => $item){
      $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
      $total += ($item['main_price'] + $attribute_price) * $item['qty'];
      $cart_total = $total;
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
    $discount = [];
    if(Session::has('coupon')){
      $discount = Session::get('coupon');
    }
    if (!PriceHelper::Digital()){
      $shipping = null;
    }
    // $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
    // $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    // $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
    // $grand_total = $grand_total + $state_tax;
    $grand_total = floatval($cart_total);
    $minAmountValidate = 1600.00;
    $minAmountDelivery = floatval($distritoGet->distrito_min_amount);
    $maxAmountDelivery = floatval($distritoGet->distrito_max_amount);
    $ship_data['ship_amountaddress'] = 0;
    if($total_amount >= $minAmountValidate){
      $ship_data['ship_amountaddress'] = $maxAmountDelivery;
      $total_amount_operation = $grand_total + $maxAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }else if($total_amount < $minAmountValidate){
      $ship_data['ship_amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }else{
      $ship_data['ship_amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }

    $ship_data['ship_zip'] = (isset($request->ship_zip) && $request->ship_zip != "") ? $request->ship_zip : "No definido";
    $ship_data['ship_country'] = (isset($request->ship_country) && $request->ship_country != "") ? $request->ship_country : "No definido";
    if($ship == "" || $ship_array[0] == null || $ship_array[0] == ""){
      $ship_data['ship_first_name'] = $bill['bill_first_name'];
      $ship_data['ship_last_name'] = $bill['bill_last_name'];
      $ship_data['ship_address1'] = $bill['bill_address1'];
      $ship_data['ship_address2'] = $bill['bill_address2'];
      $ship_data['ship_phone'] = $bill['bill_phone'];
      Session::put('shipping_address', $ship_data);
      return redirect(route('front.checkout.payment'));
    }else{
      echo "";
    }
  }
  /* ---------------- PAYMENT ---------------- */
  public function payment(){
    if(!Session::has('billing_address')){
      return redirect(route('front.checkout.billing'));
    }
    if(!Session::has('shipping_address')){
      return redirect(route('front.checkout.shipping'));
    }
    if(!Session::has('cart')){
      return redirect(route('front.cart'));
    }
    $data['user'] = Auth::user();
    $cart = Session::get('cart');
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $total_amount = 0;
    $grand_total = 0;
    $attribute_price = 0;
    foreach($cart as $key => $item){
      $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
      $total += ($item['main_price'] + $attribute_price) * $item['qty'];
      $cart_total = $total;
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
    $discount = [];
    if(Session::has('coupon')){
      $discount = Session::get('coupon');
    }
    if (!PriceHelper::Digital()){
      $shipping = null;
    }
    // $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
    // $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    // $state_tax = Auth::check() && Auth::user()->state_id ? Auth::user()->state->price : 0;
    // $grand_total = $grand_total + $state_tax;
    $grand_total = $cart_total;
    $total_amount = $grand_total;
    $total_amount = $grand_total;
    $data['cart'] = $cart;
    $data['cart_total'] = $cart_total;
    $data['grand_total'] = $total_amount;
    $data['discount'] = $discount;
    $data['shipping'] = $shipping;
    $data['tax'] = $total_tax;
    $data['payments'] = PaymentSetting::whereStatus(1)->get();
    return view('front.checkout.payment',$data);
  }
  /* ---------------- AL ENVIAR DATOS DE COMPROBANTE ---------------- */
  public function sendDataVoucher(Request $request){    
    $input = $request->all();
    $selOptSelected = (isset($input['chckpay_selOpt']) && $input['chckpay_selOpt'] != "") ? $input['chckpay_selOpt'] : '';
    // $arrDataVoucher = [];
    if($selOptSelected == 'boleta'){
      $arrDataVoucher = [
        "selOptSelected" => 'boleta',
        "selOptSelectedId" => 1,
        "first_name" => (isset($input['chckpay_firt_name']) && $input['chckpay_firt_name'] != "") ? $input['chckpay_firt_name'] : '',
        "dni" => (isset($input['chckpay_dni']) && $input['chckpay_dni'] != "") ? $input['chckpay_dni'] : '',
        "phone" => (isset($input['chckpay_phone']) && $input['chckpay_phone'] != "") ? $input['chckpay_phone'] : '',
      ];
    }else if($selOptSelected == 'factura'){
      $arrDataVoucher = [
        "selOptSelected" => 'factura',
        "selOptSelectedId" => 2,
        "ruc" => (isset($input['chckpay_ruc']) && $input['chckpay_ruc'] != "") ? $input['chckpay_ruc'] : '',
        "razonsocial" => (isset($input['chckpay_razonsocial']) && $input['chckpay_razonsocial'] != "") ? $input['chckpay_razonsocial'] : '',
        "address" => (isset($input['chckpay_address']) && $input['chckpay_address'] != "") ? $input['chckpay_address'] : '',
        "phone" => (isset($input['chckpay_phone']) && $input['chckpay_phone'] != "") ? $input['chckpay_phone'] : '',
      ];
    }else{
      $arrDataVoucher = [];
    }
        
    if(Session::has('data_voucher')){
      Session::put('data_voucher', $arrDataVoucher);
    }else{
      Session::put('data_voucher', $arrDataVoucher);
    }
    return response()->json($arrDataVoucher);
  }
  /* ---------------- AL ENVIAR Y PROCESAR LOS DATOS DE PAGO ---------------- */
  public function checkoutProcess(Request $request){
    /*
    echo "<pre>";
    print_r($request->all());
    echo "<pre>";
    echo "<br>";
    */
    $r = "";
    if(isset($request['kr-answer']) && $request['kr-answer'] != ""){
      $izzipay_r = json_decode($request['kr-answer'], TRUE);
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
    }
    exit();
    /*
    $r = "";
    if(isset($_POST) && isset($_POST['kr-answer'])){
      $izzipay_r = json_decode($_POST['kr-answer'], TRUE);
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
      

      $pay_status = "";
      if($orderStatus == "PAID"){
        $pay_status = "paid";
      }else if($orderStatus == "RUNNING"){
        $pay_status = "in_process";
      }else{
        $pay_status = "unpaid";
      }
      
      
      require_once '../model/business-settings.php';
      $bssiness_payment = new BusinessSettings;
      $l_delivery_charge = $bssiness_payment->getDeliveryCharge();
      $l_delivery_charge_value = $l_delivery_charge[0]['value'];
      
      $del_charge = "";
        if($izzipay_r['customer']['billingDetails']['title'] == "delivery"){
            $del_charge = floatval($l_delivery_charge_value);
        }else if($izzipay_r['customer']['billingDetails']['title'] == "tienda"){
            $del_charge = "0.00";
        }else{
            $del_charge = "0.00";
        }
      
      $amount_final = $convertAmmount - $del_charge;
      
      // INFORMACIÓN PARA EL DETALLE EN EL ADMINISTRADOR
      $arr_delivery_address = [
        "id" => 0,
        "addres_type" => "Home",
        "contact_person_number" => $izzipay_r['customer']['billingDetails']['phoneNumber'],
        "address" => $izzipay_r['customer']['billingDetails']['address'],
        "latitude" => "-12.023474199999994",
        "longitude" => "-77.01358479999999",
        "created_at" => date("Y-m-d H:i:s"),
        "updated_at" => date("Y-m-d H:i:s"),
        "user_id" => $_SESSION['usr-logg_srwong']['id'],
        "contact_person_name" => $_SESSION['usr-logg_srwong']['f_name'] . " " . $_SESSION['usr-logg_srwong']['l_name']
      ];
      // INFORMACIÓN DE LA ORDEN
      $arr_order = [
        "user_id" => $_SESSION['usr-logg_srwong']['id'],
        "order_amount" => $amount_final,
        "payment_status" => $pay_status,
        "order_status" => "pending",
        "payment_method" => "IzziPay",
        "transaction_reference" => $izzipay_r['customer']['reference'],
        "delivery_charge" => $del_charge,
        "order_type" => $izzipay_r['customer']['billingDetails']['title'],
        "branch_id" => $izzipay_r['customer']['billingDetails']['city'],
        "delivery_address" => json_encode($arr_delivery_address, TRUE),
        "user_phone_number" => (isset($izzipay_r['customer']['billingDetails']['phoneNumber']) && $izzipay_r['customer']['billingDetails']['phoneNumber'] != "" && $izzipay_r['customer']['billingDetails']['phoneNumber'] != 0) ? $izzipay_r['customer']['billingDetails']['phoneNumber'] : "0",
        "order_id" => $orderID,
        "type_delivery" => $izzipay_r['customer']['shippingDetails']['address'],
        "info_facturation" => $izzipay_r['customer']['shippingDetails']['address2'],
        "deliv_name" => $izzipay_r['customer']['shippingDetails']['firstName'],
        "deliv_dni" => $izzipay_r['customer']['shippingDetails']['identityCode'],
        "deliv_ruc" => $izzipay_r['customer']['shippingDetails']['zipCode'],
        "deliv_razonsocial" => $izzipay_r['customer']['shippingDetails']['legalName'],
        "t_payment" => $izzipay_r['customer']['billingDetails']['firstName'],
        "t_amount_payment" => $izzipay_r['customer']['billingDetails']['identityCode'],
        "urbanization_id" => $izzipay_r['customer']['billingDetails']['country'],
      ];
      // INFORMACIÓN PARA EL DETALLE DE LA DIRECCIÓN DEL ENVÍO
      $arr_customer_addresses = [
        "address_type" => "Home",
        "contact_person_number" => $izzipay_r['customer']['billingDetails']['phoneNumber'],
        "address" => $izzipay_r['customer']['billingDetails']['address'],
        "latitude" => "No especificado",
        "longitude" => "No especificado",
        "user_id" => $_SESSION['usr-logg_srwong']['id'],
        "contact_person_name" => $_SESSION['usr-logg_srwong']['f_name'] . " " . $_SESSION['usr-logg_srwong']['l_name'],
        "n_dni" => $izzipay_r['customer']['shippingDetails']['identityCode']
      ];
      
      // echo "<pre>";
      // print_r($izzipay_r);
      // echo "</pre>";
      // echo "<!------------------------------->";
      // echo "<pre>";
      // print_r($arr_order);
      // echo "</pre>";
      // exit();
      
      require_once '../model/orders.php';
      require_once '../model/customer_addresses.php';
      $orders = new Orders();
      $customaddressses = new CustomerAddress();
      $add = $orders->addOrder($arr_order);
        
      // print_r($add);
      // exit();
        
      if($add[0]['r'] == "order_recent"){
        $updorderid = $orders->updateOrderIdTempCart_ByIdClient($arr_order['user_id'], $arr_order['order_id']);
        if($updorderid == "true"){
          $updstatus = $orders->updateStatusTempCart_ByIdClient($arr_order['user_id'], $arr_order['order_id'], "completed");
          if($updstatus == "true"){
            // ---- ACTUALIZAR LA DIRECCIÓN DEL USUARIO
            $addcustomeraddress = $customaddressses->addCustomerAddress($arr_customer_addresses);
            
            // print_r($addcustomeraddress);
            // exit();
            
            if($addcustomeraddress[0]['res'] == "first_time"){
                $r = array(
                  "r" => "true"
                );
                header("Location: ./confirm");
            }else if($addcustomeraddress[0]['res'] == "second_time"){
                $r = array(
                  "r" => "second_timeaddress"
                );
                header("Location: ./confirm");
            }else{
                $r = array(
                  "r" => "err_addaddress"
                );
                header("Location: ./");
            }
          }else{
            $r = array(
              "r" => "err_updstatus"
            );
            header("Location: ./");
          }
        }else{
          $r = array(
            "r" => "err_updorderid"
          );
          header("Location: ./");
        }
      }else if($add[0]['r'] == "order_exists"){
        $updorderid = $orders->updateOrderIdTempCart_ByIdClient($arr_order['user_id'], $arr_order['order_id']);
        if($updorderid == "true"){
          $updstatus = $orders->updateStatusTempCart_ByIdClient($arr_order['user_id'], $arr_order['order_id'], "in_process");
          if($updstatus == "true"){
            $r = array(
              "r" => "true"
            );
            header("Location: ./confirm");
          }else{
            $r = array(
              "r" => "err_updstatus"
            );
            header("Location: ./");
          }
        }else{
          $r = array(
            "r" => "err_updorderid"
          );
          header("Location: ./");
        }
      }else{
        header("Location: ./");
      }
      
    }else{
      header("Location: ./");
    }
    */
  }
  /* ---------------- AL ENVIAR DATOS DESDE EL MÉTODO DE PAGO ---------------- */
	public function checkout(PaymentRequest $request){
    
    echo "<pre>";
    print_r($request->all());
    echo "<pre>";
    exit();    

    $input = $request->all();
    $checkout = false;
    $payment_redirect = false;
    $payment = null;
    if(Session::has('currency')){
      $currency = Currency::findOrFail(Session::get('currency'));
    }else{
      $currency = Currency::where('is_default',1)->first();
    }
    // use currency check
    $usd_supported = ['USD','EUR'];
    $paypal_supported = ['USD','EUR','AUD','BRL','CAD','HKD','JPY','MXN','NZD','PHP','GBP','RUB'];
    $paystack_supported = ['NGN'];
    switch ($input['payment_method']){
      case 'Stripe':
        if(!in_array($currency->name,$usd_supported)){
          Session::flash('error',__('Moneda no admitida'));
          return redirect()->back();
        }
        $checkout = true;
        $payment = $this->stripeSubmit($input);
      break;
      case 'Paypal':
        if(!in_array($currency->name,$paypal_supported)){
          Session::flash('error',__('Moneda no admitida'));
          return redirect()->back();
        }
        $checkout = true;
        $payment_redirect = true;
        $payment = $this->paypalSubmit($input);
      break;
      case 'Mollie':
        if(!in_array($currency->name,$usd_supported)){
          Session::flash('error',__('Moneda no admitida'));
          return redirect()->back();
        }
        $checkout = true;
        $payment_redirect = true;
        $payment = $this->MollieSubmit($input);
      break;
      case 'Paystack':
        if(!in_array($currency->name,$paystack_supported)){
          Session::flash('error',__('Moneda no admitida'));
          return redirect()->back();
        }
        $checkout = true;
        $payment = $this->PaystackSubmit($input);
      break;
      case 'Bank':
        $checkout = true;
        $payment = $this->BankSubmit($input);
      break;
      case 'Cash On Delivery':
        $checkout = true;
        $payment = $this->cashOnDeliverySubmit($input);
      break;
    }
    if($checkout){
      if($payment_redirect){
        if($payment['status']){
          return redirect()->away($payment['link']);
        }else{
          Session::put('message',$payment['message']);
          return redirect()->route('front.checkout.cancle');
        }
      }else{
        if($payment['status']){
          return redirect()->route('front.checkout.success');
        }else{
          Session::put('message',$payment['message']);
          return redirect()->route('front.checkout.cancle');
        }
      }
    }else{
      return redirect()->route('front.checkout.cancle');
    }
	}
	public function paymentRedirect(Request $request){
    $responseData = $request->all();
    if(Session::has('order_payment_id')){
      $payment = $this->paypalNotify($responseData);
      if($payment['status']){
        return redirect()->route('front.checkout.success');
      }else{
        Session::put('message',$payment['message']);
        return redirect()->route('front.checkout.cancle');
      }
    }else{
      return redirect()->route('front.checkout.cancle');
    }
  }
	public function mollieRedirect(Request $request){
    $responseData = $request->all();
    $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
    $responseData['payment_id'] = $payment->id;
    if($payment->status == 'paid'){
      $payment = $this->mollieNotify($responseData);
      if($payment['status']){
        return redirect()->route('front.checkout.success');
      }else{
        Session::put('message',$payment['message']);
        return redirect()->route('front.checkout.cancle');
      }
    }else{
      return redirect()->route('front.checkout.cancle');
    }
  }
	public function paymentSuccess(){
    if(Session::has('order_id')){
      $order_id = Session::get('order_id');
      $order = Order::find($order_id);
      $cart = json_decode($order->cart, true);
      $setting = Setting::first();
      if($setting->is_twilio == 1){
        $sms = new SmsHelper();
        $user_number = $order->user->phone;
        if($user_number){
          $sms->SendSms($user_number,"'purchase'");
        }
      }
      return view('front.checkout.success',compact('order','cart'));
    }
    return redirect()->route('front.index');
	}
	public function paymentCancle(){
    $message = '';
    if(Session::has('message')){
      $message = Session::get('message');
      Session::forget('message');
    }else{
      $message = __('Payment Failed!');
    }
    Session::flash('error',$message);
    return redirect()->route('front.checkout.billing');
	}
  public function stateSetUp($state_id){
    if (!Session::has('cart')){
      return redirect(route('front.cart'));
    }
    $cart = Session::get('cart');
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $attribute_price = 0;
    foreach($cart as $key => $item){
      $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
      $total += ($item['main_price'] + $attribute_price) * $item['qty'];
      $cart_total = $total;
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
    $discount = [];
    if(Session::has('coupon')){
      $discount = Session::get('coupon');
    }
    $grand_total = ($cart_total + ($shipping?$shipping->price:0)) + $total_tax;
    $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
    $state_price = 0;
    if($state_id){
      $state = State::findOrFail($state_id);
      if($state->type == 'fixed'){
        $state_price = $state->price;
      }else{
        $state_price = ($cart_total * $state->price) / 100;
      }
    }else{
      if(Auth::check() && Auth::user()->state_id){
        $state = Auth::user()->state;
        if($state->type == 'fixed'){
          $state_price = $state->price;
        }else{
          $state_price = ($cart_total * $state->price) / 100;
        }
      }else{
        $state_price = 0;
      }
    }
    // $total_amount = $grand_total + $state_price;
    $total_amount = $grand_total;
    $data['state_price'] = PriceHelper::setCurrencyPrice($state_price);
    $data['grand_total'] = PriceHelper::setCurrencyPrice($total_amount);
    return response()->json($data);
  }
  /* ------------------- NUEVO CONTENIDO ------------------- */
  public function getAllDepartamentos(){
    $departamentos = Departamento::get()->toArray();
    $data = $departamentos;
    return response()->json(['data'=>$data]);
  }
  public function getProvinciaByIdDepartamento(Request $request){
    if($request->departamento_code){
      $provincias = Provincia::where('departamento_code', $request->departamento_code)->get()->toArray();
      $data = $provincias;
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function getDistritoByIdProvincia(Request $request){
    if($request->provincia_code){
      $distritos = Distrito::where('provincia_code', $request->provincia_code)->get()->toArray();
      $data = $distritos;
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function getGeneratePDFOrderPreview(){
    $get_idUser = Auth::user()->id;
    $get_BillingAddress = Session::get('billing_address');
    $get_ShippingAddress = Session::get('shipping_address');
    $get_SessionCart = Session::get('cart');
    $get_SessionCartFormat = [];
    $countAllProds = 0;
    $newSubtotalAllProds = 0;
    foreach($get_SessionCart as $k => $v){
      $newIdProds = str_replace('-','', $k);
      $newSubtotalProds = $v['price'] * $v['qty'];
      $newSubtotalProdsFormat = (isset($v['subtotal']) && !empty($v['subtotal'])) ? $v['subtotal'] : PriceHelper::setCurrencyPrice($newSubtotalProds);
      $newSubtotalAllProds += $newSubtotalProds;
      $get_SessionCartFormat[$countAllProds] = [
        'id' => $newIdProds,
        'options_id' => (isset($v['options_id']) && !empty($v['options_id'])) ? $v['options_id'] : [],
        'attribute' => (isset($v['attribute']) && !empty($v['attribute'])) ? $v['attribute'] : [],
        'attribute_price' => (isset($v['attribute_price']) && !empty($v['attribute_price'])) ? $v['attribute_price'] : [],
        'name' => (isset($v['name']) && !empty($v['name'])) ? $v['name'] : 'No encontrado',
        'slug' => (isset($v['slug']) && !empty($v['slug'])) ? $v['slug'] : 'No-encontrado',
        'sku' => (isset($v['sku']) && !empty($v['sku'])) ? $v['sku'] : 'No-encontrado',
        'brand_name' => (isset($v['brand_name']) && !empty($v['brand_name'])) ? $v['brand_name'] : 'No-encontrado',
        'qty' => (isset($v['qty']) && !empty($v['qty'])) ? $v['qty'] : 0,
        'price' => (isset($v['price']) && !empty($v['price'])) ? PriceHelper::setCurrencyPrice($v['price']) : 0,
        'main_price' => (isset($v['main_price']) && !empty($v['main_price'])) ? PriceHelper::setCurrencyPrice($v['main_price']) : 0,
        'photo' => (isset($v['photo']) && !empty($v['photo'])) ? $v['photo'] : '',
        'type' => (isset($v['type']) && !empty($v['type'])) ? $v['type'] : '',
        'item_type' => (isset($v['item_type']) && !empty($v['item_type'])) ? $v['item_type'] : 'Normal',
        'item_l_n' => (isset($v['item_l_n']) && !empty($v['item_l_n'])) ? $v['item_l_n'] : [],
        'item_l_k' => (isset($v['item_l_k']) && !empty($v['item_l_k'])) ? $v['item_l_k'] : [],
        'user_id' => (isset($v['user_id']) && !empty($v['user_id'])) ? $v['user_id'] : $get_idUser,
        'subtotal' => $newSubtotalProdsFormat,
      ];
      $countAllProds++;
    }
    
    $get_SessionCartSubtotal = [
      'totalNeto' => PriceHelper::setCurrencyPrice($newSubtotalAllProds)
    ];

    // ---------- DIRECCIÓN DE ENVÍO
    $reg_address1 = (isset(Auth::user()->reg_address1) && !empty(Auth::user()->reg_address1))? Auth::user()->reg_address1 : '';
    $reg_address2 = (isset(Auth::user()->reg_address2) && !empty(Auth::user()->reg_address2))? Auth::user()->reg_address2 : '';
    $reg_addressFinal = '';
    if(!empty($reg_address1) && !empty($reg_address2)){
      $reg_addressFinal = $reg_address1.", ".$reg_address2;
    }else if(!empty($reg_address1) && empty($reg_address2)){
      $reg_addressFinal = $reg_address1;
    }else if(empty($reg_address1) && !empty($reg_address2)){
      $reg_addressFinal = $reg_address2;
    }else{
      if(!empty($get_ShippingAddress['ship_address1']) && !empty($get_ShippingAddress['ship_address2'])){
        $reg_addressFinal = $get_ShippingAddress['ship_address1'].", ".$get_ShippingAddress['ship_address2'];
      }else if(!empty($get_ShippingAddress['ship_address1']) && empty($get_ShippingAddress['ship_address2'])){
        $reg_addressFinal = $get_ShippingAddress['ship_address1'];
      }else if(empty($get_ShippingAddress['ship_address1']) && !empty($get_ShippingAddress['ship_address2'])){
        $reg_addressFinal = $get_ShippingAddress['ship_address2'];
      }else{
        $reg_addressFinal = '';
      }
    }
    // ---------- TELÉFONO
    $reg_phone = (isset($get_ShippingAddress['ship_phone'])) && !empty($get_ShippingAddress['ship_phone']) ? $get_ShippingAddress['ship_phone'] : '';
    $reg_phoneFinal = '';
    if(!empty($reg_phone) || $reg_phone != 0){
      $reg_phoneFinal = $reg_phone;
    }else{
      $reg_phoneFinal = Auth::user()->phone;
    }

    // ---------- CLIENTE/RAZON SOCIAL
    $reg_razonsocial = (isset($get_ShippingAddress['ship_razonsocial'])) && !empty($get_ShippingAddress['ship_razonsocial']) ? $get_ShippingAddress['ship_razonsocial'] : '';
    $reg_razonsocialFinal = '';
    if(!empty($reg_razonsocial)){
      $reg_razonsocialFinal = $reg_razonsocial;
    }else{
      $reg_razonsocialFinal = Auth::user()->reg_razonsocial;
    }
    
    $get_SessionUserInfo = [
      'date' => date('Y/m/d H:i:s'),
      'client' => $reg_razonsocialFinal,
      'name' => Auth::user()->first_name . Auth::user()->last_name,
      'ruc' => (isset(Auth::user()->reg_ruc) && !empty(Auth::user()->reg_ruc))? Auth::user()->reg_ruc : 'No especificado',
      'user' => (isset(Auth::user()->email) && !empty(Auth::user()->email))? Auth::user()->email : 'No especificado',
      'address' => $reg_addressFinal,
      'phone' => $reg_phoneFinal,
      'email' => (isset(Auth::user()->email) && !empty(Auth::user()->email))? Auth::user()->email : 'No especificado',
    ];
    

    $dataPDF = [
      "billing_address" => $get_BillingAddress,
      "shipping_address" => $get_ShippingAddress,
      "session_cart" => $get_SessionCartFormat,
      "session_cartSubtotal" => $get_SessionCartSubtotal,
      "session_userInfo" => $get_SessionUserInfo,
    ];
    
    return PDF::loadView('front.checkout.gen_pdforderpreview', compact('dataPDF'))
          ->setPaper('A4', 'landscape')
          ->stream('ejemplo.pdf', array('Attachment' => true))
          ->header('Content-Type', 'application/pdf');
    
    exit();
  }
}