<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Provincia,
  Repositories\Back\DistritoRepository,
  Http\Requests\DistritoRequest,
  Http\Controllers\Controller
};
use App\Models\Distrito;
use App\Models\Ciudad;
use Illuminate\Http\Request;
class DistritoController extends Controller{
  public function __construct(DistritoRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.distrito.index',[
      'datas' => Distrito::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    /*
    return view('back.distrito.create');
    */
  }
  public function store(Request $request){
    /*
    //Distrito::create($request->all());
    $this->repository->store($request);
    return redirect()->route('back.distrito.index')->withSuccess(__('New Distrito Added Successfully.'));
    */
  }

  public function getCiudad(Request $request){
    /*
    if($request->provincia_id){
        $data = Provincia::findOrFail($request->provincia_id);
        $data = $data->ciudad;
    }else{
        $data = [];
    }
    return response()->json(['data'=>$data]);
    */
  }
  public function getDistrito(Request $request){
    /*
    if($request->ciudad_id){
        $data = Ciudad::findOrFail($request->ciudad_id);
        $data = $data->distrito;
    }else{
        $data = [];
    }
    return response()->json(['data'=>$data]);
    */
  }
  public function edit($id){
    /*
    $distrito = Distrito::findOrFail($id);
    return view('back.distrito.edit',compact('distrito'));
    */
  }
  public function update(Request $request, $id){
    /*
    $distrito = $request->except('_method', '_token');
    Distrito::where("id","=",$id)->update($distrito);
    return redirect()->route('back.distrito.index')->withSuccess(__('Distrito Updated Successfully.'));
    */
  }
  public function destroy($id){
    /*
    Distrito::destroy($id);
    return redirect()->route('back.distrito.index')->withSuccess(__('Distrito Deleted Successfully.'));
    */
  }
}