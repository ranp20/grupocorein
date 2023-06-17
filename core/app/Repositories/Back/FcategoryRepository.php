<?php

namespace App\Repositories\Back;

use App\{
    Models\Fcategory,
    Models\Gallery,
    Helpers\ImageHelper
};

class FcategoryRepository
{

    /**
     * Store category.
     *
     * @param  \App\Http\Requests\FcategoryRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        Fcategory::create($input);
    }

    /**
     * Update category.
     *
     * @param  \App\Http\Requests\FcategoryRequest  $request
     * @return void
     */

    public function update($fcategory, $request)
    {
        $input = $request->all();
        /*
        if ($file = $request->file('photo')) {
            $images_name = ImageHelper::ItemhandleUploadedImage($request->file('photo'),'assets/images');

            $input['photo'] = $images_name[0];
            $input['thumbnail'] = $images_name[1];
        }
        
        $item_id = Fcategory::create($input)->id;
        */
        
        $fcategory->update($input);
    }

    /**
     * Delete category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($fcategory)
    {
        $fcategory->delete();
    }

}
