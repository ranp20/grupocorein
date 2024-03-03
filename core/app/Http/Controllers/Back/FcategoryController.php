<?php
namespace App\Http\Controllers\Back;
use App\{
    Models\Fcategory,
    Repositories\Back\FcategoryRepository,
    Http\Requests\FcategoryRequest,
    Http\Controllers\Controller
};
class FcategoryController extends Controller{
    public function __construct(FcategoryRepository $repository){
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }
    public function index(){
        return view('back.fcategory.index',[
            'datas' => Fcategory::orderBy('id','desc')->get()
        ]);
    }
    public function create(){
        return view('back.fcategory.create');
    }
    public function store(FcategoryRequest $request){
        $this->repository->store($request);
        return redirect()->route('back.fcategory.index')->withSuccess(__('New Category Added Successfully.'));
    }
    public function status($id,$status){
        Fcategory::find($id)->update(['status' => $status]);
        return redirect()->route('back.fcategory.index')->withSuccess(__('Status Updated Successfully.'));
    }
    public function edit(Fcategory $fcategory){
        return view('back.fcategory.edit',compact('fcategory'));
    }
    public function update(FcategoryRequest $request, Fcategory $fcategory){
        $this->repository->update($fcategory, $request);
        return redirect()->route('back.fcategory.index')->withSuccess(__('Category Updated Successfully.'));
    }
    public function destroy(Fcategory $fcategory){
        $this->repository->delete($fcategory);
        return redirect()->route('back.fcategory.index')->withSuccess(__('Category Deleted Successfully.'));
    }
}
