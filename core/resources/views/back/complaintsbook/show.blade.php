@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class=" mb-0  pl-3"><b>{{ __('Application details') }}</b></h3>
        <a class="btn btn-primary btn-sm" href="{{route('back.complaintsbook.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
      </div>
    </div>
  </div>
  @php
    $departamentoValidExist = "";
    $provinciaValidExist = "";
    $distritoValidExist = "";
    $departamentoAll = DB::table('tbl_departamentos')->select('departamento_name')->where('id', $complaintsbook->cmptbk_departamento_id)->take(1)->get()->toArray();
    $provinciaAll = DB::table('tbl_provincias')->select('provincia_name')->where('id', $complaintsbook->cmptbk_provincia_id)->take(1)->get()->toArray();
    $distritoAll = DB::table('tbl_distritos')->select('distrito_name')->where('id', $complaintsbook->cmptbk_distrito_id)->take(1)->get()->toArray();
    $departamentoValidExist = (count($departamentoAll) > 0) ? $departamentoAll[0]->departamento_name : 'No especificado';
    $provinciaValidExist = (count($provinciaAll) > 0) ? $provinciaAll[0]->provincia_name : 'No especificado';
    $distritoValidExist = (count($distritoAll) > 0) ? $distritoAll[0]->distrito_name : 'No especificado';

    $ageCheckValidShowText = ($complaintsbook->cmptbk_agecheck != '' && $complaintsbook->cmptbk_agecheck != 0) ? __('Yes') : __('No');
    $ageCheckValidShowClass = ($complaintsbook->cmptbk_agecheck != '' && $complaintsbook->cmptbk_agecheck != 0) ? 'text-primary' : 'text-danger';
  @endphp
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title strong pb-0 mb-0">{{__('Identification of the complaining consumer')}}</h3>
        </div>
        <div class="card-body">
          <div class="gd-responsive-table">
            <table class="table table-bordered table-striped">
              <tr>
                <th width="30%">{{ __("Names") }}</th>
                <td><input type="text" name="cmptbk_name" id="cmptbk_name" value="{{$complaintsbook->cmptbk_name}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Department") }}</th>
                <td><input type="text" name="cmptbk_departamento_name" id="cmptbk_departamento_name" value="{{ $departamentoValidExist }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Province") }}</th>
                <td><input type="text" name="cmptbk_provincia_name" id="cmptbk_provincia_name" value="{{ $provinciaValidExist }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("District") }}</th>
                <td><input type="text" name="cmptbk_distrito_name" id="cmptbk_distrito_name" value="{{ $distritoValidExist }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Domicilie") }}</th>
                <td><input type="text" name="cmptbk_domicilio" id="cmptbk_domicilio" value="{{ $complaintsbook->cmptbk_domicilio }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("DNI/CE") }}</th>
                <td><input type="text" name="cmptbk_dni_ce" id="cmptbk_dni_ce" value="{{ $complaintsbook->cmptbk_dni_ce }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("RUC") }}</th>
                <td><input type="text" name="cmptbk_ruc" id="cmptbk_ruc" value="{{ $complaintsbook->cmptbk_ruc }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Business name") }}</th>
                <td><input type="text" name="cmptbk_razonsocial" id="cmptbk_razonsocial" value="{{ $complaintsbook->cmptbk_razonsocial }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Phone") }}</th>
                <td><input type="text" name="cmptbk_telefono" id="cmptbk_telefono" value="{{$complaintsbook->cmptbk_telefono}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("E_mail") }}</th>
                <td><input type="text" name="cmptbk_email" id="cmptbk_email" value="{{$complaintsbook->cmptbk_email}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title strong pb-0 mb-0">{{__("Details of the consumer's claim and request")}}</h3>
        </div>
        <div class="card-body">
          <div class="gd-responsive-table">
            <table class="table table-bordered table-striped">
              <tr>
                <th width="30%">{{ __("Type of Claim") }}</th>
                <td><input type="text" name="cmptbk_typeofclaim" id="cmptbk_typeofclaim" value="{{$complaintsbook->cmptbk_typeofclaim}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Details") }}</th>
                <td>
                  <textarea class="form-control form-control-rounded ipt-mssgtxt_cmptbk" rows="3" maxlength="350" name="cmptbk_detail" id="cmptbk_detail" disabled  aria-expanded="true" aria-visibility="show">{{$complaintsbook->cmptbk_detail}}</textarea>
                </td>
              </tr>
              <tr>
                <th width="30%">{{ __("Pedido") }}</th>
                <td>
                  <textarea class="form-control form-control-rounded ipt-mssgtxt_cmptbk" rows="3" maxlength="350" name="cmptbk_order" id="cmptbk_order" disabled  aria-expanded="true" aria-visibility="show">{{$complaintsbook->cmptbk_order}}</textarea>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title strong pb-0 mb-0">{{__('Younger')}} <span class="strong {{ $ageCheckValidShowClass }}">( {{ $ageCheckValidShowText }} )</span></h3>
        </div>
        @if($complaintsbook->cmptbk_agecheck != '' && $complaintsbook->cmptbk_agecheck != 0)
        @php
          $cmptbk_datayounger = json_decode($complaintsbook->cmptbk_datayounger, TRUE);
          $cmptbk_datayounger_parents = ($cmptbk_datayounger['datayounger']['namesparents'] != null && $cmptbk_datayounger['datayounger']['namesparents'] != "") ? $cmptbk_datayounger['datayounger']['namesparents'] : "No especificado";
          $cmptbk_datayounger_dni_ce = ($cmptbk_datayounger['datayounger']['dni_ce'] != null && $cmptbk_datayounger['datayounger']['dni_ce'] != "") ? $cmptbk_datayounger['datayounger']['dni_ce'] : "No especificado";
          $cmptbk_datayounger_phone = ($cmptbk_datayounger['datayounger']['phone'] != null && $cmptbk_datayounger['datayounger']['phone'] != "") ? $cmptbk_datayounger['datayounger']['phone'] : "No especificado";
          $cmptbk_datayounger_email = ($cmptbk_datayounger['datayounger']['email'] != null && $cmptbk_datayounger['datayounger']['email'] != "") ? $cmptbk_datayounger['datayounger']['email'] : "No especificado";
        @endphp
        <div class="card-body">
          <div class="gd-responsive-table">
            <table class="table table-bordered table-striped">
              <tr>
                <th width="30%">{{ __("Name of father/mother") }}</th>
                <td><input type="text" name="cmptbk_datayounger_parents" id="cmptbk_datayounger_parents" value="{{ $cmptbk_datayounger_parents }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("DNI/CE") }}</th>
                <td><input type="text" name="cmptbk_datayounger_dni_ce" id="cmptbk_datayounger_dni_ce" value="{{ $cmptbk_datayounger_dni_ce }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Phone") }}</th>
                <td><input type="text" name="cmptbk_datayounger_phone" id="cmptbk_datayounger_phone" value="{{ $cmptbk_datayounger_phone }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("E_mail") }}</th>
                <td><input type="text" name="cmptbk_datayounger_email" id="cmptbk_datayounger_email" value="{{ $cmptbk_datayounger_email }}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
            </table>
          </div>
        </div>
        @endif
      </div>
		</div>
		<div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title strong pb-0 mb-0">{{__('Identification of the contracted good')}}</h3>
        </div>
        <div class="card-body">
          <div class="gd-responsive-table">
            <table class="table table-bordered table-striped">
              <tr>
                <th width="30%">{{ __("Type of Good") }}</th>
                <td><input type="text" name="cmptbk_typeofgod" id="cmptbk_typeofgod" value="{{$complaintsbook->cmptbk_typeofgod}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Reclaimed amount") }}</th>
                <td><input type="text" name="cmptbk_reclaimedamount" id="cmptbk_reclaimedamount" value="{{ PriceHelper::adminCurrencyPrice($complaintsbook->cmptbk_reclaimedamount)}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
              <tr>
                <th width="30%">{{ __("Description") }}</th>
                <td><input type="text" name="cmptbk_description" id="cmptbk_description" value="{{$complaintsbook->cmptbk_description}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
		</div>
	</div>
</div>
@endsection