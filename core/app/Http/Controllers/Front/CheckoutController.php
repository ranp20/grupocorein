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
  Traits\BankCheckout,
  Traits\IzipayCheckout
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
use Cartalyst\Stripe\Api\Orders;
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
  use IzipayCheckout;
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
      $total += ($item['price'] + $attribute_price) * $item['qty'];
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

    $getUserInfo = Auth::user() ? Auth::user() : null;
    $regDistritoId = (isset($getUserInfo['reg_distrito_id']) && $getUserInfo['reg_distrito_id'] != "") ? $getUserInfo['reg_distrito_id'] : 0;
    $distritoGet = Distrito::where('id',$regDistritoId)->select('id','distrito_name','distrito_min_amount','distrito_max_amount')->first();
    $minAmountValidate = 1600.00;
    $minAmountDelivery = floatval($distritoGet->distrito_min_amount);
    $maxAmountDelivery = floatval($distritoGet->distrito_max_amount);
    $ship_data['ship_amountaddress'] = 0;
    if($total_amount >= $minAmountValidate){
      $data['amountaddress'] = $maxAmountDelivery;
      $total_amount_operation = $grand_total + $maxAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }else if($total_amount < $minAmountValidate){
      $data['amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }else{
      $data['amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }

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
    /*
    if(Session::has('shipping_address')){
      return redirect(route('front.checkout.payment'));
    }
    */
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
      $total += ($item['price'] + $attribute_price) * $item['qty'];
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
    
    $getUserInfo = Auth::user() ? Auth::user() : null;
    $regDistritoId = (isset($getUserInfo['reg_distrito_id']) && $getUserInfo['reg_distrito_id'] != "") ? $getUserInfo['reg_distrito_id'] : 0;
    $distritoGet = Distrito::where('id',$regDistritoId)->select('id','distrito_name','distrito_min_amount','distrito_max_amount')->first();
    $minAmountValidate = 1600.00;
    $minAmountDelivery = floatval($distritoGet->distrito_min_amount);
    $maxAmountDelivery = floatval($distritoGet->distrito_max_amount);
    $ship_data['ship_amountaddress'] = 0;
    if($total_amount >= $minAmountValidate){
      $data['amountaddress'] = $maxAmountDelivery;
      $total_amount_operation = $grand_total + $maxAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }else if($total_amount < $minAmountValidate){
      $data['amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }else{
      $data['amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
    }

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

    if(!is_array($ship)){
      $ship_array = explode(',', $ship);
    }else{
      $ship_array = $ship;
    }
    
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
      $total += ($item['price'] + $attribute_price) * $item['qty'];
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
    $ship_data['ship_amountaddressId'] = $distritoRequest;
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

    $ship_data['ship_email'] = (isset($bill['bill_email']) && $bill['bill_email'] != "") ? $bill['bill_email'] : "No definido";
    $ship_data['ship_zip'] = (isset($request->ship_zip) && $request->ship_zip != "") ? $request->ship_zip : "No definido";
    $ship_data['ship_country'] = (isset($request->ship_country) && $request->ship_country != "") ? $request->ship_country : "No definido";
    $ship_data['ship_departamento'] = (isset($request->ship_departamento) && $request->ship_departamento != "") ? $request->ship_departamento : "No definido";
    $ship_data['ship_provincia'] = (isset($request->ship_provincia) && $request->ship_provincia != "") ? $request->ship_provincia : "No definido";
    $ship_data['ship_distrito'] = (isset($request->ship_distrito) && $request->ship_distrito != "") ? $request->ship_distrito : "No definido";
    $ship_data['ship_streetaddress'] = (isset($request->ship_streetaddress) && $request->ship_streetaddress != "") ? $request->ship_streetaddress : "No definido";
    $ship_data['ship_referenceaddress'] = (isset($request->ship_referenceaddress) && $request->ship_referenceaddress != "") ? $request->ship_referenceaddress : "No definido";
    $ship_data['ship_addresseeaddress'] = (isset($request->ship_addresseeaddress) && $request->ship_addresseeaddress != "") ? $request->ship_addresseeaddress : "No definido";
    if($ship == "" || !isset($ship_array[0]) || $ship_array[0] == null || $ship_array[0] == ""){
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
  /* ---------------- ACTUALIZAR EL MONTO DE DELIVERY EN EL CARRITO ---------------- */
  public function updateAmountCart(Request $request){
    $cart = Session::get('cart');
    $total_tax = 0;
    $cart_total = 0;
    $total = 0;
    $total_amount = 0;
    $grand_total = 0;
    $attribute_price = 0;
    foreach($cart as $key => $item){
      $attribute_price = (isset($item['attribute_price']) && !empty($item['attribute_price'])) ? $item['attribute_price'] : 0;
      $total += ($item['price'] + $attribute_price) * $item['qty'];
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

    $getUserInfo = Auth::user() ? Auth::user() : null;
    $regDistritoCode = (isset($request['distrito_code']) && $request['distrito_code'] != "") ? $request['distrito_code'] : 0;
    $distritoGet = Distrito::where('distrito_code',$regDistritoCode)->select('id','distrito_name','distrito_min_amount','distrito_max_amount')->first();
    $minAmountValidate = 1600.00;
    $minAmountDelivery = floatval($distritoGet->distrito_min_amount);
    $maxAmountDelivery = floatval($distritoGet->distrito_max_amount);
    if($total_amount >= $minAmountValidate){
      $total_amount_operation = $grand_total + $maxAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $arrDataAmountCart = [
        "carttotal" => PriceHelper::setCurrencyPrice($grand_total),
        "amountaddress" => PriceHelper::setCurrencyPrice($maxAmountDelivery),
        "totalamount" => PriceHelper::setCurrencyPrice($total_amount),
      ];
      if(Session::has('shipping_address')){
        Session::put('shipping_address.ship_amountaddressId', $distritoGet->id);
        Session::put('ship_amountaddress', $maxAmountDelivery);
      }
    }else if($total_amount < $minAmountValidate){
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $arrDataAmountCart = [
        "carttotal" => PriceHelper::setCurrencyPrice($grand_total),
        "amountaddress" => PriceHelper::setCurrencyPrice($minAmountDelivery),
        "totalamount" => PriceHelper::setCurrencyPrice($total_amount),
      ];
      if(Session::has('shipping_address')){
        Session::put('shipping_address.ship_amountaddressId', $distritoGet->id);
        Session::put('ship_amountaddress', $minAmountDelivery);
      }
    }else{
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $arrDataAmountCart = [
        "carttotal" => PriceHelper::setCurrencyPrice($grand_total),
        "amountaddress" => PriceHelper::setCurrencyPrice($minAmountDelivery),
        "totalamount" => PriceHelper::setCurrencyPrice($total_amount),
      ];
      if(Session::has('shipping_address')){
        Session::put('shipping_address.ship_amountaddressId', $distritoGet->id);
        Session::put('ship_amountaddress', $minAmountDelivery);
      }
    }

    // return response()->json($arrDataAmountCart);
    return response()->json(['data'=>$arrDataAmountCart]);
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
      $total += ($item['price'] + $attribute_price) * $item['qty'];
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
    $regDistritoId = 0;
    $getUserInfo = Auth::user() ? Auth::user() : null;
    if(isset($getUserInfo['reg_distrito_id']) && $getUserInfo['reg_distrito_id'] != ""){
      if(Session::has('shipping_address.ship_amountaddressId') && Session::get('shipping_address.ship_amountaddressId') != ""){
        $regDistritoId = Session::get('shipping_address.ship_amountaddressId');
      }else{
        $regDistritoId = $getUserInfo['reg_distrito_id'];
      }
    }
    $distritoGet = Distrito::where('id',$regDistritoId)->select('id','distrito_name','distrito_min_amount','distrito_max_amount')->first();
    $minAmountValidate = 1600.00;
    $minAmountDelivery = floatval($distritoGet->distrito_min_amount);
    $maxAmountDelivery = floatval($distritoGet->distrito_max_amount);
    $ship_data['ship_amountaddress'] = 0;
    if($total_amount >= $minAmountValidate){
      $data['amountaddress'] = $maxAmountDelivery;
      $total_amount_operation = $grand_total + $maxAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
      Session::put('shipping_address.ship_amountaddress', $maxAmountDelivery);
      Session::put('shipping_address.grand_total', $total_amount);
    }else if($total_amount < $minAmountValidate){
      $data['amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
      Session::put('shipping_address.ship_amountaddress', $minAmountDelivery);
      Session::put('shipping_address.grand_total', $total_amount);
    }else{
      $data['amountaddress'] = $minAmountDelivery;
      $total_amount_operation = $grand_total + $minAmountDelivery;
      $total_amount = floatval($total_amount_operation);
      $ship_data['grand_total'] = $total_amount;
      Session::put('shipping_address.ship_amountaddress', $minAmountDelivery);
      Session::put('shipping_address.grand_total', $total_amount);
    }

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
  /* ---------------- AL ENVIAR DATOS DESDE EL MÉTODO DE PAGO ---------------- */
	public function checkout(PaymentRequest $request){

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
      case 'Izipay':
        $checkout = true;
        $payment = $this->IzipaySubmit($input);
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
      $total += ($item['price'] + $attribute_price) * $item['qty'];
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
  public function getGeneratePDFOrderPreview(){
    
    $ultimateIdGenCode = Order::select('id_gencode')->orderBy('id', 'desc')->take(1)->first();
    $nextIdGenCode = $this->getUltimateIdGenCode($ultimateIdGenCode);
    
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

    // MONTO DE DELIVERY
    $ammountDeliveryShipping = (isset($get_ShippingAddress['ship_amountaddress']) && !empty($get_ShippingAddress['ship_amountaddress'])) ? $get_ShippingAddress['ship_amountaddress'] : 0;

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
    
    $totalShipping = $newSubtotalAllProds + $ammountDeliveryShipping;
    $totalIGV = $newSubtotalAllProds * (18 / 100);
    // $totalNeto = $totalIGV + $totalShipping;
    $totalNeto = $totalShipping;

    $get_SessionCartSubtotal = [
      'subtotal' => PriceHelper::setCurrencyPrice($newSubtotalAllProds),
      'totalIGV' => PriceHelper::setCurrencyPrice($totalIGV),
      'delivery' => PriceHelper::setCurrencyPrice($ammountDeliveryShipping),
      'totalNeto' => PriceHelper::setCurrencyPrice($totalNeto)
    ];
    $setting = Setting::first();
    $getSettingsInfo = [
      'site_title' => $setting->title,
      'site_ruc' => $setting->ruc,
      'site_working-hours' => [
        'init' => $setting->friday_start,
        'end' => $setting->friday_end
      ],
      'site_weekend' => [
        'init' => $setting->satureday_start,
        'end' => $setting->satureday_end
      ]
    ];

    $dataPDF = [
      "billing_address" => $get_BillingAddress,
      "shipping_address" => $get_ShippingAddress,
      "session_cart" => $get_SessionCartFormat,
      "session_cartSubtotal" => $get_SessionCartSubtotal,
      "session_userInfo" => $get_SessionUserInfo,
      "system_settinginfo" => $getSettingsInfo,
      "getUltimateGenCodeOrder" => $nextIdGenCode
    ];
    
    return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
          ->loadView('front.checkout.gen_pdforderpreview', compact('dataPDF'))
          ->setPaper('A4', 'landscape')
          ->stream('ejemplo.pdf', array('Attachment' => true))
          ->header('Content-Type', 'application/pdf');
    
    exit();
  }
}