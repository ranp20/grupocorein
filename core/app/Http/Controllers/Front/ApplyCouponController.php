<?php
namespace App\Http\Controllers\Front;
use Illuminate\{
    Http\Request,
    Support\Facades\Session
};
use App\{
    Models\ApplyCoupon,
    Http\Controllers\Controller,
    Repositories\Front\ApplyCouponRepository
};
use Auth;
use App\Models\Setting;
class ApplyCouponController extends Controller{
    
    public function __construct(ApplyCouponRepository $repository){
        $this->repository = $repository;
        $this->middleware('localize');
    }

    public function index(){
        //
    }

    public function create(){
        //
    }

    public function store(Request $request){

        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        exit();

        $this->repository->store($request);
        return redirect()->back()->withSuccess(__('New Coupon Added Successfully.'));
    }
    
    public function show(ApplyCoupon $applyCoupon){
        //
    }

    public function edit(ApplyCoupon $applyCoupon){
        //
    }

    public function update(Request $request, ApplyCoupon $applyCoupon){
        //
    }

    public function destroy(ApplyCoupon $applyCoupon){
        //
    }
}
