<?php
namespace App\Http\Controllers\User;
use App\{
  Models\Order,
  Models\TrackOrder,
  Http\Controllers\Controller
};
use App\Helpers\PriceHelper;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
class OrderController extends Controller{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('localize');
  }
  public function index(){
    $orders = Order::whereUserId(Auth::user()->id)->latest('id')->get();
    return view('user.order.index',compact('orders'));
  } 
  public function details($id){
    $user = Auth::user();
    $order = Order::findOrfail($id);
    $cart = json_decode($order->cart, true);
    return view('user.order.invoice',compact('user','order','cart'));
  }
  public function printOrder($id){
    $user = Auth::user();
    $order = Order::findOrfail($id);
    $cart = json_decode($order->cart, true);
    return view('user.order.print',compact('user','order','cart'));
  }
  public function getGeneratePDFOrderPreview(Request $request){
    $order = "";
    if(isset($request->id_order) && $request->id_order != ""){
      $order = Order::where('id', $request->id_order)->get()->toArray()[0];
      $orderBillingInfo = Order::where('id', $request->id_order)->select('billing_info')->get();
      // $orderBillingInfo = Order::findOrfail($request->id_order);
      $user = User::where('id', $order['user_id'])->get()->toArray()[0];
            
      $get_idUser = $user['id'];
      $nextIdGenCode = $order['id_gencode'];
      // $get_BillingAddress = json_decode($orderBillingInfo->billing_info,true);
      $get_BillingAddress = $orderBillingInfo;
      $get_ShippingAddress = $order['shipping_info'];
      $get_SessionCart = json_decode($order['cart'], TRUE);
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
      $reg_address1 = (isset($user['reg_address1']) && !empty($user['reg_address1']))? $user['reg_address1'] : '';
      $reg_address2 = (isset($user['reg_address2']) && !empty($user['reg_address2']))? $user['reg_address2'] : '';
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
          // $reg_addressFinal = $get_BillingAddress['bill_address1'] . " " . $get_BillingAddress['bill_address2'];
          // $reg_addressFinal = $get_BillingAddress['billing_info'];
          // $reg_addressFinal = $get_BillingAddress;
          $reg_addressFinal = 'No especificado';
          // foreach($get_BillingAddress->billing_info as $k => $v){
          //   $reg_addressFinal = [
          //     'bill_address1' => $v['bill_address1'],
          //     'bill_address2' => $v['bill_address2'],
          //   ];
          // }
        }
      }
      // ---------- TELÉFONO
      $reg_phone = (isset($get_ShippingAddress['ship_phone'])) && !empty($get_ShippingAddress['ship_phone']) ? $get_ShippingAddress['ship_phone'] : '';
      $reg_phoneFinal = '';
      if(!empty($reg_phone) || $reg_phone != 0){
        $reg_phoneFinal = $reg_phone;
      }else{
        $reg_phoneFinal = $user['phone'];
      }

      // ---------- CLIENTE/RAZON SOCIAL
      $reg_razonsocial = (isset($get_ShippingAddress['ship_razonsocial'])) && !empty($get_ShippingAddress['ship_razonsocial']) ? $get_ShippingAddress['ship_razonsocial'] : '';
      $reg_razonsocialFinal = '';
      if(!empty($reg_razonsocial)){
        $reg_razonsocialFinal = $reg_razonsocial;
      }else{
        if($user['reg_razonsocial'] || $user['reg_razonsocial'] != ""){
          $reg_razonsocialFinal = $user['reg_razonsocial'];
        }else{
          $reg_razonsocialFinal = $user['first_name'] . " " . $user['last_name'];
        }
      }

      // MONTO DE DELIVERY
      $ammountDeliveryShipping = (isset($get_ShippingAddress['ship_amountaddress']) && !empty($get_ShippingAddress['ship_amountaddress'])) ? $get_ShippingAddress['ship_amountaddress'] : 0;

      $get_SessionUserInfo = [
        'date' => date('Y/m/d H:i:s'),
        'client' => $reg_razonsocialFinal,
        'name' => $user['first_name'] . " " . $user['last_name'],
        'ruc' => (isset($user['reg_ruc']) && !empty($user['reg_ruc']))? $user['reg_ruc'] : 'No especificado',
        'user' => (isset($user['email']) && !empty($user['email']))? $user['email'] : 'No especificado',
        'address' => $reg_addressFinal,
        'phone' => $reg_phoneFinal,
        'email' => (isset($user['email']) && !empty($user['email']))? $user['email'] : 'No especificado',
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
    }   
    return PDF::loadView('back.order.gen_pdforderpreview', compact('dataPDF'))
          ->setPaper('A4', 'landscape')
          ->stream('ejemplo.pdf', array('Attachment' => true))
          ->header('Content-Type', 'application/pdf');
    exit();    
  }
}
