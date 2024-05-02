<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Item,
  Models\Gallery,
  Http\Requests\ItemRequest,
  Http\Controllers\Controller,
  Http\Requests\GalleryRequest,
  Repositories\Back\ItemRepository
};
use App\Models\Category;
use App\Models\ChieldCategory;
use App\Models\Coupons;
use App\Models\Currency;
use App\Models\Subcategory;
use App\Models\Tax;
use Illuminate\Http\Request;
class ItemController extends Controller{
  public function __construct(ItemRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function add(){
    return view('back.item.add');
  }
  public function index(Request $request){
    $item_type = $request->has('item_type') ? ($request->item_type ? $request->item_type : '') : '';
    $is_type = $request->has('is_type') ? ($request->is_type ? $request->is_type : '') : '';
    $category_id = $request->has('category_id') ? ($request->category_id ? $request->category_id : '') : '';
    $coupon_id = $request->has('coupon_id') ? ($request->coupon_id ? $request->coupon_id : '') : '';
    $orderby = $request->has('orderby') ? ($request->orderby ? $request->orderby : 'desc') : 'desc';
    /* -- NUEVO CONTENIDO (INICIO) --*/
    $sku = $request->has('sku') ? ($request->sku ? $request->sku : '') : '';
    $sap_code = $request->has('sap_code') ? ($request->sap_code ? $request->sap_code : '') : '';
    /* -- NUEVO CONTENIDO (FIN) --*/
    $datas = Item::
    when($item_type, function ($query, $item_type) {
      return $query->where('item_type', $item_type);
    })
    ->when($is_type, function ($query, $is_type) {
      if($is_type != 'outofstock'){
        return $query->where('is_type', $is_type);
      }else{
        return $query->whereStock(0)->whereItemType('normal');
      }
    })
    ->when($category_id, function ($query, $category_id) {
      return $query->where('category_id', $category_id);
    })
    /* -- NUEVO CONTENIDO (INICIO) --*/
    ->when($coupon_id, function ($query, $coupon_id) {
      return $query->where('coupon_id', $coupon_id);
    })
    ->when($sku, function ($query, $sku) {
      return $query->where('sku', 'like', '%'.$sku.'%');
    })
    ->when($sap_code, function ($query, $sap_code) {
      return $query->where('sap_code', 'like', '%'.$sap_code.'%');
    })
    /* -- NUEVO CONTENIDO (FIN) --*/
    ->when($orderby, function ($query, $orderby) {
      return $query->orderby('id', $orderby);
    })
    ->get();
    return view('back.item.index',[
      'datas' => $datas
    ]);
  }
  public function getsubCategory(Request $request){
    if($request->category_id){
      $data = Category::findOrFail($request->category_id);
      $data = $data->subcategory;
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function getChildCategory(Request $request){
    if($request->subcategory_id){
      $data = Subcategory::findOrFail($request->subcategory_id);
      $data = $data->childcategory;
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function create(){
    return view('back.item.create',[
      'curr' => Currency::where('is_default',1)->first()
    ]);
  }
  public function removeComa($val){
    $val_double = str_replace(',','',$val);
    return $val_double;
  }
  public function store(ItemRequest $request){    
    $rComeFunction_on_sale_price = (isset($_POST['on_sale_price']) && !empty($request->post('on_sale_price')) && $request->post('on_sale_price') != "") ? $this->removeComa($request->post('on_sale_price')) : 0;
    $rComeFunction_special_offer_price = (isset($_POST['special_offer_price']) && !empty($request->post('special_offer_price')) && $request->post('special_offer_price') != "") ? $this->removeComa($request->post('special_offer_price')) : 0;
    $request->request->add(['on_sale_price' => $rComeFunction_on_sale_price]);
    $request->request->add(['special_offer_price' => $rComeFunction_special_offer_price]);
    $namProduct = e($request->post('name'));
    $names = Item::where('name', 'like', '%'.$namProduct.'%')->select('name')->get()->toArray();
    foreach($names as $name){
      if($name['name'] == $namProduct){
        return redirect()->route('back.item.create')->withErrors(__('El nombre del producto es idéntico a otro ya ingresado. Por favor, ingrese un nuevo nombre*.'));
      }
    }
    $item_id = $this->repository->store($request);
    // exit();
    if($request->is_button ==0){
      return redirect()->route('back.item.index')->withSuccess(__('Producto agregado con éxito.'));
    }else{
      return redirect(route('back.item.edit', $item_id))->withSuccess(__('Producto agregado con éxito.'));
    }
  }
  public function edit(Item $item){
    return view('back.item.edit',[
      'item' => $item,
      'curr' => Currency::where('is_default',1)->first(),
      'social_icons' => json_decode($item->social_icons,true),
      'social_links' => json_decode($item->social_links,true),
      'specification_name' => json_decode($item->specification_name,true),
      'specification_description' => json_decode($item->specification_description,true),
      'selectedIds' => ($item->store_availables && $item->store_availables != "") ? json_decode($item->store_availables, TRUE)['store'] : ''
    ]);
  }
  public function update(ItemRequest $request, Item $item){    
    $rComeFunction_on_sale_price = (isset($_POST['on_sale_price']) && !empty($request->post('on_sale_price')) && $request->post('on_sale_price') != "") ? $this->removeComa($request->post('on_sale_price')) : 0;
    $rComeFunction_special_offer_price = (isset($_POST['special_offer_price']) && !empty($request->post('special_offer_price')) && $request->post('special_offer_price') != "") ? $this->removeComa($request->post('special_offer_price')) : 0;
    $request->request->add(['on_sale_price' => $rComeFunction_on_sale_price]);
    $request->request->add(['special_offer_price' => $rComeFunction_special_offer_price]);
    $item_id = $item->id;
    $namProduct = e($request->post('name'));
    $names = Item::where('name', 'like', '%'.$namProduct.'%')->where('id','!=',$item_id)->select('name')->get()->toArray();
    foreach($names as $name){
      if($name['name'] == $namProduct){
        return redirect()->route('back.item.edit', $item_id)->withErrors(__('El nombre del producto es idéntico a otro ya ingresado. Por favor, ingrese un nuevo nombre*.'));
      }
    }
    $this->repository->update($item, $request);
    if($request->is_button ==0){
      return redirect()->route('back.item.index')->withSuccess(__('Product Updated Successfully.'));
    }else{
      return redirect()->back()->withSuccess(__('Product Updated Successfully.'));
    }
  }
  public function status(Item $item,$status){
    $item->update(['status' => $status]);
    return redirect()->back()->withSuccess(__('Status Updated Successfully.'));
  }
  public function destroy(Item $item){
    $this->repository->delete($item);
    return redirect()->back()->withSuccess(__('Product Deleted Successfully.'));
  }
  public function galleries(Item $item){
    return view('back.item.galleries',compact('item'));
  }
  public function galleriesUpdate(GalleryRequest $request){
    $this->repository->galleriesUpdate($request);
    return redirect()->back()->withSuccess(__('Gallery Information Updated Successfully.'));
  }
  public function galleryDelete(Gallery $gallery){
    $this->repository->galleryDelete($gallery);
    return redirect()->back()->withSuccess(__('Successfully Deleted From Gallery.'));
  }
  public function highlight(Item $item){
    return view('back.item.highlight',[
      'item' => $item
    ]);
  }
  public function highlight_update(Item $item,Request $request){
    $this->repository->highlight($item, $request);
    return redirect()->route('back.item.index')->withSuccess(__('Product Updated Successfully.'));
  }
  // ---------------- DIGITAL PRODUCT START ---------------//
  public function deigitalItemCreate(){
    return view('back.item.digital.create',[
      'curr' => Currency::where('is_default',1)->first()
    ]);
  }
  public function deigitalItemStore(ItemRequest $request){
    $this->repository->store($request);
    return redirect()->route('back.item.index')->withSuccess(__('New Product Added Successfully.'));
  }
  public function deigitalItemEdit($id){
    $item = Item::findOrFail($id);
    return view('back.item.digital.edit',[
      'item' => $item,
      'curr' => Currency::where('is_default',1)->first(),
      'social_icons' => json_decode($item->social_icons,true),
      'social_links' => json_decode($item->social_links,true),
      'specification_name' => json_decode($item->specification_name,true),
      'specification_description' => json_decode($item->specification_description,true),
    ]);
  }
  // ---------------- LICENSE PRODUCT START ---------------//
  public function licenseItemCreate(){
    return view('back.item.license.create',[
      'curr' => Currency::where('is_default',1)->first()
    ]);
  }
  public function licenseItemStore(ItemRequest $request){
    $this->repository->store($request);
    return redirect()->route('back.item.index')->withSuccess(__('New Product Added Successfully.'));
  }
  public function licenseItemEdit($id){
    $item = Item::findOrFail($id);
    return view('back.item.license.edit',[
      'item' => $item,
      'curr' => Currency::where('is_default',1)->first(),
      'social_icons' => json_decode($item->social_icons,true),
      'social_links' => json_decode($item->social_links,true),
      'specification_name' => json_decode($item->specification_name,true),
      'specification_description' => json_decode($item->specification_description,true),
      'license_name' => json_decode($item->license_name,true),
      'license_key' => json_decode($item->license_key,true),
    ]);
  }
  public function stockOut(){
    $datas = Item::where('item_type','normal')->where('stock',0)->get();
    return view('back.item.stockout',compact('datas'));
  }
  public function getAllTaxes(){
    $taxes = Tax::get()->toArray();
    $data = $taxes;
    return response()->json(['data'=>$data]);
  }
  public function getProductName(Request $request){
    // print_r(urldecode($request->productname));
    // print_r(urldecode($request->input['productname']));
    // exit();
    // $namProduct = addslashes($request->productname);
    $namProduct = e($request->productname);
    // $namProduct = $request->productname;
    $data = "";
    $names = Item::where('name', 'like', '%'.$request->productname.'%')->select('name')->get()->toArray();
    foreach($names as $n){
      if($n['name'] == $namProduct){
        $data = "equals";
      }else{
        $data = "not-equals";
      }
    }
    return response()->json(['data' => $data]);
  }
}