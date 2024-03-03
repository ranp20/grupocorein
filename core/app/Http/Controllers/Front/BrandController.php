<?php
namespace App\Http\Controllers\Front;
use Illuminate\{
  Http\Request,
  Support\Facades\Session
};
use App\{
  Models\Brand,
  Http\Controllers\Controller,
};
use Auth;
use App\Models\Setting;
class BrandController extends Controller{
  public function __construct(){
    $this->middleware('localize');
  }
	public function index(Request $request){
    $setting = Setting::first();
    $sorting = $request->has('sorting') ?  ( !empty($request->sorting) ? $request->sorting : null ) : null;
    $new = $request->has('new') ?  ( !empty($request->new) ? 1 : null ) : null;
    $brands = Brand::when($new, function ($query){
      return $query->orderby('id','asc');
    })
    ->where('status',1)
    ->orderby('id','asc')->paginate($setting->view_product);
    $blade = 'front.brands.index';
    return view($blade,[ 'brands' => $brands ]);
	}
}