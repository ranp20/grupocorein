@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b>{{ __('Distritos') }}</b></h3>
			</div>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-body">
			@include('alerts.alerts')
			<div class="gd-responsive-table">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>{{ __('#') }}</th>
							<th>{{ __('Distrito_code') }}</th>
              <th>{{ __('Distrito_name') }}</th>
						</tr>
					</thead>
					<tbody>
            @include('back.distrito.table',compact('datas'))
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection