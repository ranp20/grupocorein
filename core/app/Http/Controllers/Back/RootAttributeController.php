<?php
namespace App\Http\Controllers\Back;
use App\{
    Models\RootAttribute,
    Repositories\Back\RootAttributeRepository,
    Http\Requests\RootAttributeRequest,
    Http\Controllers\Controller
};
class RootAttributeController extends Controller{
    public function __construct(RootAttributeRepository $repository){
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }
    public function index(){
        return view('back.attributeroot.index',[
            'datas' => RootAttribute::orderBy('id','desc')->get()
        ]);
    }
    public function create(){
        return view('back.attributeroot.create');
    }
    public function store(RootAttributeRequest $request){
        $this->repository->store($request);
        return redirect()->route('back.attributeroot.index')->withSuccess(__('New AttributeRoot Added Successfully.'));
    }
    public function edit(RootAttribute $attributeroot){
        return view('back.attributeroot.edit',compact('attributeroot'));
    }
    public function update(RootAttributeRequest $request, RootAttribute $attributeroot){
        $this->repository->update($attributeroot, $request);
        return redirect()->route('back.attributeroot.index')->withSuccess(__('AttributeRoot Updated Successfully.'));
    }
    public function destroy(RootAttribute $attributeroot){
        $this->repository->delete($attributeroot);
        return redirect()->route('back.attributeroot.index')->withSuccess(__('AttributeRoot Deleted Successfully.'));
    }
}
