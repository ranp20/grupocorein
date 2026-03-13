<?php
namespace App\Repositories\Back;
use App\{
  Models\Sitemap
};
use App\Models\HomeCutomize;
class SitemapRepository{
  public function update($sitemap, $request){
    $input = $request->all();
    $sitemap->update($input);
  }
}
