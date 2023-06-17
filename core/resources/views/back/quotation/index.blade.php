@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b>{{ __('All Quotation') }}</b></h3>
				<a class="btn btn-primary  btn-sm" href="{{route('back.quotation.create')}}"><i class="fas fa-plus"></i> {{ __('Add') }}</a>
			</div>
		</div>
	</div>
  <input type="hidden" id="product_url" value="{{route('back.quotation.index')}}">
	<div class="card shadow mb-4">
		<div class="card-body">
      @include('alerts.alerts')
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="quotation-table" width="100%" cellspacing="0">
					<thead>
						<tr>
              <th>{{ __('#') }}</th>
              <th>{{ __('Distrito_code') }}</th>
              <th>{{ __('Distrito_n') }}</th>
              <th>{{ __('Provincia_code') }}</th>
              <th>{{ __('Provincia_n') }}</th>
              <th>{{ __('Departamento_code') }}</th>
              <th>{{ __('Departamento_n') }}</th>
              <th>{{ __('Amount (Delivery)') }}</th>
              <th>{{ __('Amount equal to or greater than') }} S/1,600</th>
						</tr>
					</thead>
					<tbody>
            @include('back.quotation.table',compact('datas'))
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{asset('assets/back/js/core/jquery.3.6.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/datatables/dataTables.bootstrap5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/quotation.js')}}"></script>
@endsection