<?php
namespace App\Repositories\Front;
use App\{
  Models\Cart,
  Models\Tax,
  Models\Item,
  Models\Brand,
  Models\PromoCode,
  Helpers\PriceHelper,
  Models\TempCart
};
use App\Models\AttributeOption;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartRepository{
  public function store($request){
    $msg = '';
    $qty_check  = 0;
    $input = $request->all();
    $input['option_name']=[];
    $input['option_price']=[];
    $input['attr_name'] =[];
    $qty = isset($input['quantity']) ? $input['quantity'] : 1 ;
    $qty = is_numeric($qty) ? $qty : 1;
    $cart = Session::get('cart');
    $item = Item::where('id',$input['item_id'])->select('id','tax_id','sections_id','name','photo','discount_price','previous_price','on_sale_price','special_offer_price','brand_id','slug','sku','is_type','item_type','license_name','license_key')->first();
    // $taxes = Tax::where('id',$item->tax_id)->select('id','name','value','status')->first();
    $brand = Brand::where('id',$item->brand_id)->select('id','name','slug')->first();
    $single = isset($request->type) ? ($request->type == '1' ? 1 : 0 ) : 0;
    if(Session::has('cart')){
      if($item->item_type == 'digital' || $item->item_type == 'license'){
        $check = array_key_exists($input['item_id'],Session::get('cart'));
        if($check){
          return __('Producto ya añadido');
        }else{
          if(array_key_exists($input['item_id'].'-',Session::get('cart'))){
            return __('Producto ya añadido');
          }
        }
      }
    }

    $option_id = [];
    if($single == 1){
      $attr_name = [];
      $option_name = [];
      $option_price = [];

      if(count($item->attributes) > 0){
        foreach($item->attributes as $attr){
          if(isset($attr->options[0]->name)){
            $attr_name[] = $attr->name;
            $option_name[] = $attr->options[0]->name;
            $option_price[] = $attr->options[0]->price;
            $option_id[] = $attr->options[0]->id;
          }
        }
      }

      $input['attr_name'] = $attr_name;
      $input['option_price'] = $option_price;
      $input['option_name'] = $option_name;
      $input['option_id'] = $option_id;

      if($request->quantity != 'NaN'){
        $qty = $request->quantity;
        $qty_check = 1;
      }else{
        $qty = 1;
      }
    }else{
      if($input['attribute_ids']){
        foreach(explode(',',$input['attribute_ids']) as $attrId){
          $attr = Attribute::findOrFail($attrId);
          $attr_name[] = $attr->name;
        }
        $input['attr_name'] = $attr_name;
      }

      if($input['options_ids']){
        foreach(explode(',',$input['options_ids']) as $optionId){
          $option = AttributeOption::findOrFail($optionId);
          $option_name[] = $option->name;
          $option_price[] = $option->price;
          $option_id[] = $option->id;
        }
        $input['option_name'] = $option_name;
        $input['option_price'] = $option_price;
      }
    }

    if(!$item){
      abort(404);
    }

    $option_price = array_sum($input['option_price']);
    $attribute['names'] = $input['attr_name'];
    $attribute['option_name'] = $input['option_name'];

    if(isset($request->item_key) && $request->item_key !=(int) 0){
      $cart_item_key = explode('-',$request->item_key)[1];
    }else{
      $cart_item_key = str_replace(' ','',implode(',',$attribute['option_name']));
    }

    $attribute['option_price'] = $input['option_price'];
    $cart = Session::get('cart');
    $tempCart = Session::get('cart');
    $qtyProdinCart = $qty;
    $date = date('Y-m-d H:i:s');

    $colorCollection = [];
    if(isset($request->attr_color_code)){
      $colorCollection['atributoraiz_collection']['color']['code'] = $input['attr_color_code'];
    }
    if(isset($request->attr_color_name)){
      $colorCollection['atributoraiz_collection']['color']['name'] = $input['attr_color_name'];
    }
    /*
    echo "<pre>";
    print_r($request->all());
    echo "</pre>";
    exit();
    */

    // if cart is empty then this the first product
    if(!$cart || !isset($cart[$item->id.'-'.$cart_item_key])){
      // echo "recién agregado";
      $license_name = json_decode($item->license_name,true);
      $license_key = json_decode($item->license_name,true);
      $cart[$item->id.'-'.$cart_item_key] = [
        'options_id' => $option_id,
        'attribute' => $attribute,
        'attribute_price' => $option_price,
        "attribute_collection" => json_encode($colorCollection),
        "name" => $item->name,
        "slug" => $item->slug,
        "sku" => $item->sku,
        "brand_id" => (isset($brand->id) && $brand->id != 0) ? $brand->id : "",
        "brand_name" => (isset($brand->name) && $brand->name != "") ? $brand->name : "",
        "qty" => $qty,
        "price" => PriceHelper::grandPrice($item),
        "main_price" => $item->discount_price,
        "photo" => $item->photo,
        "type" => $item->item_type,
        "item_type" => $item->item_type,
        'item_l_n' => $item->item_type == 'license' ? end($license_name) : null,
        'item_l_k' => $item->item_type == 'license' ? end($license_key) : null,
      ];    
      
      Session::put('cart', $cart);
      if(Auth::check() && Auth::user()->role !== 'admin'){
        if(!empty(auth()->user()) || auth()->user() != ""){
          $tempCart = [
            "user_id" => $input['user_id'],
            "item_id" => $item->id,
            "attribute_collection" => json_encode($colorCollection),
            "name" => $item->name,
            "slug" => $item->slug,
            "sku" => $item->sku,
            "brand_id" => (isset($brand->id) && $brand->id != 0) ? $brand->id : "",
            "quantity" => $qty,
            "price" => PriceHelper::grandPrice($item),
            "main_price" => $item->discount_price,
            "photo" => $item->photo,
            "is_type" => $item->is_type,
            "item_type" => $item->item_type,
            "created_at" => $date,
            "updated_at" => $date,
          ];
          TempCart::insert($tempCart);
        }
      }
      return __('Producto agregado');
    }

    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$item->id.'-'.$cart_item_key])){
      $cart = Session::get('cart');
      $qtyProdinCart = $cart[$item->id.'-'.$cart_item_key]['qty'];
      if($qty_check == 1){
        $cart[$item->id.'-'.$cart_item_key]['qty'] =  $qty;
        // $cart[$item->id.'-'.$cart_item_key]['subtotal'] = ($cart[$item->id.'-'.$cart_item_key]['price'] * $qty);
        $qtyProdinCart = $qty;
        $cart[$item->id.'-'.$cart_item_key]['attribute_collection'] = json_encode($colorCollection);
        $tempCart = [
          "user_id" => $input['user_id'],
          "item_id" => $item->id,
          "attribute_collection" => json_encode($colorCollection),
          "quantity" => $qtyProdinCart,
          "updated_at" => $date
        ];
      }else{
        $cart[$item->id.'-'.$cart_item_key]['qty'] +=  $qty;
        // $cart[$item->id.'-'.$cart_item_key]['subtotal'] = ($cart[$item->id.'-'.$cart_item_key]['price'] * $qty);
        $qtyProdinCart += $qty;
        $cart[$item->id.'-'.$cart_item_key]['attribute_collection'] = json_encode($colorCollection);
        $tempCart = [
          "user_id" => $input['user_id'],
          "item_id" => $item->id,
          "attribute_collection" => json_encode($colorCollection),
          "quantity" => $qtyProdinCart,
          "updated_at" => $date
        ];
      }
      Session::put('cart', $cart);
      if(Auth::check() && Auth::user()->role !== 'admin'){
        if(!empty(auth()->user()) || auth()->user() != ""){
          TempCart::where("user_id", "=", $tempCart['user_id'])->where("item_id", "=", $tempCart['item_id'])->update(['attribute_collection' => $tempCart['attribute_collection'], 'quantity' => $tempCart['quantity']]);
        }
      }

      if($qty_check == 1){
        $mgs = __('Producto agregado');
      }else{
        $mgs = __('Producto actualizado');
      }

      $qty_check = 0;
      return $mgs;
    }

    return __('Producto agregado');
  }
	public function promoStore($request){
    $input = $request->all();
    $promo_code = PromoCode::where('status', 1)->whereCodeName($input['code'])->where('no_of_times', '>', 0)->first();
    if($promo_code){
      $cart = Session::get('cart');
      $cartTotal = PriceHelper::cartTotal($cart, 2);
      $discount = $this->getDiscount($promo_code->discount,$promo_code->type,$cartTotal);
      $coupon= [
        'discount' => $discount['sub'],
        'code'  => $promo_code
      ];
      Session::put('coupon',$coupon);

      return [
        'status'  => true,
        'message' => __('¡Código promocional encontrado!')
      ];
    }else{
      return [
        'status'  => false,
        'message' => __('No se encontró ningún código de cupón')
      ];
    }
  }
	public function getCart(){
    $cart = Session::has('cart') ? Session::get('cart') : null;
    return $cart;
  }
  public function getDiscount($discount,$type,$price){
    if($type == 'amount'){
      $sub = $discount;
      $total = $price - $sub;
    }else{
      $val = $price / 100;
      $sub = $val * $discount;
      $total = $price - $sub;
    }

    return [
      'sub' => $sub,
      'total' => $total
    ];
  }
}
