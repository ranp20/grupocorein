<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\Post,
  Repositories\Back\PostRepository,
  Http\Requests\ImageStoreRequest,
  Http\Requests\ImageUpdateRequest,
  Http\Controllers\Controller
};
use Illuminate\Http\Request;
class PostController extends Controller{
  public function __construct(PostRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.post.index',[
      'datas' => Post::with('category')->orderBy('id','desc')->get()
    ]);
  }
  public function create(){
    return view('back.post.create');
  }
  public function store(Request $request){
    $request->validate([
      'photo*' => 'required|image',
      'title' => 'required|unique:posts|max:255',
      'details' => 'required',
      'tags' => 'nullable|max:255'
    ]);
    $this->repository->store($request);
    return redirect()->route('back.post.index')->withSuccess(__('New Post Added Successfully.'));
  }
  public function edit(Post $post){
    return view('back.post.edit',compact('post'));
  }
  public function update(Request $request, Post $post){
    $request->validate([
      'photo*' => 'image',
      'title' => 'required|max:255|unique:posts,title,'.$post->id,
      'category_id' => 'required',
      'details' => 'required',
      'tags' => 'nullable|max:255'
    ]);
    $this->repository->update($post, $request);
    return redirect()->route('back.post.index')->withSuccess(__('Post Updated Successfully.'));
  }
  public function destroy(Post $post){
    $this->repository->delete($post);
    return redirect()->route('back.post.index')->withSuccess(__('Post Deleted Successfully.'));
  }
  public function delete($key,$id){
    $this->repository->photoDelete($key,$id);
    return back()->withSuccess(__('Photo Deleted Successfully.'));
  }
}