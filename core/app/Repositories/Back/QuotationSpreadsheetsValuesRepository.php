<?php
namespace App\Repositories\Back;
use App\{
  Models\QuotationSpreadsheetsValues
};
use App\Models\HomeCutomize;
class QuotationSpreadsheetsValuesRepository{
  public function store($request){
    $data = $request;
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit();
    QuotationSpreadsheetsValues::create($data);
  }

  public function update($category, $request){

  }

  public function delete($category){
        
  }
}
