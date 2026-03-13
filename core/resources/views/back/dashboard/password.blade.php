@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="d-sm-flex align-items-center justify-content-between py-1 px-3">
			<h3 class="mb-0 bc-title"><b>{{ __('Change Password') }}</b></h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('back.dashboard') }}">{{ __('Dashboard') }}</a></li>
				<li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Change Password') }}</a></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="p-5">
								<form class="admin-form" action="{{ route('back.password.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
									@include('alerts.alerts')
									<div class="form-group d-block position-relative">
										<label for="current_password">{{ __('Current Password') }} *</label>
										<div class="cFrmCtrl__cInput--ico d-block position-relative">
											<input type="password" name="current_password" class="form-control" id="current_password" placeholder="{{ __('Enter Your Current Password') }}" value="">
											<div class="cFrmCtrl__cIcon--R fnc-icon_passCtrl me-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"></path></svg>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="new_password">{{ __('New Password') }} *</label>
										<input type="password" name="new_password" class="form-control" id="admn_ew_password" placeholder="{{ __('Enter Your New Password') }}" value="" >
									</div>
									<div class="form-group">
										<label for="renew_password">{{ __('Re-Type New Password') }} *</label>
										<input type="password" name="renew_password" class="form-control" id="adm_renew_password" placeholder="{{ __('Re-Type Your New Password') }}" value="" >
										<span id="mssg_cConfirmTwoPassAdm"></span>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-secondary btn-block">{{ __('Submit') }}</button>
									</div>
									<div>
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