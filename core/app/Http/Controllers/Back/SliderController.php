<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Slider,
  Repositories\Back\SliderRepository,
  Http\Requests\ImageStoreRequest,
  Http\Requests\ImageUpdateRequest,
  Http\Controllers\Controller
};
use App\Helpers\ImageHelper;
use App\Models\HomeCutomize;
use Illuminate\Http\Request;
class SliderController extends Controller{
  public function __construct(SliderRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.slider.index',[
      'datas' => Slider::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
  return view('back.slider.create');
  }
  public function store(Request $request){
    $request->validate([
      'photo' => 'required|image',
      'title' => 'required|max:100',
    ]);
    $this->repository->store($request);
    return redirect()->route('back.slider.index')->withSuccess(__('New Slider Added Successfully.'));
  }
  public function edit(Slider $slider){
    return view('back.slider.edit',compact('slider'));
  }
  public function update(ImageUpdateRequest $request, Slider $slider){
    $request->validate([
      'photo' => 'image',
      'title' => 'required|max:100',
    ]);
    $this->repository->update($slider, $request);
    return redirect()->route('back.slider.index')->withSuccess(__('Slider Updated Successfully.'));
  }
  public function destroy(Slider $slider){
    $this->repository->delete($slider);
    return redirect()->route('back.slider.index')->withSuccess(__('Slider Deleted Successfully.'));
  }
}