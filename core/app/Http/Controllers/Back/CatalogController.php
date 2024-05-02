<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Catalog,
  Repositories\Back\CatalogRepository,
  Http\Requests\CatalogRequest,
  Http\Controllers\Controller
};
class CatalogController extends Controller{
  public function __construct(CatalogRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.catalog.index',[
      'datas' => Catalog::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.catalog.create');
  }
  public function store(CatalogRequest $request){
    $this->repository->store($request);
    return redirect()->route('back.catalog.index')->withSuccess(__('New Catalog Added Successfully.'));
  }
  public function status($id,$status){
    Catalog::find($id)->update(['status' => $status]);
    return redirect()->route('back.catalog.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function edit(Catalog $catalog){
    return view('back.catalog.edit',compact('catalog'));
  }
  public function update(CatalogRequest $request, Catalog $catalog){
    $this->repository->update($catalog, $request);
    return redirect()->route('back.catalog.index')->withSuccess(__('Catalog Updated Successfully.'));
  }
  public function destroy(Catalog $catalog){
    $this->repository->delete($catalog);
    return redirect()->route('back.catalog.index')->withSuccess(__('Catalog Deleted Successfully.'));
  }
}