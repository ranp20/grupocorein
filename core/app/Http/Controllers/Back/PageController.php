<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Page,
    Http\Requests\PageRequest,
    Http\Controllers\Controller
};

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }

    public function index()
    {
        return view('back.page.index',[
            'datas' => Page::orderBy('id','desc')->get()
        ]);
    }

    public function create()
    {
        return view('back.page.create');
    }

    public function store(PageRequest $request)
    {
        Page::create($request->all());
        return redirect()->route('back.page.index')->withSuccess(__('New Page Added Successfully.'));
    }

    public function edit(Page $page)
    {
        return view('back.page.edit',compact('page'));
    }

    public function pos($id,$pos)
    {
        $page = Page::find($id)->update(['pos' => $pos]);
        return redirect()->route('back.page.index')->withSuccess(__('Status Updated Successfully.'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        return redirect()->route('back.page.index')->withSuccess(__('Page Updated Successfully.'));
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('back.page.index')->withSuccess(__('Page Deleted Successfully.'));
    }
}
