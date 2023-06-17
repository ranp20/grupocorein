<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Faq,
    Models\galleries_faq,
    Http\Controllers\Controller,
    Http\Requests\GalleryFaqRequest,
    Repositories\Back\FaqRepository
};

use Illuminate\Http\Request;


class FaqController extends Controller
{
    public function __construct(FaqRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }
    
    public function index()
    {
        return view('back.faq.index',[
            'datas' => Faq::with('category')->orderBy('id','desc')->get()
        ]);
    }

    public function create()
    {
        return view('back.faq.create');
    }

    public function store(Request $request)
    {

        $faq_id = $this->repository->store($request);

        return redirect()->route('back.faq.index')->withSuccess(__('New Faq Added Successfully.'));
    }

    public function edit(Faq $faq)
    {
        return view('back.faq.edit',compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        //$faq->update($request->all());
        $this->repository->update($faq, $request);
        return redirect()->route('back.faq.index')->withSuccess(__('Faq Updated Successfully.'));
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('back.faq.index')->withSuccess(__('Faq Deleted Successfully.'));
    }
    
    public function galleries(Faq $faq)
    {
        return view('back.faq.galleries',compact('faq'));
    }

    public function galleriesUpdate(GalleryFaqRequest $request)
    {
        $this->repository->galleries_faqUpdate($request);
        return redirect()->back()->withSuccess(__('Gallery Information Updated Successfully.'));
    }

    public function galleryDelete(galleries_faq $gallery)
    {
        $this->repository->galleries_faqDelete($gallery);
        return redirect()->back()->withSuccess(__('Successfully Deleted From Gallery.'));
    }
}
