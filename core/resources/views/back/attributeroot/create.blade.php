@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b>{{ __('Create AttributeRoot') }}</b> </h3>
				<a class="btn btn-primary  btn-sm" href="{{route('back.attributeroot.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="admin-form" action="{{ route('back.attributeroot.store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								@include('alerts.alerts')
								<div class="form-group">
									<label for="name">{{ __('Name') }} *</label>
									<input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
