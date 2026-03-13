<?php
namespace App\Repositories\Front;
use App\{
  Models\User,
  Models\Setting,
  Helpers\EmailHelper,
  Models\Notification
};
use App\Helpers\ImageHelper;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class UserRepository{
  public function register($request){
    $input = $request->all();
    $user = new User;
    $input['password'] = bcrypt($request['password']);
    $input['email'] = $input['email'];
    $input['first_name'] = $input['first_name'];
    $input['last_name'] = $input['last_name'];
    $input['phone'] = str_replace(' ','',$input['phone']);
    $verify = Str::random(6);
    $input['email_token'] = $verify;
    $input['reg_enterprise'] = $input['reg_enterprise'];

    $input['reg_address1'] = (isset($input['reg_address1'])) ? $input['reg_address1'] : '';
    $input['reg_address2'] = (isset($input['reg_address2'])) ? $input['reg_address2'] : '';
    $input['reg_ruc'] = (isset($input['reg_ruc'])) ? $input['reg_ruc'] : '';
    $input['reg_razonsocial'] = (isset($input['reg_razonsocial'])) ? $input['reg_razonsocial'] : '';
    $input['reg_addressfiscal'] = (isset($input['reg_addressfiscal'])) ? $input['reg_addressfiscal'] : '';
    $input['reg_codepostal'] = (isset($input['reg_codepostal'])) ? $input['reg_codepostal'] : '';
    $input['reg_country'] = (isset($input['reg_country'])) ? $input['reg_country'] : '';
    $input['reg_departamento'] = (isset($input['reg_departamento'])) ? $input['reg_departamento'] : '';
    $input['reg_provincia'] = (isset($input['reg_provincia'])) ? $input['reg_provincia'] : '';
    $input['reg_distrito'] = (isset($input['reg_distrito'])) ? $input['reg_distrito'] : '';
    $input['reg_streetaddress'] = (isset($input['reg_streetaddress'])) ? $input['reg_streetaddress'] : '';
    $input['reg_referenceaddress'] = (isset($input['reg_referenceaddress'])) ? $input['reg_referenceaddress'] : '';
    $input['reg_addresseeaddress'] = (isset($input['reg_addresseeaddress'])) ? $input['reg_addresseeaddress'] : '';

    $user->fill($input)->save();
    Notification::create(['user_id' => $user->id]);
    $emailData = [
      'to' => $user->email,
      'type' => "Registration",
      'user_name' => $user->displayName(),
      'order_cost' => '',
      'transaction_number' => '',
      'site_title' => Setting::first()->title,
    ];
    $email = new EmailHelper();
    $email->sendTemplateMail($emailData);
  }
  public function profileUpdate($request){
    $input = $request->all();
    if($request['user_id']){
      $user = User::findOrFail($request['user_id']);
    }else{
      $user = Auth::user();
    }
    if($request['password'] && isset($input['password']) && !empty($input['password']) && $input['password'] != ""){
      $input['password'] = bcrypt($input['password']);
    }
    if($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedImageUser($file,'/assets/images/users',$user,'/assets/images/users/','photo');
    }
    if($request->newsletter){
      if(!Subscriber::where('email',$user->email)->exists()){
        Subscriber::insert([
          'email' => $user->email
        ]);
      }
    }else{
      Subscriber::where('email',$user->email)->delete();
    }
    $user->update($input);
  }
}