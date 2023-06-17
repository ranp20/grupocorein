<?php
namespace App\Repositories\Back;
use App\{
  Models\Provincia,
  Helpers\ImageHelper
};
use App\Models\HomeCutomize;
class ProvinciaRepository{
  public function store($request){
    $input = $request->all();
    Provincia::create($input);
  }
  public function update($provincia, $request){
    $input = $request->all();
    $provincia->update($input);
  }
  public function delete($provincia){
    $provincia->delete();
    return ['message' => __('Provincia eliminada correctamente.'),'status' => 1];
  }
}