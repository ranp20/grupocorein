<?php
namespace App\Repositories\Back;
use App\{
  Models\Departamento,
  Helpers\ImageHelper
};
class DepartamentoRepository{
  public function store($request){
    $input = $request->all();
    Departamento::create($input);
  }
  public function update($departamento, $request){
    $input = $request->all();
    $departamento->update($input);
  }
  public function delete($departamento){
    $departamento->delete();
    return ['message' => __('Departamento eliminada correctamente.'),'status' => 1];
  }
}
