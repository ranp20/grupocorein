<?php
namespace App\Repositories\Back;
use App\{
  Helpers\ImageHelper,
  Models\PaymentSetting
};
class PaymentSettingRepository{
  public function payment(){
    $cod = PaymentSetting::whereUniqueKeyword('cod')->first();
    $data['cod'] = $cod;
    $stripe = PaymentSetting::whereUniqueKeyword('stripe')->first();
    $data['stripeData'] = $stripe->convertJsonData();
    $data['stripe'] = $stripe;
    $paypal = PaymentSetting::whereUniqueKeyword('paypal')->first();
    $data['paypalData'] = $paypal->convertJsonData();
    $data['paypal'] = $paypal;
    $molly = PaymentSetting::whereUniqueKeyword('mollie')->first();
    $data['mollyData'] = $molly->convertJsonData();
    $data['molly'] = $molly;
    $paytm = PaymentSetting::whereUniqueKeyword('paytm')->first();
    $data['paytmData'] = $paytm->convertJsonData();
    $data['paytm'] = $paytm;
    $razorpay = PaymentSetting::whereUniqueKeyword('razorpay')->first();
    $data['razorpayData'] = $razorpay->convertJsonData();
    $data['razorpay'] = $razorpay;
    $sslcommerz = PaymentSetting::whereUniqueKeyword('sslcommerz')->first();
    $data['sslcommerzData'] = $sslcommerz->convertJsonData();
    $data['sslcommerz'] = $sslcommerz;
    $mercadopago = PaymentSetting::whereUniqueKeyword('mercadopago')->first();
    $data['mercadopagoData'] = $mercadopago->convertJsonData();
    $data['mercadopago'] = $mercadopago;
    $authorize = PaymentSetting::whereUniqueKeyword('authorize')->first();
    $data['authorizeData'] = $authorize->convertJsonData();
    $data['authorize'] = $authorize;
    $paystack = PaymentSetting::whereUniqueKeyword('paystack')->first();
    $data['paystackData'] = $paystack->convertJsonData();
    $data['paystack'] = $paystack;
    $flutterwave = PaymentSetting::whereUniqueKeyword('flutterwave')->first();
    $data['flutterwaveData'] = $flutterwave->convertJsonData();
    $data['flutterwave'] = $flutterwave;
    $bank = PaymentSetting::whereUniqueKeyword('bank')->first();
    $data['bank'] = $bank;
    $izipay = PaymentSetting::whereUniqueKeyword('izipay')->first();
    $data['izipayData'] = $izipay->convertJsonData();
    $data['izipay'] = $izipay;
    return $data;
  }
  public function update($request){
    $input = $request->all();
    $pay_data = PaymentSetting::whereUniqueKeyword($input['unique_keyword'])->first();
    if($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/back/images/payment',$pay_data,'/assets/back/images/payment/','photo');
    }
    if($request->has('pkey')){
      $info_data = $input['pkey'];
      if($pay_data->unique_keyword == 'mollie'){
        $paydata = $pay_data->convertJsonData();
        $prev = $paydata['key'];
      }
      if(array_key_exists("check_sandbox",$info_data)){
        $info_data['check_sandbox'] = 1;
      }else{
        if(strpos($pay_data->information, 'check_sandbox') !== false){
          $info_data['check_sandbox'] = 0;
        }
      }
      $input['information'] = json_encode($info_data);
    }
    if($request->has('status')){
      $input['status'] = 1;
    }else{
      $input['status'] = 0;
    }
    $pay_data->update($input);
    if($pay_data->unique_keyword == 'mollie'){
      $paydata = $pay_data->convertJsonData();
      $this->setEnv('MOLLIE_KEY',$input['pkey']['key'],$prev);
    }
  }
  private function setEnv($key, $value,$prev){
    file_put_contents(app()->environmentFilePath(), str_replace(
      $key . '=' . $prev,
      $key . '=' . $value,
      file_get_contents(app()->environmentFilePath())
    ));
  }
}