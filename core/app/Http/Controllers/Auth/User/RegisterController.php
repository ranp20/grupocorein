<?php
namespace App\Http\Controllers\Auth\User;
use App\{
  Http\Requests\UserRequest,
  Http\Controllers\Controller,
  Repositories\Front\UserRepository
};
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller{

  public function __construct(UserRepository $repository){
    $this->repository = $repository;
  }

  public function showForm(){
    return view('user.auth.register');
  }

  public function register(UserRequest $request){

    $ruc = "";
    $address1 = "";
    $address2 = "";
    $razonsocial = "";
    $addressfiscal = "";
    $codepostal = 0;
    $country = 0;
    $departamento = 0;
    $provincia = 0;
    $distrito = 0;
    $streetaddress = "";
    $referenceaddress = "";
    $addresseeaddress = "";

    if(!isset($_POST['reg_enterprise']) || empty($request->post('reg_enterprise')) || $request->post('reg_enterprise') == ""){
      $request->request->add(['reg_enterprise' => 'off']);
    }else{
      if($request->post('reg_enterprise') != ""){
        $address1 = (isset($_POST['reg_address1']) && !empty($request->post('reg_address1')) && $request->post('reg_address1') != "") ? $request->post('reg_address1') : '';
        $address2 = (isset($_POST['reg_address2']) && !empty($request->post('reg_address2')) && $request->post('reg_address2') != "") ? $request->post('reg_address2') : '';
        $ruc = (isset($_POST['reg_ruc']) && !empty($request->post('reg_ruc')) && $request->post('reg_ruc') != "") ? $request->post('reg_ruc') : '';
        $razonsocial = (isset($_POST['reg_razonsocial']) && !empty($request->post('reg_razonsocial')) && $request->post('reg_razonsocial') != "") ? $request->post('reg_razonsocial') : '';
        $addressfiscal = (isset($_POST['reg_addressfiscal']) && !empty($request->post('reg_addressfiscal')) && $request->post('reg_addressfiscal') != "") ? $request->post('reg_addressfiscal') : '';
        $codepostal = (isset($_POST['reg_codepostal']) && !empty($request->post('reg_codepostal')) && $request->post('reg_codepostal') != "") ? $request->post('reg_codepostal') : 0;
        $country = (isset($_POST['reg_country']) && !empty($request->post('reg_country')) && $request->post('reg_country') != "") ? $request->post('reg_country') : 0;
        $departamento = (isset($_POST['reg_departamento']) && !empty($request->post('reg_departamento')) && $request->post('reg_departamento') != "") ? $request->post('reg_departamento') : 0;
        $provincia = (isset($_POST['reg_provincia']) && !empty($request->post('reg_provincia')) && $request->post('reg_provincia') != "") ? $request->post('reg_provincia') : 0;
        $distrito = (isset($_POST['reg_distrito']) && !empty($request->post('reg_distrito')) && $request->post('reg_distrito') != "") ? $request->post('reg_distrito') : 0;
        $streetaddress = (isset($_POST['reg_streetaddress']) && !empty($request->post('reg_streetaddress')) && $request->post('reg_streetaddress') != "") ? $request->post('reg_streetaddress') : "";
        $referenceaddress = (isset($_POST['reg_referenceaddress']) && !empty($request->post('reg_referenceaddress')) && $request->post('reg_referenceaddress') != "") ? $request->post('reg_referenceaddress') : "";
        $addresseeaddress = (isset($_POST['reg_addresseeaddress']) && !empty($request->post('reg_addresseeaddress')) && $request->post('reg_addresseeaddress') != "") ? $request->post('reg_addresseeaddress') : "";
      }
    }

    $request->request->add(['reg_address1' => $address1]);
    $request->request->add(['reg_address2' => $address2]);
    $request->request->add(['reg_ruc' => $ruc]);
    $request->request->add(['reg_razonsocial' => $razonsocial]);
    $request->request->add(['reg_addressfiscal' => $addressfiscal]);
    $request->request->add(['reg_codepostal' => $codepostal]);
    $request->request->add(['reg_country_id' => $country]);
    $request->request->add(['reg_departamento_id' => $departamento]);
    $request->request->add(['reg_provincia_id' => $provincia]);
    $request->request->add(['reg_distrito_id' => $distrito]);
    $request->request->add(['reg_streetaddress' => $streetaddress]);
    $request->request->add(['reg_referenceaddress' => $referenceaddress]);
    $request->request->add(['reg_addresseeaddress' => $addresseeaddress]);

    $request->validate([
      'email' => 'required|email|unique:users,email'
    ]);
    $this->repository->register($request);
    Session::flash('success',__('Account Register Successfully please login'));
    return redirect()->back();
  }
  
  public function verify($token){
    $user = User::where('email_token',$token)->first();
    if($user){
      Auth::login($user); 
      return redirect(route('user.dashboard'));
    }else{
      return redirect(route('user.login'));
    }
  }
}