<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Provincia,
  Repositories\Back\ProvinciaRepository,
  Http\Requests\ProvinciaRequest,
  Http\Controllers\Controller
};
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Exceptions\InvalidOrderException;
class ProvinciaController extends Controller{
  public function __construct(ProvinciaRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }  
  public function index(){
    return view('back.provincia.index',[
        'datas' => Provincia::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.provincia.create');
  }
  public function store(ProvinciaRequest $request){
    //Provincia::create($request->all());
    $this->repository->store($request);
    return redirect()->route('back.provincia.index')->withSuccess(__('New Provincia Added Successfully.'));
  }
  public function edit($id){
    $provincia = Provincia::findOrFail($id);
    return view('back.provincia.edit',compact('provincia'));
  }
  public function update(ProvinciaRequest $request, $id){
    $provincia = $request->except('_method', '_token');
    Provincia::where("id","=",$id)->update($provincia);
    return redirect()->route('back.provincia.index')->withSuccess(__('Provincia Updated Successfully.'));
  }
  public function destroy($id){
    Provincia::destroy($id);
    return redirect()->route('back.provincia.index')->withSuccess(__('Provincia Deleted Successfully.'));
  }
}
