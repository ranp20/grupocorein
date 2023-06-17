<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Provincia,
  Models\Ciudad,
  Models\Distrito,
  Models\ShippingService,
  Http\Requests\ShippingServiceRequest,
  Http\Controllers\Controller
};
use App\Models\Currency;
use Illuminate\Http\Request;
class ShippingServiceController extends Controller{
  public function __construct(){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
  }
  public function index(){
    return view('back.shipping.index',[
      'datas' => ShippingService::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.shipping.create');
  }
  public function store(Request $request){
    $input = $request->all();
    $curr = Currency::where('is_default',1)->first();
    $input['price'] = $request->price / $curr->value;
    ShippingService::create($input);
    return redirect()->route('back.shipping.index')->withSuccess(__('New Shipping Service Added Successfully.'));
  }
  public function edit(ShippingService $shipping){
    return view('back.shipping.edit',compact('shipping'));
  }
  public function status($id,$status){
    ShippingService::find($id)->update(['status' => $status]);
    ShippingService::where('id','!=',$id)->where('id','!=',1)->update(['status' => 0]); 
    return redirect()->route('back.shipping.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function update(ShippingServiceRequest $request, ShippingService $shipping){
    $input = $request->all();
    $curr = Currency::where('is_default',1)->first();
    if($shipping->id == 1){
      if($request->is_condition){
        $input['is_condition'] = 1;
        $input['minimum_price'] = $request->minimum_price / $curr->value;
      }else{
        $input['is_condition'] = 0;
        $input['minimum_price'] = 0;
      }
    }
    $input['price'] = $request->price / $curr->value;
    $shipping->update($input);
    return redirect()->route('back.shipping.index')->withSuccess(__('Shipping Service Updated Successfully.'));
  }
  public function destroy(ShippingService $shipping){
    $shipping->delete();
    return redirect()->route('back.shipping.index')->withSuccess(__('Shipping Service Deleted Successfully.'));
  }
}