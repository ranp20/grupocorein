<?php
namespace App\Http\Controllers\Auth\User;
use App\{
  Http\Controllers\Controller,
  Http\Requests\AuthRequest
};
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Brand;
use App\Models\TempCart;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller{
  public function __construct(){
    $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    $setting = Setting::first();
    if($setting->recaptcha == 1){
      Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
      Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
    }
  }
  public function showForm(){
    return view('user.auth.login');
  }
  public function login(AuthRequest $request){
    if (Auth::attempt(['email' => $request->login_email, 'password' => $request->login_password])){
      if(!Auth::user()->email_token){
        Session::flash('error',__('Email not verify !'));
        return redirect()->back();
      }
      if($request->has('modal')){
        return redirect()->back();
      }else{        
        $idUser = Auth::user()->id;
        $dataCartSess = TempCart::where("user_id", "=", $idUser)->get()->toArray();
        $newArrCartSessData = [];
        foreach($dataCartSess as $k => $v){
          $idProdFormatSessCart = $v['item_id']."-";
          $brandByIdTempCart = Brand::where('id',$v['brand_id'])->select('id','name','slug')->first();
          $newArrCartSessData[$idProdFormatSessCart] = [
            'options_id' => [],
            'attribute' => [],
            'attribute_price' => [],
            "attribute_collection" => $v['attribute_collection'],
            "name" => $v['name'],
            "slug" => $v['slug'],
            "sku" => $v['sku'],
            "brand_id" => (isset($brandByIdTempCart->id) && $brandByIdTempCart->id != "") ? $brandByIdTempCart->id : "",
            "brand_name" => (isset($brandByIdTempCart->name) && $brandByIdTempCart->name != "") ? $brandByIdTempCart->name : "",
            "qty" => $v['quantity'],
            "price" => $v['price'],
            "main_price" => $v['main_price'],
            "photo" => $v['photo'],
            "type" => $v['is_type'],
            "item_type" => $v['item_type'],
            "coupon_id" => $v['coupon_id'],
            "coupon_price" => $v['coupon_price'],
            "quantity_withoutcoupon" => $v['quantity_withoutcoupon'],
            'item_l_n' => null,
            'item_l_k' => null,
            "user_id" => $v['user_id']
          ];
        }        
        if(!Session::has('cart')){
          Session::put('cart', $newArrCartSessData);
        }else{
          Session::put('cart', $newArrCartSessData);
        }        
        return redirect()->intended(route('user.dashboard'));
      }
    }
    Session::flash('error',__('Email Or Password Doesn t Match !'));
    return redirect()->back();
  }
  public function logout(){
    // session()->flush(); // Eliminar todos los datos de session | Users & Admin
    session()->forget('cart');
    session()->forget('compare');
    session()->forget('view_catalog');
    session()->forget('billing_address');
    session()->forget('shipping_address');
    session()->forget('coupon');
    session()->forget('payment_id');
    session()->forget('order_id');
    session()->forget('searhproduct_user');
    session()->forget('data_voucher');
    session()->forget('message');
    Auth::logout();
    return redirect('/');
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
}