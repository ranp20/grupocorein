<?php
namespace App\Http\Controllers\Front;
use App\{
    Models\Item,
    Http\Controllers\Controller,
    Repositories\Front\CartRepository,
    Models\TempCart
};
use Auth;
use App\Helpers\PriceHelper;
use App\Models\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller{

    public function __construct(CartRepository $repository){
        $this->repository = $repository;
        $this->middleware('localize');
    }

	public function index(){
        if(Session::has('cart')){
            $cart = Session::get('cart');
        }else{
            $cart = [];
        }
        return view('front.catalog.cart',[
            'cart' => $cart
        ]);
    }
    
    public function addToCart(Request $request){
        $dataSessUser = Auth::user();
        if(isset($dataSessUser) && !empty($dataSessUser)){
            if(isset($dataSessUser->first_name) && isset($dataSessUser->last_name)){
                $authSession = Auth::user();
                $request->request->add(['user_id' => $authSession->id]);
            }else{
                $request->request->add(['user_id' => 0]);
            }
        }else{
            $request->request->add(['user_id' => 0]);
        }
        
        $msg = $this->repository->store($request);
        if($request->ajax()){
            return response()->json(['message' => $msg , 'qty' => count(Session::get('cart'))]);
        }
    }

	public function store(Request $request){
        $msg = $this->repository->store($request);
        if(isset($request->addtocart)){
           Session::flash('success_message',__('Carrito agregado con éxito'));
           return back();
        }
        return redirect()->route('front.cart')->withSuccess($msg);
	}

    public function destroy($id){
        // $idprod = str_replace(array("-", ",", ";",":"), '', $id);
        
        $cart = Session::get('cart');
        unset($cart[$id]);
        if(count($cart) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        // Session::flash('success',__('El artículo del carrito se eliminó con éxito.'));
        // return back();
        $data = [
            "type" => "success",
            "mssg" => "El artículo del carrito se eliminó con éxito.",
        ];
        $res = json_encode($data);
        return $res;
    }

    // public function deleteItemOfCart($request){
    //     echo "<pre>";
    //     print_r($request->all());
    //     echo "</pre>";
    //     exit();
    // }

	public function promoStore(Request $request){
        return response()->json($this->repository->promoStore($request));
	}

    public function shippingStore(Request $request){
        return redirect()->route('front.checkout');
    }
    
    public function update($id){
        return view('front.catalog.cart_form',[
            'item' => Item::findOrFail($id),
            'attributes' => Item::findOrFail($id)->attributes,
            'cart_item' => Session::get('cart')[$id],
        ]);
    }

    public function shippingCharge(Request $request){
        $charges = [];
        $items = [];
        foreach($request->user_id as $data){
            $check = explode('|',$data);
            $charges[] = $check[0];
            $items[] = $check[1];
        }
        $cart = Session::get('cart');
        $delivery_amount = 0;
        foreach($charges as $index => $charge){
            if($charge != 0){
                 $vendor_charge = Item::findOrFail($items[$index])->user->shipping->price;
                $delivery_amount += $vendor_charge;
                $cart[$items[$index]]['delivery_charge'] = $vendor_charge;
            }else{
                $cart[$items[$index]]['delivery_charge'] = 0;
            }
        }
        Session::put('cart',$cart);
        return response()->json(['delivery' => PriceHelper::setPrice($delivery_amount),'main' => $delivery_amount]);
    }

    public function headerCartLoad(){
        return view('includes.header_cart');
    }

    public function CartLoad(){
        return view('includes.cart');
    }

    public function cartClear(){
        $dataSessUser = Auth::user();
        $id_SessUser = 0;
        $allTmpCart = "";
        if(isset($dataSessUser) && !empty($dataSessUser)){
            if(isset($dataSessUser->first_name) && isset($dataSessUser->last_name)){
                $id_SessUser = $dataSessUser->id;
                TempCart::where("user_id", $id_SessUser)->delete();
            }
        }
        /*
        echo "<pre>";
        print_r($allTmpCart);
        echo "</pre>";
        exit();
        */
        Session::forget('cart');

        $data = [
            "type" => "success",
            "mssg" => "Su carrito está vacío.",
        ];
        $res = json_encode($data);
        return $res;

        // Session::flash('success',__('Su carrito está vacío.'));
        // return back();
    }

}