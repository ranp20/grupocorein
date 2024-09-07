@extends('master.back')
@section('content')
<?php
function formatTelNumber($phonenumber){
	$withoutspaces = str_replace(" ","",$phonenumber);
	$withoutspacesfinal = preg_replace('/(\d{1,3})(?=(\d{3})+$)/', '$1 ', $withoutspaces);
	return $withoutspacesfinal;
}
?>
<div class="container-fluid">
  <div class="card mb-4">
    <div class="d-sm-flex align-items-center justify-content-between py-1 px-3">
      <h3 class="mb-0 bc-title"><b>{{ __('Update Profile') }}</b></h3>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('back.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Update Profile') }}</a></li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body ">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="p-5">
							  <form class="admin-form" action="{{ route('back.profile.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
									@include('alerts.alerts')
									<div class="form-group">
										<label for="name">{{ __('Current Image') }}</label>
										<div class="col-lg-12 pb-1 mb-3">
											<div class="mxwh-50px">
												<img class="img-fluid" src="{{ $data->photo ? asset('assets/back/images/profile/'.$data->photo) : asset('assets/back/images/profile/placeholder.png') }}" alt="No Image Found" width="100" height="100">
											</div>
										</div>
										<span>{{ __('Image Size Should Be 50 x 50.') }}</span>
									</div>
									<div class="form-group position-relative text-center">
										<label class="file">
											<input type="file" accept="image/*" class="upload-photo" name="photo" id="file" aria-label="File browser example">
											<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
										</label>
									</div>
									<div class="form-group">
										<label for="name">{{ __('User Name') }} *</label>
										<input type="text" name="name" class="form-control" id="name" placeholder="{{ __('User Name') }}" value="{{$data->name}}" >
									</div>
									<div class="form-group">
										<label for="email">{{ __('Email Address') }} *</label>
										<input type="email" name="email" class="form-control" id="email" placeholder="{{ __('Email Address') }}" value="{{$data->email}}" >
									</div>
									<div class="form-group">
										<label for="phone">{{ __('Phone Number') }} *</label>
										<input type="text" name="phone" class="form-control" id="phone" placeholder="{{ __('Phone Number') }}" value="{{ formatTelNumber($data->phone) }}" minlength="9" maxlength="11" data-valformat="withspacesforthreenumbers">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-secondary btn-block">{{ __('Submit') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ asset('assets/back/js/profile.js') }}"></script>
@endsection