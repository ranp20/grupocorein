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
use App\Models\ApplyCoupon;
use App\Models\AttributeOption;
use App\Models\Attribute;
use App\Models\Coupons;
use App\Models\RootUnit;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartRepository{
  public function store($request){
    $msg = '';
    $qty_check = 0;
    $qty_check_coupon = 0;
    $quantity_withoutcoupon = 0;
    $input = $request->all();
    $input['option_name']=[];
    $input['option_price']=[];
    $input['attr_name'] =[];
    // -------------- CANTIDAD DE PRODUCTOS AÑADIDOS CON EL PRECIO ORIGINAL (SIN CUPÓN)
    $qty = isset($input['quantity']) ? $input['quantity'] : 1;
    $qty = is_numeric($qty) ? $qty : 1;
    // -------------- CANTIDAD DE PRODUCTOS AÑADIDOS CON EL PRECIO DE CUPÓN (CON CUPÓN)
    // $qty = isset($input['quantity']) ? $input['quantity'] : 1;
    // $qty = is_numeric($qty) ? $qty : 1;
    $cart = Session::get('cart');
    $item = Item::where('id',$input['item_id'])->select('id','tax_id','sections_id','name','photo','discount_price','previous_price','on_sale_price','special_offer_price','brand_id','coupon_id','unidad_raiz','atributo_raiz','atributoraiz_collection','slug','sku','is_type','item_type','license_name','license_key')->first();
    // -------------- REDIRIGIR HACIA LA PÁGINA DE ERROR 404, EN CASO DE NO ENCONTRAR EL PRODUCTO...
    if(!$item){
      abort(404);
    }
    // -------------- VALIDAR SI EL PRODUCTO ES "digital" o "físico" y si ya está añadido en el carrito...
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
    $itemAllData = (isset($cart[$item->id.'-'.$cart_item_key])) ? $cart[$item->id.'-'.$cart_item_key] : [];
    $attrColorCollection = [];
    if(isset($itemAllData['attribute_collection'])){
      $arrCountDataProd = json_decode($itemAllData['attribute_collection'], TRUE);
      if(isset($arrCountDataProd['atributoraiz_collection'])){
        if(isset($arrCountDataProd['atributoraiz_collection']['color'])){
          $attrColorCollection['color_code'] = $arrCountDataProd['atributoraiz_collection']['color']['code'];
          $attrColorCollection['color_name'] = $arrCountDataProd['atributoraiz_collection']['color']['name'];
        }
      }
    }

    if(isset($request->attr_color_code)){
      if(isset($attrColorCollection['color_code']) && $attrColorCollection['color_name']){
        if($attrColorCollection['color_code'] != "0" && $attrColorCollection['color_name'] != "0"){
          $colorCollection['atributoraiz_collection']['color']['code'] = $attrColorCollection['color_code'];
        }else{
          $colorCollection['atributoraiz_collection']['color']['code'] = $input['attr_color_code'];
        }
      }else{
        $colorCollection['atributoraiz_collection']['color']['code'] = $input['attr_color_code'];
      }
    }
    if(isset($request->attr_color_name)){
      if(isset($attrColorCollection['color_code']) && $attrColorCollection['color_name']){
        if($attrColorCollection['color_code'] != "0" && $attrColorCollection['color_name'] != "0"){
          $colorCollection['atributoraiz_collection']['color']['name'] = $attrColorCollection['color_name'];
        }else{
          $colorCollection['atributoraiz_collection']['color']['name'] = $input['attr_color_name'];
        }
      }else{
        $colorCollection['atributoraiz_collection']['color']['name'] = $input['attr_color_name'];
      }      
    }

    // $taxes = Tax::where('id',$item->tax_id)->select('id','name','value','status')->first();
    $brand = Brand::where('id',$item->brand_id)->select('id','name','slug')->first();
    $rootunit = RootUnit::where('id',$item->unidad_raiz)->select('id','name')->first();
    $user_id = (isset($input['user_id']) && $input['user_id'] != "") ? $input['user_id'] : 0;
    $item_id = (isset($input['item_id']) && $input['item_id'] != "") ? $input['item_id'] : 0;
    $coupon_id = (isset($input['coupon_id']) && $input['coupon_id'] != "") ? $input['coupon_id'] : 0;

    // echo "input coupon_id: ".$input['coupon_id']."<br>";
    // echo "user_id: ".$user_id."<br>";
    // echo "item_id: ".$item_id."<br>";
    // echo "coupon_id: ".$coupon_id."<br>";
    // exit();
    // Si no existe el coupon_id enviado desde el front, buscar por el ID del producto en la tabla de ApplyCoupon...
    $couponvalidexist = "";
    if($coupon_id == 0){
      $applycoupon = ApplyCoupon::where('id_user','=',$user_id)->where('id_prod','=',$item_id)->select('id_user','id_prod','id_coupon','totalprice','status')->take(1)->get();
      $validcouponjson = json_decode($applycoupon, TRUE);
      if(count($validcouponjson) <= 0){
        // echo "Este producto no tiene un cupón agregado...";
        $couponvalidexist = [];
      }else{
        $couponvalidid = $validcouponjson[0]['id_coupon'];
        $couponvalidexist = $applycoupon;
        $coupon_id = $couponvalidid;
      }
    }else{
      $applycoupon = ApplyCoupon::where('id_user','=',$user_id)->where('id_prod','=',$item_id)->where('id_coupon',"=",$coupon_id)->select('id_user','id_prod','id_coupon','totalprice','status')->take(1)->get();
      $couponvalidexist = $applycoupon;
    }

    // $applycoupon = ApplyCoupon::where('id_user','=',$user_id)->where('id_prod','=',$item_id)->where('id_coupon',"=",$coupon_id)->select()->take(1)->get();
    $couponinfo = Coupons::where('id',"=",$coupon_id)->select('discount_percentage','time_end','status')->take(1)->get();
    // (1) -------------- VALIDAR SI EXISTE UN CUPÓN ASIGNADO AL PRODUCTO, OBTENER EL NUEVO PRECIO...
    if(count($couponvalidexist) != 0){
      $arrApplyCoupon = json_decode($couponvalidexist, TRUE);
      $applycoupon_totalprice = $arrApplyCoupon[0]['totalprice']; // PRECIO DEL CUPÓN
      $applycoupon_idcoupon = $arrApplyCoupon[0]['id_coupon']; // ID DEL CUPÓN
      // echo "PRECIO CUPÓN: ".$applycoupon_totalprice."<br>";
      // echo "ID CUPÓN: ".$applycoupon_idcoupon."<br>";
      // exit();
      if(count($couponinfo) != 0){
        $couponjsontoarray = json_decode($couponinfo, TRUE);
        $couponget_timeend = $couponjsontoarray[0]['time_end'];
        $couponget_status = $couponjsontoarray[0]['status'];
        // (2) -------------- VALIDAR SI EL CUPÓN ESTÁ VENCIDO Y/O PRÓXIMO A VENCER DE ACUEDO A LA FECHA Y HORA...
        // Crear un objeto DateTime a partir de la fecha final...
        $currentDate = new DateTime();
        $expirationDate = DateTime::createFromFormat('Y-m-d H:i:s', $couponget_timeend, new DateTimeZone('America/Lima'));
        // Obtener las fechas en milisegundos...
        $millisecondsCurrentDate = $currentDate->getTimestamp() * 1000;
        $millisecondsExpirationDate = $expirationDate->getTimestamp() * 1000;
        // Calcular el tiempo restante...
        $remainingTime = max(0, $millisecondsExpirationDate - $millisecondsCurrentDate);
        if($remainingTime <= 0){
          // echo "El cupón ya NO es válido (C)";
          // -------------- Si el carrito ESTÁ vacío.
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
              "rootunit_id" => (isset($rootunit->id) && $rootunit->id != "") ? $rootunit->id : "",
              "rootunit_name" => (isset($rootunit->name) && $rootunit->name != "") ? $rootunit->name : "",
              "qty" => $qty,
              "price" => PriceHelper::grandPrice($item),
              "main_price" => $item->discount_price,
              "photo" => $item->photo,
              "type" => $item->item_type,
              "item_type" => $item->item_type,
              "coupon_id" => "0",
              "coupon_price" => "0",
              "quantity_withoutcoupon" => "0",
              "coupon_valid" => 'not_available',
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
                  "coupon_id" => "0",
                  "coupon_price" => "0",
                  "quantity_withoutcoupon" => "0",
                  "coupon_valid" => 'not_available',
                  "created_at" => $date,
                  "updated_at" => $date,
                ];
                TempCart::insert($tempCart);
              }
            }
            // return __('Producto agregado. El cupón ya NO es válido (C)');
            return __('Producto agregado. El cupón ya NO es válido');
          }
          // -------------- Si el carrito NO está vacío, verifique si este producto existe y luego incremente la cantidad.
          if(isset($cart[$item->id.'-'.$cart_item_key])){
            $cart = Session::get('cart');
            $qtyProdinCart = $cart[$item->id.'-'.$cart_item_key]['qty'];
            if($qty_check == 1){
              $cart[$item->id.'-'.$cart_item_key]['qty'] =  $qty;
              $cart[$item->id.'-'.$cart_item_key]['coupon_valid'] =  'not_available';
              // $cart[$item->id.'-'.$cart_item_key]['subtotal'] = ($cart[$item->id.'-'.$cart_item_key]['price'] * $qty);
              $qtyProdinCart = $qty;
              $cart[$item->id.'-'.$cart_item_key]['attribute_collection'] = json_encode($colorCollection);
              $tempCart = [
                "user_id" => $input['user_id'],
                "item_id" => $item->id,
                "attribute_collection" => json_encode($colorCollection),
                "quantity" => $qtyProdinCart,
                "coupon_id" => "0",
                "coupon_price" => "0",
                "quantity_withoutcoupon" => "0",
                "coupon_valid" => 'not_available',
                "updated_at" => $date
              ];
            }else{
              $cart[$item->id.'-'.$cart_item_key]['qty'] +=  $qty;
              $cart[$item->id.'-'.$cart_item_key]['coupon_valid'] =  'not_available';
              // $cart[$item->id.'-'.$cart_item_key]['subtotal'] = ($cart[$item->id.'-'.$cart_item_key]['price'] * $qty);
              $qtyProdinCart += $qty;
              $cart[$item->id.'-'.$cart_item_key]['attribute_collection'] = json_encode($colorCollection);
              $tempCart = [
                "user_id" => $input['user_id'],
                "item_id" => $item->id,
                "attribute_collection" => json_encode($colorCollection),
                "quantity" => $qtyProdinCart,
                "coupon_id" => "0",
                "coupon_price" => "0",
                "quantity_withoutcoupon" => "0",
                "coupon_valid" => 'not_available',
                "updated_at" => $date
              ];
            }
            Session::put('cart', $cart);
            if(Auth::check() && Auth::user()->role !== 'admin'){
              if(!empty(auth()->user()) || auth()->user() != ""){
                TempCart::where("user_id", "=", $tempCart['user_id'])->where("item_id", "=", $tempCart['item_id'])->update(['attribute_collection' => $tempCart['attribute_collection'], 'quantity' => $tempCart['quantity'], 'coupon_price' => $tempCart['coupon_price'], 'coupon_valid' => $tempCart['coupon_valid']]);
              }
            }

            if($qty_check == 1){
              // $mgs = __('Producto agregado. El cupón ya NO es válido (C)');
              $mgs = __('Producto agregado. El cupón ya NO es válido');
            }else{
              // $mgs = __('Producto actualizado. El cupón ya NO es válido (C)');
              $mgs = __('Producto actualizado. El cupón ya NO es válido');
            }

            $qty_check = 0;
            return $mgs;
          }
        }else{
          // (3) -------------- VALIDAR EL ESTADO DEL CUPÓN EN ESTE PRODUCTO...
          if($couponget_status != 0){
            // echo $couponget_timeend."<br>";
            // echo "El cupón todavía está activo (B)";
            // -------------- Si el carrito ESTÁ vacío.
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
                "rootunit_id" => (isset($rootunit->id) && $rootunit->id != "") ? $rootunit->id : "",
                "rootunit_name" => (isset($rootunit->name) && $rootunit->name != "") ? $rootunit->name : "",
                "qty" => $qty,
                "price" => PriceHelper::grandPrice($item),
                "main_price" => $item->discount_price,
                "photo" => $item->photo,
                "type" => $item->item_type,
                "item_type" => $item->item_type,
                "coupon_id" => $item->coupon_id,
                "coupon_price" => $applycoupon_totalprice,
                "quantity_withoutcoupon" => "0",
                "coupon_valid" => 'available',
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
                    "coupon_id" => $item->coupon_id,
                    "coupon_price" => $applycoupon_totalprice,
                    "quantity_withoutcoupon" => "0",
                    "coupon_valid" => 'available',
                    "created_at" => $date,
                    "updated_at" => $date,
                  ];
                  TempCart::insert($tempCart);
                }
              }
              // return __('Producto agregado. El cupón todavía está activo (B)');
              return __('Producto agregado. El cupón todavía está activo');
            }
            // -------------- Si el carrito NO está vacío, verifique si este producto existe y luego incremente la cantidad.
            // (HOY - 14/03/2024) : Comprobar si el nuevo precio aplicado con cupón se está respetando...
            if(isset($cart[$item->id.'-'.$cart_item_key])){
              $cart = Session::get('cart');
              $qtyProdinCart = $cart[$item->id.'-'.$cart_item_key]['qty'];
              if($cart[$item->id.'-'.$cart_item_key]['coupon_id'] != 0 && isset($cart[$item->id.'-'.$cart_item_key]['coupon_price']) && $cart[$item->id.'-'.$cart_item_key]['coupon_price'] != "" && $cart[$item->id.'-'.$cart_item_key]['coupon_price'] != "0"){
                // echo "Si ya tiene estos atributos, mantener la última cantidad antes de la activación del cupón...";
              }else{
                // echo "Primer producto con este cupón";
                $cart[$item->id.'-'.$cart_item_key]['quantity_withoutcoupon'] = $cart[$item->id.'-'.$cart_item_key]['qty'];
                $quantity_withoutcoupon = $cart[$item->id.'-'.$cart_item_key]['quantity_withoutcoupon'];
              }
              if($qty_check == 1){
                $cart[$item->id.'-'.$cart_item_key]['qty'] =  $qty;
                // $cart[$item->id.'-'.$cart_item_key]['subtotal'] = ($cart[$item->id.'-'.$cart_item_key]['price'] * $qty);
                $qtyProdinCart = $qty;
                $cart[$item->id.'-'.$cart_item_key]['attribute_collection'] = json_encode($colorCollection);
                $cart[$item->id.'-'.$cart_item_key]['coupon_id'] = $applycoupon_idcoupon;
                $cart[$item->id.'-'.$cart_item_key]['coupon_price'] = $applycoupon_totalprice;
                $quantity_withoutcoupon = $cart[$item->id.'-'.$cart_item_key]['quantity_withoutcoupon'];
                $cart[$item->id.'-'.$cart_item_key]['coupon_valid'] =  'available';
                $tempCart = [
                  "user_id" => $input['user_id'],
                  "item_id" => $item->id,
                  "attribute_collection" => json_encode($colorCollection),
                  "quantity" => $qtyProdinCart,
                  "coupon_id" => $applycoupon_idcoupon,
                  "coupon_price" => $applycoupon_totalprice,
                  "quantity_withoutcoupon" => $quantity_withoutcoupon,
                  "coupon_valid" => 'available',
                  "updated_at" => $date
                ];
              }else{
                $cart[$item->id.'-'.$cart_item_key]['qty'] +=  $qty;
                // $cart[$item->id.'-'.$cart_item_key]['subtotal'] = ($cart[$item->id.'-'.$cart_item_key]['price'] * $qty);
                $qtyProdinCart += $qty;
                $cart[$item->id.'-'.$cart_item_key]['attribute_collection'] = json_encode($colorCollection);
                $cart[$item->id.'-'.$cart_item_key]['coupon_id'] = $applycoupon_idcoupon;
                $cart[$item->id.'-'.$cart_item_key]['coupon_price'] = $applycoupon_totalprice;
                $quantity_withoutcoupon = $cart[$item->id.'-'.$cart_item_key]['quantity_withoutcoupon'];
                $cart[$item->id.'-'.$cart_item_key]['coupon_valid'] =  'available';
                $tempCart = [
                  "user_id" => $input['user_id'],
                  "item_id" => $item->id,
                  "attribute_collection" => json_encode($colorCollection),
                  "quantity" => $qtyProdinCart,
                  "coupon_id" => $applycoupon_idcoupon,
                  "coupon_price" => $applycoupon_totalprice,
                  "quantity_withoutcoupon" => $quantity_withoutcoupon,
                  "coupon_valid" => 'available',
                  "updated_at" => $date
                ];
              }
              Session::put('cart', $cart);
              if(Auth::check() && Auth::user()->role !== 'admin'){
                if(!empty(auth()->user()) || auth()->user() != ""){
                  TempCart::where("user_id", "=", $tempCart['user_id'])->where("item_id", "=", $tempCart['item_id'])->update(['attribute_collection' => $tempCart['attribute_collection'], 'quantity' => $tempCart['quantity'], 'coupon_price' => $tempCart['coupon_price'], 'quantity_withoutcoupon' => $tempCart['quantity_withoutcoupon'], 'coupon_valid' => $tempCart['coupon_valid']]);
                }
              }

              if($qty_check == 1){
                // $mgs = __('Producto agregado. El cupón todavía está activo (B)');
                $mgs = __('Producto agregado. El cupón todavía está activo');
              }else{
                // $mgs = __('Producto actualizado. El cupón todavía está activo (B)');
                $mgs = __('Producto actualizado. El cupón todavía está activo');
              }

              $qty_check = 0;
              return $mgs;
            }
          }else{
            // echo "El cupón ya NO está activo (H)";
            // -------------- Si el carrito ESTÁ vacío.
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
                "rootunit_id" => (isset($rootunit->id) && $rootunit->id != "") ? $rootunit->id : "",
                "rootunit_name" => (isset($rootunit->name) && $rootunit->name != "") ? $rootunit->name : "",
                "qty" => $qty,
                "price" => PriceHelper::grandPrice($item),
                "main_price" => $item->discount_price,
                "photo" => $item->photo,
                "type" => $item->item_type,
                "item_type" => $item->item_type,
                "coupon_id" => "0",
                "coupon_price" => "0",
                "quantity_withoutcoupon" => "0",
                "coupon_valid" => 'not_available',
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
                    "coupon_id" => "0",
                    "coupon_price" => "0",
                    "quantity_withoutcoupon" => "0",
                    "coupon_valid" => 'not_available',
                    "created_at" => $date,
                    "updated_at" => $date,
                  ];
                  TempCart::insert($tempCart);
                }
              }
              // return __('Producto agregado. El cupón ya NO está activo (H)');
              return __('Producto agregado. El cupón ya NO está activo');
            }
            // -------------- Si el carrito NO está vacío, verifique si este producto existe y luego incremente la cantidad.
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
                  "coupon_id" => "0",
                  "coupon_price" => "0",
                  "quantity_withoutcoupon" => "0",
                  "coupon_valid" => 'not_available',
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
                  "coupon_id" => "0",
                  "coupon_price" => "0",
                  "quantity_withoutcoupon" => "0",
                  "coupon_valid" => 'not_available',
                  "updated_at" => $date
                ];
              }
              Session::put('cart', $cart);
              if(Auth::check() && Auth::user()->role !== 'admin'){
                if(!empty(auth()->user()) || auth()->user() != ""){
                  TempCart::where("user_id", "=", $tempCart['user_id'])->where("item_id", "=", $tempCart['item_id'])->update(['attribute_collection' => $tempCart['attribute_collection'], 'quantity' => $tempCart['quantity'], 'coupon_price' => $tempCart['coupon_price'], 'coupon_valid' => $tempCart['coupon_valid']]);
                }
              }

              if($qty_check == 1){
                // $mgs = __('Producto agregado. El cupón ya NO está activo (H)');
                $mgs = __('Producto agregado. El cupón ya NO está activo');
              }else{
                // $mgs = __('Producto actualizado. El cupón ya NO está activo (H)');
                $mgs = __('Producto actualizado. El cupón ya NO está activo');
              }

              $qty_check = 0;
              return $mgs;
            }
          }
        }
      }else{
        // echo "No existe este cupón (A)";
        // -------------- Si el carrito ESTÁ vacío.
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
            "rootunit_id" => (isset($rootunit->id) && $rootunit->id != "") ? $rootunit->id : "",
            "rootunit_name" => (isset($rootunit->name) && $rootunit->name != "") ? $rootunit->name : "",
            "qty" => $qty,
            "price" => PriceHelper::grandPrice($item),
            "main_price" => $item->discount_price,
            "photo" => $item->photo,
            "type" => $item->item_type,
            "item_type" => $item->item_type,
            "coupon_id" => "0",
            "coupon_price" => "0",
            "quantity_withoutcoupon" => "0",
            "coupon_valid" => 'not_available',
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
                "coupon_id" => "0",
                "coupon_price" => "0",
                "quantity_withoutcoupon" => "0",
                "coupon_valid" => 'not_available',
                "created_at" => $date,
                "updated_at" => $date,
              ];
              TempCart::insert($tempCart);
            }
          }
          // return __('Producto agregado. No existe este cupón (A)');
          return __('Producto agregado. No existe este cupón');
        }
        // -------------- Si el carrito NO está vacío, verifique si este producto existe y luego incremente la cantidad.
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
              "coupon_id" => "0",
              "coupon_price" => "0",
              "quantity_withoutcoupon" => "0",
              "coupon_valid" => 'not_available',
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
              "coupon_id" => "0",
              "coupon_price" => "0",
              "quantity_withoutcoupon" => "0",
              "coupon_valid" => 'not_available',
              "updated_at" => $date
            ];
          }
          Session::put('cart', $cart);
          if(Auth::check() && Auth::user()->role !== 'admin'){
            if(!empty(auth()->user()) || auth()->user() != ""){
              TempCart::where("user_id", "=", $tempCart['user_id'])->where("item_id", "=", $tempCart['item_id'])->update(['attribute_collection' => $tempCart['attribute_collection'], 'quantity' => $tempCart['quantity'], 'coupon_price' => $tempCart['coupon_price'], 'coupon_valid' => $tempCart['coupon_valid']]);
            }
          }

          if($qty_check == 1){
            // $mgs = __('Producto agregado. No existe este cupón (A)');
            $mgs = __('Producto agregado. No existe este cupón');
          }else{
            // $mgs = __('Producto actualizado. No existe este cupón (A)');
            $mgs = __('Producto actualizado. No existe este cupón');
          }

          $qty_check = 0;
          return $mgs;
        }
      }
    }else{
      // echo "No hay un cupón activado para este producto (AF)";
      // -------------- Si el carrito ESTÁ vacío.
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
          "rootunit_id" => (isset($rootunit->id) && $rootunit->id != "") ? $rootunit->id : "",
          "rootunit_name" => (isset($rootunit->name) && $rootunit->name != "") ? $rootunit->name : "",
          "qty" => $qty,
          "price" => PriceHelper::grandPrice($item),
          "main_price" => $item->discount_price,
          "photo" => $item->photo,
          "type" => $item->item_type,
          "item_type" => $item->item_type,
          "coupon_id" => "0",
          "coupon_price" => "0",
          "quantity_withoutcoupon" => "0",
          "coupon_valid" => 'not_available',
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
              "coupon_id" => "0",
              "coupon_price" => "0",
              "quantity_withoutcoupon" => "0",
              "coupon_valid" => 'not_available',
              "created_at" => $date,
              "updated_at" => $date,
            ];
            TempCart::insert($tempCart);
          }
        }
        return __('Producto agregado');
      }
      // -------------- Si el carrito NO está vacío, verifique si este producto existe y luego incremente la cantidad.
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
            "coupon_id" => "0",
            "coupon_price" => "0",
            "quantity_withoutcoupon" => "0",
            "coupon_valid" => 'not_available',
            "updated_at" => $date
          ];
          $mgs = __('Producto agregado');
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
            "coupon_id" => "0",
            "coupon_price" => "0",
            "quantity_withoutcoupon" => "0",
            "coupon_valid" => 'not_available',
            "updated_at" => $date
          ];
          $mgs = __('Producto actualizado');
        }
        Session::put('cart', $cart);
        if(Auth::check() && Auth::user()->role !== 'admin'){
          if(!empty(auth()->user()) || auth()->user() != ""){
            TempCart::where("user_id", "=", $tempCart['user_id'])->where("item_id", "=", $tempCart['item_id'])->update(['attribute_collection' => $tempCart['attribute_collection'], 'quantity' => $tempCart['quantity'], 'coupon_price' => $tempCart['coupon_price'], 'coupon_valid' => $tempCart['coupon_valid']]);
          }
        }
        $qty_check = 0;
        return $mgs;
      }
    }
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