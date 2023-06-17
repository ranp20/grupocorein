<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\PaymentSetting,
  Http\Controllers\Controller,
  Http\Requests\PaymentSettingRequest,
  Repositories\Back\PaymentSettingRepository
};
use Illuminate\Http\Request;
class PaymentSettingController extends Controller{
  public function __construct(PaymentSettingRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function payment(){
    return view('back.settings.payment', $this->repository->payment());
  }
  public function update(PaymentSettingRequest $request){
    $this->repository->update($request);
    return redirect()->back()->withSuccess(__('Payment Information Updated Successfully.'));
  }
}