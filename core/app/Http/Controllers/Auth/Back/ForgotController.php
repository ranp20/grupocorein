<?php
namespace App\Http\Controllers\Auth\Back;
use App\{
  Models\Admin,
  Http\Controllers\Controller,
  Repositories\Both\ForgotRepository
};
use Illuminate\Http\Request;

class ForgotController extends Controller{
  public function __construct(ForgotRepository $repository){
    $this->repository = $repository;
    $this->middleware('guest:admin');
  }
  public function showForm(){
    return view('back.auth.forgot');
  }
  public function forgot(Request $request){
    if ($data = Admin::whereEmail($request->email)->first()){
      $this->repository->forgot($data,$request,'back');
      return redirect()->back()->withSuccess(__('We Have Sent a Link To Your Account!. Please Check Your Email.'));
    }
    else{
      return redirect()->back()->withErrors(__('No Account Found With This Email.'))->withInput($request->all());
    }
  }
  public function showChangePassForm($token){
    if($token){
      if( Admin::whereEmailToken($token)->exists() ){
        return view('back.auth.changepass',compact('token'));
      }
    }
  }
  public function changepass(Request $request){
    $data =  Admin::whereEmailToken($request->file_token)->first();
    $resp = $this->repository->updatePassword($data,$request,'back');
    if($resp['status']){
        return redirect($resp['redurect_url'])->withSuccess($resp['message']);
    }else{
        return redirect()->back()->withErrors($resp['message']);
    }
  }
}