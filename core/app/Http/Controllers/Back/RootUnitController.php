<?php
namespace App\Http\Controllers\Back;
use App\{
    Models\RootUnit,
    Repositories\Back\RootUnitRepository,
    Http\Requests\RootUnitRequest,
    Http\Controllers\Controller
};
class RootUnitController extends Controller{
    public function __construct(RootUnitRepository $repository){
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }
    public function index(){
        return view('back.unitroot.index',[
            'datas' => RootUnit::orderBy('id','desc')->get()
        ]);
    }
    public function create(){
        return view('back.unitroot.create');
    }
    public function store(RootUnitRequest $request){
        $this->repository->store($request);
        return redirect()->route('back.unitroot.index')->withSuccess(__('New UnitRoot Added Successfully.'));
    }
    public function edit(RootUnit $unitroot){
        return view('back.unitroot.edit',compact('unitroot'));
    }
    public function update(RootUnitRequest $request, RootUnit $unitroot){
        $this->repository->update($unitroot, $request);
        return redirect()->route('back.unitroot.index')->withSuccess(__('UnitRoot Updated Successfully.'));
    }
    public function destroy(RootUnit $unitroot){
        $this->repository->delete($unitroot);
        return redirect()->route('back.unitroot.index')->withSuccess(__('UnitRoot Deleted Successfully.'));
    }
}
