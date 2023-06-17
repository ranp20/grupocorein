@extends('master.back')

@section('content')

<div class="container-fluid">
	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Edit Ciudad') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('back.ciudad.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
	<!-- Form -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="admin-form" action="{{ route('back.ciudad.update',$ciudad->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
								@method('PUT')
								@include('alerts.alerts')

								<div class="form-group">
									<label for="provincia_id">{{ __('Select Category') }} *</label>
									<select name="provincia_id" id="provincia_id" class="form-control" >
										@foreach(DB::table('provincias')->get() as $provincia)
										<option value="{{ $provincia->id }}" {{$ciudad->provincia_id == $provincia->id ? 'selected' :''}} >{{ $provincia->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="name">{{ __('Name') }} *</label>
									<input type="text" name="name" class="form-control item-name" id="name"
										placeholder="{{ __('Enter Name') }}" value="{{ $ciudad->name}}" >
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
