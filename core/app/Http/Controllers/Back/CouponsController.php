<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Coupons,
  Repositories\Back\CouponsRepository,
  Http\Requests\CouponsRequest,
  Http\Controllers\Controller
};
use Illuminate\Http\Request;
class CouponsController extends Controller{
  public function __construct(CouponsRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.coupons.index',[
      'datas' => Coupons::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.coupons.create');
  }
  public function store(Request $request){
    $this->repository->store($request);
    return redirect()->route('back.coupons.index')->withSuccess(__('New Coupon Added Successfully.'));
  }
  public function status($id,$status){
    Coupons::find($id)->update(['status' => $status]);
    return redirect()->route('back.coupons.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function edit(Coupons $coupons, $id){
    $coupons_2 = json_decode($coupons, TRUE);
    if(count($coupons_2) > 0){
      return redirect()->route('back.coupons.index');
    }else{
      $coupons = Coupons::where('id','=',$id)->first();
      return view('back.coupons.edit',compact('coupons'));
    }
  }
  public function update(CouponsRequest $request, Coupons $coupons){
    $this->repository->update($coupons, $request);
    return redirect()->route('back.coupons.index')->withSuccess(__('Coupon Updated Successfully.'));
  }
  public function destroy(Coupons $coupons, $id){ 
    $coupons = Coupons::findOrFail($id);
    $mgs = $this->repository->delete($coupons);
    if($mgs['status'] == 1){
        return redirect()->route('back.coupons.index')->withSuccess($mgs['message']);
    }else{
        return redirect()->route('back.coupons.index')->withError($mgs['message']);
    }
  }
}