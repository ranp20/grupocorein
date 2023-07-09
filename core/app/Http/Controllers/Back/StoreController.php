<?php
namespace App\Http\Controllers\Back;
use App\{
    Models\Store,
    Repositories\Back\StoreRepository,
    Http\Requests\StoreRequest,
    Http\Controllers\Controller
};
use Illuminate\Http\Request;

class StoreController extends Controller{
    public function __construct(StoreRepository $repository){
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }
    public function index(){
        return view('back.store.index',[
            'datas' => Store::orderBy('id','desc')->get()
        ]);
    }
    public function create(){
        return view('back.store.create');
    }
    public function store(Request $request){
        $this->repository->store($request);
        return redirect()->route('back.store.index')->withSuccess(__('New Store Added Successfully.'));
    }
    public function edit(Store $store){
        return view('back.store.edit',compact('store'));
    }
    public function update(Request $request, Store $store){
        $this->repository->update($store, $request);
        return redirect()->route('back.store.index')->withSuccess(__('Store Updated Successfully.'));
    }
    public function destroy(Store $store){
        $mgs = $this->repository->delete($store);
        if($mgs['status'] == 1){
            return redirect()->route('back.store.index')->withSuccess($mgs['message']);
        }else{
            return redirect()->route('back.store.index')->withError($mgs['message']);
        }
    }
}
