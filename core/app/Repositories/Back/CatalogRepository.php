<?php
namespace App\Repositories\Back;
use App\{
  Models\Catalog
};
use App\Helpers\ImageHelper;
class CatalogRepository{

  public function store($request){
    $input = $request->all();
    $input['title'] = $request->title;
    $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'assets/images/catalog');
    if($request->hasFile('adj_doc')){
      if ($request->file('adj_doc')->isValid()) {
        $file = $request->file('adj_doc');
        $filename = pathinfo($request->file('adj_doc')->getClientOriginalName(), PATHINFO_FILENAME);
        $name_replace = str_replace(' ', '', $filename);
        // $nameFinal = time()."-".date('h-i-s')."-".$name_replace;
        $nameFinal = $name_replace;
        $destination = 'assets/files/catalog'.'/';
        $ext= $file->getClientOriginalExtension();
        $namecomplete = $nameFinal.".".$ext;
        $file->move($destination, $namecomplete);
        $input['adj_doc'] = $namecomplete;
      }
    }
    Catalog::create($input);
  }
  public function update($catalog, $request){
    $input = $request->all();
    if ($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images/catalog',$catalog,'/assets/images/catalog/','photo');
    }
    $catalog->update($input);
  }
  public function delete($catalog){
    ImageHelper::handleDeletedImage($catalog,'photo','assets/images/catalog/');
    $catalog->delete();
  }
}