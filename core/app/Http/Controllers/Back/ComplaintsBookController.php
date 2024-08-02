<?php
namespace App\Http\Controllers\Back;
use App\{
  Models\ComplaintsBook,
  Http\Controllers\Controller
};
use Illuminate\Http\Request;
class ComplaintsBookController extends Controller{
  public function index(){
    return view('back.complaintsbook.index',['datas' => ComplaintsBook::latest()->get()]);
  }
  public function create(){
      //
  }
  public function store(Request $request){
      //
  }
  public function show($id){
    $complaintsbookvalid = ComplaintsBook::where("id","=",$id)->get();
    if(count($complaintsbookvalid) > 0){
      $complaintsbook = ComplaintsBook::findOrFail($id);
      return view('back.complaintsbook.show',compact('complaintsbook'));
    }else{
      return view('back.complaintsbook.index',[ 'datas' => ComplaintsBook::latest()->get()]);
    }
  }
  public function edit(ComplaintsBook $complaintsBook){
      //
  }
  public function update(Request $request, ComplaintsBook $complaintsBook){
      //
  }
  public function destroy(ComplaintsBook $complaintsBook){
      //
  }
}