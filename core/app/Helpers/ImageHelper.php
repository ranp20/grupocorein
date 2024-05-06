<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use Image;
class ImageHelper{
  // ------------------- GUARDAR ARCHIVOS EN SUS RESPECTIVOS DIRECTORIOS ($path)
  public static function handleUploadedImage($file,$path,$delete=null){
    if($file){
      if($delete){
        if(file_exists(base_path('../').$path.'/'.$delete)){
          unlink(base_path('../').$path.'/'.$delete);
        }
      }
      $name = $file->getClientOriginalName();
      $file->move($path,$name);
      return $name;
    }
  }
  // ------------------- ACTUALIZAR ARCHIVOS EN SUS RESPECTIVOS DIRECTORIOS, ELIMINAR Y REEMPLAZAR ($path)
  public static function handleUpdatedUploadedImage($file,$path,$data,$delete_path,$field){
    $name = $file->getClientOriginalName();
    $file->move(base_path('..').$path,$name);
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
    return $name;
  }
  public static function ItemhandleUpdatedUploadedImage($file,$path,$data,$delete_path,$field){
    $photo = $file->getClientOriginalName();
    $thum = $file->getClientOriginalExtension();
    $image = \Image::make($file)->resize(230,230);
    $image->save(base_path('..').$path.'/'.$thum);
    $file->move(base_path('..').$path,$photo);
    if($data['thumbnail'] != null){
      if(file_exists(base_path('../').$delete_path.$data['thumbnail'])){
        unlink(base_path('../').$delete_path.$data['thumbnail']);
      }
    }
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
    return [$photo,$thum];
  }
  // ------------------- ELIMINAR ARCHIVOS EN SUS RESPECTIVOS DIRECTORIOS
  public static function handleDeletedImage($data,$field,$delete_path){       
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
  }
  // ------------- GUARDAR IMAGEN DE CUPÓN...
  public static function ItemhandleUploadedCoupon($file,$path,$delete=null){
    if($file){
      if($delete){
        if(file_exists(base_path('../').$path.'/'.$delete)){
          unlink(base_path('../').$path.'/'.$delete);
        }
      }
      $name = $file->getClientOriginalName();
      $file->move($path,$name);
      return $name;
    }
  }
  // ------------------- ACTUALIZAR IMAGEN DE CUPÓN
  public static function handleUpdatedUploadedCoupon($file,$path,$data,$delete_path,$field){
    $name = $file->getClientOriginalName();
    $file->move(base_path('..').$path,$name);
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
    return $name;
  }
  // ------------------- GUARDAR IMÁGEN PRINCIPAL DEL PRODUCTO ($path)
  public static function ItemhandleUploadedImagePrincipalItem($file,$path,$delete=null){
    if($file){
      if($delete){
        if(file_exists(base_path('../').$path.'/'.$delete)){
          unlink(base_path('../').$path.'/'.$delete);
        }
      }
      $photo = $file->getClientOriginalName();
      $path_info = pathinfo($photo);
      $filename = $path_info['filename'];
      $extension = $path_info['extension'];
      $ext = $file->getClientOriginalExtension();
      $fileNameFinal = time().'-'.$filename.'.'.$ext;
      // $fileNameFinal = $filename.'.'.$ext;
      $image = \Image::make($file);
      $image->resize(700, 700, function ($constraint) {
        $constraint->aspectRatio(); // Mantener la proporción original
        $constraint->upsize(); // No ampliar la imagen si es más pequeña que el widthxheight especificado
      });
      $image->save(base_path('../').$path.'/'.$fileNameFinal);
      // $file->move($path,$photo);
      return [$fileNameFinal,$fileNameFinal];
    }
  }
  // ------------------- EDITAR IMÁGEN PRINCIPAL DE PRODUCTO EN SU RESPECTIVO DIRECTORIO ($path)
  public static function ItemhandleUpdatedUploadedImagePrincipalItem($file,$path,$data,$delete_path,$field){
    $photo = $file->getClientOriginalName();
    $thum = $file->getClientOriginalExtension();
    $image = \Image::make($file)->resize(230,230);
    $image->save(base_path('..').$path.'/'.$thum);
    $file->move(base_path('..').$path,$photo);
    if($data['thumbnail'] != null){
      if(file_exists(base_path('../').$delete_path.$data['thumbnail'])){
        unlink(base_path('../').$delete_path.$data['thumbnail']);
      }
    }
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
    return [$photo,$thum];
  }
  // ------------------- GUARDAR Y EDITAR GALLERÍA DE IMÁGENES DE PRODUCTOS EN SU RESPECTIVO DIRECTORIO ($path)
  public static function handleUploadedImageGallery($file,$path,$delete=null){
    if($file){
      if($delete){
        if(file_exists(base_path('../').$path.'/'.$delete)){
          unlink(base_path('../').$path.'/'.$delete);
        }
      }
      $photo = $file->getClientOriginalName();
      $path_info = pathinfo($photo);
      $filename = $path_info['filename'];
      $extension = $path_info['extension'];
      $ext = $file->getClientOriginalExtension();
      $fileNameFinal = time().'-'.$filename.'.'.$ext;
      // $fileNameFinal = $filename.'.'.$ext;
      $image = \Image::make($file);
      $image->resize(700, 700, function ($constraint){
        $constraint->aspectRatio(); // Mantener la proporción original
        $constraint->upsize(); // No ampliar la imagen si es más pequeña que el widthxheight especificado
      });
      $image->save(base_path('../').$path.'/'.$fileNameFinal);
      // $file->move($path,$photo);
      return $fileNameFinal;
    }
  }
  // ------------------- GUARDAR IMÁGENES DE SLIDER EN SU RESPECTIVA DIRECTIVA ($path)
  public static function handleUploadedImageSlider($file,$path,$delete=null){
    if($file){
      if($delete){
        if(file_exists(base_path('../').$path.'/'.$delete)){
          unlink(base_path('../').$path.'/'.$delete);
        }
      }
      $photo = $file->getClientOriginalName();
      $path_info = pathinfo($photo);
      $filename = $path_info['filename'];
      $extension = $path_info['extension'];
      $ext = $file->getClientOriginalExtension();
      $fileNameFinal = $filename.'.'.$ext;
      $image = \Image::make($file);
      $image->resize(1200, 1200, function ($constraint){
        $constraint->aspectRatio(); // Mantener la proporción original
        $constraint->upsize(); // No ampliar la imagen si es más pequeña que el widthxheight especificado
      });
      $image->save(base_path('../').$path.'/'.$fileNameFinal);
      // $file->move($path,$photo);
      return $fileNameFinal;
    }
  }
  // ------------------- ACTUALIZAR IMÁGENES DE SLIDER EN SU RESPECTIVA DIRECTIVA, ELIMINAR Y REEMPLAZAR ($path)
  public static function handleUpdatedUploadedImageSlider($file,$path,$data,$delete_path,$field){
    $filename = $file->getClientOriginalName();
    $file->move(base_path('..').$path,$filename);
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
    return $filename;
  }
  // ------------------- ACTUALIZAR ICONO DE USUARIO ($path)
  public static function handleUpdatedUploadedImageUser($file,$path,$data,$delete_path,$field){
    // $name = $file->getClientOriginalName();
    // $file->move(base_path('..').$path,$name);
    if($data[$field] != null){
      if(file_exists(base_path('../').$delete_path.$data[$field])){
        unlink(base_path('../').$delete_path.$data[$field]);
      }
    }
    $photo = $file->getClientOriginalName();
    $path_info = pathinfo($photo);
    $filename = $path_info['filename'];
    $extension = $path_info['extension'];
    $ext = $file->getClientOriginalExtension();
    $fileNameFinal = $filename.'.'.$ext;
    $image = \Image::make($file);
    $image->resize(150, 150, function ($constraint){
      $constraint->aspectRatio(); // Mantener la proporción original
      $constraint->upsize(); // No ampliar la imagen si es más pequeña que el widthxheight especificado
    });
    $image->save(base_path('../').$path.'/'.$fileNameFinal);
    // $file->move($path,$photo);
    return $fileNameFinal;
  }
}