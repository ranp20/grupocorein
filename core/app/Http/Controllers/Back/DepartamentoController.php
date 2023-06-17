<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Departamento,
  Repositories\Back\DepartamentoRepository,
  Http\Requests\DepartamentoRequest,
  Http\Controllers\Controller
};
use Illuminate\Http\Request;
class DepartamentoController extends Controller{
  public function __construct(DepartamentoRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.departamento.index',[
      'datas' => Departamento::orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    
  }
  public function store(Request $request){
    
  }
  public function show(Departamento $departamento){
    
  }
  public function edit(Departamento $departamento){
    
  }
  public function update(Request $request, Departamento $departamento){
    
  }
  public function destroy(Departamento $departamento){
    
  }
}
