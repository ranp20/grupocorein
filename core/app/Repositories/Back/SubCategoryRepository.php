<?php

namespace App\Repositories\Back;

use App\Models\Subcategory;

class SubCategoryRepository
{
    public function store($request)
    {
        $input = $request->all();
        Subcategory::create($input);
    }

    public function update($category, $request)
    {
        $input = $request->all();
        
        $category->update($input);
    }

    public function delete($category)
    {
        $category->delete();
    }

}
