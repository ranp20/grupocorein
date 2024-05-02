<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Category,
  Repositories\Back\CategoryRepository,
  Http\Requests\CategoryRequest,
  Http\Controllers\Controller
};
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
class CategoryController extends Controller{
  public function __construct(CategoryRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.category.index',[
      'datas' => Category::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.category.create');
  }
  public function store(CategoryRequest $request){
    $request->validate([
      'serial' => 'required|numeric|max:150'
    ]);
    $this->repository->store($request);
    return redirect()->route('back.category.index')->withSuccess(__('New Category Added Successfully.'));
  }
  public function feature($id,$status){
    Category::find($id)->update(['is_feature' => $status]);
    return redirect()->route('back.category.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function status($id,$status){
    Category::find($id)->update(['status' => $status]);
    return redirect()->route('back.category.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function edit(Category $category){
    return view('back.category.edit',compact('category'));
  }
  public function update(CategoryRequest $request, Category $category){
    $request->validate([
      'serial' => 'required|numeric|max:150'
    ]);
    $this->repository->update($category, $request);
    return redirect()->route('back.category.index')->withSuccess(__('Category Updated Successfully.'));
  }
  public function destroy(Category $category){
    $mgs = $this->repository->delete($category);
    if($mgs['status'] == 1){
    return redirect()->route('back.category.index')->withSuccess($mgs['message']);
    }else{
    return redirect()->route('back.category.index')->withError($mgs['message']);
    }   
  }
}