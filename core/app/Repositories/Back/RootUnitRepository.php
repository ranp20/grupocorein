<?php

namespace App\Repositories\Back;

use App\{
    Models\RootUnit
};
use App\Helpers\ImageHelper;

class RootUnitRepository{

    public function store($request){
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'assets/images');
        RootUnit::create($input);
    }

    public function update($brand, $request){
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images',$brand,'/assets/images/','photo');

        }
        $brand->update($input);
    }

    public function delete($brand){
        ImageHelper::handleDeletedImage($brand,'photo','assets/images/');
        $brand->delete();
    }

}
