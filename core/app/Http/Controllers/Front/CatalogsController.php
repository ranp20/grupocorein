<?php
namespace App\Http\Controllers\Front;
use Illuminate\{
  Http\Request,
  Support\Facades\Session
};
use App\{
  Models\Catalog,
  Http\Controllers\Controller,
};
use Auth;
use App\Models\Setting;
class CatalogsController extends Controller{
  public function __construct(){
    $this->middleware('localize');
  }
	public function index(Request $request){
    $setting = Setting::first();
    $sorting = $request->has('sorting') ?  ( !empty($request->sorting) ? $request->sorting : null ) : null;
    $new = $request->has('new') ?  ( !empty($request->new) ? 1 : null ) : null;
    $top = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'top') ? 1 : null ) : null;
    $best = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'best') ? 1 : null ) : null;
    $new = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'new') ? 1 : null ) : null;

    $items = Catalog::when($new, function ($query){
      return $query->orderby('id','desc');
    })
    ->when($top, function ($query){
      return $query->whereIsType('top');
    })
    ->when($best, function ($query){
      return $query->whereIsType('best');
    })
    ->when($new, function ($query){
      return $query->whereIsType('new');
    })
    ->where('status',1)
    ->orderby('id','desc')->paginate($setting->view_product);
    $blade = 'front.catalogs.index';
    // if($request->ajax()) $blade = 'front.catalogs.catalog';
    return view($blade,[ 'items' => $items ]);
	}
  // public function viewType($type){
  //   Session::put('view_catalog',$type);
  //   return response()->json($type);
  // }
}