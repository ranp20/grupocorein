<?php
namespace App\Http\Controllers\Front;
use App\{
  Models\Item,
  Http\Controllers\Controller,
  Repositories\Front\TempCartRepository
};
use App\Helpers\PriceHelper;
use App\Models\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TempCartController extends Controller{

  public function __construct(TempCartRepository $repository){
    $this->repository = $repository;
    $this->middleware('localize');
  }
  public function index(){
    
  }  
  public function addToTempCart(Request $request){
    
  }
  public function store(Request $request){
    
  }
  public function destroy($id){
    
  }
  public function promoStore(Request $request){
    
  }
  public function shippingStore(Request $request){
    
  }  
  public function update($id){
    
  }
  public function shippingCharge(Request $request){
    
  }
  public function headerTempCartLoad(){
    
  }
  public function TempCartLoad(){
    
  }
  public function cartClear(){
    
  }
}