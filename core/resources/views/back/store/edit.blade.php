@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b>{{ __('Update Store') }}</b></h3>
				<a class="btn btn-primary btn-sm" href="{{route('back.store.index')}}"><i class="fas fa-chevron-left"></i>{{ __('Back') }}</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="admin-form" action="{{ route('back.store.update',$store->id) }}"	method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								@include('alerts.alerts')
								{{--
								<!--
								<div class="form-group">
									<label for="name">{{ __('Current Image') }} *</label>
									<br>
									<img class="admin-img" src="{{ $store->photo ? asset('assets/images/'.$store->photo) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
									<br>
									<span class="mt-1">{{ __('Image Size Should Be 60 x 60.') }}</span>
								</div>
								<div class="form-group position-relative">
									<label class="file">
										<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file" aria-label="File browser example">
										<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
									</label>
                </div>
								-->
								--}}
								<div class="form-group">
									<label for="name">{{ __('Name') }} *</label>
									<input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $store->name }}" >
								</div>
								<div class="form-group">
									<label for="telephone">{{ __('Telephone') }} *</label>
									<input type="text" name="telephone" class="form-control item-name" id="telephone" placeholder="{{ __('Enter Telephone') }}" value="{{ $store->telephone }}" >
								</div>
								<div class="form-group">
									<label for="address">{{ __('Address') }} *</label>
									<input type="text" name="address" class="form-control item-name" id="address" placeholder="{{ __('Enter Address') }}" value="{{ $store->address }}" >
								</div>
								<div class="form-group">
									<button type="submit"class="btn btn-secondary">{{ __('Submit') }}</button>
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