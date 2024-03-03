@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b>{{ __('Update Coupon') }}</b> </h3>
				<a class="btn btn-primary btn-sm" href="{{route('back.coupons.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
			</div>
		</div>
	</div>
	<form class="admin-form" action="{{ route('back.coupons.update',$coupons->id) }}"	method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		@include('alerts.alerts')
		<input type="hidden" id="id" name="id" value="{{ $coupons->id }}">
		<div class="row">
			<div class="col-lg-7">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="name">{{ __('Name') }} *</label>
										<input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $coupons->name }}" >
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label for="discount_percentage">{{ __('Discount percentage') }} (%)</label>
										<input type="number" step="0.01" min="0" max="100" name="discount_percentage" id="discount_percentage" class="form-control" value="{{ isset($coupons) ? $coupons->discount_percentage : old('discount_percentage') }}" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<label for="name">{{ __('Current Image') }} *</label><br>
								<img class="admin-img" src="{{ $coupons->photo ? asset('assets/images/coupons/'.$coupons->photo) : asset('assets/images/placeholder.png') }}" alt="No Image Found"><br>
							<span class="mt-1">{{ __('The image must be no smaller than 720 x 640.') }}</span>
						</div>
						<div class="form-group position-relative">
							<label class="file">
								<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file"
									aria-label="File browser example">
								<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<button type="submit" class="btn btn-secondary ">{{ __('Update') }}</button>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name">{{ __('Start Date') }}</label>
								<input class="form-control" type="date" name="date_init" value="{{ $coupons->date_init }}" id="date_init">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name">{{ __('End Date') }}</label>
								<input class="form-control" type="date" name="date_end" value="{{ $coupons->date_end }}" id="date_end">
							</div>
						</div>
						<?php
							$formattedTime = date('H:i', strtotime($coupons->time_end));
						?>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name">{{ __('End Time') }}</label>
								<input class="form-control" type="time" name="time_end" min="<?php echo date('h:i'); ?>" value="{{ $formattedTime }}" id="time_end">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
