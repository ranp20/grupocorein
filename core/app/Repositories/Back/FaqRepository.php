<?php

namespace App\Repositories\Back;

use App\{
    Models\Faq,
    Models\galleries_faq,
    Helpers\ImageHelper
};

class FaqRepository
{

    public function store($request)
    {
        $input = $request->all();
        
        $input['title'] = $request->title;
        $input['category_id'] = $request->category_id;
        $input['details'] = $request->details;
        
        /*-- NUEVO CONTENIDO (INICIO) --*/
        if($request->hasFile('adj_doc')){
            if ($request->file('adj_doc')->isValid()) {
                $file = $request->file('adj_doc');
                $filename = pathinfo($request->file('adj_doc')->getClientOriginalName(), PATHINFO_FILENAME);
                $name_replace = str_replace(' ', '', $filename);
                $nameFinal = time()."-".date('h-i-s')."-".$name_replace;
                $destination = 'assets/files/faq/adj_doc'.'/';
                $ext= $file->getClientOriginalExtension();
                $namecomplete = $nameFinal.".".$ext;
                $file->move($destination, $namecomplete);

                $input['adj_doc'] = $namecomplete;
            }
        }
        /*-- NUEVO CONTENIDO (FIN) --*/
        
        $faq_id = Faq::create($input)->id;
        
        if(isset($input['galleries'])){
            $this->galleries_faqUpdate($request,$faq_id);
        }
    }

    public function update($faq, $request)
    {
        $input = $request->all();
        
        $input['title'] = $request->title;
        $input['category_id'] = $request->category_id;
        $input['details'] = $request->details;
        
        /*-- NUEVO CONTENIDO (INICIO) --*/
        if($request->hasFile('adj_doc')){
            if ($request->file('adj_doc')->isValid()) {
                $file = $request->file('adj_doc');
                $filename = pathinfo($request->file('adj_doc')->getClientOriginalName(), PATHINFO_FILENAME);
                $name_replace = str_replace(' ', '', $filename);
                $nameFinal = time()."-".date('h-i-s')."-".$name_replace;
                $destination = 'assets/files/faq/adj_doc'.'/';
                $ext= $file->getClientOriginalExtension();
                $namecomplete = $nameFinal.".".$ext;
                $file->move($destination, $namecomplete);

                $input['adj_doc'] = $namecomplete;
            }
        }
        /*-- NUEVO CONTENIDO (FIN) --*/
        
        $faq->update($input);
        
        if(isset($input['galleries'])){
            $this->galleries_faqUpdate($request,$faq->id);
        }
    }

    public function delete($faq)
    {
        if($faq->galleries()->count() > 0){
            foreach($faq->galleries as $gallery){
                $this->galleries_faqDelete($gallery);
            }
        }
        ImageHelper::handleDeletedImage($faq,'photo','assets/images/faq_images/');
        $faq->delete();
    }
    
    public function galleries_faqUpdate($request,$faq_id=null)
    {
        galleries_faq::insert($this->storeImageData($request,$faq_id));
    }

    public function galleries_faqDelete($gallery)
    {
        ImageHelper::handleDeletedImage($gallery,'photo','/assets/images/faq_images/');
        $gallery->delete();
    }
    
    public function storeImageData($request,$faq_id=null)
    {
        $storeData = [];
        if ($galleries = $request->file('galleries')) {
            foreach($galleries as $key => $gallery){
                $storeData[$key] = [
                    'photo'=>  ImageHelper::handleUploadedImage($gallery,'assets/images/faq_images'),
                    'faq_id' => $faq_id ? $faq_id : $request['faq_id'],
                ];
            }
        }
        return $storeData;
    }

}
