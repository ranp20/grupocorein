<?php
namespace App\Http\Controllers\Back;
use App\{
    Models\BannersPages,
    Repositories\Back\BannersModels\BannersPagesRepository,
    Http\Requests\BannersModels\BannersPagesRequest,
    Http\Controllers\Controller
};

class BannersPagesController extends Controller
{
    public function __construct(BannersPagesRepository $repository){
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }
    public function index(){
        return view('back.brand.index',[
            'datas' => BannersPages::orderBy('id','desc')->get()
        ]);
    }
    public function create(){
        return view('back.brand.create');
    }
    public function store(BannersPagesRequest $request){
        $this->repository->store($request);
        return redirect()->route('back.brand.index')->withSuccess(__('New BannerPage Added Successfully.'));
    }
    public function status($id,$status,$type){
        BannersPages::find($id)->update([$type => $status]);
        return redirect()->route('back.brand.index')->withSuccess(__('Status Updated Successfully.'));
    }
    public function edit(BannersPages $brand){
        return view('back.brand.edit',compact('brand'));
    }
    public function update(BannersPagesRequest $request, BannersPages $brand){
        $this->repository->update($brand, $request);
        return redirect()->route('back.brand.index')->withSuccess(__('BannerPage Updated Successfully.'));
    }
    public function destroy(BannersPages $brand){
        $this->repository->delete($brand);
        return redirect()->route('back.brand.index')->withSuccess(__('BannerPage Deleted Successfully.'));
    }
}
