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
        
        if(!empty($request->file('photo'))){

            // echo "existe una imagen";
            // echo "<pre>";
            // print_r($request->file('photo'));
            // echo "</pre>";
            // $imgSlider = $request->file('photo');
            // print_r(json_decode($imgSlider, TRUE));
            
            // ImageHelper::handleUploadedImage($request->$single_image,'assets/images',$check[$single_image]);

        }
        /*
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        exit();
        
        
        if($request->hasFile('photo')){
            $data = HomeCutomize::first();
            $check = json_decode($data->banner_first,true);
            $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image,'assets/images',$check[$single_image]);
        }else{
            $check = json_decode($data->banner_first,true);
            $input[$single_image] = $check[$single_image];
        }
        */
        
       
        $request->validate([
            'logo' => 'image',
            'photo' => 'required|image',
            'title' => 'required|max:100',
            'link' => 'required|max:255',
            'details' => 'required|max:255',
        ]);
        $this->repository->store($request);
        return redirect()->route('back.slider.index')->withSuccess(__('New Slider Added Successfully.'));
    }

    public function edit(Slider $slider){
        return view('back.slider.edit',compact('slider'));
    }

    public function update(ImageUpdateRequest $request, Slider $slider){
        $request->validate([
            'title' => 'required|max:100',
            'link' => 'required|max:255',
            'logo' => 'image',
            'photo' => 'image',
            'details' => 'required|max:255',
        ]);
        $this->repository->update($slider, $request);
        return redirect()->route('back.slider.index')->withSuccess(__('Slider Updated Successfully.'));
    }

    public function destroy(Slider $slider){
        $this->repository->delete($slider);
        return redirect()->route('back.slider.index')->withSuccess(__('Slider Deleted Successfully.'));
    }
}
