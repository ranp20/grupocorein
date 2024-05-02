<?php
namespace App\Repositories\Back;
use App\{
  Models\Item,
  Models\Gallery,
  Helpers\ImageHelper
};
use App\Models\Currency;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile; 
class ItemRepository{
  public function store($request){
    $input = $request->all();
    if($request->has('unidadraiz')){
      $input['unidad_raiz'] = $request->unidadraiz;
    }
    if($request->has('atributoraiz')){
      $input['atributo_raiz'] = $request->atributoraiz;
    }
    $stores = [];
    if($request->has('store_availables')){
      foreach($request->store_availables as $key => $store){
        $stores['store'][$key]['id'] = $store;
      }
      $input['store_availables'] = json_encode($stores, true);
    }
    $atributoraiz_collection = [];
    $codeFinal = "";
    $colorname = (isset($request->color_name)) ? $request->color_name : "";
    if($request->has('color_code')){
      foreach($request->color_code as $key => $code){
        $codeFinal = ($code != "" && $code != null) ? $code : $colorname[$key];
        // echo $code."<br>";
        // if($code != null && $code != ""){
          $atributoraiz_collection['atributoraiz_collection']['color'][$key]['code'] = $codeFinal;
        // }
      }
    }
    if($request->has('color_name')){
      foreach($request->color_name as $key => $name){
        $atributoraiz_collection['atributoraiz_collection']['color'][$key]['name'] = $name;
      }
    }
    $input['atributoraiz_collection'] = json_encode($atributoraiz_collection, true);
    if($file = $request->file('photo')){
      $images_name = ImageHelper::ItemhandleUploadedImagePrincipalItem($request->file('photo'),'assets/images/items');
      $input['photo'] = $images_name[0];
      $input['thumbnail'] = $images_name[1];
    }
    $curr = Currency::where('is_default',1)->first();
    $input['discount_price'] = $request->discount_price / $curr->value;
    $input['previous_price'] = $request->previous_price / $curr->value;
    if($request->has('meta_keywords')){
      $input['meta_keywords'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->meta_keywords);
    }
    if($request->has('is_social')){
      $input['social_icons'] = json_encode($input['social_icons']);
      $input['social_links'] = json_encode($input['social_links']);
    }else{
      $input['is_social']    = 0;
      $input['social_icons'] = null;
      $input['social_links'] = null;
    }
    if($request->has('tags')){
      $input['tags'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->tags);
    }
    if($request->has('is_specification')){
      $input['specification_name'] = json_encode($input['specification_name']);
      $input['specification_description'] = json_encode($input['specification_description']);
    }else{
      $input['is_specification']    = 0;
      $input['specification_name'] = null;
      $input['specification_description'] = null;
    }
    $specification_collection = [];
    $nameFinal = "";
    $specificationdescription = (isset($request->specification_description)) ? $request->specification_description : "";
    if($request->has('specification_name')){
      foreach($request->specification_name as $key => $name){
        $nameFinal = ($name != "" && $name != null) ? $name : $specificationdescription[$key];
        // echo $name."<br>";
        // if($name != null && $name != ""){
          $specification_collection['specification_collection']['product'][$key]['name'] = $nameFinal;
        // }
      }
    }
    if($request->has('specification_description')){
      foreach($request->specification_description as $key => $description){
        $specification_collection['specification_collection']['product'][$key]['description'] = $description;
      }
    }
    $input['specification_collection'] = json_encode($specification_collection, true);

    if($request->has('license_name') && $request->has('license_key')){
      $input['license_name'] = json_encode($input['license_name']);
      $input['license_key'] = json_encode($input['license_key']);
    }else{
      $input['license_name'] = null;
      $input['license_key'] = null;
    }
    // digital product file upload
    if($request->item_type == 'digital'){
      if($request->hasFile('file')){
        $file = $request->file;
        $name = str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/files/items',$name);
        $input['file'] = $name;
      }
    }
    if($request->item_type == 'license'){
      if($request->hasFile('file')){
        $file = $request->file;
        $name = str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/files/items',$name);
        $input['file'] = $name;
      }
    }
    $input['is_type'] = 'undefine';
    /*-- NUEVO CONTENIDO (INICIO) --*/
    if($request->hasFile('adj_doc')){
      if($request->file('adj_doc')->isValid()){
        $file = $request->file('adj_doc');
        $filename = pathinfo($request->file('adj_doc')->getClientOriginalName(), PATHINFO_FILENAME);
        $name_replace = str_replace(' ', '', $filename);
        // $nameFinal = time()."-".date('h-i-s')."-".$name_replace;
        $nameFinal = $name_replace;
        $destination = 'assets/files/items/';
        $ext= $file->getClientOriginalExtension();
        $namecomplete = $nameFinal.".".$ext;
        $file->move($destination, $namecomplete);

        $input['adj_doc'] = $namecomplete;
      }
    }
    /*
    echo "<pre>";
    print_r($request->all());
    echo "</pre>";
    echo "<br>";
    */
    /*
    echo "<pre>";
    print_r($input);
    echo "</pre>";
    exit();
    */
    /*-- NUEVO CONTENIDO (FIN) --*/
    $item_id = Item::create($input)->id;
    if(isset($input['galleries'])){
      $this->galleriesUpdate($request,$item_id);
    }
    return $item_id;
  }
  public function update($item,$request){
    $input = $request->all();
    if($request->has('unidadraiz')){
      $input['unidad_raiz'] = $request->unidadraiz;
    }
    if($request->has('atributoraiz')){
      $input['atributo_raiz'] = $request->atributoraiz;
    }
    $stores = [];
    if($request->has('store_availables')){
      foreach($request->store_availables as $key => $store){
        $stores['store'][$key]['id'] = $store;
      }
      $input['store_availables'] = json_encode($stores, true);
    }else{
      $input['store_availables'] = null;
    }
    $atributoraiz_collection = [];
    $codeFinal = "";
    $colorname = (isset($request->color_name)) ? $request->color_name : "";
    if($request->has('color_code')){
      foreach($request->color_code as $key => $code){
        $codeFinal = ($code != "" && $code != null) ? $code : $colorname[$key];
        // echo $code."<br>";
        // if($code != null && $code != ""){
          $atributoraiz_collection['atributoraiz_collection']['color'][$key]['code'] = $codeFinal;
        // }
      }
    }
    if($request->has('color_name')){
      foreach($request->color_name as $key => $name){
        $atributoraiz_collection['atributoraiz_collection']['color'][$key]['name'] = $name;
      }
    }
    $input['atributoraiz_collection'] = json_encode($atributoraiz_collection, true);
    if($request->file('photo')){
      $images_name = ImageHelper::ItemhandleUpdatedUploadedImagePrincipalItem($request->photo,'/assets/images/items',$item,'/assets/images/items/','photo');
      $input['photo'] = $images_name[0];
      $input['thumbnail'] = $images_name[1];
    }
    if($request->has('meta_keywords')){
      $input['meta_keywords'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->meta_keywords);
    }
    $curr = Currency::where('is_default',1)->first();
    $input['discount_price'] = $request->discount_price / $curr->value;
    $input['previous_price'] = $request->previous_price / $curr->value;
    if($request->has('is_social')){
      $input['social_icons'] = json_encode($input['social_icons']);
      $input['social_links'] = json_encode($input['social_links']);
    }else{
      $input['is_social']    = 0;
      $input['social_icons'] = null;
      $input['social_links'] = null;
    }
    if($request->has('tags')){
      $input['tags'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->tags);
    }
    /*
    echo "<pre>";
    print_r($input);
    echo "<pre>";
    exit();
    if($request->has('is_specification')){
      if($request->has('specification_name')){}
      $input['specification_name'] = json_encode($input['specification_name']);
      $input['specification_description'] = json_encode($input['specification_description']);
    }else{
      $input['is_specification']    = 0;
      $input['specification_name'] = null;
      $input['specification_description'] = null;
    }
    */
    $specification_collection = [];
    $nameFinal = "";
    if($request->has('is_specification')){
      $specificationdescription = (isset($request->specification_description)) ? $request->specification_description : "";
      if($request->has('specification_name')){
        foreach($request->specification_name as $key => $name){
          $nameFinal = ($name != "" && $name != null) ? $name : $specificationdescription[$key];
          // echo $name."<br>";
          // if($name != null && $name != ""){
            $specification_collection['specification_collection']['product'][$key]['name'] = $nameFinal;
          // }
        }
      }
      if($request->has('specification_description')){
        foreach($request->specification_description as $key => $description){
          $specification_collection['specification_collection']['product'][$key]['description'] = $description;
        }
      }
      $input['specification_collection'] = json_encode($specification_collection, true);
    }else{
      $input['is_specification'] = 0;
      $input['specification_name'] = null;
      $input['specification_description'] = null;
    }
    

    if($request->has('license_name') && $request->has('license_key')){
      $input['license_name'] = json_encode($input['license_name']);
      $input['license_key'] = json_encode($input['license_key']);
    }else{
      $input['license_name'] = null;
      $input['license_key'] = null;
    }
    if($request->item_type == 'digital'){
      if(!$request->hasFile('file')){
        if($request->link){
          if(file_exists('assets/files/items/'.$item->file)){
            unlink('assets/files/items/'.$item->file);
          }
          $input['file'] = null;
        }
      }
    }
    // digital product file upload
    if($request->item_type == 'digital'){
      if($request->hasFile('file')){
        if($item->file){
          if(file_exists('assets/files/items/'.$item->file)){
            unlink('assets/files/items/'.$item->file);
          }
        }
        $file = $request->file;
        $name = str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/files/items',$name);
        $input['file'] = $name;
        $input['link'] = null;
      }
    }
    /*-- NUEVO CONTENIDO (INICIO) --*/
    if($request->hasFile('adj_doc')){
      if($request->file('adj_doc')->isValid()){
        $file = $request->file('adj_doc');
        $filename = pathinfo($request->file('adj_doc')->getClientOriginalName(), PATHINFO_FILENAME);
        $name_replace = str_replace(' ', '', $filename);
        // $nameFinal = time()."-".date('h-i-s')."-".$name_replace;
        $destination = 'assets/files/items/';
        $ext= $file->getClientOriginalExtension();
        $namecomplete = $name_replace.".".$ext;
        $file->move($destination, $namecomplete);
        $input['adj_doc'] = $namecomplete;
      }
    }
    /*-- NUEVO CONTENIDO (FIN) --*/
    /*
    echo "<pre>";
    print_r($input);
    echo "<pre>";
    echo "<pre>";
    print_r(json_decode($input['atributoraiz_collection'], TRUE));
    echo "<pre>";
    exit();
    */
    $item->update($input);
    if(isset($input['galleries'])){
      $this->galleriesUpdate($request,$item->id);
    }
  }
  public function highlight($item,$request){
    $input = $request->all();
    if($request->is_type != 'flash_deal'){
      $input['date'] = null;
    }
    $item->update($input);
  }
  public function delete($item){
    if($item->galleries()->count() > 0){
      foreach($item->galleries as $gallery){
        $this->galleryDelete($gallery);
      }
    }
    if($item->campaigns->count() > 0){
      $item->campaigns()->delete();
    }
    if($item->reviews->count() > 0){
      $item->reviews()->delete();
    }
    if($item->attributes()->count() > 0){
      foreach($item->attributes as $attribute){
        $attribute->options()->delete();
      }
      $item->attributes()->delete();
    }
    ImageHelper::handleDeletedImage($item,'photo','assets/images/items/');
    ImageHelper::handleDeletedImage($item,'thumbnail','assets/images/items/');
    if($item->item_type == 'digital' && $item->file){
      ImageHelper::handleDeletedImage($item,'file','assets/files/items/');
    }
    $item->delete();
  }
  // ------------------- INSERTAR IMÁGENES DEL PRODUCTO EN TABLA "galleries" ($path)
  public function galleriesUpdate($request,$item_id=null){
    Gallery::insert($this->storeImageData($request,$item_id));
  }
  public function galleryDelete($gallery){
    ImageHelper::handleDeletedImage($gallery,'photo','/assets/images/items/');
    $gallery->delete();
  }
  // ------------------- SUBIR IMÁGENES DEL PRODUCTO EN DIRECTORIO ($path)
  public function storeImageData($request,$item_id=null){
    $storeData = [];
    if($galleries = $request->file('galleries')){
      foreach($galleries as $key => $gallery){
        $storeData[$key] = [
          'photo'=>  ImageHelper::handleUploadedImageGallery($gallery,'assets/images/items'),
          'item_id' => $item_id ? $item_id : $request['item_id'],
        ];
      }
    }
    return $storeData;
  }
  /*
  public function pathToUploadedFile( $path, $test = true ){
    $filesystem = new Filesystem;
    $name = $filesystem->name( $path );
    $extension = $filesystem->extension( $path );
    $originalName = $name . '.' . $extension;
    $mimeType = $filesystem->mimeType( $path );
    $error = null;
    return new UploadedFile( $path, $originalName, $mimeType, $error, $test );
  }
  */
}