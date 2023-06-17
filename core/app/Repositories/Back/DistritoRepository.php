<?php
namespace App\Repositories\Back;
use App\{
  Models\Distrito,
  Helpers\ImageHelper
};
class DistritoRepository{
  public function store($request){
    $input = $request->all();
    Distrito::create($input);
  }
  public function update($distrito, $request){
    $input = $request->all();
    $distrito->update($input);
  }
  public function delete($distrito){
    $distrito->delete();
    return ['message' => __('Distrito eliminada correctamente.'),'status' => 1];
  }
}