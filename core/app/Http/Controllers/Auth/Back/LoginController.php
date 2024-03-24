<?php
namespace App\Http\Controllers\Auth\Back;
use App\{
  Http\Controllers\Controller,
  Http\Requests\AuthRequest,
};
use Auth;
class LoginController extends Controller{
  public function __construct(){
    $this->middleware('guest:admin', ['except' => ['logout']]);
  }
  public function showForm(){
    return view('back.auth.login');
  }
  public function login(AuthRequest $request){
    if (Auth::guard('admin')->attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
      return redirect()->intended(route('back.dashboard'));
    }
    return redirect()->back()->withErrors(__('Email Or Password Doesn\'t Match !'))->withInput($request->except('password'));
  }
  public function logout(){
      Auth::guard('admin')->logout();
      return redirect('/admin');
  }
}