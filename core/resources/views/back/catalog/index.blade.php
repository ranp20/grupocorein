@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 pl-3"><b>{{ __('Catalogs') }}</b></h3>
        <a class="btn btn-primary  btn-sm" href="{{route('back.catalog.create')}}"><i class="fas fa-plus"></i> {{ __('Add') }}</a>
      </div>
    </div>
  </div>
  <input type="hidden" id="table-create-data" data-icon="fas fa-plus" data-href="{{ route('back.catalog.create') }}" value="{{ __('Create Category') }}">
	<div class="card shadow mb-4">
		<div class="card-body">
			@include('alerts.alerts')
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
              <th>{{ __('Name') }}</th>
              <th width="20%">{{ __('Image') }}</th>
							<th width="20%">{{ __('Status') }}</th>
							<th width="15%">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
            @include('back.catalog.table',compact('datas'))
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      {{ __('You are going to delete this catalog.') }} {{ __('Do you want to delete it?') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
        <form action="" class="d-inline btn-ok" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- DELETE MODAL ENDS --}}
@endsection
