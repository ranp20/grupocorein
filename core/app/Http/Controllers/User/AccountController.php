<?php
namespace App\Http\Controllers\User;
use App\{
  Http\Requests\UserRequest,
  Http\Controllers\Controller,
  Repositories\Front\UserRepository
};
use App\Helpers\ImageHelper;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller{
  public function __construct(UserRepository $repository){
    $this->middleware('auth');
    $this->middleware('localize');
    $this->repository = $repository;
  }
  public function index(){
    return view('user.dashboard.dashboard',[
      'allorders' => Order::whereUserId(Auth::user()->id)->count(),
      'pending' => Order::whereUserId(Auth::user()->id)->whereOrderStatus('pending')->count(),
      'progress' => Order::whereUserId(Auth::user()->id)->whereOrderStatus('In Progress')->count(),
      'delivered' => Order::whereUserId(Auth::user()->id)->whereOrderStatus('Delivered')->count(),
      'canceled' => Order::whereUserId(Auth::user()->id)->whereOrderStatus('Canceled')->count()
    ]);
  }
  public function profile(){
    $user = Auth::user();
    $check_newsletter = Subscriber::where('email',$user->email)->exists();
    return view('user.dashboard.index',[
      'user' => $user,
      'check_newsletter' => $check_newsletter,
    ]);
  }
  public function profileUpdate(UserRequest $request){
    $this->repository->profileUpdate($request);
    Session::flash('success',__('Profile Updated Successfully.'));
    return redirect()->back();
  }
  public function addresses(){
    $user = Auth::user();
    return view('user.dashboard.address',[
      'user' => $user
    ]);
  }
  public function billingSubmit(Request $request){
    $request->validate([
      'bill_address1' => 'required|max:100',
      'bill_address2' => 'nullable|max:100',
      'bill_zip'      => 'nullable|max:100',
      'bill_city'      => 'required|max:100',
      'bill_company'   => 'nullable|max:100',
      'bill_country'   => 'required|max:100',
    ]);
    $user =  Auth::user();
    $input = $request->all();
    $user->update($input);
    Session::flash('success',__('Address update successfully'));
    return back();
  }
  public function shippingSubmit(Request $request){
    $request->validate([
      /*
      'ship_address1' => 'required|max:100',
      'ship_address2' => 'nullable|max:100',
      'ship_zip'      => 'nullable|max:100',
      'ship_city'      => 'required|max:100',
      'ship_company'   => 'nullable|max:100',
      'ship_country'   => 'required|max:100',
      */
      'reg_address1'   => 'required',
      'reg_address2'   => 'required',
      'reg_codepostal'   => 'required',
      'reg_country_id'   => 'required',
      'reg_departamento_id'   => 'required',
      'reg_provincia_id'   => 'required',
      'reg_distrito_id'   => 'required',
      'reg_streetaddress'   => 'required',
      'reg_referenceaddress'   => 'required',
      'reg_addresseeaddress'   => 'required',
    ]);
    $user =  Auth::user();
    $input = $request->all();
    $user->update($input);
    Session::flash('success',__('Address update successfully'));
    return back();
  }
  public function changeIconUser(Request $request){
    if(isset($request['user_id'])){
      $user = User::findOrFail($request['user_id']);
    }else{
      $user = Auth::user();
    }
    $input = $request->all();
    if($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedImageUser($file,'/assets/images/users',$user,'/assets/images/users/','photo');
      $user = Auth::user();
      $user->update($input);
      $data = [
        "type" => "success",
        "mssg" => "Su avatar fue actualizado correctamente.",
      ];
      $res = json_encode($data);
      return $res;
    }
  }
  public function removeAccount(){
    $user = User::where('id',Auth::user()->id)->first();
    ImageHelper::handleDeletedImage($user,'photo','assets/images/users');
    $user->delete();
    Session::flash('success',__('Your account successfully remove'));
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
    return redirect(route('front.index'));
  }
}