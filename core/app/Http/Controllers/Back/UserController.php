<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\User,
  Http\Controllers\Controller
};
use App\Helpers\ImageHelper;
use App\Http\Requests\UserRequest;
use App\Models\Subscriber;
use App\Repositories\Front\UserRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class UserController extends Controller{
  public function __construct(UserRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.user.index',[
      'datas' => User::latest()->get()
    ]);
  }
  public function show($id){
    $uservalid = User::where("id","=",$id)->get();
    if(count($uservalid) > 0){
      $user = User::findOrFail($id);
      return view('back.user.show',compact('user'));
    }else{
      return view('back.user.index',[ 'datas' => User::latest()->get()]);
    }
  }
  public function update(UserRequest $request){
    $request->validate([
      'password' => 'min:6|max:16|nullable'
    ]);
    $this->repository->profileUpdate($request);
    return redirect()->back()->withSuccess(__('Profile Updated Successfully.'));
  }
  public function destroy(User $user){
    ImageHelper::handleDeletedImage($user,'photo','assets/images/');
    $user->delete();
    return redirect()->route('back.user.index')->withSuccess(__('Customer Deleted Successfully.'));
  }
}
