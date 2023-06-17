<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Category,
    Repositories\Back\ChieldCategoryRepository,
    Http\Requests\ChieldcategoryRequest,
    Http\Controllers\Controller
};
use App\Models\ChieldCategory;
use App\Models\Subcategory;

class ChieldCategoryController extends Controller
{
    public function __construct(ChieldCategoryRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }

    public function index()
    {
        return view('back.childcategory.index',[
            'datas' => ChieldCategory::with('category')->orderBy('id','desc')->get()
        ]);
    }

    public function create()
    {
        return view('back.childcategory.create');
    }

    public function store(ChieldcategoryRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('back.childcategory.index')->withSuccess(__('New Childcategory Added Successfully.'));
    }

    public function status($id,$status)
    {
        ChieldCategory::find($id)->update(['status' => $status]);
        return redirect()->route('back.childcategory.index')->withSuccess(__('Status Updated Successfully.'));
    }

    public function edit(ChieldCategory $childcategory)
    {
        
        return view('back.childcategory.edit',compact('childcategory'));
    }

    public function update(ChieldCategoryRequest $request, ChieldCategory $childcategory)
    {
        $this->repository->update($childcategory, $request);
        return redirect()->route('back.childcategory.index')->withSuccess(__('Childcategory Updated Successfully.'));
    }

    public function destroy(ChieldCategory $childcategory)
    {
        $this->repository->delete($childcategory);
        return redirect()->route('back.childcategory.index')->withSuccess(__('Childcategory Deleted Successfully.'));
    }
}
