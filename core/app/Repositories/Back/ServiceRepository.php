<?php

namespace App\Repositories\Back;

use App\{
    Models\Service,
    Helpers\ImageHelper
};

class ServiceRepository
{
    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'assets/images');
        Service::create($input);
    }

    public function update($service, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images',$service,'/assets/images/','photo');
        }
        $service->update($input);
    }

    public function delete($service)
    {
        ImageHelper::handleDeletedImage($service,'photo','assets/images/');
        $service->delete();
    }

}
