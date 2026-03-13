<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Brand,
  Repositories\Back\BrandRepository,
  Http\Requests\BrandRequest,
  Http\Controllers\Controller
};
class BrandController extends Controller{
  public function __construct(BrandRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.brand.index',[
      'datas' => Brand::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.brand.create');
  }
  public function store(BrandRequest $request){
    $this->repository->store($request);
    return redirect()->route('back.brand.index')->withSuccess(__('New Brand Added Successfully.'));
  }
  public function status($id,$status,$type){
    Brand::find($id)->update([$type => $status]);
    return redirect()->route('back.brand.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function edit(Brand $brand){
    return view('back.brand.edit',compact('brand'));
  }
  public function update(BrandRequest $request, Brand $brand){
    $this->repository->update($brand, $request);
    return redirect()->route('back.brand.index')->withSuccess(__('Brand Updated Successfully.'));
  }
  public function destroy(Brand $brand){
    $this->repository->delete($brand);
    return redirect()->route('back.brand.index')->withSuccess(__('Brand Deleted Successfully.'));
  }
}