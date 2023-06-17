<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Category,
    Repositories\Back\SubCategoryRepository,
    Http\Requests\SubCategoryRequest,
    Http\Controllers\Controller
};
use App\Models\Subcategory;

class SubCategoryController extends Controller
{
    public function __construct(SubCategoryRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }

    public function index()
    {
        return view('back.subcategory.index',[
            'datas' => Subcategory::with('category')->orderBy('id','desc')->get()
        ]);
    }

    public function create()
    {
        return view('back.subcategory.create');
    }

    public function store(SubCategoryRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('back.subcategory.index')->withSuccess(__('New Subcategory Added Successfully.'));
    }

    public function status($id,$status)
    {
        Subcategory::find($id)->update(['status' => $status]);
        return redirect()->route('back.subcategory.index')->withSuccess(__('Status Updated Successfully.'));
    }

    public function edit(Subcategory $subcategory)
    {
        
        return view('back.subcategory.edit',compact('subcategory'));
    }

    public function update(SubCategoryRequest $request, Subcategory $subcategory)
    {
        $this->repository->update($subcategory, $request);
        return redirect()->route('back.subcategory.index')->withSuccess(__('Subcategory Updated Successfully.'));
    }

    public function destroy(Subcategory $subcategory)
    {
        $this->repository->delete($subcategory);
        return redirect()->route('back.subcategory.index')->withSuccess(__('Subcategory Deleted Successfully.'));
    }
}
