<?php
namespace App\Http\Controllers\Back;
// namespace Illuminate\Support\Facades;
use App\{
  Models\Distrito,
  Repositories\Back\DistritoRepository,
  Http\Requests\DistritoRequest,
  Models\Provincia,
  Repositories\Back\ProvinciaRepository,
  Http\Requests\ProvinciaRequest,
  Models\Departamento,
  Repositories\Back\DepartamentoRepository,
  Http\Requests\DepartamentoRequest,
  Models\QuotationSpreadsheets,
  Repositories\Back\QuotationSpreadsheetsRepository,
  Models\QuotationSpreadsheetsValues,
  Imports\QuotationSpreadsheetsValuesImport,
  Repositories\Back\QuotationSpreadsheetsValuesRepository,
  Http\Requests\QuotationSpreadsheetsRequest,
  Http\Controllers\Controller
};

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class QuotationSpreadsheetsController extends Controller{
  public function __construct(QuotationSpreadsheetsValuesRepository $repository){
    $this->middleware('auth:admin');
    $this->middleware('adminlocalize');
    $this->repository = $repository;
  }
  public function index(){
    return view('back.quotation.index',[
      'datas' => QuotationSpreadsheetsValues::orderBy('id','asc')->get()
    ]);
  }
  public function create(){
    return view('back.quotation.create');
  }
  public function store(Request $request){
    if($request->hasFile('spreadsheet')){
      if(empty($request->file('spreadsheet')->getRealPath())){
        return back()->with('error','Ningún archivo seleccionado');
      }
      $file = $request->file('spreadsheet');
      // Excel::import(new QuotationSpreadsheetsValuesImport, $file);
      $arraySpreadsheet = Excel::toArray(new QuotationSpreadsheetsValuesImport, $file);
      if(!empty($arraySpreadsheet)){
        $countImport = 1;
        $date = date('Y-m-d H:i:s');
        for($i = 0;$i < count($arraySpreadsheet[0]);$i++){                    
          // $datosImportar[$i]['cod_insert'] = $countImport;
          $datosImportar[$i]['distrito_code'] = $arraySpreadsheet[0][$i]['c_cod_distrito'];
          $datosImportar[$i]['distrito_nombre'] = $arraySpreadsheet[0][$i]['c_nom_distrito'];
          $datosImportar[$i]['provincia_code'] = $arraySpreadsheet[0][$i]['c_cod_provincia'];
          $datosImportar[$i]['provincia_nombre'] = $arraySpreadsheet[0][$i]['c_nom_provincia'];
          $datosImportar[$i]['departamento_code'] = $arraySpreadsheet[0][$i]['c_cod_departamento'];
          $datosImportar[$i]['departamento_nombre'] = $arraySpreadsheet[0][$i]['c_nom_departamento'];
          // $datosImportar[$i]['min_amount'] = $arraySpreadsheet[0][$i]['monto_delivery'];
          $datosImportar[$i]['min_amount'] = str_replace('s/','',$arraySpreadsheet[0][$i]['monto_delivery']);;
          $datosImportar[$i]['max_amount'] = $arraySpreadsheet[0][$i]['monto_minimo_s1600'];
          $datosImportar[$i]['created_at'] = $date;
          $datosImportar[$i]['updated_at'] = $date;
        }
        foreach($datosImportar as $k => $v){
          // DISTRITO
          $dataDistrito[$k]['departamento_code'] = $v['departamento_code'];
          $dataDistrito[$k]['provincia_code'] = $v['provincia_code'];
          $dataDistrito[$k]['distrito_code'] = $v['distrito_code'];
          $dataDistrito[$k]['distrito_name'] = $v['distrito_nombre'];
          $dataDistrito[$k]['distrito_min_amount'] = $v['min_amount'];
          $dataDistrito[$k]['distrito_max_amount'] = $v['max_amount'];
          $dataDistrito[$k]['created_at'] = $date;
          $dataDistrito[$k]['updated_at'] = $date;
          // PROVINCIA
          $dataProvincia[$k]['departamento_code'] = $v['departamento_code'];
          $dataProvincia[$k]['provincia_code'] = $v['provincia_code'];
          $dataProvincia[$k]['provincia_name'] = $v['provincia_nombre'];
          $dataProvincia[$k]['created_at'] = $date;
          $dataProvincia[$k]['updated_at'] = $date;
          // DEPARTAMENTO
          $dataDepartamento[$k]['departamento_code'] = $v['departamento_code'];
          $dataDepartamento[$k]['departamento_name'] = $v['departamento_nombre'];
          $dataDepartamento[$k]['created_at'] = $date;
          $dataDepartamento[$k]['updated_at'] = $date;
        }
        // ORDENANDO Y AGRUPANDO LOS VALORES REPETIDOS - PROVINCIA
        $provinciaArr = [];
        foreach($dataProvincia as $k => $v){
          $provinciaArr[$v['provincia_code']] = $v;
        }
        array_unshift($provinciaArr);
        // ORDENANDO Y AGRUPANDO LOS VALORES REPETIDOS - DEPARTAMENTO
        $departamentoArr = [];
        foreach($dataDepartamento as $k => $v){
          $departamentoArr[$v['departamento_code']] = $v;
        }
        array_unshift($departamentoArr);

        $file = $request->file('spreadsheet');
        $filename = pathinfo($request->file('spreadsheet')->getClientOriginalName(), PATHINFO_FILENAME);
        $name_replace = str_replace(' ', '', $filename);
        $nameFinal = time()."-".date('Y-m-d h-i-s')."-".$name_replace;
        $destination = 'assets/files/quotations'.'/';
        $ext= $file->getClientOriginalExtension();
        $namecomplete = $nameFinal.".".$ext;
        $file->move($destination, $namecomplete);

        // GUARDAR EL NOMBRE DEL ARCHIVO SUBIDO
        $arrFileUploaded = array(
          'spreadsheet' => $name_replace,
          'created_at' => $date,
          'updated_at' => $date
        );

        QuotationSpreadsheets::insert($arrFileUploaded);
        QuotationSpreadsheetsValues::insert($datosImportar);
        Distrito::insert($dataDistrito);
        Provincia::insert($provinciaArr);
        Departamento::insert($departamentoArr);
        // $this->repository->store($datosImportar);
        return redirect()->route('back.quotation.index')->with('success', 'Tarifario importado exitosamente.');
      }
    }
  }
  public function show(QuotationSpreadsheets $quotationSpreadsheets){
    
  }
  public function edit(QuotationSpreadsheets $quotationSpreadsheets){
    
  }
  public function update(Request $request, QuotationSpreadsheets $quotationSpreadsheets){
    
  }
  public function destroy(QuotationSpreadsheets $quotationSpreadsheets){
    
  }
}
