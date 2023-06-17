<?php
namespace App\Http\Controllers\Back;
use App\{
    Models\QuotationSpreadsheetsValues,
    Imports\QuotationSpreadsheetsValuesImport,
    Repositories\Back\QuotationSpreadsheetsValuesRepository,
    Http\Requests\QuotationSpreadsheetsValuesRequest,
    // Maatwebsite\Excel\Excel,
    Http\Controllers\Controller
};
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class QuotationSpreadsheetsValuesController extends Controller{
    public function __construct(QuotationSpreadsheetsValuesRepository $repository){
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }

    public function index(){
        
    }

    public function create(Request $request){
        
    }

    public function store(Request $request){
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        exit();
        
        $file = $request->file('spreadsheet');
        Excel::import(new QuotationSpreadsheetsValuesImport, $file);
        return redirect()->route('quotation.index')->with('success', 'Tarifario importado exitosamente.');
    }

    public function show(QuotationSpreadsheetsValues $quotationSpreadsheetsValues){
        
    }

    public function edit(QuotationSpreadsheetsValues $quotationSpreadsheetsValues){
        
    }

    public function update(Request $request, QuotationSpreadsheetsValues $quotationSpreadsheetsValues){
        
    }

    public function destroy(QuotationSpreadsheetsValues $quotationSpreadsheetsValues){
        
    }
}
