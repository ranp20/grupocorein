<?php
namespace App\Http\Controllers\Back;
use App\Models\Sitemap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller{
  public function __construct(){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
  }
  public function index(Request $request){
    $data['sitemaps'] = Sitemap::orderBy('id', 'DESC')->paginate(10);
    return view('back.settings.sitemap.index', $data);
  }
  public function add(){
    return view('back.settings.sitemap.add');
  }
  public function download(Request $request){
    return response()->download('assets/sitemaps/'.$request->filename);
  }
  public function store(Request $request){
    $data = new Sitemap();
    $input = $request->all();
    $input['sitemap_url'] = (isset($request->sitemap_url) && $request->sitemap_url) ? "" : 'No especificado';
    $input['filename'] = (isset($request->filename) && $request->filename) ? "" : 'No especificado';
    $data->fill($input)->save();
    return redirect()->route('back.sitemap.index')->withSuccess(__('Added new sitemap'));
  }
  public function edit($id){
    $sitemap = Sitemap::find($id)->first();
    return view('back.settings.sitemap.edit',compact('sitemap'));
  }
  public function update(Request $request, $id){
    $data = new Sitemap();
    $input = $request->all();
    $input['sitemap_url'] = (isset($request->sitemap_url) && $request->sitemap_url) ? "" : 'No especificado';
    $input['filename'] = (isset($request->filename) && $request->filename) ? "" : 'No especificado';
    $input['id'] = $id;
    Sitemap::find($id)->update($input);
    $data->update($input);
    return redirect()->route('back.sitemap.index')->withSuccess(__('Sitemap Updated Successfully.'));
  }
  public function status($id,$status){
    Sitemap::find($id)->update(['sitemap_status' => $status]);
    return redirect()->route('back.sitemap.index')->withSuccess(__('Status Updated Successfully.'));
  }
  public function delete($id){
    $sitemap = Sitemap::find($id);
    $sitemap->delete();
    return redirect()->back()->withSuccess(__('Sitemap deleted successfully!'));
  }
}
